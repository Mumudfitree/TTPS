<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('../connection.php');

    if(isset($_REQUEST['btn_insert'])){
        $year_name = $_REQUEST['txt_year'];
        $term = $_REQUEST['txt_term'];

        if(empty($year_name)){
            $errorMsg = "กรุณากรอก";
        }else {
            
        if(!isset($errorMsg)){

        $check = "SELECT * FROM year WHERE year_name = '$year_name' AND term = '$term' ";
        $query_check = mysqli_query($conn,$check)or die(mysqli_error($conn));
        $row_check = mysqli_fetch_array($query_check);
        
        if($row_check > 0)
        {
            echo "<script>";
            echo "alert('มีข้อมูลซ้ำ กรุณาตรวจสอบ ปีการศึกษาหรือภาคเรียน ?');";
            echo "window.location ='year.php'; ";
         echo "</script>";
        }else{
            $sql ="INSERT INTO year(year_name,term)VALUES ('$year_name','$term')";
            $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
            mysqli_close($conn);
            if($result){
                echo "<script>";
                echo "alert('สำเร็จ');";
                echo "window.location ='year.php'; ";
                $insertMsg = "เพิ่มข้อมูลของปีการศึกษาเสร็จสิ้น";
                echo "</script>";
                } else {
                
                echo "<script>";
                echo "alert('ล้มเหลว!');";
                echo "window.location ='year.php'; ";
                echo "</script>";
                }
        }

                
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มเวลาในการสอน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
<?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">เพิ่มปีการศึกษา</div>
    </div>
    <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
        <strong>เกิดข้อผิดพลาด! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>


    <?php
        if(isset($insertMsg)){
    ?>
        <div class="alert alert-success">
        <strong>ดำเนินการเสร็จสิ้น <?php echo $insertMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            <div class="form- text-center">
                <div class="row">
                <label for="firstname" class="col-sm-3 control-label">ปีการศึกษา(ค.ศ)</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_year" class="form-control" placeholder="ตัวอย่าง 2020">
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">เทอมการศึกษา</label>
            <div class="col-sm-6">
                <select name="txt_term" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <option value="1">เทอมการศึกษาที่1</option>
                <option value="2">เทอมการศึกษาที่2</option>
                </select>
            </div>
            </div>
        </div>
        <br>


            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-6">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="ยืนยัน">
                    <a href="time.php." class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
            </div>
    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

    </body>
</html>