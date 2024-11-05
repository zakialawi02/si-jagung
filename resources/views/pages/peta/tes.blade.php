<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <!-- Google Web Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect" />
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css" rel="stylesheet"
            integrity="sha512-T+KoG3fbDoSnlgEXFQqwcTC9AdkFIxhBlmoaFqYaIjq2ShhNwNao9AKaLUPMfwiBPL0ScxAtc+UYbHAgvd+sjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- open layers css -->
        <link href="https://cdn.jsdelivr.net/npm/ol@v10.2.1/ol.css" rel="stylesheet">

        <style>
            .map {
                width: 100%;
                height: 400px;
            }
        </style>
    </head>

    <body>
        <div class="map" id="map"></div>
        <div>NDVI: <span id="output"></span></div>


        <!-- open layers js -->
        <script src="https://cdn.jsdelivr.net/npm/ol@v10.2.1/dist/ol.js"></script>

        <!-- proj4js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.11.0/proj4.min.js" integrity="sha512-JfEOeAU2TD7AtE3xJPSBwBFCxURVqQCysNBwOnNhEJS9LgTHTWGSyYd11JUBOaJ+xVHPaA0ZhLin365CapD8EQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            console.log("RUN");

            let Map = ol.Map;
            let View = ol.View;
            let OSM = ol.source.OSM;
            let TileLayer = ol.layer.Tile;
            let TileSource = ol.source.Tile;
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
            let ImageTile = ol.source.ImageTile;
            let GeoJSON = ol.format.GeoJSON;
            let GeoTIFF = ol.source.GeoTIFF;
            let Feature = ol.Feature;
            let Point = ol.geom.Point;
            let Circle = ol.geom.Circle;
            let {
                Style,
                Fill,
                Stroke,
                Text,
                IconImage,
                Icon
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

            let WGS84 = new Projection("EPSG:4326");
            let MERCATOR = new Projection("EPSG:3857");
            let UTM49S = new Projection("EPSG:32649");

            const loader = `<div class="text-center"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></>`;


            const source = new ImageTile({
                sources: [{
                        // visible red, band 1 in the style expression above
                        url: 'https://sentinel-cogs.s3.us-west-2.amazonaws.com/sentinel-s2-l2a-cogs/36/Q/WD/2020/7/S2A_36QWD_20200701_0_L2A/B04.tif',
                        max: 10000,
                    },
                    {
                        // near infrared, band 2 in the style expression above
                        url: 'https://sentinel-cogs.s3.us-west-2.amazonaws.com/sentinel-s2-l2a-cogs/36/Q/WD/2020/7/S2A_36QWD_20200701_0_L2A/B08.tif',
                        max: 10000,
                    },
                ],
            });

            const layer = new TileLayer({
                style: {
                    color: [
                        'interpolate',
                        ['linear'],
                        // calculate NDVI, bands come from the sources below
                        ['/', ['-', ['band', 2],
                                ['band', 1]
                            ],
                            ['+', ['band', 2],
                                ['band', 1]
                            ]
                        ],
                        // color ramp for NDVI values, ranging from -1 to 1
                        -0.2,
                        [191, 191, 191],
                        -0.1,
                        [219, 219, 219],
                        0,
                        [255, 255, 224],
                        0.025,
                        [255, 250, 204],
                        0.05,
                        [237, 232, 181],
                        0.075,
                        [222, 217, 156],
                        0.1,
                        [204, 199, 130],
                        0.125,
                        [189, 184, 107],
                        0.15,
                        [176, 194, 97],
                        0.175,
                        [163, 204, 89],
                        0.2,
                        [145, 191, 82],
                        0.25,
                        [128, 179, 71],
                        0.3,
                        [112, 163, 64],
                        0.35,
                        [97, 150, 54],
                        0.4,
                        [79, 138, 46],
                        0.45,
                        [64, 125, 36],
                        0.5,
                        [48, 110, 28],
                        0.55,
                        [33, 97, 18],
                        0.6,
                        [15, 84, 10],
                        0.65,
                        [0, 69, 0],
                    ],
                },
                source: source,
            });

            const map = new Map({
                target: 'map',
                layers: [layer],
                view: source.getView(),
            });

            const output = document.getElementById('output');

            function displayPixelValue(event) {
                const data = layer.getData(event.pixel);
                if (!data) {
                    return;
                }
                const red = data[0];
                const nir = data[1];
                const ndvi = (nir - red) / (nir + red);
                output.textContent = ndvi.toFixed(2);
            }
            map.on(['pointermove', 'click'], displayPixelValue);
        </script>
    </body>

</html>
