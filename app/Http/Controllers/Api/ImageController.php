<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function index(): JsonResponse
    {
        $images = Image::all();

        return response()->json($images);
    }

    public function show(int $id): JsonResponse
    {
        $image = Image::find($id);

        try {
            // Attempt to retrieve the image by their ID
            $image = Image::findOrFail($id);

            // Return a successful response with the image data
            return response()->json($image);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // If the image is not found, return a 404 response
            return response()->json(['message' => 'Image not found'], Response::HTTP_NOT_FOUND);
        }

    }
}