<?php
/**
 * Field name: IWI, IWI2, IWI3
 * Field number: 13, 14, 15
 *
 * Must be in iwi code list
 * Mandatory for IWI1 where ethnicity identified as maori 
 * and FIRST ATTENDANCE>1 Jan 2003
 * Iwi2 and Iwi3 is optional
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_13_14_15_IWITest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testNotMandatory() {
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_13();
		$this->assertSame($valid, 'true');
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_14();
		$this->assertSame($valid, 'true');
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_15();
		$this->assertSame($valid, 'true');
	}

	public function testIWI1InCodeList() {
		//IWI1
		$this->student['IWI1'] = '0100';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_13();
		$this->assertSame($valid, 'true');

		$this->student['IWI1'] = 'a';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_13();
		$this->assertSame($valid, 'false');
	}

	public function testIWI2InCodeList() {
		//IWI2
		$this->student['IWI2'] = '0100';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_14();
		$this->assertSame($valid, 'true');

		$this->student['IWI2'] = 'a';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_14();
		$this->assertSame($valid, 'false');
	}

	public function testIWI3InCodeList() {
		//IWI3
		$this->student['IWI3'] = '0100';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_15();
		$this->assertSame($valid, 'true');

		$this->student['IWI3'] = 'a';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_15();
		$this->assertSame($valid, 'false');
	}

	public function testIWI1Mandatory() {
		$this->student['ethnic_origin'] = '211';
		$this->student['start_date'] = '2004-01-01';
		$this->student['IWI1'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_13();
		$this->assertSame($valid, 'false');
	}

	public function testNoIWIDuplicates() {
		//1 and 2
		$this->student['IWI1'] = '0100';
		$this->student['IWI2'] = '0100';
		$this->student['IWI3'] = '0101';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_13();
		$this->assertSame($valid, 'false');

		//1 and 3
		$this->student['IWI1'] = '0100';
		$this->student['IWI2'] = '0101';
		$this->student['IWI3'] = '0100';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_13();
		$this->assertSame($valid, 'false');

		//2 and 3
		$this->student['IWI1'] = '0100';
		$this->student['IWI2'] = '0101';
		$this->student['IWI3'] = '0101';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_14();
		$this->assertSame($valid, 'false');
	}
}