<?php

namespace App\Models;

use App\Events\BookSaved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JetBrains\PhpStorm\ArrayShape;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory, Searchable;

    protected $table = 'books';

    protected $dispatchesEvents = [
        'saved' => BookSaved::class,
    ];


    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'year_of_publication',
        'author_id',
        'section_id',
    ];

    #[ArrayShape(['id' => "mixed", 'title' => "mixed", 'description' => "mixed", 'author' => "mixed", 'section' => "mixed"])]
    public function toSearchableArray(): array
    {
        $array = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'author' => $this->author->full_name,
            'section' => $this->section->name,
        ];

        return $array;
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
