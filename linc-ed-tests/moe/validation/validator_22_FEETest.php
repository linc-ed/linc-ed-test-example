<?php
/**
 * Field name: FEE
 * Field number: 22
 *
 * Numeric whole number
 * Mandatory for student type FF
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_22_FEETest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testFEENotMandatory() {
		$this->student['FEE'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_22();
		$this->assertSame($valid, 'true');
	}

	public function testFEEMandatoryForFF() {
		$this->student['TYPE'] = 'FF';
		$this->student['FEE'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_22();
		$this->assertSame($valid, 'false');
	}

	public function testFeeNumeric() {
		$this->student['FEE'] = 'aaa';
		$this->student['TYPE'] = 'FF';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_22();
		$this->assertSame($valid, 'false');
	}
}