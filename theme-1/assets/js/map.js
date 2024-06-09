console.log("RUN");

let Map = ol.Map;
let View = ol.View;
let OSM = ol.source.OSM;
let TileLayer = ol.layer.Tile;
let TileSource = ol.source.Tile;
let { fromLonLat, toLonLat, Projection, useGeographic, getProjection, getTransform, addCoordinateTransforms, addProjection, transform } = ol.proj;
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
let { bbox, tile } = ol.loadingstrategy;
let { createXYZ } = ol.tilegrid;

let WGS84 = new Projection("EPSG:4326");
let MERCATOR = new Projection("EPSG:3857");
let UTM49S = new Projection("EPSG:32649");

const loader = `<div class="text-center"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></>`;

// Init View
const view = new View({
  center: ol.proj.fromLonLat([112.7464, -7.2652]),
  zoom: 15,
  // minZoom: 5,
  // maxZoom: 19,
  // Projection: WGS84,
});

// BaseMap
const osmBaseMap = new TileLayer({
  source: new OSM(),
  crossOrigin: "anonymous",
  visible: true,
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
  visible: false,
});

const mapboxBaseURL = "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiNjg2MzUzMyIsImEiOiJjbDh4NDExZW0wMXZsM3ZwODR1eDB0ajY0In0.6jHWxwN6YfLftuCFHaa1zw";
const mapboxStyleId = "mapbox/streets-v11";
const mapboxSource = new ol.source.XYZ({
  url: mapboxBaseURL.replace("{id}", mapboxStyleId),
});
const mapboxBaseMap = new ol.layer.Tile({
  source: mapboxSource,
  crossOrigin: "anonymous",
  visible: false,
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
    const { formattedLon, formattedLat } = coordinateFormatIndo(coordinate, "dd");

    return "Long: " + formattedLon + " &nbsp&nbsp&nbsp  Lat: " + formattedLat;
  },
  placeholder: "Long: - &nbsp&nbsp&nbsp  Lat: -",
  projection: "EPSG:4326",
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
      const seconds = ((absoluteCoord - degrees - minutes / 60) * 3600).toFixed(2);
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
    src: "/theme-2/assets/img/map/marker-click.svg",
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

  controls: [zoomControl, scaleControl, overviewMapControl, attribution, mousePositionControl],
});

// Layer Click Event
const vectorSourceEventClick = new VectorSource();
const vectorLayerEventClick = new VectorLayer({
  source: vectorSourceEventClick,
  style: markerClickedStyle,
  zIndex: 1000,
});
map.addLayer(vectorLayerEventClick);

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
const vectorSourceHighlightSelected = new ol.source.Vector();
const vectorLayerHighlightSelected = new ol.layer.Vector({
  source: vectorSourceHighlightSelected,
  opacity: 0.8,
  zIndex: 99,
  style: hightlightClickedStyle,
});
map.addLayer(vectorLayerHighlightSelected);

function highlightClicked(event) {
  removeHighlightClicked();
  // Dapatkan fitur yang diklik
  map.forEachFeatureAtPixel(event.pixel, function (feature) {
    selectedFeature = feature;
    feature.setStyle(hightlightClickedStyle);
    return true; // Hentikan iterasi setelah menemukan satu fitur
  });
}

function removeHighlightClicked() {
  if (selectedFeature) {
    selectedFeature.setStyle(null);
    selectedFeature = null;
  }
  return true;
}

// Add a click handler to hide the popup when the closer is clicked
$("#informationPopupClose").click(function (e) {
  removeHighlightClicked(selectedFeature);
  if (vectorSourceEventClick) {
    vectorSourceEventClick.clear();
  }
  $("#informationPopup").addClass("d-none");
});

// Event klik map
let selectedFeature = null;
map.on("singleclick", function (evt) {
  console.log("Klik map");

  $("#informationPopupContent").html(loader);

  // Get Coordinate
  const coordinate = evt.coordinate;
  const projection = view.getProjection();
  const LonLatcoordinate = toLonLat(coordinate, projection);
  // const hdmsCoordinate = toStringHDMS(LonLatcoordinate);
  const { formattedLon, formattedLat } = coordinateFormatIndo(LonLatcoordinate, "dms");
  const hdmsCoordinate = `${formattedLon} &nbsp ${formattedLat}`;
  $("#informationPopupCoordinate").html(hdmsCoordinate);

  $("#informationPopup").removeClass("d-none");

  markToClickedPosition(coordinate);

  // Dapatkan fitur yang diklik
  const feature = map.forEachFeatureAtPixel(evt.pixel, function (feature) {
    return feature;
  });
  removeHighlightClicked();
  if (!feature) {
    $("#informationPopupContent").html(``);
    selectedFeature = null;
    return;
  }
  if (feature) {
    const coordinates = feature.getGeometry().getCoordinates();
    const properties = feature.getProperties();
    $("#informationPopupContent").html(`<pre>${JSON.stringify(properties, null, 2)}</pre>`);
    highlightClicked(evt, selectedFeature);
  }
});

// surabaya layer group
const surabayaLayers = new LayerGroup({
  title: "Surabaya",
});
map.addLayer(surabayaLayers);

// Geojson style
const jalanStyle = new Style({
  stroke: new Stroke({
    color: "red",
    width: 2,
  }),
});

const kebunStyle = new Style({
  fill: new Fill({
    color: "green",
  }),
  stroke: new Stroke({
    color: "green",
    width: 2,
  }),
});

const bangunanStyle = new Style({
  fill: new Fill({
    color: "#808080",
  }),
  stroke: new Stroke({
    color: "#808080",
    width: 2,
  }),
});

function perum(zona) {
  switch (zona) {
    case "Perumahan":
      return (fillColor = "rgba(255, 0, 0, 0.8)");
    case "Perdagangan dan Jasa":
      return (fillColor = "rgba(0, 255, 0, 0.8)");
    case "Perkantoran":
      return (fillColor = "rgba(0, 0, 255, 0.8)");
    default:
      return (fillColor = "rgba(0, 200, 200, 0.8)");
  }
}

// geojson layer
const geojsonSiola = new VectorSource({
  url: "./assets/data/Environment.geojson",
  format: new GeoJSON(),
});

const layerSiola = new VectorLayer({
  source: geojsonSiola,
  zIndex: 0,
  visible: true,
  style: function (feature) {
    const zona = feature.get("zona");
    let fillColor = perum(zona);
    return new Style({
      fill: new Fill({
        color: fillColor,
      }),
      stroke: new Stroke({
        color: "#ffcc33",
        width: 2,
      }),
      text: new Text({
        text: zona,
        font: "15px Calibri,sans-serif",
        fill: new Fill({
          color: "#000000",
        }),
      }),
    });
  },
});
surabayaLayers.getLayers().push(layerSiola);

const geojsonKebun = new VectorSource({
  url: "./assets/data/AGRIKEBUN_AR_25K.geojson",
  format: new GeoJSON(),
});

const layerKebun = new VectorLayer({
  source: geojsonKebun,
  zIndex: 0,
  visible: true,
  opacity: 0.8,
  style: kebunStyle,
});
surabayaLayers.getLayers().push(layerKebun);

const geojsonBangunan = new VectorSource({
  format: new GeoJSON(),
  url: "http://localhost:8080/geoserver/surabaya/wfs?service=WFS&version=1.0.0&request=GetFeature&typeName=surabaya%3ABANGUNAN_AR_25K&outputFormat=application%2Fjson",
  strategy: bbox,
});

const layerBangunan = new VectorLayer({
  source: geojsonBangunan,
  zIndex: 0,
  visible: true,
  opacity: 0.8,
  style: bangunanStyle,
});
surabayaLayers.getLayers().push(layerBangunan);

const geojsonJalan = new VectorSource({
  format: new GeoJSON(),
  url: "http://localhost:8080/geoserver/surabaya/wfs?service=WFS&version=1.0.0&request=GetFeature&typeName=surabaya%3AJALAN_LN_25K&outputFormat=application%2Fjson",
  strategy: bbox,
});

const layerJalan = new VectorLayer({
  source: geojsonJalan,
  zIndex: 10,
  visible: true,
  style: jalanStyle,
});
surabayaLayers.getLayers().push(layerJalan);

let geojsonVisible = true;
document.getElementById("tes-1").addEventListener("click", function () {
  if (geojsonVisible) {
    console.log(layerSiola);
    layerSiola
      .getSource()
      .getFeatures()
      .forEach(function (feature) {
        if (feature.get("zona") === "Perumahan") {
          feature.setStyle(
            new ol.style.Style({
              fill: new ol.style.Fill({
                color: "rgba(0, 0, 0, 0)",
              }),
              stroke: new ol.style.Stroke({
                color: "rgba(0, 0, 0, 0)",
              }),
              text: new ol.style.Text({
                text: "",
              }),
            })
          );
        }
      });
  } else {
    layerSiola
      .getSource()
      .getFeatures()
      .forEach(function (feature) {
        const zona = feature.get("zona");
        let fillColor = perum(zona);
        feature.setStyle(
          new Style({
            fill: new Fill({
              color: fillColor,
            }),
            stroke: new Stroke({
              color: "#ffcc33",
              width: 2,
            }),
            text: new Text({
              text: zona,
              font: "15px Calibri,sans-serif",
              fill: new Fill({
                color: "#000000",
              }),
            }),
          })
        );
      });
  }
  geojsonVisible = !geojsonVisible;
});

$("#tes-2").click(function (e) {
  layerSiola.setVisible(this.checked);
});

$("#tes-3").change(function () {
  layerKebun.setVisible(this.checked);
});

$("#tes-4").change(function () {
  layerBangunan.setVisible(this.checked);
});

$("#tes-5").change(function () {
  layerJalan.setVisible(this.checked);
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
