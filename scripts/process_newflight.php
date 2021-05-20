<?php
include 'connectdb.php';
$flightcode = $_POST['flightcode'];
$airline = $_POST['airline'];
$airplane = $_POST['airplane'];
$departAirport = $_POST['departairport'];
$arriveAirport = $_POST['arriveairport'];
$days = $_POST['days'];
$query = 'INSERT INTO Flight values("' . $flightcode . '","' . $airline . '","' . $airplane . '","' . $departAirport . '",null,null,"' . $arriveAirport . '",null,null)';
$numRows = $connection->exec($query);
foreach ($days as $day) {
    $query2 = 'INSERT INTO DaysOffered values("' . $flightcode . '","' . $airline . '","' . $day . '")';
    $numRows = $connection->exec($query2);
}
$connection = NULL;
?>
<form action='../menu.php' id='form' method='get' style='display:none'>
    <input name='newflight' value='1'>
    <input type='submit'>
</form>
<script type="text/javascript">
    document.getElementById('form').submit();
</script>