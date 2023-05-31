class SingleStateliteParse:    
    def __init__(self, matrix_data): 
        self.matrix_data = matrix_data

        self.normalization_matrix()

    def normalization_matrix(self):
        matrix_data = self.matrix_data
        min_value, max_value = matrix_data.min()*1.0, matrix_data.max()*1.0
        self.matrix_data = ((matrix_data * 1.0 - matrix_data * 1.0) / (max_value * 1.0 - min_value))

