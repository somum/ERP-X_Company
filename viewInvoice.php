<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index.php");
	exit;
}

$email=($_SESSION["email"]);
$name= $_SESSION["employee_name"];
$fname=$lname=$file_name="";
require_once 'config.php';

$sql = "SELECT invoice_id, idate, cname, reference FROM invoice_details ORDER BY idate DESC;";
$result = mysqli_query($conn,$sql);

$sql2 = "SELECT * FROM invoice_details WHERE 1";
// Date filter
if(isset($_POST['date_search'])){
 if(isset($_POST['dateSearch']) && ($_POST['dateSearch'])!=""){
    $date=$_POST['dateSearch'];
      $sql2 .= " and idate 
          = '$date' ";
        }
        // Sort
$sql2 .= " ORDER BY invoice_id ";
$result = mysqli_query($conn,$sql2);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
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
	<link href="./assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
</head>

<body class="">
	<?php include('nav.php'); ?>

	<!-- Page content -->
	<!-- Dark table -->
	<div class="row mt-5" style="min-height: 1000px;">
		<div class="col">
			<div class="card bg-default shadow">
				<div class="row">
					<div class="card-header bg-transparent border-0">
						<h3 class="text-white mb-0">Invoice</h3>
					</div>
					<!-- Search form -->
					<div class="form-inline">
			            <select id="searchby" class="form-control form-control-sm ml-3 w-85" style="color: #32325d">
			              <option value="0">
			                -- search by --  
			              </option>
			              <option value="0">Invoice No
			              </option>
			              <option value="1">Reference
			              </option>
			              <option value="2">Corp. Details
			              </option>
			            </select>
			        </div>
					<form class="form-inline"  style="margin-left: 10px" >
						<i class="fas fa-search" aria-hidden="true"></i>
						<input class="form-control form-control-sm ml-3 w-75" id="myInput" onkeyup="myFunction()" type="text" placeholder="Search"aria-label="Search">
					</form>
					
					<form class="form-inline"method="POST" action="">
			            <input class="form-control form-control-sm ml-3 w-80" type="date"style="color: #32325d;" id="dateSearch" name="dateSearch" placeholder="Search"aria-label="Search">
			            <input style='margin-left: 10px;' type='submit' name='date_search' class="btn btn-sm btn-primary" value='Search'>
			         </form>
				</div>
				<div class="table-responsive">
					<table id="myTable"class="table align-items-center table-dark table-flush">
						<thead class="thead-dark">
							<tr>
								<th style="color: white; font-weight:bold;"scope="col"onclick="sortTable(0)">Invoice Serial No</th>
								<th style="color: white; font-weight:bold;"scope="col">Reference</th>
								<th style="color: white; font-weight:bold;"scope="col">Corporate Details</th>
								<th style="color: white; font-weight:bold;"scope="col"onclick="sortTable(1)">Invoice Date</th>
								<th style="color: white; font-weight:bold;"scope="col"  class="text-right">Options</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while( $row = mysqli_fetch_assoc($result))
								{ ?>    
									<tr>
										<td scope="row">
											<div class="media align-items-center">
												<?php echo $row['invoice_id']; ?>
											</div>
										</td>
										<td>
											<?php  echo $row['reference'] ?>
										</td>
										<td>
											<?php  echo $row['cname'] ?>
										</td>
										<td>
											<?php  echo $row['idate'] ?>
										</td>
										<?php $invoice_id = $row['invoice_id']; ?>
										<td class="text-right">
											<form action="test" method="post">
												<button type="submit" class="btn btn-sm btn-primary" name="invoice_id" value= "<?php  echo $invoice_id ?>">View</button>
											</form>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php include('footer.php'); ?>
		<!--   Core   -->
		<script src="./assets/js/plugins/jquery/dist/jquery.min.js"></script>
		<script src="./assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<!--   Optional JS   -->
		<script src="./assets/js/plugins/chart.js/dist/Chart.min.js"></script>
		<script src="./assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
		<!--   Argon JS   -->
		<script src="./assets/js/argon-dashboard.min.js?v=1.1.0"></script>
		<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>

		<script type="text/javascript">





		</script>
		<script>
			function myFunction() {
		        var input, filter, table, tr, td, i, txtValue;
		        input = document.getElementById("myInput");
		        filter = input.value.toUpperCase();
		        table = document.getElementById("myTable");
		        tr = table.getElementsByTagName("tr");
		        
		        var e = document.getElementById("searchby");
		        var val = e.options[e.selectedIndex].value;
		        for (i = 0; i < tr.length; i++) {

		          td = tr[i].getElementsByTagName("td")[val];
		          if (td) {
		            txtValue = td.textContent || td.innerText;
		            if (txtValue.toUpperCase().indexOf(filter) > -1) {
		              tr[i].style.display = "";
		            } else {
		              tr[i].style.display = "none";
		            }
		          }       
		        }
		      }
			function sortTable(n) {
			  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
			  table = document.getElementById("myTable");
			  switching = true;
			  // Set the sorting direction to ascending:
			  dir = "asc";
			  /* Make a loop that will continue until
			  no switching has been done: */
			  while (switching) {
			    // Start by saying: no switching is done:
			    switching = false;
			    rows = table.rows;
			    /* Loop through all table rows (except the
			    first, which contains table headers): */
			    for (i = 1; i < (rows.length - 1); i++) {
			      // Start by saying there should be no switching:
			      shouldSwitch = false;
			      /* Get the two elements you want to compare,
			      one from current row and one from the next: */
			      x = rows[i].getElementsByTagName("TD")[n];
			      y = rows[i + 1].getElementsByTagName("TD")[n];
			      /* Check if the two rows should switch place,
			      based on the direction, asc or desc: */
			      if (dir == "asc") {
			        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			          // If so, mark as a switch and break the loop:
			          shouldSwitch = true;
			          break;
			        }
			      } else if (dir == "desc") {
			        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			          // If so, mark as a switch and break the loop:
			          shouldSwitch = true;
			          break;
			        }
			      }
			    }
			    if (shouldSwitch) {
			      /* If a switch has been marked, make the switch
			      and mark that a switch has been done: */
			      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			      switching = true;
			      // Each time a switch is done, increase this count by 1:
			      switchcount ++;
			    } else {
			      /* If no switching has been done AND the direction is "asc",
			      set the direction to "desc" and run the while loop again. */
			      if (switchcount == 0 && dir == "asc") {
			        dir = "desc";
			        switching = true;
			      }
			    }
			  }
			}
        </script>

	</body>

	</html>