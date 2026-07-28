<?php

namespace App\Filament\Organization\Resources\OrganizationMembers;

use App\Filament\Organization\Resources\OrganizationMembers\Pages\CreateOrganizationMember;
use App\Filament\Organization\Resources\OrganizationMembers\Pages\EditOrganizationMember;
use App\Filament\Organization\Resources\OrganizationMembers\Pages\ListOrganizationMembers;
use App\Filament\Organization\Resources\OrganizationMembers\Pages\ViewOrganizationMember;
use App\Filament\Organization\Resources\OrganizationMembers\Schemas\OrganizationMemberForm;
use App\Filament\Organization\Resources\OrganizationMembers\Schemas\OrganizationMemberInfolist;
use App\Filament\Organization\Resources\OrganizationMembers\Tables\OrganizationMembersTable;
use App\Models\OrganizationMember;
use BackedEnum;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrganizationMemberResource extends Resource
{
    protected static ?string $model = OrganizationMember::class;

    protected static string|BackedEnum|null $navigationIcon = Phosphor::UsersFour;

    protected static ?string $recordTitleAttribute = 'user_name';

    protected static ?string $navigationLabel = 'Members';

    public static function form(Schema $schema): Schema
    {
        return OrganizationMemberForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OrganizationMemberInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrganizationMembersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrganizationMembers::route('/'),
            'create' => CreateOrganizationMember::route('/create'),
            'view' => ViewOrganizationMember::route('/{record}'),
            'edit' => EditOrganizationMember::route('/{record}/edit'),
        ];
    }
}
