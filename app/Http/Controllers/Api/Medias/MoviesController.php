<?php

namespace App\Http\Controllers\Api\Medias;

use App\Http\Controllers\Controller;
use App\Services\MediaService\MediaServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MoviesController extends Controller
{
    public const MEDIA = 'movie';

    public function index(MediaServiceInterface $mediaService): JsonResponse
    {
        $data = $mediaService->getPage(self::MEDIA, request()->query->all());

        return response()->json($data, Response::HTTP_OK);
    }

    public function topRated(MediaServiceInterface $mediaService): JsonResponse
    {
        $data = $mediaService->getTopRated(self::MEDIA, request()->query->all());

        return response()->json($data, Response::HTTP_OK);
    }

    public function search(MediaServiceInterface $mediaService): JsonResponse
    {
        $data = $mediaService->search(self::MEDIA, request()->query->all());

        return response()->json($data, Response::HTTP_OK);
    }

    public function detail(string $id, MediaServiceInterface $mediaService): JsonResponse
    {
        $data = $mediaService->detail(self::MEDIA, $id, request()->query->all());

        return response()->json($data, Response::HTTP_OK);
    }

    public function videos(string $id, MediaServiceInterface $mediaService): JsonResponse
    {
        $data = $mediaService->videos(self::MEDIA, $id, request()->query->all());

        return response()->json($data, Response::HTTP_OK);
    }
}