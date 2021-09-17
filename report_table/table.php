<?php
    include_once('../connection.php');
    include_once('./src/date.php');

    $query = "SELECT * FROM login_information ORDER BY master_id asc" or die("Error:" . mysqli_error());
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
                    รวม (<?php echo $trCount;?>)
                </th>
                <th class="percent">
                    ร้อยละ
                </th>
                <th class="score">
                    คะเเนน
                </th>
            </tr>

<?php

    while($row = mysqli_fetch_array($result))
    {
        $_SESSION['userNumber'] += 1;
        echo "
            <tr>
                <td>".$_SESSION['userNumber']."
                </td>
                <td>".$row['fname'].'  '.$row['lname']."
                </td>";
        
                for($counter = 1, $day = $firstDay; $counter <= $monthCount; $counter++, $day++){
    
                    if ($day === 7){
                        $day = 0;
                    }
                    
                    if(isWorkDayLoop($day)) continue;
            
                    
                    $trCount += 1;
                    
                    if ($day === 5) echo '<td class="date blueBox">';
                    if ($day != 5) echo '<td class="date">';

                    echo"</td>";
                    
                }

        echo    "<td>
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>"
            ;
    }

?>

        </table>
    </body>
</html>