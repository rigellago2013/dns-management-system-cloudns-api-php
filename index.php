<?php
$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DNS Manager</title>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <link rel="stylesheet" href="assets/css/font-awesome.min.css"/>
  <link rel="stylesheet" href="assets/css/style.css"/>
  <link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css" />
</head>
<body>
<div class="wrapper d-flex align-items-stretch ">
    <?php include('./public/views/partials/sidenav.php'); ?>
    <div id="content" class="p-4 p-md-5">
      <?php include('./public/views/partials/topnav.php'); ?>
      <div class="modules">
        <?php
        switch ($module) {
          case 'index':
            require_once('./public/views/dashboard.php');
            break;
          case 'domains':
            require_once('./app/modules/domains/index.php');
            break;
          case 'accounts':
            require_once('./app/modules/accounts/index.php');
            break;
          case 'dns':
            require_once('./app/modules/dnsrecords/index.php');
            break;
          case 'logs':
            require_once('./app/modules/logs/index.php');
            break;
          default:
            require_once('./public/views/dashboard.php');
            break;
        }
        ?>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
  <script type="text/javascript" src="assets/js/popper.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/datatables.min.js"></script>
  <script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>