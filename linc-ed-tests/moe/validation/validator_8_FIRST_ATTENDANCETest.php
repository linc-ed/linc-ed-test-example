<?php
/**
 * Field name: FIRST ATTENDANCE
 * Field number: 8
 * Format YYYYMMDD, mandatory
 * FIRST ATTENDANCE must be < FIRST SCHOOLING
 */
 error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');

class validator_8_FIRSTATTENDANCETest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidFirstAttendanceDateFormat() {
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_8();
		$this->assertSame($valid, 'true');
		
	}

	public function testInvalidFirstAttendanceDateFormat() {
		$this->student['start_date'] = 'aaaaa';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_8();
		$this->assertSame($valid, 'false');
	}

	public function testFirstAttendanceIsMandatory() {
		$this->student['start_date'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_8();
		$this->assertSame($valid, 'false');
	}

	public function testFirstAttendanceGTEFirstAttendance() {
		//Equal date
		$this->student['start_date'] = '2010-01-01';
		$this->student['first_schooling'] = '2010-01-01';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_8();
		$this->assertSame($valid, 'true');

		//Later date
		$this->student['first_schooling'] = '2011-01-01';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_8();
		$this->assertSame($valid, 'false');
	}
}