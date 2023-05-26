import os;
from osgeo import gdal;
import asyncio
import requests

from storage import storage_connection

class SingleStateliteImageProcessing:    
    def __init__(self, satellite_image_path): 
        self.satellite_image_path = satellite_image_path
        self.local_storage_path = '../storage/initial/'

        if not os.path.exists(self.local_storage_path):
            os.makedirs(self.local_storage_path)

    async def getCoordinate(self):
        s3 = storage_connection()
        filename = filename_with_extension = os.path.basename(self.satellite_image_path)

        download_url = s3.signed_download_url(self.satellite_image_path, max_age=60)
        response = requests.get(download_url)

        with open(self.local_storage_path + filename, "wb") as file:
            file.write(response.content)

        dataset = gdal.Open(self.local_storage_path + filename)

        geotransform = dataset.GetGeoTransform()

        xsize = dataset.RasterXSize
        ysize = dataset.RasterYSize

        ulx = round(geotransform[0] / 10000, 4) 
        uly = round(geotransform[3] / 100000, 5)

        urx = round((geotransform[0] + geotransform[1] * xsize) / 10000, 4)
        ury = uly

        llx = ulx
        lly = round((geotransform[3] + geotransform[5] * ysize) / 100000, 5)

        lrx = urx
        lry = lly

        center_x = (ulx + urx + llx + lrx)/4
        center_y = (uly + ury + lly + lry)/4

        return {
            'up_left_point' : {
                'x' : ulx,
                'y' : uly
            },
            'up_right_point': {
                'x' : urx,
                'y' : ury
            },
            'down_left_point': {
                'x' : llx,
                'y' : lly
            },
            'down_right_point': {
                'x' : lrx,
                'y' : lry
            },
            'center_point': {
                'x' : center_x,
                'y' : center_y
            }
        }

    def getWater(self):
        pass
