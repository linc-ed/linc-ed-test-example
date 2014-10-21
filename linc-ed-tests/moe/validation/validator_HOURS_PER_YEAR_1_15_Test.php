<?php
/**
 * Field name: HOURS PER YEAR 1 to HOURS PER YEAR 15
 * Field number: [33,37,41,45,49,53,57,61,65,69,73,77,81,85,89]
 *
 * Natural numbe 1 - 999
 * Mandatory if SUBJECT x is set for this field
 *
 * 
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_HOURS_PER_YEARTest extends PHPUnit_Framework_TestCase {
	
	private $student;
	private $school;
	private $fieldNumbers = [33,37,41,45,49,53,57,61,65,69,73,77,81,85,89];

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidHoursPerYear() {
		for($i = 1; $i <= 15; $i++) {
			//Reset so that we only test one field at a time
			$this->student = StudentData::getStudent();
			$subjectFieldName = 'SUBJECT ' . $i;
			$this->student[$subjectFieldName] = 'PHED';
			$hoursFieldName = 'HOURS PER YEAR SUBJECT ' . $i;
			$this->student[$hoursFieldName] = '1000';
			$moe = new MOEValidator($this->student, 'M', $this->school);
			//Get field number by indexing at i - 1
			$validator = 'check_'.$this->fieldNumbers[$i - 1];
			$valid = $moe->$validator();
			$this->assertSame($valid, 'false');
		}
	}

	public function testHoursPerYearMandatory() {
		for($i = 1; $i <= 15; $i++) {
			//Reset so that we only test one field at a time
			$this->student = StudentData::getStudent();
			$subjectFieldName = 'SUBJECT ' . $i;
			$this->student[$subjectFieldName] = 'PHED';
			$hoursFieldName = 'HOURS PER YEAR SUBJECT ' . $i;
			$this->student[$hoursFieldName] = '';
			$moe = new MOEValidator($this->student, 'J', $this->school);
			//Get field number by indexing at i - 1
			$validator = 'check_'.$this->fieldNumbers[$i - 1];
			$valid = $moe->$validator();
			$this->assertSame($valid, 'false');
		}
	}
}