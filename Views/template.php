<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>POS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="Views/img/template/icono-negro.png">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="Views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Views/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="Views/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Views/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="Views/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="Views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- DataTables -->
  <link rel="stylesheet" href="Views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="Views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- jQuery 3 -->
  <script src="Views/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="Views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="Views/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="Views/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="Views/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="Views/dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="Views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="Views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="Views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="Views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <script>
    $(document).ready(function () {
      $('.sidebar-menu').tree()
    })
  </script>

</head>
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
  
  <?php

    if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {

      echo '<div class="wrapper">';

      /*=============================================
      CABECERA
      =============================================*/
      include "modules/header.php";

      /*=============================================
      MENU LATERAL
      =============================================*/
      include "modules/menu.php";

      /*=============================================
      MODULOS
      =============================================*/
      if (isset($_GET["index"])){

        switch ($_GET["index"]) {
          case 'home':
            include "modules/home.php";
          break;

          case 'users':
            include "modules/users.php";
          break;

          case 'categories':
            include "modules/categories.php";
          break;

          case 'products':
            include "modules/products.php";
          break;

          case 'customers':
            include "modules/customers.php";
          break;

          case 'sales':
            include "modules/sales.php";
          break;

          case 'create-sales':
            include "modules/create-sales.php";
          break;

          case 'report-sales':
            include "modules/report-sales.php";
          break;

          case 'logout':
            include "modules/logout.php";
          break;
          
          default:
            include "modules/404.php";
          break;
        }
      }else{
        include "modules/home.php";
      }

      /*=============================================
      PIE DE PAGINA
      =============================================*/
      include "modules/footer.php";

      echo '</div>';
    }else{
      include "modules/login.php";
    }
  ?>

<script src="Views/js/template.js"></script>

</body>
</html>
