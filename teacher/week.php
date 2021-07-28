<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้
    require_once('../connection.php');
    date_default_timezone_set('Asia/Bangkok');
    $id =$_SESSION['master_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปจุดประสงค์รายสัปดาห์</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../pass_or_no.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include('sidebar.php'); ?>
    <div class="main">
        <div class="container">
            <div class="display-3 text-center">สรุปจุดประสงค์รายสัปดาห์</div>
            <a href="add_week.php" class="btn btn-success mb-3">เพิ่มสรุปจุดประสงค์รายสัปดาห์</a>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>วัน/เดือน/ปี</th>
                        <th>รหัสวิชา ชื่อวิชา (ชั้นเรียน)</th>
                        <th>แก้ไข</th>
                        <th>ดาวน์โหลด</th>
                        <th>สถานะการส่ง</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                $select_stmt = $db->prepare("SELECT  * FROM weekly_summary");
                $select_stmt->execute();

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){
                ?>

                    <?php $row["date_prepare_week"];
                     $id =$_SESSION['master_id']; ?>
                    <tr>

                        <?php if($row['status_prepare_week'] !='Complete' && $row['master_id'] == $id && $row['status_choose'] == 'Active'){?>
                        <td><?php echo $row["date_prepare_week"]; ?></td>
                        <td><?php echo  $row['code_subject'].' '.$row['name_subject'].' ('.$row['name_classroom'].')'; ?>
                        </td>
                        <td><a href="edit_week.php?update_id=<?php echo $row["id_prepare_week"]; ?>"
                                class="btn btn-warning">แก้ไข</td>
                        <td><a target="_blank"
                                href="download_week.php?download_id=<?php echo $row["id_prepare_week"]; ?>"
                                class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                </svg> ดาวน์โหลด</a></td>
                        <td><?php if($row['status_prepare_week'] == 'Checking'){ ?>
                            <p class="status">รอการตรวจสอบการส่ง</p>
                            <?php }elseif($row['status_prepare_week'] == 'Incomplete'){ ?>
                            <p class="status_nopass">ไม่ผ่านต้องแก้ไข</p>
                            <?php }?>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <a href="teacher_home.php" class="btn btn-warning">Back</a>
    <a href="../logout.php" class="btn btn-danger">Logout</a>
    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>


</body>

</html>