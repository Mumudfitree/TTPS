<?php

session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
    header("location: ../index.php");
}

    require_once('../connection.php');

    if(isset($_REQUEST['delete_id'])){
        
        $id = $_REQUEST['delete_id'];

        $sql = "SELECT * FROM  grade_level WHERE grade_id = '".$id."'";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        extract($row);
            
    }

    $sql = "UPDATE grade_level SET  status_grade  = 'Inactive' WHERE grade_id = '".$id."'";
    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
    mysqli_close($conn); //ปิดการเชื่อมต่อ database 

    if($result){
    echo "<script type='text/javascript'>";
    echo "alert('อัพเดตข้อมูลสถานะเสร็จสิ้น');";
    echo "window.location = 'grade_level.php'; ";
    echo "</script>";
    }
    else{
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาดกรุณาอัพเดตใหม่อีกครั้ง');";
    echo "</script>";

    }
    
?>