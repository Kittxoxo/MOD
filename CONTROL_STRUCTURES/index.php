<?php
declare(strict_types = 1);

$all_pizzas = [
    "Cheese Pizza"          => ['price' => 450.0, 'stock' => 5],
    "Pepperoni Pizza"       => ['price' => 550.0, 'stock' => 2],
    "Margharita Pizza"      => ['price' => 550.0, 'stock' => 3],
    "Creamy Spinach Pizza"  => ['price' => 600.0, 'stock' => 5],
    "Hawaiian Pizza"        => ['price' => 550.0, 'stock' => 4],
    "Four Cheese Pizza"     => ['price' => 600.0, 'stock' => 6],
    "Dessert Pizza"         => ['price' => 600.0, 'stock' => 7],
    "Overload Pizza"        => ['price' => 750.0, 'stock' => 2],
];

$nutrition = [
    'fat'   => 16,
    'sugar' => 51,
    'salt'  => 6.3,
];

$list_flavors = array ("Cheese", "Pepperoni", "Creamy Spinach", "Margharita", "Hawaiian", "Four Cheese", "Dessert", "Overload");

// IF-ELSE STATEMENT (1)

$name = "Kitt";

if ($name === "") {
    $greetings = "Please input your name, thanks!";
} else {
    $greetings = "Welcome to the Pizza Shop, $name!";
}


// SWITCH STATEMENT (2)

$order = 5; //PROMO BUNDLE ORDER

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
    case 5:
        $flavor = "Cheese, Pepperoni, Creamy Spinach, Margharita";
        break;
    default:
        $flavor = "no-answer"; 
}

// FUNCTIONS

function write_logo(){
    echo '<img src="img/logo.png" alt="Logo" style="height:150px; width:150px;">';
}

function write_copyright_notice(){
    $year = date('Y');
    echo '&copy; ' . $year;
}

$tax = 20;

function calculate_total($price, $quantity){
    $cost = $price * $quantity;
    $tax = $cost * (20 / 100);
    $total = $cost + $tax;
    return $total;
}

$tax_rate = 0.2;

function calculate_running_total(float $price, $quantity){
    global $tax_rate;
    static $running_total = 0;
    $total = $price * $quantity;
    $tax = $total * $tax_rate;
    $running_total = $running_total + $total + $tax;
    return $running_total;
}

//FUNCTIONS WITH MULTIPLE VALUES

$ph_price = 12240;
$rates = [
    'uk' => 0.013,
    'eu' => 0.015,
    'jp' => 2.63,
    'us' => 0.017,
];

function calculate_prices($usd, $exchange_rates){
    $prices = [
        'pound' => $usd * $exchange_rates['uk'],
        'euro'  => $usd * $exchange_rates['eu'],
        'yen'   => $usd * $exchange_rates['jp'],
        'dollars' => $usd * $exchange_rates['us'],
    ];
    return $prices;
}

$global_prices = calculate_prices($ph_price, $rates);

//TYPE DECLARATIONS

$price_type = 540;
$quantity_type = 3;

function calculate_total_type(float $price_type, int $quantity_type) : float{
    return $price_type * $quantity_type;
}

$total_type = calculate_total_type($price_type, $quantity_type);

//MULTIPLE RETURN STATEMENT

$stock = 10;

function get_stock_message($stock){
    if ($stock >= 10){
        return "Good availability";
    }
    if ($stock > 0 && $stock < 10){
        return "Low stock. Buy now while there are still fresh pizzas!";
    }
    return "Out of stock.";
}

function get_reorder_message(int $stock): string {
    return $stock < 10 ? "Yes" : "No";
}

//DEFAULT VALUES

function calculate_cost($cost, $quantity, $discount = 0, $tax = 20){
    $cost = $cost * $quantity;
    $tax = $cost * ($tax / 100);
    return ($cost + $tax) - $discount;
}

function get_total_value(float $price, int $quantity): float {
    return $price * $quantity;
}

function get_tax_due(float $price, int $quantity, int $tax_rate = 0): float {
    return get_total_value($price, $quantity) * ($tax_rate / 100);
}

?>

<!DOCTYPE html>
<!-- HEADER (3) -->
<p><?php include ("header.php") ?> </p>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/styles.css">
    <title>Control Structures</title>
</head>
<body>
    <header>
        <h1><?= write_logo() ?>Papa Pizzeria</h1>
    </header>

    <h2> <?= $greetings ?> </h2>

    <p> Please choose your order of choice based <br> on the number system. </p>

    <!-- FOR LOOP (4) -->
    <!-- LIST OF FLAVORS -->

    <p>
    <?php 
    foreach ($list_flavors as $i => $flavor_name): ?>
        [<?= $i + 1 ?>] <?= $flavor_name ?><br>
    <?php endforeach; 
    ?>
    </p>

    <!-- NUTRITION FACTS -->

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
            <td><?= $stats ?>g</td>
        </tr>  
    <?php } ?>
    </table>
    </p>

    <!-- PRODUCT TABLE -->
    <h2>Product Inventory</h2>
    <p> Inventory: <?= get_stock_message($stock) ?> </p>
    <table>
        <tr>
            <th>Product</th>
            <th>Stock</th>
            <th>Restock?</th>
            <th>Total Value (₱)</th>
            <th>Tax Due (₱)</th>
        </tr>
        <?php foreach ($all_pizzas as $name => $data): ?>
            <tr>
                <td><?= $name ?></td>
                <td><?= $data['stock'] ?></td>
                <td><?= get_reorder_message($data['stock']) ?></td>
                <td>₱<?= number_format(get_total_value($data['price'], $data['stock']), 2) ?></td>
                <td>₱<?= number_format(get_tax_due($data['price'], $data['stock'], $tax), 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p> =========== Prices =========== </p>

    <p>Cheese Pizza ₱<?= calculate_cost(cost: 450, quantity: 1, discount: 0, tax: 20) ?></p>
    <p>Pepperoni Pizza ₱<?= calculate_cost(cost: 550, quantity: 1, discount: 0, tax: 20) ?></p>
    <p>Hawaiian Pizza ₱<?= calculate_cost(550, 1, 0, 20) ?></p>
    <p>Margharita Pizza ₱<?= calculate_cost(550, 1, 0, 20) ?></p>
    <p>Creamy Spinach Pizza ₱<?= calculate_cost(600, 1, 0, 20) ?></p>
    <p>Four Cheese Pizza ₱<?= calculate_cost(600, 1, 0, 20) ?></p>
    <p>Dessert Pizza ₱<?= calculate_cost(600, 1, 0, 20) ?></p>
    <p>Overload Pizza ₱<?= calculate_cost(750, 1, 0, 20) ?></p>

    <p> ============================== </p>

    <p> You selected [<?= $flavor ?>], estimated waiting time <br> is 35 minutes. Enjoy! </p> 

    <p>====== Receipt of Total ======</p>
    
    <table>
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Running Total</th>
        </tr>
        <tr>
            <td>Cheese:</td>
            <td>₱540</td>
            <td>5</td>
            <td>₱<?= calculate_running_total(660,5)?></td>
        </tr>
        <tr>
            <td>Pepperoni:</td>
            <td>₱660</td>
            <td>2</td>
            <td>₱<?= calculate_running_total(660,2)?></td>
        </tr>
        <tr>
            <td>Creamy Spinach:</td>
            <td>₱720</td>
            <td>5</td>
            <td>₱<?= calculate_running_total(720,5)?></td>
        </tr>
        <tr>
            <td>Margharita:</td>
            <td>₱660</td>
            <td>3</td>
            <td>₱<?= calculate_running_total(660,3)?></td>
        </tr>
    <p>Prices include tax at: <?= $tax ?>%</p>
    </table>

    <h2>In a different currency?</h2>
    <p>₱<?= $ph_price ?></p>
    <p>
        (UK &pound; <?= $global_prices['pound'] ?> |
        EU &euro; <?= $global_prices['euro']   ?> |
        JP &yen; <?= $global_prices['yen'] ?> |
        US &dollar; <?= $global_prices['dollars'] ?> )
    </p>

    <h1>History</h1>
    <h2>You bought three cheese pizzas.</h2>
    <p>Your total was ₱<?= $total_type ?></p>

    <!-- FOOTER (6) -->
    <p><?php include ("footer.php") ?></p>
</body>
</html>
