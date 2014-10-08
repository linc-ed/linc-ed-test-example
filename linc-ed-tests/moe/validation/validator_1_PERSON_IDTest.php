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
		MOECodeSets::addSchool(array('school_id' => '1234', 'school_type'=>'20', 'enrollmentScheme'=>'Y', 'enrollmentSchemeDate'=>''));
		MOECodeSets::addStudent(array
				('person_id'=>'2756',
			    'dob'=>'2003-02-28',
			    'start_date'=>'2014-02-04',
			    'gender'=>'M',
			    'first_name'=>'Sam',
			    'last_name'=>'Parkes',
			    'nsn'=>'132627179',
			    'sms_id'=>'0',
			    'vacated'=>'0',
			    'pid'=>'2756',
			    'field_2'=>'',
			    'field_3'=>'',
			    'field_4'=>'',
			    'field_5'=>'',
			    'field_6'=>'',
			    'field_7'=>'',
			    'field_8'=>'',
			    'field_9'=>'2014-03-04',
			    'field_10'=>'111',
			    'field_11'=>'',
			    'field_12'=>'',
			    'field_16'=>'',
			    'field_17'=>'6',
			    'field_18'=>'RE',
			    'field_19'=>'3451',
			    'field_20'=>'INZN',
			    'field_21'=>'NZL',
			    'field_22'=>'',
			    'field_23'=>'1',
			    'field_24'=>'N/A',
			    'field_26'=>'',
			    'field_27'=>'',
			    'field_28'=>'',
			    'field_29'=>'',
			    'field_30'=>'',
			    'field_31'=>'',
			    'field_32'=>'',
			    'field_33'=>'',
			    'field_34'=>'',
			    'field_35'=>'',
			    'field_36'=>'',
			    'field_37'=>'',
			    'field_38'=>'',
			    'field_39'=>'',
			    'field_40'=>'',
			    'field_41'=>'',
			    'field_42'=>'',
			    'field_43'=>'',
			    'field_44'=>'',
			    'field_45'=>'',
			    'field_46'=>'',
			    'field_47'=>'',
			    'field_48'=>'',
			    'field_49'=>'',
			    'field_50'=>'',
			    'field_51'=>'',
			    'field_52'=>'',
			    'field_53'=>'',
			    'field_54'=>'',
			    'field_55'=>'',
			    'field_56'=>'',
			    'field_57'=>'',
			    'field_58'=>'',
			    'field_59'=>'',
			    'field_60'=>'',
			    'field_61'=>'',
			    'field_62'=>'',
			    'field_63'=>'',
			    'field_64'=>'',
			    'field_65'=>'',
			    'field_66'=>'',
			    'field_67'=>'',
			    'field_68'=>'',
			    'field_69'=>'',
			    'field_70'=>'',
			    'field_71'=>'',
			    'field_72'=>'',
			    'field_73'=>'',
			    'field_74'=>'',
			    'field_75'=>'',
			    'field_76'=>'',
			    'field_77'=>'',
			    'field_78'=>'',
			    'field_79'=>'',
			    'field_80'=>'',
			    'field_81'=>'',
			    'field_82'=>'',
			    'field_83'=>'',
			    'field_84'=>'',
			    'field_85'=>'',
			    'field_86'=>'',
			    'field_87'=>'',
			    'field_88'=>'',
			    'field_89'=>'',
			    'field_90'=>'',
			    'field_91'=>'',
			    'field_92'=>'',
			    'field_93'=>'',
			    'field_94'=>'',
			    'field_95'=>'',
			    'field_96'=>'57 Weka Street',
			    'field_97'=>'Fendalton',
			    'field_98'=>'Christchurch',
			    'field_99'=>'',
			    'field_100'=>'',
			    'field_101'=>'',
			    'field_102'=>'',
			    'field_103'=>'6',
			    'field_104'=>'',
			    'field_106'=>'',
			    'field_107'=>'Sam',
			    'field_108'=>'Parkes',
			    'field_109'=>'',
			    'field_110'=>'',
			    'field_111'=>'',
			    'field_112'=>'3418515',
			    'field_113'=>'0274424418  call first',
			    'field_114'=>'',
			    'field_115'=>'dolcevita@xtra.co.nz',
			    'field_116'=>'Vincent',
			    'field_117'=>'Nicola',
			    'field_118'=>'',
			    'field_119'=>'',
			    'field_120'=>'',
			    'field_121'=>'',
			    'field_122'=>'',
			    'field_123'=>'0274424418',
			    'field_124'=>'',
			    'field_125'=>'',
			    'field_126'=>'',
			    'field_127'=>'',
			    'field_128'=>'',
			    'field_129'=>'',
			    'field_130'=>'',
			    'field_131'=>'',
			    'field_2000'=>'mother',
			    'field_2001'=>'',
			    'field_2002'=>'',
			    'field_2003'=>'',
			    'field_2004'=>'',
			    'field_2005'=>'yes',
			    'field_2006'=>'',
			    'field_2007'=>'',
			    'field_2008'=>'',
			    'field_2009'=>'',
			    'field_2010'=>'',
			    'field_2011'=>'',
			    'field_2012'=>'',
			    'field_2013'=>'',
			    'field_2014'=>'',
			    'field_2015'=>'',
			    'field_2016'=>'',
			    'field_2017'=>'',
			    'field_2018'=>'',
			    'field_2019'=>'',
			    'field_2020'=>'',
			    'field_2021'=>'',
			    'field_2022'=>'',
			    'field_2023'=>'',
			    'field_2024'=>'',
			    'field_2025'=>'',
			    'field_2026'=>'',
			    'field_2027'=>'dolcevita@xtra.co.nz',
			    'field_2028'=>'',
			    'field_2029'=>'',
			    'field_2030'=>'Yes',
			    'field_2031'=>'',
			    'field_2032'=>'',
			    'field_2033'=>'',
			    'field_2034'=>'',
			    'field_2035'=>'',
			    'field_2036'=>'',
			    'field_2037'=>'',
			    'field_2038'=>'',
			    'field_2039'=>'',
			    'field_2040'=>'',
			    'field_2041'=>'',
			    'field_2042'=>'',
			    'field_2043'=>'',
			    'field_2044'=>'')
);
			 
}

	//Naming the function testName allows it to be called by phpunit
	//(We could also use an annotation @test)

	//This test may be redundant - if the validator is allways passed
	//a string.
	public function testStudentId() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[2756], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_2();
		$this->assertSame($valid, 'true');
		
	}

	public function testnsn() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[2756], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_3();
		$this->assertSame($valid, 'true');
		
	}

	public function testlast_name() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[2756], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_4();
		$this->assertSame($valid, 'true');
		
	}

	public function testfirst_name() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[2756], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_5();
		$this->assertSame($valid, 'true');
		
	}

	public function testGender() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[2756], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_6();
		$this->assertSame($valid, 'true');
		
	}

	public function testDOB() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[2756], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_7();
		$this->assertSame($valid, 'true');
		
	}

	

	public function testStartDateAtThisSchool() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[2756], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_8();
		$this->assertSame($valid, 'true');
		
	}

	public function testStartDateAtAnySchool() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[2756], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_9();
		$this->assertSame($valid, 'true');
		
	}

	public function testEthnicity1() {
				
		
		$moe = new MOEValidator(MOECodeSets::$students[2756], 'M', MOECodeSets::$schools[1234]);
		$valid = $moe->check_10();
		$this->assertSame($valid, 'true');
		
	}





	
	
    

}

?>