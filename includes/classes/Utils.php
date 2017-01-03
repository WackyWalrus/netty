<?php

class Utils {

	function goodVariable($variable) {
		if (!is_null($variable) && isset($variable)) {
			$type = getType($variable);
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
		return false;
	}

	function EpochToDateTime($epoch) {
		if (Utils::goodVariable($epoch)) {
			return date('m/d/y h:ia', $epoch);
		}
		return date('m/d/y h:ia');
	}

	function includeToVar($includefile, $globals = array()) {
		if (!empty($globals)) {
			foreach($globals as $global) {
				global ${$global};
			}
		}

		ob_start();
		include $includefile;
		return ob_get_clean();
	}
}

?>