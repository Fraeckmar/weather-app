<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherDailyRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function weatherToday(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
            'units' => 'required|string'
        ]);
        $reqUri = env('WEATHER_APP_API_URI').'/data/2.5/weather';
        $client = new Client();
        $response = $client->request('GET', $reqUri, [
            'query' => [
                'q' => $request->city,
                'units' => $request->units,
                'appid' => env('WEATHER_MAP_API')
            ]
        ]);
        $data = json_decode($response->getBody()->getContents());
        $data->date = date('M d, Y H:i', $data->dt);
        return $data;
    }

    public function weatherDaily(WeatherDailyRequest $request)
    {
        $reqUri = env('WEATHER_APP_API_URI').'/data/2.5/onecall';
        $client = new Client();
        $response = $client->request('GET', $reqUri, [
            'query' => [
                'lat' => $request->lat,
                'lon' => $request->lon,
                'units' => $request->units,
                'exclude' => 'hourly,minutely',
                'appid' => env('WEATHER_MAP_API')
            ]
        ]);
        $content = json_decode($response->getBody()->getContents());
        $data = [];
        foreach ($content->daily as $idx => $weather) {
            if ($idx == 0 || $idx > 6) {
                continue;
            }
            $data[] = [
                'date' => date('D', $weather->dt),
                'temp' => round(($weather->temp->min + $weather->temp->max) / 2),
                'day' => round($weather->temp->day),
                'night' => round($weather->temp->night),
                'eve' => round($weather->temp->eve),
                'morn' => round($weather->temp->morn),
                'icon' => env('WEATHER_APP_URI').'/img/w/'.$weather->weather[0]->icon.'.png'
            ];
        }
        return $data;
    }
}
