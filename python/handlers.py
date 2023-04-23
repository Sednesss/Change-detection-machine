from fastapi import APIRouter
import time


router = APIRouter()

@router.get('/')
def index():
    time.sleep(5)
    return {
        'status': 'OK'
    }

@router.post('/test')
def index():
    time.sleep(5)
    return {
        'test': 'test'
    }