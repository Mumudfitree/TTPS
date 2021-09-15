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
        <link rel="stylesheet" href="./test/css/style.css"></link>
        <table>
            <tr>
                <th>
                    ที่
                </th>
                <th>
                    ชื่อ-สกุล
                </th>
<?php

    for($counter = 1, $day = $firstDay; $counter <= $monthCount; $counter++){

        $enum_day[$counter] = $day;

        $day += 1;
        if ($day === 7){
            $day = 0;
        }


        echo '
                <th>
                '.$counter.'
                </th>
             ';
    }

?>
                <th>
                    รวม (%d)
                </th>
                <th>
                    ร้อยละ
                </th>
                <th>
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
                </td>
                
                <td>
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