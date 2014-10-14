<?php
/**
 * Field name: POST SCHOOL ACTIVITY
 * Field number: 104
 *
 * Controlled list
 * Mandatory for school leavers Leave REASON in [L, E, O, X]
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_104_POST_SCHOOL_ACTIVITYTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testPostSchoolActivityMandatory() {
		$this->student['POST-SCHOOL ACTIVITY'] = '';
		$this->student['REASON'] = 'L';
		$this->student['funding_year_level'] = '10';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_104();
		$this->assertSame($valid, 'false');
	}

	public function testPostSchoolActivityValid() {
		$this->student['POST-SCHOOL ACTIVITY'] = 'aaaaaaaa';
		$this->student['REASON'] = 'L';
		$this->student['funding_year_level'] = '10';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_104();
		$this->assertSame($valid, 'false');
	}
}