<?php
include 'connectdb.php';
$flightcode = substr($_POST['flightcode'], -3);
$airline = substr($_POST['flightcode'], 0, -3);
$departTime = $_POST['hour'] . ':' . $_POST['minute'] . ':' . $_POST['second'];
$query = 'UPDATE Flight SET ActualDeparture="' . $departTime . '" WHERE 3DigitNumber="' . $flightcode . '" AND AirlineCode="' . $airline . '"';
$numRows = $connection->exec($query);
$connection = NULL;
?>
<form action='../menu.php' id='form' method='get' style='display:none'>
    <input name='updateflight' value='1'>
    <input type='submit'>
</form>
<script type="text/javascript">
    document.getElementById('form').submit();
</script>