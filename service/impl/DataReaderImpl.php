<?php
require_once 'service/DataReader.php';
class DataReaderImpl implements DataReaderInterface {
    public function readData($source): array
    {
        $records = [];
        $file = fopen($source, "r");
        fgets($file);
        while (($line = fgets($file)) !== false) {
            $parts = explode(" ", trim($line));
            $type = $parts[0] ?? null;
            $serviceId = $parts[1] ?? null;
            $questionTypeId = $parts[2] ?? null;
            $responseType = $parts[3] ?? null;
            $date = $parts[4] ?? null;
            $time = $parts[5] ?? null;
            $records[] = new Record($type, $serviceId, $questionTypeId, $responseType, $date, $time);
        }
        fclose($file);
        return $records;
    }
}
