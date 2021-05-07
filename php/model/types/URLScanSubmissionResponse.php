<?php


class URLScanSubmissionResponse extends Base {
    public $message,$uuid,$api,$url;

    public function __construct($sourceObject) {
        parent::__construct($sourceObject);
    }
}