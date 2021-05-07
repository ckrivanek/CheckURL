<?php


class URLScanSubmissionRequest{
    public $url, $visibility, $tags;

    /**
     * URLScanSubmissionRequest constructor.
     * @param $url
     * @param $visibility
     * @param $tags
     */
    public function __construct($url, $visibility, $tags)
    {
        $this->url = $url;
        $this->visibility = $visibility;
        $this->tags = $tags;
    }
}