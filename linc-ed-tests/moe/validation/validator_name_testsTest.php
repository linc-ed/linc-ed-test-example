<?php
/**
 * Field name: contacts address fields
 * Field number: 118, 119, 120, 121, 122, 126, 127, 128, 129, 130
 *
 * Fields with embedded double-quote characters must be delimited with double-quote characters, and the embedded double-quote characters must be represented by a pair of double-quote characters.	
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_addressFieldsTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testContact1Address1to4() {

		$this->student['contact_1_address1']='"Taylors Hill" Cornwall Road';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_118();
		$this->assertSame($valid, 'false');

		$this->student['contact_1_address2']='"Taylors Hill" Cornwall Road';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_118();
		$this->assertSame($valid, 'false');


	$this->student['contact_1_address3']='"Taylors Hill" Cornwall Road';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_118();
		$this->assertSame($valid, 'false');


	$this->student['contact_1_address4']='"Taylors Hill" Cornwall Road';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_118();
		$this->assertSame($valid, 'false');

	}
}
