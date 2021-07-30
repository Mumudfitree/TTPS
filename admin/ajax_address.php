<?php
    include('../connection.php');
if(isset($_POST['function']) && $_POST['function'] == 'grade_level'){
    $id = $_POST['id'];
    $sql = "SELECT * FROM classroom WHERE grade_id = '$id' ";
    $query = mysqli_query($conn,$sql);
        echo '<option value="" select="disable">กรุณาเลือกชั้นเรียน</option>';
    foreach($query as $value){
        echo '<option value="'.$value['class_id'].'">'.$value['name_classroom'].'</option>';
    }
    exit();
}
if(isset($_POST['function']) && $_POST['function'] == 'grade_level1'){
    $id1 = $_POST['id'];
    $sql1 = "SELECT * FROM subject WHERE grade_id = '$id1' ";
    $query1 = mysqli_query($conn,$sql1);
    echo '<option value="" select="disable">กรุณาเลือกวิชา</option>';
    foreach($query1 as $value1){
        echo '<option value="'.$value1['subject_id'].'">'.$value1['code_subject'].' '.$value1['name_subject'].'</option> ';
    }
    exit();
}
?>