<?php 
    if (!isset($_SESSION['teacher_login'])) {
        header("location: ../index.php");
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!-- icon -->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="style.css">

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
.sidenav a, .dropdown-btn {
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
.sidenav a:hover, .dropdown-btn:hover {
    color: #f1f1f1;
}
  
  /* Main content */
.main {
    margin-left: 200px; /* Same as the width of the sidenav */
    font-size: 20px; /* Increased text to enable scrolling */
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
    background-color: #262626;
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

    <!--<div class="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
    <div class="side-bar">
        <div class="close-btn">
            <i class="fas fa-time"></i>
        </div>
        <div class="menu">
            <div class="item"><a href="#"><i class="fas fa-desktop"></i>Dashboard</a></div>
            <div class="item">
                <a class="sub-btn"><i class="fas fa-table"></i>Table<i
                        class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="#" class="sub-item">Sub item 01</a><br>
                    <a href="#" class="sub-item">Sub item 02</a><br>
                    <a href="#" class="sub-item">Sub item 03</a>
                </div>
            </div>
            <div class="item"><a href="#">หน้าหลัก</a></div>
            <div class="item"><a href="#">หน้าหลัก</a></div>
            <a href="###" onclick=" logout()"><i class="fas fa-sign-out"></i> ออกจากระบบ</a></li>
        </div>
    </div>
    <!--
    <div class="sidebar">
        <nav>
            <ul>
                <li><a href="teacher_home.php"><i class="fa fa-fw fa-home"></i> หน้าหลัก</a></li>
                <li class="dropdown"> <a href="##"><i class="fa fa-fw fa-user"></i> เตรียมสอน<span>&rsaquo;</span></a>
                    <ul>
                        <li class="dropdown_two"><a href="add_hours.php">เพิ่มข้อมูล</a></li>
                        <li class="dropdown_two"><a href="hours.php">รายละเอียด</a></li>
                        <li class="dropdown_two"><a href="pass_work.php">อนุมัติ</a></li>
                    </ul>
                </li>
                <li class="dropdown"> <a href="###"><i class="fa fa-fw fa-user"></i> สรุปรายสัปดาห์<span>&rsaquo;</span></a>
                    <ul>
                        <li class="dropdown_two"><a href="add_week.php">เพิ่มข้อมูล</a></li>
                        <li class="dropdown_two"><a href="week.php">รายละเอียด</a></li>
                        <li class="dropdown_two"><a href="pass_work_week.php">อนุมัติ</a></li>
                    </ul>
                </li>
                <li><a href="###" onclick=" logout()"><i class="fa fa-sign-out"></i> ออกจากระบบ</a></li>
            </ul>
        </nav>
    </div>
    <div class="tut_overview" style="display: none;">
<a target="_top" href="css_navbar.asp" class="active">Navbar</a>
<a target="_top" href="css_navbar_vertical.asp">Vertical Navbar</a>
<a target="_top" href="css_navbar_horizontal.asp">Horizontal Navbar</a>
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
    </script>
-->
    <!--<script type="text/javascript">
    $(document).ready(function() {
        //jquery for toggle sub menus
        $('.sub-btn').click(function() {
            $(this).next('.sub-menu').slideToggle();
            $(this).find('.dropdown').toggleClass('rotate');

        });
        //jquery for expand and collapse the sidebar
        $('.menu-btn').click(function() {
            $('.side-bar').addClass('active');
            $('.menu-btn').css("visibility", "hidden");
        });

        $('.close-btn').click(function() {
            $('.side-bar').removeClass('active');
            $('.menu-btn').css("visibility", "visible");
        });
    });

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
        <a href="teacher_home.php">หน้าหลัก</a>
        <button class="dropdown-btn">เตรียมสอน
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="add_hours.php">เพิ่มข้อมูล</a>
            <a href="hours.php">รายละเอียด</a>
            <a href="pass_work.php">สำเร็จ</a>
        </div>
        <button class="dropdown-btn">สรุปผลรายสัปดาห์
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="add_week.php">เพิ่มข้อมูล</a>
            <a href="week.php">รายละเอียด</a>
            <a href="pass_work_week.php">สำเร็จ</a>
        </div>
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