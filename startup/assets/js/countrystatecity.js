
function ajaxCall() {
    this.send = function(data, url, method, success, type) {
        type = type||'json';
        var successRes = function(data) {
            success(data);
        }

        var errorRes = function(e) {
            console.log(e);
            //alert("Error found \nError Code: "+e.status+" \nError Message: "+e.statusText);
            //jQuery('#loader').modal('hide');
        }
        jQuery.ajax({
            url: url,
            type: method,
            data: data,
            success: successRes,
            error: errorRes,
            dataType: type,
            timeout: 60000
        });

    }

}

function locationInfo() {
    var rootUrl = "https://geodata.solutions/api/api.php";
    //now check for set values
    var addParams = '';
    if(jQuery("#gds_appid").length > 0) {
        addParams += '&appid=' + jQuery("#gds_appid").val();
    }
    if(jQuery("#gds_hash").length > 0) {
        addParams += '&hash=' + jQuery("#gds_hash").val();
    }

    var call = new ajaxCall();

    this.confCity = function(id) {
     //   console.log(id);
     //   console.log('started');
        var url = rootUrl+'?type=confCity&countryId='+ jQuery('#countryId option:selected').attr('countryid') +'&stateId=' + jQuery('#stateId option:selected').attr('stateid') + '&cityId=' + id;
        var method = "post";
        var data = {};
        call.send(data, url, method, function(data) {
            if(data){
                //    alert(data);
            }
            else{
                //   alert('No data');
            }
        });
    };


    this.getCities = function(id) {
        jQuery(".cities option:gt(0)").remove();
        //get additional fields
        var stateClasses = jQuery('#cityId').attr('class');

        var cC = stateClasses.split(" ");
        cC.shift();
        var addClasses = '';
        if(cC.length > 0)
        {
            acC = cC.join();
            addClasses = '&addClasses=' + encodeURIComponent(acC);
        }
        var url = rootUrl+'?type=getCities&countryId='+ jQuery('#countryId option:selected').attr('countryid') +'&stateId=' + id + addParams + addClasses;
        var method = "post";
        var data = {};
        jQuery('.cities').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function(data) {
            jQuery('.cities').find("option:eq(0)").html("Select City");
            if(data.tp == 1){
                var listlen = Object.keys(data['result']).length;

                if(listlen > 0)
                {
                    jQuery.each(data['result'], function(key, val) {

                        var option = jQuery('<option />');
                        option.attr('value', val).text(val);
                        jQuery('.cities').append(option);
                    });
                }
                else
                {
                    var usestate = jQuery('#stateId option:selected').val();
                    var option = jQuery('<option />');
                    option.attr('value', usestate).text(usestate);
                    option.attr('selected', 'selected');
                    jQuery('.cities').append(option);
                }

                jQuery(".cities").prop("disabled",false);
            }
            else{
                alert(data.msg);
            }
        });
    };

    this.getStates = function(id) {
        jQuery(".states option:gt(0)").remove();
        jQuery(".cities option:gt(0)").remove();
        //get additional fields
        var stateClasses = jQuery('#stateId').attr('class');

        var cC = stateClasses.split(" ");
        cC.shift();
        var addClasses = '';
        if(cC.length > 0)
        {
            acC = cC.join();
            addClasses = '&addClasses=' + encodeURIComponent(acC);
        }
        var url = rootUrl+'?type=getStates&countryId=' + id + addParams  + addClasses;
        var method = "post";
        var data = {};
        jQuery('.states').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function(data) {
            jQuery('.states').find("option:eq(0)").html("Select State");
            if(data.tp == 1){
                jQuery.each(data['result'], function(key, val) {
                    var option = jQuery('<option />');
                    option.attr('value', val).text(val);
                    option.attr('stateid', key);
                    jQuery('.states').append(option);
                });
                jQuery(".states").prop("disabled",false);
            }
            else{
                alert(data.msg);
            }
        });
    };

    this.getCountries = function() {
        //get additional fields
        var countryClasses = jQuery('#countryId').attr('class');

        var cC = countryClasses.split(" ");
        cC.shift();
        var addClasses = '';
        if(cC.length > 0)
        {
            acC = cC.join();
            addClasses = '&addClasses=' + encodeURIComponent(acC);
        }

        var presel = false;
        var iip = 'N';
        jQuery.each(cC, function( index, value ) {
            if (value.match("^presel-")) {
                presel = value.substring(7);

            }
            if(value.match("^presel-byi"))
            {
                var iip = 'Y';
            }
        });


        var url = rootUrl+'?type=getCountries' + addParams + addClasses;
        var method = "post";
        var data = {};
        jQuery('.countries').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function(data) {
              
            jQuery('.countries').find("option:eq(0)").html(countryName);

            if(data.tp == 1){
                if(presel == 'byip')
                {
                    presel = data['presel'];
                    console.log('2 presel is set as ' + presel);
                }


                if(jQuery.inArray("group-continents",cC) > -1)
                {
                    var $select = jQuery('.countries');
                    console.log(data['result']);
                    jQuery.each(data['result'], function(i, optgroups) {
                        var $optgroup = jQuery("<optgroup>", {label: i});
                        if(optgroups.length > 0)
                        {
                            $optgroup.appendTo($select);
                        }

                        jQuery.each(optgroups, function(groupName, options) {
                            var coption = jQuery('<option />');
                            coption.attr('value', options.name).text(options.name);
                            coption.attr('countryid', options.id);
                            if(presel) {
                                if (presel.toUpperCase() == options.id) {
                                    coption.attr('selected', 'selected');
                                }
                            }
                            coption.appendTo($optgroup);
                        });
                    });
                }
                else
                {
                    jQuery.each(data['result'], function(key, val) {
                        var option = jQuery('<option />');
                        option.attr('value', val).text(val);
                        option.attr('countryid', key);
                        if(presel)
                        {
                            if(presel.toUpperCase() ==  key)
                            {
                                option.attr('selected', 'selected');
                            }
                        }
                        jQuery('.countries').append(option);
                    });
                }
                if(presel)
                {
                    jQuery('.countries').trigger('change');
                }
                jQuery(".countries").prop("disabled",false);
            }
            else{
                alert(data.msg);
            }
        });
    };

}

jQuery(function() {
    var loc = new locationInfo();
    loc.getCountries();
    jQuery(".countries").on("change", function(ev) {
        var countryId = jQuery("option:selected", this).attr('countryid');
        if(countryId != ''){
            loc.getStates(countryId);
        }
        else{
            jQuery(".states option:gt(0)").remove();
        }
    });
    jQuery(".states").on("change", function(ev) {
        var stateId = jQuery("option:selected", this).attr('stateid');
        if(stateId != ''){
            loc.getCities(stateId);
        }
        else{
            jQuery(".cities option:gt(0)").remove();
        }
    });

    jQuery(".cities").on("change", function(ev) {
        var cityId = jQuery("option:selected", this).val();
        if(cityId != ''){
            loc.confCity(cityId);
        }
    });
});



var select = document.getElementById("selectCountry");
    
var countries = new Array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burma", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo, Democratic Republic", "Congo, Republic of the", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Mongolia", "Morocco", "Monaco", "Mozambique", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Norway", "Oman", "Pakistan", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Samoa", "San Marino", " Sao Tome", "Saudi Arabia", "Senegal", "Serbia and Montenegro", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");
    
//console.log(countries);
//console.log(select);
    
for (var i = 0; i < countries.length; i++) {
    
    var option = document.createElement("option"); 
  //for every turn of the loop create an option tag
    //console.log(option);
    var txt = document.createTextNode(countries[i]); 
  //for every turn of the loop create the inner text
    //console.log(txt);
    option.appendChild(txt); 
  //for every turn of the loop put the words from txt inside the <option> tags
    //console.log(option);
    option.setAttribute("value",countries[i]); //for every turn of the loop set the value attribute to corresponding country name
    //console.log(option);
    select.insertBefore(option,select.lastChild);
    //console.log(select);
    
}

document.addEventListener ('DOMContentLoaded', function() {
    //console.log('DOM fully loaded and parsed');
    document.querySelector('select[name="selectCountry"]').onchange = alertCountry;
     }, false);
  