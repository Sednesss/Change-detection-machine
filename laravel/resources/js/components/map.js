import Map from "ol/Map.js";
import View from "ol/View.js";
import {
  fromLonLat
} from "ol/proj.js";
import TileLayer from "ol/layer/Tile.js";
import XYZ from "ol/source/XYZ.js";

import GeoJSON from 'ol/format/GeoJSON';
import VectorLayer from 'ol/layer/Vector';
import VectorSource from 'ol/source/Vector';
import { Circle as CircleStyle, Fill, Stroke, Style } from 'ol/style';


// [34, 81],
// [61, 81],
// [34, 78],
// [61, 78],
// [34, 81],

// [40, 87],
// [67, 87],
// [40, 84],
// [67, 84],
// [40, 87]

const styles = [
  new Style({
    stroke: new Stroke({
      color: '#793F56',
      width: 3,
    }),
    fill: new Fill({
      color: '#793F56' + '50',
    }),
  })
];

const geojsonObject = {
  'type': 'FeatureCollection',
  'crs': {
    'type': 'name',
    'properties': {
      'name': 'EPSG:3857',
    },
  },
  'features': [
    {
      'type': 'Feature',
      'geometry': {
        'type': 'Polygon',
        'coordinates': [
          [
            [3400000, 8100000],
            [6100000, 8100000],
            [3400000, 7800000],
            [6000000, 7800000],
            [3400000, 8100000],
          ],
        ],
      },
    },
    {
      'type': 'Feature',
      'geometry': {
        'type': 'Polygon',
        'coordinates': [
          [
            [-2e6, 6e6],
            [-2e6, 8e6],
            [0, 8e6],
            [0, 6e6],
            [-2e6, 6e6],
          ],
        ],
      },
    },
  ],
};

const source = new VectorSource({
  features: new GeoJSON().readFeatures(geojsonObject),
});

const layer = new VectorLayer({
  source: source,
  style: styles,
});


// Инициализация карты
const map = new Map({
  target: "map",
  layers: [
    new TileLayer({
      source: new XYZ({
        url: "https://{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      }),
    }),
    layer
  ],
  view: new View({
    center: fromLonLat([global_value_project_map_center_x, global_value_project_map_center_y]),
    zoom: 8,
  }),
});
