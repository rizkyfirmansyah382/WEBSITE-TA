@extends('admin.temp_admin.index')
@section('content')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.9/dist/leaflet-search.src.min.css">

    <style>
        #map {
            height: 400px;
        }
    </style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Tambahkan Polygon Baru</div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Tambahkan Polygon Baru</div>
                <div class="card-body">
                    <form action="/data-pemetaan/{{ $id_anggota_tervalidasi }}/editData" method="POST">
                        @csrf
                        <div class="form-group ">
                            <label for="">Koordinat</label>
                            <input value="{{ $data->coordinates }}" type="text" class="form-control @error('coordinates')
                                is-invalid
                            @enderror" name="coordinates" id="coordinates">
                            @error('coordinates')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm my-2">edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.9/dist/leaflet-search.src.min.js"></script>

    <script>
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        var Stadia_Dark = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
            });

        var Esri_WorldStreetMap = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
            });

        // var map = L.map('map', {
        //     center: [{{ $polygon->id_anggota_tervalidasi }}],
        //     zoom: 10,
        //     layers: [osm]
        // });

        var map = L.map('map', {
        center: [0.33129702610172435, 101.02436296565637], // Koordinat tetap (ganti sesuai kebutuhan)
        zoom: 10,
        layers: [osm]
        });


        var baseMaps = {
            'Open Street Map': osm,
            'Esri World': Esri_WorldStreetMap,
            'Stadia Dark': Stadia_Dark
        }

        L.control.layers(baseMaps).addTo(map)

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                polygon: {
                    allowIntersection: false, // Restrict drawing polygons that intersect
                    drawError: {
                        color: '#e1e100', // Color the shape will turn when intersects
                        message: '<strong>Oh snap!<strong> you can\'t draw that!', // Message that will show when intersect
                    },
                    shapeOptions: {
                        color: '#97009c', // Color of the polygon
                    },
                },
                polyline: false,
                circle: false,
                marker: false,
                circlemarker: false,
            },
            edit: {
                featureGroup: drawnItems,
            },
        });
        map.addControl(drawControl);

        var latlngsArray = []; // Array to store coordinates

        map.on(L.Draw.Event.CREATED, function (e) {
            var layer = e.layer;
            var type = e.layerType;

            if (type === 'polygon') {
                var latlngs = layer.getLatLngs()[0]; // Get polygon coordinates

                var coords = latlngs.map(function (latlng) {
                    return [latlng.lat, latlng.lng];
                });

                latlngsArray.push(coords);
                drawnItems.addLayer(layer);
                $('[name="coordinates"]').val(JSON.stringify(latlngsArray));

                console.log(latlngsArray); // Display the array in the console
            }
        });

        // ... (your existing code for updating marker location or clicking on the map) ...
    </script>

@endsection