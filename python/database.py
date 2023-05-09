import mysql.connector

from config.database_config import DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_CONNECTION

def db_connection():
    match DB_CONNECTION:
        case "mysql":
            db = mysql.connector.connect(
                host=DB_HOST,
                port=DB_PORT,
                database=DB_DATABASE,
                user=DB_USERNAME,
                password=DB_PASSWORD
            )
        case "postgressql":
            pass
        case "mongodb":
            pass
        case "sqlite":
            pass
        case _:
            pass
    return db

MySQLConnection = mysql.connector.MySQLConnection