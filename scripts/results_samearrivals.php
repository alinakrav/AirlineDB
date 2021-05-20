<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Search results</title>
    <link rel="stylesheet" href="/AirlineDB/styles/style_results.css">
</head>

<body>
    <?php
    include 'connectdb.php';
    ?>
    <button onclick='window.location = "/AirlineDB/menu.php"'>Go Back</button>
        <?php
        $query = 'SELECT AirlineCode, 3DigitNumber, ScheduledArrival FROM Flight WHERE ScheduledArrival=ActualArrival';
        $result = $connection->query($query);

        if ($result->rowCount() != 0) {
            echo '<h1>Flights that Arrived at Their Scheduled Time</h1>';
            echo '<table><tr><th>Flight Code</th><th>Arrival Time</th></tr>';
        } else { // if no results
            echo '<div class="noresult"><h1 style="color:white">No results found for this query.</h1></div><table>';
        }
        while ($row = $result->fetch()) {
            echo "<tr><td>" . $row["AirlineCode"] . $row["3DigitNumber"] . "</td><td>" . $row["ScheduledArrival"] . "</td></tr>";
        }
        ?>
    </table>
    <?php
    $connection = NULL;
    ?>
</body>

</html>