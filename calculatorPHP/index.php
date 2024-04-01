<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
    <input type="number" name="num01" placeholder="Number One">
    <select name="operator" >
        <option value="add">+</option>
        <option value="subtract">-</option>
        <option value="multiply">*</option>
        <option value="divide">/</option>
    </select>

    <input type="number" name="num02" placeholder="Number Two">
    <input type="submit" value="Calculate">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["num01"]) || isset($_POST["num02"]) || isset($_POST["operator"])):
                // Grab data from inputs
                $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
                $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
                // $num01 = htmlspecialchars($_POST["num01"]);
                // $num02 = htmlspecialchars($_POST["num02"]);
                $operator = htmlspecialchars($_POST["operator"]);
            endif;

            // Error handlers
            $errors = false;

            if (empty($num01) || empty($num02) || empty($operator)){
                echo "<p class = 'calc-error'>Fill in all fields</p>";
                $errors = true;
            }

            if (!is_numeric($num01) || !is_numeric($num02)){
                echo "<p class = 'calc-error'>Only write numbers</p>";
                $errors = true;
            }

            // calculate the numbers if no errors

            if (!$errors){
                $value = 0;
                switch ($operator){
                    case "add":
                        $value = $num01 + $num02;
                        break;
                    case "subtract":
                        $value = $num01 - $num02;
                        break;
                    case "multiply":
                        $value = $num01 * $num02;
                        break;
                    case "divide":
                        $value = $num01 / $num02;
                        break;
                    default:
                        echo "<p class = 'calc-error'>Someting went wrong</p>";
                        break;
                }

                echo "<p class='calc-result'>Resultat: " . $value . "</p>";    
            }

        }

    ?>
    
</body>
</html>


