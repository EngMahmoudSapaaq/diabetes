<?php
include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:../index.php');
};

if (isset($_GET['logout'])) {
    unset($admin_id);
    session_destroy();
    header('location:../index.php');
}
 $user_id= $_GET['user_id'] ?? null;
$users = mysqli_query($conn, "SELECT * FROM `user` WHERE user_id = '$user_id'") or die('Query failed: ' . mysqli_error($conn));
$user =mysqli_fetch_assoc($users);
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
                    <a class="nav-link link-light" href="patients.php">حسابات المرضى</a>
                    <a class="nav-link link-light active" href="articles.php">المقالات</a>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="../login.php" class="btn btn-primary btn btn-outline-light p-3">تسجيل خروج</a>
            </div>
        </div>
    </nav>

    <main class="bg-light">
        <header>
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false" style="margin-bottom: 40px;">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div style="
                                /*background-image: url(assets/img/login.avif);*/
                                background-position: center;
                                background-size: cover;
                                min-height: 100vh;
                                padding-top: 150px;
                                display: flex !important;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;
                            " class="d-block w-100">
                            <h1>بيانات المريض</h1>

                            <div class="mt-5 row w-100 justify-content-center">
                                
                                    <div class="row">
                                        <div class="col-lg-2">
                                          <img src="../assets/img/user.svg" style="width: 400px;height: 400px;">
                                        </div>
                                        <div class="col-lg-2"></div>
                                        <form action="#" class="col-lg-6 col-md-6">

                                            <div class="mt-3">
                                                <label for="fname">الاسم الأول <span class="text-primary-darker">*</span></label>
                                                <input type="text" readonly value="<?php echo $user['first_name'];  ?>" id="fname" required class="form-control text-start">
                                            </div>
        
                                            <div class="mt-3">
                                                <label for="lname">الاسم الثاني <span class="text-primary-darker">*</span></label>
                                                <input type="text" readonly value="<?php echo $user['last_name'];  ?>" id="lname" required class="form-control text-start">
                                            </div>
        
                                            <div class="mt-3">
                                                <label for="phone">النوع <span class="text-primary-darker">*</span></label>
                                                <input readonly value="<?php echo $user['gender'];  ?>" required type="text" id="phone" class="form-control text-start">
                                            </div>
        
                                            <div class="mt-3">
                                                <label for="phone">رقم الهاتف <span class="text-primary-darker">*</span></label>
                                                <input readonly value="<?php echo $user['phone'];  ?>" required type="text" id="phone" class="form-control text-start">
                                            </div>
        
                                            <div class="mt-3">
                                                <label for="username">اسم المستخدم <span class="text-primary-darker">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-primary text-light" id="basic-addon1">@</span>
                                                    <input readonly value="<?php echo $user['username'];  ?>" required type="text" name="username" id="username" class="form-control">
                                                </div>
                                            </div>
        
                                            <div class="mt-3">
                                                <label for="email">البريد الالكتروني <span class="text-primary-darker">*</span></label>
                                                <input readonly value="<?php echo $user['email'];  ?>" required type="email" id="email" class="form-control text-start">
                                            </div>
        
                                           
                                        </form>
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
                                    href="patients.php"><i class="fa fa-users me-1" style="width: 25px;"></i>
                                    <span>حسابات المرضى</span></a>
                            </li>
                            <li class="mb-1"><a
                                    class="fs-4 link-light fw-bolder text-decoration-none d-flex justify-content-start align-items-center"
                                    href="articles.php"><i class="fa fa-file-text me-1" style="width: 25px;"></i>
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