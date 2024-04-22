<?php
session_start();

if (!isset($_SESSION['Login'])) {
    header('location: choose.php');
    exit;
}

require_once('config.php');

$student_id = $_SESSION['Login'];

$sql1 = "SELECT Que_no FROM registrar WHERE IsActive = 1 AND student_id = $student_id ORDER BY Que_no ASC LIMIT 1";

$registrarQueue = "----"; // Default queue numbers if not found

$result1 = mysqli_query($conn, $sql1);
if ($row1 = mysqli_fetch_assoc($result1)) {
    $registrarQueue = $row1['Que_no'];
}

// Function to get the next available queue number
function getNextQueueNumber($conn) {
    $sql = "SELECT MAX(Que_no) AS max_que FROM registrar";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['max_que'] + 1;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['Login']; // Fetching student ID from session
    $student_fullname = substr($_POST['student_name'] ?? '', 0, 100);
    $department = 'registrar'; // Set the department to 'registrar'

    $stmt = $conn->prepare("SELECT * FROM $department WHERE Student_ID = ? AND IsActive = 1");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo 'You already have an active request for this department. Please wait for your turn.';
    } else {
        $que_no = getNextQueueNumber($conn); // Get the next queue number
        $currentDate = date("Y-m-d");

        $stmt = $conn->prepare("INSERT INTO $department (Date, Que_no, Student_ID, student_fullname, IsActive) VALUES (?, ?, ?, ?, 1)");
        $stmt->bind_param("siss", $currentDate, $que_no, $student_id, $student_fullname);

        if ($stmt->execute()) {
            echo 'Priority number reserved successfully. Your queue number is: ' . $que_no;
        } else {
            $error_message = addslashes($stmt->error); // Escape special characters
            echo 'Error: ' . $error_message;
        }

        $stmt->close();
    }
    exit; // Ensure that no other code is executed after echoing the message
}
?><!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Account</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
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
    <style>
      .queue-numbers {
    display: flex;
    align-items: center;
}

.queue-item {
    margin-right: 40px;
    display: flex;
    align-items: center;
}

.queue-item span {
    margin-right: 20px;
}

.queue-number {
    color: #007bff;
    font-size: 40px;
    font-weight: bold;
}

    </style>
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
                        <b>
                            <p style="font-size: 20px; color: blue; text-shadow: 2px 2px 50px #00008b; padding-left: 18px;">S L S U</p>
                        </b>
                    </div>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Profile -->
                    <li class="menu-item active">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div data-i18n="Layouts">Me</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                                <a href="student.php" class="menu-link">
                                    <div data-i18n="Without menu">Profile</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="pages-account-settings-account.php" class="menu-link">
                                    <div data-i18n="Without menu">Que Number</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Request -->
                    <li class="menu-item">
                        <a href="request.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-add-to-queue"></i>
                            <div data-i18n="Analytics">Grades</div>
                        </a>
                    </li>
            </aside>
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
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
                                        <img src="../assets/img/avatars/profile.png" alts class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="student.php">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="../assets/img/avatars/profile.png" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block"></span>
                                                    <small class="text-muted">Student</small>
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
                                  <h5 class="card-header">Active Queue</h5>
                                  <!-- Account -->
                                  <div class="card-body">
                                      <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-5">
                                          <div>
                                              <img src="../assets/img/avatars/profile.png" alt="user-avatar" class="d-block" height="100" width="100" id="uploadedAvatar" style="border-radius: 50px;" />
                                          </div>
                                          <br>
                                          <div class="queue-numbers">
                                              <div class="queue-item">
                                                  <span class="d-block d-md-inline-block mb-md-2">Registrar:</span>
                                                  <span class="queue-number"><?php echo $registrarQueue; ?></span>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div id="formAuthentication" class="mb-3">
    <?php if(isset($message)): ?>
    <p><?php echo $message; ?></p>
    <?php endif; ?>
    <!-- Remove the form and replace it with a button -->
    <button class="btn btn-primary d-grid w-100" onclick="requestQueueNumber()">Request Queue Number</button>
</div>

<script>
    function requestQueueNumber() {
        // Perform AJAX request to PHP script for requesting queue number
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Success response
                    var response = xhr.responseText;
                    alert(response); // Show response message
                    window.location.reload(); // Reload the page to update the queue number display
                } else {
                    // Error response
                    alert('Error: ' + xhr.statusText);
                }
            }
        };

        // Send POST request to the PHP script
        xhr.open('POST', '<?php echo $_SERVER['PHP_SELF']; ?>', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send();
    }
</script>


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