<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестовое задание</title>
    <link rel="stylesheet" href="style.css">
    <!-- Подключаем jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>
   <!-- Front-end  -->
    <h2 class="mb-2">Front-End</h2>

    <!-- 1 задание -->
    <h4 class="mb-2">
        <p>1) Внутри блока < div > заданной ширины и высоты (200 на 300 пикселей) находится изображение < img >. </p>
        <p>Необходимо сделать вертикальное и горизонтальное выравнивание картинки внутри блока < div >.</p>
        <p>Размеры изображения не известны. Картинка должна быть обязательно тегом < img ></p>
        <p>Напишите код реализации (желательно без использования Flexbox)</p>
    </h4>

    <div id="task" class="mb-2">
        <div>
            1) Вариант, когда картинка должна целиком поместить в блок
            <div id="task_1_1">
                <img src="images/task1.jpg" alt="">
            </div>
        </div>
        <div>
            2) Вариант, когда картинку следует "обрезать" и центрировать в блок
            <div id="task_1_2">
                <img src="images/task1.jpg" alt="">
            </div>
        </div>
    </div>

    <!-- 2 задание -->
    <h4 class="mb-2">
        <p>2) Горизонтальное меню сайта реализовано на тегах ul>li>a. </p>
        <p>Напишите код (желательно без использования Flexbox) равномерного выравнивание пунктов горизонтального меню по ширине (одинаковые отступы между блоками) контейнера.</p>
    </h4>

    <div class="navbar">
        <ul>
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
            <li>
                <a href="#">Blog</a>
            </li>
        </ul>
    </div>

    <!-- 3 задание -->
    <h4 class="mb-2">
        <p>3) Имеется двухуровневое горизонтальное меню.</p>
        <p>Напишите код плавного появления и исчезновение второго (выпадающего) уровня меню при наведении на пункт меню первого уровня.</p>
    </h4>
    <div class="navbar">
        <ul>
            <li>
                <a href="#">Home</a>
                <ul class="menu">
                    <li><a href="#"> Элемент 1</a></li>
                    <li><a href="#"> Элемент 2</a></li>
                    <li><a href="#"> Элемент 3</a></li>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
                <ul class="menu">
                    <li><a href="#"> Элемент 1</a></li>
                    <li><a href="#"> Элемент 2</a></li>
                    <li><a href="#"> Элемент 3</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Contact</a>
                <ul class="menu">
                    <li><a href="#"> Элемент 1</a></li>
                    <li><a href="#"> Элемент 2</a></li>
                    <li><a href="#"> Элемент 3</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Blog</a>
                <ul class="menu">
                    <li><a href="#"> Элемент 1</a></li>
                    <li><a href="#"> Элемент 2</a></li>
                    <li><a href="#"> Элемент 3</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- 4 задание -->
    <h4 class="mb-2">
        <p>4) Напишите код, который позволяет получить и вывести в консоль jquery-элементы с data-атрибутом ID</p>
    </h4>
    <div id="task4" data-id="123" class="mb-2">Значение отображается в консоли</div>

    <script>
        // let id = $('#task4').attr('data-id');
        let id = $('#task4').data('id');
        console.log(id);
    </script>

    <!-- 5 задание -->
    <h4 class="mb-2">
        <p>5) Необходимо отсортировать элементы класса .class по высоте и вывести их в по убыванию высоты в родителе .parent </p>
        <p>Напишите код.</p>
    </h4>

    <div class="parent">
        <div class="class" style="height:30px"></div>
        <div class="class" style="height:10px"></div>
        <div class="class" style="height:40px"></div>
        <div class="class" style="height:20px"></div>
        <div class="class" style="height:50px"></div>
    </div>

    <script>
        $(document).ready(($) => {
            let sort = (a, b) => {
                let elem1 = $(a).height();
                let elem2 = $(b).height();
                return elem1 < elem2 ? 1 : -1;
            };

            let list = $(".class");
            list.sort(sort);
            for(let i = 0; i < list.length; i++) {
                $('.parent').append(list[i]);
            }
        });
    </script>

    <!-- 6 задание -->
    <h4 class="mb-2">
        <p>6) Необходимо скрывать элементы с data-атрибутом noprint при печати страницы. </p>
        <p>Напишите код.</p>
    </h4>

    <div class="mb-2">
        <div data-noprint>Данный элемент не отображается при печати страницы</div>
        <p data-noprint>И этот тоже</p>
    </div>

    <script>
        let noPrintElements = [];
        let data = document.querySelectorAll('[data-noprint]');

        window.addEventListener("beforeprint", (event) => {
            Array.prototype.forEach.call(data, function(item, index) {
                noPrintElements.push({"element": item, "display": item.style.display });
                item.style.display = 'none';
            });
        });

        window.addEventListener("afterprint", (event) => {
            Array.prototype.forEach.call(noPrintElements, function(item, index) {
                item.element.style.display = item.display;
            });      
            noPrintElements = [];
        });
    </script>


    <!-- PHP  -->
    <h2 class="mb-2">PHP</h2>
    <!-- Задание 7 -->
    <b>7) У вас есть csv-файл с разделами и товарами интернет-магазина на 5000 строк.</b>
    <b>Необходимо получить информацию из файла и внести информацию в базу данных  интернет-магазина (опционально с проверкой имеющихся позиций и обновления информации по ней).</b>
    <b>Опишите алгоритм решения данной задачи с указанием используемых функций и классов.</b> <br>

    <div class="mb-2">
        <p>1) Подключаемся к БД через функцию <i>Connect()</i>, где указываем данные к БД (host, user, password, db)</p>
        <p>2) В функции <i>UploadCSV</i> Соединяемся с БД, с помощью <b>fopen()</b> открываем файл в формате CSV. С помощью <b>fgetcsv()</b> читаем строку из файла и производим разбор данных</p>
        <p>В цикле while проверяем существует ли запись, если да, то обновляем данные <b>UPDATE</b>, иначе добавляем <b>INSERT</b></p>
        <p>Закрываем соединение с файлом <b>fclose</b></p>
        <p>3) При необходимости можем отобразить данные из БД функцией <i>Display()</i></p>
        <span>Пример работы можно посмотреть в файле script.php</span>
    </div>

    <!-- Задание 8 -->
    <b>8) Опишите алгоритм двухфакторной авторизации на сайте.</b> <br>
    
    <div class="mb-2">
        <p>Для начала авторизуемся на сайте под своим Логином/Паролем, после этого отправляем код в СМС/на почту/через сторонее приложение, как GoogleAuthenticator,</p>
        <p>выводим форму на сайте, куда нужно ввести полученный код. Если они совпадают, то завершаем авторизацию.</p>
    </div>

    <h2 class="mb-2">SQL</h2>
    <!-- Задание 9 -->
    <b>9)  В базе данных есть:</b>
    <ul>
        <li>таблица категорий товаров category (id, name),</li>
        <li>таблица товаров product (id,category_id,name,price),</li>
        <li>таблица свойств property (id,name)</li>
        <li>таблица значений свойств товаров property_value (product_id,property_id,value)</li>
    </ul>
    <br>
    <p>Необходимо: 	</p>
    <ul>
        <li>получить значения свойств товара, если известно его ID</li>
        <li>получить список названий уникальных свойств товара по названию категории (свойство должно быть только у 1 товара в категории).</li>
    </ul>
    <br>
    <p>Напишите запросы.</p>

    <div class="mb-2">
        <p>1. Необходимо получить значения свойств товара, если известно его ID:</p>
        <p>'SELECT * from `product` JOIN `property_value` ON `property_value`.`product_id` = `product`.id
                                    JOIN `property` ON `property`.id = `property_value`.`property_id`
                                    WHERE `product`.id =' . $id</p>
    </div>


    <h2 class="mb-2">1C-Битрикс</h2>
    <!-- Задание 10 -->
    <b>10) В инфоблоке новостей необходимо изменить размер изображения анонса новости под размеры контейнера (320 на 240 пикселей).</b>
    <p>Напишите код.</p> <br>
    
    <div class="code mb-2">
        <?php
        $string = '
        while ($arItem = $res->GetNext()) {
            $image = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]);
            
            if (isset($image)) {
                $tmpImage = CFile::ResizeImageGet($image, array("width" => 320, "height" => 240), BX_RESIZE_IMAGE_PROPORTIONAL, false);
                $image["SRC"] = $tmpImage["SRC"];
            }
            echo "img srс="$image["SRC"]" alt="$arItem["ALT"]" title="$arItem["TITLE"]">";
        }
        ';
        echo nl2br($string);
        ?>
    </div>


    <!-- Задание 11 -->
    <b>11) Необходимо получить  все цены товара по его ID.</b>
    <p>Напишите код (или алгоритм).</p>

    <div class="mb-2">
        <p>$price = CPrice::GetList(array(), array('PRODUCT_ID' => $id));</p>
    </div>

    <!-- Задание 12 -->
    <b>12) Через импорт на сайт выгружаются товары (керамическая плитка) с ценой за упаковку (по этой цене товар идет в корзину). </b>
    <p>В товаре есть информация о площади товара (упаковка плитки покрывает площадь 1,8 кв.м). </p>
    <p>Необходимо после добавления товара автоматически пересчитывать стоимость товара за 1 кв.м, записать значение в пользовательское поле товара для дальнейшего вывода на сайте.</p>


    <h2 class="mb-2">Сервер</h2>
    <!-- Задание 13 -->
    <b>13)  Как выполнить смену пароля пользователя root через командную строку?</b>

    <div class="mb-2">
        Чтобы поменять пароль любого пользователя необходимо ввести в командную строку: <br>
        <b>sudo passwd имя_пользователя</b> <br>
        Где вместо <i>имя_пользователя</i> нужно подставить имя учётной записи пользователя Linux.
    </div>

    <!-- Задание 14 -->
    <b>14) Вы находитесь в директории /home/ </b>
    <p>Необходимо найти все файлы внутри этой директории с текстом ‘bitrix’ рекурсивно.</p>

    <div class="mb-2">
        <b>grep -rnwl '/home/' -e "bitrix"</b>, <br>
        где <i>-r</i> рекурсивный поиск, <i>-n</i> вывод номера строки
        <i>-w</i> только целые слова, <i>-l</i> вывод имени файла, где было совпадение
    </div>

    <!-- Задание 15 -->
    <b>15) Как поставить обновление на Linux-сервер?</b> <br>
    
    <b>$ sudo do-release-upgrade -d</b>
</body>
</html>