<?php

session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
    header("location: ../index.php");
}

    require_once('../connection.php');

    if(isset($_REQUEST['delete_id'])){

        $id = $_REQUEST['delete_id'];

        $sql = "SELECT * FROM  user_data WHERE user_id = '".$id."'";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        extract($row);
        
            /*$id = $_REQUEST['delete_id'];
            $select_stmt = $db->prepare("SELECT * FROM login_information WHERE master_id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);*/
            
    }
    $sql = "UPDATE user_data SET  status_user  = 'Inactive' WHERE user_id = '".$id."'";
    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
    mysqli_close($conn); //ปิดการเชื่อมต่อ database 

    if($result){
    echo "<script type='text/javascript'>";
    echo "alert('อัพเดตข้อมูลสถานะเสร็จสิ้น');";
    echo "window.location = 'index.php'; ";
    echo "</script>";
    }
    else{
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาดกรุณาอัพเดตใหม่อีกครั้ง');";
    echo "</script>";

    }
    /*$update_stmt = $db->prepare("UPDATE login_information SET status_master  = 'Inactive' WHERE master_id = :id");
    $update_stmt->bindParam(':id', $id);
    if($update_stmt->execute()){
        $updateMeg = "Record update successfully...";
        header("refresh:1,index.php");
    }*/
?>