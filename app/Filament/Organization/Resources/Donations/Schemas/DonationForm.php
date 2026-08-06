<?php

namespace App\Filament\Organization\Resources\Donations\Schemas;

use App\Enums\DonationItemUnitEnums;
use App\Models\Donation;
use App\Models\FoodCategory;
use Carbon\Carbon;
use Fahiem\FilamentPinpoint\Pinpoint;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DonationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema(static::getDetailsComponents())
                            ->columns([
                                'default' => 1,
                                'sm' => 1,
                                'md' => 2,
                                'lg' => 2,
                            ]),

                        Section::make()
                            // ->afterHeader([
                            //     Action::make('reset')
                            //         ->modalHeading('Are you sure?')
                            //         ->modalDescription('All existing items will be removed from the order.')
                            //         ->requiresConfirmation()
                            //         ->color('danger')
                            //         ->action(fn (Set $set) => $set('items', [])),
                            // ])
                            ->schema(
                                static::getLocationComponents(),
                            )
                            ->columns([
                                'default' => 1,
                                'sm' => 1,
                                'md' => 2,
                                'lg' => 2,
                            ]),
                        Section::make()
                            ->schema([static::getDonationItemsRepeater()]),
                    ]),
                // ->columnSpan(['lg' => fn (?Order $record) => $record === null ? 3 : 2]),
            ]);
    }

    public static function generateRefNo(): string
    {
        return 'GP#-'.strtoupper(Str::random(6));
    }

    /**
     * @return array<Component>
     */
    public static function getDetailsComponents(): array
    {
        return [
            TextInput::make('reference_no')
                ->label('Ref #')
                ->required()
                ->unique(ignoreRecord: true)
                ->default(fn () => static::generateRefNo())
                ->suffixAction(
                    Action::make('generateRefNo')
                        ->icon(Phosphor::ArrowsClockwise)
                        ->tooltip('Generate Reference No.')
                        ->action(function (callable $set) {
                            $set('reference_no', static::generateRefNo());
                        }),
                )
                ->dehydrated(),

            TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(255),

            DateTimePicker::make('available_from')
                ->required()
                ->prefix('Start')
                ->minDate(fn (string $operation) => $operation === 'create' ? now() : null)
                ->live(onBlur: true)
                ->afterOrEqual(fn (string $operation) => $operation === 'create' ? now() : null)
                ->displayFormat('M/d/Y h:i A')
                ->seconds(false),

            DateTimePicker::make('expires_at')
                ->required()
                ->prefix('End')
                ->minDate(fn (Get $get) => $get('available_from') ?? now())
                ->after('available_from') // keep this — always valid regardless of operation
                ->after(fn (string $operation) => $operation === 'create' ? 'now' : null) // only enforce on create
                ->displayFormat('M/d/Y h:i A')
                ->seconds(false),
        ];
    }

    /**
     * @return array<Component>
     */
    public static function getLocationComponents(): array
    {
        return [
            Pinpoint::make('pickup_location')
                ->label('Pick up Location')
                ->provider('leaflet')
                ->defaultLocation(10.90154, 123.0705) // Victorias Default
                ->defaultZoom(15)
                ->height(400)
                ->latField('pickup_location.lat')
                ->lngField('pickup_location.long')
                ->addressField('pickup_location.address')
                ->draggable()
                ->searchable()
                ->columnSpanFull()
                ->height(300)
                ->dehydrated(),

            TextInput::make('pickup_location.lat')
                ->label('Latitude')
                ->readOnly(),

            TextInput::make('pickup_location.long')
                ->label('Longitude')
                ->readOnly(),
        ];
    }

    public static function getDonationItemsRepeater(): Repeater
    {
        return Repeater::make('donationItems')
            ->relationship('donationItems')
            ->schema([
                Group::make([
                    TextInput::make('food_name')
                        ->label('Food')
                        ->maxLength(255)
                        ->required()
                        ->trim()
                        ->unique(ignoreRecord: true)
                        ->live(onBlur: true),

                    Select::make('food_category_id')
                        ->label('Category')
                        ->options(
                            fn () => FoodCategory::query()
                                ->pluck('name', 'id')
                                ->map(fn ($name) => Str::title($name))
                        )
                        ->required()
                        ->reactive()
                        ->distinct()
                        ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                        ->searchable()
                        ->native(false)
                        ->preload()
                        ->optionsLimit(5),

                    DatePicker::make('expires_at')
                        ->label('Expires')
                        ->required()
                        ->minDate(now())
                        ->after('available_from')
                        ->displayFormat('M j, Y')
                        ->native(false)
                        ->suffixIcon(Phosphor::CalendarDots)
                        ->columnSpan([
                            'default' => 1,
                            'sm' => 1,
                            'md' => 2,
                            'lg' => 2,
                        ])
                        ->columnSpanFull(),

                    Group::make([
                        TextInput::make('quantity')
                            ->label('Qty.')
                            ->integer()
                            ->minValue(1)
                            ->maxValue(2147483647)
                            ->default(1)
                            ->required(),

                        Select::make('unit')
                            ->label('Unit')
                            ->placeholder('')
                            ->options(DonationItemUnitEnums::class)
                            ->native(false)
                            ->required(),

                        TextInput::make('temperature_required')
                            ->label('Temp.')
                            ->maxLength(255)
                            ->trim(),

                        TextInput::make('estimated_meals')
                            ->label('Meals')
                            ->maxLength(255)
                            ->trim(),
                    ])->columnSpanFull()
                        ->columns([
                            'default' => 1,
                            'sm' => 1,
                            'md' => 2,
                            'lg' => 4,
                        ]),

                    Textarea::make('food_desc')
                        ->label('Description')
                        ->maxLength(255)
                        ->trim()
                        ->columnspanFull(),

                ])
                    ->columns([
                        'default' => 1,
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2,
                    ])
                    ->columnSpan([
                        'default' => 1,
                        'sm' => 1,
                        'md' => 3,
                        'lg' => 3,
                    ]),
                Group::make([
                    FileUpload::make('food_imgs.images')
                        ->label('Attachments')
                        ->required()
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('donation_attachments')
                        ->visibility('public')
                        ->multiple()
                        ->maxParallelUploads(1)
                        ->panelLayout('grid')
                        ->reorderable()
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp'])
                        ->maxSize(2048)
                        ->maxFiles(3)
                        ->optimize('webp'),

                    DateTimePicker::make('prepared_at')
                        ->label('Prepared')
                        ->required()
                        ->maxDate(now())
                        ->before('expires_at')
                        ->displayFormat('M j, Y h:i A')
                        ->seconds(false)
                        ->native(false)
                        ->suffixIcon(Phosphor::CalendarDots)
                        ->default(now())
                        ->dehydrated()
                        ->readOnly(),
                ])
                    ->columnSpan([
                                            'default' => 1,
                                            'sm' => 1,
                                            'md' => 2,
                                            'lg' => 2,
                                        ]),

            ])
            ->columns([
                                    'default' => 1,
                                    'sm' => 1,
                                    'md' => 5,
                                    'lg' => 5,
                                ])
            ->extraItemActions([
                                    // Action::make('openProduct')
                                    //     ->tooltip('Open product')
                                    //     ->icon(Heroicon::ArrowTopRightOnSquare)
                                    //     ->url(function (array $arguments, Repeater $component): ?string {
                                    //         $itemData = $component->getRawItemState($arguments['item']);

                                    //         $product = Product::find($itemData['product_id']);

                                    //         if (! $product) {
                                    //             return null;
                                    //         }

                                    //         return ProductResource::getUrl('edit', ['record' => $product]);
                                    //     }, shouldOpenInNewTab: true)
                                    //     ->hidden(fn (array $arguments, Repeater $component): bool => blank($component->getRawItemState($arguments['item'])['product_id'])),
                                ])
            ->itemLabel(fn (array $state): ?string => $state['food_name'] ?? null)
            ->defaultItems(1)
            ->hiddenLabel()
            ->required()
            ->addActionLabel('Add another item')
            ->collapsible()
            ->addActionAlignment(Alignment::End)
            ->mutateRelationshipDataBeforeCreateUsing(function (array $data, ?Donation $record): array {
                $data['food_name'] = Str::of($data['food_name'])->title();
                $data['organization_id'] = $record?->organization_id ?? Auth::user()->organization_id;
                $data['prepared_at'] = Carbon::parse($data['prepared_at'])->format('Y-m-d H:i:s');

                return $data;
            });
    }
}
