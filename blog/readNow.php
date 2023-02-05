<?php 
    include '../investor/avatarInitials.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="A simple and elegant site" />
    <link rel="icon" href="/Assets/MiddlefundLogo.png" />
    <link rel="stylesheet" href="./css/readNow.css" />
    <link rel="stylesheet" href="./css/tailwind.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css"
    />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js"
      defer
    ></script>

    <title>Middlefund Blog</title>
  </head>
  <body>
    <header class="header">
      <div class="header-container">
        <!-- navbar -->
        <nav class="navbar">
          <!-- menu -->
          <div class="navmenu">
            <a href="../index.php" class="navmenu-button">
              <svg
                class="navmenu-icon"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                ></path>
              </svg>
            </a>
            <a href="startReading.php" class="navmenu-button">
              <svg
                class="navmenu-icon"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </a>
          </div>
          <?php
           session_start();
           if(isset($_SESSION['username'])){?>
          <div class="relative" x-data="{ isOpen: false }">
            <?php if(empty(isset($_SESSION['user_image']))){ ?>
                <button @click="isOpen = !isOpen" class="p-1 bg-gray-200 rounded-full focus:outline-none focus:ring" id="profileDrop">
                    <?php
                    echo getProfilePicture($_SESSION['username']); ?>
                    </button>
                  <?php } 
                  
                  else{ ?>
                  <button @click="isOpen = !isOpen" class="p-1 bg-gray-200 rounded-full focus:outline-none focus:ring">
                    <img
                    class="object-cover w-8 h-8 rounded-full"
                    src="../Assets/userImages/<?php echo $_SESSION['user_image']?>";
                    alt=""
                  />
                  </button>
                 <?php } ?>
            <!-- green dot -->
            <div
              class="
                absolute
                right-0
                p-1
                bg-green-400
                rounded-full
                bottom-3
                animate-ping
              "
            ></div>
            <div
              class="
                absolute
                right-0
                p-1
                bg-green-400
                border border-white
                rounded-full
                bottom-3
              "
            ></div>

            <div
              @click.away="isOpen = false"
              x-show.transition.opacity="isOpen"
              class="
                absolute
                z-50
                w-48
                max-w-md
                mt-3
                transform
                bg-white
                rounded-md
                shadow-lg
                -translate-x-3/4
                min-w-max
              "
            >
              <div class="flex flex-col p-4 space-y-1 font-medium border-b">
                <span class="text-gray-800"><?php echo $_SESSION['username']?></span>
                <span class="text-sm text-gray-400"><?php echo $_SESSION['email']?></span>
              </div>
             <!-- <ul class="flex flex-col p-2 my-2 space-y-1">
                <li>
                  <a
                    href="settings.php"
                    class="
                      block
                      px-2
                      py-1
                      transition
                      rounded-md
                      hover:bg-gray-100
                    "
                    >Settings</a
                  >
                </li>
                <li>
                  <a
                    href="#"
                    class="
                      block
                      px-2
                      py-1
                      transition
                      rounded-md
                      hover:bg-gray-100
                    "
                    >Another Link</a
                  >
                </li>
              </ul> -->
              <div
                class="
                  flex
                  items
                  -center
                  justify-center
                  p-4
                  text-blue-700
                  underline
                  border-t
                "
              >
                <a href="../SignInUpNew/logout.php">Logout</a>
              </div>
            </div>
          </div>
          <?php } ?>
        </nav>
      </div>
    </header>
    <div class="mainContainer">
      <div class="heading"><h1>REGISTERING YOUR STARTUP</h1></div>
      <br />
      <div class="paragraphs">
        <p>
          Laboris ea tempor occaecat irure occaecat duis in irure ullamco aliqua
          velit dolor est. Elit amet voluptate pariatur magna proident do eu qui
          eiusmod ad quis veniam voluptate. Amet proident velit irure minim nisi
          deserunt nulla sunt sint incididunt. Laborum ut sunt pariatur ut
          voluptate duis ipsum. Et in eiusmod id consectetur exercitation
          incididunt dolore do. Tempor deserunt deserunt eu aliquip ipsum Lorem
          elit elit in cillum. Irure laboris proident non non aliqua enim
          cupidatat aliqua fugiat cillum id. Velit amet cupidatat anim occaecat
          pariatur dolor sunt eu est Lorem. Dolor consectetur consequat esse sit
          magna esse anim proident aute duis fugiat anim officia. Eu ut officia
          voluptate eu consectetur dolore voluptate culpa. Labore nisi ipsum
          laborum consequat velit proident aliquip sit do incididunt nisi.
          Exercitation laboris eiusmod dolore culpa sunt qui do nostrud est. Do
          pariatur non consequat adipisicing mollit proident dolor pariatur non
          consectetur occaecat amet fugiat in. Occaecat duis laborum sit enim et
          adipisicing aute. Dolore irure eu magna do dolor Lorem veniam enim.
          Ipsum laboris magna aliqua amet sunt voluptate amet anim.
          Reprehenderit enim reprehenderit consectetur elit exercitation aliqua
          sunt commodo quis nisi incididunt dolore deserunt. Ea magna magna
          velit aute dolore adipisicing amet deserunt exercitation eiusmod
          voluptate eiusmod. Ut et pariatur duis commodo mollit excepteur minim
          consequat dolor proident duis nostrud. Commodo ipsum irure nostrud
          magna nisi elit cupidatat magna fugiat eu occaecat aliqua aute. Culpa
          enim id occaecat commodo consequat. Lorem ad aliqua in magna ullamco
          sit quis eu sit sunt velit ullamco. Eu duis dolore nisi labore dolor
          cupidatat laboris commodo. Amet labore adipisicing exercitation
          laborum amet enim dolore esse. Est nulla exercitation magna cillum
          fugiat. Exercitation ex laborum reprehenderit ullamco culpa sit nisi
          sit qui exercitation occaecat. Consectetur ad in ex veniam
          exercitation enim. Irure nulla velit aliquip cupidatat labore anim
          dolor ad duis esse. Non Lorem non cupidatat labore duis occaecat irure
          voluptate. Adipisicing consectetur reprehenderit irure consectetur id
          occaecat Lorem officia laboris ipsum. Incididunt eu consectetur duis
          in anim velit minim veniam. Nostrud in veniam aliqua sunt pariatur do
          quis culpa ad aliqua. Veniam cillum Lorem non aliqua mollit
          adipisicing velit in eiusmod veniam excepteur sint. Sit adipisicing
          aliquip est excepteur consequat. Elit Lorem duis veniam ut commodo
          pariatur Lorem labore ad. Amet reprehenderit reprehenderit mollit
          culpa amet reprehenderit adipisicing id culpa mollit tempor. Sit sint
          magna dolore cupidatat. In cillum non non anim id. Aliqua veniam
          mollit in in anim esse reprehenderit id commodo aliqua deserunt id ad.
          Officia reprehenderit minim duis voluptate mollit eiusmod ad
          reprehenderit adipisicing. Do nisi do anim qui excepteur officia ipsum
          reprehenderit deserunt aliqua anim. Ad id duis non eu quis aute. Ad
          ipsum enim adipisicing sint est in nostrud anim est dolore cupidatat
          non laboris. Veniam nisi eu nisi incididunt. Culpa aliqua non
          incididunt qui nulla culpa deserunt ullamco irure. Mollit eu pariatur
          veniam ex adipisicing exercitation amet ad elit. Occaecat sint minim
          commodo eu sunt consectetur cillum Lorem eiusmod amet anim non et.
        </p>
      </div>
      <br />
      <div class="fLeft">
        <h3>Author: Basha Tahidu Damba</h3>
        <br />
        <h2>06/12/2021<br /><br /><br /></h2>
      </div>
      <div class="fRight">
        <a href="#" id="topBtn">Previous Post</a>&nbsp;&nbsp;&nbsp;<a href="#"
          >Next Post</a
        ><br /><br /><a href="#">Blog Menu</a>
      </div>
    </div>
  </body>
</html>
