<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationsResource\Pages;
use App\Models\Application;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;

class ApplicationsResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-m-identification';
    protected static string | array $withoutRouteMiddleware = [''];

    public static function getGloballySearchableAttributes(): array
    {
        return ['SFName', 'SCivilId' ,'invoiceReference','invoiceId'];
    }

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return new HtmlString($record->SFName . '<small> ('.$record->SCivilId.')</small>');
    }

    public static function getGlobalSearchResultUrl(Model $record): ?string
    {

        $canView = static::canView($record);

        if (static::hasPage('view') && $canView) {
            return static::getUrl('view', ['record' => $record]);
        }

        $canEdit = static::canEdit($record);

        if (static::hasPage('edit') && $canEdit) {
            return static::getUrl('edit', ['record' => $record]);
        }
        if ($canEdit) {
            return static::getUrl(parameters: [
                'tableAction' => 'edit',
                'tableActionRecord' => $record,
            ]);
        }

        if ($canView) {
            return static::getUrl(parameters: [
                'tableAction' => 'view',
                'tableActionRecord' => $record,
            ]);
        }

        return null;
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
                        Forms\Components\TextInput::make('age')
                            ->label('Age')
                            ->disabled(),
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
                Section::make('Invoice Details')
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                        '2xl' => 4,
                    ])
                    ->schema([
                        Forms\Components\Select::make('paid')
                            ->label('Is Paid')
                            ->options([
                                '0' => 'Not Pay',
                                '1' => 'Paid',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->label('Price')
                            ->required()
                            ->type('number')
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('paid_at')
                            ->label('Paid at'),
                        Forms\Components\TextInput::make('invoiceReference')
                            ->label('Invoice Reference')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('invoiceId')
                            ->label('Invoice Id')
                            ->maxLength(255),
                    ]),
                Section::make('Other Information')
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                        '2xl' => 4,
                    ])
                    ->schema([
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Filled at')
                            ->disabled(),
                        Forms\Components\TextInput::make('HowDidYouKnow')
                            ->label('How to get to know us')
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('SFName')
                    ->label('Full Name')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('SNationlity')
                    ->label('Nationality')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('dob')
                    ->label('Birthdate')
                    ->date()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('Sex')
                    ->label('Sex')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('SCivilId')
                    ->label('Civil ID')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('SPreviousSchool')
                    ->label('Previous School Name')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('SCurricullum')
                    ->label('Curriculum')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('SHAddress')
                    ->label('Home Address')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('FName')
                    ->label('Father Full Name')
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('FNationlity')
                    ->label('Father Nationality')
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('FCivilId')
                    ->label('Father Civil ID')
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('FMobile')
                    ->label('Father Mobile')
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('FEmail')
                    ->label('Father Email')
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('FOccupation')
                    ->label('Father Occupation')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('FName')
                    ->label('Mother Full Name')
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('MNationlity')
                    ->label('Mother Nationality')
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('MCivilId')
                    ->label('Mother Civil ID')
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('MMobile')
                    ->label('Mother Mobile')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('MEmail')
                    ->label('Mother Email')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('MOccupation')
                    ->label('Mother Occupation')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Filled at')
                    ->date()
                    ->toggleable(),
                Tables\Columns\BooleanColumn::make('paid')
                    ->label('Is Paid')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('invoiceReference')
                    ->label('inv.Reference')
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('invoiceId')
                    ->label('inv.Id')
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('SFName')
                            ->label('Full Name'),
                        TextConstraint::make('SNationlity')
                            ->label('Nationality'),
                        DateConstraint::make('dob')
                            ->label('Birthdate'),
                        QueryBuilder\Constraints\SelectConstraint::make('Sex')
                            ->label('Sex')
                            ->options([
                                'Male'=>'Male',
                                'Female'=>'Female',
                            ]),
                        TextConstraint::make('SCivilId')
                            ->label('Civil ID'),
                        TextConstraint::make('SPreviousSchool')
                            ->label('Previous School Name'),
                        TextConstraint::make('SCurricullum')
                            ->label('Curriculum'),
                        TextConstraint::make('SHAddress')
                            ->label('Home Address'),
                        TextConstraint::make('FName')
                            ->label('Father Full Name'),
                        TextConstraint::make('FNationlity')
                            ->label('Father Nationality'),
                        TextConstraint::make('FCivilId')
                            ->label('Father Civil ID'),
                        TextConstraint::make('FMobile')
                            ->label('Father Mobile'),
                        TextConstraint::make('FEmail')
                            ->label('Father Email'),
                        TextConstraint::make('FOccupation')
                            ->label('Father Occupation'),
                        TextConstraint::make('FBAddress')
                            ->label('Father Address'),
                        TextConstraint::make('FName')
                            ->label('Mother Full Name'),
                        TextConstraint::make('MNationlity')
                            ->label('Mother Nationality'),
                        TextConstraint::make('MCivilId')
                            ->label('Mother Civil ID'),
                        TextConstraint::make('MMobile')
                            ->label('Mother Mobile'),
                        TextConstraint::make('MEmail')
                            ->label('Mother Email'),
                        TextConstraint::make('MOccupation')
                            ->label('Mother Occupation'),
                        TextConstraint::make('MBAddress')
                            ->label('Mother Address'),
                        DateConstraint::make('created_at')
                            ->label('Filled at'),
                        DateConstraint::make('paid_at')
                            ->label('Paid at'),
                        QueryBuilder\Constraints\SelectConstraint::make('paid')
                            ->label('Is paid')
                            ->options([
                                '0'=>'Not Pay',
                                '1'=>'Paid',
                            ]),
                        TextConstraint::make('invoiceReference')
                            ->label('Invoice Reference'),
                        TextConstraint::make('invoiceId')
                            ->label('Invoice ID'),
                    ])
                    ->constraintPickerColumns(2),
                    Tables\Filters\TrashedFilter::make('deleted_at')
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\Action::make('visit')
                        ->label('Guest View')
                        ->icon('heroicon-m-arrow-top-right-on-square')
                        ->openUrlInNewTab()
                        ->url(function(Application $application) {
                            return  route('application.show', ['uuid' => $application->uuid]);
                        }),
                    Tables\Actions\Action::make('download')
                        ->label('PDF Export')
                        ->icon('heroicon-o-document-check')
                        ->openUrlInNewTab()
                        ->url(function(Application $application) {
                            return  route('application.export', ['uuid' => $application->uuid]);
                        })
//                    Tables\Actions\EditAction::make(),
//                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
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
