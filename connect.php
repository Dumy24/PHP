<?php

function connect(
    $host = 'localhost',
    $user = 'root',
    $pass = '',
    $dbname = 'proiect1',
) {
    global $link;
    $link = mysqli_connect($host, $user, $pass, $dbname) or die('Database error');
}


// function submitCar($anFabricatie, $marca, $km, $putere)
// {
//     if ($marca == "" || $anFabricatie == "" || $km == "" || $putere == "") {
//         echo "<h3> span style='color:red'> Toate campurile sunt obligatorii!</span> </h3>";
//         return false;
//     }
//     $ins = "INSERT INTO cars (an_fabricatie, marca, km, putere) VALUES('$anFabricatie','$marca','$km','$putere')";
//     $link = mysqli_connect("localhost", "root", "", "proiect1");
//     mysqli_query($link, $ins);
//     return true;
// }
