<?php

// include composer autoload
require 'vendor/autoload.php';
include('../connection.php');//เชื่อมต่อฐานข้อมูล

// import the PhpSpreadsheet Class
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if($_FILES["myfile"]["name"] != '')
{
 $allowed_extension = array('xls', 'csv', 'xlsx');//สกุลไฟล์
 $file_array = explode(".", $_FILES["myfile"]["name"]);//Upload
 $file_extension = end($file_array);
 
//$inputFileName = $_FILES["myfile"]["name"];//ชื่อไฟล์ Excel ที่ต้องการอ่านข้อมูล $_FILES["myfile"]["name"]
//echo $inputFileName;
//move_uploaded_file($_FILES["myfile"]["name"],$inputFileName); // Copy/Upload CSV
    if(in_array($file_extension, $allowed_extension))
    {
    $file_name = time() . '.' . $file_extension;
    move_uploaded_file($_FILES['myfile']['tmp_name'], $file_name);
    $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

    $spreadsheet = $reader->load($file_name);
    //unlink($file_name);
    
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);



$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_name);
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
$writer->save('output.xlsx');
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('output.xlsx');
unlink($file_name);

$i = 0;
$j = 1;
$data = [];
foreach($sheetData as $s => $k){
    foreach($k as $g){
        $i++;
        $data[$j][] = $g;
    }
    $j++;
}
 
include('../connection.php');
$check = "SELECT * FROM choose_a_teaching";
                    $query_check = mysqli_query($conn,$check);
                    $row_check = mysqli_fetch_array($query_check);
 
//Insert Data To MySQL
$i = 2;
$j = 0;
foreach($data as $q[]){
    if($j >= 0){
        if($i > 3){
        
        $name = trim($q[0][0]);//A[0][0]
        $lname = trim($q[0][1]);//A[0][0]
        $sql1 = "SELECT login_id FROM login_information as login, user_data as user WHERE user.user_id = login.user_id AND login.user_role_id ='5' AND user.firstname = '".$name."' AND user.lastname = '".$lname."'
        AND user.status_user = 'Active' AND login.status_login = 'Active' ";
        $query1 = mysqli_query($conn,$sql1);
        $row = mysqli_fetch_array($query1);
        $login_id = $row['login_id'];
        
        $term = trim($q[0][2]);
        $year = trim($q[0][3]);//C
        $sql6 = "SELECT year_id FROM year WHERE year_name = '".$year."' AND term = '".$term."' AND status_year = 'Active' ";
        $query6 = mysqli_query($conn,$sql6);
        $row6 = mysqli_fetch_array($query6);
        $year_id = $row6['year_id'];

        $date = trim($q[$j][0]);//B
        /*$sql6 = "SELECT choose_id FROM choose_a_teaching  WHERE date = '".$date."' ";
        $query6 = mysqli_query($conn,$sql6);
        $row6 = mysqli_fetch_array($query6);
        $master_id = $row6['master_id'];*/

        $time = trim($q[$j][1]);//C
        $sql5 = "SELECT time_id FROM time WHERE time_name = '".$time."' AND year_id ='".$year_id."' AND status_time = 'Active' ";
        $query5 = mysqli_query($conn,$sql5);
        $row5 = mysqli_fetch_array($query5);
        $time_id = $row5['time_id'];

        

        
        
        $grade_level_user = trim($q[$j][4]);//A[1][0]
        $name_grade_level= trim($q[$j][5]);
        $sql2 = "SELECT grade_id FROM grade_level WHERE grade_level_user = '$grade_level_user' AND name_gradelevel = '$name_grade_level' AND status_grade = 'Active' ";
        $query2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_array($query2);
        $grade_id  = $row2['grade_id'];

        $class = trim($q[$j][2]);
        $sql4 = "SELECT class_id FROM classroom as class, grade_level as grade WHERE class.grade_id = grade.grade_id AND class.name_classroom = '".$class."' AND class.grade_id = '".$grade_id."' AND status_class = 'Active' ";
        $query4 = mysqli_query($conn,$sql4);
        $row4 = mysqli_fetch_array($query4);
        $class_id = $row4['class_id'];

        $code_subject = trim($q[$j][3]);//B
        $sql3 = "SELECT subject_id FROM subject WHERE code_subject = '".$code_subject."' AND grade_id = '".$grade_id."' AND status_subject = 'Active' ";
        $query3 = mysqli_query($conn,$sql3);
        $row3 = mysqli_fetch_array($query3);
        $subject_id = $row3['subject_id'];

        
        $check = "SELECT * FROM choose_a_teaching WHERE login_id = '$login_id' AND time_id = '$time_id' AND date = '$date' ";
        $query_check = mysqli_query($conn,$check)or die(mysqli_error());
        $row_check = mysqli_fetch_array($query_check);
        
        if($row_check > 0)
        {
            echo "<script>";
            echo "alert('มีข้อมูลซ้ำ');";
            echo "window.location ='choose_a_teaching.php'; ";
         echo "</script>";
        }else{
            $sql = "INSERT INTO choose_a_teaching (login_id,grade_id,subject_id,class_id,time_id,date,year_id) VALUES ('$login_id','$grade_id ','$subject_id','$class_id','$time_id ','$date','$year_id')";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>";
                            echo "alert('เพิ่มข้อมูลเสร็จสิ้น');";
                            echo "window.location ='choose_a_teaching.php'; ";
                    echo "</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        }
	    
	
	}
	$i++;
    }
    $j++;
        }

    }
}//ไฟล์ว่าง
echo "<script>";
    echo "alert('กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง');";
    echo "window.location ='add_excel.php'; ";
        echo "</script>"; 

mysqli_close($conn);
?>