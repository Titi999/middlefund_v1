<?php 
    include 'investor/avatarInitials.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="CSS/index.css">
        <link rel="stylesheet" href="CSS/tailwind.css">
        <link rel="icon" href="Assets/MiddlefundLogo.png">
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/plugins/CSSPlugin.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/easing/EasePack.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenLite.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TimelineLite.min.js"></script>
        <title>MIDDLEFUND</title>
    </head>  
    <body>
		<div class="part1">
	    <header>
		    <nav class="navigation">
			    <div class="logo">
				    <h1><img src="Assets/MiddlefundLogo.png" width="90"></h1>
			    </div>
                <?php 
                    session_start();
                    if(empty(isset($_SESSION['username']))){
                        ?>
                    <ul class="menu-list">
                        <li><a href="SignInUpNew/signUp.php">Join</a></li>
                        <li><a href="SignInUpNew/index.php">Login</a></li>
                    </ul>

                    <div class="humbarger">
                        <div class="bar"></div>
                        <div class="bar2 bar"></div>
                        <div class="bar"></div>
                    </div>
                    <?php }
                    else{
                        ?>
                <div class="relative" x-data="{ isOpen: false }" id="profileImage">
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
                <div class="absolute right-0 p-1 bg-green-400 rounded-full bottom-3 animate-ping"></div>
                <div class="absolute right-0 p-1 bg-green-400 border border-white rounded-full bottom-3"></div>

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
                      <a href="settings.php" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Settings</a>
                    </li>
                    <li>
                      <a href="#" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Another Link</a>
                    </li>
                  </ul> -->
                  <div class="flex items -center justify-center p-4 text-blue-700 underline border-t">
                    <a href="../SignInUpNew/logout.php">Logout</a>
                  </div>
                </div>
              </div>
                        <!--<ul class="menu-list">
                        <li><a href="signUpIn/signup.php"></a><?php echo $_SESSION['username']?></li>
                        <li><a href="signUpIn/logout.php">Logout</a></li>
                    </ul>

                    <div class="humbarger">
                        <div class="bar"></div>
                        <div class="bar2 bar"></div>
                        <div class="bar"></div>
                    </div> -->
                    <?php
                    }
                ?>
		    </nav>
		    <div class="intro-section" id="home">
			    <div class="intro-content">
				    <h1>MIDDLEFUND</h1>
				    <h6>We provide a platform that helps startups reach a global<br> 
						audience through entrepreneurship and investment. We help them build<br> 
						everything they need to succeed including pitch development, investor research and easy access to funding
					</h6>
			    </div>
		    </div>	
	    </header>
		<div class="cards">
			<div class="card">
				<div class="moveDown">REGISTER TO GET ACCESS TO OUR PORTFOLIO OF STARTUPS
					CHANGING THE WORLD<br><br>
					<a href="investor/index.php" class="investorButton">INVESTORS</a>
				</div>
			</div>
			<div class="card">
				<div class="moveDown">REGISTER TO GET ACCESS TO OUR POOL OF RESOURCES
					AND INVESTORS<br><br>
					<a href="startup/myindex.php" class="startupButton">STARTUPS</a>
				</div>
			</div>  
		</div>
		<div class="blogMain">
			<div class = "blogBtn">
			<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="goo">
			  <defs>
				<filter id="goo">
				  <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
				  <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
				  <feComposite in="SourceGraphic" in2="goo"/>
				</filter>
			  </defs>
			</svg>
			
			<span class="button--bubble__container">
			  <a href="https://middlefund.substack.com" class="button button--bubble" target="_blank">
				Blog
			  </a>
			  <span class="button--bubble__effect-container">
				<span class="circle top-left"></span>
				<span class="circle top-left"></span>
				<span class="circle top-left"></span>
			
				<span class="button effect-button"></span>
			
				<span class="circle bottom-right"></span>
				<span class="circle bottom-right"></span>
				<span class="circle bottom-right"></span>
			  </span>
			</span>
			</div>
			</div>
			<br>
		</div>
		<section class="intro">
			<div class="introcontainer">
			  <h1>HOW IT WORKS</h1>
			</div>
		  </section>
		<div class="worksContainer">
			<div class="borderWaves">
				<p class="numbering">I<p>
				<p class="worksContent">
					Submitting your pitch is the first review process. If we find your 
					deck or business plan to fit any of our investors' portfolios. 
					We will send it to them directly. Your pitch will also be listed on the general
					 startup page where  verified investors will have access to.<br><br></p></div>
			  <div class="borderWaves">
				<p class="numbering">II<p>
				<p class="worksContent">
					If an investor is interested you are automatically sent an email to notify you and the next review process can begin. 
					This is where the investor asks you questions they might need answers to, if you reach this stage, Congratulations!<br><br><br></p>
			  </div>
			  <div class="borderWaves">
				<p class="numbering">III<p>
				<p class="worksContent">

					After the second review process, if all questions have been answered then you should expect a term sheet sent intto your inbox within 3-5 business working days. 
					An investor can decide to pull their investment even after term sheets have been agreed upon. A term sheet does not represent a contract.</p></div>
		</div><br><br><br>
		   <!--
		  <section class="timeline">
			<ul>
			  <li>
				<div>
				  <time>STEP 1</time>Submitting your pitch is the first review process. 
				  If we find your deck or business plan to fit any of our investors' portfolios. 
				  We will send it to them directly. 
				  Your pitch will also be listed on the general startup page where verified investors will have access t0
				</div>
			  </li>
			  <li>
				<div>
				  <time>STEP 2</time>If an investor is interested you are automatically sent an email to notify you and dthe next review process can begin. 
				  This is where the investor asks you questions they might need answers to, if you reach this stage, Congratulations!
				</div>
			  </li>
			  <li>
				<div>
				  <time>STEP 3</time>After the second review process, 
				  if all questions have been answered then you should expect a term sheet sent intto your inbox within 3-5 business working days. 
				  An investor can decide to pull their investment even after term sheets have been agreed upon. A term sheet does not represent a contract.		
				</div>
			  </li>
			</ul>
		  </section> -->
		  <div class="pg-footer">
			<footer class="footer">
			  <svg class="footer-wave-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 100" preserveAspectRatio="none">
				<path class="footer-wave-path" d="M851.8,100c125,0,288.3-45,348.2-64V0H0v44c3.7-1,7.3-1.9,11-2.9C80.7,22,151.7,10.8,223.5,6.3C276.7,2.9,330,4,383,9.8 c52.2,5.7,103.3,16.2,153.4,32.8C623.9,71.3,726.8,100,851.8,100z"></path>
			  </svg>
			  <div class="footer-content">
				<div class="footer-content-column">
				  <div class="footer-logo">
					<a class="footer-logo-link" href="#">
					  <span class="hidden-link-text"></span>
					  <h3>Middlefund</h3>
					  
					</a>
				  </div>
				  <br>
				  <hr>
				  <div class="footer-menu">
					<ul id="menu-get-started" class="footer-menu-list">
					  <li id="menu-item-173730" class="menu-item menu-item-type-post_type menu-item-object-product menu-item-173730">
					   Contact Us | <a href="https://www.instagram.com/middlefund/">Instagram <img src="Assets/icons8-instagram-24.png" style="vertical-align: middle;
						display: inline-block;"/></a> &nbsp;&nbsp;
					   <a href="#">Facebook&nbsp;<img src="Assets/icons8-facebook-24.png" style="vertical-align: middle;
						display: inline-block;"/></a>&nbsp;&nbsp;
					    <a href="https://twitter.com/middlefund">Twitter&nbsp;<img src="Assets/icons8-twitter-circled-24.png" style="vertical-align: middle;display: inline-block;"/></a> &nbsp;&nbsp;
						<a href="https://www.linkedin.com/company/middlefund/">LinkedIn&nbsp;<img src="Assets/icons8-linkedin-circled-24.png" style="vertical-align: middle;display: inline-block;"/></a>
					  </li><br>
					  <li id="menu-item-173728" class="menu-item menu-item-type-post_type menu-item-object-product menu-item-173728">
					   About Us |&nbsp;&nbsp;<a href="https://middlefund.gitbook.io/product-docs/">Legal Library</a></li><br>
					  <li id="menu-item-173727" class="menu-item menu-item-type-post_type menu-item-object-product menu-item-173727">
						Email Us | <a href="mailto:info@middlefund.co"><img src="Assets/icons8-mail-24.png" style="vertical-align: middle;display: inline-block;"/>info@middlefund.co</a>
					  </li>
					</ul>
				  </div>
				</div>
			  </div>
			  <div class="footer-copyright">
				<div class="footer-copyright-wrapper">
				  <p class="footer-copyright-text">
					<a class="footer-copyright-link" href="#" target="_self"> ©2021. | MiddleFund. | All rights reserved. </a>
				  </p>
				</div>
			  </div>
			</footer>
		  </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
    <script src="Javascript/index.js"></script>
</html>