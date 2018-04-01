﻿<?php
    class JWT {
        const SECRET_KEY = 'letmetellyouasecret';

        public static function generateJWT($payload){
            // base64 encodes the header json
            $header = array('typ' => 'JWT', 'alg' => 'HS256');
            $header = json_encode($header);
            $encoded_header = base64_encode($header);

            // base64 encodes the payload json
            $payload = json_encode($payload);
            $encoded_payload = base64_encode($payload);

            // base64 strings are concatenated to one that looks like this
            $header_payload = $encoded_header . '.' . $encoded_payload;

            //Setting the secret key
            $secret_key = self::SECRET_KEY;

            // Creating the signature, a hash with the sha256 algorithm and the secret key. The signature is also base64 encoded.
            $signature = base64_encode(hash_hmac('sha256', $header_payload, $secret_key, true));

            // Creating the JWT token by concatenating the signature with the header and payload, that looks like this:
            $jwt_token = $header_payload . '.' . $signature;

            //listing the resulted  JWT
            return $jwt_token;
        }

        public static function verifyJWT($receivedJWT){
            //Setting the secret key
            $secret_key = self::SECRET_KEY;

            // Split a string by '.' 
            $jwt_values = explode('.', $receivedJWT);

            // extracting the signature from the original JWT 
            $received_signature = $jwt_values[2];

            // concatenating the first two arguments of the $jwt_values array, representing the header and the payload
            $receivedHeaderAndPayload = $jwt_values[0] . '.' . $jwt_values[1];

            // creating the Base 64 encoded new signature generated by applying the HMAC method to the concatenated header and payload values
            $resultedsignature = base64_encode(hash_hmac('sha256', $receivedHeaderAndPayload, $secret_key, true));

            // checking if the created signature is equal to the received signature
            if($resultedsignature == $received_signature) {

                // If everything worked fine, if the signature is ok and the payload was not modified you should get a success message
                return true;
            }
            return false;
        }

        public static function getPayload($receivedJWT){
            $jwt_values = explode('.', $receivedJWT);
            $receivedPayload = $jwt_values[1];
            return $receivedPayload;
        }
    }
?> 