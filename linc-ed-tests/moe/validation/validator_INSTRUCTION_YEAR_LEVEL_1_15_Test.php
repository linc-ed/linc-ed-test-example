<?php
/**
 * Field name: INSTRUCTIONAL YEAR LEVEL 1 to INSTRUCTIONAL YEAR LEVEL 15
 * Field number: [34,38,42,46,50,54,58,62,66,70,74,78,82,86,90]
 *
 * Controlled list
 * Mandatory if SUBJECT x is set for this field
 * and RMonth is J
 * 
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_INSTRUCTION_YEAR_LEVELTest extends PHPUnit_Framework_TestCase {
	
	private $student;
	private $school;
	private $fieldNumbers = [34,38,42,46,50,54,58,62,66,70,74,78,82,86,90];

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidInstructionalLevel() {
		for($i = 1; $i <= 15; $i++) {
			//Reset so that we only test one field at a time
			$this->student = StudentData::getStudent();
			$subjectFieldName = 'SUBJECT ' . $i;
			$this->student[$subjectFieldName] = 'PHED';
			$this->student['funding_year_level'] = '10';
			$yearLevelFieldName = 'INSTRUCTIONAL YEAR LEVEL SUBJECT ' . $i;
			$this->student[$yearLevelFieldName] = 'invalid';
			$moe = new MOEValidator($this->student, 'J', $this->school);
			//Get field number by indexing at i - 1
			$validator = 'check_'.$this->fieldNumbers[$i - 1];
			$valid = $moe->$validator();
			$this->assertSame($valid, 'false');
		}
	}

	public function testInstructionalLevelMandatory() {
		for($i = 1; $i <= 15; $i++) {
			//Reset so that we only test one field at a time
			$this->student = StudentData::getStudent();
			$subjectFieldName = 'SUBJECT ' . $i;
			$this->student[$subjectFieldName] = 'PHED';
			$yearLevelFieldName = 'INSTRUCTIONAL YEAR LEVEL SUBJECT ' . $i;
			$this->student[$yearLevelFieldName] = '';
			$this->student['funding_year_level'] = '10';
			$moe = new MOEValidator($this->student, 'J', $this->school);
			//Get field number by indexing at i - 1
			$validator = 'check_'.$this->fieldNumbers[$i - 1];
			$valid = $moe->$validator();
			$this->assertSame($valid, 'false');
		}
	}
}