import asyncio
from s3 import S3Client

from config.storage_config import STORAGE_CONNECTION, YANDEX_CLOUD_KEY, YANDEX_CLOUD_SECRET, YANDEX_CLOUD_REGION, YANDEX_CLOUD_BUCKET

def storage_connection():
    match STORAGE_CONNECTION:
        case "yandexcloud":
            client = S3Client(
                access_key=YANDEX_CLOUD_KEY, 
                secret_key=YANDEX_CLOUD_SECRET, 
                region=YANDEX_CLOUD_REGION, 
                s3_bucket=YANDEX_CLOUD_BUCKET
            )
        case "local":
            pass
        case _:
            pass
    return client