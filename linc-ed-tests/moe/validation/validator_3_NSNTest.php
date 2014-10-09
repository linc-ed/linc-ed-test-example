<?php
/**
 * Field name: NSN
 * Field number: 3
 * Natural number, Mandatory , unless the student has left the school or has the STUDENT TYPE = EM or NF
 */

error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');

class validator_3_NSNTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidNSN() {
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_3();
		$this->assertSame($valid, 'true');
	}

	public function testNSNContainsNoCharacters() {
		//Contains characters
		$student['nsn'] = '2a';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_3();
		$this->assertSame($valid, 'false');
	}

	public function testNSNIsInteger() {
		//Floating point
		$student['nsn'] = '2.0';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_3();
		$this->assertSame($valid, 'false');

	}

	public function testNSNIsNaturalNumber() {
		//Negative
		$student['nsn'] = '-2';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_3();
		$this->assertSame($valid, 'false');
	}

	public function testNSNIsMandatory() {
		$student['nsn'] = '';
		$student['TYPE'] = 'RE';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_3();
		$this->assertSame($valid, 'false');
	}

	public function testNSNIsNotMandatoryForEM() {
		//Student type EM
		$student['nsn'] = '';
		$student['TYPE'] = 'EM';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_3();
		$this->assertSame($valid, 'true');
	}

	public function testNSNIsNotMandatoryForNF() {
		//Student type NF
		$student['nsn'] = '';
		$student['TYPE'] = 'NF';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_3();
		$this->assertSame($valid, 'true');
	}

}