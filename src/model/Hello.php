<?php

namespace App\Api\model;
use App\Api;

class Hello{
    
    public function world(){

        return array(
            's' => true,
            'd' => array(
                'text' => 'Hello World'
            ),
            'm' => ''
        );

    }
}