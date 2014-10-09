<?php
/**
 * Field name: SURNAME
 * Field number: 4
 * ASCII or ASCII plus macronised, mandatory
 * field should not contain brackets, commas or multiple spaces before or after hyphens or apostrophes.
 */
 error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_4_SURNAMETest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidSurname() {
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'true');
	}

	public function testSurnameIsMandatory() {
		$this->student['last_name'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'false');
	}

	public function testSurnameDoesNotContainBrackets() {
		$this->student['last_name'] = 'a(b)';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'false');
	}

	public function testSurnameDoesNotContainCommas() {
		$this->student['last_name'] = 'a,b';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'false');
	}

	public function testSurnameMultipleSpacesWithHyphen() {
		//one space
		$this->student['last_name'] = 'a - b';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'true');

		//two space before
		$this->student['last_name'] = 'a  - b';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'false');

		//two space after
		$this->student['last_name'] = 'a -  b';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'false');
	}

	public function testSurnameMultipleSpacesWithApostrophie() {
		//one space
		$this->student['last_name'] = 'a \' b';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'true');

		//two space before
		$this->student['last_name'] = 'a  \' b';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'false');

		//two space after
		$this->student['last_name'] = 'a \'  b';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'false');
	}
}