<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\RichEditor;


class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('description')
                    ->required(),
                Forms\Components\RichEditor::make('features')
                    ->required(),

                FileUpload::make('thumbnail')
                    ->image()
                    ->directory('projects')
                    ->disk('public') // Pastikan disimpan di public disk
                    ->visibility('public'), // Pastikan gambar bisa diakses oleh publik
                
                FileUpload::make('gallery')
                    ->label('Project Gallery')
                    ->multiple()  // Mengizinkan unggah banyak gambar
                    ->directory('projects/gallery')
                    ->disk('public')
                    ->visibility('public'),

                Forms\Components\TextInput::make('url')
                    ->label('Project URL')
                    ->url()
                    ->maxLength(255),

                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Textarea::make('technology')
                    ->rows(4)
                    ->placeholder('Pisahkan dengan koma atau enter')
                    ->maxLength(1000),
                

                Forms\Components\DatePicker::make('completion_date'),

                Forms\Components\Toggle::make('is_featured')
                    ->label('Featured on Homepage'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

                ImageColumn::make('thumbnail'),

                ImageColumn::make('gallery')
                ->label('Gallery')
                ->limit(3), // Tampilkan maksimal 3 gambar di tabel

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable(),

                Tables\Columns\TextColumn::make('completion_date')
                    ->date(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
