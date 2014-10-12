<?php
/**
 * Field name: BOARDING STATUS
 * Field number: 95
 *
 * Y OR N
 * Mandatory for school with boarding facilities
 *
 * Invalid if:
 *
 * 635
 * If Boarding Status=Y and Zoning Status not ‘INZN’ and 
 * REASON=Null and FIRST ATTENDANCE >= enrolment 
 * scheme effective date
 * and [Rmonth in [M,J] or Funding Year Level >=9]
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_95_BOARDING_STATUSTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidBoardingStatus() {
		$this->student['BOARDING STATUS'] = 'aaaaaaa';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_95();
		$this->assertSame($valid, 'false');
	}

	// 635
 	// If Boarding Status=Y and Zoning Status not ‘INZN’ and 
 	// REASON=Null and FIRST ATTENDANCE >= enrolment 
 	// scheme effective date
 	// and [Rmonth in [M,J] or Funding Year Level >=9]

 	public function testBoardingStatusZoningStatus() {
 		$this->student['BOARDING STATUS'] = 'Y';
 		$this->student['zoning'] = '';
 		$this->student['REASON'] = '';
 		$this->student['start_date'] = '2014-02-02';
 		$this->school['enrolment_scheme_date'] = '2014-01-01';
 		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_95();
		$this->assertSame($valid, 'false');
 	}
}