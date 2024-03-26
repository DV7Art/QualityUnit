<?php
class DataReader {
    public function readData($filename): array
    {
        $records = [];
        $file = fopen($filename, "r");
        fgets($file);
        while (($line = fgets($file)) !== false) {
            $parts = explode(" ", trim($line));
            $type = $parts[0] ?? null;
            $serviceId = $parts[1] ?? null;
            $questionTypeId = $parts[2] ?? null;
            $responseType = $parts[3] ?? null;
            $date = $parts[4] ?? null;
//            $dateTo = null;
//            if (isset($parts[4]) && str_contains($parts[4], '-')) {
//                list($dateFrom, $dateTo) = explode('-', $parts[4]);
//            }
            $time = $parts[5] ?? null;
            $records[] = new Record($type, $serviceId, $questionTypeId, $responseType, $date, $time);
        }
        fclose($file);
        return $records;
    }
}
