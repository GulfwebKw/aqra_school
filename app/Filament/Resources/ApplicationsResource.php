<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationsResource\Pages;
use App\Models\Application;
use App\Models\Grade;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;

class ApplicationsResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-m-identification';
    protected static string | array $withoutRouteMiddleware = [''];

    public static function getGloballySearchableAttributes(): array
    {
        return ['SFName', 'SCivilId'];
    }

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return new HtmlString($record->SFName . '<small> ('.$record->SCivilId.')</small>');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                Tabs\Tab::make('Student Details')
                Section::make('Student Details')
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                        '2xl' => 4,
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('SFName')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('SNationlity')
                            ->label('Nationality')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('dob')
                            ->label('Birthdate')
                            ->required(),
                        Forms\Components\Select::make('Sex')
                            ->label('Sex')
                            ->required()
                            ->options([
                                'Male'=>'Male',
                                'Female'=>'Female',
                            ]),
                        Forms\Components\TextInput::make('SCivilId')
                            ->label('Civil ID')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('SPreviousSchool')
                            ->label('Previous School Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('SCurricullum')
                            ->label('Curriculum')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('SHAddress')
                            ->label('Home Address')
                            ->required()
                            ->maxLength(255),
                    ]),
                Section::make('Father Details')
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                        '2xl' => 4,
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('FName')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('FNationlity')
                            ->label('Nationality')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('FCivilId')
                            ->label('Civil ID')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('FMobile')
                            ->label('Mobile')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('FEmail')
                            ->label('Email')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('FOccupation')
                            ->label('Occupation')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('FBAddress')
                            ->label('Address')
                            ->required()
                            ->maxLength(255),
                    ]),
                Section::make('Mother Details')
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                        '2xl' => 4,
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('FName')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('MNationlity')
                            ->label('Nationality')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('MCivilId')
                            ->label('Civil ID')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('MMobile')
                            ->label('Mobile')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('MEmail')
                            ->label('Email')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('MOccupation')
                            ->label('Occupation')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('MBAddress')
                            ->label('Address')
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('SFName')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('SNationlity')
                    ->label('Nationality')
                    ->searchable(),
                Tables\Columns\TextColumn::make('SCivilId')
                    ->label('Civil ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Filled At')
                    ->date(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('grade')
                    ->form([
                        Forms\Components\Select::make('grade')
                            ->options(Grade::withTrashed()->get()->mapWithKeys(fn($item) => [$item->id => $item->title])),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['grade'] ?? null,
                                fn (Builder $query, $date): Builder => $query->where('Grade_id', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['grade'] ?? null) {
                            $indicators['grade'] = 'Application Of ' . optional(Grade::withTrashed()->find($data['grade']))->title ;
                        }
                        return $indicators;
                    }),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Application from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Application until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
//                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
//                    Tables\Actions\EditAction::make(),
//                    Tables\Actions\DeleteAction::make(),
//                ]),
            ])
            ->bulkActions([
            ]);
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
            'index' => Pages\ListApplications::route('/'),
//            'create' => Pages\CreateApplications::route('/create'),
            'view' => Pages\ViewApplications::route('/{record}'),
            'edit' => Pages\EditApplications::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
