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

let WGS84 = new Projection("EPSG:4326");
let MERCATOR = new Projection("EPSG:3857");
let UTM49S = new Projection("EPSG:32649");

const loader = `<div class="text-center"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></>`;

// Init View
const view = new View({
  // projection: "EPSG:4326",
  center: ol.proj.fromLonLat([112.7464, -7.2652]),
  zoom: 15,
  // minZoom: 5,
  // maxZoom: 19,
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
  className: "ol-scale-line",
});

// Mouse Position
const mousePositionControl = new MousePosition({
  coordinateFormat: function (coordinate) {
    const coord = toStringHDMS(coordinate);
    const template = "Long: {x}° &nbsp&nbsp&nbsp  Lat: {y}°";
    const outCoord = format(coordinate, template, 5);
    return outCoord;
  },
  projection: "EPSG:4326",
  className: "ol-mouse-position",
  // target: document.getElementById("mouse-position"),
});

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

  controls: [new ol.control.Zoom(), scaleControl, overviewMapControl, attribution, mousePositionControl],
});

// Layer Click Event
const vectorSourceEventClick = new VectorSource();
const vectorLayerEventClick = new VectorLayer({
  source: vectorSourceEventClick,
  style: markerClickedStyle,
  zIndex: 100,
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
const highlightVectorSource = new ol.source.Vector();
const highlightVectorLayer = new ol.layer.Vector({
  source: highlightVectorSource,
  opacity: 0.8,
  zIndex: 99,
  style: hightlightClickedStyle,
});
map.addLayer(highlightVectorLayer);

function highlightClicked(geojson) {
  highlightVectorSource.clear();
  geojson.forEach((feature) => {
    highlightVectorSource.addFeatures(new GeoJSON().readFeatures(feature));
  });
}

// Add a click handler to hide the popup when the closer is clicked
$("#overlayPopupClose").click(function (e) {
  $("#overlayPopup").addClass("d-none");
});

// wms source layer
const surabayaWMS = new LayerGroup({
  title: "Surabaya",
});
map.addLayer(surabayaWMS);

const surabayaWMSLayer = [
  { name: "JALAN_LN_25K", title: "JALAN", visible: true, zIndex: 10 },
  { name: "AGRIKEBUN_AR_25K", title: "AGRIKEBUN", visible: true, zIndex: 1 },
  { name: "AGRILADANG_AR_25K", title: "AGRILADANG", visible: true, zIndex: 1 },
  { name: "AGRISAWAH_AR_25K", title: "AGRISAWAH", visible: true, zIndex: 1 },
  { name: "RAWA_AR_25K", title: "RAWA", visible: true, zIndex: 1 },
];
console.log(surabayaWMSLayer);

/**
 * Creates a new TileLayer with a TileWMS source.
 *
 * @param {string} title - The title of the layer.
 * @param {string} layerName - The name of the layer in the WMS(Geoserver).
 * @param {boolean} visible - Whether the layer is visible.
 * @param {number} zIndex - The z-index of the layer.
 * @return {TileLayer} The created TileLayer.
 */
const createWMSLayer = (title, layerName, visible, zIndex) =>
  new TileLayer({
    title,
    source: new TileWMS({
      url: "http://localhost:8080/geoserver/surabaya/wms",
      params: {
        LAYERS: `surabaya:${layerName}`,
        TILED: true,
        FORMAT: "image/png",
      },
      serverType: "geoserver",
    }),
    opacity: 0.8,
    visible: visible,
    zIndex: zIndex,
  });

surabayaWMSLayer.map(({ name, title, visible, zIndex }) => {
  const layer = createWMSLayer(title, name, visible, zIndex);
  surabayaWMS.getLayers().push(layer);
});

const prosesFetchWMSLayerData = async (evt, viewResolution, projection, surabayaWMS, no_layers, surabayaWMSLayer) => {
  let url = [];
  let wmsSource = [];
  let layer_title = [];

  let dataArray = [];
  let feturesArray = [];

  let i;
  for (i = 0; i < no_layers; i++) {
    let visibility = surabayaWMS.getLayers().item(i).getVisible();
    if (visibility == true) {
      layer_title[i] = surabayaWMS.getLayers().item(i).get("title");
      // alert(`${i}= ${layer_title[i]}`);
      // alert(`${surabayaWMSLayer[i].name}`);
      wmsSource[i] = new ol.source.ImageWMS({
        url: "http://localhost:8080/geoserver/wms",
        params: {
          LAYERS: surabayaWMSLayer[i].name,
        },
        serverType: "geoserver",
        // crossOrigin: "anonymous",
      });
      url[i] = wmsSource[i].getFeatureInfoUrl(evt.coordinate, viewResolution, projection, {
        INFO_FORMAT: "application/json",
      });

      if (url[i]) {
        try {
          let response = await fetch(url[i]);
          let data = await response.json();
          const dataProperties = data.features;
          if (dataProperties.length > 0) {
            dataArray.push(data);
          }
        } catch (error) {
          console.error("Error fetching data:", error);
        }
      }
    }
  }
  // console.log({ dataArray });
  dataArray.forEach((data) => {
    feturesArray.push(data.features);
  });
  // console.log({ feturesArray });

  return { dataArray, feturesArray };
};

map.on("singleclick", eventClickMap);

function eventClickMap(evt) {
  console.log("Klik map");
  $("#overlayPopupContent").html(loader);
  let viewResolution = /** @type {number} */ (view.getResolution());
  let projection = view.getProjection();

  // Get Coordinate
  var coordinate = evt.coordinate;
  const hdmsCoordinate = toStringHDMS(transform(coordinate, MERCATOR, WGS84));
  $("#overlayPopupCoordinate").html(hdmsCoordinate);

  markToClickedPosition(coordinate);

  // Dapatkan fitur yang diklik
  let no_layers = surabayaWMS.getLayers().get("length");

  $("#overlayPopup").removeClass("d-none");

  (async () => {
    const result = await prosesFetchWMSLayerData(evt, viewResolution, projection, surabayaWMS, no_layers, surabayaWMSLayer);
    console.log({ result });
    const { dataArray, feturesArray } = result;
    let idPropertiesData = [];
    let mergedPropertiesFeatures = [];
    let mergedDataGeojson = [];
    feturesArray.forEach((data) => {
      data.forEach((feature) => {
        const properties = feature.properties;
        idPropertiesData.push(feature.id);
        mergedPropertiesFeatures.push(properties);
      });
    });
    dataArray.forEach((data) => {
      mergedDataGeojson.push(data);
    });
    // console.log(mergedPropertiesFeatures);
    console.log(mergedDataGeojson);

    highlightClicked(mergedDataGeojson);

    if (dataArray.length > 0) {
      $("#overlayPopupTitle h5").html(`Informasi Data Layer`);
      $("#overlayPopupContent").html(`<pre>${JSON.stringify(mergedPropertiesFeatures, null, 2)}</pre>`);
    } else {
      $("#overlayPopupTitle h5").html(`Koordinat`);
      $("#overlayPopupContent").html(``);
    }
  })();
}

$("#tes-1").click(function (e) {
  if (this.checked) {
    surabayaWMS.getLayers().item(0).setVisible(true);
  } else {
    surabayaWMS.getLayers().item(0).setVisible(false);
  }
});
$("#tes-2").click(function (e) {
  if (this.checked) {
    surabayaWMS.getLayers().item(1).setVisible(true);
  } else {
    surabayaWMS.getLayers().item(1).setVisible(false);
  }
});
$("#tes-3").click(function (e) {
  if (this.checked) {
    surabayaWMS.getLayers().item(2).setVisible(true);
  } else {
    surabayaWMS.getLayers().item(2).setVisible(false);
  }
});
$("#tes-4").click(function (e) {
  if (this.checked) {
    surabayaWMS.getLayers().item(3).setVisible(true);
  } else {
    surabayaWMS.getLayers().item(3).setVisible(false);
  }
});
$("#tes-5").click(function (e) {
  if (this.checked) {
    surabayaWMS.getLayers().item(4).setVisible(true);
  } else {
    surabayaWMS.getLayers().item(4).setVisible(false);
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
