<?php
include_once("info.php");
$pool_address = 'your_pool_address'; //like: '0x123456ee203952e97c581d709f0d3f7f7d952aa1'
$network = 'bsc';

$last_txid = get_last_txid();
$last_transaction_hash = '';
$total_buy_amount = $amount = 0;

$result = get_pool_transaction($pool_address,$network);
if($result != null && !empty($result['result'])) {
    if(count($result['result'])) {
        foreach($result['result'] as $tr) {
            $transaction_hash = $tr['transaction_hash'];            
            if($transaction_hash == $last_txid) {                
                break;
            } else {
                $topic2 = $tr['topic2'];                
                if($topic2 != null) {
                    $data = $tr['data'];
                    $data_len = strlen($data);                    
                    if($data_len === 258) {
                        $hex = substr($data,194);                                            
                        if($hex !== '0000000000000000000000000000000000000000000000000000000000000000' ) {    
                            $dec = hexdec($hex) / (10 ** 18);                            
                            if($dec > 0) {
                                $amount = $dec;
                                $last_transaction_hash = $tr['transaction_hash']; 
                                $total_buy_amount += $dec;
                            }
                        }                    
                    }                
                }
            }                 
        }
    }
}


if($total_buy_amount > 0) {    
    
    $datas = [];
    $datas['last_txid'] = $last_transaction_hash;
    $datas['last_buy_amount'] = $amount;
    update_info($datas);    
    unset($datas);

    /*
      Do something you want, such as sending alert or email or even a sale swap
    */
   
    
}
?>