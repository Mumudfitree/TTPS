<?php

//import.php

include 'vendor/autoload.php';

//include('../connection.php');//เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$database = "php_multiplelogin";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
mysqli_set_charset($conn, "utf8");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if($_FILES["import_excel"]["name"] != '')
{
 $allowed_extension = array('xls', 'csv', 'xlsx');//สกุลไฟล์
 $file_array = explode(".", $_FILES["import_excel"]["name"]);//Upload
 $file_extension = end($file_array);//

 if(in_array($file_extension, $allowed_extension))
    {
  $file_name = time() . '.' . $file_extension;
  move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
  $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

  $spreadsheet = $reader->load($file_name);

  unlink($file_name);

  $data = $spreadsheet->getActiveSheet()->toArray();
  $i = 2;
  $j = 0;
  foreach($data as $row[])
  {
    if($j >= 0){
        if($i > 3){
            

    $firstname = trim($row[0][0]);//A[0][0]
    $lastname = trim($row[0][1]);//A[0][0]*/
    $sql1 = "SELECT login_id FROM login_information as login, user_data as user WHERE user.user_id = login.user_id AND login.user_role_id ='5' AND user.firstname = '$firstname' AND user.lastname = '$lastname'";
    $query1 = mysqli_query($conn,$sql1);
    $row11 = mysqli_fetch_array($query1);
    $login_id = $row11['login_id'];
    
    
    $year = trim($row[0][2]);//C
    $sql6 = "SELECT year_id FROM year WHERE year_name = '".$year."' ";
    $query6 = mysqli_query($conn,$sql6);
    $row6 = mysqli_fetch_array($query6);
    $year_id = $row6['year_id'];

    $date = trim($row[$j][0]);//B
    /*$sql6 = "SELECT choose_id FROM choose_a_teaching  WHERE date = '".$date."' ";
    $query6 = mysqli_query($conn,$sql6);
    $row6 = mysqli_fetch_array($query6);
    $master_id = $row6['master_id'];*/

    $time = trim($row[$j][1]);//C
    $sql5 = "SELECT time_id FROM time WHERE time_name = '".$time."' ";
    $query5 = mysqli_query($conn,$sql5);
    $row5 = mysqli_fetch_array($query5);
    $time_id = $row5['time_id'];

    $class = trim($row[$j][2]);
    $sql4 = "SELECT class_id FROM classroom WHERE name_classroom = '".$class."' ";
    $query4 = mysqli_query($conn,$sql4);
    $row4 = mysqli_fetch_array($query4);
    $class_id = $row4['class_id'];

    $code_subject = trim($row[$j][3]);//B
    $sql3 = "SELECT subject_id FROM subject WHERE code_subject = '".$code_subject."' ";
    $query3 = mysqli_query($conn,$sql3);
    $row3 = mysqli_fetch_array($query3);
    $subject_id = $row3['subject_id'];
    
    $grade = trim($row[$j][4]);//A[1][0]
    $sql2 = "SELECT grade_id FROM grade_level WHERE grade_level_user = '$grade' ";
    $query2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($query2);
    $grade_id  = $row2['grade_id'];

    $insert_data = array(//เพิ่มข้อมูล
        $firstname = trim($row[0][0]),//A[0][0]
        $lastname = trim($row[0][1]),
        $year = trim($row[0][2]),
        $date = trim($row[$j][0]),
        $time = trim($row[$j][1]),
        $class = trim($row[$j][2]),
        $code_subject = trim($row[$j][3]),
        $grade = trim($row[$j][4]) 
       );
    

   $query = "choose_a_teaching(login_id,grade_id,subject_id,class_id,time_id,date,year_id) VALUES 
   (:login_id,:grade_id ,:subject_id,:class_id,:time_id,:date,:year_id)";
   
   /*$result = $connection->prepare('DELETE FROM blog WHERE id = ?');
$result->bind_param('i', $_GET['delpost']);
$result->execute();

   
   $statement ->bind_param($insert_data);
   $statement->execute($insert_data);*/
   $statement = $conn->prepare($query);
   $statement->execute($insert_data);
    }
    $i++;
}
    $j++;
  }
    $message = '<div class="alert alert-success">Data Imported Successfully</div>';

 }
 else
 {
  $message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
 }
}
else
{
 $message = '<div class="alert alert-danger">Please Select File</div>';
}


echo $message;


?>
