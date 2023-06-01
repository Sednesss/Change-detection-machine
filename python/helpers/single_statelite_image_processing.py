import os
from osgeo import gdal
from osgeo import osr
import asyncio
import requests
import math

from storage import storage_connection


class SingleStateliteImageProcessing:
    def __init__(self, satellite_image_path):
        self.satellite_image_path = satellite_image_path
        self.local_storage_path_initial = "../storage/initial/"

        if not os.path.exists(self.local_storage_path_initial):
            os.makedirs(self.local_storage_path_initial)

    # image calculate
    async def getCoordinate(self):
        s3 = storage_connection()
        filename = filename_with_extension = os.path.basename(self.satellite_image_path)

        download_url = s3.signed_download_url(self.satellite_image_path, max_age=60)
        response = requests.get(download_url)

        with open(self.local_storage_path_initial + filename, "wb") as file:
            file.write(response.content)

        dataset = gdal.Open(self.local_storage_path_initial + filename)

        coordinates = self.calculate_coordinate(dataset)

        return coordinates

    def calculate_coordinate(self, dataset):
        geotransform = dataset.GetGeoTransform()
        proj = dataset.GetProjection()

        width = dataset.RasterXSize
        height = dataset.RasterYSize

        up_left = (
            round(geotransform[0] + geotransform[1] * 0 + 0 * geotransform[2]),
            round(geotransform[3] + geotransform[4] * 0 + 0 * geotransform[5]),
        )
        up_right = (
            round(geotransform[0] + geotransform[1] * height + 0 * geotransform[2]),
            round(geotransform[3] + geotransform[4] * height + 0 * geotransform[5]),
        )
        low_left = (
            round(geotransform[0] + geotransform[1] * 0 + width * geotransform[2]),
            round(geotransform[3] + geotransform[4] * 0 + width * geotransform[5]),
        )
        low_right = (
            round(geotransform[0] + geotransform[1] * height + width * geotransform[2]),
            round(geotransform[3] + geotransform[4] * height + width * geotransform[5]),
        )
        center = (
            round(geotransform[0] + geotransform[1] * 0.5 + 0.5 * geotransform[2]),
            round(geotransform[3] + geotransform[4] * 0.5 + 0.5 * geotransform[5]),
        )

        return {
            "up_left_point": {"x": up_left[0], "y": up_left[1]},
            "up_right_point": {"x": up_right[0], "y": up_right[1]},
            "low_right_point": {"x": low_right[0], "y": low_right[1]},
            "low_left_point": {"x": low_left[0], "y": low_left[1]},
            "center_point": {"x": center[0], "y": center[1]},
        }
    
    # project processing
    async def getRasterBand(self):
        s3 = storage_connection()
        filename = filename_with_extension = os.path.basename(self.satellite_image_path)

        download_url = s3.signed_download_url(self.satellite_image_path, max_age=60)
        response = requests.get(download_url)

        with open(self.local_storage_path_initial + filename, "wb") as file:
            file.write(response.content)

        dataset = gdal.Open(self.local_storage_path_initial + filename)

        geotransform = dataset.GetGeoTransform()
        width = dataset.RasterXSize
        height = dataset.RasterYSize
        data = dataset.GetRasterBand(1).ReadAsArray()

        return data, geotransform, width, height
