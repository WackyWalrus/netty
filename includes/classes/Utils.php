<?php

class Utils {
	function EpochToDateTime($epoch) {
		if ($epoch !== null &&
				$epoch !== undefined) {
			return date('m/d/y h:ia', $epoch);
		}
		return date('m/d/y h:ia');
	}
}

?>