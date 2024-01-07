<?php

namespace App\Filament\Resources\Setting;

use App\Filament\Resources\Setting;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class AdminResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Setting';
    protected static ?string $navigationLabel = "Admins";
    protected static ?string $label = "Admin";

    protected static ?string $navigationIcon = 'heroicon-m-user-group';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return new HtmlString($record->name . '<small> ('.$record->email.')</small>');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->type('email')
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->nullable()
                    ->confirmed()
                    ->type('password'),
                Forms\Components\TextInput::make('password_confirmation')
                    ->nullable()
                    ->type('password'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('id', 'desc');
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
            'index' => Setting\UserResource\Pages\ListAdmins::route('/'),
            'create' => Setting\UserResource\Pages\CreateAdmin::route('/create'),
            'edit' => Setting\UserResource\Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
