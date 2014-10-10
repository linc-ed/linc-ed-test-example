<?php
/**
 * Field name: COUNTRY OF CITIZENSHIP
 * Field number: 21
 *
 * In controlled list
 * Mandatory
 * NZL students cannot be FF or EX in in month M or J or
 * if funding year level >= 9
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_21_COUNTRY_OF_CITIZENSHIPTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidCountryOfCitizenship() {
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_21();
		$this->assertSame($valid, 'true');
	}

	public function testCountryOfCitizenshipMandatory() {
		$this->student['citizenship'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_21();
		$this->assertSame($valid, 'false');
	}

	public function testNZLCitizenCannotBeFF() {
		$this->student['citizenship'] = 'NZL';
		$this->student['TYPE'] = 'FF';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_21();
		$this->assertSame($valid, 'false');
	}

	public function testNZLCitizenCannotBeEX() {
		$this->student['citizenship'] = 'NZL';
		$this->student['TYPE'] = 'EX';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_21();
		$this->assertSame($valid, 'false');
	}
}