<?php

class Utils {
	function EpochToDateTime($epoch) {
		return date('m/d/y h:ia', $epoch);
	}
}

?>