<?php
    function getToken(){   
        $user = "MTYzNzcxMzQzOQ==";
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

        $token = $result->accessTokenResponse->token;
    
        curl_close($curl);   
    
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //var_dump($result);
            //echo $token;      
        }        

        return $token;
    }  

    function getTracking($sin, $role){
        //echo $passTok;

        //echo $sin;

        //$i = 0;

        $url = "https://api.dhlecommerce.dhl.com/rest/v3/Tracking";
	    $method = "POST";
	    $headers = array(
	        "content-type: application/json"	        
	    );        
	    $body = '{"trackItemRequest": {"hdr": {"messageType": "TRACKITEM","accessToken": "';
        $body_2 = '","messageDateTime": "2021-04-14T14:32:14+08:00","messageVersion": "1.0","messageLanguage": "en"},"bd": {       "customerAccountId": null,     "soldToAccountId": null,"pickupAccountId": null,"ePODRequired": "N","trackingReferenceNumber": ["MYCGU';
        $body_3 = '"]}}}';
        
        //echo $body.getToken().$body_2.$sin.$body_3."<br><br>";     //test json string

	    $curl = curl_init();
	
	    curl_setopt_array($curl, array(
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_URL => $url,
	        CURLOPT_CUSTOMREQUEST => $method,
	        CURLOPT_HTTPHEADER => $headers,
			CURLOPT_POSTFIELDS => $body.getToken().$body_2.$sin.$body_3
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
                                    <th class="text-center" scope="row" colspan="2">Tracking ID</th>
                                    <td scope="row"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->trackingID; ?></td>
                                </tr>
                                <tr class="text-center">
                                    <th scope="row" colspan="2">Time</th>
                                    <th scope="row" colspan="2">Activity</th>
                                </tr><?php
                                for($i=0; $i<sizeof($result->trackItemResponse->bd->shipmentItems[0]->events); $i++){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                                                   
                                }?>                                
                            </tbody>                      
                        </table>
                    </div> 
                <?php
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
                                <th class="text-center" scope="row" colspan="2">Tracking ID</th>
                                <td scope="row"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->trackingID; ?></td>
                            </tr>
                            <tr class="text-center">
                                <th scope="row" colspan="2">Time</th>
                                <th scope="row" colspan="2">Activity</th>
                            </tr><?php                           
                            for($i=0; $i<sizeof($result->trackItemResponse->bd->shipmentItems[0]->events); $i++){
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Arrived at facility"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }                                
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Delivery Rescheduled [THE CUSTOMER HAS RESCHEDULED DUE TO NOT AT HOME]"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Delivery was attempted: closed premises [THE BUSINESS ADDRESS IS CLOSED]"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Delivery was refused"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Departed from facility"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Out for delivery"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Processed at delivery facility"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Return shipment being processed"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Return shipment was successfully delivered"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Shipment data received"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Sorted to delivery facility"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }
                                if($result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description == "Successfully delivered"){?>
                                    <tr>
                                        <td scope="row" colspan="2"><?php echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->dateTime; ?></td>
                                        <td scope="row" colspan="2"><?php  echo $result->trackItemResponse->bd->shipmentItems[0]->events[$i]->description;  ?></td>
                                    </tr><?php                              
                                }                                
                            }?> 
                        </tbody>
                    </table>
                </div><?php
            }
	    }
    }
?>