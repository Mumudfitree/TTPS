<?php

    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if ($_SESSION['login_type'] != 1) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }


    require_once('../connection.php');
    
    $query=mysqli_query($conn,"SELECT COUNT(grade_id) FROM grade_level");
                        $row = mysqli_fetch_row($query);
                    
                        $rows = $row[0];
                    
                        $page_rows = 10;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 
                    
                        $last = ceil($rows/$page_rows);
                    
                        if($last < 1){
                            $last = 1;
                        }
                    
                        $pagenum = 1;
                    
                        if(isset($_GET['pn'])){
                            $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
                        }
                    
                        if ($pagenum < 1) {
                            $pagenum = 1;
                        }
                        else if ($pagenum > $last) {
                            $pagenum = $last;
                        }
                    
                        $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
                    
                        $sql = "SELECT * from grade_level ORDER BY grade_id DESC $limit";
                        if(isset($_GET['search'])){ 
                            $search = $_GET['search'];
                            $sql = "SELECT * from grade_level WHERE name_gradelevel LIKE '%" . $search . "%' ORDER BY grade_id DESC $limit ";
                        }
                        $nquery=mysqli_query($conn,$sql);
                    
                        $paginationCtrls = '';
                    
                        if($last != 1){
                    
                            if ($pagenum > 1) {
                        $previous = $pagenum - 1;
                                $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-info">ย้อนกลับ</a> &nbsp; &nbsp; ';
                        
                                for($i = $pagenum-4; $i < $pagenum; $i++){
                                    if($i > 0){
                                $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
                                    }
                            }
                        }
                        
                            $paginationCtrls .= ''.$pagenum.' &nbsp; ';
                        
                            for($i = $pagenum+1; $i <= $last; $i++){
                                $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
                                if($i >= $pagenum+4){
                                    break;
                                }
                            }
                        
                        if ($pagenum != $last) {
                        $next = $pagenum + 1;
                        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-info">ถัดไป</a> ';
                        }
                            }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระดับชั้นเรียน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../pass_or_no.css">
</head>

<body>
    <?php include_once('slidebar_admin.php'); ?>
    <div class="main">
        <div class="container">
            <div class="display-3 text-center">ระดับชั้นเรียน</div>
            <a href="add_grade_level.php" class="btn btn-success mb-3">เพิ่มระดับชั้นเรียน</a>
            <!-- ปุ่ม Search -->
            <ul class="nav nav-pills pull-right"> 
            <div class="d-flex pb-3">
            <input class="form-control me-2" type="search" placeholder="ค้นหาระดับชั้น" aria-label="Search"
                        id="Search" onchange="search_input()">
                    <button class=" btn btn-outline-success" type="submit" onclick='search()'>ค้นหา</button>
            </div>
            </div>

        <!-- ไอนี่ส่วน search ต้องใส่ ไม่ใส่แล้วดึงข้อมูลไม่ได้ แต่ซ่อน tag p ไว้ 😎😎 -->
        <script>
        function search_input() {
            var search = document.getElementById("Search").value;
            return search;
        }

        function search() {
            location.href = "grade_level.php?search=" + search_input();
        }
        </script>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ชื่อระดับการศึกษา</th>
                        <th>ชื่อระดับชั้นเรียน</th>
                        <th>สถานะ</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                        <th>แก้ไขสถานะ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row =  mysqli_fetch_array($nquery)){
                ?>

                    <tr>
                        <td><?php echo $row["grade_level_user"]; ?></td>
                        <td><?php echo $row["name_gradelevel"]; ?></td>
                        <td><?php if($row["status_grade"] == 'Active'){?>
                            <p class="active">ใช้งานได้</p>
                        <?php } elseif($row["status_grade"] == 'Inactive'){?>
                            <p class="inactive">ถูกระงับการใช้งาน</p>
                       <?php } ?></td>
                        <td><a href="edit_gradelevel.php?update_id=<?php echo $row['grade_id']; ?>"
                                class="btn btn-warning">แก้ไข</td>
                        <td><a href="delete_gradelevel.php?delete_id=<?php echo $row['grade_id']; ?>" class="btn btn-danger"
                                class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">ลบข้อมูล
                        </td>
                        <td><a href="change_status_grade.php?change_id=<?php echo $row["grade_id"]; ?>"
                                class="btn btn-info "
                                onclick="return confirm('คุณต้องการเปลี่ยนสถานะของระดับชั้นหรือไม่')">แก้ไขสถานะ</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
				</div>
				<div class="col-lg-2">
				</div>
        </div>
    </div>


    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>