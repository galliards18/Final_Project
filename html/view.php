<?php
session_start();

    if (!isset($_SESSION['isLogin'])) {
        header('location: choose.php');
        exit;
    }

  require_once('config.php');

$student_id = $yearid = $subid = $grades =  "";

$student_id = $_GET['student_id'];
$subid = $_GET['subid']; // Assuming you're passing subject ID through GET parameter

$sql = "SELECT * FROM grades WHERE student_id='$student_id' AND subid='$subid'";

if ($results = mysqli_query($conn, $sql)) {
    // Assuming you're fetching multiple rows of grades for the same student and subject
    while ($data = mysqli_fetch_assoc($results)) {
        $gradesid = $data['gradesid'];
        // Do something with the grades data
    }
}


$id = $firstname = $lastname = $address = $gender = $email = $birthday = $phone =  "";

$student_id = $_GET['student_id'];

$sql = "SELECT * FROM student_registration WHERE student_id='$student_id'";

if ($results = mysqli_query($conn, $sql)) {
    $data = mysqli_fetch_assoc($results);
    $id = $data['id'];
    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $address = $data['address'];
    $gender = $data['gender'];
    $email = $data['email'];
    $birthday = $data['birthday'];
    $phone = $data['phone'];
}
?>
<!DOCTYPE html>
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo" style=" padding: 70px;">
            <div class="logo">
              <img style="border-radius: 500px; box-shadow: 2px 2px 20px #00008b; margin-top: 30px; margin-bottom: 5px;" src="../assets/img/avatars/logo.png" width="100" height="100" alt="">
              <b><p style="font-size: 20px; color: blue; text-shadow: 2px 2px 50px #00008b; padding-left: 18px;">S L S U</p></b>
          </div>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Analytics">Student  </div>
              </a>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
              <a href="registrar/registrar.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-building"></i>
                <div data-i18n="Analytics">Queuing Students</div>
              </a>
            </li>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <center> 
                <p style="font-size: 18px; padding-top: 15px;"><b>Southern Leyte State University</b></p>  
              </center>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/user.png" alts class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/user.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"></span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="logout.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y"> 
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                    <hr class="my-0" />
                    <!-- Form -->
                    <div class="card-body">
                      <form action="#" class="form-control" id="formAccountSettings" method="POST">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <p
                              class="form-control"
                              id="firstName"
                              autofocus
                            /><?php echo $firstname; ?></p>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <p 
                              class="form-control" 
                              id="lastName" 
                            /><?php echo $lastname; ?></p>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="id" class="form-label">Student ID</label>
                            <p
                              class="form-control"
                              id="id"
                            /><?php echo $id; ?></p>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <div class="input-group input-group-merge">
                              <p class="input-group-text">PH</p>
                              <p
                                id="phoneNumber"
                                class="form-control"
                              /><?php echo $phone; ?></p>
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <p
                              class="form-control"
                              id="email"
                            /><?php echo $email; ?></p>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Birth Date</label>
                            <p
                              class="form-control"
                              id="organization"
                            /><?php echo $birthday; ?></p>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <p 
                            class="form-control" 
                            id="address" 
                            /><?php echo $address; ?></p>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="gender" class="form-label">Gender</label>
                            <p 
                            class="form-control" 
                            id="gender" 
                            /><?php echo $gender; ?></p>
                          </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  <br/>
                  <div class="card mb-4">
                    <h5 class="card-header">Grades Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <hr class="my-0" />
                        <!-- Form -->
                        <div class="card-body">
                            <form action="#" class="form-control" id="formAccountSettings" method="POST">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="first" class="form-label">First Subject</label>
                                        <p class="form-control" id="first"><?php echo $grades; ?></p>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="second" class="form-label">Second Subject</label>
                                        <p class="form-control" id="second"><?php echo $subid; ?></p>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="third" class="form-label">Third Subject</label>
                                        <p class="form-control" id="third"><?php echo $subid; ?></p>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="fourth">Fourth Subject</label>
                                        <p class="form-control" id="fourth"><?php echo $subid; ?></p>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="fifth" class="form-label">Fifth Subject</label>
                                        <p class="form-control" id="fifth"><?php echo $subid; ?></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>
                </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">

            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
