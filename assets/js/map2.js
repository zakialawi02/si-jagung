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
  center: ol.proj.fromLonLat([111.450394, -7.847051]),
  zoom: 17,
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

const mapboxBaseURL = "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiNjg2MzUzMyIsImEiOiJjbDh4NDExZW0wMXZsM3ZwODR1eDB0ajY0In0.6jHWxwN6YfLftuCFHaa1zw";
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
    const { formattedLon, formattedLat } = coordinateFormatIndo(coordinate, "dd");

    return "Long: " + formattedLon + " &nbsp&nbsp&nbsp  Lat: " + formattedLat;
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

  controls: [zoomControl, scaleControl, overviewMapControl, attribution, mousePositionControl],
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
  opacity: 0.8,
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
const sijagungWMS = new LayerGroup({
  title: "SIJAGUNG",
});
map.addLayer(sijagungWMS);

const sijagungWMSLayer = [
  { name: "LC08_L1TP_119065_20240717_20240717_02_RT_B2", title: "raster", visible: false, opacity: 0.9, zIndex: 1 },
  { name: "swh_pnrg_polygon", title: "sawah jagung", visible: true, opacity: 0.8, zIndex: 2 },
];
console.log(sijagungWMSLayer);

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
      url: "https://geoserver.zakiserver.my.id/geoserver/si-jagung/wms",
      attributions: "si-jagung wms layer",
      params: {
        LAYERS: `si-jagung:${layerName}`,
        TILED: true,
        FORMAT: "image/png",
      },
      serverType: "geoserver",
    }),
    preload: Infinity,
    // crossOrigin: "anonymous",
    opacity: opacity,
    visible: visible,
    zIndex: zIndex,
  });

sijagungWMSLayer.map(({ title, name, visible, zIndex }) => {
  const layer = createWMSLayer(title, name, visible, zIndex);
  sijagungWMS.getLayers().push(layer);
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
  // const hdmsCoordinate = toStringHDMS(LonLatcoordinate);
  const { formattedLon, formattedLat } = coordinateFormatIndo(LonLatcoordinate, "dms");
  const hdmsCoordinate = `${formattedLon} &nbsp ${formattedLat}`;
  $("#informationPopupCoordinate").html(hdmsCoordinate);

  removeHighlightClicked();
  markToClickedPosition(coordinate);

  // Dapatkan fitur yang diklik
  let no_layers = sijagungWMS.getLayers().get("length");

  $("#informationPopup").removeClass("d-none");

  (async () => {
    let WMS_ARRAY = [];

    let i;
    for (i = 0; i < no_layers; i++) {
      let visibility = sijagungWMS.getLayers().item(i).getVisible();
      if (visibility == true) {
        let params_layers = sijagungWMS.getLayers().item(i).getSource().getParams().LAYERS;
        WMS_ARRAY.push(params_layers);
      }
    }

    let dataArray = [];
    const wmsSource = new ol.source.ImageWMS({
      url: "https://geoserver.zakiserver.my.id/geoserver/wms",
      params: {
        LAYERS: WMS_ARRAY,
      },
      serverType: "geoserver",
      // crossOrigin: "anonymous",
    });
    url = wmsSource.getFeatureInfoUrl(evt.coordinate, viewResolution, projection, {
      INFO_FORMAT: "application/json",
      FEATURE_COUNT: 1,
    });
    // console.log(url);
    if (url) {
      try {
        let response = await fetch(url);
        let data = await response.json();
        const dataProperties = data.features;
        if (dataProperties.length > 0) {
          dataArray.push(data);
        }
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    }
    // console.log({ dataArray });

    if (dataArray.length > 0) {
      let featuresArray = [];
      let idPropertiesData = [];
      let mergedPropertiesFeatures = [];
      let crsGeo = dataArray[0].crs;
      let mergedDataGeojson = [];

      dataArray.forEach((data) => {
        featuresArray.push(data.features);
      });
      // console.log(featuresArray);
      featuresArray.forEach((features) => {
        features.forEach((feature) => {
          const geom = {
            crs: crsGeo,
            type: "FeatureCollection",
            features: [],
          };
          feature.properties.mark = feature.id;
          geom.features.push(feature);
          mergedDataGeojson.push(geom);
          mergedPropertiesFeatures.push(feature.properties);
          idPropertiesData.push(feature.id);
        });
      });

      // console.log({ mergedDataGeojson });
      // console.log({ mergedPropertiesFeatures });

      highlightClicked(mergedDataGeojson);

      $("#informationPopupContent").html(`<pre>Raw : <br> ${JSON.stringify(mergedPropertiesFeatures, null, 2)}</pre>`);
    } else {
      $("#informationPopupContent").html(``);
    }
  })();
}

const checkboxesLayer = document.querySelectorAll(".layer .form-check-input");
checkboxesLayer.forEach((checkbox) => {
  checkbox.addEventListener("change", (event) => {
    // console.log(event.target.checked);
    const layerName = event.target.value;
    if (layerName) {
      const name = layerName.split(":")[1];
      const index = sijagungWMSLayer.findIndex((layer) => layer.name === name);
      console.log({ index });
      if (event.target.checked) {
        sijagungWMS.getLayers().item(index).setVisible(true);
      } else {
        sijagungWMS.getLayers().item(index).setVisible(false);
      }
    }
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
