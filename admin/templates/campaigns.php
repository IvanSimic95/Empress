<?php


        $sql = "SELECT * FROM orders WHERE (order_status = 'completed' AND DATE(order_date) >= '$startDate' AND DATE(order_date) <= '$endDate') OR (order_status = 'processing' AND DATE(order_date) >= '$startDate' AND DATE(order_date) <= '$endDate') GROUP BY fbCampaign ORDER BY order_id DESC";
        $result = $conn->query($sql);
                if ($result->num_rows == 0) {
                         echo "no results";
                } else {


                           //Find campaign name from FB
                           $ch = curl_init();
                           curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v13.0/act_798761478055222/campaigns?fields=name&access_token='.$FBToken);
                           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                           $r = curl_exec($ch);
                           if (curl_errno($ch)) {echo 'Error:' . curl_error($ch);}
                           curl_close($ch);
                           $y = json_decode($r, true);


                           $totalsum = 0;
                           $totalcount = 0;
                           $totalspend = 0;
                           $totalprofit = 0;
                           $totalpersale = 0;
                           $totalcounter = 0;
                           

                  

                        while ($row = $result->fetch_assoc()) {
                        $id = $row["fbCampaign"];

                        
                                
                                if($id == "website" OR $id == "{{campaign.id}}" OR $id == "" OR $id == "0" OR $id == "domain_click"){
                                }else{

                                            //Find campaign name from FB
                        $crequest = "https://graph.facebook.com/v13.0/".$id."/insights?time_ranges=[{since:'".$startDate."',until:'".$endDate."'}]&access_token=".$FBToken;    
                          $ch = curl_init();

                          curl_setopt($ch, CURLOPT_URL, $crequest);
                          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                          $r = curl_exec($ch);
                          if (curl_errno($ch)) {echo 'Error:' . curl_error($ch);}
                          curl_close($ch);
                          $y2 = json_decode($r, true);
                          $y3 = $y2['data'];
                          if (array_key_exists("0",$y3)){
                          $s = $y2['data'][0];
                 
                        
                          if (array_key_exists("spend",$s)){
                                $spend = round($s['spend']);
                          }else{
                                $spend = 0;
                          }
                          
                        }else{
                                $spend = 0;
                        }

                                   
                                        $n = $y['data'];
                                        for ($i = 0; $i < count($n); $i++) {
                                               if ($n[$i]['id'] == $id){
                                                $key = $i;
                                               }
                                             
                                        }
                                        $name = $n[$key]['name'];

                                        //Find campaign Sales Count from DB
                                        $sql4 = "SELECT * FROM orders WHERE (order_status = 'completed' AND fbCampaign = '$id' AND DATE(order_date) >= '$startDate' AND DATE(order_date) <= '$endDate') OR (order_status = 'processing' AND fbCampaign = '$id' AND DATE(order_date) >= '$startDate' AND DATE(order_date) <= '$endDate')";
                                        $r4 = $conn->query($sql4);
                                        $countSales = $r4->num_rows;
                                  

                                        //Find campaign Sales from DB
                                        $sql3 = "SELECT SUM(order_price) AS sum_quantity FROM orders WHERE (order_status = 'completed' AND fbCampaign = '$id' AND DATE(order_date) >= '$startDate' AND DATE(order_date) <= '$endDate') OR (order_status = 'processing' AND fbCampaign = '$id' AND DATE(order_date) >= '$startDate' AND DATE(order_date) <= '$endDate')";
                                        $r3 = $conn->query($sql3);
                                        $fetch3 = $r3->fetch_assoc();
                                        $sum = $fetch3['sum_quantity'];
                                        if($sum > 0){
                                        $sum = $sum * 0.84;
                                        $sum = round($sum);
                                        }else{
                                        $sum = 0;
                                        }

                                        $dif = $sum - $spend;
                                        if($dif < 0){
                                                $difcolor = "red";
                            
                                                
                                        }else{
                                                $difcolor = "lightgreen";
                                    
                                                $dif = "+".$dif;
                                        }
                                        if($sum > 0 && $countSales > 0){
                                        $persale = round($sum / $countSales,2);
                                        }else{
                                        $persale = 0;
                                        }
                                        $totalsum += $sum;
                                        $totalcount += $countSales;
                                        $totalspend += $spend;
                                        $totalprofit += $dif;
                                        $totalpersale += $persale;
                                        $totalcounter += 1;

                                        echo '<tr id="' . $id . '">
                                        <td><a href="adsets.php?c='.$id.'&cname='.$name.'&sdate='.$startDate.'&edate='.$endDate.'">' . $id . '</a></td>
                                        <td>' . $name . '</td>
                                        <td>$' . $sum . ' (' .$countSales. ')</td>
                                        <td>$' . $spend. '</td>
                                        <td style="color:'.$difcolor.'">' .$dif. '</td>
                                        <td>$'.$persale.'</td>
                                        </tr>
                                        ';
                                }

                       
                        }
                        $finaltotal = round($totalpersale / $totalcounter,2);
                        echo '
                        <tfoot>
                        <tr>
                        <th>Total:</th>
                        <th></th>
                        <th><b>$'.$totalsum.'</b> (<b>'.$totalcount.'</b>)</th>
                        <th><b>$'.$totalspend.'</b></th>
                        <th><b>'.$totalprofit.'</b></th>
                        <th><b>$'.$finaltotal.'</b></th>
                        </tr>
                        </tfoot>';
                        $conn->close();
                }
?>