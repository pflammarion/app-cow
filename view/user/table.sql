/*Journalier Pour une vache*/
SELECT data_sensor.Value
/*AVG(data_sensor.Value) herd*/
FROM data_sensor
         LEFT JOIN chip_level ON chip_level.Chip_Level_Id = data_sensor.Chip_Level_Id
         LEFT JOIN chip_cow_user ON chip_cow_user.Chip_Id = chip_level.Chip_Id
         LEFT JOIN cow ON cow.Cow_Id = chip_cow_user.Cow_Id
WHERE cow.Cow_Id = 1
    /*cow.Cow_Id != 1 herd*/
  AND chip_cow_user.User_Id = 9
  AND chip_level.Sensor_Id = 1
  AND data_sensor.Average_Id = 1
  AND YEAR(data_sensor.Date) =2022
  AND MONTH(data_sensor.Date)=01
  AND DAY(data_sensor.Date)=01
  AND HOUR(data_sensor.Date) BETWEEN 04 AND 07; #pour récupérer les valeurs entre 0 et 3 heures

/*between 08 AND 11;
between 12 AND 15;
between 16 AND 19;
between 20 AND 23;
between 00 AND 03;*/


/*Annuel*/

SELECT data_sensor.Value #,data_sensor.Date
FROM data_sensor
         LEFT JOIN chip_level ON chip_level.Chip_Level_Id = data_sensor.Chip_Level_Id
         LEFT JOIN chip_cow_user ON chip_cow_user.Chip_Id = chip_level.Chip_Id
         LEFT JOIN cow ON cow.Cow_Id = chip_cow_user.Cow_Id
WHERE cow.Cow_Id = 1
  AND chip_cow_user.User_Id = 9
  AND chip_level.Sensor_Id = 1
  AND data_sensor.Average_Id = 3 # mensuel
  AND YEAR(data_sensor.Date) =2022
  AND MONTH(data_sensor.Date)=03
  AND DAY(data_sensor.Date)=01 # On ne modifie pas cette valeur
  AND HOUR(data_sensor.Date) BETWEEN 00 AND 03; # On ne modifie cette valeur

/*Semaine*/

SELECT data_sensor.Value
FROM data_sensor
         LEFT JOIN chip_level ON chip_level.Chip_Level_Id = data_sensor.Chip_Level_Id
         LEFT JOIN chip_cow_user ON chip_cow_user.Chip_Id = chip_level.Chip_Id
         LEFT JOIN cow ON cow.Cow_Id = chip_cow_user.Cow_Id
WHERE cow.Cow_Id = 1
  AND chip_cow_user.User_Id = 9
  AND chip_level.Sensor_Id = 1
  AND data_sensor.Average_Id = 2 # journalier
  AND YEAR(data_sensor.Date) =2022
  AND MONTH(data_sensor.Date)=01
  AND DAY(data_sensor.Date)=02 # pour le 01 (il faudrait associer avec lundi c'est à dire avec la date de mardi)
  AND HOUR(data_sensor.Date)BETWEEN 00 AND 23;

SELECT DAYOFWEEK('2022-01-01') as jour_semaine;

SELECT WEEK('2022-11-01') as semaine_numero;