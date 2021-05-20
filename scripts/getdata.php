<?php
function showFlightOptions()
{
    include 'connectdb.php';
    $query = "SELECT AirlineCode, 3DigitNumber FROM Flight ORDER BY AirlineCode,3DigitNumber";
    $result = $connection->query($query);
    while ($row = $result->fetch()) {
        $number = $row['AirlineCode'] . $row['3DigitNumber'];
        makeOption($number);
    }
}

function showOptionsFromTable($table, $field)
{
    include 'connectdb.php';
    $query = "SELECT " . $field . " FROM " . $table . " ORDER BY " . $field;
    $result = $connection->query($query);
    while ($row = $result->fetch()) {
        makeOption($row[$field]);
    }
}

function showOptionsInRange($lo, $hi, $default, $format = null, $formatValueOnly = false)
{
    if ($formatValueOnly) {
        for ($i = $lo; $i < $default; $i++) {
            makeOptionDiffValue($i, sprintf($format, $i));
        }
        makeOptionSelectedDiffValue($default, sprintf($format, $default));
        for ($i = $default + 1; $i <= $hi; $i++) {
            makeOption($i, sprintf($format, $i));
        }
    } else if ($format === null) {
        for ($i = $lo; $i < $default; $i++) {
            makeOption($i);
        }
        makeOptionSelected($default);
        for ($i = $default + 1; $i <= $hi; $i++) {
            makeOption($i);
        }
    } else {
        for ($i = $lo; $i < $default; $i++) {
            makeOption(sprintf($format, $i));
        }
        makeOptionSelected(sprintf($format, $default));
        for ($i = $default + 1; $i <= $hi; $i++) {
            makeOption(sprintf($format, $i));
        }
    }
}

function showMonthOptions()
{
    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $currentM = date('n');
    $i = 0;
    while ($i < $currentM - 1) {
        echo '<option value="';
        echo sprintf('%02d', $i + 1);
        echo '">' . $months[$i] . '</option>';
        $i++;
    }
    echo '<option selected value="';
    echo sprintf('%02d', $currentM);
    echo '">' . $months[$currentM - 1] . '</option>';
    while ($i < 11) {
        $i++;
        echo '<option value="';
        echo sprintf('%02d', $i + 1);
        echo '">' . $months[$i] . '</option>';
    }
}

function showWeekOptions()
{
    $weekdays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $currentM = date('n');
    $current = date('N');
    $i = 0;
    while ($i < $current - 1) {
        echo '<option value="' . $weekdays[$i];
        echo '">' . $weekdays[$i] . '</option>';
        $i++;
    }
    echo '<option selected value="' . $weekdays[$current - 1];
    echo '">' . $weekdays[$current - 1] . '</option>';
    while ($i < 6) {
        $i++;
        echo '<option value="' . $weekdays[$i];
        echo '">' . $weekdays[$i] . '</option>';
    }
}

function showTimeOptions($unit)
{
    echo '<option selected value=""';
    echo '">' . $unit . '</option>';
    if ($unit == 'Hour')
        $hi = 24;
    else
        $hi = 60;
    for ($i = 0; $i < $hi; $i++) {
        makeOption(sprintf('%02d', $i));
    }
}

function makeOption($text)
{
    echo '<option value="';
    echo $text;
    echo '">' . $text . '</option>';
}

function makeOptionDiffValue($text, $value)
{
    echo '<option value="';
    echo $value;
    echo '">' . $text . '</option>';
}

function makeOptionSelected($text)
{
    echo '<option selected value="';
    echo $text;
    echo '">' . $text . '</option>';
}

function makeOptionSelectedDiffValue($text, $value)
{
    echo '<option selected value="';
    echo $value;
    echo '">' . $text . '</option>';
}
