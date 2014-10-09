<?php
/**
 * Field name: ORS AND SECTION 9
 * Field number: 16
 *
 * Must be in controlled values list
 * Uppercase only
 * Mandatory
 */
// error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_16_ORS_AND_SECTION_9Test extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testORSSECT9IsMandatory() {
		$this->student['ORS and Section 9'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_16();
		$this->assertSame($valid, 'false');

		$this->student['ORS and Section 9'] = 'N';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_16();
		$this->assertSame($valid, 'true');
	}

	public function testORSSECT9IsInCodeSet() {
		$this->student['ORS and Section 9'] = 'n';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_16();
		$this->assertSame($valid, 'false');

		$this->student['ORS and Section 9'] = 'aaa';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_16();
		$this->assertSame($valid, 'false');

		$this->student['ORS and Section 9'] = 'H';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_16();
		$this->assertSame($valid, 'true');
	}
}