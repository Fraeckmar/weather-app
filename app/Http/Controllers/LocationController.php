<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationDetailsRequest;
use App\Http\Requests\LocationSearchRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function search(LocationSearchRequest $request)
    {
        $client = new Client();
        $reqUri = env('FOURSQUARE_LOCATION_URI').'/v3/places/search';
        $response = $client->request('GET', $reqUri, [
            'headers' => [
                'Authorization' => env('FOURSQUARE_LOCATION_KEY')
            ],
            'query' => [
                'near' => $request->venue
            ]
        ]);
        $content = json_decode($response->getBody()->getContents());
        $data = [];
        if ($response->getStatusCode() == 200 && !empty($content->results)) {
            foreach ($content->results as $place) {
                $icons = [];
                if (!empty($place->categories)) {
                    foreach ($place->categories as $cat) {
                        $icons[] = $cat->icon->prefix.'120'.$cat->icon->suffix;
                    }
                }
                $data[] = [
                    'fsqId' => $place->fsq_id,
                    'name' => $place->name,
                    'icons' => $icons
                ];
            }
        }
        return $data;
    }

    public function details(LocationDetailsRequest $request) 
    {
        $reqUri = env('FOURSQUARE_LOCATION_URI').'/v3/places/'.$request->fsq_id;
        $client = new Client();
        $response = $client->request('GET', $reqUri, [
            'headers' => [
                'Authorization' => env('FOURSQUARE_LOCATION_KEY')
            ]
        ]);
        $content = $response->getBody()->getContents();
        return json_decode($content);
    }

    public function photos(LocationDetailsRequest $request)
    {
        $reqUri = env('FOURSQUARE_LOCATION_URI').'/v3/places/'.$request->fsq_id.'/photos';
        $client = new Client();
        $response = $client->request('GET', $reqUri, [
            'headers' => [
                'Authorization' => env('FOURSQUARE_LOCATION_KEY')
            ]
        ]);
        $content = json_decode($response->getBody()->getContents());
        $data = [];
        if ($response->getStatusCode() == 200 && !empty($content)) {
            foreach ($content as $photo) {
                $data[] = $photo->prefix.'300'.$photo->suffix;
            }
        }
        return $data;
    }

    public function tips(LocationDetailsRequest $request)
    {
        $reqUri = env('FOURSQUARE_LOCATION_URI').'/v3/places/'.$request->fsq_id.'/tips';
        $client = new Client();
        $response = $client->request('GET', $reqUri, [
            'headers' => [
                'Authorization' => env('FOURSQUARE_LOCATION_KEY')
            ]
        ]);
        $content = json_decode($response->getBody()->getContents());
        $data = [];
        if ($response->getStatusCode() == 200 && !empty($content)) {
            foreach ($content as $comment) {
                $data[] = $comment->text;
            }
        }
        return $data;
    }
}
