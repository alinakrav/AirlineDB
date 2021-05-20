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
        $airlineCode = $_POST['airlinecode'];
        $day = $_POST['day'];
        $query = 'SELECT daysoffered.airlinecode as AirlineCode, daysoffered.3digitnumber as 3DigitNumber, leaves.city AS DepartCity, arrives.city AS ArriveCity, Day FROM (((flight INNER JOIN daysoffered ON flight.airlinecode=daysoffered.airlinecode AND flight.3digitnumber=daysoffered.3digitnumber) INNER JOIN airport AS leaves ON flight.departureairport=leaves.airportcode) INNER JOIN airport AS arrives ON flight.arrivalairport=arrives.airportcode) where DaysOffered.AirlineCode="' . $airlineCode . '" and Day="' . $day . '"';
        $result = $connection->query($query);

        if ($result->rowCount() != 0) {
            echo '<h1>' . strtoupper($airlineCode) . '\'s Flights on ' . $day . ':</h1>';
            echo '<table><tr><th>Flight Code</th><th>Departure Location</th><th>Arrival Location</th></tr>';
        } else { // if no results
            echo '<div class="noresult"><h1 style="color:white">No results found for this query.</h1></div><table>';
        }
        while ($row = $result->fetch()) {
            echo "<tr><td>" . $row["AirlineCode"] . $row["3DigitNumber"] . "</td><td>" . $row["DepartCity"] . "</td><td>" . $row["ArriveCity"] . "</td></tr>";
        }
        $connection = NULL;
        ?>
    </table>
</body>

</html>