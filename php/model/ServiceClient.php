<?php

require_once(__DIR__ . "/../lib/Config.php");
require_once(__DIR__ . "/types/URLScanSubmissionResponse.php");
require_once(__DIR__ . "/types/URLScanResultsResponse.php");

class ServiceClient
{
    static public function submitURL($conRequest): URLScanSubmissionResponse{
        $apikey = Config::getConfigValue("urlscan", "urlscanApi");
        $serviceEndpoint = Config::getConfigValue("urlscan", "submissionEndpoint");
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode($conRequest),
                'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n" .
                    "API-Key: " . $apikey . "\r\n"
            )
        );

        $context  = stream_context_create( $options );
        $result = file_get_contents( $serviceEndpoint, false, $context );
        $submissionResponse = json_decode( $result );
        $response = new URLScanSubmissionResponse($submissionResponse);
        return $response;
    }

    static public function retrieveResults($api) {
        sleep(32);
        $result = file_get_contents($api);
        $submissionResponse = json_decode( $result );
        $response = new URLScanResultsResponse($submissionResponse);
        return $response;
    }
}