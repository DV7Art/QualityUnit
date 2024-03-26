<?php
require_once 'service/DataWriter.php';
class DataWriterImpl implements DataWriterInterface {
    public function writeResults($destination, $results): void
    {
        $file = fopen($destination, "w");
        foreach ($results as $result) {
            fwrite($file, $result . "\n");
        }
        fclose($file);
    }
}
