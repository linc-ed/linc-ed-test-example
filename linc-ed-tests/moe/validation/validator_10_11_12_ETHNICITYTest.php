<?php
/**
 * Field name: ETHNIC1, ETHNIC2, ETHNIC3
 * Field number: 10, 11, 12
 *
 * Must be in ethnicity code list
 * Mandatory for ETHNIC1 if month M or J or funding level >= 9
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_10_11_12_ETHNICITYTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testEthnicity1Mandatory() {
		$this->student['ethnic_origin'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_10();
		$this->assertSame($valid, 'false');
	}

	public function testEthnicityInCodelist() {
		//ETHNIC1
		$this->student['ethnic_origin'] = '111';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_10();
		$this->assertSame($valid, 'true');

		$this->student['ethnic_origin'] = '1';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_10();
		$this->assertSame($valid, 'false');
		
		//ETHNIC2
		$this->student['ethnic_origin2'] = '2';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_10();
		$this->assertSame($valid, 'false');

		//ETHNIC3
		$this->student['ethnic_origin3'] = '3';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_10();
		$this->assertSame($valid, 'false');
	}

	public function testEthnicityNotMandatoryForYearLevel() {
		$this->student['ethnic_origin'] = '';
		$this->student['funding_year_level'] = '10';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_10();
		$this->assertSame($valid, 'true');
	}

		public function testEthnicityNotMandatoryForMonth() {
		$this->student['ethnic_origin'] = '';
		$moe = new MOEValidator($this->student, 'E', $this->school);
		$valid = $moe->check_10();
		$this->assertSame($valid, 'true');
	}
}
