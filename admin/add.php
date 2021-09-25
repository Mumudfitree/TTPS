<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('../connection.php');

    if(isset($_REQUEST['btn_insert'])){
        $firstname = $_REQUEST['txt_firstname'];
        $lastname = $_REQUEST['txt_lastname'];
        $email = $_REQUEST['txt_email'];
        

        if(empty($firstname)){
            $errorMsg = "กรุณากรอกชื่อ";
        }else if(empty($lastname)){
            $errorMsg = "กรุณากรอกนามสกุล";
        }else if(empty($email)){
            $errorMsg = "กรุณากรอกอีเมลล์";
        }else {
            
                if(!isset($errorMsg)){
        $check = "SELECT * FROM user_data WHERE firstname = '$firstname' AND lastname = '$lastname' OR email = '$email' ";
        $query_check = mysqli_query($conn,$check)or die(mysqli_error($conn));
        $row_check = mysqli_fetch_array($query_check);
        
        if($row_check > 0)
        {
            echo "<script>";
            echo "alert('มีข้อมูลซ้ำ กรุณาตรวจสอบ ชื่อ-สกุล หรือ อีเมลล์?');";
            echo "window.location ='index.php'; ";
         echo "</script>";
        }else{
            $sql ="INSERT INTO user_data(firstname,lastname,email)VALUES ('$firstname','$lastname','$email')";
            $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
            mysqli_close($conn);
            if($result){
                echo "<script>";
                echo "alert('สำเร็จ');";
                echo "window.location ='index.php'; ";
                $insertMsg = "เพิ่มข้อมูลของสมาชิกเสร็จสิ้น";
                echo "</script>";
                } else {
                
                echo "<script>";
                echo "alert('ล้มเหลว!');";
                echo "window.location ='index.php'; ";
                echo "</script>";
                }
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
            <div class="form- text-center">
                <div class="row">
                <label for="firstname" class="col-sm-3 control-label">ชื่อ</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_firstname" class="form-control" placeholder="ชื่อ">
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="lastname" class="col-sm-3 control-label">นามสกุล</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_lastname" class="form-control" placeholder="นามสกุล">
                </div>
                </div>
            </div>
            <br>

            

            <div class="form- text-center">
                <div class="row">
                <label for="email" class="col-sm-3 control-label">อีเมลล์</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_email" class="form-control" placeholder="อีเมลล์">
                </div>
                </div>
            </div>
            <br>

        

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-6">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="ยืนยัน">
                    <a href="index.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
            </div>
    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

    </body>
</html>