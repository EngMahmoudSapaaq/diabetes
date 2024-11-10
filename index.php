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
    <title>مرض السكري</title>

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
        <header>
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/tt.jpeg" style="height: 100vh; object-fit: cover;"
                            class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block bg-primary">
                            <h5>خدمات الكشف المبكر</h5>
                            <p>نحن نقدم خدمات متكاملة للكشف المبكر عن مرض السكري لتجنب المضاعفات.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/tt1.webp" style="height: 100vh; object-fit: cover;"
                            class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block bg-primary">
                            <h5>خدمات المتابعة الدورية</h5>
                            <p>متابعة دقيقة للحالة الصحية لمريض السكري لضمان أفضل مستويات الرعاية.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/tt2.jpg" style="height: 100vh; object-fit: cover;"
                            class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block bg-primary">
                            <h5>الدعم الكامل لمرضى السكري</h5>
                            <p>نحن نقدم الدعم الكامل لمرضى السكري من خلال برامج التوعية والاستشارات الطبية.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </header>
        
        
        <section class="my-5 py-5" id="about-us">

            <div class="container">
                <h1 class="fs-9 fw-bold mb-4 text-center">من <b
                        class="text-primary">نحن</b></h1>

                <div class="row text-center align-items-center">
                    <div class="col-md-6 text-start">
                        <img class="pt-7 pt-md-0 img-fluid rounded" src="assets/img/about2.png" alt="" />
                    </div>

                    <div class="col-md-6 text-md-start">
                        <div class="col-md-12 mb-4">
                            <div class="icon mb-3">
                                <i class="fas fa-heartbeat fa-3x text-primary"></i>
                            </div>
                            <h3 class="fs-5 fw-bold">مهمتنا</h3>
                            <p class="text-secondary">نحن ملتزمون بتقديم الرعاية الصحية الشاملة لمرضى السكري. مهمتنا هي
                                توفير أفضل سبل المتابعة والدعم لضمان صحة أفضل وراحة نفسية للمريض.</p>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="icon mb-3">
                                <i class="fas fa-user-md fa-3x text-primary"></i>
                            </div>
                            <h3 class="fs-5 fw-bold">خدماتنا</h3>
                            <p class="text-secondary">نوفر خدمات طبية شاملة تشمل المتابعة الصحية، مراجعة الفحوصات،
                                وتخزين البيانات الطبية بشكل آمن. نحرص على تقديم الدعم الكامل لمرضانا عبر كل مراحل
                                العلاج.</p>
                        </div>
                    </div>

                </div>
            </div><!-- end of .container-->

        </section>

        <section class="my-5 py-5 bg-primary text-light" id="how-it-works">

            <div class="container">
                <h1 class="fs-9 fw-bold mb-4 text-center ">ما <b
                        class="">نقدمه</b></h1>

                <div class="row text-center">
                    <div class="col-md-3 mb-4">
                        <div class="icon mb-3">
                            <i class="fas fa-stethoscope fa-3x"></i>
                        </div>
                        <h3 class="fs-5 fw-bold">1. متابعة المرضى</h3>
                        <p class="">نوفر خدمة المتابعة المستمرة للمرضى لضمان تحسن حالتهم الصحية وتقديم
                            الاستشارات الطبية اللازمة.</p>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="icon mb-3">
                            <i class="fas fa-file-medical-alt fa-3x "></i>
                        </div>
                        <h3 class="fs-5 fw-bold">2. مراجعة الفحوصات</h3>
                        <p class="">نقوم بمراجعة وتحليل نتائج الفحوصات الطبية لتحديد أفضل مسار علاجي
                            يتناسب مع حالة المريض.</p>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="icon mb-3">
                            <i class="fas fa-database fa-3x "></i>
                        </div>
                        <h3 class="fs-5 fw-bold">3. تخزين بيانات المرضى</h3>
                        <p class="">نؤمن حفظ وتخزين بيانات المرضى الطبية بشكل آمن لضمان الخصوصية وسهولة
                            الوصول إلى المعلومات.</p>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="icon mb-3">
                            <i class="fas fa-file-text fa-3x"></i>
                        </div>
                        <h3 class="fs-5 fw-bold">4. مقالات طبية عن السكري</h3>
                        <p class="">نقدم مقالات طبية عن مرض السكري تفيد المرضى للتوعية</p>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a class="btn btn-primary btn-lg" href="login.php" role="button">سجل من هنا <i
                            class="fa fa-play ms-1" style="scale: -1;"></i></a>
                </div>
            </div><!-- end of .container-->

        </section>

        <header style="margin-top: calc(106px + 3rem) !important;" class="mb-5">

            <div class="row w-100 my-auto justify-content-center align-items-center gap-2">
                <h1 style="text-align: center;margin-bottom: 10px">عن السكري</h1>
                <div class="col-11 p-3 card">
                    <div class="card-top-img d-flex justify-content-center align-items-center gap-1">
                        <iframe style="width: 100%; min-height: 75vh;" src="https://www.youtube.com/embed/XfyGv-xwjlI?si=AEI_k5ukI85eN4kt" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        
                    </div>
                    
                </div>
            
            </div>

        </header>
        
        <section class="my-5 py-5" id="about-us">
            <div class="container">
                <div class="mb-4 text-center d-flex justify-content-center align-items-center gap-4">
                    <h1 class="fs-9 fw-bold">معلومات وزارة الصحة</h1>
                    <img src="assets/img/logo.png" alt="">
                </div>

                <div class="row text-center align-items-center">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-lg-3 col-md-5">
                            <div class="card position-relative" style="width: 18rem;">
                                <img src="assets/img/hh.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">مفاهيم خاطئة عن مرض السكري</h5>
                                </div>
                                <a href="assets/img/hh.png" download class="btn btn-primary btn-lg" style="position: absolute; top: 0; right: 0;"><i class="fa fa-download"></i></a>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-5">
                            <div class="card position-relative" style="width: 18rem;">
                                <img src="assets/img/hh1.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">مفاهيم حول مرض السكري</h5>
                                </div>
                                <a href="assets/img/hh1.png" download class="btn btn-primary btn-lg" style="position: absolute; top: 0; right: 0;"><i class="fa fa-download"></i></a>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-5">
                            <div class="card position-relative" style="width: 18rem;">
                                <img src="assets/img/ww.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">فحوصات السكري</h5>
                                </div>
                                <a href="assets/img/ww.png" download class="btn btn-primary btn-lg" style="position: absolute; top: 0; right: 0;"><i class="fa fa-download"></i></a>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-5">
                            <div class="card position-relative" style="width: 18rem;">
                                <img src="assets/img/ww1.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">ما قبل السكري</h5>
                                </div>
                                <a href="assets/img/ww1.png" download class="btn btn-primary btn-lg" style="position: absolute; top: 0; right: 0;"><i class="fa fa-download"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <div
                        class="col-lg-3 col-md-6 mb-4 mb-lg-0 order-3 order-md-3 order-lg-2 text-start">
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

    <!-- bootstrap bundle -->
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- fontawesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
        integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>