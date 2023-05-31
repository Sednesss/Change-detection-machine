from osgeo import ogr

def create_shape_file():
    # Создаем новый файл шейп-файла
    driver = ogr.GetDriverByName('ESRI Shapefile')
    shapefile = driver.CreateDataSource('output.shp')

    # Создаем новый слой в файле
    layer = shapefile.CreateLayer('layer', geom_type=ogr.wkbPolygon)

    # Создаем поле для хранения идентификатора
    field_id = ogr.FieldDefn('id', ogr.OFTInteger)
    layer.CreateField(field_id)

    # Создаем поле для хранения значения
    field_value = ogr.FieldDefn('value', ogr.OFTReal)
    layer.CreateField(field_value)

    