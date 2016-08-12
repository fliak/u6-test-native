<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 10.8.16
 * Time: 22.55
 */

namespace App\Http;


class JsonResponse extends Response
{

    public function __construct($body, $statusCode = 200, array $headers = [])
    {
        $body = json_encode($body);
        
        $headers['Content-Type'] = 'application/json';
        
        parent::__construct($body, $statusCode, $headers);
    }

}