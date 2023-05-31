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
        coordinates, matrix_data = await single_statelite_image_processing.getCoordinate()

        sql_query_helper.addBoundaryPointsStateliteImage(satellite_image_id, coordinates)
        sql_query_helper.editStateliteImageCenter(satellite_image_id, coordinates)

        sql_query_helper.editStateliteImageStatus(satellite_image_id, 'coordinate_calculation')
        sql_query_helper.checkProjectField(satellite_image_id, coordinates)

        sql_query_helper.addMatrixDataToStateliteImage(satellite_image_id, matrix_data)

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
    cursor.execute("SELECT * FROM migrations")
    result = cursor.fetchall()

    return {
        'test': 'test',
        'qwerty': satellite_image_id,
        'db': satellite_image_id
    }
    
@router.post('/project/processing', name='project:processing')
async def index(
    project_id:int = Body(..., embed=True),
    date_start:str = Body(..., embed=True),
    date_end:str = Body(..., embed=True),
    db: MySQLConnection = Depends(db_connection)
    ):

    sql_query_helper = SqlQueryHelper(db)
    project_data = sql_query_helper.getProjectFromID(project_id)

    if True:
    
        return JSONResponse(content={
            'messege': 'Succes',
            'status': True,
            'data': project_data
        })
    
    return JSONResponse(content={
        'messege': 'Bad',
        'status': False,
    },
    status_code=500)


  
    