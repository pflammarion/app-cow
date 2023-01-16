import datetime

from faker import Faker
from collections import defaultdict

if __name__ == '__main__':
    fake = Faker()
    fake_data = defaultdict(list)

    ##mettre le chip_level_id, c'est pour prendre en compte les différents capteurs 16-19
    j = 1
    while j < 9:
        cow = str(j)
        baseSensor = 16 + (4 * (j - 1))
        chip = [str(baseSensor), str(baseSensor + 1), str(baseSensor + 2), str(baseSensor + 3)]
        keys = ['cardiaque', 'carbone', 'sonore', 'batterie']
        for i in range(len(chip)):
            min = 20
            max = 100
            year = 2023
            min_number_value_hour = 2
            max_number_value_hour = 4
            chip_number = chip[i]

            ####Mettre le bon fichier ici
            with open("../data_sensor.sql", "a") as f:
                f.write('USE APPCOW;')
                f.write("\n")
                f.write('-- Annual data')
                f.write("\n")
                for i in range(6):
                    value = str(fake.pyint(min, max))
                    month = [1, 3, 5, 7, 9, 11]
                    date = str(datetime.datetime(year, month[i], 1, 0, 0, 0))
                    coef = str(fake.pyint(min_number_value_hour * 5040, max_number_value_hour * 5040))
                    query = "INSERT INTO data_sensor (Value, Date, Chip_Level_Id, Average_Id, Coef) VALUES (" + value + ", '" + date + "', " + chip_number + ", 3 ," + coef + ");"
                    f.write(query)
                    f.write("\n")
                f.write('-- Week data')
                f.write("\n")
                for k in range (11):
                    for i in range(28):
                        value = str(fake.pyint(min, max))
                        jour = i + 1
                        date = str(datetime.datetime(year, k+1, jour, 0, 0, 0))
                        coef = str(fake.pyint(min_number_value_hour * 24, max_number_value_hour * 24))
                        query = "INSERT INTO data_sensor (Value, Date, Chip_Level_Id, Average_Id, Coef) VALUES (" + value + ", '" + date + "', " + chip_number + ", 2 ," + coef + ");"
                        f.write(query)
                        f.write("\n")

                f.write('-- Day data')
                f.write("\n")
                for k in range (11):
                    for i in range(6):
                        value = str(fake.pyint(min, max))
                        hour = i * 4
                        date = str(datetime.datetime(year, k+1, i+1, hour, 0, 0))
                        coef = str(fake.pyint(min_number_value_hour * 3, max_number_value_hour * 3))
                        query = "INSERT INTO data_sensor (Value, Date, Chip_Level_Id, Average_Id, Coef) VALUES (" + value + ", '" + date + "', " + chip_number + ", 1 ," + coef + ");"
                        f.write(query)
                        f.write("\n")

                f.write('-- Instant data')
                f.write("\n")
                for _ in range(20):
                    value = str(fake.pyint(min, max))
                    date = str(fake.date_time_ad(None, datetime.datetime(year, 1, 15, 16, 0, 0),datetime.datetime(year, 1, 15, 0, 0, 0)))
                    coef = '1'
                    query = "INSERT INTO data_sensor (Value, Date, Chip_Level_Id, Average_Id, Coef) VALUES (" + value + ", '" + date + "', " + chip_number + ", 4 ," + coef + ");"
                    f.write(query)
                    f.write("\n")
        j += 1