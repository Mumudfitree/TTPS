<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    

    require_once('../connection.php');
    $id1 = $_SESSION['UserID'];

    if(isset($_REQUEST['update_id'])){
        
        $id = $_REQUEST['update_id'];

        $sql = "SELECT * FROM choose_a_teaching as c,login_information as m , subject as sub, classroom as class, grade_level as grade,time as t,year as y,user_data as user
        WHERE user.user_id = m.user_id AND c.choose_id = '".$id."' and c.login_id = m.login_id and c.subject_id = sub.subject_id and c.class_id = class.class_id and c.grade_id = grade.grade_id and c.time_id = t.time_id and c.year_id = y.year_id ";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        extract($row);
            /*$id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM choose_a_teaching as c,login_information as m , subject as sub, classroom as class 
            WHERE c.choose_id = :id and c.master_id = m.master_id and c.subject_id = sub.subject_id and c.class_id = class.class_id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);*/
        
    }if(isset($_REQUEST['btn_update'])){
        $name = $_REQUEST['txt_name'];
        $code_up = $_REQUEST['txt_code'] ;
        $classroom_up = $_REQUEST['txt_classroom'];
        $grade_level_user = $_REQUEST['txt_grade'];
        $time = $_REQUEST['txt_time'];
        //$datei = $_REQUEST['txt_date'];
        //$yeari = $_REQUEST['txt_year'];
        $status;
        
        

        
        if(empty($code_up)){
            $errorMsg = "Please enter Code";
        }else if(empty($classroom_up)){
            $errorMsg = "Please enter Classroom";
        }else{
            
                if(!isset($errorMsg))
                    $sql = "UPDATE choose_a_teaching SET login_id = '".$name."', grade_id = '".$grade_level_user."', class_id = '".$classroom_up."' ,subject_id = '".$code_up."',time_id = '".$time."',
                    status_choose='Active' WHERE choose_id = '".$id."' ";
                    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
                    mysqli_close($conn); //ปิดการเชื่อมต่อ database 

                    if($result){
                        echo "<script type='text/javascript'>";
                        echo "alert('อัพเดตข้อมูลเสร็จสิ้น');";
                        echo "window.location = 'choose_a_teaching.php'; ";
                        echo "</script>";
                        }
                        else{
                        echo "<script type='text/javascript'>";
                        echo "alert('เกิดข้อผิดพลาดกรุณาอัพเดตใหม่อีกครั้ง');";
                        echo "</script>";
                                
                            }
            
        }

    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขวิชาการสอน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/bootstrap_button.css">
</head>

<body>
    <?php include_once('slidebar_admin.php'); ?>
    <div class="main">
        <div class="container">
            <div class="display-3 text-center">แก้ไขวิชาการสอน</div>
        </div>
        <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
            <strong>เกิดข้อผิดพลาด <?php echo $errorMsg; ?></strong>
        </div>
        <?php } ?>


        <?php
        if(isset($updateMeg)){
    ?>
        <div class="alert alert-success">
            <strong>ดำเนินการเสร็จสิ้น <?php echo $updateMeg; ?></strong>
        </div>
        <?php } ?>

        <form method="post" class="form-horizontal mt-5">
            <div class="form- text-center">
                <div class="row">
                    <input type="hidden" id="id" name="id" >
                    <label for="type" class="col-sm-3 control-label">ชื่อ</label>
                    <div class="col-sm-6">
                        <select name="txt_name" class="form-control">
                            <option value="<?php echo $login_id; ?>"><?php echo $firstname .' '.$lastname; ?></option>
                            <?php 
                $query1 = "SELECT * FROM login_information as login, user_data as user WHERE login.user_id = user.user_id";
                $result1 = mysqli_query($conn,$query1);//login data
                ?>
                            <?php foreach($result1 as $row1){
                    if($row1['status_login'] == 'Active' && $row1['user_role_id'] == '5' && row1['login_id'] !== $login_id){?>
                            <option value="<?php echo $row1["login_id"]; ?>">
                                <?php echo $row1["firstname"].' '.$row1["lastname"]; ?>
                            </option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <?php
                $grade = $grade_id;
                $sql_grade = "SELECT * FROM grade_level ";
                $query_grade =mysqli_query($conn,$sql_grade); 
                
                $class = $class_id;
                $sql_class = "SELECT * FROM classroom WHERE grade_id ='$grade'";
                $query_class =mysqli_query($conn,$sql_class); 

                $sub = $subject_id;
                $sql_sub = "SELECT * FROM subject WHERE grade_id ='$grade'";
                $query_sub =mysqli_query($conn,$sql_sub); 



            
                //$sql12 = "SELECT * FROM classroom WHERE grade_id =''"
            ?>
            <div class="form- text-center">
                    <div class="row">
                        <label for="grade_level" class="col-sm-3 control-label">ระดับชั้น</label>
                        <div class="col-sm-6">
                            <select name="txt_grade" id="grade_level" class="form-control">
                                <option value="" selected="disable">กรุณาเลือกระดับชั้นเรียน</option>
                                <?php foreach($query_grade as $value){?>
                                    
                                <option value="<?= $value['grade_id'];?>"<?= $value['grade_id']==$grade ? 'selected': ''; ?>><?php echo $value['name_gradelevel']?></option>
                                
                                
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <br>


                <div class="form- text-center">
                    <div class="row">
                        <label for="classroom" class="col-sm-3 control-label">ชั้น</label>
                        <div class="col-sm-6">
                        <select name="txt_classroom" id="classroom" class="form-control">
                        <option value="" selected="disable">กรุณาเลือกชั้นเรียน</option>
                        <?php foreach($query_class as $value){?>    
                                    <option value="<?=$value['class_id'];?>"<?= $value['class_id']==$class ? 'selected':''; ?>><?php echo $value['name_classroom']?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form- text-center">
                    <div class="row">
                        <label for="subject" class="col-sm-3 control-label">วิชา</label>
                        <div class="col-sm-6">
                            <select name="txt_code" id="subject" class="form-control">
                            <option value="" selected="disable">กรุณาเลือกวิชา</option>
                            <?php foreach($query_sub as $value){
                                //if($value["status_subject"] == 'Active' && $value['subject_id'] != $subject_id){?>    
                                    <option value="<?=$value['subject_id'];?>"<?= $value['subject_id']==$sub ? 'selected':''; ?>><?php echo $value['name_subject']?></option>
                                    <?php// } ?>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <br>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script type="text/javascript">
                    $('#grade_level').change(function(){
                        var id_grade_level = $(this).val();
                        $.ajax({
                            type: "post",
                            url: "ajax_address.php",
                            data: {id: id_grade_level,function:'grade_level'} ,
                            success: function(data) {
                                $('#classroom').html(data);
                        }
                    });
                });
                $('#grade_level').change(function(){
                        var grade_level_id = $(this).val();
                        $.ajax({
                            type: "post",
                            url: "ajax_address.php",
                            data: {id: grade_level_id,function:'grade_level1'} ,
                            success: function(data) {
                                $('#subject').html(data);
                        }
                    });
                });
                    </script>
            
            <div class="form- text-center">
                <div class="row">
                    <label for="type" class="col-sm-3 control-label">เวลาในการสอน</label>
                    <div class="col-sm-6">
                        <select name="txt_time" class="form-control">
                            <option value="<?php echo $time_id; ?>" selected="selected"><?php echo $time_name; ?></option>
                            <?php
                $query4 = "SELECT * FROM time ";
                $result4 = mysqli_query($conn,$query4);//classroom
                ?>
                            <?php foreach($result4 as $row4){
                    if($row4['status_time'] == 'Active' && $row4['time_id'] != $time_id){?>
                            <option value="<?php echo $row4["time_id"]; ?>"><?php echo $row4["time_name"]; ?>
                            </option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="form- text-center">
                <div class="row">
                    <label for="type" class="col-sm-3 control-label">วันที่สอน</label>
                    <div class="col-sm-6">
                        <select name="txt_date" class="form-control">
                            <option value="<?php echo date; ?>" selected="selected"><?php echo $date; ?></option>
                            <option value="วันจันทร์">วันจันทร์</option>
                            <option value="วันอังคาร">วันอังคาร</option>
                            <option value="วันพุธ">วันพุธ</option>
                            <option value="วันพฤหัสบดี">วันพฤหัสบดี</option>
                            <option value="วันศุกร์">วันศุกร์</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="form- text-center">
                <div class="row">
                    <label for="type" class="col-sm-3 control-label">ปีการศึกษา</label>
                    <div class="col-sm-6">
                        <select name="txt_year" class="form-control">
                            <option value="<?php echo $year_id;?>" selected="selected"><?php echo $term.'/'.$year_name;?></option>
                            <?php
                $query5 = "SELECT * FROM year ";
                $result5 = mysqli_query($conn,$query5);//classroom
                ?>
                            <?php foreach($result5 as $row5){
                    if($row5['status_year'] == 'Active'){?>
                            <option value="<?php echo $row5["year_id"]; ?>">
                                <?php echo $row5["term"].'/'.$row5["year_name"]; ?>
                            </option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="อัพเดต">
                    <a href="choose_a_teaching.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>
    






    <script src="js/slime.js">
    < /> <
    script src = "js/popper.js" >
    </script>
    <script src="js/bootstrap.js"></script>


</body>

</html>