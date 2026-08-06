<?php

namespace App\Filament\Pages;

use Fahiem\FilamentPinpoint\Pinpoint;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\ToolbarButtonGroup;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\EditTenantProfile;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class EditOrganizationProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Organization profile';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Organization Information')
                        ->icon(Phosphor::Storefront)
                        ->completedIcon(Phosphor::CheckCircle)
                        ->schema([
                            Group::make([
                                FileUpload::make('org_logo')
                                    ->label("Your Organization's Logo")
                                    ->required()
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->directory('org_uploads')
                                    ->visibility('public')
                                    ->columnSpan([
                                        'default' => 1,
                                        'md' => 2,
                                        'lg' => 2,
                                    ])
                                    ->maxSize(512)
                                    ->optimize('webp')
                                    ->validationMessages([
                                        'required' => 'Please upload an organization logo.',
                                        'image' => 'The uploaded file must be an image.',
                                        'max' => 'The uploaded file must be less than 512kb.',
                                    ]),

                                Group::make([
                                    TextInput::make('org_name')
                                        ->label('Name')
                                        ->required()
                                        ->trim()
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->unique(table: 'organizations', column: 'org_name')
                                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('org_slug', Str::slug($state)))
                                        ->validationMessages([
                                            'required' => 'Please enter an organization name.',
                                            'unique' => 'This organization name is already taken.',
                                        ]),

                                    TextInput::make('org_slug')
                                        ->label('Slug')
                                        ->required()
                                        ->trim()
                                        ->maxLength(255)
                                        ->disabled()
                                        ->dehydrated()
                                        ->validationMessages([
                                            'required' => 'Please generate slug.',
                                            'unique' => 'This slug is already taken.',
                                        ]),

                                    Group::make([
                                        TextInput::make('org_email')
                                            ->label('Email')
                                            ->email()
                                            ->trim()
                                            ->required()
                                            ->suffixIcon(Phosphor::Envelope)
                                            ->maxLength(255)
                                            ->validationMessages([
                                                'required' => 'Please enter an email.',
                                                'unique' => 'This email is already taken.',
                                                'email' => 'Please enter a valid email.',
                                            ]),

                                        TextInput::make('org_contact_number')
                                            ->label('Contact Number')
                                            ->tel()
                                            ->trim()
                                            ->required()
                                            ->suffixIcon(Phosphor::Phone)
                                            ->maxLength(10) // Total characters allowed in the input box (e.g., 9493934319)
                                            ->telRegex('/^9\d{9}$/') // Ensures it starts with 9 and is followed by exactly 9 digits
                                            ->prefix('+639')
                                            ->validationMessages([
                                                'required' => 'Please enter a contact number.',
                                                'regex' => 'The contact number must be a valid 10-digit number starting with 9.',
                                                'max' => 'The contact number must be 10 digits.',
                                            ]),

                                    ])
                                        ->columnSpanFull()
                                        ->columns([
                                            'default' => 1,
                                            'sm' => 1,
                                            'md' => 2,
                                            'lg' => 2,
                                        ]),

                                    TagsInput::make('org_cat')
                                        ->label('Categories')
                                        ->required()
                                        ->reorderable()
                                        ->trim()
                                        ->splitKeys(['Tab', ' '])
                                        ->nestedRecursiveRules([
                                            'min:3',
                                            'max:150',
                                        ])
                                        ->separator(',')
                                        ->suggestions([
                                            'restaurant',
                                            'hotel',
                                            'supermarket',
                                            'bakery',
                                            'NGO',
                                            'LGU',
                                            'community pantry'
                                        ])
                                        ->columnSpanFull(),
                                ])
                                    ->columns(2)
                                    ->columnSpan([
                                        'default' => 1,
                                        'md' => 3,
                                        'lg' => 3,
                                    ])
                            ])
                                ->columnSpanFull()
                                ->columns([
                                    'default' => 1,
                                    'md' => 5,
                                    'lg' => 5,
                                ]),
                        ]),
                    Step::make('Orginization Description')
                        ->icon(Phosphor::ArticleNyTimes)
                        ->completedIcon(Phosphor::CheckCircle)
                        ->schema([
                            RichEditor::make('org_desc')
                                ->label('Description')
                                ->maxLength(2000)
                                ->floatingToolbars([
                                    'paragraph' => [
                                        'bold',
                                        'italic',
                                        'underline',
                                        'strike',
                                        'subscript',
                                        'superscript',
                                    ],
                                    'heading' => [
                                        'h1',
                                        'h2',
                                        'h3',
                                    ],
                                    'table' => [
                                        'tableAddColumnBefore',
                                        'tableAddColumnAfter',
                                        'tableDeleteColumn',
                                        'tableAddRowBefore',
                                        'tableAddRowAfter',
                                        'tableDeleteRow',
                                        'tableMergeCells',
                                        'tableSplitCell',
                                        'tableToggleHeaderRow',
                                        'tableToggleHeaderCell',
                                        'tableDelete',
                                    ],
                                ])
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'strike', 'link'],
                                    [ToolbarButtonGroup::make('Paragraph', ['paragraph', 'h1', 'h2', 'h3'])->textualButtons()],
                                    [ToolbarButtonGroup::make('Alignment', ['alignStart', 'alignCenter', 'alignEnd', 'alignJustify'])],
                                    ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                    ['undo', 'redo'],
                                ])
                                ->validationMessages([
                                    'max' => 'The description must not exceed :max characters.',
                                ])

                        ]),
                    Step::make('Location & Other Details')
                        ->icon(Phosphor::MapPin)
                        ->completedIcon(Phosphor::Info)
                        ->schema([
                            Group::make([
                                Pinpoint::make('other_details') // dummy key, just anchors the picker UI
                                    ->label('Location')
                                    ->defaultLocation(10.90154, 123.0705)
                                    ->defaultZoom(15)
                                    ->height(300)
                                    ->latField('other_details.lat')
                                    ->lngField('other_details.long')
                                    ->addressField('other_details.address')
                                    ->draggable()
                                    ->searchable()
                                    ->columnSpanFull()
                                    ->live(onBlur: true),

                                Hidden::make('other_details.lat')
                                    ->label('Latitude'),

                                Hidden::make('other_details.long')
                                    ->label('Longitude'),

                                Hidden::make('other_details.address')
                                    ->label('Address'),
                            ])
                                ->columnSpanFull()
                                ->columns([
                                    'default' => 1,
                                    'md' => 2,
                                    'lg' => 2,
                                ])
                        ]),


                ])
                    ->columnSpanFull()
                    ->submitAction(new HtmlString(Blade::render(<<<'BLADE'
                    <x-filament::button type="submit" size="sm">
                        {{ __('Update Organization') }}
                    </x-filament::button>
                BLADE)))
            ])
            ->columns([
                'default' => 1,
                'md' => 5,
                'lg' => 5,
            ]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $oldSlug = $record->org_slug;
        $newSlug = $data['org_slug'];
        $data['org_contact_number'] = Str::trim('0' . $data['org_contact_number']);
         $data['org_type'] = Str::of(Auth::user()->getRoleNames()->first())->title()->trim();
         
        $record->update($data);

        // If slug changed, redirect to the new tenant URL
        if ($oldSlug !== $newSlug) {
            $this->redirect(
                route('filament.organization.tenant', ['tenant' => $newSlug]),
                navigate: false
            );
        }

        return $record;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['org_contact_number'] = Str::replace('0', '', $data['org_contact_number']);

        return $data;
    }

    /**
     * Remove the default register button rendered outside the wizard.
     */
    protected function getFormActions(): array
    {
        return [];
    }
}
