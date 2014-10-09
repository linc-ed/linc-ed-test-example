<?php
/**
 * Field name: FIRST SCHOOLING
 * Field number: 9
 * Format YYYYMMDD, mandatory for school types 20, 21, 32
 * 
 * Invalid if school type 20, 21 or 32 and first schooling is <= dob + 4.9 years
 * AND return month is M or J OR funding level is >= 9
 *
 * Invalid if not present AND school type 20, 21 or 32
 * AND funding level < 9 and month M or J
 */
// error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_9_FIRST_SCHOOLINGTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidFirstSchoolingDateFormat() {
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_9();
		$this->assertSame($valid, 'true');
	}

	public function testInvalidFirstSchoolingDateFormat() {
		$this->student['first_schooling'] = 'aaaaaa';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_9();
		$this->assertSame($valid, 'false');
	}

	public function testNotMandatoryForAllSchools() {
		$this->student['first_schooling'] = '';
		$this->school['school_type'] = '19';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_9();
		$this->assertSame($valid, 'true');
	}

	public function testMandatoryForSomeSchools() {
		//school type 20
		$this->student['first_schooling'] = '';
		$this->school['school_type'] = '20';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_9();
		$this->assertSame($valid, 'false');

		//school type 21
		$this->student['first_schooling'] = '';
		$this->school['school_type'] = '21';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_9();
		$this->assertSame($valid, 'false');

		//school type 32
		$this->student['first_schooling'] = '';
		$this->school['school_type'] = '32';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_9();
		$this->assertSame($valid, 'false');
	}

	public function testNotMandatoryForFundingLevel() {
		$this->student['first_schooling'] = '';
		$this->student['funding_year_level'] = '10';
		$this->school['school_type'] = '20';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_9();
		$this->assertSame($valid, 'true');
	}

	public function testStudentStartedBeforeAgeFive() {
		$this->student['first_schooling'] = '2008-01-01';
		$this->student['dob'] = '2007-01-01';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_9();
		$this->assertSame($valid, 'false');
	}

}