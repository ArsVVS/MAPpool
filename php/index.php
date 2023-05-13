<?php
session_start();

if(isset($_GET["theme"]))
{
    $theme = $_GET["theme"];

    if($theme == "light" || $theme == "dark")
    {
   	 $_SESSION["theme"] = $theme;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" id="theme-link" href="../<?php echo $_SESSION["theme"]; ?>.css">
  <title>MapPool</title>
</head>
<body>
  <div class="wrapper">
    <header class="header">
      <div class="header__logo">
        <img src="../assets/map.png" alt="logo" class="header__icon">
        <span class="header__title">MapPool</span>
      </div>
      <div class="header__content">
        <a href="list.php" class="header__item">ПЕРСОНАЛЬНЫЙ ПОДБОР</a>
        <div class="theme-button" id="theme-button">ИЗМЕНИТЬ ТЕМУ</div>
        <script>
          var btn = document.getElementById("theme-button");
          var link = document.getElementById("theme-link");

          btn.addEventListener("click", function () {
            let lightTheme = "../light.css";
            let darkTheme = "../dark.css";

            var currTheme = link.getAttribute("href");
            var theme = "";

            if(currTheme == lightTheme)
            {
   	          currTheme = darkTheme;
              theme = "dark";
            }
            else
            {    
   	          currTheme = lightTheme;
   	          theme = "light";
            }

            link.setAttribute("href", currTheme);

            var Request = new XMLHttpRequest();
            Request.open("GET", "themes.php?theme=" + theme, true); 
            Request.send();
          });
        </script>
      </div>
    </header>
    <main class="page">
      <div class="page__intro">
        <div class="intro__container">
          <div class="intro__text">
            <h1 class="intro__title">Подберите себе идеальный бассейн</h1>
            <h2 class="intro__description">
              Мы представляем из себя команду спортивных экспертов, профессиональных
              спортсменов и энтузиастов, которые хотят подбрать для Вас идеальный бассейнч.</h2>
            <a href="list.php" class="intro__link">Перейти к подбору</a>
          </div>
          <div class="intro__img">
            <img src="../assets/poolicon.png" alt="">
          </div>
        </div>
      </div>
      <div class="page__about">
        <div class="about__container">
          <img class="about__img" src="../assets/pool2.jpg"></img>
          <div class="about__text">
        <h2 class="about__title">Как мы оцениваем бассейные центры?</h2>
            <p class="about__description">
              Основываясь на специальной формуле, где учитываются определенные
              особенности каждого бассейного центра,<br>мы оцениваем каждый из них по пятибальной шкале.
            </p>
            <p class="about__description">
              Ниже перечислены несколько
              вещей, на которые мы обращаем внимание в первую очередь:
            </p>
            <ul class="about__list">
              <li class="about__element">Длина бассейна</li>
              <li class="about__element">Наличие бассейна под открытым небом</li>
              <li class="about__element">Наличие медпункта</li>
              <li class="about__element">Приспособленность для занятий инвалидов</li>
              <li class="about__element">Наличие точки питания</li>
            </ul>
            <p class="about__description">
              Помимо этого, на странице с персональным подбором присутствует панель инструментов, с помощью
              которой<br>вы
              сами сможете выбрать подходящий для вас бассейн.
            </p>
          </div>
        </div>
      </div>
    </main>
    <footer class="footer">
      <div class="footer__container">
        <div class="footer__copy">
        Все предоставленные данные были взяты с сайта <a href = "https://data.mos.ru">https://data.mos.ru</a><br />
        Copyright © 2023 All rights reserved
      </div>
    </div>
    </footer>
  </div>
</body>

</html>