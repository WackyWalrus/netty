<?php

class Utils {

	function goodVariable($variable) {
		if ($variable !== null || $variable !== undefined) {
			if (gettype($variable) === 'array') {
				if (!empty($variable) &&
						count($variable) > 0) {
					return true;
				}
			} else {
				return true;
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