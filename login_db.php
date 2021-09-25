<?php 

    if(session_status() != 2){
        session_start();//คำสั่งต้องloginก่อนถึงเข้าได้
    }

    include_once "./src/script.php";

    if(isset($_POST['btn_login'])){

        define("compatibleSQL", 0);
        define("legacySession", 1);

    //connection
        include("connection.php");
    //รับค่า user & password
        $username = $_POST['txt_username'];
        $password = $_POST['txt_password'];
        $role = $_POST['txt_role'];
    //query 
        if(!compatibleSQL) {
            $sql="SELECT * FROM login_information, user_data  WHERE 
            username='".$username."' and password='".$password."' and user_role_id ='".$role."' 
            AND login_information.user_id = user_data.user_id";
        }
        else {
            $sql="SELECT * FROM login_information WHERE username = $username AND password = $password AND user_role_id = $role";
        }

        $result = mysqli_query($conn,$sql);
            
        if(mysqli_num_rows($result)==1){

            $row = mysqli_fetch_array($result);

            $stmt = sessionDeclare($row);

            legacyLogin(legacySession);

            if($_SESSION['login_type'] === 0) {
                foreach($stmt as $command){
                    echo $command;
                }

            }

            unset($stmt);

            /*
            $_SESSION["UserID"] = $row["login_id"]; //รหัส ID
            $_SESSION["User"] = $row["firstname"]." ".$row["lastname"]; //ชื่อ-สกุล
            $_SESSION["Userlevel"] = $row["user_role_id"]; //รหัสบทบาท
                    

            if($_SESSION["Userlevel"]== "1" && $row['status_login'] == 'Active'  ){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php

                $_SESSION['admin_login'] = $username;
                $_SESSION["User"];
                $_SESSION['Role'] = 'ผู้ดูแลระบบ';
                $_SESSION['success'] = "ผู้ดูแลระบบ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                header("location: admin/admin_home.php");

            }

            if ($_SESSION["Userlevel"]=="2" && $row['status_login'] == 'Active' ){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                $_SESSION['director_login'] = $username;
                $_SESSION['Role'] = 'ผู้อำนวยการ';
                $_SESSION['success'] = "ผู้อำนวยการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                header("location: director/director_home.php");

                }

            if ($_SESSION["Userlevel"]=="3" && $row['status_login'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                $_SESSION['deputydirector_login'] = $username;
                $_SESSION['Role'] = 'รองผู้อำนวยการ';
                $_SESSION['success'] = "รองผู้อำนวยการ ฝ่ายวิชาการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                header("location: deputydirector/deputydirector_home.php");

                }

            if ($_SESSION["Userlevel"]=="4" && $row['status_login'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                $_SESSION['academicdepartment_login'] = $username;
                $_SESSION['success'] = "ฝ่ายวิชาการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                header("location: academicdepartment/academicdepartment_home.php");

                }

            if ($_SESSION["Userlevel"]=="5" && $row['status_login'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                $_SESSION['teacher_login'] = $username;
                $_SESSION['Role'] = 'คุณครู';
                $_SESSION["User"];
                $_SESSION['master_id'] = $id;
                $_SESSION['success'] = "ครู ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                header("location: teacher/teacher_home.php");

            }

            if ($_SESSION["Userlevel"]=="6" && $row['status_login'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                $_SESSION['headprimary_login'] = $username;
                $_SESSION['Role'] = 'หัวหน้าช่วงชั้นประถม';
                $_SESSION['success'] = "หัวหน้าช่วงชั้นประถม ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                header("location: headprimary/headprimary_home.php");

            }

            if ($_SESSION["Userlevel"]=="7" && $row['status_login'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                $_SESSION['headhighschool_login'] = $username;
                $_SESSION['Role'] = 'หัวหน้าช่วงชั้นมัธยม';
                $_SESSION['success'] = "หัวหน้าช่วงชั้นมัธยม ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                header("location: headhighschool/headhighschool_home.php");

            }*/

        }
        
        /*

        $script = incorrectUserDataError();

        foreach($script as $statement){
            echo $statement;
        }

        */
            
    }

    function sessionDeclare(array $data){

        if(isset($data['master_id'])) {
            if($data['status_master'] != 'Active') return 403;

            $_SESSION['master_id'] = intval($data['master_id']);
            $_SESSION['user_login'] = $data['username'];
            $_SESSION['name'] = $data['fname'].' '.$data['lname'];

            $dbrole = $data['user_role_id'];
        }

        if(isset($data['login_id'])) {
            if($data['status_login'] != 'Active') return 403;

            $_SESSION['master_id'] = intval($data['user_id']);
            $_SESSION['user_login'] = $data['username'];
            $_SESSION['name'] = $data['firstname'].' '.$data['lastname'];

            $dbrole = $data['user_role_id'];
        }

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
                $_SESSION['success'] = "รองผู้อำนวยการ ฝ่ายวิชาการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
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
            $_SESSION['login_type'] = 0;
                $script = incorrectUserDataError();

                return $script;
        }


    }
    
    function legacyLogin(int $isEnabled) {
        if (!$isEnabled){
            return;
        }

        $_SESSION["UserID"] = $_SESSION['master_id'];
        $_SESSION["User"] = $_SESSION['name'];
        $_SESSION["Userlevel"] = $_SESSION['login_type'];
    
        switch ($_SESSION['login_type']) {
            case 0:
                break;
            case 1:
                $_SESSION['admin_login'] = $_SESSION['user_login'];
                $_SESSION['Role'] = 'ผู้ดูแลระบบ';
                break;
            case 2:
                $_SESSION['director_login'] = $_SESSION['user_login'];
                $_SESSION['Role'] = 'ผู้อำนวยการ';
                break;
            case 3:
                $_SESSION['deputydirector_login'] = $_SESSION['user_login'];
                $_SESSION['Role'] = 'รองผู้อำนวยการ';
                break;
            case 4:
                $_SESSION['academicdepartment_login'] = $_SESSION['user_login'];
                break;
            case 5:
                $_SESSION['teacher_login'] = $_SESSION['user_login'];
                $_SESSION['Role'] = 'คุณครู';
                    break;
            case 6:
                $_SESSION['headprimary_login'] = $_SESSION['user_login'];
                $_SESSION['Role'] = 'หัวหน้าช่วงชั้นประถม';
                break;
            case 7:
                $_SESSION['headhighschool_login'] = $_SESSION['user_login'];
                $_SESSION['Role'] = 'หัวหน้าช่วงชั้นมัธยม';
                break;
            default:
                $_SESSION['error'] = "ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง";
            
        }
    }

?>