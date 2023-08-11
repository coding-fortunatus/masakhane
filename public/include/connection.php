<?php
    $local = 'localhost';
    $root = 'root';
    $pass = '';
    $base = 'masakhane';

    $connection = mysqli_connect($local_, $root, $pass, $base);

    if(!$connection)
    {
        die("Something is wrong with me". mysqli_error($connection));
    }
    else
    {
        echo "<h1>I am connected</h1>";
    }

