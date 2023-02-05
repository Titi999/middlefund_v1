<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php
session_start();
include '../connection.php';
include 'processForm.php';
include 'avatarInitials.php';
include 'investmentSettings.php';
include 'changePassword.php';
$sessionEmail = $_SESSION['email'];

if(empty(isset($_SESSION['username']))){
      header("Location: ../SignInUpNew/index.php");
 }
elseif ($_SESSION['user_type'] == "startup"){
    echo "
						<script>
							$(function(){
								Swal.fire(
										'Only Investor Accounts allowed',
										'Please access the Startup dashboard',
										'info',
								).then(okay => {
								if (okay) {
									window.location.href = '../index.php';
								}
								});

								});
							
						</script>
					";
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Investor Dashboard</title>
   
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css" />
    <link rel="stylesheet" href="assets/css/tailwind.css" />
    <link rel="stylesheet" href="assets/css/settings.css"/>
    <link rel="icon" href="/Assets/MiddlefundLogo.png" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- JS & CSS library of MultiSelect plugin -->
<script src="https://phpcoder.tech/multiselect/js/jquery.multiselect.js"></script>
<link rel="stylesheet" href="https://phpcoder.tech/multiselect/css/jquery.multiselect.css">

   
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'/>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script> 
    
  </head>
  <body>
    <div
      class="flex h-screen overflow-y-hidden bg-white"
      x-data="setup()"
      x-init="$refs.loading.classList.add('hidden')"
    >
      <!-- Loading screen -->
      <div
        x-ref="loading"
        class="fixed inset-0 z-[200] flex items-center justify-center text-white bg-black bg-opacity-50"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
      >
        Loading.....
      </div>
      <!-- Sidebar backdrop -->
      <div
        x-show.in.out.opacity="isSidebarOpen"
        class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
      ></div>
      <!-- Sidebar -->
      <aside
        x-transition:enter="transition transform duration-300"
        x-transition:enter-start="-translate-x-full opacity-30  ease-in"
        x-transition:enter-end="translate-x-0 opacity-100 ease-out"
        x-transition:leave="transition transform duration-300"
        x-transition:leave-start="translate-x-0 opacity-100 ease-out"
        x-transition:leave-end="-translate-x-full opacity-0 ease-in"
        class="
          fixed
          inset-y-0
          z-10
          flex flex-col flex-shrink-0
          w-64
          max-h-screen
          overflow-hidden
          transition-all
          transform
          bg-white
          shadow-lg
          lg:z-auto lg:static lg:shadow-none
        "
        :class="{'-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen}"
      >
        <!-- sidebar header -->
        <div class="flex items-center justify-between flex-shrink-0 p-2" :class="{'lg:justify-center': !isSidebarOpen}">
          <span class="p-2 text-xl font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
            <a href="../index.php"><img src="assets/images/MiddlefundLogo.png" width="100"><span :class="{'lg:hidden': !isSidebarOpen}"></span></a>
          </span>
          <button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
            <svg
              class="w-6 h-6 text-gray-600"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <!-- Sidebar links -->
        <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
          <ul class="p-2 overflow-hidden">
            <li>
              <a
             
              id="current"
                href="index.php"
                class="flex items-center p-2 space-x-2 rounded-md"
                :class="{'justify-center': !isSidebarOpen}"
              >
                <span>
                  <img src="assets/images/icons8-home-42.png" width="25">
                </span>
                <span :class="{ 'lg:hidden': !isSidebarOpen }">Home</span>
              </a>
            </li>
              <br>
            <li>
              <a
                href="viewStartups.php"
                class="flex items-center p-2 space-x-2 rounded-md"
                :class="{'justify-center': !isSidebarOpen}"
              >
                <span>
                  <img src="assets/images/icons8-view-42.png" width="25">
                </span>
                <span :class="{ 'lg:hidden': !isSidebarOpen }">View Startups</span>
              </a>
            </li>
            <br>
            <li>
              <a
              style="background-color:#A49370;" 
                href="settings.php"
                class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
                :class="{'justify-center': !isSidebarOpen}"
              >
                <span>
                  <img src="assets/images/icons8-settings-42.png" width="25">
                </span>
                <span :class="{ 'lg:hidden': !isSidebarOpen }">Settings</span>
              </a>
            </li>

            
            <!-- Sidebar Links... -->
          </ul>
        </nav>
        <!-- Sidebar footer -->
        <div class="flex-shrink-0 p-2 border-t max-h-14">
          <button
            class="
              flex
              items-center
              justify-center
              w-full
              px-4
              py-2
              space-x-1
              font-medium
              tracking-wider
              uppercase
              bg-gray-100
              border
              rounded-md
              focus:outline-none focus:ring
            "
            type="reset" onclick="location.href='../SignInUpNew/logout.php'"
          >
            <span>
              <svg
                class="w-6 h-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                />
              </svg>
            </span>
            <span :class="{'lg:hidden': !isSidebarOpen}"> Logout </span>
          </button>
        </div>
      </aside>

      <div class="flex flex-col flex-1 h-full overflow-hidden">
        <header class="flex-shrink-0 border-b">
          <div class="flex items-center justify-between p-2">
            <!-- Navbar left -->
            <div class="flex items-center space-x-3">
              <span class="p-2 text-xl font-semibold tracking-wider uppercase lg:hidden"><a href="../index.php"><img src="assets/images/MiddlefundLogo.png" width="50"></a></span>
              <!-- Toggle sidebar button -->
              <button @click="toggleSidbarMenu()" class="p-2 rounded-md focus:outline-none">
               <img src="assets/images/icons8-menu-24.png">
              </button>
            </div>

            <!-- Navbar right -->
            <div class="relative flex items-center space-x-3">
                <!-- Notification Menu -->
                <div class="relative" x-data="{ isOpen: false }">
                  <!-- red dot -->
                <!--<div class="absolute right-0 p-1 bg-red-400 rounded-full animate-ping"></div>-->
                 <?php
                    $queryGet =mysqli_query($conn, "SELECT * FROM notification WHERE email = '".$_SESSION['email']."' AND status = 'unread'");
                    $count = mysqli_num_rows($queryGet);
                    ?>
                  <div class="absolute right-0 p-1 bg-red-400 border rounded-full" id="notiNum"><h6 class="notiNum"><?php echo $count ?></h6></div>
                  <button
                    @click="isOpen = !isOpen"
                    class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none focus:ring"
                  >
                    <svg
                      class="w-6 h-6 text-gray-500"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                      />
                    </svg>
                  </button>

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
                      mobileNot
                    "
                    style="padding-right:25px;"

                  >
                    <div class="p-4 font-medium border-b">
                      <span class="text-gray-800">Notification</span>
                    </div>
                    <?php
                    $query = "SELECT * FROM notification WHERE email = '".$_SESSION['email']."' ORDER BY date DESC";
                    $stmtNot = $conn -> prepare($query);
                    $stmtNot ->execute();
                    $resultNot =$stmtNot ->get_result();
                    
                    if((mysqli_num_rows($resultNot) == 0)){
                         ?>
                        <ul class="flex flex-col p-2 my-2 space-y-1 notiUl"  style="min-height:200px; vertical-align: middle; margin-left: 15px">
                        <br><br>
                            No New Notifications
                        </ul>
                        <?php } else{ ?> 
                       
                    <ul class="flex flex-col p-2 my-2 space-y-1 notiUl"  style="max-height:350px; overflow:scroll;">
                    <?php 
                     while ($rowNot=$resultNot->fetch_assoc()) { ?>
                      <li style="line-height: 13px;">
                        <a class="block px-2 py-1 transition rounded-md hover:bg-gray-100">
                         <h3 style="font-size:15px; font-weight:400;"><strong> <?php echo $rowNot['title']; ?></strong></h3><br>
                          <h4 style="font-size:12px; color:black;"><?php echo $rowNot['message']; ?></h4><br>
                                                  </a>
                        <h6 style="font-size:10px; float:left">
                        <img src="https://img.icons8.com/material-outlined/24/000000/time.png"/ width="15"  style="vertical-align: middle; display: inline-block">&nbsp;<?php echo date('F j, Y',strtotime($rowNot['date'])); ?></h6>
                        <?php if($rowNot['status'] == "unread"){    $NotId = $rowNot['id'];?>
                       <!-- <a href=""><h6 style="font-size:10px; float:right">
                        <button onclick="read()"  name="readBtn" id="read"><i class="fas fa-eye"></i>&nbsp;Mark as read</button>
                        </h6></a> -->
                         <a href="read.php?id=<?php echo $NotId; ?>"><h6 style="font-size:10px; float:right">
                        <i class="fas fa-eye"></i>&nbsp;Mark as read
                        </h6></a>
                        <?php } ?>
                      </li><br>
                      <?php
                        }
                        ?>
                    </ul>
                     <div class="flex items-center justify-center p-4 text-blue-700 underline border-t">
                       <a href="clearNotifications.php?email=<?php echo $_SESSION['email']; ?>"  name="readBtn" id="read">Clear All Notifications</a>
                     </div> 
                     <?php } ?>
                  </div>
                </div>


             

              <!-- User Menu -->
              <div class="relative" x-data="{ isOpen: false }">
                 <?php if(empty(isset($_SESSION['user_image']))){ ?>
                <button @click="isOpen = !isOpen" class="p-1 bg-gray-200 rounded-full focus:outline-none focus:ring" id="profileDrop">
                    <?php
                    echo getProfilePicture($_SESSION['username']); ?>
                  <?php } 
                  else{ ?>
                  <button @click="isOpen = !isOpen" class="p-1 bg-gray-200 rounded-full focus:outline-none focus:ring">
                    <img
                    class="object-cover w-8 h-8 rounded-full"
                    src="../Assets/userImages/<?php echo $_SESSION['user_image']?>";
                    alt=""
                  />
                 <?php } ?>
                </button>
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
                  <ul class="flex flex-col p-2 my-2 space-y-1">
                    <li>
                      <a href="settings.php" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Settings</a>
                    </li>
                  </ul>
                  <div class="flex items -center justify-center p-4 text-blue-700 underline border-t">
                    <a href="../SignInUpNew/logout.php">Logout</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>

        <!-- Main content -->
        <main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll" id="mainContainer">
          <!-- Main content header -->
          <section>
        <div class="">
                    <ul class="faq-list">
                    
                        <li>
                            <h4 class="faq-heading">
                           

                            
                            <img src="assets/images/icons8-user-settings-48.png" width="25" style="vertical-align: middle;
                            display: inline-block;"/>&nbsp; &nbsp; &nbsp;Account Settings</h4>
                            <form  action="settings.php" method="post" enctype="multipart/form-data">
                            <button id="b3" style="display:none">A success message!</button>
                                          <!--  <?php if(!empty($msg4)): ?>
                                        <br><br>
                            <div class="<?php echo $css_class4; ?>">
                                <?php echo $msg4;?>
                            </div>
                            <?php endif ?> -->
                            <p class="read faq-text">
                             <?php if(empty(isset($_SESSION['user_image']))){?>
                                        <img src="../Assets/undraw_profile_pic_ic5t.png" onclick="triggerClick()" id="profileDisplay">
                                        <?php }
                                 else{?>
                                        <img src="../Assets/userImages/<?php echo $_SESSION['user_image']?>" onclick="triggerClick()" id="profileDisplay">
                                <?php } ?>
                                        <label>Profile Picture</label>
                                        <input type="file" accept="image/*" name="profileImage" onchange="displayImage(this)" id="profileImage" style="display:none;"><br><br>
                                        <label>Name:</label><br><input type="text" name="userName" value="<?php echo $_SESSION['username'] ?>"><br><br>
                                        <label>Email:</label><br><input type="text" name="userEmail" value="<?php echo $_SESSION['email'] ?>"><br><br>
                                        <label>Location:</label><br><input type="text" name="userLocation" value="<?php echo $_SESSION['location'] ?>" ><br><br>
                                         <button class="update" name="accountBtn">Save Changes</button>
                            </p>
                            </form>
                        </li>
                         
                         
                        <li>
                            <h4 class="faq-heading"><img src="assets/images/icons8-edit-profile-42.png" width="25" style="vertical-align: middle;
                            display: inline-block;"/> &nbsp; &nbsp; &nbsp;Investor Profile Settings</h4>
                            <form method="POST" action="settings.php">
                            <?php if(!empty($msg2)):?>
                                        <br><br>
                            <div class="<? echo $css_class2; ?>">
                                <?php echo $msg2;?>
                            </div>
                            <?php endif ?>
                            <p class="read faq-text">
                             <?php 
                             $investmentResult = "SELECT * FROM investor WHERE email = '".$_SESSION['email']."'";
                             $records = mysqli_query($conn, $investmentResult);
                             $data = mysqli_fetch_array($records);
                            
                                    ?>

                                        <label>Commitment ($USD):</label><br>
                                        <input name="commitment" type="text" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="$1,000,000.00" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $data['commitment']; ?>"><br><br>
            <label>Investment Stages:</label><br>
        <select name="interests[]" multiple id="languageSelect2" required>
                <option value="Idea Stage" <?php if(strpos($data['investmentStages'], 'Idea Stage') !== false ){ ?> selected <?php } ?> >Idea Stage</option>
                <option value="Minimum Viable Product (MVP)" <?php if(strpos($data['investmentStages'], 'Minimum Viable Product (MVP)') !== false ){ ?> selected <?php } ?>>Minimum Viable Product (MVP)</option>
                <option value="Pre Seed(Pre Revenue)" <?php if(strpos($data['investmentStages'], 'Pre Seed(Pre Revenue)') !== false ){ ?> selected <?php } ?>>Pre Seed(Pre Revenue)</option>
                <option value="Pre Seed(Pre Revenue with Traction)" <?php if(strpos($data['investmentStages'], 'Pre Seed(Pre Revenue with Traction)') !== false ){ ?> selected <?php } ?>>Pre Seed(Pre Revenue with Traction)</option>
                <option value="Early Stage" <?php if(strpos($data['investmentStages'], 'Early Stage') !== false ){ ?> selected <?php } ?>>Early Stage</option>
                <option value="Seed Stage" <?php if(strpos($data['investmentStages'], 'Seed Stage') !== false ){ ?> selected <?php } ?>>Seed Stage</option>
                <option value="Series A+" <?php if(strpos($data['investmentStages'], 'Series A+') !== false ){ ?> selected <?php } ?>>Series A+</option>

        </select></br>
                                        <label>Interests:</label><br>
            <select name="interests[]" multiple id="languageSelect" required>
            <option value="Advertising Technology (ADTECH)" <?php if(strpos($data['interests'], 'Advertising Technology (ADTECH)') !== false ){ ?> selected <?php } ?>>Advertising Technology (ADTECH)</option>
            <option value="Apparel and Accessories" <?php if(strpos($data['interests'], 'Apparel and Accessories') !== false ){ ?> selected <?php } ?>>Apparel and Accessories</option>
            <option value="Artificial Intelligence" <?php if(strpos($data['interests'], 'Artificial Intelligence') !== false ){ ?> selected <?php } ?>>Artificial Intelligence</option>
            <option value="Biotech" <?php if(strpos($data['interests'], 'Biotech') !== false ){ ?> selected <?php } ?>>Biotech</option>
            <option value="Blockchain" <?php if(strpos($data['interests'], 'Blockchain') !== false ){ ?> selected <?php } ?>>Blockchain</option>
            <option value="Web 3.0" <?php if(strpos($data['interests'], 'Web 3.0') !== false ){ ?> selected <?php } ?>>Web 3.0</option>
            <option value="Agriculture" <?php if(strpos($data['interests'], 'Agriculture') !== false ){ ?> selected <?php } ?>>Agriculture</option>
            <option value="Climate Focused" <?php if(strpos($data['interests'], 'Climate Focused') !== false ){ ?> selected <?php } ?>>Climate Focused</option>
            <option value="Crypto" <?php if(strpos($data['interests'], 'Crypto') !== false ){ ?> selected <?php } ?>>Crypto</option>
            <option value="Cybersecurity" <?php if(strpos($data['interests'], 'Cybersecurity') !== false ){ ?> selected <?php } ?>>Cybersecurity</option>
            <option value="Delivery Service" <?php if(strpos($data['interests'], 'Delivery Service') !== false ){ ?> selected <?php } ?>>Delivery Service</option>
            <option value="Drug development" <?php if(strpos($data['interests'], 'Drug development') !== false ){ ?> selected <?php } ?>>Drug development</option>
            <option value="E- commerce" <?php if(strpos($data['interests'], 'E-commerce') !== false ){ ?> selected <?php } ?>>E-commerce</option>
            <option value="Educational Tech (EDTECH)" <?php if(strpos($data['interests'], 'Educational Tech (EDTECH)') !== false ){ ?> selected <?php } ?>>Educational Tech (EDTECH)</option>
            <option value="Financial Technology (FINTECH)" <?php if(strpos($data['interests'], 'Financial Technology (FINTECH)') !== false ){ ?> selected <?php } ?>>Financial Technology (FINTECH)</option>
            <option value="Food & Groceries" <?php if(strpos($data['interests'], 'Food & Groceries') !== false ){ ?> selected <?php } ?>>Food & Groceries</option>
            <option value="Gaming" <?php if(strpos($data['interests'], 'Gaming') !== false ){ ?> selected <?php } ?>>Gaming</option>
            <option value="Health and Wellness" <?php if(strpos($data['interests'], 'Health and Wellness') !== false ){ ?> selected <?php } ?>>Health and Wellness</option>
            <option value="Health tech" <?php if(strpos($data['interests'], 'Health tech') !== false ){ ?> selected <?php } ?>>Health tech</option>
            <option value="Machinery & Equipment" <?php if(strpos($data['interests'], 'Machinery & Equipment') !== false ){ ?> selected <?php } ?>>Machinery & Equipment</option>
            <option value="On Demand Services (Food, Products, Skills)" <?php if(strpos($data['interests'], 'On Demand Services (Food, Products, Skills)') !== false ){ ?> selected <?php } ?>>On Demand Services (Food, Products, Skills)</option>
            <option value="Property Tech (PROPTECH)" <?php if(strpos($data['interests'], 'Property Tech (PROPTECH)') !== false ){ ?> selected <?php } ?>>Property Tech (PROPTECH)</option>
            <option value="Real Estate" <?php if(strpos($data['interests'], 'Real Estate') !== false ){ ?> selected <?php } ?>>Real Estate</option>
            <option value="Shared Mobility" <?php if(strpos($data['interests'], 'Shared Mobility') !== false ){ ?> selected <?php } ?>>Shared Mobility</option>
            <option value="Sustainability" <?php if(strpos($data['interests'], 'Sustainability') !== false ){ ?> selected <?php } ?>>Sustainability</option>
            <option value="Web 3.0 & Metaverse" <?php if(strpos($data['interests'], 'Web 3.0 & Metaverse') !== false ){ ?> selected <?php } ?>>Web 3.0 & Metaverse</option>
        </select></br></br>
                     <button class="update" name="updateInvestment">Save Changes</button>
                            </p>
                                         
                            </form>
                        </li>
                        <li>
                            <h4 class="faq-heading"><img src="assets/images/icons8-security-configuration-42.png" width="25" style="vertical-align: middle;
                            display: inline-block;"/> &nbsp; &nbsp; &nbsp;Password and Security </h4>
                            <form method="POST" action="settings.php">
                                              <?php if(!empty($msg1)):?>
                                              <br><br>
                            <div class="<?php echo $css_class1; ?>">
                                <?php echo $msg1;?>
                            </div>
                            <?php endif ?>
                            <p class="read faq-text">
                            <label>Current Password:</label><br><input type="password" name="old" value="<?php echo (isset($_SESSION['old'])) ? $_SESSION['old'] : ''; ?>"><br><br>
                                        <label>New Password:</label><br><input type="password" name="new" value="<?php echo (isset($_SESSION['new'])) ? $_SESSION['new'] : ''; ?>"><br><br>
                                        <label>Confirm New Password:</label><br><input type="password" name="retype" value="<?php echo (isset($_SESSION['retype'])) ? $_SESSION['retype'] : ''; ?>"><br><br>
                                         <button class="update" name="updatePassword">Save Changes</button>
                            </p>
                            </form>
                        </li>
                        <li>
                            <h4 class="faq-heading">
                            <img src="assets/images/icons8-social-network-42.png" width="25" style="vertical-align: middle;
                            display: inline-block;"/> &nbsp; &nbsp; &nbsp;Social Media
                            </h4>
                            <form method="POST" action="settings.php">
                                              <?php if(!empty($msg3)):?>
                                              <br><br>
                            <div class="<?php echo $css_class3; ?>">
                                <?php echo $msg3;?>
                            </div>
                            <?php endif ?>
                            <p class="read faq-text">
                                Insert your social media links<br>
                                        <label>Twitter:</label><br><input type="text" name="twitter" value="<?php echo $data['twitter']; ?>"><br><br>
                                        <label>Instagram</label><br><input type="text" name="instagram" value="<?php echo $data['instagram']; ?>"><br><br>
                                        <label>Facebook</label><br><input type="text" name="facebook" value="<?php echo $data['facebook']; ?>"><br><br>
                                        <label>LinkedIn</label><br><input type="text" name="linkedin" value="<?php echo $data['linkedin']; ?>"><br><br>
                                         <button class="update" name="updateSocials">Save Changes</button>
                            </p>
                        </li>
                    </ul>
                   <!-- <div class="changesDiv">
                     <button class="update">Save Changes</button>
                     </div> -->
                </div>
    </section>
         
        </main>
        <!-- Main footer -->
        <footer class="flex items-center justify-between flex-shrink-0 p-4 border-t max-h-14">
          <div>Middlefund &copy; 2021</div>
        </footer>
      </div>

      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/settings.js"></script>
    <script>
      const setup = () => {
        return {
          loading: true,
          isSidebarOpen: false,
          toggleSidbarMenu() {
            this.isSidebarOpen = !this.isSidebarOpen
          },
          isSettingsPanelOpen: false,
          isSearchBoxOpen: false,
        }
      }
    </script>
    <script>
    function read() {
      $.ajax({
        url:"read.php?id=<?php echo $NotId; ?>", //the page containing php script
        type: "POST", //request type
        success:function(result){
       }
     });
 }
    </script>
  </body>
</html>
