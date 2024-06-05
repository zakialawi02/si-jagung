console.log("RUN");

let Map = ol.Map;
let View = ol.View;
let OSM = ol.source.OSM;
let TileLayer = ol.layer.Tile;
let TileSource = ol.source.Tile;
let { fromLonLat, toLonLat } = ol.proj;
let VectorLayer = ol.layer.Vector;
let VectorSource = ol.source.Vector;
let LayerGroup = ol.layer.Group;
let Overlay = ol.Overlay;
let TileWMS = ol.source.TileWMS;
let GeoJSON = ol.format.GeoJSON;
let Feature = ol.Feature;
let Point = ol.geom.Point;
let Circle = ol.geom.Circle;
let Style = ol.style.Style;
let Fill = ol.style.Fill;
let Stroke = ol.style.Stroke;
let Text = ol.style.Text;
let IconImage = ol.style.IconImage;
let Icon = ol.style.Icon;

// Init View
const view = new View({
  center: ol.proj.fromLonLat([112.7464, -7.2652]),
  zoom: 15,
  // minZoom: 5,
  // maxZoom: 19,
  Projection: "EPSG:4326",
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

// Init To Canvas/View
let map = new Map({
  target: "map",

  layers: [
    new LayerGroup({
      layers: baseMaps,
    }),
  ],

  view: view,

  controls: [new ol.control.Zoom(), new ol.control.ScaleLine()],
});

//
const vectorSource = new VectorSource();

const wms1 = new TileLayer({
  source: new TileWMS({
    url: "http://localhost:8080/geoserver/surabaya/wms",
    params: {
      LAYERS: "surabaya:JALAN_LN_25K",
      TILED: true,
      FORMAT: "image/png",
    },
    serverType: "geoserver",
    transition: 0,
    // crossOrigin: "anonymous",
  }),
  opacity: 0.8,
  visible: true,
  zIndex: 10,
});
map.addLayer(wms1);

const wms2 = new TileLayer({
  source: new TileWMS({
    url: "http://localhost:8080/geoserver/surabaya/wms",
    params: {
      LAYERS: "	surabaya:AGRIKEBUN_AR_25K",
      TILED: true,
      FORMAT: "image/png",
    },
    serverType: "geoserver",
    transition: 0,
    // crossOrigin: "anonymous",
  }),
  opacity: 0.8,
  visible: true,
  zIndex: 1,
});
map.addLayer(wms2);
const wms3 = new TileLayer({
  source: new TileWMS({
    url: "http://localhost:8080/geoserver/surabaya/wms",
    params: {
      LAYERS: "	surabaya:AGRILADANG_AR_25K",
      TILED: true,
      FORMAT: "image/png",
    },
    serverType: "geoserver",
    transition: 0,
    // crossOrigin: "anonymous",
  }),
  opacity: 0.8,
  visible: true,
  zIndex: 1,
});
map.addLayer(wms3);
const wms4 = new TileLayer({
  source: new TileWMS({
    url: "http://localhost:8080/geoserver/surabaya/wms",
    params: {
      LAYERS: "surabaya:AGRISAWAH_AR_25K",
      TILED: true,
      FORMAT: "image/png",
    },
    serverType: "geoserver",
    transition: 0,
    // crossOrigin: "anonymous",
  }),
  opacity: 0.8,
  visible: true,
  zIndex: 1,
});
map.addLayer(wms4);
const wms5 = new TileLayer({
  source: new TileWMS({
    url: "http://localhost:8080/geoserver/surabaya/wms",
    params: {
      LAYERS: "surabaya:RAWA_AR_25K",
      TILED: true,
      FORMAT: "image/png",
    },
    serverType: "geoserver",
    transition: 0,
    // crossOrigin: "anonymous",
  }),
  opacity: 0.8,
  visible: true,
  zIndex: 1,
});
map.addLayer(wms5);

$("#tes-1").click(function (e) {
  if (this.checked) {
    wms1.setVisible(true);
  } else {
    wms1.setVisible(false);
  }
});
$("#tes-2").click(function (e) {
  if (this.checked) {
    wms2.setVisible(true);
  } else {
    wms2.setVisible(false);
  }
});
$("#tes-3").click(function (e) {
  if (this.checked) {
    wms3.setVisible(true);
  } else {
    wms3.setVisible(false);
  }
});
$("#tes-4").click(function (e) {
  if (this.checked) {
    wms4.setVisible(true);
  } else {
    wms4.setVisible(false);
  }
});
$("#tes-5").click(function (e) {
  if (this.checked) {
    wms5.setVisible(true);
  } else {
    wms5.setVisible(false);
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
