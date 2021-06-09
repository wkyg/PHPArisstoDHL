<?php
    function TestGetToken(){   
        $user = "MTYzNzcxMzQzOQ=";
        $password = "MTQ4MDg3O2304211619163487";
        $returnFormat = "json";
         
        $url = "https://api.dhlecommerce.dhl.com/rest/v1/OAuth/AccessToken?clientId=".$user.
        "&password=".$password."&returnFormat=".$returnFormat."";
        $method = "GET";
        $headers = array(
            "content-type: application/json"
        );
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);   
    
        $result = json_decode($response);

        //$token = $result->accessTokenResponse->token;
    
        curl_close($curl);   
    
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //var_dump($result);
            //echo $token;      
        }        

        //return $token;
    }  

    function TestgetTracking($trackingNo, $role){
        //echo $passTok;

        //echo $sin;

        //$i = 0;

        $url = "https://api.dhlecommerce.dhl.com/rest/v3/Tracking";
	    $method = "POST";
	    $headers = array(
	        "content-type: application/json"	        
	    );        
	    $body = '{"trackItemRequest": {"hdr": {"messageType": "TRACKITEM","accessToken": "';
        $body_2 = '","messageDateTime": "2021-04-14T14:32:14+08:00","messageVersion": "1.0","messageLanguage": "en"},"bd": {       "customerAccountId": null,     "soldToAccountId": null,"pickupAccountId": null,"ePODRequired": "N","trackingReferenceNumber": ["';
        $body_3 = '"]}}}';
        
        //echo $body.getToken().$body_2.$sin.$body_3."<br><br>";     //test json string

	    $curl = curl_init();
	
	    curl_setopt_array($curl, array(
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_URL => $url,
	        CURLOPT_CUSTOMREQUEST => $method,
	        CURLOPT_HTTPHEADER => $headers,
			CURLOPT_POSTFIELDS => $body.getToken().$body_2.$trackingNo.$body_3
	    ));
	
	    $response = curl_exec($curl);
	    $err = curl_error($curl);

        $result = json_decode($response);
	
	    curl_close($curl);
	
	    if ($err) {
	    	echo "cURL Error #:" . $err;
	    } else {
            //echo $result;
            //var_dump($result);
            /*
            if($role == "stf"){?>
                <div class="col col-lg-12">
                    <table class="table table-danger table-hover">
                        <thead class="text-center">
                            <tr>
                                <th scope="col" colspan="3">Shipment Status</th>                                    
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>                                    
                                <td scope="row" colspan="2">
                                    <?php 
                                        $day = strtotime($result->trackItemResponse->bd->shipmentItems[0]->events[0]->dateTime);
                                        echo "<b>".$result->trackItemResponse->bd->shipmentItems[0]->events[0]->description."</b>"; 
                                        echo " on "."<b>".date('D', $day).", ".date('d', $day)." ".date('M', $day)." ".date('Y', $day)."</b>";
                                        echo " by <b>DHL</b>"
                                    ?>
                                </td>                                    
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-danger table-hover">
                        <tbody class="text-center">
                            <tr>
                                <th class="text-center" scope="row" colspan="1">Reference No.</th>
                                <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->shipmentID ?></td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row" colspan="1">Tracking ID</th>
                                <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->trackingID; ?></td>
                            </tr>                            
                            <tr>
                                <th class="text-center" scope="row" colspan="1">Shipping Address</th>
                                <td scope="row" colspan="2"><?php echo "//Shipping address here//"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-danger table-hover">
                        <tbody class="text-center">
                            <tr class="text-center">
                                <th scope="row" >Time</th>
                                <th scope="row">Activity</th>   
                                <th scope="row">Location</th>
                            </tr><?php
                            for($i=0; $i<sizeof($result->trackItemResponse->bd->shipmentItems[0]->events); $i++){?>
                                <tr>
                                    <td scope="row">
                                        <?php 
                                            $date_2 = strtotime($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime);
                                            echo date('d', $date_2)." ".date('M', $date_2)."</br>";
                                            echo date('H:i', $date_2);
                                        ?>
                                    </td>
                                    <td scope="row"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    <td scope="row">
                                        <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                        ?>
                                    </td>
                                </tr><?php                                                   
                            }?>                                
                        </tbody>                      
                    </table>
                </div> <?php
            }else if($role == "cust"){?>
                <div class="col col-lg-12">
                    <table class="table table-danger table-hover">
                        <thead class="text-center">
                            <tr>
                                <th scope="col" colspan="3">Shipment Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>                                    
                                <td scope="row" colspan="2">
                                    <?php 
                                        $day = strtotime($result->trackItemResponse->bd->shipmentItems[0]->events[0]->dateTime);
                                        echo "<b>".$result->trackItemResponse->bd->shipmentItems[0]->events[0]->description."</b>"; 
                                        echo " on "."<b>".date('D', $day).", ".date('d', $day)." ".date('M', $day)." ".date('Y', $day)."</b>";
                                        echo " by <b>DHL</b>"
                                    ?>
                                </td>                                    
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-danger table-hover">
                        <tbody class="text-center">
                            <tr>
                                <th class="text-center" scope="row" colspan="1">Reference No.</th>
                                <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->shipmentID ?></td>
                            </tr>     
                            <tr>
                                <th class="text-center" scope="row" colspan="1">Tracking ID</th>
                                <td scope="row"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->trackingID; ?></td>
                            </tr>                            
                            <tr>
                                <th class="text-center" scope="row" colspan="1">Shipping Address</th>
                                <td scope="row" colspan="2"><?php echo "//Shipping address here//" ?></td>
                            </tr>                       
                        </tbody>
                    </table>
                    <table class="table table-danger table-hover">
                        <tbody class="text-center">
                            <tr class="text-center">
                                <th scope="row" colspan="1">Time</th>
                                <th scope="row" colspan="1">Activity</th>
                                <th scope="row" colspan="1">Location</th>
                            </tr><?php                           
                            for($i=0; $i<sizeof($result->trackItemResponse->bd->shipmentItems[0]->events); $i++){

                                $cust_date = strtotime($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime);

                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Arrived at facility"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }                                
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Delivery Rescheduled [THE CUSTOMER HAS RESCHEDULED DUE TO NOT AT HOME]"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Delivery was attempted: closed premises [THE BUSINESS ADDRESS IS CLOSED]"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Delivery was refused"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Departed from facility"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Out for Delivery"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Processed at delivery facility"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Return shipment being processed"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Return shipment was successfully delivered"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Shipment data received"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Sorted to delivery facility"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Successfully delivered"){?>
                                    <tr>
                                        <td scope="row" colspan="1">
                                            <?php 
                                                echo date('d', $cust_date)." ".date('M', $cust_date)."</br>";
                                                echo date('H:i', $cust_date); 
                                            ?>
                                        </td>
                                        <td scope="row" colspan="1"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                        <td scope="row">
                                            <?php  
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->city."</br>";
                                            echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->address->state;
                                            ?>
                                        </td>
                                    </tr><?php                              
                                }                                
                            }?>
                        </tbody>
                    </table>
                </div><?php
            }*/
	    }
    }
?>