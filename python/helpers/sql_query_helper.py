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

    def addBoundaryPointsStateliteImage(self, satellite_image_id, coordinates):
        
        self.cursor.execute(f"""SELECT COUNT(*) FROM boundary_points WHERE satellite_image_id = {satellite_image_id};""")
        result = self.cursor.fetchall()
        
        if result[0][0] != 0:
            self.cursor.execute(f"""DELETE FROM boundary_points WHERE satellite_image_id = {satellite_image_id};""")
            self.connection.commit()

        self.cursor.execute(f"""INSERT INTO boundary_points (satellite_image_id, position, x, y, created_at, updated_at) VALUES 
        ({satellite_image_id}, 1, {coordinates['up_left_point']['x']}, {coordinates['up_left_point']['y']}, NOW(), NOW()),
        ({satellite_image_id}, 2, {coordinates['up_right_point']['x']}, {coordinates['up_right_point']['y']}, NOW(), NOW()),
        ({satellite_image_id}, 3, {coordinates['down_left_point']['x']}, {coordinates['down_left_point']['y']}, NOW(), NOW()),
        ({satellite_image_id}, 4, {coordinates['down_right_point']['x']}, {coordinates['down_right_point']['y']}, NOW(), NOW());""")
        self.connection.commit()

    def editStateliteImageCenter(self, satellite_image_id, coordinates):
        self.cursor.execute(f"""UPDATE satellite_images
        SET map_center_x = {coordinates['center_point']['x']}, map_center_y = {coordinates['center_point']['y']}
        WHERE id = {satellite_image_id};""")
        self.connection.commit()