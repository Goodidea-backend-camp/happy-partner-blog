<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true),
                TextInput::make('slug')
                    // ->required() // Temporarily removed for testing spatie/laravel-sluggable backend generation
                    ->maxLength(255)
                    ->unique(Post::class, 'slug', ignoreRecord: true)
                    ->readonly(),
                MarkdownEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->required()
                    ->default('draft')
                    ->reactive(),
            ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        // $data['user_id'] = auth()->id(); // Removed, now handled by Post model event
        
        // Handle published_at based on status during creation
        if (isset($data['status'])) {
            if ($data['status'] === 'published' && empty($data['published_at'])) {
                $data['published_at'] = now();
            } elseif ($data['status'] === 'draft') {
                $data['published_at'] = null;
            }
        }
        return $data;
    }
    
    public static function mutateFormDataBeforeSave(array $data): array
    {
        // Access the original record to check old status if needed
        $originalRecord = null;
        if (isset($data['id'])) {
            $originalRecord = static::getModel()::find($data['id']);
        }

        if ($data['status'] === 'published') {
            // If it's being published now (either new or status changed from draft)
            // or was already published and remains so, ensure published_at is set.
            if (!$originalRecord || $originalRecord->status !== 'published' || $originalRecord->published_at === null) {
                 // If it wasn't published before, or published_at was null, set it now.
                 $data['published_at'] = now();
            } else {
                // It was already published and had a date, keep the original date unless explicitly changed.
                // If published_at could be part of $data (e.g. from a form field), we might need to handle it.
                // For now, we assume we only set it if it's newly published or was null.
                $data['published_at'] = $originalRecord->published_at; 
            }
        } elseif ($data['status'] === 'draft') {
            $data['published_at'] = null;
        }
        // Ensure user_id is not lost on update, if not part of $data
        if ($originalRecord && !isset($data['user_id'])) {
            $data['user_id'] = $originalRecord->user_id;
        }

        return $data;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Author')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'secondary' => 'draft',
                        'success' => 'published',
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // We can add filters for status or author later if needed
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        if (auth()->check() && auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }
        return $query;
    }
}
