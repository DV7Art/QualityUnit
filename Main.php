<?php
require_once 'db/Record.php';
require_once 'DataReader.php';
require_once 'DataProcessor.php';
require_once 'DataWriter.php';

$records = (new DataReader())->readData('input.txt');
$results = (new DataProcessor())->processRecords($records);
                    (new DataWriter())->writeResults('output.txt', $results);