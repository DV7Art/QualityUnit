<?php
require_once 'db/Record.php';
require_once 'DataProcessor.php';
require_once 'service/impl/DataReaderImpl.php';
require_once 'service/impl/DataWriterImpl.php';

$strategies = [
    'serviceId' => new ServiceIdMatchStrategy(),
    'questionTypeId' => new QuestionTypeIdMatchStrategy(),
    'date' => new DateMatchStrategy()
];

$records = (new DataReaderImpl())->readData('input.txt');
$results = (new DataProcessor($strategies))->processRecords($records);
                    (new DataWriterImpl())->writeResults('output.txt', $results);