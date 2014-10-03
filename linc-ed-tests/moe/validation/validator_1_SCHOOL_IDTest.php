<?php

/**
 * Our first test for the SCHOOL_ID field.
 * The specification describes that it is mandatory, and that
 * the school must be open. So we test that not setting the field,
 * setting the field to a non existant school, or setting the field
 * to a closed school all return false.
 */

require_once(dirname(__FILE__).'/../../../moe/MOEValidator.php');
require_once(dirname(__FILE__).'/../../../moe/MOECodeSets.php');

//Class can be named anything we like - but I prefer to mirror the filename 
class validator_1_SCHOOL_IDTest extends PHPUnit_Framework_TestCase {

	//This is a special PHPUnit function that is called before all these tests
	public static function setUpBeforeClass()
	{
		//Set up schools for validation
		//I'm inventing a structure here based on 
		//http://www.educationcounts.govt.nz/__data/assets/excel_doc/0007/145645/School-Name-and-Numbers-2014-01.xls
		MOECodeSets::addSchool(array('1', '', 'Open School', ''));
		MOECodeSets::addSchool(array('2', '*', 'Closed School', ''));
	}

	//Naming the function testName allows it to be called by phpunit
	//(We could also use an annotation @test)

	//This test may be redundant - if the validator is allways passed
	//a string.
	public function testNotNull() {
		$school_id = null;
		$valid = MOEValidator::validate_1_SCHOOL_ID($school_id);
		$this->assertSame($valid, false);
	}

	public function testEmptyField() {
		$school_id = '';
		$valid = MOEValidator::validate_1_SCHOOL_ID($school_id);
		$this->assertSame($valid, false);
	}

	public function testNonSchool() {
		$school_id = 'adasd';
		$valid = MOEValidator::validate_1_SCHOOL_ID($school_id);
		$this->assertSame($valid, false);
	}

	public function testOpenSchool() {
		$school_id = '1';
		$valid = MOEValidator::validate_1_SCHOOL_ID($school_id);
		$this->assertSame($valid, true);
	}

	public function testClosedSchool() {
		$school_id = '2';
		$valid = MOEValidator::validate_1_SCHOOL_ID($school_id);
		$this->assertSame($valid, false);
	}
}

?>