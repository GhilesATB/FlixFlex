<?php

namespace App\Services\DataSource;

use Illuminate\Support\Facades\Http;

class MediaDataSource implements ExternalApiDataSourceInterface
{
    public function __construct(private readonly string $base_url)
    {}

    /*
     * build and request data from external Api based on term media_type , ids and request parameters
     */
    public function getData(string $term, string $mediaType, array $id = null, $params = null): Object
    {
        $uri = $this->makeUri($term, $mediaType, $id);
        $data = $this->RequestData($uri, $params);

        return $data;
    }

    /*
     * request data from external api based on uri and request params using authorization token
     */
    public function RequestData(string $uri, array $params): Object
    {
        $response = Http::withHeaders(['Authorization' =>'Bearer ' .env('TMDB_API_TOKEN')])->get($uri, $params);

        $data = json_decode($response->body());

        return $data;
    }

    /*
     * build request uri based on term and ids
     */
    private function makeUri(string $term, string $mediaType, array $ids = null): string
    {
        $uri = match ($term) {
            'discover' => "{$this->base_url}/discover/" . $mediaType,
            'top_rated' => "{$this->base_url}/{$mediaType}/top_rated",
            'search' => "{$this->base_url}/search/{$mediaType}",
            'detail' => "{$this->base_url}/{$mediaType}/{$ids[$mediaType]}",
            'videos' => "{$this->base_url}/{$mediaType}/{$ids[$mediaType]}/videos",
        };

        return $uri;
    }
}