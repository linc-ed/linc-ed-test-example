<?php
/**
 * Field name: FTE
 * Field number: 23
 *
 * Number from 0.0 to 1.0 inclusive with one decimal point
 * Mandatory
 *
 * Invalid if:
 *
 * 221
 * If TYPE not equal to EM and STP is NULL and FUNDING
 * YEAR LEVEL < 9 and FTE < 1
 * and [Rmonth in [M,J] 
 *
 * 225
 * If TYPE not equal to EM and STP is NULL and FTE<1 and 
 * age <16 years on Roll count date
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_23_FTETest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testFTEMandatory() {
		$this->student['FTE'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_23();
		$this->assertSame($valid, 'false');
	}

	public function testFTEInRange() {
		$this->student['FTE'] = '1.1';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_23();
		$this->assertSame($valid, 'false');

		$this->student['FTE'] = '1.0';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_23();
		$this->assertSame($valid, 'true');
	}

	// 221
	// If TYPE not equal to EM and STP is NULL and FUNDING
	// YEAR LEVEL < 9 and FTE < 1
	// and [Rmonth in [M,J] 

	public function testFTEError221() {
		$this->student['TYPE'] = 'RE';
		$this->student['STP'] = '';
		$this->student['funding_year_level'] = '8';
		$this->student['FTE'] = '0.5';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_23();
		$this->assertSame($valid, 'false');
	}

	// 225
	// If TYPE not equal to EM and STP is NULL and FTE<1 and 
	// age <16 years on Roll count date

	public function testFTEError225() {
		$this->student['TYPE'] = 'RE';
		$this->student['STP'] = '';
		$birthYear = date('Y') - 10;
		$this->student['dob'] = $birthYear . '-01-01';
		$this->student['FTE'] - '0.5';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_23();
		$this->assertSame($valid, 'false');
	}

}