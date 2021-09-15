<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }

    require_once('../connection.php');
    

    if(isset($_REQUEST['update_id'])){
        //2. query ข้อมูลจากตาราง:
        $id = $_REQUEST['update_id'];

        $sql = "SELECT * FROM  login_information as login, user_data as user, user_role as role 
        WHERE login.user_id = user.user_id AND login.user_role_id = role.user_role_id AND login.login_id = '".$id."'  ";
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
        $user_up = $_REQUEST['txt_user'];
        $username_up = $_REQUEST['txt_username'];
        $password_up = $_REQUEST['txt_password'];
        $role_up = $_REQUEST['txt_role'];
        $status;
        

        if(empty($user_up)){
            $errorMsg = "กรุณาระบุชื่อผู้ใช้งาน";
        }else if(empty($username_up)){
            $errorMsg = "กรุณากรอกชื่อบัญชีผู้ใช้";
        }else if(empty($password_up)){
            $errorMsg = "กรุณากรอกรหัสผ่าน";
        }else if(empty($role_up)){
            $errorMsg = "กรุณาระบุบทบาท";
        }else{
                if(!isset($errorMsg))
                    $sql = "UPDATE login_information SET user_id = '".$user_up."' ,username = '".$username_up."',
                    password= '".$password_up."',user_role_id ='".$role_up."'
                    WHERE login_id = '".$id."'";
                    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                    mysqli_close($conn); //ปิดการเชื่อมต่อ database 

    if($result){
        echo "<script type='text/javascript'>";
        echo "alert('อัพเดตข้อมูลเสร็จสิ้น');";
        echo "window.location = 'login_information.php'; ";
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
            <div class="display-3 text-center">หน้าแก้ไขข้อมูลเข้าระบบ</div>
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
                    <input type="hidden" id="id" name="id">
                    <div class="form- text-center">
                        <div class="row">
                            <label for="name_subject" class="col-sm-3 control-label">ชื่อผู้ใช้งาน</label>
                            <div class="col-sm-6">
                                <select name="txt_user" class="form-control">
                                    <?php 
                    $queryz1 = ("SELECT * FROM user_data ");
                    $resultz1 =mysqli_query($conn,$queryz1);
                     ?>
                                    <option value="<?php echo $user_id; ?>"><?php echo $firstname .' '.$lastname; ?>
                                    </option>
                                    <?php foreach($resultz1 as $rowz1){?>
                                    <?php if($rowz1['status_user']=='Active' && $rowz1['user_id'] !== $user_id){?>
                                    <option value="<?php echo $rowz1["user_id"];?>">
                                        <?php echo $rowz1["firstname"].' '.$rowz1["lastname"]; ?>
                                    </option>
                                    <?php }else{?>

                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="form- text-center">
                        <div class="row">
                            <label for="lastname" class="col-sm-3 control-label">ชื่อบัญชีผู้ใช้</label>
                            <div class="col-sm-6">
                                <input type="text" name="txt_username" class="form-control"
                                    value="<?php echo $username; ?>">
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="form- text-center">
                        <div class="row">
                            <label for="lastname" class="col-sm-3 control-label">รหัสผ่าน</label>
                            <div class="col-sm-6">
                                <input type="text" name="txt_password" class="form-control"
                                    value="<?php echo $password; ?>">
                            </div>
                        </div>
                    </div>
                    <br>



                    <div class="form- text-center">
                        <div class="row">
                            <label for="name_subject" class="col-sm-3 control-label">บทบาท</label>
                            <div class="col-sm-6">
                                <select name="txt_role" class="form-control">
                                    <?php 
                    $queryz = ("SELECT * FROM user_role ");
                    $resultz =mysqli_query($conn,$queryz);
                     ?>
                                    <option value="<?php echo $user_role_id; ?>"><?php echo $name_role; ?></option>
                                    <?php foreach($resultz as $rowz){?>
                                    <?php if($rowz['status_role']=='Active' && $rowz['user_role_id'] !== $user_role_id){?>
                                    <option value="<?php echo $rowz["user_role_id"];?>">
                                        <?php echo $rowz['name_role']; ?></option>
                                    </option>
                                    <?php }else{?>

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
                            <a href="login_information.php" class="btn btn-danger">ยกเลิก</a>
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