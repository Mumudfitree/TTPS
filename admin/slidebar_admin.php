<?php 
    if (!isset($_SESSION['admin_login'])) {
        header("location: ../index.php");
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <style>
    .pull-right {
        text-align: right;
        color: white;
    }

    /* Fixed sidenav, full height */
    .sidenav {
        height: 100%;
        width: 200px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        padding-top: 20px;
    }

    /* Style the sidenav links and the dropdown button */
    .sidenav a,
    .dropdown-btn {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 20px;
        color: #818181;
        display: block;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
    }

    /* On mouse-over */
    .sidenav a:hover,
    .dropdown-btn:hover {
        color: #f1f1f1;
    }

    /* Main content */
    .main {
        margin-left: 200px;
        /* Same as the width of the sidenav */
        font-size: 20px;
        /* Increased text to enable scrolling */
        padding: 0px 10px;
    }

    /* Add an active class to the active dropdown button */
    .active {
        background-color: green;
        color: white;
    }

    /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
    .dropdown-container {
        display: none;
        background-color: #303030;/*#262626*/
        padding-left: 8px;
    }

    /* Optional: Style the caret down icon */
    .fa-caret-down {
        float: right;
        padding-right: 8px;
    }

    /* Some media queries for responsiveness */
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="col-md-12">
            <div class="pull-right">คุณ: <?php echo $_SESSION['User']; ?>&ensp;สถานะในตอนนี้:
                <?php echo $_SESSION['Role'];?>
            </div>
        </div>
        <!--/.col -->
    </nav>

    <!--<div class="sidebar">
        <a href="admin_home.php"><i class="fa fa-fw fa-home"></i> หน้าหลัก</a>
        <a href="index.php"><i class="fa fa-fw fa-user"></i> สมาชิก</a>
        <a href="role_type.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                <path
                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
            </svg> บทบาทผู้ใช้</a>
        <a href="grade_level.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-bookmark-dash" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                <path
                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
            </svg> ระดับชั้น</a>
        <a href="classroom.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-card-list" viewBox="0 0 16 16">
                <path
                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                <path
                    d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
            </svg> ชั้นเรียน</a>
        <a href="subject.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-book-half" viewBox="0 0 16 16">
                <path
                    d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
            </svg> วิชา</a>
        <a href="year.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-book-half" viewBox="0 0 16 16">
                <path
                    d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
            </svg> ปีการศึกษา</a>
        <a href="time.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-book-half" viewBox="0 0 16 16">
                <path
                    d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
            </svg> เวลาของการเรียน</a>
        <a href="choose_a_teaching.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path
                    d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z" />
            </svg> หน้าที่ครู</a>
        <a href="###" onclick=" logout()"><i class="fa fa-sign-out"></i> ออกจากระบบ</a>

    </div>
    <script>
    function logout() {
        var reallyLogout = confirm("คุณต้องการออกจากระบบใช่หรือไม่?");
        if (reallyLogout) {
            location.href = "../logout.php";
        }
    }
    var el = document.getElementById("logout");
    if (el.addEventListener) {
        el.addEventListener("click", logoutfunction, false);
    } else {
        el.attachEvent('onclick', logoutfunction);
    }
    </script>-->
    <div class="sidenav">
        <a href="admin_home.php">หน้าหลัก</a>
        <button class="dropdown-btn">สมาชิก
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="add.php">เพิ่มข้อมูล</a>
            <a href="index.php">รายละเอียด</a>
        </div>
        <button class="dropdown-btn">บทบาทผู้ใช้
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="add_role.php">เพิ่มข้อมูล</a>
            <a href="role_type.php">รายละเอียด</a>
        </div>
        <button class="dropdown-btn">ข้อมูลเข้าสู่ระบบ
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="add_login.php">เพิ่มข้อมูล</a>
            <a href="login_information.php">รายละเอียด</a>
        </div>
        <button class="dropdown-btn">ระดับชั้น
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="add_grade_level.php">เพิ่มข้อมูล</a>
            <a href="grade_level.php">รายละเอียด</a>
        </div>
        <button class="dropdown-btn">ชั้นเรียน
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="add_classroom.php">เพิ่มข้อมูล</a>
            <a href="classroom.php">รายละเอียด</a>
        </div>
        <button class="dropdown-btn">วิชา
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="add_subject.php">เพิ่มข้อมูล</a>
            <a href="subject.php">รายละเอียด</a>
        </div>
        <button class="dropdown-btn">ปีการศึกษา
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="add_year.php">เพิ่มข้อมูล</a>
            <a href="year.php">รายละเอียด</a>
        </div>
        <button class="dropdown-btn">เวลาของการเรียน
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="add_time.php">เพิ่มข้อมูล</a>
            <a href="time.php">รายละเอียด</a>
        </div>
        <button class="dropdown-btn">หน้าที่ครู
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="add_choose_a_teaching.php">เพิ่มข้อมูล</a>
            <a href="add_excel.php">เพิ่มข้อมูลทางExcel</a>
            <a href="choose_a_teaching.php">รายละเอียด</a>
        </div>

        <a href="../report_table/table.php">สรุปการเข้าสอน</a>
        <a href="###" onclick=" logout()"> ออกจากระบบ</a>
    </div>


    <script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }

    function logout() {
        var reallyLogout = confirm("คุณต้องการออกจากระบบใช่หรือไม่?");
        if (reallyLogout) {
            location.href = "../logout.php";
        }
    }
    var el = document.getElementById("logout");
    if (el.addEventListener) {
        el.addEventListener("click", logoutfunction, false);
    } else {
        el.attachEvent('onclick', logoutfunction);
    }
    </script>


</body>

</html>