<?php
//Підключаємо Header
require 'app/view/header.phtml';
//Підключаємо menu
require 'app/view/menu.phtml';
//Підключаємо Get_limit для перевірки на кількість сторінок
require 'app/controller/index/get_limit.php';
//Підключаємо index
require 'app/view/index/index.phtml';
//Підключаємо limit для пагінації і кількості висвітлених оголошень
require 'app/view/index/select_limit.phtml';
//Підключаємо pagination
require 'app/view/index/pagination.phtml';
//Підключаємо Footer
require 'app/view/footer.phtml';