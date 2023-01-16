<?php
/* To learn how to build this request 
please chheck: https://docs.uipath.com/orchestrator/reference/building-api-requests 
at POST Requests section.
also look at this: https://postman.uipath.rocks/#58fadde2-0a93-4074-8955-b2639f77795b 
*/
class Queue_item{
    private $endpoint, $access_token,$queue_name, $user_name, $email, $phone, $address,$UnitId;

    public function _construct(
        $endpoint = "https://cloud.uipath.com/persopdnvubp/AbuSennaOrg/orchestrator_/odata/Queues/UiPathODataSvc.AddQueueItem",
        $UnitId = NULL,
        $access_token = NULL,
        $queue_name = NULL,
        $user_name = NULL,
        $email = NULL,
        $phone = NULL,
        $address = NULL
    ){
        $this->endpoint = $endpoint;
        $this->UnitId = $UnitId;
        $this->access_token = $access_token;
        $this->queue_name = $queue_name;
        $this->user_name = $user_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
    }

    public function set_endpoint($endpoint){
        $this->endpoint = $endpoint;
    }

    public function set_UnitId($UnitId){
        $this->UnitId = $UnitId;
    }

    public function set_access_token($access_token){
        $this->access_token = $access_token;
    }

    public function set_Queue_name($queue_name){
        $this->queue_name = $queue_name;
    }

    public function set_user_name($user_name){
        $this->user_name = $user_name;
    }

    public function set_email($email){
        $this->email = $email;
    }

    public function set_phone($phone){
        $this->phone = $phone;
    }

    public function set_address($address){
        $this->address = $address;
    }


    public function add_queue_item(){

        $ch = curl_init();

        curl_setopt_array(
            $ch,
            [
                CURLOPT_URL => $this->endpoint, //set the end point url.
                CURLOPT_POST => true,     //set the method to be post.
                CURLOPT_POSTFIELDS => '{
                    "itemData": {
                        "Priority": "Normal",
                        "Name": "'.$this->queue_name.'",
                        "SpecificContent": {
                            "Name@odata.type": "#String",
                            "Name": "'.$this->user_name.'",
                            "email@odata.type": "#String",
                            "email": "'.$this->email.'",
                            "phone@odata.type": "#String",
                            "phone": "'.$this->phone.'",
                            "address@odata.type": "#String",
                            "address": "'.$this->address.'"
                        },
                        "Reference": "User details"
                    }
                }',
                CURLOPT_RETURNTRANSFER => true, //store the result in a variable insted of showing it directly to the browser.
                CURLOPT_HTTPHEADER =>[  //set request header data.
                    'X-UIPATH-OrganizationUnitId: '.$this->UnitId,
                    'accept: application/json',
                    'authorization: Bearer '.$this->access_token,
                    'Content-Type: application/json;odata.metadata=minimal;odata.streaming=true'
                ]
            ]
        );

        //Run cURL (Execute http request)
        $result = curl_exec($ch);

        //Close cURL resource
        curl_close($ch);
        return $result;

    }
}
?>