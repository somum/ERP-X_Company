<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index.php");
	exit;
}
include 'config.php';
$email=($_SESSION["email"]);

$name=$_SESSION["employee_name"];

$sql = "SELECT * FROM ref_table";
$result = mysqli_query($conn,$sql);

$sql2 = "SELECT sum FROM invoice_count WHERE id=1;";
$result2 = mysqli_query($conn,$sql2);
$row = mysqli_fetch_array($result2);

$count = sprintf('%06d', $row['sum'] + 1);
$invoice_id = "SL $count / 19";

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href='./js/jquery-ui.min.css' type='text/css' rel='stylesheet' >
  <script src="./js/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="./js/jquery-ui.min.js" type="text/javascript"></script>
  <title>Create Invoice</title>
  
  <link rel="stylesheet" type="text/css" href="./css/invoice.css"/>
  <script type="text/javascript" src="js/typeahead.js"></script>

  <style> 
    /*Position and style for the sidebar*/ 

    .sidebar { 
      height: 100%; 
      width: 0; 
      position: fixed; 
      /*Stays in place */ 
      background-color: white; 
      /*green*/ 
      overflow-x: hidden; 
      /*for Disabling horizontal scroll */ 
    } 
    /* Position and style for the sidebar links */ 

    .sidebar a { 
      padding: 10px 10px 10px; 
      font-size: 14px; 
      color: #111; 
      display: block; 
      transition: 0.3s; 
    } 
    /* the links change color when mouse hovers upon them*/ 

    .sidebar a:hover { 
      color: #FFFFFF; 
    } 
    /* Position and style the for cross button */ 

    .sidebar .closebtn { 
      position: absolute; 
      top: 0; 
      right: 25px; 
    } 
    /* Style for the sidebar button */ 

    .openbtn { 
      font-size: 20px; 
      background-color: gray; 
      color: #111; 
      padding: 5px 5px 5px; 
      border: none; 
    } 
        /* the sidebar button changes  
        color when mouse hovers upon it */ 
        .openbtn:hover { 
          color: #FFFFFF; 
        } 

      /* pushes the page content to the right 
      when you open the side navigation */ 

      #main { 
        transition: margin-left .5s; 
        /* If you want a transition effect */ 
        padding: 10px; 
      }
      .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 5px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
      } 
    </style> 

    <style>
      .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 12px 16px;
        z-index: 1;
      }
    </style>

  </head>
  <body>
    <div id="sidebar" class="sidebar">
      <a>
        <img src="./assets/img/brand/sair.png" style="width: 240px;" alt="...">
      </a> 
      <!--the cross button-->
      <ul class="navbar-nav" style="padding-left: 25px; padding-top: 25px;">
        <li class="nav-item" >
          <a class=" nav-link " href=" ./index"> 
            <i class="ni ni-tv-2 text-primary"></i><span style="color: black;
            padding-left: 10px;">Dashboard<span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./viewPassengers">
              <i class="ni ni-single-02 text-orange "></i> <span style="color: black;padding-left: 10px;">View Passengers<span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="./addPassengers">
                <i class="fa fa-user-plus text-green"></i> <span style="color: black; padding-left: 10px;">Add Passengers<span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="./searchPassengers">
                  <i class="ni ni-circle-08 text-blue"></i> <span style="color: black;padding-left: 10px;">Search Passengers<span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="./corporateDetails">
                    <i class="ni ni-archive-2 text-black"></i> <span style="color: black;padding-left: 10px;">Corporate Details<span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="./refDetails">
                      <i class="ni ni-caps-small text-green"></i> <span style="color: black;padding-left: 10px;">Reference Details<span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="./createInvoice">
                        <i class="ni ni-ruler-pencil text-red"></i> <span style="color: black;padding-left: 10px;">Create Invoice<span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="./viewInvoice">
                          <i class="ni ni-bullet-list-67 text-info"></i> <span style="color: black;padding-left: 10px;">View Invoice<span>
                          </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="./officeSearch">
                          <i class="ni ni-bullet-list-67 text-success"></i> <span style="color: black;padding-left: 10px;">Office Invoice<span>
                        </a>
                      </li>

                        <li class="nav-item">
                          <a class="nav-link" href="./logout">
                            <i class="ni ni-button-power text-red"></i> <span style="color: black;padding-left: 10px;">Logout<span>
                            </a>
                          </li>



                        </ul>
                      </div> 
                      <div id="main">    
                        <h2>Create Invoice Details</h2>
                        <button class="button" onclick="sideBarHandle()">...</button>
                        <form method="POST" action="invoiceUp.php" class="register">
                          <div style="float: left;width: 395px;">
                            <label>Reference
                            </label>
                            <input style="text-transform:uppercase " name="reference" id="reference" list="refList"type="text"/>
                            <datalist name="refList" id="refList">
                              <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                <option value="<?php echo $row['reference']?>">
                                <?php  } ?> 
                              </datalist>
                              <label style="margin-top: 5px;">Company
                              </label>
                              <select name="companyRef" id="aioConceptName" style="margin-top: 5px;">
                              	<?php if (strpos($email, 'skylight') == true) {?>
								<?php echo'<option value="SKYLIGHT CORPORATION LTD.">SKYLIGHT CORPORATION LTD.
                                </option>';} ?>
                                <?php if (strpos($email, 'sairbd') == true) {?>
                                <?php echo'<option value="SAIR AIR BD LTD.">SAIR AIR BD LTD.
                                </option>';}?>
                                <?php if (strpos($email, 'himalaya') == true) {?>
                                <?php echo'<option value="HIMALAYA AIRLINES">HIMALAYA AIRLINES
                                </option>';}?>
                              </select>
                              <label >Corp. name
                              </label>
                              <input name="cname" style="text-transform:uppercase" class='company_name' id='username_1' type="text"/>

                            </div>
                            <div style="float: left;width: 350px;">
                              <label>Customer Address
                              </label>
                              <textarea rows="4" name="c_address" style="text-transform:uppercase;width: 230px;" class='c_address' id='salary_1' type="text"></textarea>
                            </div>

                            <div style="float: left;width: 250px;margin-right: 20px;">
                              <label>Invoice no
                              </label>
                              <input style="text-transform:uppercase; width: 130px;" type="text" readonly name="invoice_id" id="invoice_id" value="<?php echo $invoice_id ?>" />

                              <label style="margin-top: 5px;">Invoice date
                              </label>
                              <?php
                              date_default_timezone_set("Asia/Dhaka");
                              ?>
                              <input name="idate" type="date"style="margin-top: 5px;" value="<?php echo date('Y-m-d'); ?>">

                              <label style="margin-top: 5px;">P/O
                              </label>
                              <input name="poNo" style="text-transform:uppercase; width: 130px;margin-top: 5px;" id='poNo' type="text"/>

                              <label style="margin-top: 5px;">P/O Date
                              </label>
                              <input name="poDate" type="date"style="text-transform:uppercase; width: 130px;margin-top: 5px;" id='poDate' type="text"/>
                            </div>

                            <div style="float: left; width: 125px; ">
                              <label style="">Office Invoice
                              </label>
                              <input name="o_invoice[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_invoice' type="text"/>
                              <input name="o_invoice[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_invoice1' type="text"/>
                              <input name="o_invoice[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_invoice2' type="text"/>
                              <input name="o_invoice[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_invoice3' type="text"/>
                              <input name="o_invoice[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_invoice4' type="text"/>
                              <input name="o_invoice[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_invoice5' type="text"/>
                            </div>
                            <div style="float: left; width: 125px">
                              <label style="margin-left: -20px">Amount
                              </label>
                              <input name="o_amount[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_amount' type="number"/>
                              <input name="o_amount[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_amount1' type="number"/>
                              <input name="o_amount[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_amount2' type="number"/>
                              <input name="o_amount[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_amount3' type="number"/>
                              <input name="o_amount[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_amount4' type="number"/>
                              <input name="o_amount[]" style="text-transform:uppercase; width: 110px;margin-top: 2px;" id='o_amount5' type="number"/>
                            </div>
                            <p style="margin-left: 53px;">
                              <label>Customer Names
                              </label>
                              <textarea name="individualName" style="text-transform:uppercase" rows="4" name="individualName"placeholder="1. Mr. X
2. Mr. Y"required></textarea>
                                <div class="calculation" style="margin-left: 1000px;">
                                  <h4 style="margin-left: 130px; color: black;"><b>Amount : </b><span id="oAmountres"></span></h4>
                                </div>
                            </p>

                            <P style="margin-left: 53px;">
                              <label>Sector
                              </label>
                              <input name="sector" style="text-transform:uppercase" type="text"/>
                            </P>
                            <p style="margin-left: 53px;">
                              <label>Airline
                              </label>
                              <input type="text" list="airline1" name="airline" style="text-transform:uppercase" multiple  />
                              <datalist name="airline1" id="airline1">
                                <option value="Air Canada">Air Canada
                                </option>
                                <option value="Air France">Air France
                                </option>
                                <option value="Air India">Air India
                                </option>
                                <option value="AirAsia">AirAsia
                                </option>
                                <option value="APG Airlines">APG Airlines
                                </option>
                                <option value="Air Madagascar">Air Madagascar
                                </option>
                                <option value="Air Mauritius">Air Mauritius
                                </option>
                                <option value="Biman Bangladesh">Biman Bangladesh
                                </option>
                                <option value="Bangkok Airways">Bangkok Airways
                                </option>
                                <option value="China Southern Airlines">China Southern Airlines
                                </option>
                                <option value="China Eastern Airlines">China Eastern Airlines
                                </option>
                                <option value="Cathay Pacific">Cathay Pacific
                                </option>
                                <option value="Delta Air Lines">Delta Air Lines
                                </option>
                                <option value="Emirates">Emirates
                                </option>
                                <option value="Etihad Airways">Etihad Airways
                                </option>
                                <option value="EgyptAir">EgyptAir
                                </option>
                                <option value="Flydubai">Flydubai
                                </option>
                                <option value="Gulf Air">Gulf Air
                                </option>
                                <option value="Himalaya Airlines">Himalaya Airlines
                                </option>
                                <option value="Jet Airways">Jet Airways
                                </option>
                                <option value="Kuwait Airways">Kuwait Airways
                                </option>
                                <option value="Malaysia Airlines">Malaysia Airlines
                                </option>
                                <option value="Maldivian Airline">Maldivian Airline
                                </option>
                                <option value="Malindo Air">Malindo Air
                                </option>
                                <option value="Oman Air">Oman Air
                                </option>
                                <option value="Qatar Airways">Qatar Airways
                                </option>
                                <option value="Qantas Airline">Qantas Airline
                                </option>
                                <option value="Royal Air Maroc">Royal Air Maroc
                                </option>
                                <option value="Regent Airways">Regent Airways
                                </option>
                                <option value="Singapore Airlines">Singapore Airlines
                                </option>
                                <option value="SpiceJet">SpiceJet
                                </option>
                                <option value="Saudia Airline">Saudia Airline
                                </option>
                                <option value="SriLankan Airlines">SriLankan Airlines
                                </option>
                                <option value="Thai Airways">Thai Airways
                                </option>
                                <option value="Turkish Airlines">Turkish Airlines
                                </option>
                                <option value="US-Bangla Airlines">US-Bangla Airlines
                                </option>
                              </datalist>	
                            </p>
                            <p style="margin-left: 53px;">
                              <label>Class
                              </label>
                              <input type="text" list="class1" name="class"/>
                              <datalist name="class1" id="class1">
                                <option value="Economy">
                                  <option value="Business">
                                    <option value="First">
                                    </datalist>


                                  </p>
                                  <P style="margin-left: 53px;">
                                    <label>Ticket No
                                    </label>
                                    <input name="ticketNo" style="text-transform:uppercase" type="text"/>

                                  </P>

                                </fieldset>
                                <fieldset class="row2">
                                  <legend>Fare
                                  </legend>
                                  <p>	
                                   <label for="adultFareLabel" style="margin-top: 6px;">
                                     <input type="checkbox" id="adultFareLabel" />Adult:
                                   </label>
                                   <div id="adultFareDiv" style="display: none">
                                     <input name="adultFare" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999" id="adultFare" class="short"type="number" step=".01"/>

                                     <label class="short">Qty</label>
                                     <input name="adultQty"  onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999" id="adultQty" class="sqty" type="number"/>
                                   </div>

                                   <label for="childFareLabel" style="margin-left: 10px;">
                                     <input type="checkbox" id="childFareLabel" />Child:

                                   </label>
                                   <div id="childFareDiv" style="display: none">
                                     <input name="childFare" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999" id="childFare" class="short"type="number" step=".01"/>
                                     <label class="short">Qty</label>
                                     <input name="childQty" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="childQty" class="sqty" type="number"/>
                                   </div>

                                   <label for="infantFareLabel" style="margin-left: 10px;">
                                    <input type="checkbox" id="infantFareLabel" />Infant:
                                  </label>
                                  <div id="infantFareDiv" style="display: none">
                                    <input name="infantFare" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999" id="infantFare" class="short"type="number" step=".01"/>
                                    <label class="short">Qty</label>
                                    <input name="infantQty" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="infantQty" class="sqty" type="number"/>
                                  </div>
                                </p>
                                <p style="margin-top: 5px;">

                                  <label for="cAdjustmentLabel" style="margin-top: 6px;width:200px">
                                   <input type="checkbox" id="cAdjustmentLabel" />Commercial Adjustment:
                                 </label>
                                 <div id="cPercentageDiv" style="display: none">
                                   <input name="cPercentage" id="cPercentage"class="short"type="number" step=".01"/>
                                   <label class="short">or</label>
                                   <input name="cTk" id="cTk" class="short" type="number"placeholder="in tk"/>
                                 </div>

                                 <div class="calculation" style="margin-left: 900px;">
                                  <h4 style="margin-left: 100px; color: black;"><b> Fare : </b><span id="total_expenses"></span></h4>
                                  <h4 style="margin-left: 100px; color: black;"><b>Commission : </b><span id="com"></span> </h4>
                                </div>
                              </p>
                            </fieldset>
                            <fieldset class="row2">
                              <legend>Tax
                              </legend>
                              <p>
                                <Label style="margin-top: 6px;">Embarkation: </Label>
                                <label for="eAdultFareLabel" style="margin-top: 6px;">
                                 <input type="checkbox" id="eAdultFareLabel" />Adult:
                               </label>
                               <div id="eAdultFareDiv" style="display: none">
                                 <input name="eAdultFare"onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999" id="eAdultFare" class="short"type="number" step=".01"/>
                                 <label class="short">Qty</label>
                                 <input name="eAdultQty" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="eAdultQty" class="sqty" type="number"/>
                               </div>

                               <label for="eChildFareLabel" style="margin-left: 10px;">
                                 <input type="checkbox" id="eChildFareLabel" />Child:

                               </label>
                               <div id="eChildFareDiv" style="display: none">
                                 <input name="eChildFare" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999"id="eChildFare" class="short"type="number" step=".01"/>
                                 <label class="short">Qty</label>
                                 <input name="eChildQty" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="eChildQty" class="sqty" type="number"/>
                               </div>

                               <label for="eInfantFareLabel" style="margin-left: 10px;">
                                <input type="checkbox" id="eInfantFareLabel" />Infant:

                              </label>
                              <div id="eInfantFareDiv" style="display: none">
                                <input name="eInfantFare" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999"id="eInfantFare" class="short"type="number" step=".01"/>
                                <label class="short">Qty</label>
                                <input name="eInfantQty" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="eInfantQty" class="sqty" type="number" />
                              </div>
                              <!----->
                            </p>
                            <p>
                              <Label style="margin-top: 6px;">Travel: </Label>
                              <!---->
                              <label for="tAdultFareLabel" style="margin-top: 6px;">
                               <input type="checkbox" id="tAdultFareLabel" />Adult:
                             </label>
                             <div id="tAdultFareDiv" style="display: none">
                               <input name="tAdultFare"onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999" id="tAdultFare" class="short"type="number" step=".01"/>
                               <label class="short">Qty</label>
                               <input name="tAdultQty" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="tAdultQty" class="sqty" type="number"/>
                             </div>

                             <label for="tChildFareLabel" style="margin-left: 10px;">
                               <input type="checkbox" id="tChildFareLabel" />Child:

                             </label>
                             <div id="tChildFareDiv" style="display: none">
                               <input name="tChildFare" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999"id="tChildFare" class="short"type="number" step=".01"/>
                               <label class="short">Qty</label>
                               <input name="tChildQty" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="tChildQty" class="sqty" type="number" />
                             </div>

                             <label for="tInfantFareLabel" style="margin-left: 10px;">
                              <input type="checkbox" id="tInfantFareLabel" />Infant:

                            </label>
                            <div id="tInfantFareDiv" style="display: none">
                              <input name="tInfantFare"onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999" id="tInfantFare" class="short"type="number" step=".01"/>
                              <label class="short">Qty</label>
                              <input name="tInfantQty" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="tInfantQty" class="sqty" type="number"/>
                            </div>
                          </p>
                          <p>
                           <Label style="margin-top: 6px;">Other: </Label>
                           <!---->
                           <label for="oAdultFareLabel" style="margin-top: 6px;">
                             <input type="checkbox" id="oAdultFareLabel" />Adult:
                           </label>
                           <div id="oAdultFareDiv" style="display: none">
                             <input name="oAdultFare"onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999" id="oAdultFare" class="short"type="number" step=".01"/>
                             <label class="short">Qty</label>
                             <input name="oAdultQty" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="oAdultQty" class="sqty" type="number"/>
                           </div>

                           <label for="oChildFareLabel" style="margin-left: 10px;">
                             <input type="checkbox" id="oChildFareLabel" />Child:

                           </label>
                           <div id="oChildFareDiv" style="display: none">
                             <input name="oChildFare"onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999" id="oChildFare" class="short"type="number" step=".01"/>
                             <label class="short">Qty</label>
                             <input name="oChildQty" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="oChildQty" class="sqty" type="number"/>
                           </div>

                           <label for="oInfantFareLabel" style="margin-left: 10px;">
                            <input type="checkbox" id="oInfantFareLabel" />Infant:

                          </label>
                          <div id="oInfantFareDiv" style="display: none">
                            <input name="oInfantFare" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999"id="oInfantFare" class="short"type="number" step=".01"/>
                            <label class="short">Qty</label>
                            <input name="oInfantQty" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="oInfantQty" class="sqty" type="number"/>
                          </div>

                          <div class="calculation" style="margin-left: 900px;">
                            <h4 style="margin-left: 100px; color: black;"><b>Total Tax : </b><span id="totalTax"></span></h4>   
                          </div>
                        </p>
                      </fieldset>
                      <fieldset class="row2">
                        <legend>Others
                        </legend>
                        <p>
                          <!----->
                          <label for="otherExpense1Label" style="margin-left: 10px;">
                            <input type="checkbox" id="otherExpense1Label" />Purpose:

                          </label>
                          <div id="otherExpense1Div" style="display: none">
                           <input style="text-transform:uppercase" name="otherPurpose1" id="otherPurpose1" type="text"/>
                           <label>Expense:</label>
                           <input name="otherExpense1" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999"id="otherExpense1" class="short"type="number" step=".01"/>
                           <label class="short">Qty</label>
                           <input name="otherQty1" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="otherQty1" class="sqty" type="number" />
                           <!---->
                         </div>    
                       </p>
                       <p>
                        <label for="otherExpense2Label" style="margin-left: 10px;">
                          <input type="checkbox" id="otherExpense2Label" />Purpose:

                        </label>
                        <div id="otherExpense2Div" style="display: none">
                         <input style="text-transform:uppercase" name="otherPurpose2" id="otherPurpose2" type="text"/>
                         <label>Expense:</label>
                         <input name="otherExpense2" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999"id="otherExpense2" class="short"type="number" step=".01"/>
                         <label class="short">Qty</label>
                         <input name="otherQty2" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="otherQty2" class="sqty" type="number"/>
                         <!---->
                       </div> 
                     </p>

                     <p>
                      <label for="otherExpense3Label" style="margin-left: 10px;">
                        <input type="checkbox" id="otherExpense3Label" />Purpose:

                      </label>
                      <div id="otherExpense3Div" style="display: none">
                       <input style="text-transform:uppercase" name="otherPurpose3" id="otherPurpose3" type="text"/>
                       <label>Expense:</label>
                       <input name="otherExpense3" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999"id="otherExpense3" class="short"type="number" step=".01"/>
                       <label class="short">Qty</label>
                       <input name="otherQty3" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="otherQty3" class="sqty" type="number"/>
                       <!---->
                     </div> 
                   </p>

                   <p>
                    <label for="otherExpense4Label" style="margin-left: 10px;">
                      <input type="checkbox" id="otherExpense4Label" />Purpose:

                    </label>
                    <div id="otherExpense4Div" style="display: none">
                     <input style="text-transform:uppercase" name="otherPurpose4" id="otherPurpose4" type="text"/>
                     <label>Expense:</label>
                     <input name="otherExpense4" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999"id="otherExpense4" class="short"type="number" step=".01"/>
                     <label class="short">Qty</label>
                     <input name="otherQty4" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="otherQty4" class="sqty" type="number"/>
                     <!---->
                   </div> 
                 </p>

                 <p>
                  <label for="otherExpense5Label" style="margin-left: 10px;">
                    <input type="checkbox" id="otherExpense5Label" />Purpose:

                  </label>
                  <div id="otherExpense5Div" style="display: none">
                   <input style="text-transform:uppercase" name="otherPurpose5" id="otherPurpose5" type="text"/>
                   <label>Expense:</label>
                   <input name="otherExpense5" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999"id="otherExpense5" class="short"type="number" step=".01"/>
                   <label class="short">Qty</label>
                   <input name="otherQty5" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="otherQty5" class="sqty" type="number" />
                   <!---->
                 </div> 
               </p>

               <p>
                <label for="otherExpense6Label" style="margin-left: 10px;">
                  <input type="checkbox" id="otherExpense6Label" />Purpose:

                </label>
                <div id="otherExpense6Div" style="display: none">
                 <input style="text-transform:uppercase" name="otherPurpose6" id="otherPurpose6" type="text"/>
                 <label>Expense:</label>
                 <input name="otherExpense6" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999"id="otherExpense6" class="short"type="number" step=".01"/>
                 <label class="short">Qty</label>
                 <input name="otherQty6" onkeypress="return isNumeric1(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "5" min = "0" max = "99999"id="otherQty6" class="sqty" type="number"/>
                 <!---->
               </div> 

               <div class="calculation" style="margin-left: 900px;">
                <h4 style="margin-left: 100px; color: black;"><b>Other Fee : </b><span id="otherFee"></span></h4>
              </div>
            </p>

          </fieldset>
          <fieldset class="row2">
            <legend>Payment
            </legend>
            <p>
              <Label style="width: 200px; margin-left: -50px;">Advance Payment: </Label>
              <input name="pAmount"onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999" id="pAmount" type="number"/>

              <label>Payment date</label>
              <input name="pDate" type="date"/>

              <div class="calculation" style="margin-left: 900px; font-weight: 900">
                 <h3 style="margin-left: 100px; color: black;"><b>Total: </b><span id="tot_expenses"></span> </h3>
              </div>
            </p>
            <p style="margin-left: 53px;">
              <label>Bank Details</label>
                <textarea name="bank_details" rows="4"></textarea>
              <label >Cash /Check:
             </label>
             <input name="check_ref" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"type = "number" maxlength = "10" min = "0" max = "99999999" style="text-transform:uppercase; width: 130px;" id='check_ref' type="text"/>
              
              <div class="calculation" style="margin-left: 900px; font-weight: 900">
                <h2 style="margin-left: 100px;color: black;"><b>Due: </b><span id="com_expenses"></span> </h2>
              </div>
           </p>



           <p >
              <select name="addressRef"style="margin-top: 5px; max-width: 151px;" onchange="changeAddress(this.value)">
                  <option >Select footer location</option>
                  <option value="address1">Kalabagan Address (Skylight)</option>
                  <option value="address2">Gulshan Address (Sairbd)</option>
                  <option value="address3">Gulshan Address (Skylight)</option>
               </select>
              <textarea rows="4" name="location" style="text-transform:uppercase;width: 390px;" id='location' type="text">House# 12, Road# 16/A, Gulshan-1, Dhaka-1213
Tel:  +88 02 9853558, +88 02 9853583
Email: info@skylight.com.bd</textarea>
          </p>
         </fieldset>
         <input type="submit" name="submit" value="Create">
       </form>

       <script>
        function changeAddress(v) {
          //alert(v);

          var add1 = "34 Green Road, Kolabagan,Dhaka-1205&#10Tel:  +88029640107&#10Email: info@skylight.com.bd";
          var add2= "House# 12, Road# 16/A, Gulshan-1, Dhaka-1213&#10Tel:  +88 02 9853558, +88 02 9853583&#10Email: info@skylight.com.bd"

          var add3= "House# 12, Road# 16/A, Gulshan-1, Dhaka-1213&#10Tel:  +88 02 9853558, +88 02 9853583&#10Email: info@sairbd.com"
          if(v == "address1")
            $('#location').html(add1);
          else if(v == "address2")
            $('#location').html(add2);
          else if(v == "address3")
            $('#location').html(add3);
        }
        </script>

       <script>

        $(document).ready(function () {
          $('#cname').typeahead({
            source: function (query, result) {
              $.ajax({
                url: "corpSuggestionScript.php",
                data: 'query=' + query,            
                dataType: "json",
                type: "POST",
                success: function (data) {
                  result($.map(data, function (item) {
                    return item;
                  }));
                }
              });
            }
          });

        });

      </script>

      <!----test--->
      <script type="text/javascript">
        $(document).ready(function(){

          $(document).on('keydown', '.company_name', function() {

            var id = this.id;
            var splitid = id.split('_');
            var index = splitid[1];

            $( '#'+id ).autocomplete({
              source: function( request, response ) {
                $.ajax({
                  url: "getDetails.php",
                  type: 'post',
                  dataType: "json",
                  data: {
                    search: request.term,request:1
                  },
                  success: function( data ) {
                    response( data );
                  }
                });
              },
              select: function (event, ui) {
                        $(this).val(ui.item.label); // display the selected text
                        var userid = ui.item.value; // selected id to input

                        // AJAX
                        $.ajax({
                          url: 'getDetails.php',
                          type: 'post',
                          data: {userid:userid,request:2},
                          dataType: 'json',
                          success:function(response){

                            var len = response.length;

                            if(len > 0){
                              var id = response[0]['id'];
                              var c_address = response[0]['c_address'];
                              document.getElementById('salary_'+index).value = c_address;

                            }

                          }
                        });

                        return false;
                      }
                    });
          });

        });

      </script>

      <script type="text/javascript">
       $(function () {
        $("#adultFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#adultFareDiv").show();

          } else {
            $("#adultFareDiv").hide();
            $('#adultFare').val('');
            $('#adultQty').val('');

          }
        });

        $("#childFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#childFareDiv").show();

          } else {
            $("#childFareDiv").hide();
            $('#childFare').val('');
            $('#childQty').val('');

          }
        });

        $("#infantFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#infantFareDiv").show();

          } else {
            $("#infantFareDiv").hide();
            $('#infantFare').val('');
            $('#infantQty').val('');

          }
        });
        $("#cAdjustmentLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#cPercentageDiv").show();

          } else {
            $("#cPercentageDiv").hide();
            $("#cPercentage").val('');
            $("#cTk").val('');
          }
        });
        $("#eInfantFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#eInfantFareDiv").show();

          } else {
            $("#eInfantFareDiv").hide();
            $('#eInfantFare').val('');
            $('#eInfantQty').val('');

          }
        });
        $("#eChildFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#eChildFareDiv").show();

          } else {
            $("#eChildFareDiv").hide();
            $('#eChildFare').val('');
            $('#eChildQty').val('');
          }
        });
        $("#eAdultFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#eAdultFareDiv").show();

          } else {
            $("#eAdultFareDiv").hide();
            $('#eAdultFare').val('');
            $('#eAdultQty').val('');

          }
        });
        $("#tInfantFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#tInfantFareDiv").show();

          } else {
            $("#tInfantFareDiv").hide();
            $('#tInfantFare').val('');
            $('#tInfantQty').val('');

          }
        });
        $("#tChildFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#tChildFareDiv").show();

          } else {
            $("#tChildFareDiv").hide();
            $('#tChildFare').val('');
            $('#tChildQty').val('');

          }
        });
        $("#tAdultFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#tAdultFareDiv").show();

          } else {
            $("#tAdultFareDiv").hide();
            $('#tAdultFare').val('');
            $('#tAdultQty').val('');

          }
        });

        $("#oInfantFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#oInfantFareDiv").show();

          } else {
            $("#oInfantFareDiv").hide();
            $('#oInfantFare').val('');
            $('#oInfantQty').val('');

          }
        });
        $("#oChildFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#oChildFareDiv").show();

          } else {
            $("#oChildFareDiv").hide();
            $('#oChildFare').val('');
            $('#oChildQty').val('');

          }
        });
        $("#oAdultFareLabel").click(function () {
          if ($(this).is(":checked")) {
            $("#oAdultFareDiv").show();

          } else {
            $("#oAdultFareDiv").hide();
            $('#oAdultFare').val('');
            $('#oAdultQty').val('');

          }
        });

        $("#otherExpense1Label").click(function () {
          if ($(this).is(":checked")) {
            $("#otherExpense1Div").show();

          } else {
            $("#otherExpense1Div").hide();
            $('#otherExpense1').val('');
            $('#otherQty1').val('');

          }
        });
        $("#otherExpense2Label").click(function () {
          if ($(this).is(":checked")) {
            $("#otherExpense2Div").show();

          } else {
            $("#otherExpense2Div").hide();
            $('#otherExpense2').val('');
            $('#otherQty2').val('');

          }
        });
        $("#otherExpense3Label").click(function () {
          if ($(this).is(":checked")) {
            $("#otherExpense3Div").show();

          } else {
            $("#otherExpense3Div").hide();
            $('#otherExpense3').val('');
            $('#otherQty3').val('');

          }
        });

        $("#otherExpense4Label").click(function () {
          if ($(this).is(":checked")) {
            $("#otherExpense4Div").show();

          } else {
            $("#otherExpense4Div").hide();
            $('#otherExpense4').val('');
            $('#otherQty4').val('');

          }
        });

        $("#otherExpense5Label").click(function () {
          if ($(this).is(":checked")) {
            $("#otherExpense5Div").show();

          } else {
            $("#otherExpense5Div").hide();
            $('#otherExpense5').val('');
            $('#otherQty5').val('');

          }
        });

        $("#otherExpense6Label").click(function () {
          if ($(this).is(":checked")) {
            $("#otherExpense6Div").show();

          } else {
            $("#otherExpense6Div").hide();
            $('#otherExpense6').val('');
            $('#otherQty6').val('');

          }
        });
      });
    </script>

    <script type="text/javascript">
    $('input').keyup(function(){ // run anytime the value changes
    var adult = parseFloat($('#adultFare').val()); // get value of field
    var aQty = parseFloat($('#adultQty').val()); // convert it to a float

    if($('#childQty').val() != '' && $('#childQty').val() > 0)
    {
        var child = parseFloat($('#childFare').val()); // get value of field
        var cQty = parseFloat($('#childQty').val()); // convert it to a float
      }
      else{
        var child = 0; // get value of field
        var cQty = 0; // convert it to a float
      }
      if($('#infantQty').val() != "" )
      {
        var infant = parseFloat($('#infantFare').val()); // get value of field
        var iQty = parseFloat($('#infantQty').val()); // convert it to a float
      }
      else{
        var infant = 0;
        var iQty = 0;
      }
      var res = (adult * aQty)+(child * cQty)+(infant * iQty);
    $('#total_expenses').html(res); // add them and output it

    if($('#cPercentage').val() != ""){
        var cper = parseFloat($('#cPercentage').val()); // convert it to a float
        var commission = Math.round(res*cper/100);
        $('#com').html(commission);
        
      }
      else if($('#cTk').val() != ""){
        var cper = parseFloat($('#cTk').val()); // convert it to a float
        var commission = cper;
        $('#com').html(commission);
      }
      else{
        var commission = 0;
        var cper = 0;
        $('#com').html(commission);
      }
      if($('#eAdultQty').val() != '')
      {
        var eadult = parseFloat($('#eAdultFare').val()); // get value of field
        var eaQty = parseFloat($('#eAdultQty').val()); // convert it to a float
      }
      else{
        var eadult = 0;
        var eaQty = 0;
      }
      if($('#eChildQty').val() != '')
      {
        var echild = parseFloat($('#eChildFare').val()); // get value of field
        var ecQty = parseFloat($('#eChildQty').val()); // convert it to a float
      }
      else{
        var echild = 0; // get value of field
        var ecQty = 0; // convert it to a float
      }
      if($('#eInfantQty').val() != "" )
      {
        var einfant = parseFloat($('#eInfantFare').val()); // get value of field
        var eiQty = parseFloat($('#eInfantQty').val()); // convert it to a float
      }
      else{
        var einfant = 0;
        var eiQty = 0;
      }

      if($('#tAdultQty').val() != '' )
      {
        var tadult = parseFloat($('#tAdultFare').val()); // get value of field
        var taQty = parseFloat($('#tAdultQty').val()); // convert it to a float
      }
      else{
        var tadult = 0;
        var taQty = 0;
      }
      if($('#tChildQty').val() != '')
      {
        var tchild = parseFloat($('#tChildFare').val()); // get value of field
        var tcQty = parseFloat($('#tChildQty').val()); // convert it to a float
      }
      else{
        var tchild = 0; // get value of field
        var tcQty = 0; // convert it to a float
      }
      if($('#tInfantQty').val() != "" )
      {
        var tinfant = parseFloat($('#tInfantFare').val()); // get value of field
        var tiQty = parseFloat($('#tInfantQty').val()); // convert it to a float
      }
      else{
        var tinfant = 0;
        var tiQty = 0;
      }
      if($('#oAdultQty').val() != '')
      {
        var oadult = parseFloat($('#oAdultFare').val()); // get value of field
        var oaQty = parseFloat($('#oAdultQty').val()); // convert it to a float
      }
      else{
        var oadult = 0;
        var oaQty = 0;
      }
      if($('#oChildQty').val() != '')
      {
        var ochild = parseFloat($('#oChildFare').val()); // get value of field
        var ocQty = parseFloat($('#oChildQty').val()); // convert it to a float
      }
      else{
        var ochild = 0; // get value of field
        var ocQty = 0; // convert it to a float
      }
      if($('#oInfantQty').val() != "" )
      {
        var oinfant = parseFloat($('#oInfantFare').val()); // get value of field
        var oiQty = parseFloat($('#oInfantQty').val()); // convert it to a float
      }
      else{
        var oinfant = 0;
        var oiQty = 0;
      }
      var total_tax = (eadult * eaQty)+(echild * ecQty)+(einfant * eiQty) + (tadult * taQty)+(tchild * tcQty)+(tinfant * tiQty) +(oadult * oaQty)+(ochild * ocQty)+(oinfant * oiQty);
      $('#totalTax').html(total_tax);
      if($('#otherQty1').val() != '')
      {
        var otherexpense1 = parseFloat($('#otherExpense1').val()); // get value of field
        var otherQty1 = parseFloat($('#otherQty1').val()); // convert it to a float
      }
      else{
        var otherexpense1 = 0;
        var otherQty1 = 0;
      }
      if($('#otherQty2').val() != '')
      {
        var otherexpense2 = parseFloat($('#otherExpense2').val()); // get value of field
        var otherQty2 = parseFloat($('#otherQty2').val()); // convert it to a float
      }
      else{
        var otherexpense2 = 0; // get value of field
        var otherQty2 = 0; // convert it to a float
      }
      if($('#otherQty3').val() != "" )
      {
        var otherexpense3 = parseFloat($('#otherExpense3').val()); // get value of field
        var otherQty3 = parseFloat($('#otherQty3').val()); // convert it to a float
      }
      else{
        var otherexpense3 = 0;
        var otherQty3 = 0;
      }
      if($('#otherQty4').val() != "" )
      {
        var otherexpense4 = parseFloat($('#otherExpense4').val()); // get value of field
        var otherQty4 = parseFloat($('#otherQty4').val()); // convert it to a float
      }
      else{
        var otherexpense4 = 0;
        var otherQty4 = 0;
      }
      if($('#otherQty5').val() != "" )
      {
        var otherexpense5 = parseFloat($('#otherExpense5').val()); // get value of field
        var otherQty5 = parseFloat($('#otherQty5').val()); // convert it to a float
      }
      else{
        var otherexpense5 = 0;
        var otherQty5 = 0;
      }
      if($('#otherQty6').val() != "" )
      {
        var otherexpense6 = parseFloat($('#otherExpense6').val()); // get value of field
        var otherQty6 = parseFloat($('#otherQty6').val()); // convert it to a float
      }
      else{
        var otherexpense6 = 0;
        var otherQty6 = 0;
      }
      var other_fee = (otherexpense1 * otherQty1)+(otherexpense2 * otherQty2)+(otherexpense3 * otherQty3)+(otherexpense4 * otherQty4)+(otherexpense5 * otherQty5)+(otherexpense6 * otherQty6);

      $('#otherFee').html(other_fee);

      if($('#pAmount').val() != "" )
      {
        var advance = parseFloat($('#pAmount').val()); // get value of field
      }
      else{
        var advance = 0;
      }

      var total = res - commission + total_tax + other_fee;
      $('#tot_expenses').html(total);

      var due = res - commission + total_tax + other_fee - advance;
      $('#com_expenses').html(due);


      if($('#o_amount').val() != '' )
      {
        var otot = parseFloat($('#o_amount').val()); // get value of field
      }
      else
        var otot = 0;

      if($('#o_amount1').val() != '' )
      {
        var otot1 = parseFloat($('#o_amount1').val()); // get value of field
      }
      else
        var otot1 = 0;
      if($('#o_amount2').val() != '' )
      {
        var otot2 = parseFloat($('#o_amount2').val()); // get value of field
      }
      else
        var otot2 = 0;

      if($('#o_amount3').val() != '' )
      {
        var otot3 = parseFloat($('#o_amount3').val()); // get value of field
      }
      else
        var otot3 = 0;

      if($('#o_amount4').val() != '' )
      {
        var otot4 = parseFloat($('#o_amount4').val()); // get value of field
      }
      else
        var otot4 = 0;

      if($('#o_amount5').val() != '' )
      {
        var otot5 = parseFloat($('#o_amount5').val()); // get value of field
      }
      else
        var otot5 = 0;

      $('#oAmountres').html(otot+ otot1 +otot2+otot3+otot4+otot5);
    });
  </script>
  <script> 
    var flag = 0;
    function sideBarHandle() { 

      if(flag == 0)
      {
        flag = 1;
        openNav();
      }
      else{
        flag = 0;
        closeNav();
      }
    } 
    /* Sets the width of the sidebar  
    to 250 and the left margin of the  
    page content to 250 */ 
    function openNav() { 
      document.getElementById( 
        "sidebar").style.width = "250px"; 
      document.getElementById( 
        "main").style.marginLeft = "250px"; 
    } 

    /* Set the width of the sidebar  
    to 0 and the left margin of the  
    page content to 0 */ 
    function closeNav() { 
      document.getElementById( 
        "sidebar").style.width = "0"; 
      document.getElementById( 
        "main").style.marginLeft = "0"; 
    } 
  </script>
  <script type="text/javascript">
  	
  	jQuery(function($) { // DOM ready

  $('form').on('keydown', function(e) {
    if (e.which === 13 && !$(e.target).is('textarea')) {
      e.preventDefault();
      console.log("ENTER-KEY PREVENTED ON NON-TEXTAREA ELEMENTS");
    }
  });

});
  </script>
  <script type="text/javascript">
    
  function maxLengthCheck(object) {
    if (object.value.length > object.maxLength)
      object.value = object.value.slice(0, object.maxLength)
  }
    
  function isNumeric (evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode (key);
    var regex = /[0-9 .]/;
    if ( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }

  function isNumeric1 (evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode (key);
    var regex = /[0-9]/;
    if ( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }

  </script>
  <!--Endtest--->
</div>
</body>
</html>