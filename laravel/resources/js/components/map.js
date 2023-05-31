import Map from "ol/Map.js";
import View from "ol/View.js";
import {
	fromLonLat,
	transformExtent,
	get as getProjection
} from "ol/proj.js";
import TileLayer from "ol/layer/Tile.js";
import XYZ from "ol/source/XYZ.js";

import GeoJSON from 'ol/format/GeoJSON';
import VectorLayer from 'ol/layer/Vector';
import VectorSource from 'ol/source/Vector';
import { Circle as CircleStyle, Fill, Stroke, Style } from 'ol/style';

var coordinates = null;
var colors = null;

if (typeof global_value_images_coordinates === 'string' && global_value_images_coordinates.trim() !== '') {
	try {
	  coordinates = JSON.parse(global_value_images_coordinates.replace(/&quot;/g, '"'));
	  colors = JSON.parse(global_value_images_colors.replace(/&quot;/g, '"'));

	} catch (error) {
	  console.error('Ошибка при парсинге JSON-строки:', error);
	}
  }

console.log(coordinates);
console.log(colors);

// Определяем проекцию карты и проекцию данных
const string_projection = 'PROJCS["WGS 84 / UTM zone 47N",GEOGCS["WGS 84",DATUM["WGS_1984",SPHEROID["WGS 84",6378137,298.257223563,AUTHORITY["EPSG","7030"]],AUTHORITY["EPSG","6326"]],PRIMEM["Greenwich",0,AUTHORITY["EPSG","8901"]],UNIT["degree",0.0174532925199433,AUTHORITY["EPSG","9122"]],AUTHORITY["EPSG","4326"]],PROJECTION["Transverse_Mercator"],PARAMETER["latitude_of_origin",0],PARAMETER["central_meridian",99],PARAMETER["scale_factor",0.9996],PARAMETER["false_easting",500000],PARAMETER["false_northing",0],UNIT["metre",1,AUTHORITY["EPSG","9001"]],AXIS["Easting",EAST],AXIS["Northing",NORTH],AUTHORITY["EPSG","32647"]]'
const projectionMap = getProjection(string_projection);

const layers = AddPolygon(coordinates, colors);

layers.unshift(new TileLayer({
	source: new XYZ({
		url: "https://{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png",
	}),
}));

console.log(layers);

// Инициализация карты
const map = new Map({
	target: "map",
	layers: layers,
	view: new View({
		center: [Number(global_value_project_map_center_x), Number(global_value_project_map_center_y)],
		zoom: 8,
		projection: projectionMap,
	}),
});

function AddPolygon(coordinates, colors) {

	var polygons = [];

	for (const key in coordinates) {

		var element_coordinates = new Array();
		element_coordinates.push(new Array());

		for (const key2 in coordinates[key]) {
			element_coordinates[0].push([coordinates[key][key2].x, coordinates[key][key2].y])
		}

		var new_element = {
			'type': 'Feature',
			'geometry': {
				'type': 'Polygon',
				'coordinates': element_coordinates,
			},
		};

		var geo_json = {
			'type': 'FeatureCollection',
			'crs': {
				'type': 'name',
				'properties': {
					'name': 'EPSG:32647',
				},
			},
			'features': [new_element],
		};

		var styles = [
			new Style({
				stroke: new Stroke({
					color: colors[key],
					width: 3,
				}),
				fill: new Fill({
					color: colors[key] + '50',
				}),
			})
		];

		polygons.push([styles, geo_json]);
	}


	var layers = [];

	for (const key in polygons) {
		var features = new GeoJSON().readFeatures(polygons[key][1], {
			dataProjection: projectionMap,
			featureProjection: projectionMap,
		});

		var source = new VectorSource({
			features: features,
		});

		var layer = new VectorLayer({
			source: source,
			style: polygons[key][0],
		});

		layers.push(layer);
	}

	return layers
}