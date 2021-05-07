<?php
class ControllerRequest {
  public $data, $id, $param;

  /**
   * ControllerRequest constructor.
   * @param $data
   * @param $id
   * @param $param
   */
  public function __construct($data = null, int $id = null, string $param = null) {
    $this->data = $data;
    $this->id = $id;
    $this->param = $param;
  }
}