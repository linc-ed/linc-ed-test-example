<?php
/**
 * Field name: GENDER
 * Field number: 6
 * M or F uppercase only, mandatory
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_6_GENDERTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testGenderMorF() {
		//M or F
		$this->student['gender'] = 'M';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_6();
		$this->assertSame($valid, 'true');
		$this->student['gender'] = 'F';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_6();
		$this->assertSame($valid, 'true');

		//Non M or F data
		$this->student['gender'] = 'Male';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_6();
		$this->assertSame($valid, 'false');
	}

	public function testGenderUppercase() {
		$this->student['gender'] = 'm';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_6();
		$this->assertSame($valid, 'false');
	}

	public function testGenderMandatory() {
		$this->student['gender'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_6();
		$this->assertSame($valid, 'false');
	}

}