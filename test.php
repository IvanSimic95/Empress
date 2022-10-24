<?php
$data = file_get_contents('php://input');
error_log("Data: $data");

$data = "sessid2=sessid20221013134630553&account_id=6490&action_type=neworder&product_codename=112&product_id=130&user_id=146150&storecheckedoutcarts_id=139038&aff_id=0&rr_createdate=2022-10-24+10%3A53%3A09&order_id_global=5AFZ6R9A&user_id=146150&name=Ivan+Simic&address=Jurja+Dalmatinca+23&city=Vinkovci&state=Vukovar-Srijem&country=Croatia&zip=32100&comments=&was_fulfilled=0&date_fulfillment=0000-00-00+00%3A00%3A00&total=FREE&payment_method=N%2FA&payment_cardtype=&payment_cardlast4=4859&was_canceled=0&date_canceled=0000-00-00+00%3A00%3A00&external_order_id=20599&aff_id=0&aff_commission=0.00&order_details=I+will+use+my+Psychic+Abilities+to+draw+your+Soulmate+within+12+hours+with+100%25+accuracy&shipping_method=0&is_test=1&total_collected=0.00&total_outstanding=0.00&is_free=0&customer_emailaddress=email%40isimic.com&customer_phone=0977117522&referrer_url=mc.sendgrid.com&referrer_sid=248503967%7C20599&referrer_self=www.buygoods.com%2Fsecure%2Fcheckout&ipaddress=62.4.34.122&shipping_cost=0.00&funnel_codename=&funnel_step=&flag_sms_sent=0&external_order_id2=&merchant_commission=0.00&external_order_id3=&lang=&external_order_id4=&external_order_id5=&cogs=0.00&coupon_discount=0.00&subid=248503967&subid2=20599&subid3=soulmate&subid4=&subid5=&accrual_total=0.00&buy_url=www.buygoods.com%2Fsecure%2Fcheckout%2Fassets%2Fcheckout_light%3F&salespage_url=https%3A%2F%2Fpsychic-empress.com%2F&flag_upsell=0&sale_saved_agent=0&sale_saved_date=0000-00-00+00%3A00%3A00&phone_helpgrid=&browser_user_agent=Mozilla%2F5.0+%28Windows+NT+10.0%3B+Win64%3B+x64%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F106.0.0.0+Safari%2F537.36&traffic_source=&vid1=&vid2=&vid3=&aff_name=&total_clean=56.24&amount_in_currency=FREE&token=a1499036f3ca222a12eb0978d8d8377f&token_ipn=5dfb7da07fbbf86d16c1a8662c172131&help_token=198267ef7062c89e719cedea3adf80f4&sid=248503967&sid2=20599&total_amount_charged=0.00&total_amount_charged_in_currency=0.00&currency=USD&charges_count=&billing_country=Croatia&billing_state=Vukovar-Srijem&billing_address=Jurja+Dalmatinca+23&billing_zip=32100&billing_city=Vinkovci&customer_firstname=Ivan&customer_lastname=Simic&order_id=290650&order_date=October+24%2C+2022&order_date_time=October+24%2C+2022%2C+10%3A53+AM&order_date_eu=24%2F10%2F2022&customer_name=Ivan+Simic&customer_country=Croatia&customer_zip=32100&customer_state=Vukovar-Srijem&customer_city=Vinkovci&account_id=6490&country_2letter=&shipping_cost_total=0.00&product_quantity=1&flag_frontend=1&product_id=130&product_codename=112&flag_autofulfill=1&payment_status=Completed&product_name=I+will+use+my+Psychic+Abilities+to+draw+your+Soulmate+within+12+hours+with+100%25+accuracy&product_price=44.99&sku=&product=Digital+eBook%3A+I+will+use+my+Psychic+Abilities+to+draw+your+Soulmate+within+12+hours+with+100%25+accuracy&taxes=11.25&payment_terms=%26%2336%3B44.99%3Cbr%3E%2B+%26%2336%3B11.25+Taxes&total_comma=FREE&product_url_encoded=https%253A%252F%252Fpsychic-artist.com%252Fdashboard&register_id=&RUNNING_OFFLINE=1";
$data = urldecode($data);
$newdata = explode("&", $data);


$cart = array();
foreach($newdata as $item) {

    $newitem = explode("=", $item);
    $first  = $newitem[0];
    

    if (array_key_exists(1,$newitem)){
        $second = $newitem[1];
    }else{
        $second = "";
    }

    $cart[$first] = $second;
}
print_r($cart);
?>