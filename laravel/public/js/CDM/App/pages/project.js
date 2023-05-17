import Map from "../../../ol/Map.js";
import View from "../../../ol/View.js";
import {
  fromLonLat
} from "../../../ol/proj.js";
import TileLayer from "../../../ol/layer/Tile.js";
import XYZ from "../../../ol/source/XYZ.js";

const map = new Map({
  target: "map",
  layers: [
    new TileLayer({
      source: new XYZ({
        url: "https://{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      }),
    }),
  ],
  view: new View({
    center: fromLonLat([global_value_project_map_center_x, global_value_project_map_center_y]),
    zoom: 8,
  }),
});