from pydantic import BaseModel


class SatelliteImageryProcessing(BaseModel):
    data: str
    test: int