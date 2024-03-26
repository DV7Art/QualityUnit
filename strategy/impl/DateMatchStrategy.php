<?php
class DateMatchStrategy implements MatchStrategy {
    public function match($queryPart, $timelinePart): bool {
        // Convert the date string $timelinePart to a DateTime object
        $timelineDate = DateTime::createFromFormat('d.m.Y', $timelinePart);

        // Check if $queryPart contains a date range
        if (str_contains($queryPart, '-')) {
            list($dateFrom, $dateTo) = explode('-', $queryPart);
            $dateFrom = DateTime::createFromFormat('d.m.Y', $dateFrom);
            $dateTo = DateTime::createFromFormat('d.m.Y', $dateTo);

            // Check if $timelineDate is in the range from $dateFrom to $dateTo
            return $timelineDate >= $dateFrom && $timelineDate <= $dateTo;
        } else {
            // Convert the date string $queryPart to a DateTime object
            $queryDate = DateTime::createFromFormat('d.m.Y', $queryPart);

            // Check for matching dates
            return $timelineDate == $queryDate;
        }
    }
}
