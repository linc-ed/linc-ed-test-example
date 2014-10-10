<?php
/**
 * Field name: REASON
 * Field number: 27
 *
 * Controlled value list
 * Mandatory for Students where Last Attendance Date is populated
 *
 * 273
 * If REASON in [E, K] but age on LAST ATTENDANCE >=16
 * and [Rmonth in [M,J] or Funding Year Level >=9]
 * Exempted or Excluded student must be <16
 * 
 * 275
 * REASON If REASON in [L, X] and age on LAST ATTENDANCE <15yrs 
 * +9mnths at last attendance
 *
 * 669
 * If ELIGIBILITY in [20199,20201,60001,60002] and LEAVE 
 * REASON = ‘J’
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_27_REASONTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testReasonNotMandatory() {
		$this->student['REASON'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_27();
		$this->assertSame($valid, 'true');
	}

	public function testReasonMandatory() {
		$this->student['REASON'] = '';
		$this->student['LAST ATTENDANCE'] = '2014-01-01';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_27();
		$this->assertSame($valid, 'false');
	}

	public function testReasonValid() {
		$this->student['REASON'] = 'invalid';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_27();
		$this->assertSame($valid, 'true');
	}

	// 273
	// If REASON in [E, K] but age on LAST ATTENDANCE >=16
	// and [Rmonth in [M,J] or Funding Year Level >=9]

	public function testReasonError273() {
		$this->student['REASON'] = 'E';
		$this->student['LAST ATTENDANCE'] = '2014-01-01';
		$this->student['dob'] = '1980-01-01';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_27();
		$this->assertSame($valid, 'false');
	}

	// 275
	// REASON If REASON in [L, X] and age on LAST ATTENDANCE <15yrs 
	// +9mnths at last attendance

	public function testReasonError275() {
		$this->student['REASON'] = 'L';
		$this->student['LAST ATTENDANCE'] = '2014-01-01';
		$this->student['dob'] = '2013-01-01';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_27();
		$this->assertSame($valid, 'false');
	}

	// 669
	// If ELIGIBILITY in [20199,20201,60001,60002] and LEAVE 
	// REASON = ‘J’
	public function testReasonError669() {
		$this->student['REASON'] = 'J';
		$thos->student['ELIGIBILITY'] = '20199';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_27();
		$this->assertSame($valid, 'false');
	}
}