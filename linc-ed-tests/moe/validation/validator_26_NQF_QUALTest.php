<?php
/**
 * Field name: NQF QUAL
 * Field number: 26
 *
 * Controlled list
 * Mandatory for secondary aged students (RE, FF, TPRE, TPREOM)
 * and Adult (AD, TPAD, TPRAE, RA, TPRAOM) students who are 
 * leaving the New Zealand schooling sector and where REASON in 
 * [L, E, O, X, C] 
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_26_NQF_QUALTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testNQFQualNotMandatory() {
		$this->student['NQF QUAL'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_26();
		$this->assertSame($valid, 'true');
	}

	public function testNQFQualMandatory() {
		$this->student['TYPE'] = 'RE';
		$this->student['REASON'] = 'L';
		$this->student['NQF QUAL'] = '';
		$this->student['funding_year_level'] = '10';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_26();
		$this->assertSame($valid, 'false');
	}

	public function testValidNQFQual() {
		$this->student['NQF QUAL'] = 'invalid';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_26();
		$this->assertSame($valid, 'false');
	}

}