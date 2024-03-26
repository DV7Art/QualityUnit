<?php
class DateMatchStrategy implements MatchStrategy {
    public function match($queryPart, $timelinePart): bool {
        if ($this->field == 'dateFrom') {
            // If dateFrom is set and the date on the timeline is earlier than dateFrom, return false
            if ($queryPart && $timelinePart && strtotime($timelinePart) < strtotime($queryPart)) {
                return false;
            }
        }
        if ($this->field == 'dateTo') {
            // If dateTo is set and the date on the timeline is later than dateTo, return false
            if ($queryPart && $timelinePart && strtotime($timelinePart) > strtotime($queryPart)) {
                return false;
            }
        }
        return true;
    }
}
