<?php
class Record  {
    public $type;
    public $serviceId;
    public $questionTypeId;
    public $responseType;
    public $date;
    public $time;

    public function __construct($type, $serviceId, $questionTypeId, $responseType, $date, $time) {
        $this->type = $type;
        $this->serviceId = $serviceId;
        $this->questionTypeId = $questionTypeId;
        $this->responseType = $responseType;
        $this->date = $date;
        $this->time = $time;
    }
}