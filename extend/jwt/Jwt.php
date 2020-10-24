<?php


namespace jwt;


class Jwt
{
    public static function CreateToken($data){
        $payload =[
            "iss" => config("jwt.iss"),
            "aud" => config("jwt.aud"),
            "iat" => time(),
            "nbf" => time(),
            "exp" => time()+24*3600,
            "data"=>$data,
        ];
        $jwt = \Firebase\JWT\JWT::encode($payload,config("jwt.key"));
        return $jwt;
    }

    public static function decodedToken($jwt){
        $decoded = \Firebase\JWT\JWT::decode($jwt,config("jwt.key"),array("HS256"));
        return (array)$decoded;
    }

}