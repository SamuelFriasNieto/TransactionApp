<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../views/css/transactionForm.css">
</head>
<body>
    <?php 
        foreach($errores as $error) {
            echo $error;
            echo "</br>";
        }
    ?>
    <main>
        <form action="" method="POST">
            <h1>Make a Transaction</h1>
            <p>Transaction Date</p>
            <input type="text" name="date" placeholder="mm/dd/yyyy">
            <p>Transaction Check</p>
            <input type="number" name="check">
            <p>Transaction Description</p>
            <input type="text" name="description">
            <p>Transaction Amount</p>
            <input type="text" name="amount">
            <br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </main>
    
</body>
</html>