<?php

namespace App\Events;

use App\Models\Book;
use Illuminate\Queue\SerializesModels;

class BookSaved
{
    use SerializesModels;

    public Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function handle(): void
    {
        $this->book->searchable();
    }
}
