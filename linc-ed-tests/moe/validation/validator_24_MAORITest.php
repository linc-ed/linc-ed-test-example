<?php
/**
 * Field name: MAORI
 * Field number: 24
 *
 * In controlled field list
 * Not mandatory
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_24_MAORITest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testMaoriNotMandatory() {
		$this->student['MAORI'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_24();
		$this->assertSame($valid, 'true');
	}

	public function testMaoriInFieldList() {
		$this->student['MAORI'] = 'invalid';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_24();
		$this->assertSame($valid, 'false');
	}

}