@extends("layouts.appFront")

@section("title", "Daftar List Lahan | " . config("app.name"))
@section("meta_description", "")
@section("meta_keywords", "")

@section("og_title", config("app.name"))
@section("og_description", "")

@push("css")
    <!-- open layers css -->
    <link href="https://cdn.jsdelivr.net/npm/ol@v10.2.1/ol.css" rel="stylesheet">

    <style>
        .map {
            width: 330px !important;
            height: 220px !important;
            /* display: none; */
            /* Sembunyikan elemen peta untuk menghindari interaksi */
        }

        .screenshot {
            margin-top: 10px;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@section("content")
    <!-- Navbar -->
    @include("components.front._navbar")

    <main class="mt-3 pt-5" style="min-height: 100vh">
        <section class="container p-3 px-4">
            <h2>List Lahan</h2>

            <div class="row">
                @forelse ($data['lahan'] as $lahan)
                    <div class="col-md-6 col-lg-4">
                        <div class="card mb-2 p-3">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center flex-row">
                                    <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                                    <div class="c-details ms-1">
                                        <h5 class="mb-0">{{ $lahan->nama_pemilik }}</h5>
                                    </div>
                                </div>
                                <div class="badge text-dark"><span class="text-muted">No. Kebun </span> <span>{{ $lahan->no_kebun }}</span> </div>
                            </div>
                            <div class="mt-5">
                                <h5 class="heading">Jagung: {{ $lahan->jenis_jagung }}</h5>
                                <h6 class="heading">Varietas Jagung: <br> {{ $lahan->varietas_jagung }}</h6>
                                <h6>luas lahan: <br> {{ number_format((float) $lahan->luas / 1000, 2, ",", ".") }} Ha</h6>
                                <h6>Jumlah Produksi per panen [Kg] : <br> {{ number_format((float) $lahan->jumlah_produksi, 2, ",", ".") }}</h6>
                                <h6>Kontak : {{ $lahan->kontak ?? "-" }}</h6>
                                <div class="mt-3">
                                    <div class="map" id="map-{{ $lahan->id }}"></div>
                                    <img class="screenshot" id="screenshot-{{ $lahan->id }}" alt="Map Screenshot">
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col align-items-center d-flex justify-content-center">
                        <p>Tidak ada data</p>
                    </div>
                @endforelse
            </div>

        </section>

        <!-- Footer -->
        @include("components.front._footer")
    </main>
@endsection


@push("javascript")
    <!-- open layers js -->
    <script src="https://cdn.jsdelivr.net/npm/ol@v10.2.1/dist/ol.js"></script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

        $(".navbar-toggler").click(function(e) {
            $("#navbarCollapse").toggleClass("collapse");
            $("#navbarCollapse").toggleClass("show");
        });
        $("#navbarCollapse .nav-item.nav-link").click(function(e) {
            $("#navbarCollapse").removeClass("collapse");
        });
        $(document).click(function(e) {
            if (!$(e.target).closest("#navbarCollapse").length) {
                $("#navbarCollapse").removeClass("show");
            }
        });
        $("#userDropdown").click(function(e) {
            $("#userDropdown-menu").toggleClass("show");
        });
    </script>

    <script>
        let Map = ol.Map;
        let View = ol.View;
        let OSM = ol.source.OSM;
        let TileLayer = ol.layer.Tile;
        let {
            fromLonLat,
            getProjection,
            transform,
        } = ol.proj;
        let VectorLayer = ol.layer.Vector;
        let VectorSource = ol.source.Vector;
        let GeoJSON = ol.format.GeoJSON;
        let {
            Style,
            Fill,
            Stroke,
        } = ol.style;

        // Fungsi untuk menampilkan gambar peta statis
        function captureMap(map, target) {
            return new Promise((resolve) => {
                setTimeout(() => {
                    const mapCanvas = document.createElement('canvas');
                    const size = map.getSize();
                    mapCanvas.width = size[0];
                    mapCanvas.height = size[1];
                    const mapContext = mapCanvas.getContext('2d');

                    Array.prototype.forEach.call(
                        document.querySelectorAll(`#map-${target} .ol-layer canvas`),
                        function(canvas) {
                            if (canvas.width > 0) {
                                mapContext.globalAlpha = canvas.parentNode.style.opacity === '' ? 1 : Number(canvas.parentNode.style.opacity);
                                const transform = canvas.style.transform;
                                const matrix = transform.match(/^matrix\(([^\(]*)\)$/)[1].split(',').map(Number);
                                CanvasRenderingContext2D.prototype.setTransform.apply(mapContext, matrix);
                                mapContext.drawImage(canvas, 0, 0);
                            }
                        }
                    );

                    const dataURL = mapCanvas.toDataURL('image/png');
                    document.getElementById(`screenshot-${target}`).src = dataURL;

                    $(`#map-${target}`).remove(); // Hapus elemen peta setelah capture selesai
                    resolve(); // Tandai bahwa capture selesai
                }, 10); // Beri jeda untuk memastikan semua elemen sudah selesai dirender
            });
        }

        // Fungsi untuk membuat peta
        async function createMap(geojsonObject, target) {
            let mapContainer = document.createElement('div');
            mapContainer.id = `map-${target}`;
            mapContainer.style.width = "300px";
            mapContainer.style.height = "300px";
            document.body.appendChild(mapContainer);

            const basemapLayer = new TileLayer({
                source: new OSM()
            });

            const map = new Map({
                target: `map-${target}`,
                layers: [basemapLayer],
                view: new View({
                    center: fromLonLat([111.550394, -7.857051]),
                    zoom: 16,
                    minZoom: 9,
                    maxZoom: 19,
                })
            });

            const geojsonFormat = new GeoJSON();
            const features = geojsonFormat.readFeatures(geojsonObject, {
                dataProjection: 'EPSG:4326',
                featureProjection: map.getView().getProjection()
            });

            const vectorSource = new VectorSource({
                features
            });
            const vectorLayer = new VectorLayer({
                source: vectorSource,
                style: new Style({
                    stroke: new Stroke({
                        color: 'rgba(0, 255, 0, 1)',
                        width: 2
                    }),
                    fill: new Fill({
                        color: 'rgba(0, 255, 0, 0.3)'
                    })
                })
            });

            map.addLayer(vectorLayer);
            map.getView().fit(vectorSource.getExtent(), {
                padding: [80, 80, 80, 80],
                duration: 0,
                maxZoom: 18
            });

            await new Promise((resolve) => map.once('rendercomplete', resolve));

            await captureMap(map, target);

            document.body.removeChild(mapContainer); // Hapus elemen peta setelah capture selesai
        }

        $.ajax({
            url: '/daftar-lahan',
            type: 'GET',
            dataType: 'json',
            success: async function(data) {
                const dataRaw = data.data;
                console.log(dataRaw);

                for (let i = 0; i < dataRaw.length; i++) {
                    const geojsonObject = JSON.parse(dataRaw[i].geom_geojson);
                    await createMap(geojsonObject, dataRaw[i].id); // Tunggu setiap peta selesai sebelum lanjut
                }
            }
        });
    </script>
@endpush
