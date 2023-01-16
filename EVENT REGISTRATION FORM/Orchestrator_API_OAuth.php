<?php

class OAuth{

   private $endpoint, $client_id, $client_secret, $scope;

   public function __construct(
    $endpoint = "https://cloud.uipath.com/identity_/connect/token",
    $client_id = NULL,
    $client_secret = NULL,
    $scope = NULL){

        $this->endpoint = $endpoint;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->scope = $scope;

   }

    public function set_endpoint($endpoint){
        $this->endpoint = $endpoint;
    }

    public function set_client_id($client_id){
        $this->client_id = $client_id;
    }

    public function set_client_secret($client_secret){
        $this->client_secret = $client_secret;
    }

    public function set_scope($scope){
        $this->scope = $scope;
    }

    public function get_OAuth(){

        $payload = http_build_query([    
            'grant_type' => 'client_credentials',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'scope' => $this->scope
        ]);

        $ch = curl_init();

        curl_setopt_array(
            $ch,
            [
                CURLOPT_URL => $this->endpoint, //set the end point url.
                CURLOPT_POST => true,     //set the method to be post.
                CURLOPT_POSTFIELDS => $payload, //set request body data
                CURLOPT_RETURNTRANSFER => true, //store the result in a variable insted of showing it directly to the browser.
                CURLOPT_HTTPHEADER =>[  //set request header data.
                    'Authorization: Bearer Token',
                    'Content-Type: application/x-www-form-urlencoded'
                ]
            ]
        );

        //Run cURL (Execute http request)
        $result = curl_exec($ch);

        //Close cURL resource
        curl_close($ch);

        $decoded_result = json_decode($result);
        $OAuth = $decoded_result->access_token;
        return $OAuth;
    }
}
?>