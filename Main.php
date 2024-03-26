<?php
require_once 'db/Record.php';
require_once 'DataProcessor.php';
require_once 'service/impl/DataReaderImpl.php';
require_once 'service/impl/DataWriterImpl.php';

$records = (new DataReaderImpl())->readData('input.txt');
$results = (new DataProcessor())->processRecords($records);
                    (new DataWriterImpl())->writeResults('output.txt', $results);