<?php 
function getTransactionFiles($dirPath) {
    $files = [];

    foreach(scandir($dirPath) as $file) {
        if(is_dir($file)) {
            continue;
        }
        
        $files[] = $dirPath.$file;
        
    }
    return $files;
}

function getTransactions($file) {
    if(!file_exists($file)) {
        echo "El archivo no existe";
    }

    $transactionsArray = [];

    $transactions = fopen($file,"r");
    fgetcsv($transactions);
    while(($transaction = fgetcsv($transactions)) !== false) {
        [$date,$check,$description,$amount] = $transaction;
        $transactionData = [
            "date" => $date,
            "check" => $check,
            "description" => $description,
            "amount" => $amount
        ];
        $transactionsArray[] = $transactionData;
    }

    return $transactionsArray;
}

function processTotalAmount($array) {
    $total = 0;
    foreach($array as $transaction) {
        $amount = preg_replace("/[$,]/","",$transaction["amount"]);
        $total = $total+$amount;
    }
    $total = "$".$total;

    return $total;
}



?>