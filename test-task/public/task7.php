<?php
try {
    $exlFile = fopen(__DIR__ . '/excel/Books.xlsx', 'r');
} catch (\Throwable $th) {
    echo 'Что-то пошло не так при загрузке файла Excel: ' . $th;
}

while(($line = fgetcsv($exlFile)) !== FALSE){
    $name = $line[0];

    echo $name;
}