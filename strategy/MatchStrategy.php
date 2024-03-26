<?php
interface MatchStrategy {
    public function match($queryPart, $timelinePart): bool;
}