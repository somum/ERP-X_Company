<?php
$email=($_SESSION["email"]);
?>
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id=" ">
  <div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="navbar-brand pt-0" href="./index">
      <img src="./assets/img/brand/sair.png" class="navbar-brand-img" alt="...">
    </a>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
      
      <!-- Navigation -->
      <ul class="navbar-nav">
        <li class="nav-item" >
          <a class=" nav-link " href=" ./index"> 
            <i class="ni ni-tv-2 text-primary"></i><span style="color: black;">Dashboard<span>
          </a>
        </li>
        <?php
          if (strpos($email, 'sairbd') == true) {?>
                <?php echo'<li class="nav-item" >
          <a class=" nav-link " href=" ./viewAgentIata"> 
            <i class="ni ni-circle-08 text-primary"></i><span style="color: black;">Agent Details<span>
          </a>
        </li>';}?>
        <li class="nav-item">
          <a href="#pageSubmenu" data-toggle="collapse" class="nav-link"  aria-expanded="false" class="dropdown-toggle">
            <i class="ni ni-user-run text-indigo "></i> <span style="color: black;">Passengers Menu<span>
          </a>
          <ul class="collapse list-unstyled" id="pageSubmenu">
              <li class="nav-item">
                <a class="nav-link " href="./viewPassengers">
                  <i class="ni ni-single-02 text-orange "></i> <span style="color: black;">Search Passengers<span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="./addPassengers">
                  <i class="fa fa-user-plus text-green"></i> <span style="color: black;">Add Passengers<span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="./searchPassengers">
                  <i class="ni ni-circle-08 text-blue"></i> <span style="color: black;">Date Inquiry<span>
                </a>
              </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./corporateDetails">
            <i class="ni ni-archive-2 text-black"></i> <span style="color: black;">Corporate Details<span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./refDetails">
            <i class="ni ni-caps-small text-green"></i> <span style="color: black;">Reference Details<span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#pageSubmenu2" data-toggle="collapse" class="nav-link"  aria-expanded="false" class="dropdown-toggle">
            <i class="ni ni-check-bold text-indigo "></i> <span style="color: black;">Invoice Menu<span>
          </a>
          <ul class="collapse list-unstyled" id="pageSubmenu2">
           <li class="nav-item">
            <a class="nav-link " href="./createInvoice">
              <i class="ni ni-ruler-pencil text-red"></i> <span style="color: black;">Create Invoice<span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./viewInvoice">
                <i class="ni ni-bullet-list-67 text-info"></i> <span style="color: black;">View Invoice<span>
                </a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="./officeSearch">
                <i class="ni ni-bullet-list-67 text-success"></i> <span style="color: black;">Office Invoice<span>
              </a>
            </li>
          </ul>
        </li>
   
        <li class="nav-item">
          <a class="nav-link" href="./logout">
            <i class="ni ni-button-power text-red"></i> <span style="color: black;">Logout<span>
          </a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
<div class="main-content">
  <!-- Navbar -->
  <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
      <!-- Brand -->
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index">Dashboard</a>
      
      <!-- User -->
      <ul class="navbar-nav align-items-center d-none d-md-flex">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="./assets/img/brand/profile-pic.jpg">
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold"><?php echo $email?></span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="./dashboard" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="logout" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- End Navbar -->
  <!-- Header -->
  <div class="" style="min-height: 100px; background-color:#172B4D;">
  
  </div>
