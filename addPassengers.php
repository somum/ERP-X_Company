<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index");
	exit;
}
require_once 'config.php';

$email=$_SESSION["email"];
$name=$_SESSION["employee_name"];


$sql = "SELECT * FROM ref_table";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM corp_details";
$result2 = mysqli_query($conn, $sql2);

?>


<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>
		SAir AIR BD LTD...
	</title>
	
	<!-- Favicon -->
	<link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<!-- Icons -->
	<link href="./assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
	<link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
	<!-- CSS Files -->
	<link href="./assets/css/argon-dashboard.css" rel="stylesheet" />

	<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/typeahead.js"></script> 
	
</head>

<body class="">
	<?php include('nav.php'); ?>

	<!-- Page content -->
	<div class="container-fluid mt--7">
		<div class="row">
			<div class="col-xl-1">
			</div>
			<div class="col-xl-10" style="margin-top: 115px;">
				<div class="card bg-secondary shadow">
					<div class="card-header bg-white border-0">
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0">Add New Passenger Details</h3>
							</div>

						</div>
					</div>
					<div class="card-body">
						<form method="post" action="upload.php" enctype="multipart/form-data">

							<h6 class="heading-small text-muted mb-4">User information</h6>
							<div class="pl-lg-4">
								<div class="row">
									<div class="col-lg-5">
										<div class="form-group">
											<label class="form-control-label" for="reference">Reference</label>
											<input type="text" list="refList" style="text-transform: uppercase;"name="reference" id="reference" class="form-control form-control-alternative" placeholder="Enter reference">
											<datalist name="refList" id="refList" >
												<?php while($row = mysqli_fetch_assoc($result)) { ?>
													<option value="<?php echo $row['reference']?>">
													<?php  } ?>	
												</datalist>

											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group">
												<label class="form-control-label" for="passNo">Corporate Details</label>
												<input type="text" list="corplist" style="text-transform: uppercase;"name="corp_details" id="corp_details" class="form-control form-control-alternative" placeholder="Enter Corporate Details">
												<datalist name="corplist" id="corplist">
													<?php while($row = mysqli_fetch_assoc($result2)) { ?>
														<option value="<?php echo $row['company_name']?>">
														<?php  } ?>	
													</datalist>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group">
													<label class="form-control-label" for="fname">First Name *</label>
													<input type="text" required name="fname" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter First Name">
												</div>
											</div>

											<div class="col-lg-5">
												<div class="form-group">
													<label class="form-control-label" for="lname">Last Name *</label>
													<input type="text" required name="lname" class="form-control form-control-alternative" style="text-transform: uppercase;"placeholder="Enter Last Name">
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<label class="form-control-label" for="lname">Gender</label>

														<select name="gender" class="form-control form-control-alternative">
					                                    <option value="">
					                                    </option>
					                                    <option value="MALE">MALE
					                                    </option>
					                                    <option value="FEMALE">FEMALE
					                                    </option>
					                                    <option value="OTHER">Other
					                                    </option>
					                                  </select>

														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="passNo">Passport No *</label>
															<input required type="text" style="text-transform: uppercase;"name="passNo" class="form-control form-control-alternative" placeholder="Enter Passport No">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="passNo">Date of Birth *</label>
															<input required type="date" name="dob" class="form-control form-control-alternative" placeholder="Enter Date of Birth">
														</div>
													</div>

												</div>

												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="fname">Date of Issue</label>
															<input type="date" name="passport_issue" id="passport_issue"  class="form-control form-control-alternative" placeholder="First Name">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="lname">Date of Expire *</label>
															<input required type="date" id="passport_expire" name="passport_expire" class="form-control form-control-alternative" placeholder="Last Name">
														</div>
													</div>


												</div>

												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="fname">Place of Issue</label>
															<input type="text" style="text-transform: uppercase;"name="issue_place" class="form-control form-control-alternative" placeholder="Enter Place of Issue">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
													<label class="form-control-label" for="nationality">Country *</label>
													<input type="text" name="nationality" required class="form-control form-control-alternative" style="text-transform: uppercase;" list="country1">
													<datalist name="country1" id="country1">
														<option value="Afghanistan">Afghanistan</option>
											                <option value="Åland Islands">Åland Islands</option>
											                <option value="Albania">Albania</option>
											                <option value="Algeria">Algeria</option>
											                <option value="American Samoa">American Samoa</option>
											                <option value="Andorra">Andorra</option>
											                <option value="Angola">Angola</option>
											                <option value="Anguilla">Anguilla</option>
											                <option value="Antarctica">Antarctica</option>
											                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
											                <option value="Argentina">Argentina</option>
											                <option value="Armenia">Armenia</option>
											                <option value="Aruba">Aruba</option>
											                <option value="Australia">Australia</option>
											                <option value="Austria">Austria</option>
											                <option value="Azerbaijan">Azerbaijan</option>
											                <option value="Bahamas">Bahamas</option>
											                <option value="Bahrain">Bahrain</option>
											                <option value="Bangladesh">Bangladesh</option>
											                <option value="Barbados">Barbados</option>
											                <option value="Belarus">Belarus</option>
											                <option value="Belgium">Belgium</option>
											                <option value="Belize">Belize</option>
											                <option value="Benin">Benin</option>
											                <option value="Bermuda">Bermuda</option>
											                <option value="Bhutan">Bhutan</option>
											                <option value="Bolivia">Bolivia</option>
											                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
											                <option value="Botswana">Botswana</option>
											                <option value="Bouvet Island">Bouvet Island</option>
											                <option value="Brazil">Brazil</option>
											                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
											                <option value="Brunei Darussalam">Brunei Darussalam</option>
											                <option value="Bulgaria">Bulgaria</option>
											                <option value="Burkina Faso">Burkina Faso</option>
											                <option value="Burundi">Burundi</option>
											                <option value="Cambodia">Cambodia</option>
											                <option value="Cameroon">Cameroon</option>
											                <option value="Canada">Canada</option>
											                <option value="Cape Verde">Cape Verde</option>
											                <option value="Cayman Islands">Cayman Islands</option>
											                <option value="Central African Republic">Central African Republic</option>
											                <option value="Chad">Chad</option>
											                <option value="Chile">Chile</option>
											                <option value="China">China</option>
											                <option value="Christmas Island">Christmas Island</option>
											                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
											                <option value="Colombia">Colombia</option>
											                <option value="Comoros">Comoros</option>
											                <option value="Congo">Congo</option>
											                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
											                <option value="Cook Islands">Cook Islands</option>
											                <option value="Costa Rica">Costa Rica</option>
											                <option value="Cote D'ivoire">Cote D'ivoire</option>
											                <option value="Croatia">Croatia</option>
											                <option value="Cuba">Cuba</option>
											                <option value="Cyprus">Cyprus</option>
											                <option value="Czech Republic">Czech Republic</option>
											                <option value="Denmark">Denmark</option>
											                <option value="Djibouti">Djibouti</option>
											                <option value="Dominica">Dominica</option>
											                <option value="Dominican Republic">Dominican Republic</option>
											                <option value="Ecuador">Ecuador</option>
											                <option value="Egypt">Egypt</option>
											                <option value="El Salvador">El Salvador</option>
											                <option value="England">England</option>
											                <option value="Equatorial Guinea">Equatorial Guinea</option>
											                <option value="Eritrea">Eritrea</option>
											                <option value="Estonia">Estonia</option>
											                <option value="Ethiopia">Ethiopia</option>
											                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
											                <option value="Faroe Islands">Faroe Islands</option>
											                <option value="Fiji">Fiji</option>
											                <option value="Finland">Finland</option>
											                <option value="France">France</option>
											                <option value="French Guiana">French Guiana</option>
											                <option value="French Polynesia">French Polynesia</option>
											                <option value="French Southern Territories">French Southern Territories</option>
											                <option value="Gabon">Gabon</option>
											                <option value="Gambia">Gambia</option>
											                <option value="Georgia">Georgia</option>
											                <option value="Germany">Germany</option>
											                <option value="Ghana">Ghana</option>
											                <option value="Gibraltar">Gibraltar</option>
											                <option value="Greece">Greece</option>
											                <option value="Greenland">Greenland</option>
											                <option value="Grenada">Grenada</option>
											                <option value="Guadeloupe">Guadeloupe</option>
											                <option value="Guam">Guam</option>
											                <option value="Guatemala">Guatemala</option>
											                <option value="Guernsey">Guernsey</option>
											                <option value="Guinea">Guinea</option>
											                <option value="Guinea-bissau">Guinea-bissau</option>
											                <option value="Guyana">Guyana</option>
											                <option value="Haiti">Haiti</option>
											                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
											                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
											                <option value="Honduras">Honduras</option>
											                <option value="Hong Kong">Hong Kong</option>
											                <option value="Hungary">Hungary</option>
											                <option value="Iceland">Iceland</option>
											                <option value="India">India</option>
											                <option value="Indonesia">Indonesia</option>
											                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
											                <option value="Iraq">Iraq</option>
											                <option value="Ireland">Ireland</option>
											                <option value="Isle of Man">Isle of Man</option>
											                <option value="Israel">Israel</option>
											                <option value="Italy">Italy</option>
											                <option value="Jamaica">Jamaica</option>
											                <option value="Japan">Japan</option>
											                <option value="Jersey">Jersey</option>
											                <option value="Jordan">Jordan</option>
											                <option value="Kazakhstan">Kazakhstan</option>
											                <option value="Kenya">Kenya</option>
											                <option value="Kiribati">Kiribati</option>
											                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
											                <option value="Korea, Republic of">Korea, Republic of</option>
											                <option value="Kuwait">Kuwait</option>
											                <option value="Kyrgyzstan">Kyrgyzstan</option>
											                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
											                <option value="Latvia">Latvia</option>
											                <option value="Lebanon">Lebanon</option>
											                <option value="Lesotho">Lesotho</option>
											                <option value="Liberia">Liberia</option>
											                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
											                <option value="Liechtenstein">Liechtenstein</option>
											                <option value="Lithuania">Lithuania</option>
											                <option value="Luxembourg">Luxembourg</option>
											                <option value="Macao">Macao</option>
											                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
											                <option value="Madagascar">Madagascar</option>
											                <option value="Malawi">Malawi</option>
											                <option value="Malaysia">Malaysia</option>
											                <option value="Maldives">Maldives</option>
											                <option value="Mali">Mali</option>
											                <option value="Malta">Malta</option>
											                <option value="Marshall Islands">Marshall Islands</option>
											                <option value="Martinique">Martinique</option>
											                <option value="Mauritania">Mauritania</option>
											                <option value="Mauritius">Mauritius</option>
											                <option value="Mayotte">Mayotte</option>
											                <option value="Mexico">Mexico</option>
											                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
											                <option value="Moldova, Republic of">Moldova, Republic of</option>
											                <option value="Monaco">Monaco</option>
											                <option value="Mongolia">Mongolia</option>
											                <option value="Montenegro">Montenegro</option>
											                <option value="Montserrat">Montserrat</option>
											                <option value="Morocco">Morocco</option>
											                <option value="Mozambique">Mozambique</option>
											                <option value="Myanmar">Myanmar</option>
											                <option value="Namibia">Namibia</option>
											                <option value="Nauru">Nauru</option>
											                <option value="Nepal">Nepal</option>
											                <option value="Netherlands">Netherlands</option>
											                <option value="Netherlands Antilles">Netherlands Antilles</option>
											                <option value="New Caledonia">New Caledonia</option>
											                <option value="New Zealand">New Zealand</option>
											                <option value="Nicaragua">Nicaragua</option>
											                <option value="Niger">Niger</option>
											                <option value="Nigeria">Nigeria</option>
											                <option value="Niue">Niue</option>
											                <option value="Norfolk Island">Norfolk Island</option>
											                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
											                <option value="Norway">Norway</option>
											                <option value="Oman">Oman</option>
											                <option value="Pakistan">Pakistan</option>
											                <option value="Palau">Palau</option>
											                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
											                <option value="Panama">Panama</option>
											                <option value="Papua New Guinea">Papua New Guinea</option>
											                <option value="Paraguay">Paraguay</option>
											                <option value="Peru">Peru</option>
											                <option value="Philippines">Philippines</option>
											                <option value="Pitcairn">Pitcairn</option>
											                <option value="Poland">Poland</option>
											                <option value="Portugal">Portugal</option>
											                <option value="Puerto Rico">Puerto Rico</option>
											                <option value="Qatar">Qatar</option>
											                <option value="Reunion">Reunion</option>
											                <option value="Romania">Romania</option>
											                <option value="Russian Federation">Russian Federation</option>
											                <option value="Rwanda">Rwanda</option>
											                <option value="Saint Helena">Saint Helena</option>
											                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
											                <option value="Saint Lucia">Saint Lucia</option>
											                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
											                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
											                <option value="Samoa">Samoa</option>
											                <option value="San Marino">San Marino</option>
											                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
											                <option value="Saudi Arabia">Saudi Arabia</option>
											                <option value="Senegal">Senegal</option>
											                <option value="Serbia">Serbia</option>
											                <option value="Seychelles">Seychelles</option>
											                <option value="Sierra Leone">Sierra Leone</option>
											                <option value="Singapore">Singapore</option>
											                <option value="Slovakia">Slovakia</option>
											                <option value="Slovenia">Slovenia</option>
											                <option value="Solomon Islands">Solomon Islands</option>
											                <option value="Somalia">Somalia</option>
											                <option value="South Africa">South Africa</option>
											                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
											                <option value="Spain">Spain</option>
											                <option value="Sri Lanka">Sri Lanka</option>
											                <option value="Sudan">Sudan</option>
											                <option value="Suriname">Suriname</option>
											                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
											                <option value="Swaziland">Swaziland</option>
											                <option value="Sweden">Sweden</option>
											                <option value="Switzerland">Switzerland</option>
											                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
											                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
											                <option value="Tajikistan">Tajikistan</option>
											                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
											                <option value="Thailand">Thailand</option>
											                <option value="Timor-leste">Timor-leste</option>
											                <option value="Togo">Togo</option>
											                <option value="Tokelau">Tokelau</option>
											                <option value="Tonga">Tonga</option>
											                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
											                <option value="Tunisia">Tunisia</option>
											                <option value="Turkey">Turkey</option>
											                <option value="Turkmenistan">Turkmenistan</option>
											                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
											                <option value="Tuvalu">Tuvalu</option>
											                <option value="Uganda">Uganda</option>
											                <option value="Ukraine">Ukraine</option>
											                <option value="United Arab Emirates">United Arab Emirates</option>
											                <option value="United Kingdom">United Kingdom</option>
											                <option value="United States">United States</option>
											                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
											                <option value="Uruguay">Uruguay</option>
											                <option value="Uzbekistan">Uzbekistan</option>
											                <option value="Vanuatu">Vanuatu</option>
											                <option value="Venezuela">Venezuela</option>
											                <option value="Viet Nam">Viet Nam</option>
											                <option value="Virgin Islands, British">Virgin Islands, British</option>
											                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
											                <option value="Wallis and Futuna">Wallis and Futuna</option>
											                <option value="Western Sahara">Western Sahara</option>
											                <option value="Yemen">Yemen</option>
											                <option value="Zambia">Zambia</option>
											                <option value="Zimbabwe">Zimbabwe</option>


															</datalist>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="passNo">Date of Marriage</label>
															<input type="date" name="dom" class="form-control form-control-alternative" placeholder="Enter Date of Birth">
														</div>
													</div>
												</div>

												<h6 class="heading-small text-muted mb-4" style="margin-left: -28px; padding:10px;">Miles Info</h6>
												<div class="field_wrapper">
													<div class="row">
														<div class="col-lg-3" style="padding-left:15px; padding-right: 3px">
															<label class="form-control-label">Miles Name</label>
															<input type="text" style="text-transform: uppercase;" class="form-control form-control-alternative" name="miles_name[]" value=""/>
														</div>
														<div class="col-lg-2" style="padding: 0px 3px;">
															<label class="form-control-label">Miles No</label>
															<input type="text" style="text-transform: uppercase;" class="form-control form-control-alternative" name="miles_no[]" value=""/>
														</div>
														<div class="col-lg-2" style="padding: 0px 3px;">
															<label class="form-control-label">Total Miles</label>
															<input type="text" style="text-transform: uppercase;" class="form-control form-control-alternative" name="total_miles[]" value=""/>
														</div>
														<div class="col-lg-2" style="padding: 0px 3px;">
															<label class="form-control-label">P/W</label>
															<input type="text"  class="form-control form-control-alternative" name="pw[]" value=""/>
														</div>
														<div class="col-lg-2" style="padding: 0px 3px;">
															<label class="form-control-label">Expire Date</label>	
															<input type="date" class="form-control form-control-alternative" name="miles_expire[]" value=""/>
														</div>
														<div class="col-lg-1">
															<label class="form-control-label">Options</label>
															<a href="javascript:void(0);" id="add_button" title="Add field"><img src="./images/add.png" style="height:20px; width:20px;"></a> 
														</div>
													</div>
												</div>
												<div class="row" style="margin-top: 10px;">
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="pEmail">Email 01</label>
															<input type="text" name="pEmail" id="pEmail" class="form-control form-control-alternative" placeholder="Enter Email">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="pEmail2">Email 02</label>
															<input type="text" name="pEmail2" id="pEmail2" class="form-control form-control-alternative" placeholder="Enter Email">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="passNo">Contact No 01 *</label>
															<input required type="text" style="text-transform: uppercase;"name="contact_no" class="form-control form-control-alternative" placeholder="Enter Contact No">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="passNo">Contact No 02</label>
															<input type="text" style="text-transform: uppercase;"name="contact_no2" class="form-control form-control-alternative" placeholder="Enter Contact No">
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="passNo">Other Address *</label>
															<textarea required type="text" rows="4" style="text-transform: uppercase;"name="present_address" class="form-control form-control-alternative" placeholder="Enter Present Address" ></textarea>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="passNo">Permanent Address</label>
															<textarea type="text" rows="4"style="text-transform: uppercase;"name="permanent_address"class="form-control form-control-alternative" placeholder="Enter Permanent Address"></textarea>
														</div>
													</div>
												</div>





											</div>


											<div class="pl-lg-4">

											</div>

											<h6 class="heading-small text-muted mb-4">Alternative Contact Information</h6>
											<div class="pl-lg-4">

												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="fname">Name</label>
															<input type="text" style="text-transform: uppercase;"name="alter_pname" class="form-control form-control-alternative" placeholder="Enter Name">
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<label class="form-control-label" for="lname">Contact No</label>
															<input type="text" style="text-transform: uppercase;"name="alter_pcontact" class="form-control form-control-alternative" placeholder="Enter Contact No">
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<label class="form-control-label" for="passNo">Other Address</label>
															<input type="text" style="text-transform: uppercase;"name="other_address" class="form-control form-control-alternative" placeholder="Enter other Address" >
														</div>
													</div>
												</div>
											</div>
											<h6 class="heading-small text-muted mb-4">Important Images</h6>
											<div class="row" style="margin-left: 30px;">
												<div id="drop_file_zone">
													<p style="margin-top: 18px;margin-left:20px;"><input type="file" name="fileToUpload2" id="fileToUpload2"></p>

												</div>
												<div id="drop_file_zone" style="margin-left: 10px;">
													<p style="margin-top: 18px;margin-left:20px;"><input type="file" name="fileToUpload1"></p>

												</div>
											</div>
											<div class="row" style="margin-top: 10px;margin-left: 30px;">
												<div id="drop_file_zone">
													<p style="margin-top: 18px;margin-left:20px;"><input type="file"  name="fileToUpload3"></p>

												</div>
												<div id="drop_file_zone" style="margin-left: 10px;">
													<p style="margin-top: 18px;margin-left:20px;"><input type="file" name="fileToUpload4"></p>

												</div>
											</div>
											<div class="row" style="margin-top: 10px;margin-left: 30px;">
												<div id="drop_file_zone">
													<p style="margin-top: 18px;margin-left:20px;"><input type="file"  name="fileToUpload5"></p>

												</div>
												<div id="drop_file_zone" style="margin-left: 10px;">
													<p style="margin-top: 18px;margin-left:20px;"><input type="file" name="fileToUpload6"></p>

												</div>
											</div>
							<!---<div class="pl-lg-4">
								<div class="row">
									<div class="col-6">
										<input type="file" name="fileToUpload2[]" id="fileToUpload2[]"  multiple cass="file">
									</div>
								</div>
							</div>--->
							<div class="col-12 text-right">
								<input type="submit" name="submit" class="btn btn-sm btn-primary" value="Add Passenger">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-1">
			</div>
		</div>
		<?php include('footer.php'); ?>
		<!--   Core   -->

		<script src="./assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<!--   Optional JS   -->

		<!--   Argon JS   -->
		<script src="./assets/js/argon-dashboard.min.js?v=1.1.0"></script>
		<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>

		<script type="text/javascript">$('.file-upload').file_upload();</script>

		<script type="text/javascript">
			$(document).ready(function(){
    var maxField = 6; //Input fields increment limitation
    var addButton = $('#add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="margin-top: 10px;"><div class="row"><div class="col-lg-3" style="padding-left:15px; padding-right: 3px"><input type="text" class="form-control form-control-alternative" style="text-transform: uppercase;" name="miles_name[]" value=""/></div><div class="col-lg-2" style="padding: 0px 3px;"><input type="text" style="text-transform: uppercase;" class="form-control form-control-alternative" name="miles_no[]" value=""/></div><div class="col-lg-2" style="padding: 0px 3px;"><input type="text" class="form-control form-control-alternative" name="total_miles[]" value=""/></div><div class="col-lg-2" style="padding: 0px 3px;"><input type="text" style="" class="form-control form-control-alternative" name="pw[]" value=""/></div><div class="col-lg-2" style="padding: 0px 3px;"><input type="date" class="form-control form-control-alternative" name="miles_expire[]" value=""/></div><div class="col-lg-1"><a  href="javascript:void(0);" class="remove_button"><img src="./images/minus.png" style="height:20px; width:28px;margin-left:-4px;"></a></div></div>'; //New input field html 




    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
    	e.preventDefault();
        $(this).parent().parent().remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<script>
  
  $("#passport_expire").change(function() {
    var startDate = document.getElementById("passport_issue").value;
    var endDate = document.getElementById("passport_expire").value;

    if ((Date.parse(endDate) <= Date.parse(startDate))) {
      alert("Date of Expire should be greater than Date of Issue");
      document.getElementById("passport_expire").value = "";
    }
  });

</script>

</body>

</html>



