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
let GeoJSON = ol.format.GeoJSON;
let Feature = ol.Feature;
let Point = ol.geom.Point;
let Circle = ol.geom.Circle;
let { Style, Fill, Stroke, Text, IconImage, Icon } = ol.style;
let { Attribution, OverviewMap, ScaleLine, MousePosition } = ol.control;
let { register } = ol.proj.proj4;
let { format, toStringHDMS, toStringXY } = ol.coordinate;

let WGS84 = new Projection("EPSG:4326");
let MERCATOR = new Projection("EPSG:3857");
let UTM49S = new Projection("EPSG:32649");

const loader = `<div class="text-center"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></>`;

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
    coordinateFormat: function (coordinate) {
        const { formattedLon, formattedLat } = coordinateFormatIndo(
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
        return { formattedLon, formattedLat };
    } else {
        const formattedLon = `${Math.abs(lon).toFixed(5)}° ${lonDirection}`;
        const formattedLat = `${Math.abs(lat).toFixed(5)}° ${latDirection}`;
        return { formattedLon, formattedLat };
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

// Layer Click Event
const vectorSourceEventClick = new VectorSource();
const vectorLayerEventClick = new VectorLayer({
    source: vectorSourceEventClick,
    style: markerClickedStyle,
    zIndex: 100,
});
map.addLayer(vectorLayerEventClick);

/**
 * Marks a clicked position on the map.
 *
 * @param {ol.Coordinate} coordinate - The coordinate of the clicked position.
 * @return {void}
 */
function markToClickedPosition(coordinate) {
    const marker = new Feature({
        geometry: new Point(coordinate),
    });
    if (vectorSourceEventClick) {
        vectorSourceEventClick.clear();
    }
    vectorLayerEventClick.getSource().addFeatures([marker]);
}

// Layer highlight Event Click
const highlightVectorSource = new ol.source.Vector();
const highlightVectorLayer = new ol.layer.Vector({
    source: highlightVectorSource,
    opacity: 0.5,
    zIndex: 99,
    style: hightlightClickedStyle,
});
map.addLayer(highlightVectorLayer);

/**
 * Highlights the clicked features on the map by adding them to the highlight vector source.
 *
 * @param {Array} geojson - An array of GeoJSON features to highlight.
 * @return {void} This function does not return anything.
 */
function highlightClicked(geojson) {
    geojson.forEach((feature) => {
        highlightVectorSource.addFeatures(new GeoJSON().readFeatures(feature));
    });
}

function removeHighlightClicked() {
    if (vectorSourceEventClick) {
        vectorSourceEventClick.clear();
    }
    if (highlightVectorSource) {
        highlightVectorSource.clear();
    }
}

// Add a click handler to hide the popup when the closer is clicked
$("#informationPopupClose").click(function (e) {
    removeHighlightClicked();
    $("#informationPopup").addClass("d-none");
});

// wms source layer
const ndviLayers = new LayerGroup({
    title: "NDVI (Normalized Difference Vegetation Index)",
});
map.addLayer(ndviLayers);
const ndmiLayers = new LayerGroup({
    title: "NDMI (Normalized Difference Moisture Index)",
});
map.addLayer(ndmiLayers);
const methaneLayers = new LayerGroup({
    title: "Methane",
});
map.addLayer(methaneLayers);

const ndviWMSLayers = [
    {
        name: "2021-01-03-00_00_2021-01-03-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Januari 2021",
        date: "2021-01",
        visible: true,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-03-19-00_00_2021-03-19-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Maret 2021",
        date: "2021-03",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-04-23-00_00_2021-04-23-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI April 2021",
        date: "2021-04",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-05-18-00_00_2021-05-18-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Mei 2021",
        date: "2021-05",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-06-07-00_00_2021-06-07-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Juni 2021",
        date: "2021-06",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-07-27-00_00_2021-07-27-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Juli 2021",
        date: "2021-07",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-08-06-00_00_2021-08-06-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Agustus 2021",
        date: "2021-08",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-09-10-00_00_2021-09-10-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI September 2021",
        date: "2021-09",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-10-05-00_00_2021-10-05-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Oktober 2021",
        date: "2021-10",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-11-09-00_00_2021-11-09-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI November 2021",
        date: "2021-11",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-12-19-00_00_2021-12-19-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Desember 2021",
        date: "2021-12",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-01-03-00_00_2022-01-03-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Januari 2022",
        date: "2022-01",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-02-02-00_00_2022-02-02-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Februari 2022",
        date: "2022-02",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-03-04-00_00_2022-03-04-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Maret 2022",
        date: "2022-03",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-04-03-00_00_2022-04-03-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI April 2022",
        date: "2022-04",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-05-13-00_00_2022-05-13-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Mei 2022",
        date: "2022-05",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-06-02-00_00_2022-06-02-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Juni 2022",
        date: "2022-06",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-07-07-00_00_2022-07-07-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Juli 2022",
        date: "2022-07",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-08-01-00_00_2022-08-01-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Agustus 2022",
        date: "2022-08",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-10-30-00_00_2022-10-30-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Oktober 2022",
        date: "2022-10",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-11-04-00_00_2022-11-04-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI November 2022",
        date: "2022-11",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-12-09-00_00_2022-12-09-23_59_Sentinel-2_L1C_NDVI",
        title: "NDVI Desember 2022",
        date: "2022-12",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
];
console.log(ndviWMSLayers);
const ndmiWMSLayers = [
    {
        name: "2021-01-03-00_00_2021-01-03-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Januari 2021",
        date: "2021-01",
        visible: true,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-03-19-00_00_2021-03-19-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Maret 2021",
        date: "2021-03",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-04-23-00_00_2021-04-23-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index April 2021",
        date: "2021-04",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-05-18-00_00_2021-05-18-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Mei 2021",
        date: "2021-05",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-06-07-00_00_2021-06-07-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Juni 2021",
        date: "2021-06",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-07-27-00_00_2021-07-27-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Juli 2021",
        date: "2021-07",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-08-06-00_00_2021-08-06-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Agustus 2021",
        date: "2021-08",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-09-10-00_00_2021-09-10-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index September 2021",
        date: "2021-09",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-10-05-00_00_2021-10-05-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Oktober 2021",
        date: "2021-10",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-11-09-00_00_2021-11-09-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index November 2021",
        date: "2021-11",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2021-12-19-00_00_2021-12-19-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Desember 2021",
        date: "2021-12",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-01-03-00_00_2022-01-03-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Januari 2022",
        date: "2022-01",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-02-02-00_00_2022-02-02-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Februari 2022",
        date: "2022-02",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-03-04-00_00_2022-03-04-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Maret 2022",
        date: "2022-03",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-04-03-00_00_2022-04-03-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index April 2022",
        date: "2022-04",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-05-13-00_00_2022-05-13-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Mei 2022",
        date: "2022-05",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-06-02-00_00_2022-06-02-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Juni 2022",
        date: "2022-06",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-07-07-00_00_2022-07-07-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Juli 2022",
        date: "2022-07",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-08-01-00_00_2022-08-01-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Agustus 2022",
        date: "2022-08",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-10-30-00_00_2022-10-30-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Oktober 2022",
        date: "2022-10",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-11-04-00_00_2022-11-04-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index November 2022",
        date: "2022-11",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "2022-12-09-00_00_2022-12-09-23_59_Sentinel-2_L1C_Moisture_index",
        title: "Moisture Index Desember 2022",
        date: "2022-12",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
];
console.log(ndmiWMSLayers);
const methaneWMSLayers = [
    {
        name: "Metana Januari 2022",
        title: "Metana Januari 2022",
        date: "2022-01",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "Metana Februari 2022",
        title: "Metana Februari 2022",
        date: "2022-02",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "Metana Maret 2022",
        title: "Metana Maret 2022",
        date: "2022-03",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "Metana April 2022",
        title: "Metana April 2022",
        date: "2022-04",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "Metana Mei 2022",
        title: "Metana Mei 2022",
        date: "2022-05",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "Metana Juni 2022",
        title: "Metana Juni 2022",
        date: "2022-06",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "Metana Juli 2022",
        title: "Metana Juli 2022",
        date: "2022-07",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "Metana Agustus 2022",
        title: "Metana Agustus 2022",
        date: "2022-08",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "Metana September 2023",
        title: "Metana September 2023",
        date: "2023-09",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "Metana Oktober 2022",
        title: "Metana Oktober 2022",
        date: "2022-10",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "Metana November 2022",
        title: "Metana November 2022",
        date: "2022-11",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
    {
        name: "Metana Desember 2022",
        title: "Metana Desember 2022",
        date: "2022-12",
        visible: false,
        opacity: 0.8,
        zIndex: 1,
    },
];
console.log(methaneWMSLayers);

/**
 * Creates a new TileLayer with a TileWMS source.
 *
 * @param {string} title - The title of the layer.
 * @param {string} layerName - The name of the layer in the WMS(Geoserver).
 * @param {boolean} visible - Whether the layer is visible.
 * @param {number} zIndex - The z-index of the layer.
 * @return {TileLayer} The created TileLayer.
 */
const createWMSLayer = (title, layerName, visible, opacity, zIndex) =>
    new TileLayer({
        title,
        source: new TileWMS({
            url: "http://82.112.237.119:8080/geoserver/si-jagung/wms",
            attributions: "si-jagung wms layer",
            params: {
                LAYERS: `si-jagung:${layerName}`,
                TILED: true,
                FORMAT: "image/png",
                TRANSPARENT: true,
            },
            serverType: "geoserver",
            crossOrigin: "anonymous",
        }),
        preload: Infinity,
        opacity: opacity ?? 0.6,
        visible: visible ?? true,
        zIndex: zIndex ?? 1,
    });

ndviWMSLayers.map(({ title, name, visible, zIndex }) => {
    const layer = createWMSLayer(title, name, visible, zIndex);
    ndviLayers.getLayers().push(layer);
});
ndmiWMSLayers.map(({ title, name, visible, zIndex }) => {
    const layer = createWMSLayer(title, name, visible, zIndex);
    ndmiLayers.getLayers().push(layer);
});
methaneWMSLayers.map(({ title, name, visible, zIndex }) => {
    const layer = createWMSLayer(title, name, visible, zIndex);
    methaneLayers.getLayers().push(layer);
});

map.on("singleclick", eventClickMap);

function eventClickMap(evt) {
    console.log("Klik map");
    $("#informationPopupContent").html(loader);
    let viewResolution = /** @type {number} */ (view.getResolution());
    let projection = view.getProjection();

    // Get Coordinate
    const coordinate = evt.coordinate;
    const LonLatcoordinate = toLonLat(coordinate, projection);
    const { formattedLon, formattedLat } = coordinateFormatIndo(
        LonLatcoordinate,
        "dms"
    );
    const hdmsCoordinate = `${formattedLon} &nbsp ${formattedLat}`;
    $("#informationPopupCoordinate").html(hdmsCoordinate);

    removeHighlightClicked();
    markToClickedPosition(coordinate);

    // Combine layers from both ndviLayers and ndmiLayers
    const layersArray = [
        ...ndviLayers.getLayers().getArray(),
        ...ndmiLayers.getLayers().getArray(),
    ];
    const visibleLayers = layersArray.filter((layer) => layer.getVisible());

    $("#informationPopup").removeClass("d-none");

    (async () => {
        let WMS_ARRAY = [];
        let dataArray = [];

        // Collect visible layers' WMS parameters
        for (const layer of visibleLayers) {
            const params_layers = layer.getSource().getParams().LAYERS;
            WMS_ARRAY.push(params_layers);
        }

        if (WMS_ARRAY.length > 0) {
            const wmsSource = new ol.source.ImageWMS({
                url: "http://82.112.237.119:8080/geoserver/wms",
                params: {
                    LAYERS: WMS_ARRAY.join(","), // Join layers into a single string
                },
                serverType: "geoserver",
                crossOrigin: "anonymous",
            });

            const url = wmsSource.getFeatureInfoUrl(
                evt.coordinate,
                viewResolution,
                projection,
                {
                    INFO_FORMAT: "application/json",
                    FEATURE_COUNT: 1,
                }
            );

            if (url) {
                try {
                    let response = await fetch(url);
                    let data = await response.json();
                    if (data.features.length > 0) {
                        dataArray.push(data);
                    }
                } catch (error) {
                    console.error("Error fetching data:", error);
                }
            }
        }

        if (dataArray.length > 0) {
            let featuresArray = [];
            let mergedPropertiesFeatures = [];
            let crsGeo = dataArray[0].crs;

            // Merge features from all data
            dataArray.forEach((data) => {
                featuresArray.push(...data.features);
            });

            featuresArray.forEach((feature) => {
                feature.properties.mark = feature.id; // Assign mark property
                mergedPropertiesFeatures.push(feature.properties);
            });

            highlightClicked(dataArray); // Highlight clicked features

            // Display information properties layer
            $("#informationPopupContent").html(
                `<pre>Raw : <br> ${JSON.stringify(
                    mergedPropertiesFeatures,
                    null,
                    2
                )}</pre>`
            );
        } else {
            $("#informationPopupContent").html(`No features found.`);
        }
    })();
}

const checkboxesLayer = document.querySelectorAll(".layer .form-check-input");
const toggleLayerVisibility = (layerName, checked) => {
    const name = layerName.split(":")[1];
    const index = ndviWMSLayers.findIndex((layer) => layer.name === name);
    if (index >= 0) {
        ndviLayers.getLayers().item(index).setVisible(checked);
    }
    const index2 = ndmiWMSLayers.findIndex((layer) => layer.name === name);
    if (index2 >= 0) {
        ndmiLayers.getLayers().item(index2).setVisible(checked);
    }
    const index3 = methaneWMSLayers.findIndex((layer) => layer.name === name);
    if (index3 >= 0) {
        methaneLayers.getLayers().item(index3).setVisible(checked);
    }
};
checkboxesLayer.forEach((checkbox) => {
    checkbox.addEventListener("change", (event) => {
        toggleLayerVisibility(event.target.value, event.target.checked);
    });
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

$("#basemap").change(function (e) {
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
