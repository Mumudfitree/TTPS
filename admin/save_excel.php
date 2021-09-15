<?php

//import.php

include 'vendor/autoload.php';

$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");

if($_FILES["import_excel"]["name"] != '')
{
 $allowed_extension = array('xls', 'csv', 'xlsx');//นามสกุลไฟล์
 $file_array = explode(".", $_FILES["import_excel"]["name"]);
 $file_extension = end($file_array);

 if(in_array($file_extension, $allowed_extension))
 {
  $file_name = time() . '.' . $file_extension;//ชื่อตอน import ชื่อ(เวลา) + . + นามสกุลไฟล์ 
  move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);//ส่วนของข้อมูลที่import แล้ว สร้างใหม่
  $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);//ส่วนของข้อมูลที่import แล้ว สร้างใหม่
  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);//ส่วนของข้อมูลที่import แล้ว สร้างใหม่

  $spreadsheet = $reader->load($file_name);//ส่วนของข้อมูลที่import แล้ว สร้างใหม่

  unlink($file_name);//ส่วนของข้อมูลที่import แล้ว สร้างใหม่

  $data = $spreadsheet->getActiveSheet()->toArray();

  foreach($data as $row)
  {
   $insert_data = array(
    ':first_name'  => $row[0],
    ':last_name'  => $row[1],
    ':created_at'  => $row[2],
    ':updated_at'  => $row[3]
   );

   $query = "
   INSERT INTO sample_datas 
   (first_name, last_name, created_at, updated_at) 
   VALUES (:first_name, :last_name, :created_at, :updated_at)
   ";

   $statement = $connect->prepare($query);
   $statement->execute($insert_data);
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
