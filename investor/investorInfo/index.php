<?php
include '../connection.php';
session_start();
if(empty(isset($_SESSION['username']))){
     header("Location: ../../SignInUpNew/index.php");
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
									window.location.href = '../../index.php';
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Assets/MiddlefundLogo.png" />
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Investor Information</title>
</head>
<body>
    <form class="pure-form pure-form-aligned" action="investorInfo.php" method="post">
    <div class="heading">
        <h1>We need a little more information</h1>
        <div class="pure-control-group">
        <label>Registering as</label>
        <select class="firstSelect" id="regAs" name="regAs" required>
            <option>Please select</option>
            <option value="Organisation">Organisation</option>
            <option value="Individual">Individual</option>
        </select>
        </div>
    </div>
    <div class="main">
        <div class="grid-item left">
            <div class="pure-control-group">
                <label for="OrgName">Organisation Name</label>
                <input class="textNumber" id="orgName" type="text" placeholder="What organisation do you represent" name="OrgName">
            </div>
            <div class="pure-control-group">
            <label for="position">Position</label>
            <input class="textNumber" id="position" type = "text" placeholder="What is your position in the organisation" name="position">
            </div>
            <div class="pure-control-group">
            <label for="commitment">Commitment</label>
            <input class="textNumber" type="text" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="How much are you looking to commit" name="commitment" required>
            </div>
            <div class="pure-control-group">
            <label for="avg">Average Cheque Size</label>
            <input type="text" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency1" class="textNumber" placeholder="What is the minimum amount you will invest" name="avgChequeSize" required>
            </div>
            <div class="pure-control-group">
            <label for="max">Maximum Cheque Size</label>
            <input type="text" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency2" class="textNumber" placeholder="What is the maximum amount you will invest" name="maxChequeSize" required>
            </div>

        </div>
        <div class="grid-item right">
            <div class="pure-control-group">
                <label for="stage">Investment Stages</label>
                <select type="text" class="multiselect" multiple="multiple" role="multiselect" name="investmentStages[]" required>
                    <option value="Idea Stage">Idea Stage</option>
                    <option value="Minimum Viable Product (MVP)">Minimum Viable Product (MVP)</option>
                    <option value="Pre Seed(Pre Revenue)">Pre Seed(Pre Revenue)</option>
                    <option value="Pre Seed(Pre Revenue with Traction)">Pre Seed(Pre Revenue with Traction)</option>
                    <option value="Early Stage">Early Stage</option>
                    <option value="Seed Stage">Seed Stage</option>
                    <option value="Series A+">Series A+</option>
                </select>
            </div>
            <div class="pure-control-group">
            <label for="interest">Interests</label>
            <select name="interests[]" class="multiselect" multiple="multiple" role="multiselect" required>
                <option value="Advertising Technology (ADTECH)">Advertising Technology (ADTECH)</option>
                <option value="Apparel and Accessories">Apparel and Accessories</option>
                <option value="Artificial Intelligence">Artificial Intelligence</option>
                <option value="Biotech">Biotech</option>
                <option value="Blockchain">Blockchain</option>
                <option value="Web 3.0">Web 3.0</option>
                <option value="Agriculture">Agriculture</option>
                <option value="Climate Focused">Climate Focused</option>
                <option value="Crypto">Crypto</option>
                <option value="Cybersecurity">Cybersecurity</option>
                <option value="Delivery Service">Delivery Service</option>
                <option value="Drug development">Drug development</option>
                <option value="E- commerce">E-commerce</option>
                <option value="Educational Tech (EDTECH)">Educational Tech (EDTECH)</option>
                <option value="Educational Tech (EDTECH)">Educational Tech (EDTECH)</option>
                <option value="Financial Technology (FINTECH)">Financial Technology (FINTECH)</option>
                <option value="Food & Groceries">Food & Groceries</option>
                <option value="Gaming">Gaming</option>
                <option value="Health and Wellness">Health and Wellness</option>
                <option value="Health tech">Health tech</option>
                <option value="Machinery & Equipment">Machinery & Equipment</option>
                <option value="On Demand Services (Food, Products, Skills)">On Demand Services (Food, Products, Skills)</option>
                <option value="Property Tech (PROPTECH)">Property Tech (PROPTECH)</option>
                <option value="Real Estate">Real Estate</option>
                <option value="Shared Mobility">Shared Mobility</option>
                <option value="Sustainability">Sustainability</option>
                <option value="Web 3.0 & Metaverse">Web 3.0 & Metaverse</option>
            </select>
            </div>
            <div class="pure-control-group">
            <label for="twitter">Twitter</label>
            <input type="text" class="textNumber" name="twitter" placeholder="twitter.com/username">
            </div>
            <div class="pure-control-group">
            <label for="linkedIn">LinkedIn</label>
            <input type="text" class="textNumber"  name="linkedIn"placeholder="linkedIn.com/username">
            </div>
        </div>
    </div>
    <div class="submitContainer">
        <input class="submitBtn" name="infoBtn" type="submit">
    </div>
    </form>
    <script src="./index.js"></script>
    <script>
    $('#regAs').change(function() {
    if( $(this).val() == "Individual") {
        $('#orgName').prop( "disabled", true );
        $('#position').prop( "disabled", true );
    } else {       
        $('#orgName').prop( "disabled", false );
        $('#position').prop( "disabled", false );
    }
});
    </script>
</body>
</html>