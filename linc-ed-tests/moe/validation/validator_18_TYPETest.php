<?php
/**
 * Field name: TYPE
 * Field number: 18
 *
 * Must be in controlled values list
 * Mandatory
 *
 * Invalid if:
 *
 * 171
 * If TYPE=Null
 *
 * 172
 * If School Type in [30, 40] and TYPE not in [FF, AE, EX, AD, 
 * RA, RE, EM, SA, NA, NF, SF, TPREOM, TPRAOM, TPAD, 
 * TPRE, TPRAE]
 *
 * 176
 * If TYPE in [AD, RA, TPAD, TPRAE, TPRAOM] and age is 
 * <19 on 1 Jan (t)
 *
 * 177a
 * If REASON=Null and ORS AND SECTION 9 = N and 
 * TYPE=RE and age at 1 Jan(t)>=19
 *
 * 177b
 * If REASON=Null and TYPE in [TPRE, TPREOM] and age at 
 * 1 Jan(t)>=19
 *
 * 179
 * If TYPE=NA and LAST ATTENDANCE>=1March year (t-1) 
 * and <1 March year (t) and REASON not NULL 
 *
 * 612
 * If ORS AND SECTION 9=N and School Type in [20, 21, 22] 
 * and TYPE not in [FF, EX, RE, EM, SA, NA,NF, SF]
 *
 * 613
 * If School Type in [32, 34, 35] and TYPE not in Ministry 
 * code list for TYPE
 *
 * 614
 * If School Type=23 and TYPE not in [FF, AD, RA, RE, EM, 
 * NA, NF,SF]
 *
 * 666
 * If Student Type = “NF” and Eligibility Criteria NOT in 
 * [60010, 60011] 
 * and [Rmonth in [M,J] or Funding Year Level >=9]
 *
 * 667
 * If Student Type is NOT “NF” and Eligibility Criteria in 
 * [60010, 60011]
 * and [Rmonth in [M,J] or Funding Year Level >=9]
 */
error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_18_TYPETest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	public function testValidType() {
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'true');
	}

	// 171
	// If TYPE=Null

	public function testTypeMandatory() {
		$this->student['TYPE'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'false');
	}

	// 172
	// If School Type in [30, 40] and TYPE not in [FF, AE, EX, AD, 
	// RA, RE, EM, SA, NA, NF, SF, TPREOM, TPRAOM, TPAD, 
	// TPRE, TPRAE]

	public function testTypeError172() {
		$this->school['school_type'] = '30';
		$this->student['TYPE'] = 'AA';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'false');
	}

	// 176
	// If TYPE in [AD, RA, TPAD, TPRAE, TPRAOM] and age is 
	// <19 on 1 Jan (t)

	public function testTypeError176() {
		$year = date('Y');
		$this->student['dob'] = $year . '-01-01';
		$this->student['TYPE'] = 'AD';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'false');
	}

	// 177a
	// If REASON=Null and ORS AND SECTION 9 = N and 
	// TYPE=RE and age at 1 Jan(t)>=19

	public function testTypeError177a() {
		$this->student['REASON'] = '';
		$this->student['ORS and Section 9'] = 'N';
		$this->student['TYPE'] = 'RE';
		$this->student['dob'] = '1980-01-01'; //Old student
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'false');
	}

	// 177b
	// If REASON=Null and TYPE in [TPRE, TPREOM] and age at 
	// 1 Jan(t)>=19

	public function testTypeError177b() {
		$this->student['REASON'] = '';
		$this->student['TYPE'] = 'TPRE';
		$this->student['dob'] = '1980-01-01';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'false');
	}

	// 179
	// If TYPE=NA and LAST ATTENDANCE>=1March year (t-1) 
	// and <1 March year (t) and REASON not NULL 

	public function testTypeError179() {
		$this->student['TYPE'] = 'NA';
		$year = date('Y') - 1;
		$student['LAST ATTENDANCE'] = $year . '-04-01';
		$this->student['REASON'] = 'S';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'false');
	}

	// 612
	// If ORS AND SECTION 9=N and School Type in [20, 21, 22] 
	// and TYPE not in [FF, EX, RE, EM, SA, NA,NF, SF]

	public function testTypeError612() {
		$this->student['ORS and Section 9'] = 'N';
		$this->school['school_type'] = '20';
		$this->student['TYPE'] = 'TPRE';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'false');
	}

	// 613
	// If School Type in [32, 34, 35] and TYPE not in Ministry 
	// code list for TYPE

	public function testTypeError613() {
		$this->school['school_type'] = '32';
		$this->student['TYPE'] = 'notatype';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'false');
	}

	// 614
	// If School Type=23 and TYPE not in [FF, AD, RA, RE, EM, 
	// NA, NF,SF]

	public function testTypeError614() {
		$this->school['school_type'] = '23';
		$this->student['TYPE'] = 'TPRE';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'false');
	}

	// 666
	// If Student Type = “NF” and Eligibility Criteria NOT in 
	// [60010, 60011] 
	// and [Rmonth in [M,J] or Funding Year Level >=9]

	public function testTypeError666() {
		$this->student['TYPE'] = 'NF';
		$this->student['ELIGIBILITY CRITERIA'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'false');
	}

	// 667
	// If Student Type is NOT “NF” and Eligibility Criteria in 
	// [60010, 60011]
	// and [Rmonth in [M,J] or Funding Year Level >=9]

	public function testTypeError667() {
		$this->student['TYPE'] = 'RE';
		$this->student['ELIGIBILITY CRITERIA'] = '60010';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'false');
	}
}