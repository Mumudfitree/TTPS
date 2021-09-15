<!DOCTYPE html>
<html>

< <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!-- icon -->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="primary_slidebar.css">

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
    <!--<div class="sidenav">
        <a href="headprimary_home.php"><i class="fa fa-fw fa-home"></i> หน้าหลัก</a>
        <a href="check.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-journal-check" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                <path
                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                <path
                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
            </svg> ตรวจสอบเตรียมสอนรายชั่วโมง</a>
        <a href="check_week.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-journal-check" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                <path
                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                <path
                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
            </svg> ตรวจสอบสรุปผลรายสัปดาห์</a>
        <!--<a href="grade_level.php"><i class="fa fa-gear"></i> ตั้งค่า</a>-->
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
    </script>



</body>

</html>