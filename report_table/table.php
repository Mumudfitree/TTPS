<?php
    include_once('../connection.php');
    include_once('./src/date.php');
    include_once('./src/userData.php');

    define('Generate', 1);

    $query = "SELECT * FROM login_information ORDER BY master_id asc" or die("Error:" . mysqli_error($conn));
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $_SESSION['userNumber'] = 0;

    /* while($row =  mysqli_fetch_array($result))
    {
        $_SESSION['userNumber'] += 1;
        echo $_SESSION['userNumber'];
    }*/

    $dayInfo = getDayOfWeek();
    $monthCount = returnDayCount($dayInfo);
    $enum_day = enumGenerator($monthCount);
    $firstDay = findFirstDayOfMonth($dayInfo);
    $enum_day = dayGenerate($enum_day, $monthCount, $firstDay);

?>
<html>
    <head>
        
    </head>
    <body>
        <link rel="stylesheet" href="./test/css/table.css"></link>
        <div>
            การเตรียมการสอนระดับประถม (อิสลามศึกษา)
            <p>ภาคเรียนที่ 1 ปีการศึกษา 2563 ประจำเดือนกันยายน</p>
        </div>
        <table margin="center">
            <tr>
                <th class="order">
                    ที่
                </th>
                <th class="name">
                    ชื่อ-สกุล
                </th>
                <?php

$trCount = 0;

    for($counter = 1, $day = $firstDay; $counter <= $monthCount; $counter++, $day++){
    
        if ($day === 7){
            $day = 0;
        }
        
        if(isWorkDayLoop($day)) continue;

        
        $trCount += 1;
        
        if ($day === 5) echo '<th class="date blueBox">';
        if ($day != 5) echo '<th class="date">';
        
        echo        $counter.'
        </th>
        ';

    }

?>
                <th class="sum">
                    รวม (<?php echo $trCount; $_SESSION['trCount'] = $trCount;?>)
                </th>
                <th class="percent">
                    ร้อยละ
                </th>
                <th class="score">
                    คะเเนน
                </th>
            </tr>

<?php

    $i = 0;

    while($row = mysqli_fetch_array($result))
    {
        $_SESSION['userNumber'] += 1;
        echo "
            <tr>
                <td>".$_SESSION['userNumber']."
                </td>
                <td>".$row['fname'].'  '.$row['lname']."
                </td>";

                $count = array();

                for($counter = 1, $day = $firstDay, $count[$i] = 0; $counter <= $monthCount; $counter++, $day++){
    
                    if ($day === 7){
                        $day = 0;
                    }
                    
                    if(isWorkDayLoop($day)) continue;
                    
                    if(Generate && (!isset($_SESSION['prevent']))){
                        $rand = dataGenerater();
                    }
                    
                    $trCount += 1;
                    
                    if(checkPainterSpecialCase($rand)){

                        if($rand==='11'){
                            echo '<td class="date leave-assign">1</td>';
                            $count[$i] += 1;
                        }
                        else {
                            if($rand==='0'){
                                echo '<td class="date blank">';
                            }
                            if($rand==='0.3'){
                                echo '<td class="date third">';
                                $count[$i] += 0.3;
                            }
                            if($rand==='0.5'){
                                echo '<td class="date half">';
                                $count[$i] += 0.5;
                            }
                            if($rand==='0.7'){
                                echo '<td class="date seventh">';
                                $count[$i] += 0.7;
                            }
                            if($rand==='ป'){
                                echo '<td class="date ill">';
                            }
                            if($rand==='ล'){
                                echo '<td class="date leave">';
                            }
                            echo $rand."</td>";
                        }
                    }
                    else {
                        if ($day === 5) echo '<td class="date blueBox">';
                        if ($day != 5) echo '<td class="date">';

                        echo"1</td>";
                        $count[$i] += 1;
                    }

                    
                }

        $sum = $count[$i];
        $percent = round(($sum/(intval($_SESSION['trCount']))*100), 2, PHP_ROUND_HALF_UP);
        $score = round(($percent/10), 0, PHP_ROUND_HALF_UP);
        
        
        echo    "<td>".$sum."
                </td>
                <td>".$percent."
                </td>
                <td>".$score."
                </td>
            </tr>"
            ;

        $i += 1;
    }
    unset($_SESSION['prevent']);
?>

        </table>
        <div class="container">
            <div class="card">
                <p><br>........................................<br>
                    (นางสาวอสิต  เห็นดีน)<br>
                    หัวหน้าช่วงชั้นประถม(อิสลามศึกษา)<br>
                </p>
                <p>
                <br>........................................<br>
                    (นางสาวมาเรียม  หัสเหล็ม)<br>
                    รอง ผอ. ฝ่ายวิชาการ<br>
                </p>
            </div>
            <div class="card">
            <p><br>........................................<br>
                    (นางสาวรัชฎาภรณ์  หมัดแสละ)<br>
                    หัวหน้าฝ่ายวิชาการประถม<br>
                </p>
                <p>
                <br>........................................<br>
                    (นายสุวรรณ  อุมาสะ)<br>
                    ผู้อำนวยการ<br>
                </p>
            </div>
        </div>
    </body>
</html>