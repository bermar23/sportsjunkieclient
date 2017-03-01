<?php
/**
 * Created by PhpStorm.
 * User: Bermar
 * Date: 2/28/2017
 * Time: 1:38 PM
 */

function getNewCode($lastCode, $prefix, $length){
	$newCode = '';	
	if(empty($lastCode)){
		$lastCode = $prefix;
		$codeLength = $length;
		for ($i = 1; $i < $codeLength; $i++) {
			$lastCode .= "0";
		}
	}
	
	//get new code
	$newCode = getNextAlphaNumericCode($prefix, $lastCode);
	
	return $newCode;
}

function getNextAlphaNumericCode($prefix = NULL, $current = NULL, $forceTotalLength = NULL, $uppercaseAlpha = TRUE)
{
	if (is_null($prefix) && is_null($forceTotalLength) && is_null($current)) {
		// invalid, can't all be NULL
		return FALSE;
	}

	// set $prefix
	if (is_null($prefix)) {
		$prefix = "";
	} elseif (!is_string($prefix)) {
		$prefix = strtoupper((string)$prefix);
	}

	// set $forceTotalLength
	if (is_null($forceTotalLength) || (is_string($forceTotalLength) && strlen($forceTotalLength) == 0)) {
		if (!is_null($current) && is_string($current) && strlen($current) > 0) {
			$forceTotalLength = strlen($current);
		} else {
			$forceTotalLength = strlen($prefix) + 3;
		}
	} elseif (!is_int($forceTotalLength)) {
		try {
			$forceTotalLength = intval($forceTotalLength);
		} catch (Exception $ex) {
			return FALSE;
		}
	}
	$forceCodeLength = $forceTotalLength - strlen($prefix);

	// set $current
	if (is_null($current)) {
		$current = $prefix . str_repeat("0", $forceCodeLength);
	} else {
		if (!is_string($current)) {
			$current = (string)$current;
		}
	}

	if (strcmp(substr($current, 0, strlen($prefix)), $prefix) === 0) {
		// it has the prefix included
		$currentCodeWithoutPrefix = substr($current, strlen($prefix));
	} else {
		// prefix isn't included
		$currentCodeWithoutPrefix = $current;

		$forceCodeLength = $forceCodeLength + strlen($prefix);
	}

	if (strlen($currentCodeWithoutPrefix) < $forceCodeLength) {
		// pad it
		$currentCodeWithoutPrefix = str_repeat("0", $forceCodeLength - strlen($currentCodeWithoutPrefix)) . $currentCodeWithoutPrefix;
	} elseif (strlen($currentCodeWithoutPrefix) > $forceCodeLength) {
		// trim it from the left
		$currentCodeWithoutPrefix = substr($currentCodeWithoutPrefix, strlen($currentCodeWithoutPrefix) - $forceCodeLength, $forceCodeLength);
	}

	$theCode = "";
	$hasBeenIndexed = FALSE;
	for ($index = strlen($currentCodeWithoutPrefix) - 1; $index >= 0; $index--) {
		$thisChar = substr($currentCodeWithoutPrefix, $index, 1);

		if ($hasBeenIndexed) {
			// just keep the chars
			$theCode = $thisChar . $theCode;
		} else {
			if (ord($thisChar) == 57) {
				// is a 9, index the char to an A
				$theCode = "A" . $theCode;

				$hasBeenIndexed = TRUE;
			} elseif (ord($thisChar) == 90) {
				// is a Z, index the char to an a
				$theCode = "a" . $theCode;

				$hasBeenIndexed = TRUE;
			} elseif (ord($thisChar) == 122) {
				// is a z, test if it's the last char
				if ($index == 0) {
					// is the last char, this code is already full
					return FALSE;
				} else {
					// not the last char, make this 0 & will index the next char
					$theCode = "0" . $theCode;
				}
			} else {
				// index the ascii by 1
				$theCode = chr(ord($thisChar) + 1) . $theCode;

				$hasBeenIndexed = TRUE;
			}
		}
	}

	/*
	if ($uppercaseAlpha) {
		$theCode = strtoupper($theCode);
	} else {
		$theCode = strtolower($theCode);
	}
	*/

	return $prefix . $theCode;
}