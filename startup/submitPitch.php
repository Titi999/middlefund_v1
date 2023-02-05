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
 elseif ($_SESSION['user_type'] == "investor"){
    echo "
						<script>
							$(function(){
								Swal.fire(
										'Only Startup Accounts allowed',
										'Please access the Investor dashboard',
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
    <title> Start Up Portal</title>
    <link rel="icon" href="../Assets/MiddlefundLogo.png">
    <link rel="stylesheet" href="assets/css/tailwind.css" />
    <link rel="stylesheet" href="assets/css/investor.css"/>
    <link rel="stylesheet" href="assets/css/submitPitch.css"/>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css"                integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
      <script src="https://use.fontawesome.com/e34e683bda.js"></script>
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
      id="aside"
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
          w-8
          max-h-screen
          overflow-hidden
          transition-all
          transform
       
          shadow-lg
          lg:z-auto lg:static lg:shadow-none
        "
        :class="{'-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen}"
      >
        <!-- sidebar header -->
        <div class="flex items-center justify-between flex-shrink-0 p-2" :class="{'lg:justify-center': !isSidebarOpen}">
          <span class="p-2 text-xl font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
            <a href="myindex.php"><img src="assets/images/MiddlefundLogo.png" width="120"><span :class="{'lg:hidden': !isSidebarOpen}"></span></a>
          </span>
                  </div>
        <!-- Sidebar links -->
        <nav id="nav" class="flex-1 overflow-hidden hover:overflow-y-auto" style="background-color:#3A3838">
          
        </nav>
        <!-- Sidebar footer -->
      </aside>

      <div class="flex flex-col flex-1 h-full overflow-hidden">
        <header class="flex-shrink-0 border-b" style="color:black;">
          <div class="flex items-center justify-between p-2">
            <!-- Navbar left -->
            <div class="flex items-center space-x-3">
              <span class="p-2 text-xl font-semibold tracking-wider uppercase lg:hidden"><a href="myindex.php"><img src="assets/images/MiddlefundLogo.png" width="50" id="logo"></a></span>
              
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
        <main class="flex-1 max-h-full overflow-hidden overflow-y-scroll">
        <?php 
            $startup = "SELECT * FROM startup WHERE email = '".$_SESSION['email']."'";
            $records = mysqli_query($conn, $startup);
            $data = mysqli_fetch_array($records);
                             
        ?><br>
        <div style="text-align: center;">Status: <?php echo $data['status']; ?>&nbsp<?php if($data['status'] == "unverified"){?><img src="assets/images/icons8-unverified-account-50.png" width="20" style="vertical-align: middle;display: inline-block;"><?php }else if($data['status'] == "awaiting"){?><img src="assets/images/icons8-waiting-64.png" width="20" style="vertical-align: middle;display: inline-block;"><?php }else{?><img src="assets/images/icons8-verified-account-48.png" width="20" style="vertical-align: middle;display: inline-block;"><?php } ?></div>
        <div>
        <?php if($data['status'] == 'awaiting'){?>
        <div style="font-size:x-large; text-align: center; color:#A49370; top:50%; left:50%; position:absolute; transform: translate(-50%, -50%);">Your Startup Pitch is Under Review. We will notify you if accepted or rejected</div>
        <?php }else{?>
        <form class="pure-form pure-form-aligned"  method="post" action="backend.php" enctype='multipart/form-data'>
      <br>
      <h2>Startup Profile</h2>
      <br>
      <div class="profileSection">
        <div>
          <div class="pure-control-group">
            <label for="aligned-name">Startup Name</label>
            <input type="text" id="aligned-name" name="name" value="<?php echo $data['name']; ?>" required/>
          </div>
          <br>
          <div class="pure-control-group">
            <label for="aligned-industry">Startup Industry</label>
            <select name="industry" required>
              <?php if(empty($data['industry'])){ ?>
              <option>What industry do you operate in?</option>
              <?php }?>
              <option value="Advertising Technology (ADTECH)" <?php if($data['industry'] == "Advertising Technology (ADTECH)"){ ?> selected <?php } ?>>Advertising Technology (ADTECH)</option>
<option value="Apparel and Accessories" <?php if($data['industry'] == "Apparel and Accessories"){ ?> selected <?php } ?>>Apparel and Accessories</option>
<option value="Artificial Intelligence" <?php if($data['industry'] == "Artificial Intelligence"){ ?> selected <?php } ?>>Artificial Intelligence</option>
<option value="Biotech" <?php if($data['industry'] == "Biotech"){ ?> selected <?php } ?>>Biotech</option>
<option value="Blockchain" <?php if($data['industry'] == "Blockchain"){ ?> selected <?php } ?>>Blockchain</option>
<option value="Web 3.0" <?php if($data['industry'] == "Web 3.0"){ ?> selected <?php } ?>>Web 3.0</option>
<option value="Agriculture" <?php if($data['industry'] == "Agriculture"){ ?> selected <?php } ?>>Agriculture</option>
<option value="Climate Focused" <?php if($data['industry'] == "Climate Focused"){ ?> selected <?php } ?>>Climate Focused</option>
<option value="Crypto" <?php if($data['industry'] == "Crypto"){ ?> selected <?php } ?>>Crypto</option>
<option value="Cybersecurity" <?php if($data['industry'] == "Cybersecurity"){ ?> selected <?php } ?>>Cybersecurity</option>
<option value="Delivery Service" <?php if($data['industry'] == "Delivery Service"){ ?> selected <?php } ?>>Delivery Service</option>
<option value="Drug development" <?php if($data['industry'] == "Drug development"){ ?> selected <?php } ?>>Drug development</option>
<option value="E-commerce" <?php if($data['industry'] == "E-commerce"){ ?> selected <?php } ?>>E-commerce</option>
<option value="Educational Tech (EDTECH)" <?php if($data['industry'] == "Educational Tech (EDTECH)"){ ?> selected <?php } ?>>Educational Tech (EDTECH)</option>
<option value="Educational Tech (EDTECH)" <?php if($data['industry'] == "Educational Tech (EDTECH)"){ ?> selected <?php } ?>>Educational Tech (EDTECH)</option>
<option value="Financial Technology (FINTECH)" <?php if($data['industry'] == "Financial Technology (FINTECH)"){ ?> selected <?php } ?>>Financial Technology (FINTECH)</option>
<option value="Food & Groceries" <?php if($data['industry'] == "Food & Groceries"){ ?> selected <?php } ?>>Food & Groceries</option>
<option value="Gaming" <?php if($data['industry'] == "Gaming"){ ?> selected <?php } ?>>Gaming</option>
<option value="Health and Wellness" <?php if($data['industry'] == "Health and Wellness"){ ?> selected <?php } ?>>Health and Wellness</option>
<option value="Health tech" <?php if($data['industry'] == "Health tech"){ ?> selected <?php } ?>>Health tech</option>
<option value="Machinery & Equipment" <?php if($data['industry'] == "Machinery & Equipment"){ ?> selected <?php } ?>>Machinery & Equipment</option>
<option value="On Demand Services (Food, Products, Skills)" <?php if($data['industry'] == "On Demand Services (Food, Products, Skills)"){ ?> selected <?php } ?>>On Demand Services (Food, Products, Skills)</option>
<option value="Property Tech (PROPTECH)" <?php if($data['industry'] == "Property Tech (PROPTECH)"){ ?> selected <?php } ?>>Property Tech (PROPTECH)</option>
<option value="Real Estate" <?php if($data['industry'] == "Real Estate"){ ?> selected <?php } ?>>Real Estate</option>
<option value="Shared Mobility" <?php if($data['industry'] == "Shared Mobility"){ ?> selected <?php } ?>>Shared Mobility</option>
<option value="Sustainability" <?php if($data['industry'] == "Sustainability"){ ?> selected <?php } ?>>Sustainability</option>
<option value="Web 3.0 & Metaverse" <?php if($data['industry'] == "Web 3.0 & Metaverse"){ ?> selected <?php } ?>>Web 3.0 & Metaverse</option>           
          </select>
          </div>
          <div class="pure-control-group" id="other-div" style="display:none;">
            <label for="aligned-website">Enter Industry</label>
            <input type="text" id="aligned-website" placeholder="" name="other" value="<?php echo $data['industry']; ?>"/>
          </div>
          <br>
          <div class="pure-control-group">
            <label for="aligned-stage">Startup Stage</label>
            <select name="stage" required>
              <?php if(empty($data['stage'])){ ?>
              <option value="">What stage are you currently at?</option>
              <?php } ?>
              <option value="Idea Stage" <?php if($data['stage'] == "Idea Stage"){ ?> selected <?php } ?>>Idea Stage</option>
            <option value="Minimum Viable Product (MVP)" <?php if($data['stage'] == "Minimum Viable Product (MVP)"){ ?> selected <?php } ?>>Minimum Viable Product (MVP)</option>
            <option value="Pre Seed(Pre Revenue)" <?php if($data['stage'] == "Pre Seed(Pre Revenue)"){ ?> selected <?php } ?>>Pre Seed(Pre Revenue)</option>
            <option value="Pre Seed(Pre Revenue with Traction)" <?php if($data['stage'] == "Pre Seed(Pre Revenue with Traction)"){ ?> selected <?php } ?>>Pre Seed(Pre Revenue with Traction)</option>
            <option value="Early Stage" <?php if($data['stage'] == "Early Stage"){ ?> selected <?php } ?>>Early Stage</option>
            <option value="Seed Stage" <?php if($data['stage'] == "Seed Stage"){ ?> selected <?php } ?>>Seed Stage</option>
            <option value="Series A+" <?php if($data['stage'] == "Series A+"){ ?> selected <?php } ?>>Series A+</option>
            </select>
          </div>
          <br>
          <div class="pure-control-group">
            <label for="aligned-website">Website</label>
            <input type="text" id="aligned-website" placeholder="Leave blank if you do not have a website." name="website" value="<?php echo $data['website']; ?>"/>
          </div>
          <br>
          <div class="pure-control-group">
            <label for="aligned-linkedin">LinkedIn</label>
            <input type="text" id="aligned-linkedin" placeholder="What is your LinkedIn Page or Profile link?" name="linkedIn" value="<?php echo $data['linkedin']; ?>"/>
          </div>
          <br>
          <div class="pure-control-group">
            <label for="aligned-email">Registration Info</label>
            <select name="regInfo">
              <option value="">What is your startup registered as?</option>
              <option value="Sole proprietorship" <?php if($data['regInfo'] == "Sole proprietorship"){ ?> selected <?php } ?>>Sole proprietorship</option>
              <option value="Limited Liability Company (LLC)" <?php if($data['regInfo'] == "Limited Liability Company (LLC)"){ ?> selected <?php } ?>>Limited Liability Company (LLC)</option>
              <option value="S-Corp" <?php if($data['regInfo'] == "S-Corp"){ ?> selected <?php } ?>>S-Corp</option>
              <option value="C-Corp" <?php if($data['regInfo'] == "C-Corp"){ ?> selected <?php } ?>>C-Corp</option>
              <option value="Company Limited by Shares" <?php if($data['regInfo'] == "Company Limited by Shares"){ ?> selected <?php } ?>>Company Limited by Shares</option>
              <option value="Company Unlimited by Shares" <?php if($data['regInfo'] == "Company Unlimited by Shares"){ ?> selected <?php } ?>>Company Unlimited by Shares</option>
              <option value="Company Limited by Guarantee" <?php if($data['regInfo'] == "Company Limited by Guarantee"){ ?> selected <?php } ?>>Company Limited by Guarantee</option>
              <option value="Incorporated Partnership" <?php if($data['regInfo'] == "Incorporated Partnership"){ ?> selected <?php } ?>>Incorporated Partnership</option>
            </select>
          </div>
        </div>
        <div>
          <div class="pure-control-group">
            <label for="aligned-country">Registration Country</label>
            <select name="regCountry" id="selectCountry">
                <?php if(empty($data['regCountry'])){ ?>
              <option value="">What country is your startup registered in?</option>
                <?php } ?>
                <option value="<?php echo $data['regCountry']; ?>" selected><?php echo $data['regCountry']; ?></option>
            </select>
          </div>
          <br>
          <div class="pure-control-group">
            <label for="ownPlaces">Search City</label>
            <input type="text" id="ownPlaces" placeholder="Enter City Information to Autofill" name="place" value=""/>
          </div>
          <br>
          <div class="pure-control-group">
            <label for="ownCountry">Country</label>
            <input type="text" id="ownCountry" name="country" placeholder="Country" value="<?php echo $data['country']; ?>"/>
          </div>
          <br>
          <div class="pure-control-group">
            <label for="ownCity">City</label>
            <input type="text" id="ownCity" name="city" placeholder="City" value="<?php echo $data['city']; ?>"/>
          </div>
          <br>
          <div class="pure-control-group">
            <label for="ownState">Region or State</label>
            <input type="text" id="ownState" name="state" placeholder="State" value="<?php echo $data['state']; ?>"/>
          </div>
          <br>
        </div>
      </div>
      <br><br><br>
      <hr>
      <br><br>
      <h2>Pitch Details</h2>
      <br>
      <div class="profileSection">
        <div>
          <div class="pure-control-group">
            <label for="aligned-name">Raised Amount</label>
            <select name="raised" required>
              <?php if(empty($data['raised'])){ ?>
                <option value="">How much have you raised for your startup?</option>
              <?php }?>
              <option value="No money raised" <?php if($data['raised'] == "No money raised"){ ?> selected <?php } ?>>No money raised</option>
              <option value="Less than $50k" <?php if($data['raised'] == "Less than $50k"){ ?> selected <?php } ?>>Less than $50k</option>
              <option value="Between $50k - $350k" <?php if($data['raised'] == "Between $50k - $350k"){ ?> selected <?php } ?>>Between $50k - $350k</option>
              <option value="Between $350k - $1M" <?php if($data['raised'] == "Between $350k - $1M"){ ?> selected <?php } ?>>Between $350k - $1M</option>
              <option value="More than $1M" <?php if($data['raised'] == "More than $1M"){ ?> selected <?php } ?>>More than $1M</option>
            </select>
          </div><br>
          <div class="pure-control-group">
            <label for="aligned-website">Amount to raise($)</label>
            <input type="text" id="aligned-website" id="currency-field" data-type="currency" placeholder="How much are you looking to raise?" name="intendedRaise" value="<?php echo $data['intended_raise']; ?>"/>
          </div><br>
          <div class="pure-control-group">
            <label for="aligned-industry">Purpose of funds</label>
            <select name="purpose" required>
              <?php if(empty($data['purpose'])){ ?>
              <option value="">What do you want to use this amount for?</option>
              <?php } ?>
              <option value="Research and Development" <?php if($data['purpose'] == "Research and Development"){ ?> selected <?php } ?>>Research and Development</option>
              <option value="Marketing" <?php if($data['purpose'] == "Marketing"){ ?> selected <?php } ?>>Marketing</option>
              <option value="Scaling" <?php if($data['purpose'] == "Scaling"){ ?> selected <?php } ?>>Scaling</option>
              <option value="Launch" <?php if($data['purpose'] == "Launch"){ ?> selected <?php } ?>>Launch</option>
              <option value="New Product" <?php if($data['purpose'] == "New Product"){ ?> selected <?php } ?>>New Product</option>
              <option value="Debts" <?php if($data['purpose'] == "Debts"){ ?> selected <?php } ?>>Debts</option>
              <option value="Others" <?php if($data['purpose'] == "Others"){ ?> selected <?php } ?>>Others</option>
            </select>
          </div><br>
          <div class="pure-control-group">
            <label for="aligned-website">Equity (%)</label>
            <input type="number" id="aligned-website" placeholder="How much equity are you looking to give for this amount?" name="equity" value="<?php echo $data['equity']; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
          </div><br>
        </div>
        <div>
          <div class="pure-control-group" id="textarea">
            <label for="aligned-website">Short Bio</label>
            <textarea name="bio" id="" rows="10" placeholder="Tell us about your startup and what you do."><?php echo $data['bio']; ?></textarea>
          </div><br>
        </div>
      </div>
      <br><br><br>
      <hr>
      <br><br>
      <h2>Representative Details</h2>
      <br>
      <div class="profileSection">
        <div>
          <div class="pure-control-group">
            <label for="aligned-website">Rep’s name</label>
            <input type="text" id="aligned-website" placeholder="Full name of your startup’s representative" name="repName" value="<?php echo $data['rep_name']; ?>"/>
          </div><br>
          <div class="pure-control-group">
            <label for="aligned-website">Position/Role</label>
            <input type="text" id="aligned-website" placeholder="What is your position in the startup?" name="position" value="<?php echo $data['rep_position']; ?>"/>
          </div><br>
          <div class="pure-control-group">
            <label for="aligned-website">LinkedIn</label>
            <input type="text" id="aligned-website" placeholder="We  would love to connect and know more" name="repLinkedin" value="<?php echo $data['rep_linkedin']; ?>"/>
          </div><br>
        </div>
        <div>
          <div class="pure-control-group" id="textarea">
            <label for="aligned-website">Short Bio</label>
            <textarea name="repBio" id="" rows="10" placeholder="Tell us a little bit about the representative"><?php echo $data['rep_bio']; ?></textarea>
          </div><br>
        </div>
      </div>
      <br><br><br>
      <hr>
      <br><br>
      <h2>Supporting documents</h2>
      <br>
      <div class="documents">
        <div>
          <div id="file-upload-form" class="uploader">
            <input id="file-upload" type="file" name="logo" accept="image/*" value="<?php echo $data['logo']; ?>"/>
            <label for="file-upload" id="file-drag">
              <?php if(empty($data['logo'])){?>
              <img id="file-image" src="#" alt="Preview" class="hidden">
              <div id="start">
                <i class="fa fa-upload" aria-hidden="true"></i>
                <div>Drag to drop file or click here to upload</div>
                <div id="notimage" class="hidden">Please select an image</div>
                <!-- <span id="file-upload-btn" class="btn btn-primary">Select a file</span> -->
              </div>
              <?php } else{?>
              <img id="file-image" alt="Preview" src="startupLogo/<?php echo $data['logo']; ?>">
              <div id="start" class="hidden">
                <i class="fa fa-upload" aria-hidden="true"></i>
                <div>Drag to drop file or click here to upload</div>
                <div id="notimage" class="hidden">Please select an image</div>
                <!-- <span id="file-upload-btn" class="btn btn-primary">Select a file</span> -->
              </div>
                    <?php } ?>
              
              <div id="response" class="hidden">
                <div id="messages"></div>
              </div>
            </label>
          </div>
          <div>
            <h4>UPLOAD YOUR LOGO</h4>
            <h6>Upload yourstartup’s logo</h6>
          </div>
        </div>

        <div>
          <div id="file-upload-form" class="uploader">
            <input id="file4-upload" type="file" name="pitchDeck" accept="application/pdf" value="<?php echo $data['pitch_deck']; ?>"/>
            <label for="file4-upload" id="file4-drag">
            <?php if(empty($data['pitch_deck'])){?>
            <embed id="file4-image" src="#" type="application/pdf" width="100px" height="100px" class="hidden"/>
              <!-- <img id="file-image" src="#" alt="Preview" class="hidden"> -->
              <div id="start4">
                <i class="fa fa-upload" aria-hidden="true"></i>
                <div>Drag to drop file or click here to upload</div>
                <div id="notimage4" class="hidden">Please select a pdf file</div>
                <!-- <span id="file-upload-btn" class="btn btn-primary">Select a file</span> -->
              </div>
              <?php } else{?>
              
              <embed id="file4-image" src="./pitchDeck/<?php echo $data['pitch_deck']; ?>" type="application/pdf" width="100px" height="100px" style="text-align:center;"/>
              <div id="start4" class="hidden">
                <i class="fa fa-upload" aria-hidden="true"></i>
                <div>Drag to drop file or click here to upload</div>
                <div id="notimage4" class="hidden">Please select a pdf file</div>
                </div>
               <?php } ?>
              <div id="response4" class="hidden">
                <div id="messages4"></div>
              </div>
            </label>
          </div>
          <div>
            <h4>PITCH DECK</h4>
            <h6>Upload your pdf pitch deck</h6>
          </div>
        </div>

        <div>
          <div id="file3-upload-form" class="uploader">
            <input id="file3-upload" type="file" name="pitchVideo" accept="video/*" value="<?php echo $data['video']; ?>" />
            <label for="file3-upload" id="file3-drag">
              <!-- <img id="file2-image" src="#" alt="Preview" class="hidden"> -->
              <?php if(empty($data['video'])){?>
                <video id="file-video" src="#" alt="Preview" class="hidden"></video>
                <div id="start3">
                <i class="fa fa-upload" aria-hidden="true"></i>
                <div>Drag to drop file or click here to upload</div>
                <div id="notimage3" class="hidden">Please select an image</div>
                <!-- <span id="file-upload-btn" class="btn btn-primary">Select a file</span> -->
              </div>
              <?php } else{?>
                <video id="file-video" src="pitchVideos/<?php echo $data['video']; ?>" style="height:150px; width:300px" alt="Preview" autoplay></video>
                <div id="start3" class="hidden">
                <i class="fa fa-upload" aria-hidden="true"></i>
                <div>Drag to drop file or click here to upload</div>
                <div id="notimage3" class="hidden">Please select an image</div>
                <!-- <span id="file-upload-btn" class="btn btn-primary">Select a file</span> -->
              </div>
              <?php } ?>
              <div id="response3" class="hidden">
                <div id="messages3"></div>
              </div>
            </label>
          </div>
          <div>
            <h4>VIDEO PITCH</h4>
            <h6>This is not required but helps.</h6>
          </div>
        </div>
        <div>
          <div id="file2-upload-form" class="uploader">
            <input id="file2-upload" type="file" name="repID" accept="image/*" value="<?php echo $data['rep_id']; ?>" />
            <label for="file2-upload" id="file2-drag">
            <?php if(empty($data['rep_id'])){?>
              <img id="file2-image" src="#" alt="Preview" class="hidden">
              <div id="start2">
                <i class="fa fa-upload" aria-hidden="true"></i>
                <div>Drag to drop file or click here to upload</div>
                <div id="notimage2" class="hidden">Please select an image</div>
                <!-- <span id="file-upload-btn" class="btn btn-primary">Select a file</span> -->
              </div>
            <?php } else{?>
              <img id="file2-image" src="ID/<?php echo $data['rep_id']; ?>" alt="Preview">
              <div id="start2" class="hidden">
                <i class="fa fa-upload" aria-hidden="true"></i>
                <div>Drag to drop file or click here to upload</div>
                <div id="notimage2" class="hidden">Please select an image</div>
                <!-- <span id="file-upload-btn" class="btn btn-primary">Select a file</span> -->
              </div>
              <?php } ?>
              
              <div id="response2" class="hidden">
                <div id="messages2"></div>
              </div>
            </label>
          </div>
          <div>
            <h4>REPRESENTATIVE’S ID</h4>
            <h6>Upload a government issued ID</h6>
          </div>
        </div>
      </div>
      </div><br><br><br>
      <div class="" id="submitSection">
        <button type="submit" id="btn" name="pitchBtn" class="pure-button pure-button-primary">Submit</button>
    </div>
      <br><br><br>
    </form>
    <?php } ?>
    </div>
         </main>
        <!-- Main footer -->
    <script>
    var countryName ='<?php echo $data['country']; ?> ';
    </script>
    <script src="assets/js/submitPitch.js"></script>
    <script src="assets/js/countrystatecity.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBl4sgRqm-6PHB4dZI_QYnoXZtOqnt_tvI"></script>
<script>
google.maps.event.addDomListener(window, 'load', function () 
{
	var places = new google.maps.places.Autocomplete(document.getElementById('ownPlaces'));
	
	google.maps.event.addListener(places, 'place_changed', function () 
	{
		console.log(places.getPlace());
		var getaddress 	  = places.getPlace();				//alert(getaddress.address_components[0].long_name);
		var whole_address = getaddress.address_components;  //alert(whole_address + 'whole_address');   
		$('#ownCity').val('');
		$('#ownState').val('');
		$('#ownCountry').val('');
		
		
		$.each(whole_address, function(key1, value1) 
		{
			//alert(value1.long_name);
			//alert(value1.types[0]);
			
			
			if((value1.types[0]) == 'locality')
			{
				var prev_long_name_city = value1.long_name;  
				//alert(prev_long_name_city + '__prev_long_name_city');
				$('#ownCity').val(prev_long_name_city);
			}
			
			
			if((value1.types[0]) == 'administrative_area_level_1')
			{
				var prev_long_name_state = value1.long_name;  
				//alert(prev_long_name_state + '__prev_long_name_state');
				$('#ownState').val(prev_long_name_state);
			}
			
			if((value1.types[0]) == 'country')
			{
				var prev_long_name_country = value1.long_name;  
				//alert(prev_long_name_country + '__prev_long_name_country');
				$('#ownCountry').val(prev_long_name_country);
			}
			
			if((value1.types[0]) == 'postal_code')
			{
				var prev_long_name_pincode = value1.long_name;  
				//alert(prev_long_name_pincode + '__prev_long_name_pincode');
				$('#ownPinCode').val(prev_long_name_pincode);
			}
 
		});	
		
	});
});
</script>

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
  function check(elem) {
        // use one of possible conditions
        //  if (elem.selectedIndex == 10)
        alert("Hello");
       if (elem.value == 'Other')
         {
            document.getElementById("other-div").style.display = 'block';
        } else {
            document.getElementById("other-div").style.display = 'none';
        }
    }
    </script>
  </body>
</html>
