<?php
session_start();
include 'config.php';
$selection = $_POST['update_freq'];

// Getting the absolute path
$path;
if ($_SERVER['SERVER_NAME'] === "localhost") {
  $path = 'http://localhost:8888/Metadata';
} else {
  $path = $_SERVER['SERVER_NAME'];
}
?>


<html lang="en">
<head>
  <title>Metadata Management Tool</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="<?php echo $path; ?>/script.js"></script>
  <script>

    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
</head>

<style>
  * {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
  }
  html, body {
      height:100%;
      width:100%;
  }
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    background-color: white;
  }
  .tooltip {
    z-index: 99999;
  }
  .navbar-default {
    padding: 12px 0 10px;
    background-color: white;
    width: 100%;
    margin-bottom: 0;
    z-index: 9999;
  }
  #navbar-title {
    padding-bottom: 0;
    padding-top: 15px;
  }
  .spacing {
      margin-bottom: 100px;
  }
  #searchbar {
    width: 250px;
  }
  .img {
  background-color: #fff;
  width: 50px;
  height: 50px;
  display: block;
  }
  .navbar-brand {
    padding-top: 0;
  }
  .nav-pills {
    margin-top: 4px;
  }
  .nav>li>a {
    color: black;
  }
  .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
        background-color: #D96B27;
  }
 a.dropdown-toggle:focus {
    color: white;
  }
  #top-div h5 {
    font-weight: bold;
  }
  #display {
    position: fixed;
    background-color: white;
    border-bottom: 1px solid #DFE0E5;
    box-shadow: 0 5px 5px -3px #DFE0E5;
    width: 250px;
  }
  #display ul{
    list-style-type: none;
    padding-left: 13px;
    padding-bottom: 6px;
  }
  #display a {
    cursor: pointer;
  }
  .error {
    border-color: #ff0000 !important;
    box-shadow: 0px 1.5px rgba(255, 0, 0, 0.8) !important;
  }
  .success {
    border-color: #4BB543 !important;
    box-shadow: 0px 1.5px rgba(75, 181, 67, 0.8) !important;
  }
  i {
    color: black;
  }
  i:hover {
    color: #D96B27;
    cursor: pointer;
  }
</style>

<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href='<?php echo $path; ?>/Main.php'><img class="img" src='<?php echo $path; ?>/img/logo.png'></a>
        <a class="navbar-brand" id="navbar-title" href='<?php echo $path; ?>/Main.php'>Metadata Management Web Tool</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav navbar-right">
          <!-- If user isn't logged in hide import metadata -->
          <?php
              if (isset( $_SESSION["user"]))
              {
                echo'<li><a href=' . $path . '/import/import_metadata.php>Import Metadata</a></li>';
              }

          echo '<li><a href=' . $path . '/export/export_metadata.php>Export Metadata</a></li>';
          ?>
          <!-- If user isn't logged in show login button -->
          <?php
              if (!isset( $_SESSION["user"])) {
                echo'<li><a href=' . $path . '/user/login.php>Login</a></li>';
              } else {
                $firstCharacter = substr($_SESSION["user"], 0, 1);
                echo'<div class="dropdown" style="display:inline-block; padding-top:8px;">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius:50%; border-color:black; border-style: solid;">
                        '.strtoupper($firstCharacter).'
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li style="padding:2px 10px;">'.$_SESSION["user"].'</li>
                        <hr style="margin:5px 0;">
                        <li><a class="dropdown-item" href=' . $path . '/user/view_dataset.php>View Datasets</a></li>';
                        if ($_SESSION["type"] == 'admin') {
                          echo '<li><a class="dropdown-item" href=' . $path . '/user/manage_user.php>Manage Users</a></li>';
                        }
                  echo'<li><a class="dropdown-item" href=' . $path . '/user/logout.php>Logout</a></li>
                      </div>
                    </div>';
              }
         ?>



          <form class="navbar-form navbar-left" id="searchbar-form" autocomplete="off" action="display.php">
            <div class="form-group">
              <input type="text" id="searchbar" class="form-control" placeholder="Search Dataset" name="search" list="display" required >
              <datalist id="display"></datalist>
            </div>
          </form>
        </ul>


      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
