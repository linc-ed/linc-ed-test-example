<?php
/**
 * Field name: CURRENT YEAR LEVEL
 * Field number: 103
 *
 * Integer in code list Year levels 1 to 13
 * Mandatory
 *
 * Invalid if:
 *
 * 646 
 * If School Type = 23, 32, 34 and CURRENT YEAR LEVEL is 
 * not between 1 and 13 inclusive 
 * 
 * 647 
 * If School Type = 20, 21 and CURRENT YEAR LEVEL is not 
 * between 1 and 8 inclusive 
 * 
 * 648 
 * If School Type = 30 or 40 and CURRENT YEAR LEVEL is 
 * not between 7 and 13 inclusive 
 * 
 * 649 
 * If School Type = 22 and CURRENT YEAR LEVEL is not 
 * between 7 and 8 inclusive 
 * Current Year Level is incorrect
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_103_CURRENT_YEAR_LEVELTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testCurentYearMandatory() {
		$this->student['current_year_level'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_103();
		$this->assertSame($valid, 'false');
	}

	// 646 
	// If School Type = 23, 32, 34 and CURRENT YEAR LEVEL is 
	// not between 1 and 13 inclusive 

	public function testCurrentYearError646() {
		$this->school['school_type'] = '23';
		$this->student['current_year_level'] = '14';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_103();
		$this->assertSame($valid, 'false');
	}

	// 647 
	// If School Type = 20, 21 and CURRENT YEAR LEVEL is not 
	// between 1 and 8 inclusive 

	public function testCurrentYearError647() {
		$this->school['school_type'] = '20';
		$this->student['current_year_level'] = '9';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_103();
		$this->assertSame($valid, 'false');
	}

	// 648 
	// If School Type = 30 or 40 and CURRENT YEAR LEVEL is 
	// not between 7 and 13 inclusive 

	public function testCurrentYearError648() {
		$this->school['school_type'] = '30';
		$this->student['current_year_level'] = '6';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_103();
		$this->assertSame($valid, 'false');
	}

	// 649 
	// If School Type = 22 and CURRENT YEAR LEVEL is not 
	// between 7 and 8 inclusive 
	// Current Year Level is incorrect

	public function testCurrentYearError649() {
		$this->school['school_type'] = '22';
		$this->student['current_year_level'] = '6';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_103();
		$this->assertSame($valid, 'false');
	}
}