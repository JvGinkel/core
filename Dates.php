<?php
namespace core;

class Dates {
	// Convert $date into $step intervals.
	// $step is in 5min intervals
	//
	// @param int $date unixtimestamp
	// @param int $step step * 5min
	public static function consolidate($date, $step) {
		$step = 60 * 5 * $step; // 5min intervals
		$addl = $date % $step;
		return $date - $addl;
	}

	// Get $entries related from $today in upcoming years
	public static function years($today, $entries = 6) {
		$year = strtotime($today);
		if ($year === false) {
			return false;
		}
		$out = array(date("Y", $year));

		for ($i = 1; $i < $entries; $i++) {
			$year = strtotime("+1 year", $year);
			if ($year === false) {
				return false;
			}
			$out[] = date("Y", $year);
		}
		if (! arsort($out)) {
			return false;
		}
		return array_values($out);
	}
}
