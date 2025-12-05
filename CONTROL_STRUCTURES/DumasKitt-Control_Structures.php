<?php

$nutrition = [
    'fat'   => 16,
    'sugar' => 51,
    'salt'  => 6.3,
];

$list_flavors = array ("Cheese", "Pepperoni", "Creamy Spinach", "Margharita");

// IF-ELSE STATEMENT (1)

$name = "Kitt";

if ($name === "") {
    $greetings = "Please input your name, thanks!";
} else {
    $greetings = "Welcome to the Pizza Shop, $name!";
}


// SWITCH STATEMENT (2)

$order = 2;

switch ($order) {
    case 1: 
        $flavor = "Cheese";
        break;
    case 2:
        $flavor = "Pepperoni";
        break;
    case 3:
        $flavor = "Creamy Spinach";
        break;
    case 4:
        $flavor = "Margharita";
        break;
    default:
        $flavor = "no-answer"; 
}


?>

<!DOCTYPE html>
<!-- HEADER (3) -->
<p><?php include ("header.php") ?> </p>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "styles.css">
    <title>Control Structures</title>
</head>
<body>
    <h1>Papa Pizzeria</h1>

    <h2> <?= $greetings ?> </h2>

    <p> Please choose your order of choice based <br> on the number system. </p>

    <!-- FOR LOOP (4) -->

    <p>
    <?php 
    for ($i = 0; $i < count($list_flavors); $i++) {
        echo "\t[" . ($i + 1) . "] " . $list_flavors[$i] . "<br>";
    }
    ?>
    </p>

    <p> You selected [<?= $flavor ?>], estimated waiting time <br> is 20 minutes. Enjoy! </p> 

    <!-- FOREACH LOOP (5) --> 

    <h2> Nutrition Facts</h2>
    <p>
    <table>
        <tr>
            <th>Nutrition</th>
            <th>Info</th>
        </tr>
    <?php foreach ($nutrition as $label => $stats) { ?>
        <tr>
            <td><?= $label ?></td>
            <td><?= $stats ?></td>
        </tr>  
    <?php } ?>
    </table>
    </p>

    <h2>Nutrition (per 100g)</h2>
    <P>Fat: <?= $nutrition ['fat']; ?>% </p>
    <p>Sugar: <?= $nutrition ['sugar']; ?>% </p>
    <p>Salt: <?= $nutrition ['salt']; ?>% </p>

    <!-- FOOTER (6) -->
    <p><?php include ("footer.php") ?></p>
</body>
</html>