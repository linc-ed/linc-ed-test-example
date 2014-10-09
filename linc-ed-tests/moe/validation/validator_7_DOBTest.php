<?php
/**
 * Field name: DOB
 * Field number: 7
 * Format YYYYMMDD, mandatory
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');

class validator_7_DOBTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidDOB() {
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_7();
		$this->assertSame($valid, 'true');
	}

	public function testDOBIsMandatory() {
		$student['dob'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_7();
		$this->assertSame($valid, 'false');
	}

	public function testBadDOBFormat() {
		$student['dob'] = 'adfdgsd';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_7();
		$this->assertSame($valid, 'false');
	}
}