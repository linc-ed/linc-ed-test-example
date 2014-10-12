<?php
/**
 * Field name: PACIFIC MEDIUM – LANGUAGE, PACIFIC MEDIUM – LEVEL
 * Field number: 29, 30
 *
 * Controlled list
 * Pacific medium - language 
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_29_30_PACIFIC_MEDIUMTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testPacificMediumNotMandatory() {
		$this->student['PACIFIC MEDIUM -LANGUAGE'] = '';
		$this->student['PACIFIC MEDIUM - LEVEL'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_29();
		$this->assertSame($valid, 'true');
		$valid = $moe->check_30();
		$this->assertSame($valid, 'true');
	}

	public function testPacficMediumLanguageMandatory() {
		$this->student['PACIFIC MEDIUM -LANGUAGE'] = '';
		$this->student['PACIFIC MEDIUM - LEVEL'] = '1';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_30();
		$this->assertSame($valid, 'false');
	}

	public function testPacficMediumLevelMandatory() {
		$this->student['PACIFIC MEDIUM -LANGUAGE'] = 'CIM';
		$this->student['PACIFIC MEDIUM - LEVEL'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_29();
		$this->assertSame($valid, 'false');
	}

	public function testInvalidPacificMediumLanguage() {
		$this->student['PACIFIC MEDIUM -LANGUAGE'] = 'invalid';
		$this->student['PACIFIC MEDIUM - LEVEL'] = 'invalid';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_29();
		$this->assertSame($valid, 'false');
		$valid = $moe->check_30();
		$this->assertSame($valid, 'false');
	}
}