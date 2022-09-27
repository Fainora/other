EN - https://phpunit.readthedocs.io/en/9.5/installation.html
RU - https://phpunit.readthedocs.io/ru/latest/index.html
1. Устанавливаем PHPUnit  
    composer require --dev phpunit/phpunit ^9.5  
2. В composer.json добавляем:  
    "autoload": {  
        "classmap": [  
            "src/"  
        ]  
    },  
3. composer dump-autoload

4. Для запуска всех тестов в Windows: php vendor/phpunit/phpunit/phpunit
4.1 Или создать переменную PATH