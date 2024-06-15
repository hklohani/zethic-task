<?php

// app/Services/IpGeolocationService.php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IpGeolocationService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.abstract_api');
    }

    public function getGeolocation($ip)
    {
        Log::info('Abstract API key: ' . $ip);


        return Cache::remember("geolocation_{$ip}", 3600, function () use ($ip) {
            try {
                $response = Http::get('https://ipgeolocation.abstractapi.com/v1/', [
                    'api_key' => $this->apiKey,
                    'ip_address' => $ip,
                ]);

                if ($response->failed()) {
                    Log::error('Geolocation API request failed', ['response' => $response->body()]);
                    return null;
                }

                return $response->json();
            } catch (\Exception $e) {
                Log::error('Error fetching geolocation data', ['exception' => $e->getMessage()]);
                return null;
            }
        });
    }
}
