<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>AirlineDB</title>
    <script src='scripts/src.js'></script>
    <link rel="stylesheet" href="styles/style_menu.css">
</head>
<?php
if (isset($_GET['newflight'])) {
    // refresh without parameters after processing get request
    echo "<script type='text/javascript'>window.onload = function() {document.getElementById('newFlightMsg').classList.remove('noSubmit');};</script>";
    echo "<script type='text/javascript'>window.history.replaceState({}, 'Hide', 'menu.php');</script>";
} elseif (isset($_GET['updateflight'])) {
    echo "<script type='text/javascript'>window.onload = function() {document.getElementById('updateMsg').classList.remove('noSubmit');};</script>";
    echo "<script type='text/javascript'>window.history.replaceState({}, 'Hide', 'menu.php');</script>";
} elseif (isset($_GET['countseats'])) {
    echo "<script type='text/javascript'>window.onload = function() {document.getElementById('seatCountText').innerText = 'Average seat capacity on " . $_GET['day'] . " is " . $_GET['countseats'] . ".'; showForm('form5', 'button5'); document.getElementById('button5').classList.add('noHover'); document.getElementById('seatCount').classList.remove('noSubmit');};</script>";
    echo "<script type='text/javascript'>window.history.replaceState({}, 'Hide', 'menu.php');</script>";
}
?>

<body id='menupage'>
    <?php
    include 'scripts/getdata.php';
    $weekdays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    date_default_timezone_set('America/Toronto');
    ?>

    <h1>Airline Database Manager</h1>
    <div id='msgPosition'>
        <div class='noSubmit msg' id='newFlightMsg'>
            <h3>New Flight Successfully Added</h3>
        </div>
        <div class='noSubmit msg' id='updateMsg'>
            <h3>Departure Time Successfully Updated</h3>
        </div>
    </div>

    <!-- Function 1 -->
    <button onclick='document.getElementById("form1").submit(); hideAll(["2", "3", "4", "5"])'>Show flights that arrived on time</button>
    <form hidden=true id='form1' action="scripts/results_samearrivals.php" method="post">
        <input type='submit'>
    </form>

    <!-- Function 2 -->
    <button id='button2' onclick='toggleClass(this, "noHover"); toggle(this, "form2", ["3", "4", "5"]);'>Show flights by airline and day</button>
    <form hidden=true id='form2' action="scripts/results_airlineflights.php" method="post">
        <div class='flex'>
            <div class='labelinput column2'><label for='airlinecode'>Airline Code</label><input required placeholder='XX' style='background-color:rgb(120 233 152)' type='text' name='airlinecode'></div>
            <div class='labelinput column2'><label for='day'>Day</label>
                <select style='background-color:rgb(85 229 176)' name='day'>
                    <?php
                    showWeekOptions();
                    ?>
                </select>
            </div>
            <div class='column2'><input class='submit' type='submit' value='Go'></div>
        </div>
    </form>

    <!-- Function 3 -->
    <button id='button3' onclick='toggleClass(this, "noHover"); toggle(this, "form3", ["2", "4", "5"]);'>Add a new flight</button>
    <form hidden=true action='scripts/process_newflight.php' method='post' id='form3' class='form3'>
        <div class='flex'>
            <div class='row3'>
                <div class='labelinput column3'><label>Flight Code</label><input required placeholder='000' style='background-color:rgb(113 232 158)' name='flightcode' type='text' minlength=3 maxlength=3></div>
                <div class='labelinput column3'><label>Airline</label>
                    <select required style='background-color:rgb(71 234 174)' name='airline'>
                        <option value=''>Select</option>
                        <?php
                        showOptionsFromTable('Airline', 'AirlineCode');
                        ?>
                    </select>
                </div>
            </div>
            <div class='labelinput row3 column3'>
                <label for='airplane'>Plane ID</label>
                <select required style='background-color:rgb(118 233 154)' name='airplane'>
                    <option value=''>Select</option>
                    <?php
                    showOptionsFromTable('Airplane', 'AirplaneID');
                    ?>
                </select>
            </div>
            <div class='row3'>
                <div class='labelinput column3'>
                    <label>Departure Airport</label>
                    <select required style='background-color:rgb(117 233 154)' name='departairport'>
                        <option value=''>Select</option>
                        <?php
                        showOptionsFromTable('Airport', 'AirportCode');
                        ?>
                    </select>
                </div>
                <div class='labelinput column3'>
                    <label>Arrival Airport</label>
                    <select required style='background-color:rgb(76 232 175)' name='arriveairport'>
                        <option value=''>Select</option>
                        <?php
                        showOptionsFromTable('Airport', 'AirportCode');
                        ?>
                    </select>
                </div>
            </div>
            <div style='margin-top:5px; margin-bottom:5px;' class='labelinput row3'>
                <label>Days Offered</label>
                <?php
                for ($i = 0; $i < 7; $i++) {
                    $value = $weekdays[$i];
                    echo "<label style='color:white; font-weight:normal; margin-right: 0; margin-left: 5px; font-size:90%' for='" . $value . "'>" . substr($value, 0, 3) . "</label><input class='nostyle' type='checkbox' value='" . $value;
                    echo "' name='days[]'>";
                }
                ?>
            </div>
            <input class='row3 column3 submit' type='submit' value='Add'>
        </div>

    </form>

    <!-- Function 4 -->
    <button id='button4' onclick='toggleClass(this, "noHover"); toggle(this, "form4", ["2", "3", "5"]);'>Update a flight's actual departure</button>
    <form hidden=true action='scripts/process_updateflight.php' method='post' id='form4'>
        <div class='flex'>
            <div class='labelinput column4'>
                <label>Flight Number</label>
                <select required style='background-color:rgb(132 235 143)' id='form4select1' name='flightcode'>
                    <option value=''>Select</option>
                    <?php
                    showFlightOptions();
                    ?>
                </select>
            </div>
            <div class='labelinput column4'>
                <label>Actual Departure Time</label>
                <div class='row4'>
                    <select required style='background-color:rgb(95 229 173)' name='hour'>
                        <?php
                        showTimeOptions('hh');
                        ?>
                    </select>
                    <select required style='background-color:rgb(84 230 176)' name='minute'>
                        <?php
                        showTimeOptions('mm');
                        ?>
                    </select>
                    <select required style='background-color:rgb(73 233 174)' name='second'>
                        <?php
                        showTimeOptions('ss');
                        ?>
                    </select>
                </div>
            </div>
            <div class='column4'>
                <input class='submit' type='submit' value='Update'>
            </div>
        </div>
    </form>

    <!-- Function 5 -->
    <button id='button5' onclick='addClass("seatCount", "noSubmit"); toggleClass(this, "noHover"); toggle(this, "form5", ["2", "3", "4"]);'>Show average seat capacity by day</button>
    <form hidden=true action='scripts/process_countseats.php' method='post' id='form5'>
        <div class='flex'>
            <?php
            for ($i = 0; $i < 7; $i++) {
                $value = $weekdays[$i];
                echo "<input required type='radio' value='" . $value;
                echo "' name='day'><label for='" . $value . "'>" . substr($value, 0, 3) . "</label>";
            }
            ?>
            <input class='submit' type='submit' value='Go'>
        </div>
        <div class='noSubmit formMsg' id='seatCount'>
            <h3 id='seatCountText'>Average seat capacity on Xday is Y</h3>
        </div>
    </form>

    <?php
    $connection = NULL;
    ?>
</body>

</html>