<?php
error_reporting(E_ALL);
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
require_once(dirname(__FILE__).'/StudentData.php');

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
		MOECodeSets::addSchool(array('school_id' => '1234', 'school_type'=>'20', 'enrollmentScheme'=>'false', 'enrollmentSchemeDate'=>''));
		MOECodeSets::addSchool(array('school_id' => '3338', 'school_type'=>'20', 'enrollmentScheme'=>'false', 'enrollmentSchemeDate'=>''));
	}

	private $student;

	//Reset the student data before each test method
	public function setUp() {
		$this->student = StudentData::getStudent();
	}

	//Naming the function testName allows it to be called by phpunit
	//(We could also use an annotation @test)
	public function testStudentId() {

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_2();
		$this->assertSame($valid, 'true');
		
	}



	public function testnsn() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_3();
		$this->assertSame($valid, 'true');
		
	}

	public function testlast_name() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'true');
		
	}

	public function testfirst_name() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_5();
		$this->assertSame($valid, 'true');
		
	}

	public function testGender() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_6();
		$this->assertSame($valid, 'true');
		
	}

	public function testDOB() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_7();
		$this->assertSame($valid, 'true');
		
	}



	public function testStartDateAtThisSchool() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_8();
		$this->assertSame($valid, 'true');
		
	}

	public function testStartDateAtAnySchool() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_9();
		$this->assertSame($valid, 'true');
		
	}

	public function testEthnicity1() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_10();
		$this->assertSame($valid, 'true');
		
	}

	public function testEthnicity2() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_11();
		$this->assertSame($valid, 'true');
		
	}

	public function testEthnicity3() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_12();
		$this->assertSame($valid, 'true');
		
	}

	public function testIWI1() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_13();
		$this->assertSame($valid, 'true');
		
	}

	public function testIWI2() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_14();
		$this->assertSame($valid, 'true');
		
	}

	public function testIWI3() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_15();
		$this->assertSame($valid, 'true');
		
	}

	public function testORRS() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_16();
		$this->assertSame($valid, 'true');
		
	}

	public function testFundingYearLevel() {
				
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_17();
		$this->assertSame($valid, 'true');
		
	}

	public function testStudentType() {
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_18();
		$this->assertSame($valid, 'true');
		
	}

	public function testPreviousSchool() {
		
		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_19();
		$this->assertSame($valid, 'true');
		
	}

	public function testSchoolName(){

		$schoolCodes = MOECodes::$schoolCodes;
		$valid = array_key_exists(MOECodeSets::$schools[3338]['school_id'], $schoolCodes);
		$this->assertSame($valid, true);

	}

	public function testZoningStatus(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_20();
		$this->assertSame($valid, 'true');

	}

	public function testCitizendship(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_21();
		$this->assertSame($valid, 'true');

	}


	public function testTuitionField(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_22();
		$this->assertSame($valid, 'true');

	}

	public function testFullTimeEquivalent(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_23();
		$this->assertSame($valid, 'true');

	}

	public function testMaoriLanhguageLevel(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_24();
		$this->assertSame($valid, 'true');

	}

	public function testLastAttendanceDate(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_25();
		$this->assertSame($valid, 'true');

	}

	public function testNZQ(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_26();
		$this->assertSame($valid, 'true');

	}

	public function testReasonForLeaving(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_27();
		$this->assertSame($valid, 'true');

	}

	public function testECE(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_28();
		$this->assertSame($valid, 'true');

	}

	public function testPacific(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_29();
		$this->assertSame($valid, 'true');

	}

	public function testPacificLang(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_30();
		$this->assertSame($valid, 'true');

	}

	public function testSubject1(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_31();
		$this->assertSame($valid, 'true');

	}

	public function testSubject2(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_35();
		$this->assertSame($valid, 'true');

	}

	public function testSubject3(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_39();
		$this->assertSame($valid, 'true');

	}

	public function testSubject4(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_43();
		$this->assertSame($valid, 'true');

	}

	public function testSubject5(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_47();
		$this->assertSame($valid, 'true');

	}

	public function testSubject6(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_51();
		$this->assertSame($valid, 'true');

	}	
	public function testSubject7(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_55();
		$this->assertSame($valid, 'true');

	}
	public function testSubject8(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_59();
		$this->assertSame($valid, 'true');

	}
	public function testSubject9(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_63();
		$this->assertSame($valid, 'true');

	}

	public function testSubject10(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_67();
		$this->assertSame($valid, 'true');

	}
	public function testSubject11(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_71();
		$this->assertSame($valid, 'true');

	}
	public function testSubject12(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_75();
		$this->assertSame($valid, 'true');

	}
	public function testSubject13(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_79();
		$this->assertSame($valid, 'true');

	}
	public function testSubject14(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_83();
		$this->assertSame($valid, 'true');

	}
	public function testSubject15(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_87();
		$this->assertSame($valid, 'true');

	}

	public function testSubject1Hours(){

		$moe = new MOEValidator($this->student, 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_33();
		$this->assertSame($valid, 'true');

	}

	public function testSubject2Hours(){

		$moe = new MOEValidator($this->student, 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_37();
		$this->assertSame($valid, 'true');


	}
	public function testSubject1Level(){

		$moe = new MOEValidator($this->student, 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_34();
		$this->assertSame($valid, 'true');
		

	}

	public function testNONNQF(){

		$moe = new MOEValidator($this->student, 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_92();
		$this->assertSame($valid, 'true');
		

	}

	public function testUniversityEntrance(){

		$moe = new MOEValidator($this->student, 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_93();
		$this->assertSame($valid, 'true');
		

	}

	public function testExchangeScheme(){

		$moe = new MOEValidator($this->student, 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_94();
		$this->assertSame($valid, 'true');
		

	}

	public function testBoardingStatus(){

		$moe = new MOEValidator($this->student, 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_95();
		$this->assertSame($valid, 'true');
		

	}
	public function testAddress1(){

		$moe = new MOEValidator($this->student, 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_96();
		$this->assertSame($valid, 'true');
		

	}

	public function testAddress2(){

		$moe = new MOEValidator($this->student, 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_97();
		$this->assertSame($valid, 'true');
		

	}

	public function testAddress3(){

		$moe = new MOEValidator($this->student, 'J', MOECodeSets::$schools[1234]);
		$valid = $moe->check_98();
		$this->assertSame($valid, 'true');
		

	}

	public function testAddress4(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_99();
		$this->assertSame($valid, 'true');
		

	}

	public function testEligibilityCriteria(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_100();
		$this->assertSame($valid, 'true');
		

	}

		public function testVerificationDocuments(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_101();
		$this->assertSame($valid, 'true');
		

	}

	public function testVerificationSerialNumber(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_102();
		$this->assertSame($valid, 'true');
		

	}

	public function testCurrentYearLevel(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_103();
		$this->assertSame($valid, 'true');
		

	}

	public function testPostSchoolActivity(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_104();
		$this->assertSame($valid, 'true');
		

	}

	public function testPrivacy(){

		$moe = new MOEValidator($this->student, 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_105();
		$this->assertSame($valid, 'true');
		

	}

	

}

?>