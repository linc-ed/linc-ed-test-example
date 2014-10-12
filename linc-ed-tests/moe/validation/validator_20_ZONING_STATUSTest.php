<?php
/**
 * Field name: ZONING STATUS
 * Field number: 20
 *
 * In [INZN, OUTZ, NAPP]
 * Mandatory for [RE, RA, AD, TPREOM, TPRAOM, and EX]
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_20_ZONING_STATUSTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidZoningStatus() {
		$this->student['zoning'] = 'NAPP';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_20();
		$this->assertSame($valid, 'true');
	}

	public function testInvalidZoningStatus() {
		$this->student['zoning'] = 'invalid';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_20();
		$this->assertSame($valid, 'false');
	}

}