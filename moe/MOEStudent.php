<?php

/**
 * Wrapping arrays in small Classes is a nice way to make
 * your code more readable. It's great to be able to test
 * that $school->closed === true, instead of $school[1] === '*'.
 * 
 * There will be some performance cost from constructing
 * objects like this - but don't fall into the trap of
 * prematurely optimising code. When we find a performance
 * issue it's far easier to analyse the problem with well
 * written code.
 */

class MOEStudent {
	

	public $array;
	

	public function __construct($array) {
		
		$this->array = $array;
	}
}