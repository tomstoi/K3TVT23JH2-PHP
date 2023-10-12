<?php
$result = "";

if (
    !empty($_GET['number1']) &&
    !empty($_GET['number2']) &&
    !empty($_GET['operation'])
) {
    $number1 = filter_input(INPUT_GET, "number1", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $number2 = $_GET["number2"];
    $operation = $_GET["operation"];

    switch ($operation) {
        case 'sum':
            $result = sum($number1, $number2);
            break;

        case 'sub':
            $result = sub($number1, $number2);
            break;

        case 'multi':
            $result = multi($number1, $number2);
            break;

        case 'div':
            $result = div($number1, $number2);
            break;

        case 'pow':
            $result = power($number1, $number2);
            break;

        case 'root':
            $result = root($number1, $number2);
            break;

        default:
            $result = "";
            break;
    }
}

function sum($num1, $num2)
{
    return $num1 + $num2;
}

function sub($num1, $num2)
{
    return $num1 - $num2;
}

function multi($num1, $num2)
{
    return $num1 * $num2;
}

function div($num1, $num2)
{
    return $num1 / $num2;
}

function power($num1, $num2)
{
    return pow($num1, $num2);
}

function root($num1, $num2)
{
    return pow($num1, (1 / $num2));
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="laskin.php" method="get">
        <input type="text" name="number1" placeholder="Numero 1" />
        <input type="number" name="number2" placeholder="Numero 2" />
        <br />
        <select type="text" name="operation" id="operation">
            <option value="sum">Yhteenlasku</option>
            <option value="sub">Vähennyslasku</option>
            <option value="multi">Kertolasku</option>
            <option value="div">Jakolasku</option>
            <option value="pow">Potenssiin</option>
            <option value="root">Neliöjuuri</option>
        </select>
        <input type="submit" value="Laske" />
    </form>

    <?php echo "<p>Tulos: $result</p>" ?>
</body>

</html>