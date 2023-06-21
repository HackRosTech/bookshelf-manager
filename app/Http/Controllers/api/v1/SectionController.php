<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Section\CreateRequest;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SectionController extends Controller
{

    public function index(): JsonResponse
    {
        $sections = Section::all();

        return response()->json([
            'sections' => $sections
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function show(Section $section): JsonResponse
    {
        return response()->json([
            'section' => $section
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function create(CreateRequest $request): JsonResponse
    {
        $section = Section::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return response()->json([
            'section' => $section
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function edit(Section $section): JsonResponse
    {
        return response()->json([
            'section' => $section
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function update(Section $section, Request $request): JsonResponse
    {
        $section->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return response()->json([
            'section' => $section
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function delete(Section $section): JsonResponse
    {
        $section->delete();

        return response()
            ->json(null, Response::HTTP_NO_CONTENT);
    }
}
