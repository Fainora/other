<?php
    try {
        UploadCSV();
        //Display();
    } catch (\Throwable $th) {
        echo 'Что-то пошло не так: ' . $th;
    }
    
    function Connect() {
        $host = 'localhost';
        $db = 'db';
        $user = 'root';
        $pass = 'root';
        try {
            $db = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            return $db;
        } catch (\Throwable $th) {
            echo 'Что-то пошло не так при загрузке БД: ' . $th;
        }
    }

    function Display() {
        $db = Connect();
        $sql = $db->query('SELECT * FROM `import`');
        foreach($sql as $value) {
            print_r($value);
        }
    }

    function UploadCSV() {
        $db = Connect();

        try {
            echo 'Открываем файл <br>';
            $csvFile = fopen('import.csv', 'r'); 
        } catch (\Throwable $th) {
            echo 'Что-то пошло не так при загрузке файла CSV: ' . $th;
        }
        
        // Читаем строку из файла и производим разбор данных CSV
        fgetcsv($csvFile);
        while(($line = fgetcsv($csvFile)) !== FALSE){
            $import_id = $line[0];
            $otdel = $line[1];
            $name = $line[2];
            
            // Проверяем, существует ли в БД запись
            $prevQuery = "SELECT id FROM `import` WHERE import_id = '".$line[0]."'";
            $prevResult = $db->query($prevQuery);
            
            if($prevResult->rowCount() > 0){
                // Обновляем данные в БД
                try {
                    $db->query("UPDATE `import` SET otdel = '".$otdel."', name = '".$name."' WHERE import_id = '".$import_id."'");
                } catch (\Throwable $th) {
                    echo 'Что-то пошло не так при обновлении данных: ' . $th;
                }
            }else{
                // Добавляем данные в БД
                try {
                    $db->query("INSERT INTO `import` (import_id, otdel, name) VALUES ('".$import_id."', '".$otdel."', '".$name."')");
                } catch (\Throwable $th) {
                    echo 'Что-то пошло не так при добавлении данных: ' . $th;
                }
            }
        }
        fclose($csvFile);
    }
?>