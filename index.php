<?php
date_default_timezone_set("Asia/Jakarta");
session_start();
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPK KOST</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
</head>
<body>

<!-- cek status login atau belum -->
<?php 
    if($_SESSION['status']!="success"){
        header("Location:login.php");
    }
?>

<nav class="navbar navbar-dark bg-primary border navbar-expand-sm fixed-top">
    <a class="navbar-brand" href="#">SPK PEMILIHAN KOST</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item active ml-4"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home </a></li>
        <li class="nav-item active ml-4"><a class="nav-link" href="?page=kost"><i class="fas fa-house-user"></i> Alternatif </a></li>
        <li class="nav-item active ml-4"><a class="nav-link" href="?page=kriteria"><i class="fas fa-door-closed"></i> Kriteria </a></li>
        <li class="nav-item active ml-4"><a class="nav-link" href="?page=cripskriteria"><i class="fas fa-door-open"></i> Crips Kriteria </a></li>
        <li class="nav-item active ml-4"><a class="nav-link" href="?page=penilaian"><i class="fas fa-balance-scale"></i> Penilaian </a></li>
        <li class="nav-item active ml-4"><a class="nav-link" href="?page=perangkingan&thn="><i class="fa fa-trophy"></i> Perangkingan </a></li>
        <li class="nav-item active ml-4"><a class="nav-link" href="?page=laporan"><i class="fa fa-print"></i> Laporan </a></li>
        <li class="nav-item active ml-4"><a class="nav-link" href="?page=logout"><i class="fa fa-window-close"></i> Logout </a></li>
    </ul>
</nav>

<div class="container" style="margin-top:100px;margin-bottom:100px">
    <?php

        // pengaturan menu
        $page = isset($_GET['page']) ? $_GET['page'] : "";
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        if ($page==""){
            include "welcome.php";
        }elseif ($page=="kost"){
            if ($action==""){
                include "tampil_kost.php";
            }elseif($action=="tambahalternatif"){
                include "tambah_kost.php";
            }elseif($action=="updatealternatif"){
                include "update_kost.php";
            }else{
                include "hapus_kost.php";
            }
        }elseif ($page=="kriteria"){
            if ($action==""){
                include "tampil_kriteria.php";
            }elseif($action=="tambahkriteria"){
                include "tambah_kriteria.php";
            }elseif($action=="updatekriteria"){
                include "update_kriteria.php";
            }else{
                include "hapus_kriteria.php";
            }
        }elseif ($page=="cripskriteria"){
            if ($action==""){
                include "tampil_cripskriteria.php";
            }elseif($action=="tambahcripskriteria"){
                include "tambah_cripskriteria.php";
            }elseif($action=="updatecripskriteria"){
                include "update_cripskriteria.php";
            }else{
                include "hapus_cripskriteria.php";
            }
        }elseif ($page=="penilaian"){
            if ($action==""){
                include "tampil_penilaian.php";
            }elseif($action=="tambahpenilaian"){
                include "tambah_penilaian.php";
            }elseif($action=="updatepenilaian"){
                include "update_penilaian.php";
            }else{
                include "hapus_penilaian.php";
            }
        }elseif ($page=="perangkingan"){
            if ($action==""){
                include "perangkingan.php";
            }
        }elseif ($page=="laporan"){
            if ($action==""){
                include "laporan.php";
            }
        }else{
            if ($action==""){
                include "logout.php";
            }
        }
    ?>
</div>

    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/all.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script>
       $(document).ready(function () {
           $('#myTable').dataTable();
       });
    </script>

    <script src="assets/js/chosen.jquery.min.js"></script>
    <script>
     $(function() {
       $('.chosen').chosen();
     });
    </script>

</body>
</html>