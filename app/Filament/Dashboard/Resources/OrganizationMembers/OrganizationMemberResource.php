<?php

namespace App\Filament\Dashboard\Resources\OrganizationMembers;

use App\Filament\Dashboard\Resources\OrganizationMembers\Pages\CreateOrganizationMember;
use App\Filament\Dashboard\Resources\OrganizationMembers\Pages\EditOrganizationMember;
use App\Filament\Dashboard\Resources\OrganizationMembers\Pages\ListOrganizationMembers;
use App\Filament\Dashboard\Resources\OrganizationMembers\Pages\ViewOrganizationMember;
use App\Filament\Dashboard\Resources\OrganizationMembers\Schemas\OrganizationMemberForm;
use App\Filament\Dashboard\Resources\OrganizationMembers\Schemas\OrganizationMemberInfolist;
use App\Filament\Dashboard\Resources\OrganizationMembers\Tables\OrganizationMembersTable;
use App\Models\OrganizationMember;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrganizationMemberResource extends Resource
{
    protected static ?string $model = OrganizationMember::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'user_id';

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
