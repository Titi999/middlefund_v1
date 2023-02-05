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
    <link rel="stylesheet" href="./css/startReading.css" />
    <link rel="stylesheet" href="./css/tailwind.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css"
    />
    <link rel="stylesheet" href="assets/css/tailwind.css" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js"
      defer
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.1/web-animations.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.3.1/smooth-scrollbar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

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
            <a href="index.php" class="navmenu-button">
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
                <span class="text-gray-800"><?php echo $_SESSION['username']?></span>
                <span class="text-sm text-gray-400"><?php echo $_SESSION['email']?></span>
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
        <!-- header content -->
      </div>
    </header>
    <div class="menu-wrapper show">
      <div class="menu-icon-wrapper">
        <a href="" class="menu-icon active"></a>
      </div>
      <br />
      <ul class="menu">
        <li>
          <span
            ><img
              src="assets/images/465051_categories_list_configuration_document_file_icon.png"
              width="20"
              style="vertical-align: middle; display: inline-block; fill: white"
            />&nbsp; Categories</span
          >
        </li>
        <br />
        <!-- <li>
          <a href=""><i class="fab fa-html5"></i> HTML</a>
        </li> -->
        <li>
          <a>
            Starting Up
            <span class="cavet"><i class="fas fa-caret-right"></i></span
          ></a>
          <ul>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i> Registering your Startup</a
              >
            </li>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i>Startup Legal Documents</a
              >
            </li>
            <li>
              <a href="readNow.php"><i class="fas fa-glasses"></i>Startup Glossary</a>
            </li>
          </ul>
        </li>
        <li>
          <a>
            Fundraising
            <span class="cavet"><i class="fas fa-caret-right"></i></span
          ></a>
          <ul>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i> What is Venture Capital</a
              >
            </li>
            <li>
              <a href="readNow.php"><i class="fas fa-glasses"></i>How to raise fundingg</a>
            </li>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i>Finding the right investor</a
              >
            </li>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i>Paying back an investor</a
              >
            </li>
          </ul>
        </li>
        <li>
          <a>
            Scaling
            <span class="cavet"><i class="fas fa-caret-right"></i></span
          ></a>
          <ul>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i> What is Venture Capital</a
              >
            </li>
            <li>
              <a href="readNow.php"><i class="fas fa-glasses"></i>How to raise fundingg</a>
            </li>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i>Finding the right investor</a
              >
            </li>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i>Paying back an investor</a
              >
            </li>
          </ul>
        </li>
        <li>
          <a>
            Exit
            <span class="cavet"><i class="fas fa-caret-right"></i></span
          ></a>
          <ul>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i> What is Venture Capital</a
              >
            </li>
            <li>
              <a href="readNow.php"><i class="fas fa-glasses"></i>How to raise fundingg</a>
            </li>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i>Finding the right investor</a
              >
            </li>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i>Paying back an investor</a
              >
            </li>
          </ul>
        </li>
        <li>
          <a>
            Founder Knowledge
            <span class="cavet"><i class="fas fa-caret-right"></i></span
          ></a>
          <ul>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i> What is Venture Capital</a
              >
            </li>
            <li>
              <a href="readNow.php"><i class="fas fa-glasses"></i>How to raise fundingg</a>
            </li>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i>Finding the right investor</a
              >
            </li>
            <li>
              <a href="readNow.php"
                ><i class="fas fa-glasses"></i>Paying back an investor</a
              >
            </li>
          </ul>
        </li>

        <!-- <li>
          <a href=""><i class="fab fa-php"></i> PHP</a>
        </li>
        <li>
          <a href=""><i class="fas fa-database"></i> Mysql</a>
        </li>
        <li>
          <a
            ><i class="fab fa-js"></i> Javascript
            <span class="cavet"><i class="fas fa-caret-right"></i></span
          ></a>
          <ul>
            <li>
              <a href=""><i class="fab fa-vuejs"></i> Vue</a>
            </li>
            <li>
              <a
                ><i class="fab fa-react"></i> React
                <span class="cavet"><i class="fas fa-caret-right"></i></span
              ></a>
              <ul>
                <li>
                  <a href=""><i class="fas fa-mobile"></i> React Native</a>
                </li>
                <li>
                  <a href=""><i class="fas fa-glasses"></i> React Augmented</a>
                </li>
              </ul>
            </li>
            <li>
              <a href=""><i class="fab fa-angular"></i> Angular</a>
            </li>
          </ul>
        </li> -->
      </ul>
    </div>
    <svg
      aria-hidden="true"
      style="position: absolute; width: 0; height: 0; overflow: hidden"
      version="1.1"
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
    >
      <defs>
        <symbol id="icon-cross" viewBox="0 0 32 32">
          <title>close</title>
          <path
            d="M31.7 25.7L22 16l9.7-9.7a1 1 0 0 0 0-1.4L27.1.3a1 1 0 0 0-1.4 0L16 10 6.3.3a1 1 0 0 0-1.4 0L.3 4.9a1 1 0 0 0 0 1.4L10 16 .3 25.7a1 1 0 0 0 0 1.4l4.6 4.6a1 1 0 0 0 1.4 0L16 22l9.7 9.7a1 1 0 0 0 1.4 0l4.6-4.6a1 1 0 0 0 0-1.4z"
          />
        </symbol>
      </defs>
    </svg>

    <div class="page" data-modal-state="closed">
      <div class="container">
        <div class="card-slider">
          <div class="card-wrapper">
            <article class="card">
              <picture class="card__background">
                <img src="assets/images/undraw_business_deal_re_up4u.svg" />
              </picture>
              <div class="card__category">INTRODUCING MIDDLEFUND</div>
              <h3 class="card__title">
                Summary : We introduce who exactly we are and what we want to
                accomplish with our platform,
              </h3>
              <a href="readNow.php" class="readNow">Read Now</a>
            </article>
          </div>
          <div class="card-wrapper">
            <article class="card">
              <picture class="card__background">
                <img src="assets/images/undraw_new_ideas_jdea.svg" />
              </picture>
              <div class="card__category">STARTUP GLOSSARY</div>
              <h3 class="card__title">
                Summary: A detailed A-Z thesaurus of words you will definitely
                encounter on your startup journey.
              </h3>
              <a href="readNow.php" class="readNow">Read Now</a>
            </article>
          </div>
          <div class="card-wrapper">
            <article class="card">
              <picture class="card__background">
                <img src="https://source.unsplash.com/random" />
              </picture>
              <div class="card__category"></div>
              <h3 class="card__title"></h3>
              <div class="card__duration"></div>
            </article>
          </div>
          <div class="card-wrapper">
            <article class="card">
              <picture class="card__background">
                <img src="https://source.unsplash.com/random" />
              </picture>
              <div class="card__category"></div>
              <h3 class="card__title"></h3>
              <div class="card__duration"></div>
            </article>
          </div>
          <div class="card-wrapper">
            <article class="card">
              <picture class="card__background">
                <img src="https://source.unsplash.com/random" />
              </picture>
              <div class="card__category"></div>
              <h3 class="card__title"></h3>
              <div class="card__duration"></div>
            </article>
          </div>
        </div>
      </div>
      <div class="footerContainer">
        <div class="buttons-container">
          <a href="#">
            <div class="button facebook">
              <i class="fab fa-facebook-f"></i>
            </div>
          </a>
          <a href="https://twitter.com/middlefund">
            <div class="button twitter">
              <i class="fab fa-twitter"></i>
            </div>
          </a>
          <a href="/https://www.linkedin.com/company/middlefund/">
            <div class="button github">
              <i class="fab fa-linkedin"></i>
            </div>
          </a>
          <a href="https://www.instagram.com/middlefund/">
            <div class="button instagram">
              <i class="fab fa-instagram"></i>
            </div>
          </a>
          <a href="mailto:info@middlefund.co">
            <div class="button codepen">
              <i class="fas fa-envelope"></i>
            </div>
          </a>
        </div>
      </div>

      <div class="overlay"></div>
      <div class="modal-wrapper">
        <div class="modal">
          <button class="modal__close-button" type="button">
            <svg class="icon icon-cross">
              <use xlink:href="#icon-cross"></use>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <script src="javascript/startreading.js"></script>
  </body>
</html>
