<?php

class User extends DBModel
{
    public function login($Account,$Password){
        $LoginData = $this->getData("Account='".$Account."' AND Password='".$Password."' ");
        if($LoginData==""){
            return false;
        }else{
            return $LoginData;
        }
    }
}