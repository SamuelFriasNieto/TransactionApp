<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../views/css/transactions.css">
</head>
<body>
    <table >
        <tr>
            <th>DATE</th>
            <th>CHECK #</th>
            <th>DESCRIPTION</th>
            <th>AMOUNT</th>
        </tr>
        <?php 
            if(!empty($transactionArray)) {
                foreach($transactionArray as $transaction) {
                    $date = $transaction["date"];
                    $check = $transaction["check"];
                    $description = $transaction["description"];
                    $amount = $transaction["amount"];
                    $color = preg_match("/-/",$amount) ? "red" : "green";
                    echo "<tr>
                        <td>$date</td>
                        <td>$check</td>
                        <td>$description</td>
                        <td style='color:$color'>$amount</td>
                    ";
                }
                echo "<tr>
                <th colspan='4' style='color:$color'>$total</th>";
            }
        ?>
        
    </table>
</body>
</html>