<?php
require_once 'MatchStrategy.php';
class ServiceIdMatchStrategy implements MatchStrategy {
    public function match($queryPart, $timelinePart): bool {
        if ($queryPart != '*') {
            $queryParts = explode(".", $queryPart);
            $timelineParts = explode(".", $timelinePart);
            $minParts = min(count($queryParts), count($timelineParts));
            for ($i = 0; $i < $minParts; $i++) {
                if ($queryParts[$i] != $timelineParts[$i]) {
                    return false;
                }
            }
        }
        return true;
    }
}