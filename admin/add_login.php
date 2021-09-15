<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('../connection.php');

    if(isset($_REQUEST['btn_insert'])){
        $user = $_REQUEST['txt_user'];
        $username = $_REQUEST['txt_username'];
        $password = $_REQUEST['txt_password'];
        $role = $_REQUEST['txt_role'];

        if(empty($user)){
            $errorMsg = "กรุณาระบุชื่อผู้ใช้งาน";
        }else if(empty($username)){
            $errorMsg = "กรุณากรอกชื่อบัญชีผู้ใช้";
        }else if(empty($password)){
            $errorMsg = "กรุณากรอกรหัสผ่าน";
        }else if(empty($role)){
            $errorMsg = "กรุณาระบุบทบาท";
        }else {
            
                if(!isset($errorMsg)){
                    $sql ="INSERT INTO login_information(user_id,username,password,user_role_id)VALUES ('$user','$username','$password','$role')";
                    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                    mysqli_close($conn);
    
                    if($result){
                    echo "<script>";
                    echo "alert('สำเร็จ');";
                    echo "window.location ='login_information.php'; ";
                    $insertMsg = "เพิ่มข้อมูลของสมาชิกเสร็จสิ้น";
                    echo "</script>";
                    } else {
                    
                    echo "<script>";
                    echo "alert('ล้มเหลว!');";
                    echo "window.location ='login_information.php'; ";
                    echo "</script>";
                    }
                    /*$insert_stmt = $db->prepare("INSERT INTO login_information(fname,lname,username,password,email,user_role_id) VALUE(:fname,:lname,:user,:pass,:email,:role) ");
                    $insert_stmt->bindParam(":fname", $firstname);
                    $insert_stmt->bindParam(":lname", $lastname);
                    $insert_stmt->bindParam(":user", $username);
                    $insert_stmt->bindParam(":pass", $password);
                    $insert_stmt->bindParam(":email", $email);
                    $insert_stmt->bindParam(":role", $role);

                    if($insert_stmt->execute()){
                        $insertMsg = "เพิ่มข้อมูลของสมาชิกเสร็จสิ้น";
                        header("refresh:1,index.php");
                        
                    }
                }
            } catch (PDOException $e){
                echo $e->getMessage();
            }
            */
                
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มบุคลากร</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
<?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">เพิ่มสมาชิก</div>
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

            <?php
                $queryz = "SELECT * FROM user_data ORDER BY user_id asc" or die("Error:" . mysqli_error());
                $resultz = mysqli_query($conn, $queryz);
            ?>
            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">ชื่อผู้ใช้งาน</label>
                <div class="col-sm-6">
                <select name="txt_user" class="form-control" required>
                    <option value="">-ระบุชื่อผู้ใช้งาน-</option>
                     <?php foreach($resultz as $resultsz){
                        if($resultsz['status_user'] == 'Active'){?>
                    <option value="<?php echo $resultsz["user_id"];?>">
                        <?php echo $resultsz["firstname"].' '.$resultsz["lastname"]; ?>
                    </option>
                    <?php }else {
                        # code...
                    } ?>
                    <?php } ?>
                </select>
            </div>
            <br>


            <div class="form- text-center">
                <div class="row">
                <label for="username" class="col-sm-3 control-label">ชื่อบัญชีผู้ใช้</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_username" class="form-control" placeholder="ชื่อบัญชีผู้ใช้">
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="password" class="col-sm-3 control-label">รหัสผ่าน</label>
                <div class="col-sm-6">
                    <input type="password" name="txt_password" class="form-control" placeholder="รหัสผ่าน">
                </div>
                </div>
            </div>
            <br>

            <?php
                $query = "SELECT * FROM user_role ORDER BY user_role_id asc" or die("Error:" . mysqli_error());
                $result = mysqli_query($conn, $query);
            ?>
            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">บทบาท</label>
                <div class="col-sm-6">
                <select name="txt_role" class="form-control" required>
                    <option value="">-ระบุตำแหน่ง-</option>
                     <?php foreach($result as $results){
                        if($results['status_role'] == 'Active'){?>
                    <option value="<?php echo $results["user_role_id"];?>">
                        <?php echo $results["name_role"]; ?>
                    </option>
                    <?php }else {
                        # code...
                    } ?>
                    <?php } ?>
                </select>
            </div>
            <br>

        

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-6">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="ยืนยัน">
                    <a href="login_information.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
            </div>
    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

    </body>
</html>