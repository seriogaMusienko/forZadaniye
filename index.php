<?php
    if (isset($_POST['resultP']))
    {
        $toVal = "USD".$_POST['optVal'];//Выбраная валютная пара
        $usdCol = $_POST['usdCol'];//количество долларов
        if($_POST['optVal'] != null){
                
            //API
            $info = file_get_contents('https://currate.ru/api/?get=rates&pairs='.$toVal.'&key=16f2ecbe8827c62953aaea8f9ae962f3');
            $info = json_decode($info, true);


            $oneMoney = $info[data][$toVal];//цена одного доллара на вібраную валюту

            $result = (double)$oneMoney*(double)$usdCol;
            
            $text = '<p id="resultP">'.$usdCol." долларов = ".$result." ".$_POST['optVal'].'</p>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обменник</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form method="POST" name="someForm">
        <input type="number" id="usdInput" placeholder="кол. долларов" name="usdCol">
        <button id="convertBtn" name="resultP">Convert</button>
        <select name="optVal">
            <option value="JPY">Японская иена</option>
            <option value="RUB">Рубль</option>
            <option value="GBP">Фунт стерлингов</option>
            <option value="BTC">Bitcoin</option>
        </select>
        <?php
            echo $text;
        ?>
    </form>
</body>
</html>