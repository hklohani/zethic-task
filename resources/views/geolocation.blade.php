<!-- resources/views/geolocation.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>IP Geolocation</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />




    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <x-geolocation-form :ipAddress="$ipAddress" />

    @if (isset($geolocation))
        <div class="card">
            <h2>Geolocation Data:</h2>
            <p>Country: {{ $geolocation->country }}</p>
            <p>Region: {{ $geolocation->region }}</p>
            <p>City: {{ $geolocation->city }}</p>
            <p>Latitude: {{ $geolocation->latitude }}</p>
            <p>Longitude: {{ $geolocation->longitude }}</p>
        </div>
        <div id="map"></div>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <script>
            var map = L.map('map').setView([{{ $geolocation->latitude }}, {{ $geolocation->longitude }}], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">Zethic</a>'
            }).addTo(map);
            L.marker([{{ $geolocation->latitude }}, {{ $geolocation->longitude }}]).addTo(map)
                .bindPopup('{{ $geolocation->city }}, {{ $geolocation->region }}, {{ $geolocation->country }}')
                .openPopup();
        </script>
    @endif

    @if (isset($error))
        <p class="error">{{ $error }}</p>
    @endif


</body>

</html>
