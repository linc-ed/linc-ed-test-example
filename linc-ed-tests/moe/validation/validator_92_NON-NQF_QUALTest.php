<?php
/**
 * Field name: NON-NQF QUAL
 * Field number: 92
 *
 * Controlled list
 * Mandatory for Regular (RE, FF, TPRE, TPREOM) and Adult (RA, AD, TPAD, TPRAE, TPRAOM) students where REASON in [ L ,E, O, X, C] (students permanently leaving New Zealand schooling sector)
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_92_NON_NQF_QUALTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidNonNqfQual() {
		$this->student['NON-NQF QUAL'] = 'aaaaaaa';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_92();
		$this->assertSame($valid, 'false');
	}

	public function testNonNqfQualMandatory() {
		$this->student['NON-NQF QUAL'] = '';
		$this->student['TYPE'] = 'RE';
		$this->student['REASON'] = 'L';
		$this->student['funding_year_level'] = '10';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_92();
		$this->assertSame($valid, 'false');
	}
}