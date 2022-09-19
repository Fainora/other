<?php

$device = new Radio();
$device->turnOn();
$device->turnOff();
$device = new TV();
$device->switchTheChannel();


class Device {
    //Подключаемся
    public function turnOn() {
        echo 'Включили';
    }
    //Выключаем
    public function turnOff() {
        echo 'Выключили';
    }
    //Настраиваем устройство
    public function setUp() {
        echo 'Настроили';
    }
    //Настраиваем громкость
    public function adjustVolume() {
        echo 'Изменили громкость';
    }
}

class Radio extends Device {
    public function changeFrequency() {

    }
}

class Tv extends Device {
    public function switchTheChannel() {
        echo 'Переключили канал';
    }
}

class Mobile extends Device {
    public function call() {
        echo 'Позвонили с телефона';
    }
}