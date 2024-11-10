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
                <a href="login.php" class="btn btn-outline-light p-3">تسجيل الدخول</a>
                <a href="register.php" class="btn btn-outline-light p-3">تسجيل جديد</a>
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
                            <h1>تسجيل جديد</h1>

                            <?php
            
                                if(isset($_POST['register'])){

                                    include('connect.php');
                                    $fname = $_POST["fname"]; 
                                    $lname = $_POST["lname"]; 
                                    $email = $_POST["email"];   
                                    $phone = $_POST["phone"];   
                                    $gender = $_POST["gender"]; 
                                    $password = sha1($_POST["password"]);
                                    $confirm = sha1($_POST["confirm"]);
                                    $username = $_POST["username"]; 

                                    
                                if($password == $confirm){   

                                $sql=$con->prepare("SELECT * FROM user WHERE 
                                 email=? AND password=?");
                                $sql->execute(array($email,$password));
                                $row=$sql->fetch();
                                $count=$sql->rowCount();


                                if($email != "" && $password != ""){


                                if($count>0){


                                    $sql = $con->prepare("SELECT * FROM  user");
                                    $sql->execute();
                                    $rows = $sql->fetchAll();

                                    foreach($rows as $pat)
                                    {
                                        if($email == $pat["email"] && $password == $pat["password"])
                                        {
                                            echo '
                                     <div class="container" dir="rtl" style="margin-top:80px;color:#000">
                                          <div class="alert alert-danger role="alert" style="color:#000;text-align:center">
                                               البريد الالكتروني أو كلمة المرور خطأ من فضلك أعد المحاولة مرة أخرى
                                         </div>
                                     </div>';
                                        }

                                    }

                                } else{



                                      $sql = "INSERT INTO user (first_name , last_name , email , password , phone , gender , username) VALUES ('$fname' , '$lname' , '$email', '$password' , '$phone' , '$gender' , '$username')";

                                      $con->exec($sql);

                                     

                                     echo '
                                     <div class="container" dir="rtl" style="margin-top:80px;color:#000">
                                          <div class="alert alert-success role="alert" style="color:#000;text-align:center">
                                              تم انشاء حسابك بنجاح
                                         </div>
                                     </div>';


                                      }}else{


                                    //include('logout.php');
                                    include('register.php');

                                }	
                                    
                                }else{
                                
                                 echo '
                                     <div class="container" dir="rtl" style="margin-top:80px;color:#000">
                                          <div class="alert alert-danger role="alert" style="color:#000;text-align:center">
                                               كلمة المرور غير متطابقة
                                         </div>
                                     </div>';
                                
                                
                                }


                              }






                            ?> 
                            <div class="mt-5 row w-100 justify-content-center">
                                <div class="col-5 mb-5">
                                    <img src="assets/img/about.png" width="100%" alt="">
                                </div>
                                <form method="post" class="col-lg-4 col-md-6">

                                    <div class="mt-3">
                                        <label for="fname">الاسم الأول <span class="text-primary-darker">*</span></label>
                                        <input required type="text" name="fname" id="fname" class="form-control text-start">
                                    </div>

                                    <div class="mt-3">
                                        <label for="lname">الاسم الثاني <span class="text-primary-darker">*</span></label>
                                        <input required type="text" name="lname" id="lname" class="form-control text-start">
                                    </div>

                                    <div class="mt-3">
                                        <label for="gender">النوع <span class="text-primary-darker">*</span></label>
                                        <select required id="gender" name="gender" class="form-control text-start">
                                            <option value="">-- اختر النوع --</option>
                                            <option value="">ذكر</option>
                                            <option value="">انثى</option>
                                        </select>
                                    </div>

                                    <div class="mt-3">
                                        <label for="phone">رقم الهاتف <span class="text-primary-darker">*</span></label>
                                        <input required type="text" name="phone" id="phone" class="form-control text-start">
                                    </div>

                                    <div class="mt-3">
                                        <label for="username">اسم المستخدم <span class="text-primary-darker">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-light" id="basic-addon1">@</span>
                                            <input required type="text" name="username" id="username" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <label for="email">البريد الالكتروني <span class="text-primary-darker">*</span></label>
                                        <input required type="email" name="email" id="email" class="form-control text-start">
                                    </div>

                                    <div class="mt-3">
                                        <label for="password">كلمة المرور <span class="text-primary-darker">*</span></label>
                                        <input required type="password" name="password" id="password" class="form-control text-start">
                                    </div>

                                    <div class="mt-3">
                                        <label for="password_confirmation">تأكيد كلمة المرور <span class="text-primary-darker">*</span></label>
                                        <input required type="password" id="password_confirmation" name="confirm" class="form-control text-start">
                                    </div>

                                    <div class="text-center text-md-start mt-3">
                                        <button class="btn btn-primary me-3 btn-lg" name="register" type="submit" role="button">
                                            سجل <i class="fa fa-arrow-left"></i>
                                        </button>
                                        <a class="btn-link text-primary fw-medium" href="login.php" role="button">
                                            لديك حساب بالفعل؟
                                        </a>
                                    </div>
                                </form>
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
                                    href="index.php"><i class="fa fa-home me-1" style="width: 25px;"></i>
                                    <span>الرئيسية</span></a>
                            </li>
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