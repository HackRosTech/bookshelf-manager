<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::all();

        return response()->json([
            'books' => $books
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function show(Book $book): JsonResponse
    {
        return response()->json([
            'book' => $book
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function create(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'cover_image' => 'image|max:2048',
            'year_of_publication' => 'required',
            'author_id' => 'required|exists:authors,id',
            'section_id' => 'required|exists:sections,id',
        ]);

        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $request->file('cover_image')->store('public/cover_images');
        }

        $book = Book::create($validatedData);

        return response()->json([
            'book' => $book
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function edit(Book $book): JsonResponse
    {
        return response()->json([
            'book' => $book
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function update(Book $book, Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'cover_image' => 'image|max:2048',
            'year_of_publication' => 'required',
            'author_id' => 'required|exists:authors,id',
            'section_id' => 'required|exists:sections,id',
        ]);


        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $request->file('cover_image')->store('public/cover_images');
        }

        $book->update($validatedData);

        return response()->json([
            'book' => $book
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function delete(Book $book): JsonResponse
    {
        $book->delete();

        return response()
            ->json(null, Response::HTTP_NO_CONTENT);
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->get('query');

        $books = Book::search($query)->paginate();

        return response()->json([
            'books' => $books
        ])->setStatusCode(Response::HTTP_OK);
    }
}
