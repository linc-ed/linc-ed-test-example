<?php
/**
 * Field name: Eligibility Criteria
 *  fields 100
 */
// error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_EligibilityCriteriaTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	

	public function testELIGIBILITYIsNull() {
		$this->student['ELIGIBILITY CRITERIA'] = '[Null]';
		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_100();
		$this->assertSame($valid, 'true');

	}

	public function testVERIFICATIONIsNull() {
		$this->student['VERIFICATION DOCUMENT'] = '[Null]';
		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_101();
		$this->assertSame($valid, 'true');

	}
	
	

	

}