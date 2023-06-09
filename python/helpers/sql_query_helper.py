import json

class SqlQueryHelper:    
    def __init__(self, connection):
        self.connection = connection
        self.cursor = connection.cursor() 

    def getFilePathFromStateliteImageID(self, satellite_image_id):
        self.cursor.execute(f"""SELECT channel_emissions.path
            FROM channel_emissions
            JOIN satellite_images
            ON channel_emissions.satellite_image_id = satellite_images.id
            WHERE satellite_images.id = {satellite_image_id};""")
        result = self.cursor.fetchall()
        return result

    def getFilenameFromStateliteImageID(self, satellite_image_id):
        self.cursor.execute(f"""SELECT filename
            FROM channel_emissions
            WHERE satellite_image_id = {satellite_image_id}
            LIMIT 1;""")
        result = self.cursor.fetchall()
        return result

    def addBoundaryPointsStateliteImage(self, satellite_image_id, coordinates):
        
        self.cursor.execute(f"""SELECT COUNT(*) FROM boundary_points WHERE satellite_image_id = {satellite_image_id};""")
        result = self.cursor.fetchall()
        
        if result[0][0] != 0:
            self.cursor.execute(f"""DELETE FROM boundary_points WHERE satellite_image_id = {satellite_image_id};""")
            self.connection.commit()

        self.cursor.execute(f"""INSERT INTO boundary_points (satellite_image_id, position, x, y, created_at, updated_at) VALUES 
        ({satellite_image_id}, 1, {coordinates['up_left_point']['x']}, {coordinates['up_left_point']['y']}, NOW(), NOW()),
        ({satellite_image_id}, 2, {coordinates['up_right_point']['x']}, {coordinates['up_right_point']['y']}, NOW(), NOW()),
        ({satellite_image_id}, 3, {coordinates['low_right_point']['x']}, {coordinates['low_right_point']['y']}, NOW(), NOW()),
        ({satellite_image_id}, 4, {coordinates['low_left_point']['x']}, {coordinates['low_left_point']['y']}, NOW(), NOW());""")
        self.connection.commit()

    def editStateliteImageCenter(self, satellite_image_id, coordinates):
        self.cursor.execute(f"""UPDATE satellite_images
        SET map_center_x = {coordinates['center_point']['x']}, map_center_y = {coordinates['center_point']['y']}
        WHERE id = {satellite_image_id};""")
        self.connection.commit()

    def editStateliteImageStatus(self, satellite_image_id, status):
        self.cursor.execute(f"""UPDATE satellite_images
        SET status = '{status}'
        WHERE id = {satellite_image_id};""")
        self.connection.commit()

    def checkProjectField(self, satellite_image_id, coordinates):
        self.cursor.execute(f"""SELECT COUNT(*)
        FROM satellite_images
        WHERE project_id = (SELECT project_id FROM satellite_images WHERE id = {satellite_image_id});
        """)
        result = self.cursor.fetchall()

        if result[0][0] == 1:
            self.cursor.execute(f"""UPDATE projects
            SET map_center_x = {coordinates['center_point']['x']}, map_center_y = {coordinates['center_point']['y']}
            WHERE id = {satellite_image_id};""")
            self.connection.commit()

            self.cursor.execute(f"""UPDATE projects
            SET status = 'created'
            WHERE id = (SELECT project_id FROM satellite_images WHERE id = {satellite_image_id});""")
            self.connection.commit()
        elif result[0][0] > 1:
            self.cursor.execute(f"""UPDATE projects
            SET status = 'ready for processing'
            WHERE id = (SELECT project_id FROM satellite_images WHERE id = {satellite_image_id});""")
            self.connection.commit()

    def editDateAndCoordSystemImage(self, satellite_image_id, date, coordinate_system):
        self.cursor.execute(f"""UPDATE satellite_images
        SET date = '{date}', coordinate_system = '{coordinate_system}'
        WHERE id = {satellite_image_id};""")
        self.connection.commit()

    def getSatelliteImagesIDFromProjectID(self, project_id):
        self.cursor.execute(f"""SELECT id
            FROM satellite_images
            WHERE project_id = {project_id}
            ORDER BY id ASC;""")
        result = self.cursor.fetchall()
        return result

    def getChennelEmissionPathFromSatelliteImageID(self, satellite_image_id):
        self.cursor.execute(f"""SELECT path
            FROM channel_emissions
            WHERE satellite_image_id = {satellite_image_id}
            ORDER BY id ASC;""")
        result = self.cursor.fetchall()
        return result

    def saveUploadLinkToShapeFile(self, project_id, path_to_file):
        self.cursor.execute(f"""INSERT INTO result_processings (project_id, link, created_at, updated_at) VALUES 
        ({project_id}, '{path_to_file}', NOW(), NOW());""")
        self.connection.commit()

    def editProjectStatus(self, project_id, status):
        self.cursor.execute(f"""UPDATE projects
        SET status = '{status}'
        WHERE id = {project_id};""")
        self.connection.commit()
        
    def getDateFromStateliteImageID(self, satellite_image_id):
        self.cursor.execute(f"""SELECT date
            FROM satellite_images
            WHERE id = {satellite_image_id};""")
        result = self.cursor.fetchall()
        return result
        