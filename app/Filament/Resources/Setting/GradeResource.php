<?php

namespace App\Filament\Resources\Setting;

use App\Filament\Resources\Setting;
use App\Models\Grade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;
    protected static ?string $navigationGroup = 'Setting';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getGloballySearchableAttributes(): array
    {
        return ['title'];
    }

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->title;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->rules(['numeric'])
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->formatStateUsing(fn (string $state): string => number_format($state,2).' KD'),
                Tables\Columns\ToggleColumn::make('is_active'),
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
            ])
            ->defaultSort('ordering')
            ->reorderable('ordering');
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
            'index' => Setting\GradeResource\Pages\ListGrades::route('/'),
            'create' => Setting\GradeResource\Pages\CreateGrade::route('/create'),
            'edit' => Setting\GradeResource\Pages\EditGrade::route('/{record}/edit'),
        ];
    }
}
