<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeolocationLogRequest;
use App\Models\GeolocationLog;
use App\Services\IpGeolocationService;
use Illuminate\Http\Request;

class GeolocationLogController extends Controller
{
    protected $geoService;

    public function __construct(IpGeolocationService $geoService)
    {
        $this->geoService = $geoService;
    }

    // Show the form for creating a new resource
    public function create(Request $request)
    {
        $ipAddress = $request->ip();

        return view('geolocation', [
            'ipAddress' => $ipAddress,
        ]);
    }

    // Store a newly created resource in storage
    public function store(GeolocationLogRequest $request)
    {
        $validatedData = $request->validated();
        $ip = $validatedData['ip'];
        $geoData = $this->geoService->getGeolocation($ip);

        if ($geoData) {
            $geolocationLog = GeolocationLog::create([
                'ip_address' => $ip,
                'country' => $geoData['country'],
                'region' => $geoData['region'],
                'city' => $geoData['city'],
                'latitude' => $geoData['latitude'],
                'longitude' => $geoData['longitude'],
            ]);
            return view('geolocation', [
                'geolocation' => $geolocationLog,
                'ipAddress' => $ip,

            ]);
        }

        // return view('geolocation', [
        //     'error' => 'Unable to fetch geolocation data.',
        // ]);
        return redirect()->back()->with('error', 'Unable to fetch geolocation data.');
    }
}
