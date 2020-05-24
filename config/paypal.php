<?php
return [

    'client_id' =>'AWoKoY6QgMDpMN5ZYHAnTDkHL9_lY1Iojuf-JMr7JoOAQpf-SeGliLXBxqZSDvQ1jyYfOmD2Ar6HUZpz',
    'secret' => 'EGbatS8qh2eQCOFvNIV9SsHBuLM1pLoqqPzTpUVJ157Dl6ZymjoVnL5EYvzdxIn3J8Swj4vLU80BtVQA',
    /**
    * SDK configuration 
    */
    'settings' => [
        /**
        * Available option 'sandbox' or 'live'
        */
        'mode' => 'sandbox',
        /**
        * Specify the max request time in seconds
        */
        'http.ConnectionTimeOut' => 1000,
        /**
        * Whether want to log to a file
        */
        'log.LogEnabled' => true,
        /**
        * Specify the file that want to write on
        */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
        * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
        *
        * Logging is most verbose in the 'FINE' level and decreases as you
        * proceed towards ERROR
        */
        'log.LogLevel' => 'FINE'
        
        
        ] 
    ];