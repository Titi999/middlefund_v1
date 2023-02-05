<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php
session_start();
include 'avatarInitials.php';
include '../connection.php';
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
    <link rel="stylesheet" href="assets/css/interested.css"/>
    <link rel="icon" href="assets/images/MiddlefundLogo.png">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
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
                href="index.php"
                class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
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
                class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
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
            <div class="success-checkmark">
                <div class="check-icon">
                  <span class="icon-line line-tip"></span>
                  <span class="icon-line line-long"></span>
                  <div class="icon-circle"></div>
                  <div class="icon-fix"></div>
                </div>
              </div>
              <div>
                  <p class="headings">ALL DUE DILLIGENCE FILES AND CONTACT DETAILS WILL BE SENT TO YOUR EMAIL ADDRESS</p><br>
                    <p class="please">PLEASE NOTE:</p>
                    <p class="writings">
                        Investing in startups is high risk, you may lose all your investment if the startup fails<br>

                        We do not give investment advice<br>

                        MiddleFund does not charge management fees <br>

                        MiddleFund will be the middleman to initiate the investment but will not be involved in the day to day activities of the startup or its founders<br>

                        Arrangements can be made between investor, startup and MiddleFund if the investor wants frequent updates on the progress of the startups.<br>


                        A representative from Middlefund will contact you within the next 96 hours to discuss your requirements<br>




                    </p><br>
                    <p class="disclaimer">Please make sure to read our <a href="#" class="lDisclaimer">Disclaimer</a> before you continue</p>
              </div>
            </main>
        <!-- Main footer -->
        <footer class="flex items-center justify-between flex-shrink-0 p-4 border-t max-h-14">
          <div>Middlefund &copy; <?php echo date("Y"); ?></div>
        </footer>
      </div>

      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/interested.js"></script>
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
