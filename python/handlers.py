from fastapi import APIRouter, Body, Depends
from fastapi.responses import JSONResponse
import json
import numpy as np
import datetime

from validation import SatelliteImageryProcessing

from database import db_connection, MySQLConnection

from helpers.sql_query_helper import SqlQueryHelper
from helpers.single_statelite_image_processing import SingleStateliteImageProcessing
from helpers.parse_matrix import ParseMatrix

router = APIRouter()

@router.get('/')
def index():
    return {
        'status': 'OK'
    }

@router.post('/satellite_imagery/coordinate_calculation', name='image:coordinate')
async def index(
    satellite_image_id:int = Body(..., embed=True),
    db: MySQLConnection = Depends(db_connection)
    ):

    sql_query_helper = SqlQueryHelper(db)
    satellite_image_files = sql_query_helper.getFilePathFromStateliteImageID(satellite_image_id)

    if len(satellite_image_files) != 0:
        statelite_image_path = satellite_image_files[0][0]

        single_statelite_image_processing = SingleStateliteImageProcessing(statelite_image_path)
        coordinates = await single_statelite_image_processing.getCoordinate()

        sql_query_helper.addBoundaryPointsStateliteImage(satellite_image_id, coordinates)
        sql_query_helper.editStateliteImageCenter(satellite_image_id, coordinates)

        sql_query_helper.editStateliteImageStatus(satellite_image_id, 'coordinate_calculation')
        sql_query_helper.checkProjectField(satellite_image_id, coordinates)

        return JSONResponse(content={
            'messege': 'Succes',
            'status': True,
            'data': None
        })
    
    sql_query_helper.editStateliteImageStatus(satellite_image_id, 'error_coordinate_calculation')
    return JSONResponse(content={
        'messege': 'Bad',
        'status': False,
    },
    status_code=500)

@router.post('/satellite_imagery/processing', name='image:processing')
async def index(
    satellite_image_id:int = Body(..., embed=True),
    db: MySQLConnection = Depends(db_connection)
    ):

    cursor = db.cursor()
    cursor.execute("SELECT * FROM satellite_images")
    result = cursor.fetchall()

    return {
        'test': 'test',
        'qwerty': satellite_image_id,
        'db': result
    }
    
@router.post('/project/processing', name='project:processing')
async def index(
    project_id:int = Body(..., embed=True),
    date_start:str = Body(..., embed=True),
    date_end:str = Body(..., embed=True),
    db: MySQLConnection = Depends(db_connection)
    ):

    sql_query_helper = SqlQueryHelper(db)
    satellite_images_ids = sql_query_helper.getSatelliteImagesIDFromProjectID(project_id)

    for satellite_images_id in satellite_images_ids:
        channel_emission_paths = sql_query_helper.getChennelEmissionPathFromSatelliteImageID(satellite_images_id[0])
        if len(channel_emission_paths) == 2:
            
            green_path = channel_emission_paths[0][0]
            nir_path = channel_emission_paths[1][0]

            # Обработка green
            proccesing_helper_green = SingleStateliteImageProcessing(green_path)
            green_matrix, geotransform, width, height = await proccesing_helper_green.getRasterBand()

            # Обработка nir
            proccesing_helper_nir = SingleStateliteImageProcessing(nir_path)
            nir_matrix, geotransform, width, height = await proccesing_helper_nir.getRasterBand()
            
            layer_name = str(datetime.datetime.now())

            parce_helper = ParseMatrix()
            ndwi_matrix = parce_helper.getMatrixNDWI(green_matrix, nir_matrix)

            path_to_file, filename = parce_helper.createAndSaveShapeFileFromNDWIMatrix(ndwi_matrix, geotransform, width, height, layer_name)
            path_s3_to_file = await parce_helper.storeShapeFile(path_to_file, filename)

            sql_query_helper.saveUploadLinkToShapeFile(project_id, path_s3_to_file)
            sql_query_helper.editProjectStatus(project_id, 'finished processing')
        else:
            print('__________channel_emission_path count != 2_____________________')

    if True:
    
        return JSONResponse(content={
            'messege': 'Succes',
            'status': True,
        })
    
    return JSONResponse(content={
        'messege': 'Bad',
        'status': False,
    },
    status_code=500)


  
    