<?php 

function get_last_txid() {
    $last_txid = null;
    /* get last txid from your database
       for first run txid is null.
    */
    return $last_txid;
}

function update_info($datas) {
    /* update last txid on your database
       you can update the buy total amount for record
    */ 
    return true;
}

function get_pool_transaction($pool_address,$network) {    
    $result = [];
    $api_key = 'your_moralis_api_key';
    $pancakeswap_router_v2 = '10ed43c718714eb63d5aa57b78b54704e256024e';
    $url = 'https://deep-index.moralis.io/api/v2/'.$pool_address.'/logs?chain='.$network.'&topic1=0x000000000000000000000000'.$pancakeswap_router_v2;
    $curl = curl_init();    
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'X-API-Key: ' . $api_key,
    ));    
    $output = curl_exec($curl);
    curl_close($curl);
    $json = json_decode($output,true);     
    if(!empty($json)) {
        return $json['result'];        
    } else {
        return null;        
    }     
}

?>