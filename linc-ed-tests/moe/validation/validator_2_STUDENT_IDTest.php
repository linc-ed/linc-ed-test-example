<?php
/**
 * Field name: STUDENT ID 
 * Field number: 2
 * Alphanumeric, mandatory
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');

class validator_2_STUDENT_IDTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidStudentId() {

		$moe = new MOEValidator($this->student, 'M', $school);
		$valid = $moe->check_2();
		$this->assertSame($valid, 'true');
		
	}

	public function testStudentIdIsAlphanumeric() {
		$this->student['person_id'] = '!%&';
		$moe = new MOEValidator($this->student, 'M', $school);
		$valid = $moe->check_2();
		$this->assertSame($valid, 'false');
	}

	public function testStudentIdIsNotEmpty() {
		$this->student['person_id'] = '';
		$moe = new MOEValidator($this->student, 'M', $school);
		$valid = $moe->check_2();
		$this->assertSame($valid, 'false');
	}

}