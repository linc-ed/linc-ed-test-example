<?php
/**
 * Field name: SUBJECTS
 *  fields 31,35,39,43,47,51,55,59,63,67,71,75,79,83 and 87)
 */
// error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_SUBJECTSTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	
	public function testSubjectIsNull() {
		$this->student['SUBJECT 1'] = '[Null]';
		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_31();
		$this->assertSame($valid, 'true');

		$this->student['SUBJECT 2'] = '[Null]';
		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_35();
		$this->assertSame($valid, 'true');

		$this->student['SUBJECT 3'] = '[Null]';
		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_39();
		$this->assertSame($valid, 'true');

		$this->student['SUBJECT 4'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_43();
		$this->assertSame($valid, 'true');

		$this->student['SUBJECT 5'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_47();
		$this->assertSame($valid, 'true');

		$this->student['SUBJECT 6'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_51();
		$this->assertSame($valid, 'true');


		$this->student['SUBJECT 7'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_55();
		$this->assertSame($valid, 'true');



		$this->student['SUBJECT 8'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_59();
		$this->assertSame($valid, 'true');



		$this->student['SUBJECT 9'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_63();
		$this->assertSame($valid, 'true');



		$this->student['SUBJECT 10'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_67();
		$this->assertSame($valid, 'true');



		$this->student['SUBJECT 11'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_71();
		$this->assertSame($valid, 'true');



		$this->student['SUBJECT 12'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_75();
		$this->assertSame($valid, 'true');



		$this->student['SUBJECT 13'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_79();
		$this->assertSame($valid, 'true');



		$this->student['SUBJECT 14'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_83();
		$this->assertSame($valid, 'true');



		$this->student['SUBJECT 15'] = '[Null]';		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_87();
		$this->assertSame($valid, 'true');

	}


	public function testSubjectInstructionalYearLevelIsNull() {
		$this->student['INSTRUCTIONAL YEAR LEVEL SUBJECT 2'] = '[Null]';
		
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_38();
		$this->assertSame($valid, 'true');

	}
	

	

}