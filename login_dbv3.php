<?php 
session_start();

    require_once 'connection.php';

    
        if(isset($_POST['btn_login'])){
				//connection
				//รับค่า user & password
                  $username = $_POST['txt_username'];
                  $password = $_POST['txt_password'];
                  $role = $_POST['txt_role'];
				//query 
                  $sql="SELECT * FROM login_information Where username='".$username."' and password='".$password."' and user_role_id ='".$role."' ";

                  $result = mysqli_query($conn,$sql);
				
                  if(mysqli_num_rows($result)==1){

                      $row = mysqli_fetch_array($result);

                      $_SESSION["UserID"] = $row["master_id"];
                      $_SESSION["User"] = $row["fname"]." ".$row["lname"];
                      $_SESSION["Userlevel"] = $row["user_role_id"];
                      

                      if($_SESSION["Userlevel"]== "1" && $row['status_master'] == 'Active'  ){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php

                        $_SESSION['admin_login'] = $username;
                        $_SESSION['success'] = "ผู้ดูแลระบบ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: admin/admin_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }

                      if ($_SESSION["Userlevel"]=="2" && $row['status_master'] == 'Active' ){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['director_login'] = $username;
                        $_SESSION['success'] = "ผู้อำนวยการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: director/director_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }

                      if ($_SESSION["Userlevel"]=="3" && $row['status_master'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['deputydirector_login'] = $username;
                        $_SESSION['success'] = "รองผู้อำนวยการ ฝ่ายวิชาการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: deputydirector/deputydirector_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }

                      if ($_SESSION["Userlevel"]=="4" && $row['status_master'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['academicdepartment_login'] = $username;
                        $_SESSION['success'] = "ฝ่ายวิชาการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: academicdepartment/academicdepartment_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }
                      

                      if ($_SESSION["Userlevel"]=="5" && $row['status_master'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['teacher_login'] = $username;
                        $_SESSION["User"];
                        $_SESSION['master_id'] = $id;
                        $_SESSION['success'] = "ครู ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: teacher/teacher_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }

                      if ($_SESSION["Userlevel"]=="6" && $row['status_master'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['headprimary_login'] = $username;
                        $_SESSION['success'] = "หัวหน้าช่วงชั้นประถม ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: headprimary/headprimary_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }
                      if ($_SESSION["Userlevel"]=="7" && $row['status_master'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['headhighschool_login'] = $username;
                        $_SESSION['success'] = "หัวหน้าช่วงชั้นมัธยม ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: headhighschool/headhighschool_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }

                  }else{
                    echo "<script>";
                        echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";
                  }

                }else{
                  echo "<script>";
                      echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                      echo "window.history.back()";
                  echo "</script>";
                }
?>

    