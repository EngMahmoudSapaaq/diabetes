<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:../index.php');
};
if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:../index.php');
}

if (isset($_POST['submit'])) {

    $current_sugar_amount = mysqli_real_escape_string($conn, $_POST['current_sugar_amount']);
    $medicinen_name = mysqli_real_escape_string($conn, $_POST['medicinen_name']);

    if (!empty($_POST['user_activities'])) {
        foreach ($_POST['user_activities'] as $check) {
            $activity_id = $check;
        }
    }
//--------------------------------
    $doses = 0;
    $level = ' ';
    if ($current_sugar_amount < 90) {

        $doses += 0;
        $level = "منخفض";
    } elseif ($current_sugar_amount >= 90 && $current_sugar_amount < 200) {

        $doses += 20;
        $level = "طبيعية";
    } elseif ($current_sugar_amount >= 200 && $current_sugar_amount < 250) {

        $doses += 5;
        $level = "عالي";
    } elseif ($current_sugar_amount > 250) {

        $doses += (($current_sugar_amount - 250) / 50) * 5;
        $level = $doses > 25 ? 'عالي جدا ' : 'طبيعية';
    }


    $insert1 = mysqli_query($conn, "INSERT INTO `insulin_dose` (medicinen_name , current_sugar_amount , insulin_dose , sugar_level , user_id)"
            . " VALUES('$medicinen_name','$current_sugar_amount', '$doses', '$level', '$user_id')") or die('query failed');

    $insulin_dose = mysqli_query($conn, "SELECT insulin_dose_id FROM `insulin_dose` ORDER BY insulin_dose_id DESC LIMIT 1") or die('Query failed: ' . mysqli_error($conn));
    $rowshh=mysqli_fetch_assoc($insulin_dose);
    $insulin_dose_id = $rowshh['insulin_dose_id'];
    $insert = mysqli_query($conn, "INSERT INTO `user_activities` (activity_id , user_id , insulin_dose_id)"
            . " VALUES('$activity_id ','$user_id', '$insulin_dose_id')") or die('query failed');
    if ($insert) {
        $message1[] = ' تم حساب نسبة الانسولين بنجاح';
    } else {
        $message[] = 'لقد حدث خطأ ما في حساب الانسولين!';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>الكشف عن السكري</title>

        <!-- bootstrap RTL -->
        <link rel="stylesheet" href="../css/bootstrap.rtl.css">

        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
              integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- animate css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
              integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

        <!-- styles -->
        <style>
            * {
                font-family: "Cairo", sans-serif;
                font-optical-sizing: auto;
                font-weight: 400;
                font-style: normal;
                font-variation-settings:
                    "slnt"0;
            }
            .message{
                margin:10px 0;
                width: 100%;
                border-radius: 5px;
                padding:10px;
                text-align: center;
                background-color:red;
                color:white;
                font-size: 20px;
            }
            .message1{
                margin:10px 0;
                width: 100%;
                border-radius: 5px;
                padding:10px;
                text-align: center;
                background-color:green;
                color:white;
                font-size: 20px;
            }
        </style>

    </head>

    <body class="">

        <nav class="navbar navbar-expand-lg bg-primary text-light fixed-top" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="container p-3">
                <a class="navbar-brand link-light fw-bolder fs-3" href="#">مرض السكري</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link link-light" href="../index.php">الرئيسية</a>
                        <a class="nav-link link-light active" href="../articles.php">المقالات</a>
                        <a class="nav-link link-light" href="profile.php">الملف الشخصي</a>
                        <a class="nav-link link-light" href="medical_information.php">البيانات الطبيه والأعراض</a>
                        <a class="nav-link link-light active" href="ansulin_calc.php">حساب الأنسولين</a>
                        <a class="nav-link link-light active" href="activities.php">الأنشطة</a>
                        <a class="nav-link link-light active" href="hisotry.php">سجلات قياسات السكر</a>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="../login.php" class="btn btn-primary btn btn-outline-light p-3">تسجيل خروج</a>

                </div>
            </div>
        </nav>

        <main class="bg-light">
            <header style="margin-top: calc(106px) !important;" >
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div style="
                                 /*background-image: url(assets/img/login.avif);*/
                                 background-position: center;
                                 background-size: cover;
                                 min-height: 100vh;
                                 display: flex !important;
                                 flex-direction: column;
                                 align-items: center;
                                 justify-content: center;
                                 " class="d-block w-100">

                                <div class="mt-5 row w-100 justify-content-center align-items-center">
                                    <div class="col-lg-5 col-md-6">
                                        <h1 class="text-center"><strong>حساب نسبة الأنسولين في الدم</strong></h1>
                                        <?php
                                        if (isset($message)) {
                                            foreach ($message as $message) {
                                                echo '<div class="message">' . $message . '</div>';
                                            }
                                        } elseif (isset($message1)) {
                                            foreach ($message1 as $message1) {
                                                echo '<div class="message1">' . $message1 . '</div>';
                                            }
                                        }
                                        ?>
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="mt-3">
                                                <label for="name">الأعراض الطبية أو اسم المرض <span class="text-primary-darker">*</span></label>
                                                <textarea style="height: 200px" type="text" name="medicinen_name" id="name" class="form-control text-start" placeholder="الأعراض الطبية أو اسم المرض"></textarea>
                                            </div>

                                            <div class="mt-3">
                                                <label for="sugar">كمية السكر الحالية <span class="text-primary-darker">*</span></label>
                                                <input type="number" id="sugar" name="current_sugar_amount" class="form-control text-start" placeholder="كمية السكر الحالية">
                                            </div>
                                            <div class="mt-3" name="user_activities[]">
                                                <label for="gender">الانشطة <span class="text-primary-darker">*</span></label>
                                                <select required id="gender" name="user_activities[]" class="form-control text-start">
                                                    <option value="">-- اختر النوع --</option>
                                                    <?php
                                                    $activities = mysqli_query($conn, "SELECT * FROM `activities` WHERE user_id = '$user_id'") or die('Query failed: ' . mysqli_error($conn));
                                                    if (isset($activities) && mysqli_num_rows($activities) > 0) {
                                                        while ($activitie = mysqli_fetch_assoc($activities)) {
                                                            echo ' <option value="' . $activitie['activity_id'] . '" >' . $activitie['activity'] . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="" selected>لا يوجد انشطة متوفرة</option>';
                                                    }
                                                    ?>


                                                </select>
                                            </div>

                                            <div class="text-center text-md-start mt-3">
                                                <button class="btn btn-primary me-3 btn-lg" type="submit" name="submit"  id="calc-btn">
                                                    حساب <i class="fa fa-calculator"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-5 mb-5 text-center" id="result-container">
                                        <img src="../assets/img/calc.png" width="75%" alt="" id="calc-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <section class="pb-2 pb-lg-5 bg-primary">

                <div class="container p-5">
                    <div
                        class="row  pt-5 justify-content-between align-items-center">
                        <div
                            class="col-lg-3 col-md-6 mb-4 mb-md-6 mb-lg-0 mb-sm-2 order-1 order-md-1 order-lg-1 text-center">
                            <!-- <img class="mb-4"
                        src="assets/img/logo2.png" width="184" alt="" /> -->
                            <h1 class="text-light fw-bolder">مرض السكري</h1>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 order-3 order-md-3 order-lg-2 text-start">
                            <p class="fs-1 mb-lg-4 text-light fw-bolder">روابط</p>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1"><a
                                        class="fs-4 link-light fw-bolder text-decoration-none d-flex justify-content-start align-items-center"
                                        href="../index.php"><i class="fa fa-home me-1" style="width: 25px;"></i>
                                        <span>الرئيسية</span></a>
                                </li>
                                <li class="mb-1"><a
                                        class="fs-4 link-light fw-bolder text-decoration-none d-flex justify-content-start align-items-center"
                                        href="profile.php"><i class="fa fa-user me-1" style="width: 25px;"></i>
                                        <span>الملف الشخصي</span></a>
                                </li>
                                <li class="mb-1"><a
                                        class="fs-4 link-light fw-bolder text-decoration-none d-flex justify-content-start align-items-center"
                                        href="../articles.php"><i class="fa fa-file-text me-1" style="width: 25px;"></i>
                                        <span>المقالات</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- end of .container-->
                <p style="text-align: center;color: #FFF;">حقوق النشر محفوظة لدى &copy; مرض السكري</p>
            </section>
        </main>

        <footer>

        </footer>



        <!-- bootstrap bundle -->
        <script src="../js/bootstrap.bundle.min.js"></script>

        <!-- fontawesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
                integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </body>

</html>