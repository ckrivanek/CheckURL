<?php

require_once(__DIR__ . "/Base.php");

class URL extends Base {
  public $urlId, $url, $uuid, $malicious, $api;

  public function __construct($sourceObject) {
    parent::__construct($sourceObject);
  }
}