<?php


class URLScanResultsResponse extends Base {
    public $verdicts, $overall, $malicious;
    // verdict -> overall ->malicious

    public function __construct($sourceObject) {
        //parent::__construct($sourceObject);
        // I know this needs to be cleaned up, but it works
        if (is_object($sourceObject) || is_array($sourceObject)) {
            foreach ($sourceObject as $key => $val ) {
                // Make sure that the object has the property before setting it
                if (property_exists($this, $key)) {
                    //set verdict
                    $this->$key = $val;
                    if (is_object($val) || is_array($val)) {
                        foreach ($val as $engines => $engine) {
                            // Make sure that the object has the property before setting it
                            if (property_exists($this, $engines)) {
                                //set overall
                                $this->$engines = $engine;
                                if (is_object($engines) || is_array($engines)) {
                                    foreach ($engine as $overall => $values) {
                                        if (property_exists($this, $overall)) {
                                            $this->$overall = $values;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($this->overall!=null) {
                if (is_object($this->overall) || is_array($this->overall)) {
                    foreach ($this->overall as $notables => $notable) {
                        if (property_exists($this, $notables)) {
                            $this->$notables = $notable;
                        }
                    }
                }
            }
        }
    }
}

