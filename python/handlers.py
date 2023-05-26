from fastapi import APIRouter, Body, Depends
from fastapi.responses import JSONResponse

from validation import SatelliteImageryProcessing

from database import db_connection, MySQLConnection

from helpers.sql_query_helper import SqlQueryHelper
from helpers.single_statelite_image_processing import SingleStateliteImageProcessing

router = APIRouter()

@router.get('/')
def index():
    return {
        'status': 'OK'
    }

@router.post('/satellite_imagery_processing', name='image:processing')
async def index(
    request_body:SatelliteImageryProcessing = Body(..., embed=True),
    request_body_qqq:SatelliteImageryProcessing = Body(..., embed=True),
    db: MySQLConnection = Depends(db_connection)
    ):

    cursor = db.cursor()
    cursor.execute("SELECT * FROM migrations")
    result = cursor.fetchall()

    return {
        'test': 'test',
        'qwerty': request_body.data,
        'db': result
    }

@router.post('/coordinate_calculation', name='image:coordinate')
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

        return JSONResponse(content={
            'messege': 'Succes',
            'status': True,
            'data': None
        })
    
    return JSONResponse(content={
        'messege': 'Bad',
        'status': False,
    },
    status_code=500)


    

    