<?php
require 'strategy/impl/ServiceIdMatchStrategy.php';
require 'strategy/impl/QuestionTypeIdMatchStrategy.php';
require 'strategy/impl/DateMatchStrategy.php';
const MAX_SERVICES = 10;
const MAX_VARIATIONS = 3;
const MAX_QUESTIONS_TYPE = 10;
const MAX_CATEGORIES = 20;
const MAX_SUB_CATEGORIES = 5;
const QUERY = "D";
class DataProcessor {
    private array $strategies;
    public function __construct() {
        $this->strategies = [
            'serviceId' => new ServiceIdMatchStrategy(),
            'questionTypeId' => new QuestionTypeIdMatchStrategy(),
            'date' => new DateMatchStrategy()
        ];
    }
    public function processRecords($records): array
    {
        $queries = [];
        $timelines = [];
        foreach ($records as $record) {
            if ($record->type == QUERY) {
                $queries[] = $record;
            } else {
                $timelines[] = $record;
            }
        }
        $results = [];
        foreach ($queries as $query) {
            $totalTime = 0;
            $count = 0;
            foreach ($timelines as $timeline) {
                if ($this->matchRecord($query, $timeline)) {
                    if ($timeline->type != QUERY) {
                        $totalTime += $timeline->time;
                        $count++;
                    }
                }
            }
            $results[] = $count > 0 ? round($totalTime / $count,2) : '-';
        }
        return $results;
    }

    private function matchRecord($query, $timeline): bool
    {
        // Check service_id
        if (str_contains($query->serviceId, ".")) {
            list($serviceId, $serviceVar) = explode(".", $query->serviceId);
            if ($serviceId > MAX_SERVICES || $serviceVar > MAX_VARIATIONS) {
                return false;
            }
        } else {
            if ($query->serviceId > MAX_SERVICES) {
                return false;
            }
        }

        // Check questionTypeId
        if (str_contains($query->questionTypeId, ".")) {
            $questionInfo = explode(".", $query->questionTypeId);
            $count = count($questionInfo);
            $matchQuestionType = match ($count) {
                3 => $questionInfo[0] <= MAX_QUESTIONS_TYPE && $questionInfo[1] <= MAX_CATEGORIES && $questionInfo[2] <= MAX_SUB_CATEGORIES,
                2 => $questionInfo[0] <= MAX_QUESTIONS_TYPE && $questionInfo[1] <= MAX_CATEGORIES,
                default => false,
            };
        } else {
            $matchQuestionType = $query->questionTypeId <= MAX_QUESTIONS_TYPE;
        }

        if (!$matchQuestionType) {
            return false;
        }

        foreach ($this->strategies as $field => $strategy) {
            if (!$strategy->match($query->$field, $timeline->$field)) {
                return false;
            }
        }


        // Check responseType
        if ($timeline->responseType !== null && $query->responseType != $timeline->responseType) {
            return false;
        }

        return true;
    }
}
