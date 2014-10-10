<?php
/**
 * Field name: PREVIOUS SCHOOL
 * Field number: 19
 *
 * Natural number
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_19_PREVIOUS_SCHOOLTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testPreviousSchool() {
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_19();
		$this->assertSame($valid, 'true');
	}

	public function testNumeric() {
		$this->student['previous_school'] = 'aaa';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_19();
		$this->assertSame($valid, 'false');
	}

}