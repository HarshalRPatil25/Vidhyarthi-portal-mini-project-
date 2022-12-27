<?php
$conn = mysqli_connect('localhost', 'root', '', 'miniproject');
$query = "select date_format(curdate(), '%d/%m/%Y')";
$result = $conn->query($query);
$curDate = 0;

if (mysqli_num_rows($result) > 0) {
    while ($rowData = mysqli_fetch_array($result)) {
        $curDate = $rowData[0];
    }
}
if (isset($_POST['submit'])) {
    $rollno = $_POST['rns'];
    $ap = $_POST['ap'];
    $date = $_POST['date'];
    echo $date;
    echo $curDate;

    // $sql="UPDATE present SET Present='$ap' WHERE Roll_no in ($rollno)";
    if ($date < $curDate) {
        if ($ap == 'P') {
            $insertcolumn = "ALTER TABLE present ADD `$date` int(5)";
            $sql = "UPDATE present SET `$date`='1' WHERE Roll_no in ($rollno)";
            $sql1 = "UPDATE present SET `$date`='0' WHERE Roll_no not in ($rollno)";
        } else if ($ap == 'A') {
            $insertcolumn = "ALTER TABLE present ADD `$date` int(5)";
            $sql = "UPDATE present SET `$date`='0' WHERE Roll_no in ($rollno)";
            $sql1 = "UPDATE present SET `$date`='1' WHERE Roll_no not in ($rollno)";
        }
        if ($conn->query($insertcolumn) === TRUE) {
            // echo "Saved Changes";
        } else {
            echo "Something Went Wrong";
        }
        if ($conn->query($sql) === TRUE) {
            // echo "Saved Changes";
        } else {
            echo "Something Went Wrong";
        }
        if ($conn->query($sql) === TRUE) {
            // echo "Saved Changes";
        } else {
            echo "Something Went Wrong";
        }

    } else {
        echo "DATE ID NOT PREVIOUS ONE!!!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Previous</title>
    <link rel="stylesheet" href="Update_Previous_Style.css">
</head>

<body>

    <div class="login-form">
        <form action="Update_Previous.php" method="post">
            <h1><b>Update Previous Attendance</b></h1>
            <div class="content">
                <div class="input-details">
                    <input id="idate" name="date" type="date" placeholder="Enter The Date">
                </div>
                <div class="input-details">
                    <input name="rns" type="text" placeholder="Enter Roll Numbers">
                </div>
                <div class="input-details">
                    <input name="ap" type="text" style="text-transform: uppercase;" placeholder="A or P">
                    <!-- <select id="ap" name="ap">
                        <option value="P">P</option>
                        <option value="A">A</option>
                    </select> -->
                </div>

            </div>
            <div class="action">
                <input name="submit" type="submit"></input>
            </div>
        </form>
    </div>


</body>

</html>