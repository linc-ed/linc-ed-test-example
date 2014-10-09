<?php

/**
 * Our first test for the SCHOOL_ID field.
 * The specification describes that it is mandatory, and that
 * the school must be open. So we test that not setting the field,
 * setting the field to a non existant school, or setting the field
 * to a closed school all return false.
 */
date_default_timezone_set('Pacific/Auckland');
require_once(dirname(__FILE__).'/../../../moe/MOEValidateUpdated.php');
require_once(dirname(__FILE__).'/../../../moe/moe_test.php');
require_once(dirname(__FILE__).'/../../../moe/MOECodeSets.php');

function linc_popupmessage(){


}
function is_email(){

	
}
//Class can be named anything we like - but I prefer to mirror the filename 
class validator_1_PERSON_Test extends PHPUnit_Framework_TestCase {

	//This is a special PHPUnit function that is called before all these tests
	public static function setUpBeforeClass()
	{
		
		//Set up schools for validation
		//I'm inventing a structure here based on 
		//http://www.educationcounts.govt.nz/__data/assets/excel_doc/0007/145645/School-Name-and-Numbers-2014-01.xls
		MOECodeSets::addSchool(array('school_id' => '1234', 'school_type'=>'30', 'enrollmentScheme'=>'false', 'enrollmentSchemeDate'=>''));
		MOECodeSets::addSchool(array('school_id' => '3338', 'school_type'=>'30', 'enrollmentScheme'=>'false', 'enrollmentSchemeDate'=>''));
		MOECodeSets::addStudent(array
		(
    'person_id' => '353',
    'dob' => '2003-08-29',
    'start_date' => '2008-08-29',
    'gender' => 'Male',
    'first_name' => 'Jack',
    'last_name' => 'Harding',
    'nsn' => '132416486',
    'sms_id' => '866',
    'vacated' => '0',
    'pid' => '353',
    'first_schooling' => '2008-08-29',
    'ethnic_origin' => '111',
    'ethnic_origin2' => '0',
    'ethnic_origin3' => '',
    'ORS and Section 9' => '',
    'funding_year_level' => '10',
    'TYPE' => 'RE',
    'previous_school' => 'Unknown',
    'zoning' => '',
    'citizenship' => 'NZL',
    'FEE' => '',
    'FTE' => '1',
    'MAORI' => 'N/A',
    'LAST ATTENDANCE'=>'2011-09-09',
    'NQF QUAL' => '',
    'REASON' => 'H',
    'ECE' => '',
    'PACIFIC MEDIUM -LANGUAGE' => '',
    'PACIFIC MEDIUM - LEVEL' => '',
    'SUBJECT 1' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 1' => 'PHED',
    'HOURS PER YEAR SUBJECT 1' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 1' => '',
    'SUBJECT 2' => 'MATH',
    'MODE OF INSTRUCTION SUBJECT 2' => '',
    'HOURS PER YEAR SUBJECT 2' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 2' => '',
    'SUBJECT 3' => 'COSC',
    'MODE OF INSTRUCTION SUBJECT 3' => 'COSC',
    'HOURS PER YEAR SUBJECT 3' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 3' => '',
    'SUBJECT 4' => 'COSC',
    'MODE OF INSTRUCTION SUBJECT 4' => '',
    'HOURS PER YEAR SUBJECT 4' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 4' => '',
    'SUBJECT 5' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 5' => '',
    'HOURS PER YEAR SUBJECT 5' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 5' => '',
    'SUBJECT 6' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 6' => '',
    'HOURS PER YEAR SUBJECT 6' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 6' => '',
    'SUBJECT 7' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 7' => '',
    'HOURS PER YEAR SUBJECT 7' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 7' => '',
    'SUBJECT 8' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 8' => '',
    'HOURS PER YEAR SUBJECT 8' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 8' => '',
    'SUBJECT 9' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 9' => '',
    'HOURS PER YEAR SUBJECT 9' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 9' => '',
    'SUBJECT 10' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 10' => '',
    'HOURS PER YEAR SUBJECT 10' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 10' => '',
    'SUBJECT 11' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 11' => '',
    'HOURS PER YEAR SUBJECT 11' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 11' => '',
    'SUBJECT 12' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 12' => '',
    'HOURS PER YEAR SUBJECT 12' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 12' => '',
    'SUBJECT 13' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 13' => '',
    'HOURS PER YEAR SUBJECT 13' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 13' => '',
    'SUBJECT 14' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 14' => '',
    'HOURS PER YEAR SUBJECT 14' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 14' => '',
    'SUBJECT 15' => 'PHED',
    'MODE OF INSTRUCTION SUBJECT 15' => '',
    'HOURS PER YEAR SUBJECT 15' => '',
    'INSTRUCTIONAL YEAR LEVEL SUBJECT 15' => '',
    'TUITION WEEKS' => '',
    'NON-NQF QUAL' => '',
    'UE' => '',
    'EXCHANGE SCHEME' => '',
    'BOARDING STATUS' => '',
    'Address1' => '4 Heathfield Avenue',
    'Address2' => '',
    'Address3' => '8014',
    'Address4' => '',
    'ELIGIBILITY CRITERIA' => '',
    'VERIFICATION DOCUMENT' => '',
    'SERIAL NUMBER' => '',
    'current_year_level' => '6',
    'POST-SCHOOL ACTIVITY' => '',
    'middle_name' => '',
    'preferred_name' => 'Jack',
    'preferred_last_name' => '',
    'EXPIRY DATE' => '',
    'STP' => '',
    'WITHHOLD CONTACT DETAILS' => '',
    'Phone' => '3519654',
    'mobile_phone' => '0272821737',
    'ALTERNATIVE PHONE NUMBER' => '',
    'email_address' => 'ultimateforceltd@xtra.co.nz',
    'contact_1_last_name' => 'Harding',
    'contact_1_first_name' => 'Tracey',
    'contact_1_address1' => '4 Heathfield Avenue',
    'contact_1_address2' => 'Fendalton',
    'contact_1_address3' => 'Christchurch 8014',
    'contact_1_address4' => '',
    'contact_1_address5' => '',
    'contact_1_mobile' => '0272821737',
    'contact_2_last_name' => 'Harding',
    'contact_2_first_name' => 'Kevin',
    'contact_2_address1' => '4 Heathfield Avenue',
    'contact_2_address2' => 'Fendalton',
    'contact_2_address3' => 'Christchurch 8014',
    'contact_2_address4' => '',
    'contact_2_address5' => '',
    'contact_2_mobile' => '0275821737',
    'contact_1_type' => '',
    'contact_2_type' => 'father',
    'liveswith' => '',
    'caregiver_comment' => '',
    'access_arrangements' => '',
    'digital_safety' => 'Yes',
    'digital_comment' => '',
    'trip_permission_term_1' => '',
    'trip_permission_term_2' => '',
    'emergency1_first' => 'Alison',
    'emergency1_last' => 'Warren',
    'emergency1_phone' => '0',
    'emergency1_mobile' => '',
    'emergency2_first' => '',
    'emergency2_last' => '',
    'emergency2_phone' => '',
    'emergency2_mobile' => '',
    'medical_notes' => '',
    'medical_condition' => '',
    'medical_treatment' => '',
    'allergy' => '',
    'esol_number' => '',
    'critical_info' => '',
    'trip_permission_term_3' => '',
    'trip_permission_term_4' => '',
    'camp_permission' => '',
    'swimming_permission' => '',
    'contact_1_email' => 'ultimateforceltd@xtra.co.nz',
    'contact_2_email' => '0',
    'religious_education' => 'Yes',
    'trip_permission' => 'Yes',
    'immunisations' => '',
    'contact_3_email' => '',
    'contact_3_first_name' => '',
    'contact_3_last_name' => '',
    'contact_3_type' => '',
    'contact_3_address1' => '',
    'contact_3_address2' => '',
    'contact_3_address3' => '',
    'contact_3_address4' => '',
    'contact_3_address5' => '',
    'contact_3_phone' => '',
    'contact_3_mobile' => '',
    'emergency1_comment' => '',
    'emergency2_comment' => '' ));
			 
}

	//Naming the function testName allows it to be called by phpunit
	//(We could also use an annotation @test)

	//This test may be redundant - if the validator is allways passed
	//a string.
	public function testStudentId() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_2();
		$this->assertSame($valid, 'true');
		
	}

	public function testnsn() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_3();
		$this->assertSame($valid, 'true');
		
	}

	public function testlast_name() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'true');
		
	}

	public function testfirst_name() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_5();
		$this->assertSame($valid, 'true');
		
	}

	public function testGender() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_6();
		$this->assertSame($valid, 'true');
		
	}

	public function testDOB() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_7();
		$this->assertSame($valid, 'true');
		
	}



	public function testStartDateAtThisSchool() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_8();
		$this->assertSame($valid, 'true');
		
	}

	public function testStartDateAtAnySchool() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_9();
		$this->assertSame($valid, 'true');
		
	}

	public function testEthnicity1() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_10();
		$this->assertSame($valid, 'true');
		
	}

	public function testEthnicity2() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_11();
		$this->assertSame($valid, 'true');
		
	}

	public function testEthnicity3() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_12();
		$this->assertSame($valid, 'true');
		
	}

	public function testIWI1() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_13();
		$this->assertSame($valid, 'true');
		
	}

	public function testIWI2() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_14();
		$this->assertSame($valid, 'true');
		
	}

	public function testIWI3() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_15();
		$this->assertSame($valid, 'true');
		
	}

	public function testORRS() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_16();
		$this->assertSame($valid, 'true');
		
	}

	public function testFundingYearLevel() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'true');
		
	}

	public function testStudentType() {
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'true');
		
	}

	public function testPreviousSchool() {
		
		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_19();
		$this->assertSame($valid, 'true');
		
	}

	public function testSchoolName(){

		$schoolCodes = MOECodes::$schoolCodes;
		$valid = array_key_exists(MOECodeSets::$schools[3338]['school_id'], $schoolCodes);
		$this->assertSame($valid, true);

	}

	public function testZoningStatus(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_20();
		$this->assertSame($valid, 'true');

	}

	public function testCitizendship(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_21();
		$this->assertSame($valid, 'true');

	}


	public function testTuitionField(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_22();
		$this->assertSame($valid, 'true');

	}

	public function testFullTimeEquivalent(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_23();
		$this->assertSame($valid, 'true');

	}

	public function testMaoriLanhguageLevel(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_24();
		$this->assertSame($valid, 'true');

	}

	public function testLastAttendanceDate(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_25();
		$this->assertSame($valid, 'true');

	}

	public function testNZQ(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_26();
		$this->assertSame($valid, 'true');

	}

	public function testReasonForLeaving(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_27();
		$this->assertSame($valid, 'true');

	}

	public function testECE(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_28();
		$this->assertSame($valid, 'true');

	}

	public function testPacific(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_29();
		$this->assertSame($valid, 'true');

	}

	public function testPacificLang(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_30();
		$this->assertSame($valid, 'true');

	}

	public function testSubject1(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_31();
		$this->assertSame($valid, 'true');

	}

	public function testSubject2(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_35();
		$this->assertSame($valid, 'true');

	}

	public function testSubject3(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_39();
		$this->assertSame($valid, 'true');

	}

	public function testSubject4(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_43();
		$this->assertSame($valid, 'true');

	}

	public function testSubject5(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_47();
		$this->assertSame($valid, 'true');

	}

	public function testSubject6(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_51();
		$this->assertSame($valid, 'true');

	}	
	public function testSubject7(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_55();
		$this->assertSame($valid, 'true');

	}
	public function testSubject8(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_59();
		$this->assertSame($valid, 'true');

	}
	public function testSubject9(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_63();
		$this->assertSame($valid, 'true');

	}

	public function testSubject10(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_67();
		$this->assertSame($valid, 'true');

	}
	public function testSubject11(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_71();
		$this->assertSame($valid, 'true');

	}
	public function testSubject12(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_75();
		$this->assertSame($valid, 'true');

	}
	public function testSubject13(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_79();
		$this->assertSame($valid, 'true');

	}
	public function testSubject14(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_83();
		$this->assertSame($valid, 'true');

	}
	public function testSubject15(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_87();
		$this->assertSame($valid, 'true');

	}

	public function testSubject1Hours(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_33();
		$this->assertSame($valid, 'true');

	}

	public function testSubject2Hours(){

		$moe = new MOEValidator(MOECodeSets::$students[353], 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_37();
		$this->assertSame($valid, 'true');
		

	}

}

?>