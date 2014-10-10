<?php
/**
 * Field name: UE
 * Field number: 93
 *
 * Y or N
 * Applies to full time secondary level students (RE, FF, TPRE, TPREOM) and Adult (RA, AD, TPRAE, TPAD,TPRAOM) students leaving the New Zealand schooling sector and where REASON in [L,E,O,X, C ]
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_93_UETest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidUE() {
		$this->student['UE'] = 'aaaaaaa';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_93();
		$this->assertSame($valid, 'false');
	}

	public function testUEMandatory() {
		$this->student['UE'] = '';
		$this->student['TYPE'] = 'RE';
		$this->student['REASON'] = 'L';
		$this->student['funding_year_level'] = '10';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_93();
		$this->assertSame($valid, 'false');
	}
}