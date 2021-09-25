<?php 

    define("compatibleSQL", 1);

    if(session_status() != 2){
        session_start();//คำสั่งต้องloginก่อนถึงเข้าได้
    }
    require_once 'connection.php';

    //$_SESSION['login_type'] = 0;  //ต้นตอปัญหาล็อกอินแล้วค่ามันรี ต้องล็อกอินใหม่ตลอด

    if(!isset($_SESSION['master_id'])){ //ขอใช้ master_id ตรวจสอบ เพราะว่าจะได้ทดสอบได้ทันทีว่าเคยล็อกอินแล้วยัง และการล็อกอินไม่ใช่ข้อมูลลวง
        /*$_SESSION['login_type'] = 0;
        unset($_SESSION['master_id']);
        unset($_SESSION['user_login']);
        unset($_SESSION['name']);
        unset($_SESSION['fname']);
        unset($_SESSION['lname']);
        unset($_SESSION['success']);
        unset($_SESSION['error']);*/

        //ใช้วิธีนี้ดีกว่า
        session_destroy();

        if(session_status() != 2){
            session_start();//คำสั่งต้องloginก่อนถึงเข้าได้
        }
        
        $_SESSION['login_type'] = 0;
    }

    if (isset($_POST['btn_login'])) {
        $username = $_POST['txt_username']; // textbox name 
        $password = $_POST['txt_password']; // password
        $role = $_POST['txt_role']; // select option role

        $status;
  
        if (empty($username)) {
            $errorMsg[] = "กรุณากรอกชื่อบัญชีผู้ใช้";
        } else if (empty($password)) {
            $errorMsg[] = "กรุณากรอกรหัสผ่าน";
        } else if (empty($role)) {
            $errorMsg[] = "กรุณาระบุบทบาท";
        } else if ($username AND $password AND $role) {
            try {
                $select_stmt = $db->prepare("SELECT * FROM login_information WHERE username = :uusername AND password = :upassword AND user_role_id = :urole");
                $select_stmt->bindParam(":uusername", $username);
                $select_stmt->bindParam(":upassword", $password);
                $select_stmt->bindParam(":urole", $role);
                //$select_stmt->bindParam(":ustatus'", $status);

                $select_stmt->execute(); 

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $dbusername = $row['username'];
                    $dbpassword = $row['password'];
                    $dbrole = $row['user_role_id'];
                    //$dbstatus = $row['status_master'];
                    //$dbfname = $row['fname'];
                    //$dblname = $row['lname'];
                    //$dbid = $row['master_id'];
                    $dbid = $row['login_id'];

            
                    
                }
                if ($username != null AND $password != null AND $role != null ) {
                    if ($select_stmt->rowCount() > 0) {
                        
                        if ($username == $dbusername AND $password == $dbpassword AND $role == $dbrole )  {
                            
                            $_SESSION['master_id'] = intval($dbid);
                            $_SESSION['user_login'] = $dbusername;
                            //$_SESSION['fname'] = $dbfname;
                            //$_SESSION['lname'] = $dblname;
                            //$_SESSION['name'] = $_SESSION['fname'].' '.$_SESSION['lname'];

                            switch($dbrole) {
                                case '1':
                                    $_SESSION['login_type'] = 1;
                                    $_SESSION['success'] = "ผู้ดูแลระบบ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: admin/admin_home.php");
                                break;
                                case '2':
                                    $_SESSION['login_type'] = 2;
                                    $_SESSION['success'] = "ผู้อำนวยการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: director/director_home.php");
                                break;
                                case '3':
                                    $_SESSION['login_type'] = 3;
                                    $_SESSION['success'] = "รองผู้อำนวยการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: deputydirector/deputydirector_home.php");
                                break;
                                case '4':
                                    $_SESSION['login_type'] = 4;
                                    $_SESSION['success'] = "ฝ่ายวิชาการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: academicdepartment/academicdepartment_home.php");
                                break;
                                case '5':

                                    $_SESSION['login_type'] = 5;
                                    $_SESSION['success'] = "ครู ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: teacher/teacher_home.php");
                                break;
                                case '6':

                                    $_SESSION['login_type'] = 6;
                                    $_SESSION['success'] = "หัวหน้าช่วงชั้นประถม ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: headprimary/headprimary_home.php");
                                break;
                                
                                case '7':

                                    $_SESSION['login_type'] = 7;
                                    $_SESSION['success'] = "หัวหน้าช่วงชั้นมัธยม ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: headhighschool/headhighschool_home.php");
                                break;
                                default:
                                $_SESSION['error'] = "กรุณาตรวจสอบบัญชีผู้ใช้ รหัสผ่าน หรือบทบาทใหม่อีกครั้ง";
                                    header("location: index.php");
                            }
                        }else{
                            $_SESSION['error'] = "ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง";
                        header("location: index.php");
                        }
                    } else {
                        $_SESSION['error'] = "ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง";
                        header("location: index.php");
                    }
                }
            } catch(PDOException $e) {
                $e->getMessage();
            }
        }
    }

        //This function have been added for compatible reason, you can remove if you already ensure no more codes is used.
    function legacyLogin(int $isEnabled) {
        if (!$isEnabled){
            return;
        }
    
        switch ($_SESSION['login_type']) {
            case 0:
                break;
            case 1:
                $_SESSION['admin_login'] = $_SESSION['user_login'];
                break;
            case 2:
                $_SESSION['director_login'] = $_SESSION['user_login'];
                break;
            case 3:
                $_SESSION['deputydirector_login'] = $_SESSION['user_login'];
                break;
            case 4:
                $_SESSION['academicdepartment_login'] = $_SESSION['user_login'];
                break;
            case 5:
                $_SESSION['teacher_login'] = $_SESSION['user_login'];
                    break;
            case 6:
                $_SESSION['headprimary_login'] = $_SESSION['user_login'];
                break;
            case 7:
                $_SESSION['headhighschool_login'] = $_SESSION['user_login'];
                break;
            default:
                $_SESSION['error'] = "ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง";
            
        }
    }
    
?>