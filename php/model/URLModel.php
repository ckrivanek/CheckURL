<?php

require_once(__DIR__ . "/Database.php");

class URLModel {
  public static function saveURL(URL $url) : bool {
    $sql = "INSERT INTO urlInfo (url, uuid, malicious, api) VALUES (?, ?, ?, ?)";
    Database::executeSql($sql, "ssss", array($url->url, $url->uuid, $url->malicious, $url->api));
    return ! isset(Database::$lastError);
  }
  public static function getURLs() : array {
    $sql = "SELECT * from urlInfo";
    return Database::executeSql($sql);
  }
  public static function getURL(int $urlId) {
      $sql = "SELECT * from urlInfo WHERE urlId = ?";
      return Database::executeSql($sql, "d", array($urlId));
  }
  public static function deleteURL(int $urlId) : bool {
      $sql = "DELETE FROM urlInfo WHERE urlId = ?";
      //print ($sql);
      Database::executeSql($sql, "d", array($urlId));
      return ! isset(Database::$lastError);
  }
  public static function updateURL(URL $url) : bool {
      /*$sql = "UPDATE urlInfo SET url = ?, domainName = ?, ip = ? WHERE urlId = ?";
      //print ($sql);
      Database::executeSql($sql, "sssd", array($url->url, $url->domainName, $url->ip, $url->urlId));
      */
      return ! isset(Database::$lastError);
  }
}