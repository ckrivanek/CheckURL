<?php
class ControllerResponse {
  public $data, $status, $error;

  /**
   * ControllerResponse constructor.
   * @param $data
   * @param $status
   * @param $error
   */
  public function __construct($data = null, $status = 0, $error = null) {
    $this->data = $data;
    $this->status = $status;
    $this->error = $error;
  }
}