@extends("layouts.app")

@section("title", ($data["title"] ?? "") . " • Dashboard | " . config("app.name"))
@section("meta_description", "")

@push("css")
    <!-- open layers css -->
    <link href="https://cdn.jsdelivr.net/npm/ol@v10.2.1/ol.css" rel="stylesheet">
    <link href={{ asset("assets/css/styleBS.css") }} rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        #map {
            width: 100%;
            height: 550px;
        }
    </style>
@endpush

@section("content")

    <div class="d-flex justify-content-between align-items-center grid-margin flex-wrap">
        <div>
            <h4 class="mb-md-0 mb-3">Detil Lahan</h4>
        </div>
        <div class="d-flex align-items-center text-nowrap flex-wrap"></div>
    </div>

    <!-- Detail list -->
    <div class="card mb-3 p-3">
        <form id="lahanForm" action="{{ route("admin.lahan.update", $data["lahan"]->id) }}" method="POST">
            @csrf
            @method("PUT")

            <div class="d-flex justify-content-end align-items-center p-1 px-2">
                <button class="btn btn-primary" form="lahanForm" type="submit">Simpan</button>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" for="tgl_input">Tgl. Input</label>
                <input class="form-control" id="tgl_input" type="text" value="{{ $data["lahan"]->created_at->format("d F Y H:i:s") }}" readonly disabled>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="no_kebun">No. kebun</label>
                <input class="form-control" id="no_kebun" name="no_kebun" type="text" value="{{ $data["lahan"]->no_kebun }}" required>
                @error("no_kebun")
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="nama_pemilik">Nama Pemilik</label>
                <input class="form-control" id="nama_pemilik" name="nama_pemilik" type="text" value="{{ $data["lahan"]->nama_pemilik }}" required>
                @error("nama_pemilik")
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="luas">Luasan (Ha)</label>
                <input class="form-control" id="luas" name="luas" type="number" value="{{ $data["lahan"]->luas / 10000 }}" readonly disabled>
                @error("luas")
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="jumlah_produksi">Jumlah Produksi sekali panen (Kg)</label>
                <input class="form-control" id="jumlah_produksi" name="jumlah_produksi" type="number" value="{{ $data["lahan"]->jumlah_produksi }}" step="0.001" required>
                @error("jumlah_produksi")
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="jenis_jagung">Jenis Jagung</label>
                <select class="form-select" id="jenis_jagung" name="jenis_jagung" required>
                    <option value="pakan" @if ($data["lahan"]->jenis_jagung === "pakan") selected @endif>Pakan</option>
                    <option value="konsumsi" @if ($data["lahan"]->jenis_jagung === "konsumsi") selected @endif>Konsumsi</option>
                </select>
                @error("jenis_jagung")
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="varietas_jagung">Varietas Jagung</label>
                <input class="form-control" id="varietas_jagung" name="varietas_jagung" type="text" value="{{ $data["lahan"]->varietas_jagung }}" required>
                @error("varietas_jagung")
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="kontak">Kontak</label>
                <input class="form-control" id="kontak" name="kontak" type="text" value="{{ $data["lahan"]->kontak }}" required>
                @error("kontak")
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Pengirim</label>
                <input class="form-control" type="text" value="{{ $data["lahan"]->user->name }} | {{ $data["lahan"]->user->username }} | {{ $data["lahan"]->user->email }}" readonly disabled>
            </div>
        </form>
    </div>

    <!-- Map -->
    <div class="card mb-3 p-3">
        <div class="position-relative overflow-hidden" id="mapWrapper">
            <div class="map" id="map"></div>
            <div class="d-none d-lg-block" id="mousePosition"></div>
            <div class="" id="topLeft">
                <!-- layerControl Button -->
                <button class="position-relative" id="layerControlBtn">Layer <i data-feather="sidebar"></i><i data-feather="arrow-right"></i></button>
            </div>

            <!-- offcanvas layerControl -->
            <div class="align-self-end" id="layerControl">
                <div class="layerControl-header d-flex justify-content-between align-items-center mb-2">
                    <h5 class="layerControl-title px-2 py-1" id="layerControlTitle">Layer</h5>
                    <button class="btn btn-layerControl-close align-self-start m-1 p-1" type="button"><i data-feather="x"></i></button>
                </div>
                <div class="px-2 py-1" id="layerControlBody">
                    <div class="">
                        <div class="layer mb-3">
                            <div class="ml-3 mt-2 p-1">
                                <p class="mb-1">Data Lahan/Kebun</p>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" id="lahanKebuns" type="checkbox" value="si-jagung:lahan_kebuns" checked />
                                <label class="form-check-label" for="lahanKebuns"> Lahan Ajuan </label>
                            </div>
                        </div>

                        <div class="mb-3" id="basemap-select">
                            <div class="ml-3 mt-2 p-1">
                                <p class="mb-1">Base Map</p>
                            </div>

                            <select class="form-select" id="basemap" name="basemap">
                                <option value="osm">Street OSM</option>
                                <option value="bingaerial" selected>Bing Aerial</option>
                                <option value="mapbox">Street Mapbox</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    @if (auth()->user()->role === "admin" && !$data["lahan"]->reviewed->reviewed)
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" id="verifikasiBtn" type="button" role="button">Verifikasi</button>
        </div>
    @endif
@endsection


@push("javascript")
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
    </script>
@endpush

@push("javascript")
    <!-- open layers js -->
    <script src="https://cdn.jsdelivr.net/npm/ol@v10.2.1/dist/ol.js"></script>

    <!-- proj4js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.11.0/proj4.min.js" integrity="sha512-JfEOeAU2TD7AtE3xJPSBwBFCxURVqQCysNBwOnNhEJS9LgTHTWGSyYd11JUBOaJ+xVHPaA0ZhLin365CapD8EQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
@endpush

@push("javascript")
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".dropdown-toggle").click(function(e) {
            $(this).toggleClass("show");
            $(".dropdown-menu").toggleClass("show top-100");
        });
        $("#layerControlBtn").click(function(e) {
            $("#layerControl").toggleClass("show");
        });
        $(".btn-layerControl-close").click(function(e) {
            $("#layerControl").toggleClass("show");
        });
        $("#verifikasiBtn").click(function(e) {
            confirmAlert();
        });
    </script>
@endpush

@push("javascript")
    <script>
        function confirmAlert(dataId) {
            Swal.fire({
                title: "Apakah Anda yakin ingin menyetujui data ini?",
                text: 'Anda tidak akan bisa mengembalikannya!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#74788d',
                confirmButtonText: 'Ya, yakin!',
                cancelButtonColor: '#5664d2',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    const dataId = `{{ $data["lahan"]->id }}`;
                    const url = `{{ route("admin.lahan.verifikasi", ":dataId") }}`.replace(':dataId', dataId);
                    $('<form>', {
                        "method": "POST",
                        "action": url
                    }).append($('<input>', {
                        "name": "_token",
                        "value": `{{ csrf_token() }}`,
                        "type": "hidden"
                    })).appendTo('body').submit();
                }
            });
        }
    </script>
    <script>
        let Map = ol.Map;
        let View = ol.View;
        let OSM = ol.source.OSM;
        let TileSource = ol.source.Tile;
        let TileLayer = ol.layer.Tile;
        let {
            fromLonLat,
            toLonLat,
            Projection,
            useGeographic,
            getProjection,
            getTransform,
            addCoordinateTransforms,
            addProjection,
            transform,
        } = ol.proj;
        let VectorLayer = ol.layer.Vector;
        let VectorSource = ol.source.Vector;
        let LayerGroup = ol.layer.Group;
        let Overlay = ol.Overlay;
        let TileWMS = ol.source.TileWMS;
        let GeoJSON = ol.format.GeoJSON;
        let Feature = ol.Feature;
        let {
            Point,
            Circle,
            LineString,
            Polygon
        } = ol.geom;
        let {
            Circle: CircleStyle,
            Style,
            Fill,
            Stroke,
            Text,
            IconImage,
            Icon,
        } = ol.style;
        let {
            Attribution,
            OverviewMap,
            ScaleLine,
            MousePosition
        } = ol.control;
        let {
            register
        } = ol.proj.proj4;
        let {
            format,
            toStringHDMS,
            toStringXY
        } = ol.coordinate;
        let Draw = ol.interaction.Draw;
        let {
            getArea,
            getLength
        } = ol.sphere;
        let {
            unByKey
        } = ol.Observable;


        // Init View
        const view = new View({
            // projection: "EPSG:4326",
            center: ol.proj.fromLonLat([111.550394, -7.857051]),
            zoom: 16,
            minZoom: 9,
            maxZoom: 19,
        });

        // BaseMap
        const osmBaseMap = new TileLayer({
            source: new OSM(),
            crossOrigin: "anonymous",
            visible: false,
            preload: 10,
        });

        const sourceBingMaps = new ol.source.BingMaps({
            key: "AjQ2yJ1-i-j_WMmtyTrjaZz-3WdMb2Leh_mxe9-YBNKk_mz1cjRC7-8ILM7WUVEu",
            imagerySet: "AerialWithLabels",
            maxZoom: 20,
        });
        const bingAerialBaseMap = new ol.layer.Tile({
            preload: Infinity,
            source: sourceBingMaps,
            crossOrigin: "anonymous",
            visible: true,
            preload: 10,
        });

        const mapboxBaseURL =
            "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiNjg2MzUzMyIsImEiOiJjbDh4NDExZW0wMXZsM3ZwODR1eDB0ajY0In0.6jHWxwN6YfLftuCFHaa1zw";
        const mapboxStyleId = "mapbox/streets-v11";
        const mapboxSource = new ol.source.XYZ({
            url: mapboxBaseURL.replace("{id}", mapboxStyleId),
        });
        const mapboxBaseMap = new ol.layer.Tile({
            source: mapboxSource,
            crossOrigin: "anonymous",
            visible: false,
            preload: 10,
        });
        const baseMaps = [osmBaseMap, bingAerialBaseMap, mapboxBaseMap];

        // Minimap
        const overviewMapControl = new OverviewMap({
            layers: [
                new TileLayer({
                    source: new OSM(),
                }),
            ],
            target: document.getElementById("minimap"),
            className: "ol-overviewmap ol-custom-overviewmap",
            collapsed: false,
            tipLabel: "Minimap",
            collapseLabel: "\u00BB",
            label: "\u00AB",
        });

        // Attribution
        const attribution = new Attribution({
            target: document.getElementById("attribution"),
            collapsible: true,
            className: "ol-attribution",
        });

        // ScaleLine
        const scaleControl = new ScaleLine({
            target: document.getElementById("scaleline"),
            units: "metric",
            bar: true,
            steps: 4,
            text: true,
            minWidth: 140,
            maxWidth: 180,
            className: "ol-scale-line",
        });

        // zoom
        const zoomControl = new ol.control.Zoom({
            target: document.getElementById("zoomToggle"),
            className: "ol-custom-zoom",
            zoomInClassName: "btn ol-custom-zoom-in",
            zoomOutClassName: "btn ol-custom-zoom-out",
            zoomInLabel: "",
            zoomOutLabel: "",
        });

        // Mouse Position
        const mousePositionControl = new MousePosition({
            target: document.getElementById("mousePosition"),
            coordinateFormat: function(coordinate) {
                const {
                    formattedLon,
                    formattedLat
                } = coordinateFormatIndo(
                    coordinate,
                    "dd"
                );

                return (
                    "Long: " + formattedLon + " &nbsp&nbsp&nbsp  Lat: " + formattedLat
                );
            },
            projection: "EPSG:4326",
            placeholder: "Long: - &nbsp&nbsp&nbsp  Lat: -",
            className: "ol-custom-mouse-position",
        });

        /**
         * Formats the given coordinate into a specific format for Indo coordinates.
         *
         * @param {Array<number>} coordinate - The coordinate to be formatted. It should be an array with two elements: [longitude, latitude].
         * @param {string} [format="dd"] - The format to use for the coordinate. It can be "dd" for decimal degrees, or "dms" for degrees, minutes, and seconds.
         * @return {Object} An object containing the formatted longitude and latitude.
         * @example
         * dd=> {"formattedLon": "112.74719° BT", "formattedLat": "7.26786° LS"}
         * or
         * dms=> {"formattedLon": "112° 47' 17.00\" BT", "formattedLat": "7° 24' 46.00\" LS"}
         */
        function coordinateFormatIndo(coordinate, format = "dd") {
            const lon = coordinate[0];
            const lat = coordinate[1];

            const lonDirection = lon < 0 ? "BB" : "BT";
            const latDirection = lat < 0 ? "LS" : "LU"; // LS: Lintang Selatan, LU: Lintang Utara

            if (format === "dms") {
                const convertToDMS = (coord, direction) => {
                    const absoluteCoord = Math.abs(coord);
                    const degrees = Math.floor(absoluteCoord);
                    const minutes = Math.floor((absoluteCoord - degrees) * 60);
                    const seconds = (
                        (absoluteCoord - degrees - minutes / 60) *
                        3600
                    ).toFixed(2);
                    return `${degrees}° ${minutes}' ${seconds}" ${direction}`;
                };
                const formattedLon = convertToDMS(lon, lonDirection);
                const formattedLat = convertToDMS(lat, latDirection);
                return {
                    formattedLon,
                    formattedLat
                };
            } else {
                const formattedLon = `${Math.abs(lon).toFixed(5)}° ${lonDirection}`;
                const formattedLat = `${Math.abs(lat).toFixed(5)}° ${latDirection}`;
                return {
                    formattedLon,
                    formattedLat
                };
            }
        }

        //** STYLE ***/
        // marker style
        const markerClickedStyle = new Style({
            image: new Icon({
                anchor: [0.5, 0.99],
                anchorXUnits: "fraction",
                anchorYUnits: "fraction",
                with: 50,
                height: 50,
                opacity: 0.9,
                src: "./assets/img/map/marker-click.svg",
            }),
        });
        // hightlight style
        const hightlightClickedStyle = new ol.style.Style({
            fill: new ol.style.Fill({
                color: "orange",
            }),
            stroke: new ol.style.Stroke({
                color: "yellow",
                width: 2,
            }),
        });

        // Init To Canvas/View
        let map = new Map({
            target: "map",

            layers: [
                new LayerGroup({
                    layers: baseMaps,
                }),
            ],

            view: view,

            controls: [
                zoomControl,
                scaleControl,
                overviewMapControl,
                attribution,
                mousePositionControl,
            ],
        });

        function setOsmBasemap() {
            osmBaseMap.setVisible(true);
            bingAerialBaseMap.setVisible(false);
            mapboxBaseMap.setVisible(false);
        }

        function setBingmapBasemap() {
            osmBaseMap.setVisible(false);
            bingAerialBaseMap.setVisible(true);
            mapboxBaseMap.setVisible(false);
        }

        function setMapboxBasemap() {
            osmBaseMap.setVisible(false);
            bingAerialBaseMap.setVisible(false);
            mapboxBaseMap.setVisible(true);
        }

        $("#basemap").change(function(e) {
            e.preventDefault();
            switch ($("#basemap").val()) {
                case "osm":
                    setOsmBasemap();
                    break;
                case "bingaerial":
                    setBingmapBasemap();
                    break;
                case "mapbox":
                    setMapboxBasemap();
                    break;
                default:
                    setOsmBasemap();
                    break;
            }
        });

        const lahanKebunLayer = new TileLayer({
            source: new TileWMS({
                title: "Lahan Kebun Jagung",
                url: "http://localhost:8080/geoserver/wms",
                params: {
                    LAYERS: "si-jagung:lahan_kebuns",
                    TILED: true,
                    FORMAT: "image/png",
                    TRANSPARENT: true,
                    featureID: "lahan_kebuns.{{ $data["lahan"]->id }}",
                    // CQL_FILTER: "featureid='lahan_kebuns.9d72ba0c-9e64-4bb9-bf08-002fc723a719'" // filter hanya data dengan attribute property table
                    // CQL_FILTER: "id='{{ $data["lahan"]->id }}'" // filter hanya data dengan attribute property table

                },
                serverType: 'geoserver',
                crossOrigin: "anonymous",
            }),
            visible: true,
            opacity: 0.8,
            zIndex: 20
        });
        map.addLayer(lahanKebunLayer);

        const url = 'http://localhost:8080/geoserver/wfs?' +
            'service=WFS&' +
            'version=1.1.0&' +
            'request=GetFeature&' +
            'typename=si-jagung:lahan_kebuns&' +
            'outputFormat=application/json&' +
            'featureID=lahan_kebuns.' + '{{ $data["lahan"]->id }}' + '&' +
            'srsName=EPSG:3857'; // Sesuaikan dengan proyeksi peta Anda
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.features.length > 0) {
                    // Hanya menggunakan data untuk mendapatkan extent
                    const format = new ol.format.GeoJSON({
                        dataProjection: 'EPSG:3857',
                        featureProjection: map.getView().getProjection()
                    });
                    // Baca geometry tanpa menambahkan ke peta
                    const feature = format.readFeature(data.features[0]);
                    const extent = feature.getGeometry().getExtent();
                    // Fokuskan peta ke extent yang didapat
                    map.getView().fit(extent, {
                        padding: [150, 150, 150, 150],
                        duration: 1000,
                        maxZoom: 18
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching feature:', error);
            });

        const checkboxesLayer = document.querySelectorAll(".layer .form-check-input");
        const toggleLayerVisibility = (layerName, checked) => {
            if (layerName === "si-jagung:lahan_kebuns") {
                lahanKebunLayer.setVisible(checked);
            }
        };
        checkboxesLayer.forEach((checkbox) => {
            checkbox.addEventListener("change", (event) => {
                toggleLayerVisibility(event.target.value, event.target.checked);
            });
        });
    </script>
@endpush
