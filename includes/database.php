<?php

/**
 * Create a database connection
 *
 * @return object Connection to a MySQL server
 **/

function getDB()
{

    $db_host = "localhost";
    $db_name = 'cms';
    $db_user = 'admin';
    $db_pass = 'DTYdYj1xAUGisu3U';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    return $conn;
}
