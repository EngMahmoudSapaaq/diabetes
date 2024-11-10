<?php

session_start();
if(isset($_SESSION['password'])){
	
    if($_SESSION['type'] == "user"){
        
        $id = $_SESSION['user_id'];
        
    }elseif($_SESSION['type'] == "admin"){
        
        $id = $_SESSION['admin_id'];
        
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
    <link rel="stylesheet" href="css/bootstrap.rtl.css">

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

    <nav class="navbar navbar-expand-lg bg-primary text-light fixed-top">
        <div class="container p-3">
            <a class="navbar-brand fw-bolder fs-3 link-light" href="#">مرض السكري</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link link-light active" href="index.php">الرئيسية</a>
                    <a class="nav-link link-light" href="articles.php">المقالات</a>
                </div>
            </div>
            <div class="d-flex gap-2">
                <?php 
						 
                 if(isset($_SESSION['password'])){

                   if($_SESSION['type'] == "user"){ ?>

                  <a href="user/profile.php" class="btn btn-outline-light p-3">ملفي الشخصي</a>

                  <?php }elseif($_SESSION['type'] == "admin"){  ?>
                     <a href="admin/patients.php" class="btn btn-outline-light p-3">ملفي الشخصي</a>
                     
               <?php  }}else{ ?>
                   <a href="login.php" class="btn btn-outline-light p-3">تسجيل الدخول</a>
                   <a href="register.php" class="btn btn-outline-light p-3">تسجيل جديد</a>
                  <?php } ?>
            </div>
        </div>
    </nav>

    <main class="bg-light">
        <section class="my-5 py-5" id="about-us">

            <div class="container" style="padding-top: 40px">
                <h1 class="fs-9 fw-bold mb-4 text-center">مقالات <b
                        class="text-primary">عن السكري</b></h1>

                <?php

                include('connect.php');  
                $sql = $con->prepare("SELECT * FROM articles");      
                $sql->execute();
                $rows = $sql->fetchAll();

                foreach($rows as $pat)
                {

                ?> 
                <div class="row text-center align-items-center" style="margin-bottom: 40px;">
                    <div class="col-md-6 text-start">
                        <img class="pt-7 pt-md-0 img-fluid rounded" src="<?php echo $pat['image']; ?>" alt="" />
                    </div>

                    <div class="col-md-6 text-md-start">
                        <div class="col-md-12 mb-4">
                            <div class="icon mb-3">
                                <i class="fas fa-file-text fa-3x text-primary"></i>
                            </div>
                            <h3 class="fs-5 fw-bold"><?php echo $pat['title']; ?></h3>
                            <p class="text-secondary"><?php echo $pat['content']; ?></p>
                        </div>

                    </div>

                </div>
                <?php } ?>
                
            </div><!-- end of .container-->

        </section>

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
                                    href="index.php"><i class="fa fa-home me-1" style="width: 25px;"></i>
                                    <span>الرئيسية</span></a>
                            </li>
                            <?php 
						 
                                 if(isset($_SESSION['password'])){

                                   if($_SESSION['type'] == "user"){ ?>

                                   <li class="mb-1"><a
                                    class="fs-4 link-light fw-bolder text-decoration-none d-flex justify-content-start align-items-center"
                                    href="user/profile.php"><i class="fa fa-user me-1" style="width: 25px;"></i>
                                    <span>ملفي الشخصي</span></a>
                                   </li>

                                  <?php }elseif($_SESSION['type'] == "admin"){  ?>
                                      <li class="mb-1"><a
                                    class="fs-4 link-light fw-bolder text-decoration-none d-flex justify-content-start align-items-center"
                                    href="admin/patients.php"><i class="fa fa-user me-1" style="width: 25px;"></i>
                                    <span>ملفي الشخصي</span></a>
                                   </li>

                               <?php  }}else{ ?>
                                   <li class="mb-1"><a
                                    class="fs-4 link-light fw-bolder text-decoration-none d-flex justify-content-start align-items-center"
                                    href="login.php"><i class="fa fa-lock me-1" style="width: 25px;"></i>
                                    <span>تسجيل دخول</span></a>
                            </li>
                            <li class="mb-1"><a
                                    class="fs-4 link-light fw-bolder text-decoration-none d-flex justify-content-start align-items-center"
                                    href="register.php"><i class="fa fa-user-plus me-1" style="width: 25px;"></i>
                                    <span>تسجيل جديد</span></a>
                            </li>
                                  <?php } ?>
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
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- fontawesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
        integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>