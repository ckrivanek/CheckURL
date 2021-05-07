<?php
require_once(__DIR__ . "/ControllerRequest.php");
require_once(__DIR__ . "/ControllerResponse.php");
require_once(__DIR__ . "/../model/URLModel.php");
require_once(__DIR__ . "/../model/types/URL.php");
require_once(__DIR__ . "/../model/types/URLScanSubmissionResponse.php");
require_once(__DIR__ . "/../model/types/URLScanSubmissionRequest.php");
require_once(__DIR__ . "/../model/types/URLScanResultsResponse.php");
require_once(__DIR__ . "/../model/ServiceClient.php");

class URLController {
  static public function post(ControllerRequest $request) : ControllerResponse {
    $url = new URL($request->data);
    $error = null;
    $status = false;
    if ($url->url != null) {
      $urlRequest = new URLScanSubmissionRequest($url->url,"public",null);
      $submission = ServiceClient::submitURL($urlRequest);
      $results = ServiceClient::retrieveResults($submission->api);
      $url->uuid = $submission->uuid;
      $url->api = $submission->api;
      $url->malicious = $results->malicious;
      $badValue = false;
      foreach ($url as $key => $value) {
            if (!isset($value)){
                $badValue = true;
            }
      }
      if (!$badValue){
          $status = URLModel::saveURL($url);
      }
      else {
          if (isset($submission->message)){
              $error = $submission->message;
          }
          else{
              $error = "There was an unknown error,\n possibly due to blacklist \n or rate limiting";
          }
      }
      //$error = array($urlRequest, $submission, $url);
    }
    if ($status) {
      return new ControllerResponse(array($url), 200, $error);
    }
    else {
      return new ControllerResponse(null, 400, $error);
    }
  }
  static public function get(ControllerRequest $request) : ControllerResponse {
      if ($request->id != null){
          $urls = URLModel::getURL((int)($request->id));
      }
      else{
          $urls = URLModel::getURLs();
      }
    $statusCode = 400;
    if ($urls !=null){
        $statusCode = 200;
    }
    return new ControllerResponse($urls, $statusCode);
  }

  static public function delete(ControllerRequest $request) : ControllerResponse {
      $status = false;
      if ($request->id != null){
          $status = URLModel::deleteURL((int)($request->id));
      }
      if ($status) {
          return new ControllerResponse(null, 200);
      }
      else {
          return new ControllerResponse(null, 400);
      }
  }

  static public function put(ControllerRequest  $request) : ControllerResponse {
      $url = new URL($request->data);
      $status = false;
      if ($url->urlId != null){
          $status = URLModel::updateURL($url);
      }
      if ($status) {
          return new ControllerResponse(null, 200);
      }
      else {
          return new ControllerResponse(null, 400);
      }
  }
}