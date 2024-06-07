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
let { Attribution, OverviewMap, ScaleLine } = ol.control;
let { register } = ol.proj.proj4;
let { format, toStringHDMS, toStringXY } = ol.coordinate;

let WGS84 = new Projection("EPSG:4326");
let MERCATOR = new Projection("EPSG:3857");
let UTM49S = new Projection("EPSG:32649");

let vectorSource;
let vectorLayer;

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
  className: "ol-overviewmap ol-custom-overviewmap",
  collapsed: false,
  tipLabel: "Minimap",
  collapseLabel: "\u00BB",
  label: "\u00AB",
});

// Attribution
const attribution = new Attribution({
  collapsible: true,
  className: "ol-attribution",
});

// ScaleLine
const scaleControl = new ScaleLine({
  units: "metric",
  bar: true,
  steps: 4,
  text: true,
  minWidth: 140,
  maxWidth: 180,
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

  controls: [new ol.control.Zoom(), scaleControl, overviewMapControl, attribution],
});

// Init Overlay Popup
const popupContainer = document.getElementById("overlayPopup");
const popupContent = document.getElementById("overlayPopupContent");
const popupTitle = document.getElementById("overlayPopupTitle");
const popupCloser = document.getElementById("overlayPopupClose");
const overlay = new ol.Overlay({
  element: popupContainer,
  autoPan: true,
  autoPanAnimation: {
    duration: 250,
  },
});
map.addOverlay(overlay);

// Add a click handler to hide the popup when the closer is clicked
popupCloser.onclick = function () {
  overlay.setPosition(undefined);
  popupCloser.blur();
  return false;
};

// Event klik map
map.on("singleclick", function (event) {
  overlay.setPosition(undefined);
  popupContent.innerHTML = "";
  console.log("Klik map");
  // Get Coordinate
  const coordinate = event.coordinate;
  const hdmsCoordinate = toStringHDMS(transform(coordinate, MERCATOR, WGS84));

  // Dapatkan fitur yang diklik
  const feature = map.forEachFeatureAtPixel(event.pixel, function (feature) {
    return feature;
  });

  if (!feature) {
    popupContainer.querySelector("h5").innerHTML = "Koordinat";
    $("#coordinateOverlay").html(hdmsCoordinate);
    overlay.setPosition([]);
    return;
  }
  if (feature) {
    popupContainer.querySelector("h5").innerHTML = "Informasi Data Layer";
    const coordinates = feature.getGeometry().getCoordinates();
    const properties = feature.getProperties();
    popupContent.innerHTML = `<pre>${JSON.stringify(properties, null, 2)}</pre>`;
    overlay.setPosition(coordinates);
  }
});

//
vectorSource = new VectorSource();

// geojson example
const datageojson = new VectorSource({
  url: "./assets/data/Environment.geojson",
  format: new GeoJSON(),
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
const contohGeojson = new VectorLayer({
  source: datageojson,
  opacity: 0.8,
  visible: true,
  zIndex: 1,
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
map.addLayer(contohGeojson);
let geojsonVisible = true;
document.getElementById("tes-1").addEventListener("click", function () {
  if (geojsonVisible) {
    datageojson.getFeatures().forEach(function (feature) {
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
    datageojson.getFeatures().forEach(function (feature) {
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
  if (this.checked) {
    contohGeojson.setVisible(true);
  } else {
    contohGeojson.setVisible(false);
  }
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
