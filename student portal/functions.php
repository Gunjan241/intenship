<?php

function displayStudent($name, $course)
{
    $id = rand(1000, 9999);

    echo "
    <div class='card'>
        <h3>" . strtoupper($name) . "</h3>
        <p><b>Student ID:</b> $id</p>
        <p><b>Course:</b> " . ucfirst($course) . "</p>
        <p><b>Name Length:</b> " . strlen($name) . "</p>
    </div>
    ";
}

?>