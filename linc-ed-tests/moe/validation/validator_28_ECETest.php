<?php
/**
 * Field name: ECE
 * Field number: 28
 *
 * Controlled list
 * Not mandatory
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_28_ECETest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testECENotMandatory() {
		$this->student['ECE'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_28();
		$this->assertSame($valid, 'true');
	}

	public function testInvalidECE() {
		$this->student['ECE'] = 'invalid';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_28();
		$this->assertSame($valid, 'false');
	}
}