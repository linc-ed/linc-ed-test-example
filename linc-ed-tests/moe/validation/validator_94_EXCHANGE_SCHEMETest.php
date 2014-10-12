<?php
/**
 * Field name: EXCHANGE SCHEME
 * Field number: 94
 *
 * Controlled list
 * Mandatory for student type EX
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_94_EXCHANGE_SCHEMETest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidExchangeScheme() {
		$this->student['EXCHANGE SCHEME'] = 'aaaaaaa';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_94();
		$this->assertSame($valid, 'false');
	}

	public function testExchangeSchemeMandatory() {
		$this->student['EXCHANGE SCHEME'] = '';
		$this->student['TYPE'] = 'EX';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_94();
		$this->assertSame($valid, 'false');
	}
}