<?php 
    session_start();

    if ($_SESSION['login_type'] != 6) {
        header("location: ../index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หัวหน้าช่วงชั้นประถม</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<?php include_once('primary_slidebar.php'); ?>
    <div class="main">
    <div class="text-center mt-5">
        <div class="container">

            <?php if(isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <h3>
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>

            <h1>หัวหน้าช่วงชั้นประถม หน้าหลัก</h1>
            <hr>
                
            <h3>
                <?php if($_SESSION['login_type'] != 6) { ?>
                Welcome, <?php echo $_SESSION['name']; }?>
            </h3>

        </div>
    </div>
    </div>
    
</body>
</html>