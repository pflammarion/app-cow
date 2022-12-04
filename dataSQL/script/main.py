import datetime

from faker import Faker
from collections import defaultdict

if __name__ == '__main__':
    fake = Faker()
    fake_data = defaultdict(list)
    ##mettre le chip_level_id, c'est pour prendre en compte les différents capteurs
    chip = '15'
    min = 20
    max = 100
    with open("batterycow1.sql", "w") as f:
        f.write('USE APPCOW;')
        f.write("\n")
        f.write('-- Annual data')
        f.write("\n")
        for i in range(5):
            value = str(fake.pyint(min, max))
            month = [3, 5, 7, 9, 11]
            date = str(datetime.datetime(2022, month[i], 1, 0, 0, 0))
            query = "INSERT INTO data_sensor (Value, Date, Chip_Level_Id, Average_Id) VALUES (" + value + ", '" + date + "', " + chip + ", 3);"
            f.write(query)
            f.write("\n")
        f.write('-- Week data')
        f.write("\n")
        for i in range(7):
            value = str(fake.pyint(min, max))
            jour = i + 1
            date = str(datetime.datetime(2022, 1, jour, 0, 0, 0))
            query = "INSERT INTO data_sensor (Value, Date, Chip_Level_Id, Average_Id) VALUES (" + value + ", '" + date + "', " + chip + ", 2);"
            f.write(query)
            f.write("\n")

        f.write('-- Day data')
        f.write("\n")
        for i in range(6):
            value = str(fake.pyint(min, max))
            hour = i * 4
            date = str(datetime.datetime(2022, 1, 1, hour, 0, 0))
            query = "INSERT INTO data_sensor (Value, Date, Chip_Level_Id, Average_Id) VALUES (" + value + ", '" + date + "', " + chip + ", 1);"
            f.write(query)
            f.write("\n")

        f.write('-- Instant data')
        f.write("\n")
        for _ in range(10):
            value = str(fake.pyint(min, max))
            date = str(fake.date_time_ad(None, datetime.datetime(2022, 12, 4, 16, 0, 0),
                                         datetime.datetime(2022, 12, 4, 0, 0, 0)))
            query = "INSERT INTO data_sensor (Value, Date, Chip_Level_Id) VALUES (" + value + ", '" + date + "', " + chip + ");"
            f.write(query)
            f.write("\n")
