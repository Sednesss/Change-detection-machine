import Map from "ol/Map.js";
import View from "ol/View.js";
import {
    fromLonLat
} from "ol/proj.js";
import TileLayer from "ol/layer/Tile.js";
import XYZ from "ol/source/XYZ.js";
import Polygon from "ol/geom/Polygon.js";
import VectorLayer from "ol/layer/Vector.js";

// Инициализация карты
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

// Создаем новый слой VectorLayer
const vectorLayer = new VectorLayer({
    source: new VectorSource(),
});

// Создаем два полигона
const polygon1 = new Polygon([
    [
        [10, 10],
        [100, 10],
        [100, 100],
        [10, 100],
        [10, 10],
    ],
]);
const polygon2 = new Polygon([
    [
        [50, 50],
        [150, 50],
        [150, 150],
        [50, 150],
        [50, 50],
    ],
]);

// Добавляем полигоны в источник слоя VectorLayer
vectorLayer.getSource().addFeatures([
    new Feature({
        geometry: polygon1,
    }),
    new Feature({
        geometry: polygon2,
    }),
]);

// Добавляем слой VectorLayer в массив слоев карты
map.addLayer(vectorLayer);