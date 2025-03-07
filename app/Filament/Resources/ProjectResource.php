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
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Projects';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section for Project Details
                Forms\Components\Section::make('Project Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter project title')
                            ->helperText('The title of the project.'),

                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'link',
                                'blockquote',
                                'bulletList',
                                'orderedList',
                            ])
                            ->placeholder('Enter project description')
                            ->helperText('A detailed description of the project.'),

                        Forms\Components\RichEditor::make('features')
                            ->required()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'link',
                                'blockquote',
                                'bulletList',
                                'orderedList',
                            ])
                            ->placeholder('Enter project features')
                            ->helperText('List the key features of the project.'),
                    ])
                    ->columns(1),

                // Section for Media
                Forms\Components\Section::make('Media')
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->image()
                            ->directory('projects')
                            ->disk('public')
                            ->visibility('public')
                            ->helperText('Upload a thumbnail image for the project.')
                            ->required(),

                        FileUpload::make('gallery')
                            ->label('Project Gallery')
                            ->multiple()
                            ->directory('projects/gallery')
                            ->disk('public')
                            ->visibility('public')
                            ->helperText('Upload multiple images for the project gallery.'),
                    ])
                    ->columns(2),

                // Section for Additional Information
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\TextInput::make('url')
                            ->label('Project URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('Enter project URL')
                            ->helperText('The URL of the project (if applicable).'),

                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->placeholder('Select a category')
                            ->helperText('The category this project belongs to.'),

                        Forms\Components\Textarea::make('technology')
                            ->rows(4)
                            ->placeholder('Pisahkan dengan koma atau enter')
                            ->maxLength(1000)
                            ->helperText('List the technologies used in this project.'),

                        Forms\Components\DatePicker::make('completion_date')
                            ->placeholder('Select completion date')
                            ->helperText('The date when the project was completed.'),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured on Homepage')
                            ->helperText('Toggle to feature this project on the homepage.'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip('Project Title'),

                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->circular(),

                Tables\Columns\ImageColumn::make('gallery')
                    ->label('Gallery')
                    ->stacked()
                    ->limit(3)
                    ->tooltip('Project Gallery'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('completion_date')
                    ->label('Completion Date')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                // Filter by Category
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                // Filter for Featured Projects
                Filter::make('is_featured')
                    ->label('Featured Projects')
                    ->query(fn(Builder $query) => $query->where('is_featured', true)),
            ])
            ->actions([
                // Edit Action
                Tables\Actions\EditAction::make(),

                // Delete Action
                Tables\Actions\DeleteAction::make(),

                // Custom Action: Toggle Featured Status
                Tables\Actions\Action::make('feature')
                    ->label('Feature')
                    ->icon('heroicon-o-star')
                    ->action(function (Project $record) {
                        $record->is_featured = !$record->is_featured;
                        $record->save();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Feature Project')
                    ->modalDescription('Are you sure you want to feature this project?')
                    ->modalButton('Yes, feature it'),
            ])
            ->bulkActions([
                // Bulk Delete Action
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Jika ada relasi lain, tambahkan di sini
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
            // Jika ada custom page, tambahkan di sini
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        // Menampilkan jumlah proyek di navigation badge
        return static::getModel()::count();
    }
}