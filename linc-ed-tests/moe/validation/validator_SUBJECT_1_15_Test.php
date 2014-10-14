<?php
/**
 * Field name: SUBJECT 1 to SUBJECT 15
 * Field number: [31,35,39,43,47,51,55,59,63,67,71,75,79,83,87]
 *
 * Controlled list
 * Mandatory to have at least one subject for fulltime student
 *
 * Invalid if:
 *
 * 674
 * If one or more SUBJECT code = ‘NAPP’ and some 
 * SUBJECT codes NOT in [‘NAPP’,’Blank’]
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_SUBJECTSTest extends PHPUnit_Framework_TestCase {
	
	private $student;
	private $school;
	private $fieldNumbers = [31,35,39,43,47,51,55,59,63,67,71,75,79,83,87];

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidSubject() {
		for($i = 1; $i <= 15; $i++) {
			$fieldName = 'SUBJECT ' . $i;
			$this->student[$fieldName] = 'invalid';
		}
		$moe = new MOEValidator($this->student, 'M', $this->school);
		foreach ($this->fieldNumbers as $fieldNumber) {
			$validator = 'check_'.$fieldNumber;
			$valid = $moe->$validator();
			$this->assertSame($valid, 'false');
		}
	}

	public function testFulltimeStudentSubjectMandatory() {
		for($i = 1; $i <= 15; $i++) {
			$fieldName = 'SUBJECT ' . $i;
			$this->student[$fieldName] = '';
		}
		$this->student['funding_year_level'] = '10';
		$this->student['ORS and Section 9'] = 'N';
		$moe = new MOEValidator($this->student, 'J', $this->school);
		$valid = $valid = $moe->check_31();
		$this->assertSame($valid, 'false');
	}

	// 674
	// If one or more SUBJECT code = ‘NAPP’ and some 
	// SUBJECT codes NOT in [‘NAPP’,’Blank’]

	public function testNoNAPPSubjects() {
		$this->student['SUBJECT 1'] = 'NAPP';
		$this->student['SUBJECT 2'] = 'PHED';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $valid = $moe->check_31();
		$this->assertSame($valid, 'false');
	}
}