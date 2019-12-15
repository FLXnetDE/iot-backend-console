<?php
    class MqttOverHttp {

        // Check availability of HTTP server
        public static function checkAvailability() {
            $ini = parse_ini_file('app.ini');
            $request = curl_init('http://'.$ini['broker_host'].':'.$ini['broker_http_port'].'/');
            curl_setopt($request, CURLOPT_HEADER, 0);
            curl_setopt($request, CURLOPT_POST, 0);
            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($request);
            curl_close($request);
            return $response;
        }

        // Publish a message via HTTP transport to moquette broker
        public static function publish($topic, $payload) {
            $ini = parse_ini_file('app.ini');
            $request = curl_init('http://'.$ini['broker_host'].':'.$ini['broker_http_port'].'/mqttOverHttp');
            curl_setopt($request, CURLOPT_HEADER, 0);
            curl_setopt($request, CURLOPT_POST, 1);
            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($request, CURLOPT_POSTFIELDS, 'topic='.$topic.'&payload='.$payload);
            $response = curl_exec($request);
            curl_close($request);
            return $response;
        }

    }
?>