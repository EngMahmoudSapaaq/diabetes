<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:../index.php');
    exit;
}

if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:../index.php');
    exit;
}

$user_activities = mysqli_query($conn, "SELECT * FROM `user_activities` WHERE user_id = '$user_id'") or die('Query failed: ' . mysqli_error($conn));

// Initialize hourly data
$hourly_data = [];
$hourly_labels = [];

// Get the current date in 'Y-m-d' format
$current_date = date('Y-m-d');

// Fetch times and insulin doses for the current date
$result = mysqli_query($conn, "
    SELECT TIME(`date`) as dose_time, SUM(`current_sugar_amount`) as total_sugar
    FROM `insulin_dose`
    WHERE user_id = '$user_id' AND DATE(`date`) = '$current_date'
    GROUP BY dose_time
    ORDER BY dose_time ASC
") or die('Query failed: ' . mysqli_error($conn));

// Populate the data arrays
while ($row = mysqli_fetch_assoc($result)) {
    $time_label = date("g:i A", strtotime($row['dose_time']));
    $hourly_labels[] = $time_label;
    $hourly_data[] = $row['total_sugar'];
}

// Encode data for JavaScript
echo "<script>
        const X1 = " . json_encode($hourly_labels) . ";
        const Y1 = " . json_encode($hourly_data) . ";
      </script>";
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
            <header style="margin-top: calc(106px) !important;" class="position-relative">
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
                                    <div class="col-lg-7 col-md-8 col-12">
                                        <h1 class="text-center mb-3"><strong>سجلات قياسات السكر</strong></h1>
                                        <div class="table-reponsive">
                                            <table class="table">
                                                <thead>
                                                    <tr class="table-dark">
                                                        <th>#</th>
                                                        <th>التاريخ والوقت</th>
                                                        <th>مستوى السكر</th>
                                                        <th>كمية السكر</th>
                                                        <th>جرعة الأنسولين</th>
                                                        <th>الأنشطة</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php
$i = 0;
if (isset($user_activities) && mysqli_num_rows($user_activities) > 0) {
    while ($user_activitie = mysqli_fetch_assoc($user_activities)) {
        $i++;
        $activity_id = $user_activitie['activity_id'] ?? null;
        $insulin_dose_id = $user_activitie['insulin_dose_id'] ?? null;
        if (isset($activity_id) && isset($insulin_dose_id)) {
            $activities = mysqli_query($conn, "SELECT * FROM `activities` WHERE activity_id = '$activity_id'") or die('Query failed: ' . mysqli_error($conn));
            $activitie = mysqli_fetch_assoc($activities);
            $insulin_doses = mysqli_query($conn, "SELECT * FROM `insulin_dose` WHERE insulin_dose_id = '$insulin_dose_id'") or die('Query failed: ' . mysqli_error($conn));
            $insulin_dose = mysqli_fetch_assoc($insulin_doses);
            if (isset($insulin_dose['date']) && isset($insulin_dose['sugar_level']) && isset($insulin_dose['current_sugar_amount']) && isset($insulin_dose['insulin_dose'])) {
                $activitie_user  = empty($activitie['activity']) ? '' : $activitie['activity'];
                echo ' <tr>
                                                    <th scope="row">' . $i . '</th>
                                                    <td>' . $insulin_dose['date'] . '</td>
                                                    <td>' . $insulin_dose['sugar_level'] . '</td>
                                                    <td>' . $insulin_dose['current_sugar_amount'] . '</td>
                                                    <td>' . $insulin_dose['insulin_dose'] . '</td>
                                                    <td>
                                                        <ul>
                                                            <li>' . $activitie_user . '</li>
                                                        </ul>
                                                    </td>
                                                </tr>';
            }
        }
    }
} else {
    echo ' <tr>
                                                    <th scope="row"></th>
                                                    <td>لا يوجد بيانات متوفرة .</td>
                                                    <td></td>
                                                   <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>';
}
?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-10 mb-5 text-center">
                                        <h1><b>تقرير يومي</b></h1>
                                        <canvas id="dialyChart" class="col-12"></canvas>
                                    </div>
                                    <div class="col-10 mb-5 text-center">
                                        <h1><b>تقرير شهري</b></h1>
                                        <canvas id="monthlyChart" class="col-12"></canvas>
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

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
    const ctx1 = document.getElementById('dialyChart').getContext('2d');

    const dailyChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: X1,  // Dynamic time labels from PHP
            datasets: [{
                label: 'كمية السكر اليومية في الدم',
                data: Y1,  // Dynamic sugar levels from PHP
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: (context) => `Time: ${context.label}, Value: ${context.raw}`
                    }
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Blood Sugar Levels'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Time of Day'
                    }
                }
            },
            onClick: (evt, item) => {
                if (item.length > 0) {
                    const index = item[0].index;
                    const value = Y1[index];
                    const label = X1[index];
                    window.location.href = `activities.php?date=${label}&sugar=${value}`;
                }
            }
        }
    });
</script>



        <!-- bootstrap bundle -->
        <script src="../js/bootstrap.bundle.min.js"></script>

        <!-- fontawesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
                integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </body>

</html>