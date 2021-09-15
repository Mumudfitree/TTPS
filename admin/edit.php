<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }

    require_once('../connection.php');
    

    if(isset($_REQUEST['update_id'])){
        //2. query ข้อมูลจากตาราง:
        $id = $_REQUEST['update_id'];

        $sql = "SELECT * FROM  user_data WHERE user_id = '".$id."'  ";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
        $row = mysqli_fetch_array($result);
        extract($row);
            /*$id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM login_information as login, user_role as role WHERE login.master_id = '".$id."' AND login.user_role_id = role.user_role_id ");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            */
        
    }
    if(isset($_REQUEST['btn_update'])){
        $firstname_up = $_REQUEST['txt_firstname'];
        $lastname_up = $_REQUEST['txt_lastname'];
        $email_up = $_REQUEST['txt_email'];
        $status;
        

        if(empty($firstname_up)){
            $errorMsg = "กรุณากรอกชื่อ";
        }else if(empty($lastname_up)){
            $errorMsg = "กรุณากรอกนามสกุล";
        }else if(empty($email_up)){
            $errorMsg = "กรุณากรอกอีเมลล์";
        }else{
                if(!isset($errorMsg))
                    $sql = "UPDATE user_data SET firstname = '".$firstname_up."' ,lastname = '".$lastname_up."',
                    email= '".$email_up."'
                    WHERE user_id = '".$id."'";
                    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                    mysqli_close($conn); //ปิดการเชื่อมต่อ database 

    if($result){
        echo "<script type='text/javascript'>";
        echo "alert('อัพเดตข้อมูลเสร็จสิ้น');";
        echo "window.location = 'index.php'; ";
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
    <title>หน้าแก้ไขข้อมูลสมาชิก</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/bootstrap_button.css">
</head>
<body>
<?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">หน้าแก้ไขข้อมูลสมาชิก</div>
    </div>
    <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
        <strong>เกิดข้อผิดพลาด! <?php echo $errorMsg; ?></strong>
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
                <label for="firstname" class="col-sm-3 control-label">ชื่อ</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_firstname" class="form-control" value="<?php echo $firstname; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="lastname" class="col-sm-3 control-label">นามสกุล</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_lastname" class="form-control" value="<?php echo $lastname; ?>">
                </div>
                </div>
            </div>


            <div class="form- text-center">
                <div class="row">
                <label for="email" class="col-sm-3 control-label">อีเมลล์</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_email" class="form-control" value="<?php echo $email; ?>">
                </div>
                </div>
            </div>

        


        <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="อัพเดต">
                    <a href="index.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
    </div>
    




    <script src="js/slime.js"></>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

</body>
</html>