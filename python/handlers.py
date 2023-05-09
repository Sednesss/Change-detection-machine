from fastapi import APIRouter, Body, Depends

from validation import SatelliteImageryProcessing

from database import db_connection, MySQLConnection

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