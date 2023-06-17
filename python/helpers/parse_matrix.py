import os
from osgeo import gdal, ogr
import numpy as np
import hashlib
import datetime
import requests
import math

from storage import storage_connection


class ParseMatrix:
    def __init__(self):
        self.local_storage_path_processing = "../storage/processing/"
        self.filename = ''

        if not os.path.exists(self.local_storage_path_processing):
            os.makedirs(self.local_storage_path_processing)

    def getMatrixNDWI(self, green_matrix, nir_matrix):
        ndwi_matrix = (green_matrix - nir_matrix) / (green_matrix + nir_matrix)

        # print(green_matrix)
        # print(grenir_matrixen_matrix)
        # print('___________test____________')

        # print(ndwi_matrix.min())
        # print(ndwi_matrix.max())
        # print(ndwi_matrix.mean())
        # print(ndwi_matrix)
        # print(ndwi_matrix[0][0])
        # print('___________test____________')


        ndwi_matrix = np.where((ndwi_matrix >= 0.2) & (ndwi_matrix <= 1), 1, 0)
        return ndwi_matrix

    def createAndSaveShapeFileFromNDWIMatrix(self, shape_file_data):

        self.filename = hashlib.sha256(str(datetime.datetime.now()).encode()).hexdigest()
        path_to_file = self.local_storage_path_processing + self.filename + ".shp"

        driver = ogr.GetDriverByName("ESRI Shapefile")
        ds = driver.CreateDataSource(path_to_file)
        
        for element in shape_file_data:
            layer = ds.CreateLayer(str(element['layer_name']), geom_type=ogr.wkbPoint)
            layer.CreateField(ogr.FieldDefn('value', ogr.OFTReal))

            for y in range(element['height']):
                for x in range(element['width']):
                    value_matrix = element['ndwi_matrix'][y][x]

                    if value_matrix == 1:
                        xpos = element['geotransform'][0] + x * element['geotransform'][1] + y * element['geotransform'][2]
                        ypos = element['geotransform'][3] + x * element['geotransform'][4] + y * element['geotransform'][5]

                        point = ogr.Geometry(ogr.wkbPoint)
                        point.AddPoint(xpos, ypos)

                        feature = ogr.Feature(layer.GetLayerDefn())
                        feature.SetGeometry(point)
                        layer.CreateFeature(feature)
                        feature = None
        ds = None

        return path_to_file, self.filename

    async def storeShapeFile(self, path_to_file, filename):
        s3 = storage_connection()

        path_s3_to_file = 'satellite-images/processed/' + filename + '.shp'

        with open(path_to_file, 'rb') as shape_file:
            await s3.upload(path_s3_to_file, shape_file.read())

        return path_s3_to_file
    
