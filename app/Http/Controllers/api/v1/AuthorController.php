<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        $authors = Author::all();

        return response()->json([
            'authors' => $authors
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function show(Author $author): JsonResponse
    {
        return response()->json([
            'author' => $author
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function create(Request $request): JsonResponse
    {
        $author = Author::create([
            'full_name' => $request->input('full_name'),
            'country_of_birth' => $request->input('country_of_birth'),
            'comment' => $request->input('comment')
        ]);

        return response()->json([
            'author' => $author
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function edit(Author $author): JsonResponse
    {
        return response()->json([
            'author' => $author
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function update(Author $author, Request $request): JsonResponse
    {
        $author->update([
            'full_name' => $request->input('full_name'),
            'country_of_birth' => $request->input('country_of_birth'),
            'comment' => $request->input('comment')
        ]);

        return response()->json([
            'author' => $author
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function delete(Author $author): JsonResponse
    {
        $author->delete();

        return response()
            ->json(null, Response::HTTP_NO_CONTENT);
    }
}
