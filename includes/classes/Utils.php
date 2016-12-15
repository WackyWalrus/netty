<?php

class Utils {

	function goodVariable($variable) {
		if ($variable !== null || $variable !== undefined) {
			$type = getType($variable);
			if ($type !== null &&
					$type !== undefined) {
				if ($type === 'array') {
					if (!empty($variable) &&
							count($variable) !== -1) {
						return true;
					}
				} elseif($type === 'object') {
					$cast = (array)$variable;
					if (!empty($cast) &&
							count($cast) !== -1) {
						return true;
					}
				} else {
					if (count($variable) !== -1) {
						return true;
					}
				}
			}
		}
		return false;
	}

	function EpochToDateTime($epoch) {
		if ($this->goodVariable($epoch)) {
			return date('m/d/y h:ia', $epoch);
		}
		return date('m/d/y h:ia');
	}
}

?>