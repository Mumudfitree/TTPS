<?php

session_start();//คำสั่งต้องloginก่อนถึงเข้าได้


    require_once('../connection.php');

    if(isset($_REQUEST['change_id'])){

        $id = $_REQUEST['change_id'];

        $sql = "SELECT * FROM  time WHERE time_id = '".$id."'";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        extract($row);
          /*  $id = $_REQUEST['change_id'];
            $select_stmt = $db->prepare("SELECT * FROM login_information WHERE master_id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);*/
            
    }
    $sql = "UPDATE time SET  status_time  = 'Active' WHERE time_id = '".$id."'";
    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
    mysqli_close($conn); //ปิดการเชื่อมต่อ database 

    if($result){
    echo "<script type='text/javascript'>";
    echo "alert('อัพเดตข้อมูลสถานะเสร็จสิ้น');";
    echo "window.location = 'time.php.'; ";
    echo "</script>";
    }
    else{
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาดกรุณาอัพเดตใหม่อีกครั้ง');";
    echo "</script>";

    }
    /*$update_stmt = $db->prepare("UPDATE login_information SET status_master='Active' WHERE master_id = :id");
    $update_stmt->bindParam(':id', $id);
    if($update_stmt->execute()){
        $updateMeg = "Record update successfully...";
        header("refresh:1,index.php?update_id=$id");
    }*/
    
    
?>