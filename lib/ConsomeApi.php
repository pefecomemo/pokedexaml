<?php

class ConsomeAPI {

    private $url;

    function __construct($url){
        $this->url = $url;
    }

    function consomeAPIcUrl($endpoint, $requestMode, $body=null, $query=null) {
        # EXECEUTE A CHAMADA!
        # Criando o recurso do cUrl
        $ch = curl_init();
    
        # Definindo a URL
        if($query == null){
            curl_setopt($ch, CURLOPT_URL, $this->url.$endpoint);
        } else {
            curl_setopt($ch, CURLOPT_URL, $this->url.$endpoint.$query);
        }
        # Return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
        # Definindo o tipo de requisição
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $requestMode);
    
        if($body !== null) {
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $body);
        }
    
        # $output contains the output string
        $output = curl_exec($ch);
    
        # close curl resource to free up system resources
        curl_close($ch);
    
        return $output;
    }

}

