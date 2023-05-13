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

$mysql = new mysqli('localhost', 'root', '', 'MapPool');
$result = mysqli_query($mysql, "SELECT * FROM `data`");

if ($mysql -> connect_error) {
  die("Connection failed: " . $mysql -> connect_error);
} 

$results = [];
  
while ($name = mysqli_fetch_assoc($result)) {
  array_push($results, [
    $name['ObjectName'], 
    $name['PoolLenght'], 
    $name['PoolInOrOut'], 
    $name['AdmArea'], 
    $name['District'], 
    $name['Address'],
    $name['Email'],
    $name['WebSite'],
    $name['HelpPhone'],
    $name['HasDressingRoom'],
    $name['HasEatery'],
    $name['HasToilet'],
    $name['HasWifi'],
    $name['HasCashMachine'],
    $name['HasFirstAidPost'],
    $name['HasMusic'],
    $name['Lighting'],
    $name['Paid'],
    $name['DisabilityFriendly'],
  ]);
}

$stringResults = [];

for ($i = 0; $i < count($results); $i++) {
  array_push($stringResults, implode('|', $results[$i]));
}

$str = "";

for ($i = 1; $i < count($stringResults); $i++) {
  $str = $str . $stringResults[$i] . 'sep';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" id="theme-link" href="../<?php echo $_SESSION["theme"]; ?>.css">
  <link rel="stylesheet" href="../style.css">
  <title>MapPool</title>
</head>

<body>
  <div class="wrapper">
    <header class="header">
      <div class="header__logo">
        <img src="../assets/map.png" alt="logo" class="header__icon">
        <a href="index.php" class="header__title--secondary">MapPool</a>
      </div>
      <div class="header__content">
        <a class="header__item">ПЕРСОНАЛЬНЫЙ ПОДБОР</a>
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
    <div class="page__description">
        <h1 class="selection__title">Персональный подбор</h1>
        <div class="selection__container">
          <p class="selection__text">
            Здесь вы можете самостоятельно подобрать бассейн в соответствии с вашими пожеланиями.
          </p>
        </div>
        <img src="../assets/selectpool.jpg" alt="" class="selection__img">
      </div>
      <div class="page__main">
        <div class="main__toolbar">
          <label for="main-search" class="main__search--title">Поиск</label>
          <input type="text" class="main__search" id="main-search">
          <label for="main-rating-select">Рейтинг</label>
          <select name="main-rating-select" id="main-rating-select">
            <option value="0">Не выбрано</option>
            <option value="5">5</option>
            <option value="4">4</option>
            <option value="3">3</option>
            <option value="2">2</option>
            <option value="1">1</option>
          </select>
          <label for="main-lenght-select">Длина бассейна</label>
          <select name="main-lenght-select" id="main-lenght-select">
            <option value="none">Не выбрано</option>
            <option value="25">25 метров</option>
            <option value="50">50 метров</option>
          </select>
          <label for="main-open-select">Открытый/крытый бассейн</label>
          <select name="main-open-select" id="main-open-select">
            <option value="none">Не выбрано</option>
            <option value="open">Открытый</option>
            <option value="closed">Крытый</option>
          </select>
          <label for="main-disability-select">Занятия с инвалидами</label>
          <select name="main-disability-select" id="main-disability-select">
            <option value="none">Не выбрано</option>
            <option value="partly">Частично приспособлен</option>
            <option value="oda">Приспособлен для лиц с нарушением ОДА</option>
            <option value="fully">Приспособлен для всех групп инвалидов</option>
          </select>
          <label for="main-paid-select">Платно/бесплатно</label>
          <select name="main-paid-select" id="main-paid-select">
            <option value="none">Не выбрано</option>
            <option value="free">Бесплатно</option>
            <option value="paid">Платно</option>
          </select>
          <div class="main__input">
            <label for="hasDressingRoom">Раздевалка</label>
            <input type="checkbox" name="hasDressingRoom" id="hasDressingRoom" class="main__checkbox">
          </div>
          <div class="main__input">
            <label for="hasEatery">Точка питания</label>
            <input type="checkbox" name="hasEatery" id="hasEatery" class="main__checkbox">
          </div>
          <div class="main__input">
            <label for="hasToilet">Туалет</label>
            <input type="checkbox" name="hasToilet" id="hasToilet" class="main__checkbox">
          </div>
          <div class="main__input">
            <label for="hasWifi">Точка Wi-Fi</label>
            <input type="checkbox" name="hasWifi" id="hasWifi" class="main__checkbox">
          </div>
          <div class="main__input">
            <label for="hasCashMachine">Банкомат</label>
            <input type="checkbox" name="hasCashMachine" id="hasCashMachine" class="main__checkbox">
          </div>
          <div class="main__input">
            <label for="hasFirstAidPost">Медпункт</label>
            <input type="checkbox" name="hasFirstAidPost" id="hasFirstAidPost" class="main__checkbox">
          </div>
          <div class="main__input">
            <label for="hasMusic">Музыка</label>
            <input type="checkbox" name="hasMusic" id="hasMusic" class="main__checkbox">
          </div>
        </div>
        <div class="main__content">
         
        </div>
      </div>
    </main>
    <footer class="footer">
      <div class="footer__container">
      <div class="footer__copy">
        Все предоставленные данные были взяты с сайта <a href = "https://data.mos.ru">https://data.mos.ru</a><br />
        Copyright © 2023 All rights reserved
      </div>
    </footer>
  </div>
  <script src="../scripts/script.js"></script>
  <script>
    const mainContent = document.querySelector('.main__content');
    const data = extractData('<?php echo $str ?>');

    const mainSearch = document.querySelector('.main__search');
    const mainRatingSelect = document.querySelector('#main-rating-select');
    const mainLenghtSelect = document.querySelector('#main-lenght-select');
    const mainOpenSelect = document.querySelector('#main-open-select');
    const mainDisabilitySelect = document.querySelector('#main-disability-select');
    const mainPaidSelect = document.querySelector('#main-paid-select');
    const checkboxes = document.querySelectorAll('.main__checkbox');

    function render(elements) {
      mainContent.innerHTML = "";

      for (let i = 0; i < elements.length - 1; i++) {
        const params = [...elements[i]];

        if (!params[0].toLowerCase().includes(mainSearch.value.toLowerCase())) continue;

        const pool = {
          objectName: params[0],
          lenght: params[1],
          inOrOut: params[2],
          admArea: params[3],
          district: params[4],
          address: params[5],
          email: params[6],
          website: params[7],
          helpPhone: params[8],
          hasDressingRoom: params[9],
          hasEatery: params[10],
          hasToilet: params[11],
          hasWifi: params[12],
          hasCashMachine: params[13],
          hasFirstAidPost: params[14],
          hasMusic: params[15],
          lighting: params[16],
          paid: params[17],
          disabilityFriendly: params[18],
          rating: 0
        }

        let next = false;

        for (let j = 0; j < checkboxes.length; j++) {
          if (pool[checkboxes[j].name] === "нет" && checkboxes[j].checked === true) {
            next = true;
          }
        }

        if (next) continue;

        if (pool.hasDressingRoom === "да") pool.rating += 20;
        if (pool.hasEatery === "да") pool.rating += 15;
        if (pool.hasToilet === "да") pool.rating += 20;
        if (pool.hasWifi === "да") pool.rating += 15;
        if (pool.hasCashMachine === "да") pool.rating += 10;
        if (pool.hasFirstAidPost === "да") pool.rating += 20;
        if (pool.hasMusic === "да") pool.rating += 15;
        if (pool.disabilityFriendly === "частично приспособлен" || 
          pool.disabilityFriendly === "приспособлен для лиц с нарушением ОДА") {
            pool.rating += 5;
          } else if (pool.disabilityFriendly === "приспособлен для всех групп инвалидов") {
            pool.rating += 10;
        }

        if (+mainRatingSelect.value === 1 && pool.rating >= 25) continue;
        if (+mainRatingSelect.value === 2 && (pool.rating >= 50 || pool.rating < 25)) continue;
        if (+mainRatingSelect.value === 3 && (pool.rating >= 75 || pool.rating < 50)) continue;
        if (+mainRatingSelect.value === 4 && (pool.rating >= 100 || pool.rating < 75)) continue;
        if (+mainRatingSelect.value === 5 && pool.rating < 100) continue;

        if (mainLenghtSelect.value === "25" && pool.lenght === "50") continue;
        if (mainLenghtSelect.value === "50" && pool.lenght === "25") continue;

        if(mainOpenSelect.value === "open" && pool.inOrOut === "крытый") continue;
        if(mainOpenSelect.value === "closed" && pool.inOrOut === "открытый") continue;

        if (mainPaidSelect.value === "paid" && pool.paid === "бесплатно") continue;
        if (mainPaidSelect.value === "free" && pool.paid === "платно") continue;

        if (mainDisabilitySelect.value === "partly" && pool.disabilityFriendly !== "частично приспособлен") continue;
        if (mainDisabilitySelect.value === "oda" && pool.disabilityFriendly !== "приспособлен для лиц с нарушением ОДА") continue;
        if (mainDisabilitySelect.value === "fully" && pool.disabilityFriendly !== "приспособлен для всех групп инвалидов") continue;

        const item = document.createElement('div');

        item.classList.add('main__item');
        item.innerHTML = 
        `
          <div class="main__info">
          <p class="main__name">${pool.objectName}</p>
          <p class="main__description">${pool.address} | <span class="paid">${pool.lenght} метров<span></p>
          </div>
        `;

        if (pool.rating >= 100) {
          item.innerHTML += `
            <div class="main__rating">
              <img class="main__star" src="../assets/5.png">
            </div>            
          `
        } else if (pool.rating >= 75) {
          item.innerHTML += `
            <div class="main__rating">
            <img class="main__star" src="../assets/4.png">
            </div>
          `
        } else if (pool.rating >= 50) {
          item.innerHTML += `
            <div class="main__rating">
            <img class="main__star" src="../assets/3.png">
            </div>
          `
        } else if (pool.rating >= 25) {
          item.innerHTML += `
            <div class="main__rating">
            <img class="main__star" src="../assets/2.png">
            </div>
          `
        } else {
          item.innerHTML += `
            <div class="main__rating">
            <img class="main__star" src="../assets/1.png">
            </div>
          `
        }
          
        item.innerHTML += 
        `
          </div>
          <ul class="main__about hidden">
            <li class="about__item">Административный округ: ${pool.admArea === "" ? "информация отсутствует" : pool.admArea}</li>
            <li class="about__item">Район: ${pool.district === "" ? "информация отсутствует" : pool.district}</li>
            <li class="about__item">Адрес электронной почты: ${pool.email === "" ? "информация отсутствует" : pool.email}</li>
            <li class="about__item">Адрес сайта: <a href="${pool.website === "" ? "" : pool.website}">${pool.website === "" ? "информация отсутствует" : pool.website}</a></li>
            <li class="about__item">Справочный телефон: ${pool.helpPhone === "" ? "информация отсутствует" : pool.helpPhone}</li>
            <li class="about__item">Крытый/открытый бассейн: ${pool.inOrOut === "" ? "информация отсутствует" : pool.inOrOut}</li>
            <li class="about__item">Наличие раздевалки: ${pool.hasDressingRoom === "" ? "информация отсутствует" : pool.hasDressingRoom}</li>
            <li class="about__item">Наличие точки питания: ${pool.hasEatery === "" ? "информация отсутствует" : pool.hasEatery}</li>
            <li class="about__item">Наличие туалета: ${pool.hasToilet === "" ? "информация отсутствует" : pool.hasToilet}</li>
            <li class="about__item">Наличие точки Wi-Fi: ${pool.hasWifi === "" ? "информация отсутствует" : pool.hasWifi}</li>
            <li class="about__item">Наличие банкомата: ${pool.hasCashMachine === "" ? "информация отсутствует" : pool.hasCashMachine}</li>
            <li class="about__item">Наличие медпункта: ${pool.hasFirstAidPost === "" ? "информация отсутствует" : pool.hasFirstAidPost}</li>
            <li class="about__item">Наличие звукового сопровождения: ${pool.hasMusic === "" ? "информация отсутствует" : pool.hasMusic}</li>
            <li class="about__item">Освещение: ${pool.lighting === "" ? "информация отсутствует :(" : pool.lighting}</li>
            <li class="about__item">Платно/бесплатно: ${pool.paid === "" ? "информация отсутствует :(" : pool.paid}</li>
            <li class="about__item">Приспособленность для занятий инвалидов: ${pool.disabilityFriendly === "" ? "информация отсутствует" : pool.disabilityFriendly}</li>
          </ul>
        `;

        mainContent.append(item);
      }
    
      const mainItems = document.querySelectorAll('.main__item');

      mainItems.forEach(item => {
        item.addEventListener('click', (event) => {
          const pool = event.currentTarget;
          const about = pool.children[2];

          pool.classList.toggle('c');
          about.classList.toggle('hidden');
        })
      })
    }
  
    render(data);

    mainSearch.addEventListener('keyup', () => {
      render(data);
    })

    mainRatingSelect.addEventListener('change', () => {
      render(data);
    })

    mainLenghtSelect.addEventListener('change', () => {
      render(data);
    })

    mainOpenSelect.addEventListener('change', () => {
      render(data);
    })

    mainPaidSelect.addEventListener('change', () => {
      render(data);
    })

    mainDisabilitySelect.addEventListener('change', () => {
      render(data);
    })

    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', (event) => {
        render(data);
      })
    })
  </script>
</body>

</html>