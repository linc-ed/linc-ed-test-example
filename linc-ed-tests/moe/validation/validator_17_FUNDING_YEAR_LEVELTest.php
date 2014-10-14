<?php
/**
 * Field name: FUNDING YEAR LEVEL
 * Field number: 17
 *
 * Must be in controlled values list,
 * Mandatory
 *
 * Invalid if:
 * 
 * School Type in [23, 32, 34] and FUNDING YEAR LEVEL
 * not in [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
 *
 * If School Type in [20, 21] and REASON = Null and TYPE 
 * not equal to EM and FUNDING YEAR LEVEL>8 and 
 * Rmonth in [M,J]
 *
 * If age at 1 July(t)<=8 
 * and FUNDING YEAR LEVEL>=age–3
 *
 * If ORS and Section 9=N and Reason=Null and age at 1 
 * July(t) =>8 and <16 and FUNDING YEAR LEVEL < age –6
 * and [Rmonth in [M,J]
 *
 * If School Type=22 and FUNDING YEAR LEVEL not in [7,8] 
 * and Reason=Null
 * and [Rmonth in [M,J]]
 *
 * If School Type=30 and Type is not=EM and FUNDING
 * YEAR LEVEL<7
 *
 * If School Type=40 and Type is not =EM and FUNDING
 * YEAR LEVEL<9
 *
 * If School Type=35 and Type is not =EM and FUNDING
 * YEAR LEVEL<7 or >10 and Reason=Null
 *
 * If ORS AND SECTION 9=N and FUNDING YEAR LEVEL<9 
 * and age at 1 July (t)>=16 
 *
 * If ORS AND SECTION 9 = N and REASON = NULL and age 
 * at 1 July(t) <= 6 and FIRST_ATTENDANCE <= 1 July(t) 
 * and FIRST SCHOOLING > 1 July (t-1) and STUDENT TYPE 
 * in [‘RE’,’FF’,’EX’] and FUNDING YEAR LEVEL is NOT= 1
 * And Rmonth in [M,J]
 *
 * If ORS AND SECTION 9 = N and REASON = NULL and 
 * FIRST SCHOOLING <= 1 July (t-1) and STUDENT TYPE in 
 * [‘RE’,’FF’,’EX’] and FUNDING YEAR LEVEL < 2
 * and [Rmonth in [M,J] 
 *
 * If ORS AND SECTION 9 = N and REASON = NULL and (age 
 * at 1 July (t) – FUNDING YEAR LEVEL) < 2 and STUDENT 
 * TYPE in [‘RE’,’FF’,’EX’]
 * and [Rmonth in [M,J]
 *
 * If ORS AND SECTION 9 = N and REASON = NULL and age 
 * at July(t) < 17 and STUDENT TYPE in [‘RE’,’FF’,’EX’] and 
 *(age at 1 July (t) – FUNDING YEAR LEVEL) > 6 
 * and [Rmonth in [M,J] 
 *
 * If ORS AND SECTION 9 = N and REASON = NULL and 
 * School Type in (‘20’,’21’) and STUDENT TYPE in 
 * [‘RE’,’FF’,’EX’] and FUNDING YEAR LEVEL>6 and 
 * Reason=Null
 */
 error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/StudentData.php');
require_once(dirname(__FILE__).'/SchoolData.php');
require_once(dirname(__FILE__).'/functionStubs.php');

class validator_17_FUNDING_YEAR_LEVELTest extends PHPUnit_Framework_TestCase {

	private $student;
	private $school;

	//Reset the student and school data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
		$this->school = SchoolData::getSchool();
	}

	//Known valid funding_year_level
	public function testFundingYearLevel() {
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'true');
		
	}

	//Invalid cases:

	// School Type in [23, 32, 34] and FUNDING YEAR LEVEL
	// not in [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]

	public function testFundingYearError161() {
		$this->school['school_type'] = '23';
		$this->student['funding_year_level'] = '16';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}

	// If School Type in [20, 21] and REASON = Null and TYPE 
	// not equal to EM and FUNDING YEAR LEVEL>8 and 
	// Rmonth in [M,J]

	public function testFundingYearError162() {
		$this->school['school_type'] = '20';
		$this->student['REASON'] = '';
		$this->student['TYPE'] = 'RE';
		$this->student['funding_year_level'] = '9';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}


	// If age at 1 July(t)<=8 
	// and FUNDING YEAR LEVEL>=age–3

	public function testFundingYearError163() {
		$this->student['dob'] = '2015-01-01'; //very young student
		$this->student['funding_year_level'] = '8';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}

	// If ORS and Section 9=N and Reason=Null and age at 1 
	// July(t) =>8 and <16 and FUNDING YEAR LEVEL < age –6
	// and [Rmonth in [M,J]

	public function testFundingYearError164() {
		$this->student['ORS and Section 9'] = 'N';
		$this->student['REASON'] = '';
		$this->student['dob'] = '2003-01-01';
		$this->student['funding_year_level'] = '0';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
 	}

	// If School Type=22 and FUNDING YEAR LEVEL not in [7,8] 
	// and Reason=Null
	// and [Rmonth in [M,J]]

	public function testFundingYearError605() {
		$this->school['school_type'] = '22';
		$this->student['funding_year_level'] = '6';
		$this->student['REASON'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}

	// If School Type=30 and Type is not=EM and FUNDING
	// YEAR LEVEL<7

	public function testFundingYearError606() {
		$this->school['school_type'] = '30';
		$this->student['TYPE'] = 'RE';
		$this->student['funding_year_level'] = '6';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}


	// If School Type=40 and Type is not =EM and FUNDING
	// YEAR LEVEL<9

	public function testFundingYearError607() {
		$this->school['school_type'] = '40';
		$this->student['TYPE'] = 'RE';
		$this->student['funding_year_level'] = '8';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}

	// If School Type=35 and Type is not =EM and FUNDING
	// YEAR LEVEL<7 or >10 and Reason=Null

	public function testFundingYearError608() {
		$this->school['school_type'] = '35';
		$this->student['TYPE'] = 'RE';
		$this->student['REASON'] = '';
		$this->student['funding_year_level'] = '6';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');

		$this->student['funding_year_level'] = '11';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}

	// If ORS AND SECTION 9=N and FUNDING YEAR LEVEL<9 
	// and age at 1 July (t)>=16 

	public function testFundingYearError610() {
		$this->student['ORS and Section 9'] = 'N';
		$this->student['funding_year_level'] = '8';
		$this->student['dob'] = '1980-01-01'; // old student
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}

	// If ORS AND SECTION 9 = N and REASON = NULL and age 
	// at 1 July(t) <= 6 and FIRST_ATTENDANCE <= 1 July(t) 
	// and FIRST SCHOOLING > 1 July (t-1) and STUDENT TYPE 
	// in [‘RE’,’FF’,’EX’] and FUNDING YEAR LEVEL is NOT= 1
	// And Rmonth in [M,J]

	public function testFundingYearError675() {
		$this->student['ORS and Section 9'] = 'N';
		$this->student['REASON'] = '';
		$currentYear = date('Y');
		$birthYear = date('Y') - 5;
		$this->student['dob'] = $birthYear . '-01-01';
		$this->student['first_attendance'] = $currentYear . '-01-01';
		$this->student['first_schooling'] = $currentYear . '-01-01';
		$this->student['TYPE'] = 'RE';
		$this->student['funding_year_level'] = '2';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}

	// 
	// If ORS AND SECTION 9 = N and REASON = NULL and 
	// FIRST SCHOOLING <= 1 July (t-1) and STUDENT TYPE in 
	// [‘RE’,’FF’,’EX’] and FUNDING YEAR LEVEL < 2
	// and [Rmonth in [M,J] 

	public function testFundingYearError676() {
		$this->student['ORS and Section 9'] = 'N';
		$this->student['REASON'] = '';
		$lastYear = date('Y') - 1;
		$this->student['first_schooling'] = $lastYear .'-01-01';
		$this->student['TYPE'] = 'RE';
		$this->student['funding_year_level'] = '1';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}

	// If ORS AND SECTION 9 = N and REASON = NULL and (age 
	// at 1 July (t) – FUNDING YEAR LEVEL) < 2 and STUDENT 
	// TYPE in [‘RE’,’FF’,’EX’]
	// and [Rmonth in [M,J]

	public function testFundingYearError677() {
		$this->student['ORS and Section 9'] = 'N';
		$this->student['REASON'] = '';
		$birthYear = date('Y') - 10;
		$this->student['dob'] = $birthYear . '-01-01';
		$this->student['funding_year_level'] = '10';
		$this->student['TYPE'] = 'RE';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}

	// If ORS AND SECTION 9 = N and REASON = NULL and age 
	// at July(t) < 17 and STUDENT TYPE in [‘RE’,’FF’,’EX’] and 
	// (age at 1 July (t) – FUNDING YEAR LEVEL) > 6 
	// and [Rmonth in [M,J] 

	public function testFundingYearError678() {
		$this->student['ORS and Section 9'] = 'N';
		$this->student['REASON'] = '';
		$birthYear = date('Y') - 15;
		$this->student['dob'] = $birthYear . '-01-01';
		$this->student['funding_year_level'] = '3';
		$this->student['TYPE'] = 'RE';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}

	// If ORS AND SECTION 9 = N and REASON = NULL and 
	// School Type in (‘20’,’21’) and STUDENT TYPE in 
	// [‘RE’,’FF’,’EX’] and FUNDING YEAR LEVEL>6 and 
	// Reason=Null

	public function testFundingYearError679() {
		$this->student['ORS and Section 9'] = 'N';
		$this->student['REASON'] = '';
		$this->school['school_type'] = '20';
		$this->student['TYPE'] = 'RE';
		$this->student['funding_year_level'] = '9';
		$this->student['REASON'] = '';
		$moe = new MOEValidator($this->student, 'M', $this->school);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'false');
	}

	
}