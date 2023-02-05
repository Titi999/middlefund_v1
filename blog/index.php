 <?php
 include '../investor/avatarInitials.php';
// session_start();
// if(empty(isset($_SESSION['username']))){
//      header("Location: ../signUpIn/signup.php");
//  }

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="A simple and elegant site" />
    <link rel="icon" href="/Assets/MiddlefundLogo.png" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="stylesheet" href="./css/tailwind.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css"
    />
    <link rel="stylesheet" href="assets/css/tailwind.css" />
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
          <div class="menu">
          <!--  <a href="#" class="menu-button">
              <svg
                class="menu-icon"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                ></path>
              </svg>
            </a> -->
            <a href="../index.php" class="menu-button">
              <svg
                class="menu-icon"
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
          if((isset($_SESSION['username']))){?>
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
                <span class="text-gray-800"><?php echo $_SESSION['username'] ?></span>
                <span class="text-sm text-gray-400"><?php echo $_SESSION['email'] ?></span>
              </div>
              <!--<ul class="flex flex-col p-2 my-2 space-y-1">
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

          <!-- logo -->
          <!-- <div class="avatar">
            <span class="avatar-name">Jane Doe</span>
            <img
              src="/assets//images/avatar.jpg"
              alt="Jane Doe"
              class="avatar-image"
              id="avatar-dropdown-btn"
            />
          </div>
          <div class="avatar-dropdown" id="avatar-dropdown">
            <ul class="avatar-dropdown-ul">
              <a href="#" class="avatar-dropdown-a">Jane Doe</a>
              <a href="#" class="avatar-dropdown-a">Profile</a>
              <a href="#" class="avatar-dropdown-a">Settings</a>
              <a href="#" class="avatar-dropdown-a">Logout</a>
            </ul>
          </div> -->
        </nav>
        <!-- header content -->
        <section class="header-content">
          <h1 class="header-content-header">
            <span class="header-content-header-main">Middlefund</span>
            <span class="header-content-header-sub">Blog</span>
            <img
              src="assets/images/blob1.png"
              class="blob blob-1"
              alt="blob1"
            />
          </h1>
        </section>

        <!-- qoute -->
        <section class="header-quote">
          <p class="header-quote-content">
            We believe in building a community of like minded individuals so we
            have come up with this blog, to be able to connect individuals of
            the same goals and purpose. Dive in to our continually growing allay
            of resources.
          </p>
          <div class="header-quote-area">
            <a href="startReading.php" class="header-quote-btn">Start Reading</a>
          </div>
        </section>

        <!-- moji -->
        <div class="mojiContainer">
          <img
            src="assets/images/Humaaans - Standing (1).png"
            class="moji"
            alt="Person"
          />
        </div>

        <!-- blob 1 -->

        <img src="assets/images/blob2.png" class="blob blob-2" alt="blob2" />
      </div>
      <!-- footer -->
      <div class="footer">
        <div class="push-down">
          <div class="footerContent">
            Contact Us<br />
            <a href="https://www.instagram.com/middlefund/"
              >Instagram
              <img
                src="/Assets/icons8-instagram-24.png"
                style="vertical-align: middle; display: inline-block"
            /></a>
            &nbsp;&nbsp;
            <a href="#"
              >Facebook&nbsp;<img
                src="/Assets/icons8-facebook-24.png"
                style="vertical-align: middle; display: inline-block" /></a
            >&nbsp;&nbsp;
            <a href="https://twitter.com/middlefund"
              >Twitter&nbsp;<img
                src="/Assets/icons8-twitter-circled-24.png"
                style="vertical-align: middle; display: inline-block"
            /></a>
            &nbsp;&nbsp;
            <a href="/https://www.linkedin.com/company/middlefund/"
              >LinkedIn&nbsp;<img
                src="/Assets/icons8-linkedin-circled-24.png"
                style="vertical-align: middle; display: inline-block" /></a
            ><br />
            Email Us |
            <a href="mailto:info@middlefund.co"
              ><img
                src="/Assets/icons8-mail-24.png"
                style="vertical-align: middle; display: inline-block"
              />info@middlefund.co</a
            >
          </div>
        </div>
      </div>
    </header>
    <main class=""></main>
    <footer class=""></footer>
    <!-- javascript for non-blocking -->
    <script src="/javascript/index.js"></script>
  </body>
</html>
