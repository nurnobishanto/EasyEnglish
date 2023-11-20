<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label('Questions Title')->columnSpan('full'),
                Select::make('subject_id')
                    ->relationship('subject', 'name')->required(),
                Select::make('exam_papers')
                    ->multiple()
                    ->relationship('exam_papers', 'name'),
                // CheckboxList::make('exampapers')
                //  ->relationship('exampapers', 'name'),
                FileUpload::make('image'),
                Textarea::make('description')->label('Questions Description'),
                TextInput::make('op1')->required()->label('Option A'),
                TextInput::make('op2')->required()->label('Option B'),
                TextInput::make('op3')->required()->label('Option C'),
                TextInput::make('op4')->required()->label('Option D'),
                Select::make('ca')->required()->label('Select Correct Answer')
                    ->options([
                        'op1' => 'Option A',
                        'op2' => 'Option B',
                        'op3' => 'Option C',
                        'op4' => 'Option D',
                    ]),
                FileUpload::make('explain_img')->label('Explain Image'),
                Textarea::make('explain')->label('Questions Explain')->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('op1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('op2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('op3')
                    ->searchable(),
                Tables\Columns\TextColumn::make('op4')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ca')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
