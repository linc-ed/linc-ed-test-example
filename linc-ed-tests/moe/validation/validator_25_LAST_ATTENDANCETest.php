<?php
/**
 * Field name: LAST ATTENDANCE
 * Field number: 25
 *
 * 
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_25_LAST_ATTENDANCETest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testLastAttendanceNotMandatory() {
		$this->student['LAST ATTENDANCE'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_25();
		$this->assertSame($valid, 'true');
	}

	public function testLastAttendanceMandatoryIfReasonNotNull() {
		$this->student['LAST ATTENDANCE'] = '';
		$this->student['REASON'] = 'S';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_25();
		$this->assertSame($valid, 'false');
	}

	public function testLastAttendanceInvalidDate() {
		$this->student['LAST ATTENDANCE'] = 'aaaaa';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_25();
		$this->assertSame($valid, 'false');
	}

}