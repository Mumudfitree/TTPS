<?php /*
    session_start();

    if (!isset($_SESSION['admin_login'])) {
        header("location: ../index.php");
    }
    */
?>
<!--<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าอัพโหลดข้อมูลผ่านทางexcel</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>

<body>
    <?php // include_once('slidebar_admin.php'); ?>
    <div class="main">
        <div class="container">
            <div class="form - text-center">
                <div class="display-3 text-center">หน้าอัพโหลดข้อมูลผ่านทางexcel</div>
                <br>
                <form action="save.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="myfile" required
                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                    <button type="submit" class="btn btn-info">อัพโหลด</button>
                </form>

            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="form-group text-center">
        <div class="col-sm-offset-3 col-sm-9 mt-5">
            <a href="choose_a_teaching.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</body>

</html>-->
<!DOCTYPE html>
<html>
   <head>
     <title>Import Data From Excel or CSV File to Mysql using PHPSpreadsheet</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   </head>
   <body>
     <div class="container">
      <br />
      <h3 align="center">Import Data From Excel or CSV File to Mysql using PHPSpreadsheet</h3>
      <br />
      
        <div class="panel panel-default">
          <div class="panel-heading">Import Data From Excel or CSV File to Mysql using PHPSpreadsheet</div>
          <div class="panel-body">
          <div class="table-responsive">
           <span id="message"></span>
         
              <form method="post" id="import_excel_form" enctype="multipart/form-data">
                <table class="table">
                  <tr>
                    <td width="25%" align="right">Select Excel File</td>
                    <td width="50%"><input type="file" name="import_excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" /></td>
                    <td width="25%"><input type="submit" name="import" id="import" class="btn btn-primary" value="Import" /></td>
                  </tr>
                </table>
              </form>
           <br />
              
          </div>
          </div>
        </div>
     </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  </body>
</html>
<script>
$(document).ready(function(){
  $('#import_excel_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"save.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import').attr('disabled', 'disabled');
        $('#import').val('Importing...');
      },
      success:function(data)
      {
        $('#message').html(data);
        $('#import_excel_form')[0].reset();
        $('#import').attr('disabled', false);
        $('#import').val('Import');
      }
    })
  });
});
</script>