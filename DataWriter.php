<?php
class DataWriter {
    public function writeResults($filename, $results) {
        $file = fopen($filename, "w");
        foreach ($results as $result) {
            fwrite($file, $result . "\n");
        }
        fclose($file);
    }
}
