<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    

    require_once('../connection.php');

    $id1 = $_SESSION['master_id'];


    if(isset($_REQUEST['update_id'])){
        try{
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM weekly_summary as week, choose_a_teaching as report, subject, classroom as class, grade_level as grade
            WHERE week.id_prepare_week = '".$id."' AND report.subject_id = subject.subject_id AND report.class_id = class.class_id AND report.grade_id = grade.grade_id AND
            week.choose_id = report.choose_id ");
            //$select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e){
            $e->getMessage();
        }
    }if(isset($_REQUEST['btn_update'])){//ตั้งตัวแปร up
        //$fname_lname ;
        $date = $_REQUEST['txt_date'] ;
        $goal = $_REQUEST['txt_goal'];
        $result = $_REQUEST['txt_result'];
        $activity_good = $_REQUEST['txt_activity_good'];
        $activity_nogood = $_REQUEST['txt_activity_nogood'];
        $problem = $_REQUEST['txt_problem'];
        $student = $_REQUEST['txt_student'];
        $solve_the_problem = $_REQUEST['txt_solve_the_problem'];
        //$subject = $_REQUEST['txt_subject'];
        $choose_id = $_REQUEST['txt_choose_id'];


        if(empty($goal)){
            $errorMsg = "กรุณากรอกเป้าหมาย";
        }elseif(empty($result)){
            $errorMsg = "กรุณากรอกผลการปฎิบัติงาน";
        }else if(empty($activity_good)){
                $errorMsg = "กรุณากรอกกิจกรรมที่ทำได้ดี";
        }else if(empty($activity_nogood)){
            $errorMsg = "กรุณากรอกกิจกรรมที่ทำได้ไม่ดี";
        }else if(empty($problem)){
            $errorMsg = "กรุณากรอกปัญหา/อุปสรรค";
        }else if(empty($student)){
            $errorMsg = "กรุณากรอก นักเรียน/กิจกรรมที่ควรปรับปรุง";
        }else if(empty($solve_the_problem)){
            $errorMsg = "กรุณากรอกแนวทางการแก้ไขปัญหาหรือการปฎิบัติครั้งต่อไป";
        }else {
            try{
                if(!isset($errorMsg))
                $update_stmt = $db->prepare("UPDATE weekly_summary 
                SET choose_id = '".$choose_id."', date_prepare_week = '".$date."', goal = '".$goal."', result = '".$result."', activity_good = '".$activity_good."', activity_nogood = '".$activity_nogood."', problem ='".$problem."', student = '".$student."', Solve_the_problem ='".$solve_the_problem."'  
                , status_prepare_week ='Checking' WHERE id_prepare_week = '".$id."' ");
                //$update_stmt->bindParam(":name_lname", $fname_lname);
                //$update_stmt->bindParam(":date", $date);
                //$update_stmt->bindParam(":subject", $subject);
                //$update_stmt->bindParam(":goal",$goal);
                //$update_stmt->bindParam(":result",$result);
                //$update_stmt->bindParam(":activity_good", $activity_good);
                //$update_stmt->bindParam(":activity_nogood",$activity_nogood);
                //$update_stmt->bindParam(":problem", $problem);
                //$update_stmt->bindParam(":student", $student);
                //$update_stmt->bindParam(":solve_the_problem",$solve_the_problem);

                    if($update_stmt->execute()){
                        $updateMeg = "อัพเดตข้อมูลเสร็จสิ้น";
                        header("refresh:week.php");
                    }
            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }

    }//ขนมปัง

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขสรุปผลรายสัปดาห์</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script> <!-- datepickerเก่า -->
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> <!-- datepickerเก่า -->
    <link rel="stylesheet" type="text/css" href="jquery.datetimepicker.css">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="jquery.datetimepicker.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script language="JavaScript">
    $(function() {
        var dates = $("#datepicker").datepicker({
            dateFormat: 'dd/mm/yy',          
            defaultDate: "+1w",
            changeMonth: true,
            minDate: 0,
            beforeShowDay: noWeekends

           
        });

        function noWeekends(date) {
            var day = date.getDay();
            // ถ้าวันเป็นวันอาทิตย์ (0) หรือวันเสาร์ (6)
            if (day === 0 || day === 6) {
                // เลือกไม่ได้
                return [false, "", "วันนี้เป็นวันหยุด"];
            }
            // เลือกได้ตามปกติ
            return [true, "", ""];
        }
        $("#datepicker").datepicker({
            beforeShowDay: noWeekends
        });
    });
    </script>
    </script>
</head>

<body>
    <?php include_once('sidebar.php'); ?>
    <div class="main">
        <div class="container">
            <div class="display-3 text-center">หน้าแก้ไขสรุปผลรายสัปดาห์</div>
        </div>
        <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
        <?php } ?>


        <?php
        if(isset($updateMeg)){
    ?>
        <div class="alert alert-success">
            <strong>success <?php echo $updateMeg; ?></strong>
        </div>
        <?php } ?>

        <form method="post" class="form-horizontal mt-5">
            <div class="form- text-center">
                <div class="row">
                    <label for="fname" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
                    <div class="col-sm-6">
                        <input type="text" name="txt_firstname" class="form-control"
                            value="<?php echo $_SESSION['name']; ?>" readonly>
                    </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                    <label for="name_classroom" class="col-sm-3 control-label">วันที่รายงานผล</label>
                    <div class="col-sm-6">
                    <input type="text" name="txt_date" class="form-control" id="datepicker" value="<?php echo $row['date_prepare_week'];?>"placeholder="วัน/เดือน/ปี">
                    </div>
                </div>
            </div>
            <br>

            <?php
                $query = ("SELECT * FROM choose_a_teaching as report, subject, classroom as class
                WHERE report.subject_id = subject.subject_id AND report.class_id = class.class_id AND report.master_id = '".$id1."' ");//เชื่อม2ตาราง
                $result2 = mysqli_query($conn, $query);
                    ?>

            <div class="form- text-center">
                <div class="row">
                    <label for="name_subject" class="col-sm-3 control-label">วิชาที่สอน/กิจกรรมที่ทำ</label>
                    <div class="col-sm-6">
                        <select name="txt_choose_id" class="form-control">
                            <option value="<?php  echo $choose_id; ?>"><?php echo $name_subject.' ('.$name_classroom.')'; ?>
                            </option>
                            <?php foreach($result2 as $row2){
                                if($row2['status_choose'] == 'Active' && $row2["choose_id"] !==$choose_id ){?>
                            <option value="<?php echo $row2["choose_id"]; ?>">
                                <?php echo $row2['code_subject'].' '.$row2['name_subject'].' ('.$row2['name_classroom'].')';?>
                                
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
                    <label for="" class="col-sm-3 control-label">เป้าหมาย</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_goal" rows="4" cols="95" value=""><?php echo $row['goal'];?></textarea>
                    </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">ผลการปฎิบัติงาน</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_result" rows="4" cols="95" ><?php echo $row['result'];?></textarea>
                    </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">กิจกรรมที่ทำได้ดี</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_activity_good" rows="4" cols="95"><?php echo $row['activity_good'];?></textarea>
                    </div>
                </div>
            </div>

            <br>
            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">กิจกรรมที่ทำได้ไม่ดี</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_activity_nogood" rows="4" cols="95"><?php echo $row['activity_nogood'];?></textarea>
                    </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">ปัญหา/อุปสรรค</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_problem" rows="4" cols="95" ><?php echo $row['problem'];?></textarea>
                    </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">นักเรียน/กิจกรรมที่ต้องปรับปรุง</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_student" rows="4" cols="95" ><?php echo $row['student'];?></textarea>
                    </div>
                </div>
            </div>


            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">แนวทางการแก้ปัญหาหรือการปฎิบัติการครั้งต่อไป</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_solve_the_problem" rows="4" cols="95"><?php echo $row['Solve_the_problem'];?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="อัพเดต">
                    <a href="week.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>

        </form>
    </div>





    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>