<?php
    class CurlHelper {
        public static function perform_http_request($method, $url, $data = false)
        {
            $curl = curl_init();
            switch ($method)
            {
                case "POST":
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: POST'));
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    break;
                case "PUT":
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PUT'));
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    break;
                case "DELETE":
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                    break;
                default:
                    if ($data)
                        $url = sprintf("%s?%s", $url, http_build_query($data));
            }
        
            // Optional Authentication:
            //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
        
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
            $result = curl_exec($curl);
            curl_close($curl);
            return $result;
        }
    }
?>
