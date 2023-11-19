<?php 

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH',$root."app".DIRECTORY_SEPARATOR);
define('FILES_PATH',$root."transaction_files".DIRECTORY_SEPARATOR);
define('VIEWS_PATH',$root."views".DIRECTORY_SEPARATOR);
define('CSS_PATH',$root."views/css".DIRECTORY_SEPARATOR);

require(APP_PATH."app.php");
require(APP_PATH."helpers.php");

$files = getTransactionFiles(FILES_PATH);

$transactionArray= [];



$errores = [];

if(isset($_REQUEST["submit"])) {
    $date = recoge("date");
    $check = recoge("check");
    $description = recoge("description");
    $amount = recoge("amount");

    cTexto($description,"description",$errores,50);
    cNum($check,"check",$errores);
    cNum($amount,"amount",$errores);
    cFecha($date,"date",$errores);

    if(empty($errores)) {
        if(file_exists(FILES_PATH."transactions.csv")) {
            if($file = fopen(FILES_PATH."transactions.csv","a+")) {
                fwrite($file,$date.",".$check.",".$description.",".'"$'."$amount".'"'.PHP_EOL);
                foreach($files as $file) {
                    $transactionArray = array_merge($transactionArray,getTransactions($file));
                }
                $total = processTotalAmount($transactionArray);
                require(VIEWS_PATH."transactions.php");
            } else {
                $errores["file"] = "Error al abrir el archivo de transacciones";
            }
        } else {
            $errores["file"] = "El archivo de transacciones no existe";
            require(VIEWS_PATH."transactionForm.php");
        }
    } else {
        require(VIEWS_PATH."transactionForm.php");
    }
} else {
    require(VIEWS_PATH."transactionForm.php");
}




?>