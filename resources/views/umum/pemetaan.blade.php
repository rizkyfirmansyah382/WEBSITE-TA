@extends('umum.temp_umum.index')

@section('content')
    {{-- Content --}}
    <div id="map" style="height: 700px"></div>
    {{-- Footer --}}
    <div class="fixed-bottom pt-2 text-white" style="background-color: #006F1F">
        <center>
            <p style="font-weight: bolder">&copy; 2023 KUD Sawit Jaya x Rizky Firmansyah x Romi Irawan.</p>
        </center>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdn.jsdelivr.net/npm/leaflet.fullscreen@2.4.0/Control.FullScreen.min.js"></script>
    <script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>


    {{-- <script>
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });
    
        var map = L.map('map', {
            center: [0.33129702610172435, 101.02436296565637],
            zoom: 10,
            layers: [osm],
            fullscreenControl: {
                pseudoFullscreen: false
            }
        });
    
        const dataPolygons = @json($polygons);
    
        const dataPolygons = @json($polygons);

dataPolygons.forEach(item => {
    console.log("Item Data:", item);

    try {
        const coordinates = JSON.parse(item.coordinates);

        if (Array.isArray(coordinates)) {
            const polygon = L.polygon(coordinates).addTo(map);

            polygon.bindPopup(`
                <div class='my-2'><strong>Nama Spot : </strong> Nama     <br></div>
            `);
        } else {
            console.error("Invalid coordinates format:", coordinates);
        }
    } catch (error) {
        console.error("Error parsing coordinates:", error);
    }
});

    </script>
     --}}


    <script>
        var assetPhoto = '{{ asset('') }}';
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

        var map = L.map('map', {
            center: [0.33129702610172435, 101.02436296565637],
            zoom: 10,
            layers: [osm],
            fullscreenControl: {
                pseudoFullscreen: false
            }
        });

        const baseLayers = {
            'Openstreetmap': osm,
            'StadiaDark': Stadia_Dark,
            'Esri': Esri_WorldStreetMap
        };

        const dataPolygons = @json($polygons); // Konversi data PHP ke JSON

        //       dataPolygons.forEach(item => {
        //     console.log("Item Data:", item);

        //     try {
        //         const coordinates = JSON.parse(item.coordinates);

        //         if (Array.isArray(coordinates)) {
        //             const polygon = L.polygon(coordinates).addTo(map);

        //             polygon.bindPopup(`
    //                 <div class='my-2'><strong>Nama Anggota : </strong> Ahmad Dharma     <br></div>
    //                 <div class='my-2'><strong>Jenis Kelamin : </strong> Laki-laki     <br></div>
    //                 <div class='my-2'><strong>Almat Tinggal : </strong> RT.04/01 Bukit Payung Bangkinang     <br></div>
    //                 <div class='my-2'><strong>Pekerjaaan : </strong> Petani 	     <br></div>
    //                 <div class='my-2'><strong>Luas Lahan : </strong> 17,212 Ha     <br></div>
    //                 <div class='my-2'><strong>No Anggota : </strong> A 001     <br></div>
    //                 <div class='my-2'><strong>Kelompok : </strong> Maju Jaya     <br></div>
    //                 <div class='my-2'><strong>Blok : </strong> 1     <br></div>
    //                 <div class='my-2'>Image : </strong>  Photo    <br></div>
    //             `);
        //         } else {
        //             console.error("Invalid coordinates format:", coordinates);
        //         }
        //     } catch (error) {
        //         console.error("Error parsing coordinates:", error);
        //     }
        // });

        // Assuming you have the mergedData variable containing the information from both models

        dataPolygons.forEach(item => {
            try {
                const coordinates = JSON.parse(item.coordinates);

                if (Array.isArray(coordinates)) {
                    const polygon = L.polygon(coordinates).addTo(map);
                    console.log(item)

                    // Generate HTML content for the popup dynamically
                    const popupContent = `
                <div class='my-2'><strong>Nama Anggota : </strong> ${item.nama_anggota || 'N/A'}     <br></div>
                <div class='my-2'><strong>Jenis Kelamin : </strong> ${item.jenis_kelamin || 'N/A'}     <br></div>
                <div class='my-2'><strong>Alamat Tinggal : </strong> ${item.alamat_tinggal || 'N/A'}     <br></div>
                <div class='my-2'><strong>Pekerjaan : </strong> ${item.pekerjaan || 'N/A'}     <br></div>
                <div class='my-2'><strong>Luas Lahan : </strong> ${item.luas_lahan || 'N/A'} Ha     <br></div>
                <div class='my-2'><strong>No Anggota : </strong> ${item.no_anggota || 'N/A'}     <br></div>
                <div class='my-2'><strong>Kelompok : </strong> ${item.nama_kelompok || 'N/A'}     <br></div>
                <div class='my-2'><strong>Blok : </strong> ${item.blok || 'N/A'}     <br></div>
                <div class='my-2'><strong>IMG : </strong> <img src="${assetPhoto}${item.photo}" class="w-50 img-thumbnail">    <br></div>
                 `;

                    polygon.bindPopup(popupContent);
                } else {
                    console.error("Invalid coordinates format:", coordinates);
                }
            } catch (error) {
                console.error("Error parsing coordinates:", error);
            }
        });



        var controlSearch = new L.Control.Search({
            position: 'topleft',
            layer: L.layerGroup(dataPolygons.map(item => L.polygon(item.coordinates))),
            zoom: 15,
            markerLocation: true
        });

        map.addControl(controlSearch);

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        const layerControl = L.control.layers(baseLayers).addTo(map);
    </script>
@endsection
