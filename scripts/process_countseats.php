<?php
include 'connectdb.php';

$day = $_POST['day'];
$query = 'SELECT Avg(SeatCapacity) AS Avg, Day FROM (((DaysOffered INNER JOIN Flight ON DaysOffered.3DigitNumber=Flight.3DigitNumber AND DaysOffered.AirlineCode=Flight.AirlineCode) INNER JOIN Airplane ON Flight.AirplaneID= Airplane.AirplaneID) INNER JOIN AirplaneType ON Airplane.TypeName=AirplaneType.TypeName) WHERE Day="' . $day . '" GROUP BY Day';
$result = $connection->query($query);
if ($row = $result->fetch()) { 
    $finalAvg = round($row['Avg']);
}
$connection = NULL;
?>
<form action='../menu.php' id='form' method='get' style='display:none'>
    <?php echo "<input name='countseats' value='" . $finalAvg . "'>"; ?>
    <?php echo "<input name='day' value='" . $day . "'>"; ?>
    <input type='submit'>
</form>

<script type="text/javascript">
    document.getElementById('form').submit();
</script>