<?php require_once './includes/header.php'; ?>
<?php
global $conn;

$query = "CREATE TABLE IF NOT EXISTS users(
    id int AUTO_INCREMENT PRIMARY KEY,
    username varchar(100) not null,
    password varchar(256) not null
)";

if (!mysqli_query($conn, $query)) {
    die("Error Occured: ".mysqli_error($conn));
}

$query = "CREATE TABLE IF NOT EXISTS videos(
    id int AUTO_INCREMENT PRIMARY KEY,
    video_title varchar(200) not null,
    description varchar(256) not null,
    video_link varchar(256) not null
)";
if (!mysqli_query($conn, $query)) {
    die("Error Occured: ".mysqli_error($conn));
}

$query = "CREATE TABLE IF NOT EXISTS members(
    id int AUTO_INCREMENT PRIMARY KEY,
    fullname varchar(100) not null,
    affiliation varchar(256) not null,
    nationality varchar(50) not null,
    languages_spoken varchar(256) not null,
    languages_working_on varchar(256) not null,
    country_interesting varchar(256) not null,
    nlp_ml_tasks varchar(5000) not null,
    images varchar(256) not null
)";
if (!mysqli_query($conn, $query)) {
    die("Error Occured: ".mysqli_error($conn));
}
// To create a default login credentials for admin user
// $username = 'Admin';
// $password = "Admin01";
// $password = password_hash($password, PASSWORD_DEFAULT);

// $sql = "SELECT ";

// if ($_SERVER['REUEST_METHOD'] == "POST" && $_SESSION['loggin'] == true) {
// } else {
//     header("Location: login.php");
// }


$members = $videos = $member_success = $video_success = "";
$members_file_error = $video_file_error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['upload_videos'])) {
         // Allowed mime types
        $fileMimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain'
        );

        // Validate whether selected file is a CSV file
        if (!empty($_FILES['videos']['name']) && in_array($_FILES['videos']['type'], $fileMimes)) {
            // Open uploaded CSV file with read-only mode
            $videosCsv = fopen($_FILES['videos']['tmp_name'], 'r');
            // Skip the first line
            fgetcsv($videosCsv);
            // Parse data from CSV file line by line
            // Parse data from CSV file line by line
            while (($videoData = fgetcsv($videosCsv, 10000, ",")) !== FALSE) {
                // Get row data
                $title = $videoData[0];
                $shot_description = $videoData[1];
                $video_link = $videoData[2];

                // If user already exists in the database with the same email
                $query = "SELECT * FROM videos WHERE video_title = '$title'";
                $check = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($check);
                if (mysqli_num_rows($check) > 0) {
                    $sql = "UPDATE videos SET video_title = '$title', description = '$shot_description', video_link = '$video_link' WHERE video_title = '$title'";
                    if (mysqli_query($conn, $sql)) {
                        $video_success = "Video successfully updated";
                    }
                } else {
                    $sql = "INSERT INTO videos (video_title, description, video_link) VALUES('$title', '$shot_description', '$video_link')";
                    if (mysqli_query($conn, $sql)) {
                        $video_success = "Video successfully uploaded";
                    }
                }
            }
            // Close opened CSV file
            fclose($videosCsv);
        }
        else
        {
            $video_file_error = "Please select valid file";
        }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['upload_members'])) {
         // Allowed mime types
        $fileMimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain'
        );

        // Validate whether selected file is a CSV file
        if (!empty($_FILES['members']['name']) && in_array($_FILES['members']['type'], $fileMimes)) {
            // Open uploaded CSV file with read-only mode
            $membersCsv = fopen($_FILES['members']['tmp_name'], 'r');
            // Skip the first line
            fgetcsv($membersCsv);
            // Parse data from CSV file line by line
            while (($memberData = fgetcsv($membersCsv, 10000, ",")) !== FALSE) {
                // Get row data
                $fullName = $memberData[0];
                $Affiliation = $memberData[1];
                $Nationality = $memberData[2];
                $Languages_spoken = $memberData[3];
                $Languages_working_on = $memberData[4];
                $Interesting_thing_about_my_country = $memberData[5];
                $NLP_ML_tasks = $memberData[6];
                $Image = $memberData[7];

                // If member already exists in the database with the same fullname
                $query = "SELECT * FROM members WHERE fullname = '$fullName'";
                $check = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($check);
                if (mysqli_num_rows($check) > 0) {
                    $sql = "UPDATE members SET 
                    fullname = '$fullName', 
                    affiliation = '$Affiliation', 
                    nationality = '$Nationality', 
                    languages_spoken = '$Languages_spoken', 
                    languages_working_on = '$Languages_working_on', 
                    country_interesting = '$Interesting_thing_about_my_country', 
                    nlp_ml_tasks = '$NLP_ML_tasks', 
                    images = '$Image' 
                    WHERE fullname = '$fullName'";
                    if (mysqli_query($conn, $sql)) {
                        $member_success = "Members successfully updated";
                    }
                } else {
                    $sql = "INSERT INTO members(
                        fullname, affiliation, nationality, languages_spoken, languages_working_on, country_interesting, nlp_ml_tasks, images) 
                        VALUES('$fullName', '$Affiliation', '$Nationality', '$Languages_spoken', '$Languages_working_on', '$Interesting_thing_about_my_country', '$NLP_ML_tasks', '$Image')";
                    if (mysqli_query($conn, $sql)) {
                        $member_success = "Members successfully uploaded";
                    }
                }
            }
            // Close opened CSV file
            fclose($membersCsv);
        }
        else
        {
            $members_file_error = "Please select valid file";
        }
}
?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets/img/logo.jpg" alt="">
            <span class="d-none d-lg-block">MASAKHANE</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="assets/img/profile-img.png" alt="Profile" class="rounded-circle">
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>Kevin Anderson</h6>
                        <span>Manager</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="./includes/logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
    </ul>
</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Masakhane</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Data File Upload</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Upload Video Data</h5>
                                        <p class="text-warning text-center small">Allowed filetype is CSV</p>
                                    </div>
                                    <span class="text-success text-center"><?php echo $video_success; ?></span>
                                    <div class="form-group">
                                        <label for="dptfile" class="form-label mt-2">Upload Video Data</label>
                                        <input type="file" class="form-control mb-2" name="videos" id="dptfile">
                                        <span class="text-danger"><?php echo $video_file_error; ?></span>
                                    </div>
                                    <div class="col-12 mb-3 mt-3">
                                        <input class="btn btn-primary w-100" type="submit" name="upload_videos"
                                            value="Upload Departments">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Upload Member Data</h5>
                                        <p class="text-warning text-center small">Allowed filetype is CSV</p>
                                    </div>
                                    <span class="text-success"><?php echo $member_success; ?></span>
                                    <div class="form-group">
                                        <label for="file" class="form-label mt-2">Member File</label>
                                        <input type="file" class="form-control mb-2" name="members" id="file">
                                        <span class="text-danger"><?php echo $members_file_error; ?></span>
                                    </div>
                                    <div class="col-12 mb-3 mt-3">
                                        <input class="btn btn-primary w-100" type="submit" name="upload_members"
                                            value="Upload Members">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- End Left side columns -->
            </div>
    </section>
</main><!-- End #main -->
<?php require_once './includes/footer.php'; ?>