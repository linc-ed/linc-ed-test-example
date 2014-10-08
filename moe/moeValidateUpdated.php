<?php 


//632 MOE File Header If Enrolment Scheme=Y and Date=00000000 Enrolment Scheme is inconsistent with the Effective Date 633 MOE File Header If Enrolment Scheme=N and Date not 00000000 Enrolment Scheme is inconsistent with the Effective Date
// duplicates in iwi and ethnicity

// 651 - duplicate nsn

class MOEValidator{
	

public $school_id ='';
public $school_type;
public $person_id;
public $nsn;
public $dob;
public $gender;
public $start_date;
public $first_name;
public $last_name;
public $vacated;
public $moe = array();
public $maori = 'false';
public $rmonth = 'M';
public $rollCountDate = '';
public $EnrolmentScheme ='';
public $EnrolmentSchemeDate ='';
public $ageOnReturnDate = '';
public $checkAgetoStart;
public $returnAgeOnJan01;
public $ageOnJuly1 = '';
public $codes = '';
public $mappedData;
	
	public function __construct($data, $rmonth, $school){
		
		$this->person_id = $data['person_id'];
		$this->nsn = $data['nsn'];
		$this->dob = $data['dob'];
		$this->start_date = $data['start_date'];
		$this->gender = $data['gender'];
		$this->first_name = $data['first_name'];
		$this->last_name = $data['last_name'];
		$this->vacated = $data['vacated'];
		
	
		$this->mappedData = $data;
		
		 
		$this->school_type =  $school['school_type'];	
		$this->EnrolmentScheme =  $school['enrolment_scheme'];
		$this->EnrolmentSchemeDate =  $school['enrolment_scheme_date'];
		$this->school_id =  $school['school_id'];	
		$this->rmonth = $rmonth;
		
		
		$this->codes = new MOECodes();
	
		switch ($this->rmonth){
		
		case "M";	
		$returnDate = date('Y')."-03-01";
		$this->rollCountDate == date("Y")."0301";
		break;
		case "J";	
		$returnDate = date('Y')."-07-01";
		
		$this->rollCountDate == date("Y")."0701";
		break;
		
		
		}
		
		// use the dob field (field number 7) to calculate age on the return date and on 1 July.
		
		$date = explode("-", $this->dob);
		
		$year =  $date[0];
		$month = $date[1];
		$day = $date[2];
		
		$date1 = explode("-", $returnDate);
		$year1 =  $date1[0];
		$month1 = $date1[1];
		$day1 = $date1[2];
	
		$date2 = explode("-", date('Y')."-07-01");
		$year2 =  $date2[0];
		$month2 = $date2[1];
		$day2 = $date2[2];
		
		$this->ageOnReturnDate =  floor((mktime(0, 0, 0,  $month1,  $day1, (int) $year1) - mktime(0, 0, 0, $month, $day, (int) $year)) / 31556952);
		
		$this->ageOnJuly1=  floor((mktime(0, 0, 0,  $month2,  $day2, (int) $year2) - mktime(0, 0, 0, $month, $day, (int) $year)) / 31556952);
		

			$date1 = new DateTime($this->dob);
			
			$date2 = new DateTime($this->mappedData['first_schooling']);
			
			$interval = $date1->diff($date2);
			
			$this->checkAgetoStart =  $interval->format('%a');
			$this->returnAgeOnJan01 =   floor((mktime(0, 0, 0,  01,  01,  (int) date('Y')) - mktime(0, 0, 0, $month, $day, (int) $year)) / 31556952);
	}
	
public function returnMappedData(){
		
		return $this->mappedData;
}

private function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
	
public function returnAgeOnDate($date){
		
		$date = explode("-", $this->dob);
		$year =  $date[0];
		$month = $date[1];
		$day = $date[2];
		
		$date1 = explode("-", $date);
		$year1 =  $date1[0];
		$month1 = $date1[1];
		$day1 = $date1[2];
	
		return floor((mktime(0, 0, 0,  $month1,  $day1, $year1) - mktime(0, 0, 0, $month, $day, $year)) / 31556952);
			
	}
		


	
public function validate(){
	

$this->check_2();
$this->check_3();
$this->check_4();
$this->check_5();
$this->check_6();
$this->check_7();
$this->check_8();
$this->check_9();
$this->check_10();
$this->check_11();
$this->check_12();
$this->check_13();
$this->check_14();
$this->check_15();
$this->check_16();
$this->check_17();
$this->check_18();
$this->check_19();
$this->check_20();
$this->check_21();
$this->check_22();
$this->check_23();
$this->check_24();
$this->check_25();
$this->check_26();
$this->check_27();
$this->check_28();
$this->check_29();
$this->check_30();

// If Rmonth=J and School Type not =23 and TYPE not in [AE, NA, SA, SF, TPRE, TPRAE] and Reason=Null and FTE=1 and FUNDING YEAR LEVEL>= 9 and ORS and Section 9 = N 
if (($this->school_type != "23" && !in_array($this->mappedData['TYPE'], array('AE', 'NA', 'SA', 'SF', 'TPRE', 'TPRAE')) && $this->mappedData['funding_year_level'] >=9 && $this->mappedData['ORS and Section 9']== "N")|| $this->test ==true ){ // RMONTH!!!
	
	
	if ( (is_null($this->mappedData['SUBJECT 1']) || $this->mappedData['SUBJECT 1'] == '0') &&
		(is_null($this->mappedData['SUBJECT 2']) || $this->mappedData['SUBJECT 2'] == '0') &&
		(is_null($this->mappedData['SUBJECT 3']) || $this->mappedData['SUBJECT 3'] == '0') &&
		(is_null($this->mappedData['SUBJECT 4']) || $this->mappedData['SUBJECT 4'] == '0') &&
		(is_null($this->mappedData['SUBJECT 5']) || $this->mappedData['SUBJECT 5'] == '0') &&
		(is_null($this->mappedData['SUBJECT 6']) || $this->mappedData['SUBJECT 6'] == '0') &&
		(is_null($this->mappedData['SUBJECT 7']) || $this->mappedData['SUBJECT 7'] == '0') &&
		(is_null($this->mappedData['SUBJECT 8']) || $this->mappedData['SUBJECT 8'] == '0') &&
		(is_null($this->mappedData['SUBJECT 9']) || $this->mappedData['SUBJECT 9'] == '0') &&
		(is_null($this->mappedData['SUBJECT 10']) || $this->mappedData['SUBJECT 10'] == '0') &&
		(is_null($this->mappedData['SUBJECT 11']) || $this->mappedData['SUBJECT 11'] == '0') &&
		(is_null($this->mappedData['SUBJECT 12']) || $this->mappedData['SUBJECT 12'] == '0') &&
		(is_null($this->mappedData['SUBJECT 13']) || $this->mappedData['SUBJECT 13'] == '0') &&
		(is_null($this->mappedData['SUBJECT 14']) || $this->mappedData['SUBJECT 14'] == '0') &&
		(is_null($this->mappedData['SUBJECT 15']) || $this->mappedData['SUBJECT 15'] == '0')	
		&& $this->test == false
	 ){
		 		$this->check_31();
					$this->moe[31]['valid'] = 'false';
					$this->moe[31]['value'] = '242 - Full-time student must have at least 1 subject';
	}
	else {
		
		
		
		$this->check_31();
		if ($this->moe[31]['valid']== 'true' || $this->test ==true){
			
				$this->check_32();
				$this->check_33();
				$this->check_34();
		}
		
		$this->check_35();
		if ($this->moe[35]['valid']== 'true' || $this->test ==true){
				$this->check_36();
				$this->check_37();
				$this->check_38();
			
		}
		
		$this->check_39();
		if ($this->moe[39]['valid']== 'true' || $this->test ==true){
		
				$this->check_40();
				$this->check_41();
				$this->check_42();
		}
		$this->check_43();
		if ($this->moe[43]['valid']== 'true' || $this->test ==true){
					$this->check_44();
					$this->check_45();
					$this->check_46();
		}
		$this->check_47();
		if ($this->moe[47]['valid']== 'true' || $this->test ==true){
					$this->check_48();
					$this->check_49();
					$this->check_50();
		}
		$this->check_51();
		if ($this->moe[51]['valid']== 'true' || $this->test ==true){
					$this->check_52();
					$this->check_53();
					$this->check_54();
		}
		$this->check_55();
		if ($this->moe[55]['valid']== 'true' || $this->test ==true){
					$this->check_56();
					$this->check_57();
					$this->check_58();
		}
		
		$this->check_59();
		if ($this->moe[59]['valid']== 'true' || $this->test ==true){
					$this->check_60();
					$this->check_61();
					$this->check_62();
		}
		$this->check_63();
		if ($this->moe[63]['valid']== 'true' || $this->test ==true){
					$this->check_64();
					$this->check_65();
					$this->check_66();
		}
		$this->check_67();
		if ($this->moe[67]['valid']== 'true' || $this->test ==true){
					$this->check_68();
					$this->check_69();
					$this->check_70();
		}
		$this->check_71();
		if ($this->moe[71]['valid']== 'true' || $this->test ==true){
					$this->check_72();
					$this->check_73();
					$this->check_74();
		}
		$this->check_75();
		if ($this->moe[75]['valid']== 'true' || $this->test ==true){
					$this->check_76();
					$this->check_77();
					$this->check_78();
		}
		$this->check_79();
		if ($this->moe[79]['valid']== 'true' || $this->test ==true){
					$this->check_80();
					$this->check_81();
					$this->check_82();
		}
		$this->check_83();
		if ($this->moe[83]['valid']== 'true' || $this->test ==true){
					$this->check_84();
					$this->check_85();
					$this->check_86();
		}
		$this->check_87();
		if ($this->moe[87]['valid']== 'true' || $this->test ==true){
					$this->check_88();
					$this->check_89();
					$this->check_90();
		}
	}
}

$this->check_91();
$this->check_92();
$this->check_93();
$this->check_94();
$this->check_95();
$this->check_96();
$this->check_97();
$this->check_98();
$this->check_99();
$this->check_100();
$this->check_101();
$this->check_102();
$this->check_103();
$this->check_104();
$this->check_105();
$this->check_106();
$this->check_107();
$this->check_108();
$this->check_109();
$this->check_110();
$this->check_111();
$this->check_112();
$this->check_113();
$this->check_114();
$this->check_115();
$this->check_116();
$this->check_117();
$this->check_118();
$this->check_119();
$this->check_120();
$this->check_121();
$this->check_122();
$this->check_123();
$this->check_124();
$this->check_125();
$this->check_126();
$this->check_127();
$this->check_128();
$this->check_129();
$this->check_130();
$this->check_131();
$this->check_all();


	return $this->moe;
		
}

public function check_2(){
	$number =2;
	$this->moe[2]=array("Field Name"=>"STUDENT_ID", "LINC Name"=>"person_id", "Field No"=>"2", "Description"=>"Student's ID Number","Mandatory"=>"YES","Type"=>""
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 

$data = $this->person_id;

if (!$this->test==true){
if (!isset($data)){
	
	$this->moe[2]['valid'] = 'false';
	$this->moe[2]['value'] = '602  - Student ID is missing for [Surname, First Name] '. $this->last_name.", ".$this->first_name;
	
	

	}
else {
	
	$this->moe[2]['valid'] = 'true';
	$this->moe[2]['value'] = $data;
		
}
}

return $this->moe[$number]['valid'] ;

}


public function check_3(){
	$number = 3;
		
$this->moe[$number]=array("Field Name"=>"NSN", "LINC Name"=>"NSN", "Field No"=>$number, "Field Label"=>"National Student Number",  "Content Type"=> 'corecontent', "Description"=>"Student's National Student Number","Mandatory"=>"YES","Type"=>"Numeric"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 


$data = $this->nsn;

		$correct="/^\d{10}$/";
		$missing = "/^\d{9}$/";
			if (preg_match($correct, $data)){
				if (ctype_digit($data)){
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
				}
				else {

					$this->moe[$number]['valid'] = 'false';
					$this->moe[$number]['value'] = $data;
				}
				
			}
			else if (preg_match($missing, $data)){
				
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = '0'.$data;
			}
		// If [RMonth in J] and NSN=NULL and LAST ATTENDANCE = NULL and TYPE not in [EM, NF]
		else if (in_array($this->rmonth, array('J')) && is_null($data) && is_null($this->mappedData['LAST ATTENDANCE']) && !in_array($this->mappedData['TYPE'], array("EM", "NF"))){
			
				$this->moe[$number]['valid'] = 'false';
			
				$this->moe[$number]['message'] = '668 - Warning - Record missing NSN';
		}
		else {
			$this->moe[$number]['valid'] = 'false';
			$this->moe[$number]['value'] = "631  - This student's NSN is incorrect";
			
		}
//If two or more students, with LAST ATTENDANCE=NULL, and Student TYPE not in [EM, NF] have the same NSN. 	Duplicate NSN : XXXXXXXXX 

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		if($GLOBALS['user_level']>8){
			$disabled = '';
	}
	else {
		$disabled = "disabled='disabled'";
			
	}
	
$this->moe[$number]['input_field'] = '<input '.$disabled.' type="number" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
								
	return $this->moe[$number]['valid'] ;							

}


public function check_4(){
	$number = 4;
	
	$this->moe[$number]=array("Field Name"=>"SURNAME", "LINC Name"=>"last_name", "ICON"=> "user-plus", "Field Label"=>"Last Name",  "Content Type"=> 'corecontent',  "Placeholder"=>"Last name...",  "Field No"=>"4", "Description"=>"Student's legal surname","Mandatory"=>"YES","Type"=>"ASCII plus macronised vowels"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 

$data = $this->last_name;

if (!isset($data)|| $data==''){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = "603 - Student ".$this->person_id." surname is missing";
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}


if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';

return $this->moe[$number]['valid'] ;

}


public function check_5(){
	
	$number = 5;
	
	$this->moe[$number]=array("Field Name"=>"FIRSTNAME", "ICON"=> "user-plus", "Field Label"=>"First Name", "Content Type"=> 'corecontent',  "Placeholder"=>"First name...",  "LINC Name"=>"first_name","Field No"=>$number, "Description"=>"Student's legal first name","Mandatory"=>"YES","Type"=>"ASCII plus macronised vowels"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 

$data = $this->first_name;

if (!isset($data)|| $data==''){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = "604 - Student with no first name";
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';

return $this->moe[$number]['valid'] ;

}


public function check_6(){
	$number = 6;
	$this->moe[$number]=array("Content Type"=> 'corecontent', "Field Name"=>"GENDER", "Field Label"=>"Gender",   "LINC Name"=>"gender", "Field No"=>$number, "Description"=>"Student's gender","Mandatory"=>"YES","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>'',
'options'=> array( array('value'=>'M', 'label'=>'Male'),
array('value'=>'F', 'label'=>'Female')
)
); 

$data = $this->gender;

if ($data == 'Male' || $data == 'M'){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = "M";
	
}
else if ($data == 'Female'|| $data == 'F'){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = "F";
		
	
}
else {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = "101 - Gender is not M or F";
	
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	$this->moe[$number]['input_field'] .= '<fieldset data-role="controlgroup"  data-theme="b" data-type="horizontal">';
						foreach ($this->moe[$number]['options'] as $option){
										
			$this->moe[$number]['input_field'] .= '<input data-theme="b" data-arraypos="'.$number.'" class="radioButton" type="radio" data-id="'.$this->person_id.'" data-value="'.$option['value'].'" name="'.$this->moe[$number]['LINC Name'].'" id="radio-'.$this->moe[$number]['LINC Name'].'-'.$option['value'].'" value="'.$option['value'].'"  ';
										if ($this->moe[$number]['value'] == $option['value']){
										$this->moe[$number]['input_field'] .= "checked='checked'";
										}
					$this->moe[$number]['input_field'] .= '/>';
					$this->moe[$number]['input_field'] .= '<label data-theme="b" for="radio-'.$this->moe[$number]['LINC Name'].'-'.$option['value'].'">'.$option ['label'].'</label>';
					
										
						}
										
				$this->moe[$number]['input_field'] .= '</fieldset>';
		
	return $this->moe[$number]['valid'] ;

}


public function check_7(){
	
	$number = 7;
	$this->moe[$number]=array("Content Type"=> 'corecontent',"ICON"=> "cake", "Field Name"=>"DOB", "Field Label"=>"Date of Birth",   "LINC Name"=>"dob", "Field No"=>$number, "Description"=>"Student's date of birth","Mandatory"=>"YES","Type"=>"Date"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 
$data = $this->dob;

if (isset($data)){
	


	$convert = date('Y-m-d', strtotime($data));
	
	$date = explode("-", $data);
		$year =  $date[0];
		$month = $date[1];
		$day = $date[2];
		$check = checkdate($month, $day, $year);
	if ($check){

		if( strtotime($data) > strtotime('now') ) {
				$this->moe[$number]['valid'] = 'false';
            $this->moe[$number]['value'] = 'Date of Birth cannot be later than today';
		}
		else {
			$this->moe[$number]['valid'] = 'true';
            $this->moe[$number]['value'] = $convert;
            }	
	}
		else {
			$this->moe[$number]['valid'] = 'false';
			$this->moe[$number]['value'] = "112 - Birth date format is incorrect";
		}
	
}

else {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = "111 - Date of Birth is missing";
	
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
		 if ($this->moe[$number]['value']){  
								 $d = date('Y-m-d', strtotime($this->moe[$number]['value']));
								 } else { 
								 $d='';
								 };
		
	$this->moe[$number]['input_field'] .= '<input class="'.$this->moe[$number]['Content Type'].'" name="'.$this->moe[$number]['LINC Name'].'"  type="date" data-role="datebox" value="'.$d.'" data-arraypos="'.$this->moe[$number]['Field No'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" >';
											
								
								
		return $this->moe[$number]['valid'] ;		

}


public function check_8(){
	$number = 8;
	
	$this->moe[$number]=array("Content Type"=> 'corecontent', "ICON"=> "calendar", "Field Name"=>"FIRST ATTENDANCE", "Field Label"=>"Date first attended this school", "LINC Name"=>"start_date", "Field No"=>$number, "Description"=>"Student's date of first attendance at the school","Mandatory"=>"YES","Type"=>"Date"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 

$data = $this->start_date;



$convert = date('Ymd', strtotime($data));
	
			if (isset($convert)){	
			
				 if (preg_match("/^\d{8}$/", $convert)) {
					 //IF FIRST ATTENDANCE is < FIRST SCHOOLING
					 	if (date('Ymd', strtotime($data)) < date('Ymd', strtotime($this->mappedData['FIRST SCHOOLING']))){
							$this->moe[$number]['valid'] = 'false';
							$this->moe[$number]['value'] = "642 - Student cannot have a first attendance date before first day at any school";
						}
						else {
							$this->moe[$number]['valid'] = 'true';
							$this->moe[$number]['value'] = date('Ymd', strtotime($data));
						}
						}
						else {
							
							$this->moe[$number]['valid'] = 'false';
							$this->moe[$number]['value'] = "122 - Format of date first attended this school is incorrect";
							
						}
					
				}
			else {
				
				$this->moe[$number]['valid'] = 'false';
				$this->moe[$number]['value'] = "121 - Date first attended at this school is missing";
				
		}
		
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
		 if ($this->moe[$number]['value']){  
								 $d = date('Y-m-d', strtotime($this->moe[$number]['value']));
								 } else { 
								 $d='';
								 };
		
	$this->moe[$number]['input_field'] .= '<input class="'.$this->moe[$number]['Content Type'].'" name="'.$this->moe[$number]['LINC Name'].'"  type="date" data-role="datebox" value="'.$d.'" data-arraypos="'.$this->moe[$number]['Field No'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" >';
											
				
return $this->moe[$number]['valid'] ;		

}


public function check_9(){
	
	$number = 9;

 
	$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"FIRST SCHOOLING", "Field Label"=>"First Schooling (usually their 5th birthday)" , "ICON"=>"calendar", "LINC Name"=>"first_schooling", "Field No"=>$number, "Description"=>"Date student first started schooling (usually their 5th birthday)","Mandatory"=>"for school types 20, 21, 32","Type"=>"Date"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 

//If School Type in [20, 21, 32] and FIRST SCHOOLING=<DOB + 4.9 years and [Rmonth in [M,J] or FUNDING YEAR LEVEL >=9] 132 - Student started before age 5

if (in_array($this->school_type, array(20,21,32)) ){

$data = $this->mappedData['first_schooling'];
$this->moe[$number]['Mandatory']="YES";
$convert = date('Ymd', strtotime($data));
	
	$year = date('Y', strtotime($data));
		if (isset($data) && $year> 2000){	
				
				 if (preg_match("/^\d{8}$/", $convert)) {
					 
					
							$weeks = round(($this->checkAgetoStart)/7,0); //total weeks since started school.
							if ($weeks < 254){
								$this->moe[$number]['valid'] = 'false';
							$this->moe[$number]['value'] = "132 - Student started before age 5";
								
							}
							else {
								$this->moe[$number]['valid'] = 'true';
								$this->moe[$number]['value'] = date('Ymd', strtotime($data));
								
							}
							
						}
						else {
							
							$this->moe[$number]['valid'] = 'false';
							$this->moe[$number]['value'] = "131 - FIRST SCHOOLING date format is incorrect";
							
						}
				}
			else {
				
				$this->moe[$number]['valid'] = 'false';
				$this->moe[$number]['value'] = date('Ymd', strtotime($data));
				$this->moe[$number]['message'] = "133 - Needs date first started school";
				
		}
	
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
		 if ($this->moe[$number]['value']){  
								 $d = date('Y-m-d', strtotime($this->moe[$number]['value']));
								 } else { 
								 $d='';
								 };
		
	$this->moe[$number]['input_field'] .= '<input class="'.$this->moe[$number]['Content Type'].'" name="'.$this->moe[$number]['LINC Name'].'"  type="date" data-role="datebox" value="'.$d.'" data-arraypos="'.$this->moe[$number]['Field No'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" >';
											
				

	}

	
return $this->moe[$number]['valid'] ;	

}


public function check_10(){
	$number = 10;
	$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"ETHNIC1", "Field Label"=>"Ethnicity 1", "LINC Name"=>"ethnic_origin", "Field No"=>$number, "Description"=>"Student's 1st ethnic group identified with","Mandatory"=>"YES","Type"=>"Controlled value code list"
, 'code'=>'ethnicity', 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 
$data = $this->mappedData['ethnic_origin'];
$array = $this->codes->ethnicityCodes();
if ($data >0){	
		
		if (in_array($data, array(111,121,122, 123 ,124 ,125 ,126, 127,128,129,211,311,321,331,341,351,361,371,411, 412,413,414,421,431,441,442,443,444,511,521, 531,611,999))){
			
			$this->moe[$number]['valid'] = 'true';
			$this->moe[$number]['value'] = $data;
			if ($code == 211 ){
				$this->maori = 'true';
			}		
		}
		
		else {
			$this->moe[$number]['valid'] = 'false';
			$this->moe[$number]['value'] = '142 - Ethnic code is incorrect';
		
		}
				


}
else {
	$this->moe[$number]['valid'] = 'false';
				$this->moe[$number]['value'] = "141 - Needs ethnic group";
				
}
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
$this->moe[$number]['input_field'] = '<select name="select-'.$this->moe[$number]['LINC Name'].'" id="select-'.$this->moe[$number]['LINC Name'].$this->person_id.'" data-native-menu="false" data-inline="true" data-icon="grid" data-theme="b" data-iconpos="left" class="optionMenu">';
					
			$this->moe[$number]['input_field'] .= '<option>'.$this->moe[$number]['Description'].'</option>';
					 
							   foreach ($array as $key=> $code){
									   
									$this->moe[$number]['input_field'] .= '<option ';
										if ($key == $this->moe[$number]['value'] ){
										
									$this->moe[$number]['input_field'] .= 'selected=selected';	
										}
										
			$this->moe[$number]['input_field'].= ' value="'.$key.'" data-arraypos="'.$this->moe[$number]['Field No'].'" data-id="'.$this->person_id.'" data-value="'.$key.'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'">'.$code.'</option>';	
								}
							
			$this->moe[$number]['input_field'] .= '</select>';	

return $this->moe[$number]['valid'] ;

}


public function check_11(){
	
	$data = $this->mappedData['ethnic_origin2'];
	
$number = 11;
	
	$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"ETHNIC2",  "Field Label"=>"Ethnicity 2", "LINC Name"=>"ethnic_origin2", "Field No"=>$number, "Description"=>"Students can select up to three ethnicities, however only one is required.","Mandatory"=>"NO","Type"=>"Controlled value code list"
, 'valid'=>'','code'=>'ethnicity',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 


		$array = $this->codes->ethnicityCodes();

		if ($data=='' || $data==0){

			$this->moe[$number]['valid'] = 'true';
			$this->moe[$number]['value'] = '';
		}
		else { // field is not blank so must be checked for validity
		
				if (in_array($data, array(111,121,122, 123 ,124 ,125 ,126, 127,128,129,211,311,321,331,341,351,361,371,411, 412,413,414,421,431,441,442,443,444,511,521, 531,611,999))){
					
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
						
						if ($code == 211 ){
							$this->maori = 'true';
					}	
				}
				
				else {
					$this->moe[$number]['valid'] = 'false';
					$this->moe[$number]['value'] = '142 - Ethnic code is incorrect';
				
				}
	}	
				
	if ($this->moe[$number]['valid']=='false'){
			if ($this->moe[$number]['Mandatory']=="YES"){
				$warning = 'warning-2';	
			}
			else {
				$warning = 'warning';	
			}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
$this->moe[$number]['input_field'] = '<select name="select-'.$this->moe[$number]['LINC Name'].'" id="select-'.$this->moe[$number]['LINC Name'].$this->person_id.'" data-native-menu="false" data-inline="true" data-icon="grid" data-theme="b" data-iconpos="left" class="optionMenu">';
					
			$this->moe[$number]['input_field'] .= '<option>'.$this->moe[$number]['Description'].'</option>';
					 
							   foreach ($array as $key=> $code){
									   
									$this->moe[$number]['input_field'] .= '<option ';
										if ($key == $this->moe[$number]['value'] ){
										
									$this->moe[$number]['input_field'] .= 'selected=selected';	
										}
										
			$this->moe[$number]['input_field'].= ' value="'.$key.'" data-arraypos="'.$this->moe[$number]['Field No'].'" data-id="'.$this->person_id.'" data-value="'.$key.'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'">'.$code.'</option>';	
								}
							
			$this->moe[$number]['input_field'] .= '</select>';	

			return $this->moe[$number]['valid'] ;
}


public function check_12(){
	$data = $this->mappedData['ethnic_origin3'];
	
	$number=12;
		$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"ETHNIC3",  "Field Label"=>"Ethnicity 3", "LINC Name"=>"ethnic_origin3", "Field No"=>$number, "Description"=>"Students can select up to three ethnicities, however only one is required.","Mandatory"=>"NO","Type"=>"Controlled value code list"
, 'valid'=>'','code'=>'ethnicity',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$array = $this->codes->ethnicityCodes();
	
		if ($data=='' || $data==0){

			$this->moe[$number]['valid'] = 'true';
			$this->moe[$number]['value'] = '';
		}
		else { // field is not blank so must be checked for validity
		
				if (in_array($data, array(111,121,122, 123 ,124 ,125 ,126, 127,128,129,211,311,321,331,341,351,361,371,411, 412,413,414,421,431,441,442,443,444,511,521, 531,611,999))){
					
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
						
						if ($code == 211 ){
							$this->maori = 'true';
					}	
				}
				
				else {
					$this->moe[$number]['valid'] = 'false';
					$this->moe[$number]['value'] = '142 - Ethnic code is incorrect';
				
				}
	}	
				
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
$this->moe[$number]['input_field'] = '<select name="select-'.$this->moe[$number]['LINC Name'].'" id="select-'.$this->moe[$number]['LINC Name'].$this->person_id.'" data-native-menu="false" data-inline="true" data-icon="grid" data-theme="b" data-iconpos="left" class="optionMenu">';
					
			$this->moe[$number]['input_field'] .= '<option>'.$this->moe[$number]['Description'].'</option>';
					 
							   foreach ($array as $key=> $code){
									   
									$this->moe[$number]['input_field'] .= '<option ';
										if ($key == $this->moe[$number]['value'] ){
										
									$this->moe[$number]['input_field'] .= 'selected=selected';	
										}
										
			$this->moe[$number]['input_field'].= ' value="'.$key.'" data-arraypos="'.$this->moe[$number]['Field No'].'" data-id="'.$this->person_id.'" data-value="'.$key.'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'">'.$code.'</option>';	
								}
							
			$this->moe[$number]['input_field'] .= '</select>';	
	
return $this->moe[$number]['valid'] ;

 }


public function check_13(){
		

		if ($this->maori == 'true' ||$this->mappedData['ethnic_origin']==211 ){
			
					$data = $this->mappedData['IWI1'];
					$iwi_codes = $this->codes->iwi_codes();
				
					$number=13;
				$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"IWI1", "LINC Name"=>"IWI1", "Field No"=>$number, "Field Label"=>"Student's 1st Iwi affiliation","Description"=>"Student's 1st Iwi affiliation", "Mandatory"=>"YES","Type"=>"Controlled value code list"
			, 'valid'=>'',
			'value' =>'', 'message' =>'',
			'input_field'=>'',
			'input_label'=>''
			); 
			
	if ($this->codes->checkKey($data, $this->codes->iwi_codes())){
				
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
		
			}
			else {
				//Value is not Null and not in Ministry code list and [Rmonth in [M,J] or Funding Year Level >=9]

						if  (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9) {
							$this->moe[$number]['valid'] = 'false';
							$this->moe[$number]['value'] = '500 - Iwi code value is not in Ministry code list';
						}
						else {
									if  (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9) {
											$this->moe[$number]['valid'] = 'false';
											$this->moe[$number]['value'] = '501 - Māori student who first attended > 1 Jan 2003 must have valid Iwi code in first Iwi field	';
									}
					
					}
		}
		
	
					
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['value']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
$this->moe[$number]['input_field'] = '<select name="select-'.$this->moe[$number]['LINC Name'].'" id="select-'.$this->moe[$number]['LINC Name'].$this->person_id.'" data-native-menu="false" data-inline="true" data-icon="grid" data-theme="b" data-iconpos="left" class="optionMenu">';
					
			$this->moe[$number]['input_field'] .= '<option>'.$this->moe[$number]['Description'].'</option>';
					 
							   foreach ( $iwi_codes as $key=> $code){
									   
									$this->moe[$number]['input_field'] .= '<option ';
										if ($key == $this->moe[$number]['value'] ){
										
											$this->moe[$number]['input_field'] .= 'selected=selected';	
										}
										
			$this->moe[$number]['input_field'].= ' value="'.$key.'" data-arraypos="'.$this->moe[$number]['Field No'].'" data-id="'.$this->person_id.'" data-value="'.$key.'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'">'.$code.'</option>';	
								}
							
			$this->moe[$number]['input_field'] .= '</select>';	
			return $this->moe[$number]['valid'] ;
}
else {
	return 'true' ; // child is not recorded as being NZ Maori so this field is not required. So testing needs to show as 'true'
}	
}

public function check_14(){
		if ($this->maori == 'true' ||$this->mappedData['ethnic_origin']==211 ){
			
					$data = $this->mappedData['IWI2'];
					$iwi_codes = $this->codes->iwi_codes();
				
					$number=14;
				$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"IWI2", "LINC Name"=>"IWI2", "Field No"=>$number, "Field Label"=>"Student's 2nd Iwi affiliation","Description"=>"Student's 2nd Iwi affiliation", "Mandatory"=>"No","Type"=>"Controlled value code list"
			, 'valid'=>'',
			'value' =>'', 'message' =>'',
			'input_field'=>'',
			'input_label'=>''
			); 
			
	if ($this->codes->checkKey($data, $this->codes->iwi_codes())){
				
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
		
			}
			else {
				//Value is not Null and not in Ministry code list and [Rmonth in [M,J] or Funding Year Level >=9]
						if  (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9) {
							$this->moe[$number]['valid'] = 'false';
							$this->moe[$number]['value'] = '500 - Iwi code value is not in Ministry code list';
						}
						else {
									if  (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9) {
											$this->moe[$number]['valid'] = 'false';
											$this->moe[$number]['value'] = '501 - Māori student who first attended > 1 Jan 2003 must have valid Iwi code in first Iwi field	';
									}
					
					}
		}
		
	
					
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['value']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
$this->moe[$number]['input_field'] = '<select name="select-'.$this->moe[$number]['LINC Name'].'" id="select-'.$this->moe[$number]['LINC Name'].$this->person_id.'" data-native-menu="false" data-inline="true" data-icon="grid" data-theme="b" data-iconpos="left" class="optionMenu">';
					
			$this->moe[$number]['input_field'] .= '<option>'.$this->moe[$number]['Description'].'</option>';
					 
							   foreach ( $iwi_codes as $key=> $code){
									   
									$this->moe[$number]['input_field'] .= '<option ';
										if ($key == $this->moe[$number]['value'] ){
										
											$this->moe[$number]['input_field'] .= 'selected=selected';	
										}
										
			$this->moe[$number]['input_field'].= ' value="'.$key.'" data-arraypos="'.$this->moe[$number]['Field No'].'" data-id="'.$this->person_id.'" data-value="'.$key.'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'">'.$code.'</option>';	
								}
							
			$this->moe[$number]['input_field'] .= '</select>';	
return $this->moe[$number]['valid'] ;
}
else {
	return 'true' ; // child is not recorded as being NZ Maori so this field is not required. So testing needs to show as 'true'
}	
	
}

public function check_15(){
		if ($this->maori == 'true' ||$this->mappedData['ethnic_origin']==211 ){
			
					$data = $this->mappedData['IWI3'];
					$iwi_codes = $this->codes->iwi_codes();
				
					$number=15;
				$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"IWI3", "LINC Name"=>"IWI3", "Field No"=>$number, "Field Label"=>"Student's 3rd Iwi affiliation","Description"=>"Student's 3rd Iwi affiliation", "Mandatory"=>"No","Type"=>"Controlled value code list"
			, 'valid'=>'',
			'value' =>'', 'message' =>'',
			'input_field'=>'',
			'input_label'=>''
			); 
			
	if ($this->codes->checkKey($data, $this->codes->iwi_codes())){
				
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
		
			}
			else {
				//Value is not Null and not in Ministry code list and [Rmonth in [M,J] or Funding Year Level >=9]
						if  (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9) {
							$this->moe[$number]['valid'] = 'false';
							$this->moe[$number]['value'] = '500 - Iwi code value is not in Ministry code list';
						}
						else {
									if  (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9) {
											$this->moe[$number]['valid'] = 'false';
											$this->moe[$number]['value'] = '501 - Māori student who first attended > 1 Jan 2003 must have valid Iwi code in first Iwi field	';
									}
					
					}
		}
		
	
					
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['value']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
$this->moe[$number]['input_field'] = '<select name="select-'.$this->moe[$number]['LINC Name'].'" id="select-'.$this->moe[$number]['LINC Name'].$this->person_id.'" data-native-menu="false" data-inline="true" data-icon="grid" data-theme="b" data-iconpos="left" class="optionMenu">';
					
			$this->moe[$number]['input_field'] .= '<option>'.$this->moe[$number]['Description'].'</option>';
					 
							   foreach ( $iwi_codes as $key=> $code){
									   
									$this->moe[$number]['input_field'] .= '<option ';
										if ($key == $this->moe[$number]['value'] ){
										
											$this->moe[$number]['input_field'] .= 'selected=selected';	
										}
										
			$this->moe[$number]['input_field'].= ' value="'.$key.'" data-arraypos="'.$this->moe[$number]['Field No'].'" data-id="'.$this->person_id.'" data-value="'.$key.'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'">'.$code.'</option>';	
								}
							
			$this->moe[$number]['input_field'] .= '</select>';	

return $this->moe[$number]['valid'] ;
}
else {
	return 'true' ; // child is not recorded as being NZ Maori so this field is not required. So testing needs to show as 'true'
}	
	
}


public function check_16(){
	
	$number=16;
	$this->moe[16]=array("Content Type"=> 'metacontent', "Field Name"=>"ORS and Section 9", "LINC Name"=>"ORS and Section 9", "Field No"=>"16", "Description"=>"Level of resources required for students with a Section 9 Agreement","Mandatory"=>"YES","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 

$data = $this->mappedData[$this->moe[16]['LINC Name']];

// Value not in [N, H, V, S] and [Rmonth in [M,J] or Funding Year Level >=9]


if ($data && !in_array($data, array('N', 'H', 'V', 'S'))){
	$this->moe[16]['valid'] = 'false';
	$this->moe[16]['value'] = "151 - ORS and Section 9 code is incorrect";
}
else {
	
	$this->moe[16]['valid'] = 'true';
	$this->moe[16]['value'] = $data;
	
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';	

return $this->moe[$number]['valid'];

}


public function check_17(){
	$number = 17;
	$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"FUNDING YEAR LEVEL", "LINC Name"=>"funding_year_level", "Field Label"=>"Funding Year Level", "Content Type"=> 'metacontent',	"Field No"=>$number, "Description"=>"The actual number of years that the student has attended a school.","Mandatory"=>"YES","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 


$data = $this->mappedData[$this->moe[$number]['LINC Name']];
$array =array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);

if (isset($data) && !is_null($data) && $data !='' && in_array($data, array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15)) && is_numeric($data)){
	
	


			if (in_array($this->school_type, array(23, 32, 34)) && !in_array($data, $array)){
				
					$this->moe[$number]['valid'] = 'false';
					$this->moe[$number]['value'] = '161 - Funding Year Level is incorrect';
				
			}
			//If School Type in [20, 21] and REASON = Null and TYPE not equal to EM and FUNDING YEAR LEVEL>8 and Rmonth in [M,J]
			else if (in_array($this->school_type, array(20, 21)) && $data>8 && $this->mappedData['TYPE'] != 'EM' && $this->mappedData['REASON'] ==''){
				
				$this->moe[$number]['valid'] = 'false';
					$this->moe[$number]['value'] = '162 - Funding Year Level is inconsistent with primary school';
				
			}
			//If School Type=22 and FUNDING YEAR LEVEL not in [7,8] and Reason=Null and [Rmonth in [M,J]]
			else if (in_array($this->school_type, array(22)) && !in_array($data, array('7','8')) &&  $this->mappedData['REASON'] =='' && in_array($this->rmonth, array('M', 'J'))){
				
					$this->moe[$number]['valid'] = 'false';
					$this->moe[$number]['value'] = '605 - Funding Year Level must be 7 or 8 for a student in an intermediate school';
				
			}
			
			
			//If School Type=30 and Type is not=EM and FUNDING YEAR LEVEL<7
			else if (in_array($this->school_type, array(30)) && $data<7 && $this->mappedData['TYPE'] != 'EM' ){
				
					$this->moe[$number]['valid'] = 'false';
					$this->moe[$number]['value'] = '606 - Funding Year Level must be between 7 and 15 inclusive for this school type.';
				
			}
			
			//If School Type=40 and Type is not =EM and FUNDING YEAR LEVEL<9
			else if (in_array($this->school_type, array(40)) && $data<9 && $this->mappedData['TYPE'] != 'EM' ){
				
					$this->moe[$number]['valid'] = 'false';
					$this->moe[$number]['value'] = '607 - Funding Year Level must be between 9 and 15 inclusive for this school type.';
				
			}
			//If School Type=35 and Type is not =EM and FUNDING YEAR LEVEL<7 or >10 and Reason=Null
			else if (in_array($this->school_type, array(35)) && ($data<7 || $data>10) && $this->mappedData['TYPE'] != 'EM' && is_null($this->mappedData['REASON'])){
				
					$this->moe[$number]['valid'] = 'false';
					$this->moe[$number]['value'] = '608 - Funding Year Level must be between 7 and 10 inclusive for this school type.';
				
			}
			// If ORS and Section 9=N and FUNDING YEAR LEVEL<9 and age at 1 July (t)>=16
			else if ( $data<0 && $this->mappedData['ORS and Section 9'] == 'N' && $this->ageOnJuly1 == 16){
				
					$this->moe[$number]['valid'] = 'false';
					$this->moe[$number]['value'] = '610 - Student aged 16 or older must have Funding Year Level of Year 9 or above';
					$this->moe[$number]['message'] = '610 - Student aged 16 or older must have Funding Year Level of Year 9 or above';
				
			}
			//If FUNDING YEAR LEVEL=6 and age at 1 July(t) <=9 and Rmonth in [M,J]
			else if ($data==6 && in_array($this->rmonth, array('M', 'J')) && $this->ageOnJuly1 <=9){
				
					$this->moe[$number]['valid'] = 'false';
					$this->moe[$number]['value'] = $data;
				$this->moe[$number]['message'] = '611 - Student is too young for Year 6. Either Funding Year Level or DOB is incorrect';
			}
			
			// If ORS and Section 9=N and REASON = NULL and TYPE not in [AD,RA,FF,TPRAOM,TPAD] and age at 1 July(t)>=16 and FUNDING YEAR LEVEL<age at 1 July(t)-6
			else if ($this->mappedData['ORS and Section 9']== "N" && is_null($this->mappedData['REASON']) && !in_array($this->mappedData['TYPE'], array('AD','RA','FF','TPRAOM','TPAD')) && $data < $this->ageOnJuly1-6 ){
				
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
					$this->moe[$number]['message'] = '165 - Warning - Funding Year Level may not correspond with age';
				
			}
			// If FUNDING YEAR LEVEL>8 and REASON = NULL and age at 1 July(t) <[FUNDING YEAR LEVEL+2]
			else if (is_null($this->mappedData['REASON']) && $data > 8 && $this->ageOnReturnDate < $data+2 ){
				
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
					$this->moe[$number]['message'] = '166 - Warning - Funding Year Level may not correspond with age';
				
			}
			// If FUNDING YEAR LEVEL=0 and [Rmonth in [M,J]]
			else if ($data == 0  && in_array($this->rmonth, array("M", "J")) ){
				
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
					$this->moe[$number]['message'] = '168 - Students with Funding Year Level = 0 will not be counted on the roll return';
				
			}
			// If ORS AND SECTION 9=N and REASON = NULL and age at 1 July(t) in [14,15] and FUNDING YEAR LEVEL in [7,8]
				else if ( $this->mappedData['ORS and Section 9']== "N" && is_null($this->mappedData['REASON']) && in_array($data, array("7","8")) && in_array($this->ageOnJuly1, array("14", "15")) ){
				
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
					$this->moe[$number]['message'] = '618 - Student aged ['.$this->ageOnJuly1.'] with Funding Year Level ['.$data.']. Check date of birth and Funding Year Level';
				
			}
			// If ORS AND SECTION 9=N and REASON = NULL and TYPE not in [AD, RA, FF, NF, TPRAOM, TPAD] and FUNDING YEAR LEVEL is between 8 and 13 (inclusive) and age at 1 July(t)>[FUNDING YEAR LEVEL + 6]
			else if ( $this->mappedData['ORS and Section 9']== "N" && is_null($this->mappedData['REASON']) && $data >=8 && $data <=13 && $this->ageOnJuly1> $data+6 && !in_array($this->mappedData['TYPE'], array('AD', 'RA', 'FF', 'NF', 'TPRAOM', 'TPAD')) ){
				
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
					$this->moe[$number]['message'] = '619 - Student aged ['.$this->ageOnJuly1.'] with Funding Year Level ['.$data.']. Check date of birth and Funding Year Level';
				
			}
			// If ORS AND SECTION 9=N and REASON is not NULL and TYPE not in [AD, RA, FF, NF, TPRAOM, TPAD] and FUNDING YEAR LEVEL is between 9 and 14 (inclusive) and age at 1 July (t-1) > [FUNDING YEAR LEVEL + 6]
			else if ( $this->mappedData['ORS and Section 9']== "N" && is_null($this->mappedData['REASON']) && $data >=9 && $data <=14 && $this->ageOnJuly1> $data+6 && !in_array($this->mappedData['TYPE'], array('AD', 'RA', 'FF', 'NF', 'TPRAOM', 'TPAD')) ){
				
					$this->moe[$number]['valid'] = 'true';
					$this->moe[$number]['value'] = $data;
					$this->moe[$number]['message'] = '641 - School Leaver aged ['.$this->ageOnJuly1.'] with Funding Year Level ['. $data.']. Check Funding Year Level and date of birth.';
				
			}
			
			else {
				
				$this->moe[$number]['valid'] = 'true';
				$this->moe[$number]['value'] = $data;
			}
}

else {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Funding Level is missing' ;
	
}
	
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		

$this->moe[$number]['input_field'] = '<form>
    <div data-role="fieldcontain" class="ui-hide-label">
        <input data-theme="b" type="range"data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" class="'.$this->moe[$number]['Content Type'].'"  min="0" max="15" >
    </div>
</form>';


return $this->moe[$number]['valid'];


}


public function check_18(){
	$number = 18;
$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"TYPE", "LINC Name"=>"TYPE", "Field Label"=>"Student Type", "ICON" =>"vcard","Field No"=>"18", "Description"=>"Student Type for funding purposes","Mandatory"=>"YES","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 

$data = $this->mappedData[$this->moe[$number]['LINC Name']];
$array = 	array('FF'=>'FF', 'AE'=>'AE', 'EX'=>'EX', 'AD'=>'AD', 'RA'=>'RA', 'RE'=>'RE', 'EM'=>'EM', 'SA'=>'SA', 'NA'=>'NA', 'NF'=>'NF', 'SF'=>'SF', 'TPREOM'=>'TPREOM', 'TPRAOM'=>'TPRAOM', 'TPAD'=>'TPAD', 'TPRE'=>'TPRE', 'TPRAE'=>'TPRAE'	);

if (isset($data) && !is_null($data)){
	
	//If School Type in [30, 40] and TYPE not in [FF, AE, EX, AD, RA, RE, EM, SA, NA, NF, SF, TPREOM, TPRAOM, TPAD, TPRE, TPRAE]
	if (in_array($this->school_type, array(30, 40)) && !in_array($data, array('FF', 'AE', 'EX', 'AD', 'RA', 'RE', 'EM', 'SA', 'NA', 'NF', 'SF', 'TPREOM', 'TPRAOM', 'TPAD', 'TPRE', 'TPRAE'))){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '172 - Student type is incorrect for this school type';	
	}
	//If TYPE in [AD, RA, TPAD, TPRAE, TPRAOM] and age is <19 on 1 Jan (t)
	
	else if ( in_array($data, array('AD', 'RA', 'TPAD', 'TPRAE', 'TPRAOM')) && $this->returnAgeOnJan01 <19){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '176 - Adult must be older than 19 at 1 January of this year';	
	}
	//If REASON=Null and ORS AND SECTION 9 = N and TYPE=RE and age at 1 Jan(t)>=19.
	else if ( $data =='RE' && $this->returnAgeOnJan01 >=19 && is_null($this->mappedData['REASON']) && $this->mappedData['ORS AND SECTION 9'] == 'N'){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '177(a) - Should be coded as an Adult';	
	}
	//If REASON=Null and TYPE in [TPRE, TPREOM] and age at 1 Jan(t)>=19.
	else if ( in_array($data, array('TPRE', 'TPREOM')) && $this->returnAgeOnJan01 >=19 && is_null($this->mappedData['REASON']) ){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '177(b) - Should be coded as Teen Parent Adult eligible and enrolled (TPRAE) or Teen Parent Adult over max roll (TPRAOM)';	
	}
	//If TYPE=NA and LAST ATTENDANCE>=1March year (t-1) and <1 March year (t) and REASON not NULL
		else if ( $data =='NA' && !is_null($this->mappedData['REASON']) && $this->mappedData['LAST ATTENDANCE'] ){ //INCOMPLETE.
	$this->moe[$number]['valid'] = 'false'; 
	$this->moe[$number]['value'] = '179 -Type of Student "Not Attending" (NA) is incorrect for a school leaver. Enter correct student type at date of last attendance. [Student Type Code NA is for temporary absences only]';	
	}
	// If ORS AND SECTION 9=N and School Type in [20, 21, 22] and TYPE not in [FF, EX, RE, EM, SA, NA,NF, SF]
	
	else if ($this->mappedData['ORS and Section 9'] == 'N' && in_array($this->school_type, array('20', '21', '22')) && !in_array($data, array('FF', 'EX', 'RE', 'EM', 'SA', 'NA', 'NF', 'SF')) ){
		
	$this->moe[$number]['valid'] = 'false'; 
	$this->moe[$number]['value'] = '612 -Student type is incorrect for this school type';	
	}
	
	// If School Type in [32, 34, 35] and TYPE not in Ministry code list for TYPE
	
	else if ( in_array($this->school_type, array('32', '34', '35') )){
		
	$this->moe[$number]['valid'] = 'false'; 
	$this->moe[$number]['value'] = '613 -Student type is incorrect for this school type';	
	}
	// If School Type=23 and TYPE not in [FF, AD, RA, RE, EM, NA, NF,SF]
	else if ( $this->school_type == '23' && !in_array($data, array('FF', 'AD', 'RA', 'RE', 'EM', 'NA', 'NF','SF'))){
		
	$this->moe[$number]['valid'] = 'false'; 
	$this->moe[$number]['value'] = '614 -Student type is incorrect for this school type';	
	}
	// If TYPE=AE and age at Roll Return Date is <13 or >=17
	else if ( $data == "RE" && ($this->ageOnReturnDate <13 || $this->ageOnReturnDate >=17)){
		
	$this->moe[$number]['valid'] = 'true'; 
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '178 - Warning - Age may be incorrect for Alternative Education student';
		
	}
	// If Student Type = "NF" and Eligibility Criteria NOT in [60010, 60011] and [Rmonth in [M,J] or Funding Year Level >=9]
		else if ( $data == "NF" && !in_array($this->mappedData['Eligibility Criteria'], array('60010', '60011')) && $this->mappedData['funding_year_level'] >=9 && in_array($this->rmonth, array("M", "J" ))){
		
	$this->moe[$number]['valid'] = 'true'; 
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '666 - Warning - Student Type does not match Eligibility Criteria. The Student Type "NF" (Not Funded) is valid only for students with a 28 Day Waiver, or Extended 28 Day Waiver';
		
	}
	
	// If Student Type is NOT "NF" and Eligibility Criteria in [60010, 60011] and [Rmonth in [M,J] or Funding Year Level >=9]
		else if ( $data != "NF" && in_array($this->mappedData['Eligibility Criteria'], array('60010', '60011')) && $this->mappedData['funding_year_level'] >=9 && in_array($this->rmonth, array("M", "J" ))){
		
	$this->moe[$number]['valid'] = 'true'; 
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '667 - Warning - Student Type does not match Eligibility Criteria. Students with a 28 Day Waiver, or Extended 28 Day Waiver, are not funded and must have the Student Type "NF"';
		
	}
	
	else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	}
}
else {

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '171 - Student type is missing';
}
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
$this->moe[$number]['input_field'] = '<select name="select-'.$this->moe[$number]['LINC Name'].'" id="select-'.$this->moe[$number]['LINC Name'].$this->person_id.'" data-native-menu="false" data-inline="true" data-icon="grid" data-theme="b" data-iconpos="left" class="optionMenu">';
					
			$this->moe[$number]['input_field'] .= '<option>'.$this->moe[$number]['Description'].'</option>';
					 
							   foreach ($array as $key=> $code){
									   
									$this->moe[$number]['input_field'] .= '<option ';
										if ($key == $this->moe[$number]['value'] ){
										
									$this->moe[$number]['input_field'] .= 'selected=selected';	
										}
										
			$this->moe[$number]['input_field'].= ' value="'.$key.'" data-arraypos="'.$this->moe[$number]['Field No'].'" data-id="'.$this->person_id.'" data-value="'.$key.'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'">'.$code.'</option>';	
								}
							
			$this->moe[$number]['input_field'] .= '</select>';

			return $this->moe[$number]['valid'];	
}


public function check_19(){
	
	$this->moe[19]=array("Content Type"=> 'metacontent', "Field Name"=>"PREVIOUS SCHOOL","Field Label"=>"Previous School", "LINC Name"=>"previous_school", "Field No"=>"19", "Description"=>"Previous School of Year 7 and Year 9 students","Mandatory"=>"NO","Type"=>"Numeric"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 



$number = 19;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
$this->moe[$number]['input_field'] = '<input type="number" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
}


public function check_20(){

if ( $this->EnrolmentScheme == 'true'){	

	$number = 20;
	$this->moe[$number]=array("Field Name"=>"ZONING STATUS", "Field Label"=>"Zone", "LINC Name"=>"zoning", "Field No"=>$number, "Description"=>"Indication of whether the student resided in or out of the School Zone at date of first attendance at the school",
	"Mandatory"=>"for full time regular students if enrolment scheme",
	"Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>'', 
'options'=>array(
array('value'=>'INZN', 'label'=>'In Zone'),
array('value'=>'OUTZ', 'label'=>'Out of Zone')
)
); 

if ($this->mappedData['TYPE'] == "RE" && $this->EnrolmentScheme == 'true'){
	
	$this->moe[$number]['Mandatory']="YES";
	
}


$data = $this->mappedData[$this->moe[$number]['LINC Name']];
//If value not in [INZN, OUTZ, NAPP] (this test applies to all students to ensure only 1 of the 3 valid codes can be entered) and [Rmonth in [M,J] or Funding Year Level >=9]

if (!in_array($data, array('INZN', 'OUTZ', 'NAPP')) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)  ){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '300 - Code for zoning status is incorrect';
	
}
else {


$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
}
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	$this->moe[$number]['input_field'] .= '<fieldset data-role="controlgroup"  data-theme="b" data-type="horizontal">';
						foreach ($this->moe[$number]['options'] as $option){
										
			$this->moe[$number]['input_field'] .= '<input data-theme="b" data-arraypos="'.$number.'" class="radioButton" type="radio" data-id="'.$this->person_id.'" data-value="'.$option['value'].'" name="'.$this->moe[$number]['LINC Name'].'" id="radio-'.$this->moe[$number]['LINC Name'].'-'.$option['value'].'" value="'.$option['value'].'"  ';
										if ($this->moe[$number]['value'] == $option['value']){
										$this->moe[$number]['input_field'] .= "checked='checked'";
										}
					$this->moe[$number]['input_field'] .= '/>';
					$this->moe[$number]['input_field'] .= '<label data-theme="b" for="radio-'.$this->moe[$number]['LINC Name'].'-'.$option['value'].'">'.$option ['label'].'</label>';
					
										
						}
										
				$this->moe[$number]['input_field'] .= '</fieldset>';	

				return $this->moe[$number]['valid'];
			}
			else {

				return 'true';
			}

}


public function check_21(){
	$number =21;
	$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"COUNTRY OF CITIZENSHIP", "Field Label"=>"Country of Citizenship", "LINC Name"=>"citizenship", "Field No"=>$number, "Description"=>"Country of citizenship must be selected from the list","Mandatory"=>"YES","Type"=>"Controlled value code list",
"code"=>"country"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 


$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$array = $this->codes->countryCodes();
if ($this->codes->checkKey($data, $this->codes->countryCodes())){
	//If TYPE in [FF] and COUNTRY of CITIZENSHIP in [NZL, AUS] and [Rmonth in [M,J] or Funding Year Level >=9]
	if ($this->mappedData['TYPE'] == "FF" && in_array ($data, array ( "NZL", "AUS")) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9) ){ //INCOMPLETE
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '192 - Students from New Zealand or Australia cannot be FF';	
	
	}
	
	// If TYPE=EX and COUNTRY of CITIZENSHIP=NZL and [Rmonth in [M,J] or Funding Year Level >=9]
	else if ($this->mappedData['TYPE'] == "EX" && in_array ($data, array ("NZL")) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){ //INCOMPLETE
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '615 - Student with New Zealand citizenship cannot be a International exchange student';	
	
	}
	//If COUNTRY of CITIZENSHIP is Null and [Rmonth in [M,J] or Funding Year Level >=9]
	else if (is_null($data) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '636 - Country of Citizenship is mandatory for all students';	
		
	}
	
	else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	}
	
}
else {
$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '191 - Citizenship code is incorrect';	
	
}

				
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['value']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
$this->moe[$number]['input_field'] = '<select name="select-'.$this->moe[$number]['LINC Name'].'" id="select-'.$this->moe[$number]['LINC Name'].$this->person_id.'" data-native-menu="false" data-inline="true" data-icon="grid" data-theme="b" data-iconpos="left" class="optionMenu">';
					
			$this->moe[$number]['input_field'] .= '<option>'.$this->moe[$number]['Description'].'</option>';
					 
							   foreach ($array as $key=> $code){
									   
									$this->moe[$number]['input_field'] .= '<option ';
										if ($key == $this->moe[$number]['value'] ){
										
									$this->moe[$number]['input_field'] .= 'selected=selected';	
										}
										
			$this->moe[$number]['input_field'].= ' value="'.$key.'" data-arraypos="'.$this->moe[$number]['Field No'].'" data-id="'.$this->person_id.'" data-value="'.$key.'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'">'.$code.'</option>';	
								}
							
			$this->moe[$number]['input_field'] .= '</select>';	

			return $this->moe[$number]['valid'];
}


public function check_22(){
	$number = 22;
	$this->moe[22]=array("Content Type"=> 'metacontent', "Field Name"=>"FEE", "LINC Name"=>"FEE","Field No"=>"22","Field Label"=>"Tuition Fee paid by international students specifically International Fee payers (FF)", "Description"=>"Tuition Fee paid by international students specifically International Fee payers (FF)","Mandatory"=>"for student type FF","Type"=>"Numeric (whole number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 

$data = $this->mappedData[$this->moe[22]['LINC Name']];
// If Reason=Null and TYPE in [FF] and FEE= 0 OR FEE=Null and [Rmonth in [M,J]
if ($this->mappedData['TYPE']== "FF"){
	$this->moe[$number]['Mandatory']="YES";
}
if( is_null($this->mappedData['REASON']) && $this->mappedData['TYPE']== "FF" && ($this->mappedData['FEE']==0 || is_null( $this->mappedData['FEE'] )) ){
	
	$this->moe[22]['valid'] = 'false';
	$this->moe[22]['value'] = '202 - FEE for International fee-paying student is missing. Enter fee charged, excluding GST, for this academic year';
}
else {

	$this->moe[22]['valid'] = 'true';
	$this->moe[22]['value'] = $data;
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="number" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
return $this->moe[$number]['valid'];

}


public function check_23(){
	$number = 23;
	$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"FTE", "Field Label"=>"Full Time Equivalent", "LINC Name"=>"FTE","Field No"=>"23", "Description"=>"Full Time Equivalent - This must be a number between 0 and 1.","Mandatory"=>"YES","Type"=>"Numeric (Decimal to 1dp where applicable)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 


$data = $this->mappedData[$this->moe[$number]['LINC Name']];
// If TYPE not equal to EM and STP is NULL and FUNDING YEAR LEVEL < 9 and FTE < 1 and [Rmonth in [M,J]



if (!in_array($this->mappedData['TYPE'], array ("EM")) && is_null($this->mappedData['STP']) && $this->mappedData['funding_year_level'] <9 && in_array($this->rmonth, array('M', 'J'))  ){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '221 - Student in primary level must be full-time';
}

// If FTE>1 or FTE<0 and [Rmonth in [M,J] or Funding Year Level >=9]
else if ( ($this->mappedData['FTE'] >1 || $this->mappedData['FTE'] <0) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9) ){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '224 - FTE value must be between 0 and 1.0 inclusive';	
}
// If TYPE not equal to EM and STP is NULL and FTE<1 and age <16 years on Roll count date

else if ( $this->mappedData['TYPE'] != "EM" && is_null($this->mappedData['STP']) && $this->ageOnReturnDate <16){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '225 - Student aged <16 at Roll count date must be full-time unless attending a Secondary Tertiary Programme';	
}
// If STP is NULL and age >=16 and FTE not in [0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0]
if (is_null($this->mappedData['STP']) && $this->ageOnReturnDate >=16 && !in_array($data, array('0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0'))){ 
$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '653 - FTE is invalid';
}
// If STP=NULL and FTE=0

else if (is_null($this->mappedData['STP']) && $data ==0){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '664 - Student has a Full Time Equivalent of 0.0';
}
else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="number" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';

return $this->moe[$number]['valid'];
}


public function check_24(){
	$number = 24;
	$this->moe[$number]=array("Content Type"=> 'metacontent', "Field Name"=>"MAORI", "Field Label"=>"MAORI", "LINC Name"=>"MAORI", "Field No"=>$number, "Description"=>"Highest level of Maori Language Learning the student is involved in","Mandatory"=>"YES","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 


$data = $this->mappedData[$this->moe[$number]['LINC Name']];

// Value not in [Null, A, B, C, D, E, F, G, H] and [Rmonth in [M,J] or Funding Year Level >=9]

if (!in_array($data, array('[Null]', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'N/A')) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9) ){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '231 - Māori-medium / Māori language learning code is incorrect';
}
else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';

return $this->moe[$number]['valid'];
}


public function check_25(){
	

$data = $this->mappedData['LAST ATTENDANCE'];
		
if ((isset($data) && $data != '[Null]') ){	
	
	$this->moe[25]=array("Content Type"=> 'metacontent', "Field Name"=>"LAST ATTENDANCE","LINC Name"=>"LAST ATTENDANCE","Field No"=>"25", "Description"=>"Date of student's last attendance for tuition","Mandatory"=>"YES","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 
$number = 25;


$convert = date('Ymd', strtotime($data));
		
				 if (preg_match("/^\d{8}$/", $convert)) {
					 
					 //If LAST ATTENDANCE is not Null but REASON =Null and [Rmonth in [M,J] or Funding Year Level >=9]
					 if ((is_null($this->mappedData['REASON'])|| $this->mappedData['REASON']=="0" ) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
						 
							$this->moe[$number]['valid'] = 'false';
							$this->moe[$number]['value'] = "252 - Date in LAST ATTENDANCE field but no reason";
					 }
						else {
							
					
								$this->moe[$number]['valid'] = 'true';
								$this->moe[$number]['value'] = $convert;
						}
							
							
						}
						else {
							
							$this->moe[$number]['valid'] = 'false';
							$this->moe[$number]['value'] = "251 - Date of Last Attendance format is incorrect";
							
						}
				}
				
				
return $this->moe[$number]['valid'];

}


public function check_26(){
	
	$data = $this->mappedData['NQF QUAL'];
	if (isset($data)|| $this->test==true){	
	
	$this->moe[26]=array("Content Type"=> 'metacontent', "Field Name"=>"NQF QUAL", "LINC Name"=>"NQF QUAL", "Field No"=>"26", "Description"=>"Highest NQF secondary school attainment of a student on leaving school","Mandatory"=>"for Fulltime students Year 9+","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 

//Mandatory for secondary aged students (RE, FF, TPRE, TPREOM) and Adult (AD, TPAD, TPRAE, RA, TPRAOM) students who are leaving the NZ schooling sector and where REASON in [L, E, O, X, C]
	

$code = $this->codes->checkKey($data, $this->codes->NQF_codes());
	
	if($code){
								$this->moe[$number]['valid'] = 'true';
								$this->moe[$number]['value'] = $data;
							
							
						}
						else {
							
							$this->moe[$number]['valid'] = 'false';
							$this->moe[$number]['value'] = "Incorrect code for NQF Qual";
			}	
	}

}

public function check_27(){

if ($this->mappedData['LAST ATTENDANCE'] || $this->test==true){	
	
			$this->moe[27]=array("Content Type"=> 'metacontent', "Field Name"=>"REASON", "LINC Name"=>"REASON", "Field No"=>"27", "Description"=>"Student's reason for leaving their present school","Mandatory"=>"where LAST ATTENDANCE DATE is populated","Type"=>"Controlled value code list"
		, 'valid'=>'',
		'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
		); 
		
		if ($this->person){
		$number = 27;
		$age = $this->returnAgeOnDate(date('Y-m-d', strtotime($this->mappedData['LAST ATTENDANCE'])));
		$data = $this->mappedData[$this->moe[$number]['LINC Name']];
		
		//If REASON not in [Null, S, H, O ,D ,X ,L ,E , K , C ] and [Rmonth in [M,J] or Funding Year Level >=9]
		
		if (!in_array($data, array('[Null]', 'S', 'H', 'O' ,'D' ,'X' ,'L' ,'E' , 'K' , 'C' )) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
			$this->moe[$number]['valid'] = 'false';
			$this->moe[$number]['value'] = '271 - Reason for leaving is not valid';
		}
		
		//If REASON not Null but LAST ATTENDANCE=Null and [Rmonth in [M,J] or Funding Year Level >=9]
		
		else if (!is_null($data) && ( is_null($this->mappedData['LAST ATTENDANCE']) || $this->mappedData['LAST ATTENDANCE'] =='0' ) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
			$this->moe[$number]['valid'] = 'false';
			$this->moe[$number]['value'] = '272 - Student has reason for leaving but no LAST ATTENDANCE date';
		}
		//If REASON in [E, K] but age on LAST ATTENDANCE >=16 and [Rmonth in [M,J] or Funding Year Level >=9]
		else if (in_array($data, array('E', 'K')) && $age >=16  && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
			$this->moe[$number]['valid'] = 'false';
			$this->moe[$number]['value'] = '273 - Exempted or Excluded student must be <16';	
			
		}
		
		// If REASON in [L, X] and age on LAST ATTENDANCE <15yrs +9mnths at last attendance
		else if (in_array($data, array("L", "X")) & $age <16){
			$this->moe[$number]['valid'] = 'false';
			$this->moe[$number]['value'] = '275 - Reason for leaving code is incorrect';
			
		}
		else {
			$this->moe[$number]['valid'] = 'true';
			$this->moe[$number]['value'] = $data;
		}
}
}
return $this->moe[$number]['valid'];
}


public function check_28(){
	
	$data = $this->mappedData['ECE'];
	if ($data || $this->test==true){	
	
	$this->moe[28]=array("Content Type"=> 'metacontent', "Field Name"=>"ECE", "LINC Name"=>"ECE", "Field No"=>"28", "Description"=>"Identifier of the student's participation in Early Childhood Education","Mandatory"=>"NO","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 


$number = 28;



$code = $this->codes->checkKey($data, $this->codes->ECE_codes());

if (!$code){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'ECE code is incorrect.';
}
else {
$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
}
	}

	return $this->moe[$number]['valid'];
}

public function check_29(){
	
	$data = $this->mappedData['PACIFIC MEDIUM -LANGUAGE'];
	if (isset($data)|| $this->test==true){	
	
	$this->moe[29]=array("Content Type"=> 'metacontent', "Field Name"=>"PACIFIC MEDIUM -LANGUAGE", "LINC Name"=>"PACIFIC MEDIUM -LANGUAGE","Field No"=>"29", "Description"=>"Particular Pacific Island Language in which immersion or bilingual education is provided","Mandatory"=>"PACIFIC MEDIUM LEVEL field is populated","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
); 



$number = 29;



// If value not in [Null, CIM, FIJ, NIU, SAO, TOK, TON,PIL] and [Rmonth in [M,J] or Funding Year Level >=9]

if (!in_array($data, array('[Null]', 'CIM', 'FIJ', 'NIU', 'SAO', 'TOK', 'TON','PIL')) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '291 - Pacific medium – language code is incorrect';
}
//If value in [CIM,FIJ,NIU,SAO,TOK,TON,PIL] and PACIFIC MEDIUM – LEVEL=Null and [Rmonth in [M,J] or Funding Year Level >=9]
else if (in_array($data, array('[Null]', 'CIM', 'FIJ', 'NIU', 'SAO', 'TOK', 'TON','PIL')) && is_null($this->mappedData['PACIFIC MEDIUM - LEVEL']) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '294 - Pacific medium – level is missing';
}

else {

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
}
	}

	return $this->moe[$number]['valid'];
}


public function check_30(){
	
	$data = $this->mappedData['PACIFIC MEDIUM - LEVEL'];
	if (isset($data)|| $this->test==true){	
	
	$this->moe[30]=array("Content Type"=> 'metacontent', "Field Name"=>"PACIFIC MEDIUM - LEVEL", "LINC Name"=>"PACIFIC MEDIUM - LEVEL", "Field No"=>"30", "Description"=>"The highest Level of Pacific Language Learning the student is involved in","Mandatory"=>"where PACIFIC MEDIUM LANGUAGE field is populated","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 30;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

//If value not in [Null,1,2,3,4] and [Rmonth in [M,J] or Funding Year Level >=9]

if (!in_array($data, array('[Null]', '1', '2', '3', '4')) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '292 - Pacific medium – level code is incorrect';
}
//If value in [1,2,3,4] and PACIFIC MEDIUM – LANGUAGE=Null and [Rmonth in [M,J] or Funding Year Level >=9]
else if ( in_array($data, array('[Null]', '1', '2', '3', '4')) && is_null($this->mappedData['PACIFIC MEDIUM -LANGUAGE']) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
		$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '293 - Pacific medium – language is missing';
}

else {


$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}

return $this->moe[$number]['valid'];
}

public function check_31(){
	$this->moe[31]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 1", "LINC Name"=>"SUBJECT 1", "Field No"=>"31", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 31;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}

// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}

else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
	
	return $this->moe[$number]['valid'];

	}


public function check_32(){$this->moe[32]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 1", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 1", "Field No"=>"32", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 32;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

//If Rmonth=J and Subject is not Null and Instructional year level is Null


	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	

return $this->moe[$number]['valid'];
}

public function check_33(){$this->moe[33]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 1", "LINC Name"=>"HOURS PER YEAR SUBJECT 1", "Field No"=>"33", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 33;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[31]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[31]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}
 else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}

	return $this->moe[$number]['valid'];
}


public function check_34(){$this->moe[34]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 1", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 1","Field No"=>"34", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 34;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];
//If Rmonth=J and Subject is not Null and Instructional year level is Null

if ( $this->rmonth =='J' && ($data =='0' || is_null($data))){
		$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = '400 - Instructional year level code is missing for subject ['.$this->moe[31]['value'].']';
}

// If Rmonth=J and FUNDING YEAR LEVEL>=9 and Instructional year level not in[ZN07, ZN08, ZN09, ZN10, ZN11, ZN12, ZN13, ZNAD]
else if ( !in_array ($data, array( 'ZN07', 'ZN08', 'ZN09', 'ZN10', 'ZN11', 'ZN12', 'ZN13', 'ZNAD' )) && ($this->rmonth =='J'&& $this->mappedData['funding_year_level'] >=9)){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '401 - Instructional year level code is incorrect for ['.$this->moe[31]['value'].']';
}
else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}


return $this->moe[$number]['valid'];	
	}


public function check_35(){$this->moe[35]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 2", "LINC Name"=>"SUBJECT 2","Field No"=>"35", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 35;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}


return $this->moe[$number]['valid'];
}


public function check_36(){$this->moe[36]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 2", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 2","Field No"=>"36", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 36;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;

return $this->moe[$number]['valid'];
}


public function check_37(){$this->moe[37]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 2", "LINC Name"=>"HOURS PER YEAR SUBJECT 2","Field No"=>"37", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 37;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[35]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[35]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}

	return $this->moe[$number]['valid'];
}


public function check_38(){$this->moe[38]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 2", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 2","Field No"=>"38", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 38;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;


return $this->moe[$number]['valid'];
}


public function check_39(){$this->moe[39]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 3", "LINC Name"=>"SUBJECT 3","Field No"=>"39", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 39;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
	
return $this->moe[$number]['valid'];
	}


public function check_40(){$this->moe[40]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 3", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 3","Field No"=>"40", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 40;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;


return $this->moe[$number]['valid'];
}


public function check_41(){$this->moe[41]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 3", "LINC Name"=>"HOURS PER YEAR SUBJECT 3","Field No"=>"41", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 41;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[39]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[39]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}

	return $this->moe[$number]['valid'];
}


public function check_42(){$this->moe[42]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 3", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 3","Field No"=>"42", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 42;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;


return $this->moe[$number]['valid'];

}


public function check_43(){$this->moe[43]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 4", "LINC Name"=>"SUBJECT 4","Field No"=>"43", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 43;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}


return $this->moe[$number]['valid'];
}


public function check_44(){$this->moe[44]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 4", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 4","Field No"=>"44", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 44;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;


return $this->moe[$number]['valid'];
}


public function check_45(){$this->moe[45]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 4", "LINC Name"=>"HOURS PER YEAR SUBJECT 4","Field No"=>"45", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 45;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[43]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[43]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}

	return $this->moe[$number]['valid'];
}


public function check_46(){$this->moe[46]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 4", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 4","Field No"=>"46", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 46;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_47(){$this->moe[47]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 5", "LINC Name"=>"SUBJECT 5","Field No"=>"47", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 47;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}

return $this->moe[$number]['valid'];
}


public function check_48(){$this->moe[48]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 5", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 5","Field No"=>"48", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 48;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;


return $this->moe[$number]['valid'];
}


public function check_49(){$this->moe[49]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 5", "LINC Name"=>"HOURS PER YEAR SUBJECT 5","Field No"=>"49", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 49;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[47]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[47]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}

	return $this->moe[$number]['valid'];
}


public function check_50(){$this->moe[50]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 5", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 5","Field No"=>"50", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 50;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_51(){
	
	$this->moe[51]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 6","LINC Name"=>"SUBJECT 6", "Field No"=>"51", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 51;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
}


public function check_52(){$this->moe[52]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 6", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 6","Field No"=>"52", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 52;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_53(){$this->moe[53]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 6", "LINC Name"=>"HOURS PER YEAR SUBJECT 6","Field No"=>"53", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 53;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[51]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[51]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}


public function check_54(){$this->moe[54]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 6", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 6","Field No"=>"54", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 54;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_55(){$this->moe[55]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 7", "LINC Name"=>"SUBJECT 7","Field No"=>"55", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 55;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
}


public function check_56(){$this->moe[56]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 7", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 7","Field No"=>"56", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 56;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_57(){$this->moe[57]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 7", "LINC Name"=>"HOURS PER YEAR SUBJECT 7","Field No"=>"57", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 57;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[55]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[55]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}


public function check_58(){$this->moe[58]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 7", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 7","Field No"=>"58", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 58;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_59(){$this->moe[59]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 8", "LINC Name"=>"SUBJECT 8","Field No"=>"59", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 59;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
}


public function check_60(){$this->moe[60]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 8", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 8","Field No"=>"60", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 60;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_61(){$this->moe[61]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 8", "LINC Name"=>"HOURS PER YEAR SUBJECT 8","Field No"=>"61", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 61;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[59]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[59]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}


public function check_62(){$this->moe[62]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 8", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 8","Field No"=>"62", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 62;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_63(){$this->moe[63]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 9", "LINC Name"=>"SUBJECT 9","Field No"=>"63", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 63;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
}


public function check_64(){$this->moe[64]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 9", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 9","Field No"=>"64", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 64;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_65(){$this->moe[65]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 9", "LINC Name"=>"HOURS PER YEAR SUBJECT 9","Field No"=>"65", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 65;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[63]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[63]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}


public function check_66(){$this->moe[66]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 9", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 9","Field No"=>"66", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 66;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_67(){$this->moe[67]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 10", "LINC Name"=>"SUBJECT 10","Field No"=>"67", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 67;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
}


public function check_68(){$this->moe[68]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 10", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 10","Field No"=>"68", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 68;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_69(){$this->moe[69]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 10", "LINC Name"=>"HOURS PER YEAR SUBJECT 10","Field No"=>"69", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 69;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[67]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[67]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}


public function check_70(){$this->moe[70]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 10", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 10","Field No"=>"70", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 70;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_71(){$this->moe[71]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 11", "LINC Name"=>"SUBJECT 11","Field No"=>"71", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 71;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
}


public function check_72(){$this->moe[72]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 11", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 11","Field No"=>"72", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 72;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_73(){$this->moe[73]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 11", "LINC Name"=>"HOURS PER YEAR SUBJECT 11","Field No"=>"73", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 73;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[71]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[71]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}


public function check_74(){$this->moe[74]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 11", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 11","Field No"=>"74", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 74;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_75(){$this->moe[75]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 12", "LINC Name"=>"SUBJECT 12","Field No"=>"75", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 75;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
}


public function check_76(){$this->moe[76]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 12", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 12","Field No"=>"76", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 76;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_77(){$this->moe[77]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 12", "LINC Name"=>"HOURS PER YEAR SUBJECT 12","Field No"=>"77", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 77;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[75]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[75]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}


public function check_78(){$this->moe[78]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 12" ,"LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 12", "Field No"=>"78", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 78;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_79(){$this->moe[79]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 13", "LINC Name"=>"SUBJECT 13","Field No"=>"79", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 79;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
}

public function check_80(){$this->moe[80]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 13", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 13","Field No"=>"80", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 80;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_81(){$this->moe[81]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 13", "LINC Name"=>"HOURS PER YEAR SUBJECT 13", "Field No"=>"81", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 81;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[79]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[79]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}


public function check_82(){$this->moe[82]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 13","LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 13","Field No"=>"82", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 82;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_83(){$this->moe[83]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 14","LINC Name"=>"SUBJECT 14","Field No"=>"83", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 83;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
}


public function check_84(){$this->moe[84]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 14", "LINC Name"=>"MODE OF INSTRUCTION SUBJECT 14","Field No"=>"84", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 84;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_85(){$this->moe[85]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 14","LINC Name"=>"HOURS PER YEAR SUBJECT 14","Field No"=>"85", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 85;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[83]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[83]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}


public function check_86(){$this->moe[86]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 14", "LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 14","Field No"=>"86", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 86;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_87(){$this->moe[87]=array("Content Type"=> 'metacontent', "Field Name"=>"SUBJECT 15","LINC Name"=>"SUBJECT 15","Field No"=>"87", "Description"=>"Subject being studied at secondary school level","Mandatory"=>"for Year 9 to Year 15 for July return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 87;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


$code = $this->codes->checkKey($data, $this->codes->subjectCodes());


if (!$code) {
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '241 - Subject code ['.$data.'] is incorrect';

}
 // If Subject = "STPR" and Student Type is not "SF" and STP = NULL
else if ($data == "STPR" && $this->mappedData['TYPE'] !="SF" && is_null($this->mappedData['STP'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '665 - Student needs to be on a Secondary Tertiary Programme to have Subject "Secondary Tertiary Programme"';

}
// If Rmonth="J" and TYPE not in [AE, EM, NA,NF, SA, SF, TPRE,TPRAE] and STP=NULL and Reason=Null and FTE<1 and FUNDING YEAR LEVEL>=9 and SUBJECT 1 to SUBJECT 15=Null
else if ($thus->rmonth =="J" && !in_array($this->mappedData['TYPE'], array('AE', 'EM', 'NA', 'NF', 'SA', 'SF', 'TPRE', 'TPRAE')) && is_null($this->mappedData['STP']) && is_null($this->mappedData['REASON']) && $this->mappedData['funding_year_level'] >=9 && is_null($data)){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = '243 - Warning - Part-time student with no subjects';
}
else {
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
}


public function check_88(){$this->moe[88]=array("Content Type"=> 'metacontent', "Field Name"=>"MODE OF INSTRUCTION SUBJECT 15","LINC Name"=>"MODE OF INSTRUCTION SUBJECT 15","Field No"=>"88", "Description"=>"Predominant mode of curriculum delivery of subject 1 being studied","Mandatory"=>"Not being collected","Type"=>"-"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 88;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_89(){$this->moe[89]=array("Content Type"=> 'metacontent', "Field Name"=>"HOURS PER YEAR SUBJECT 15", "LINC Name"=>"HOURS PER YEAR SUBJECT 15","Field No"=>"89", "Description"=>"Approximate number of hours per year that subject 1 at secondary school level will be studied for","Mandatory"=>"for Year 9 – Year 15","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 89;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


//If Rmonth=J and Number of hours per year is ≥1000
 if ( $data > 1000 && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){

	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = 'Subject ['.$this->moe[87]['value'].'] cannot be studied for ≥1000hrs';

 }
 //If Rmonth=J and Subject is not Null and Number of hours per year=0 or Null
 else if ( (is_null($data) || $data == '0') && $this->rmonth =='J'){
	 	$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = 'Subject ['.$this->moe[87]['value'].'] must have hours per year';
 }
 
//  If Rmonth="J" and Number of hours per year is >=1 and <20
else if ($this->rmonth=="J" && $data >=1 && $data <20){
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied for less than 20 hrs per year [Y hours]';
}
//If Rmonth=J and Number of hours per year is >310
else if ($this->rmonth=="J" && $data >310){
	
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	$this->moe[$number]['message'] = 'Subject ['.$this->moe[$number-2]['value'].'] studied should not exceed 310 hrs per year [Y hours]';
}else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}


public function check_90(){$this->moe[90]=array("Content Type"=> 'metacontent', "Field Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 15","LINC Name"=>"INSTRUCTIONAL YEAR LEVEL SUBJECT 15","Field No"=>"90", "Description"=>"The level at which subject 1 is being studied","Mandatory"=>"for all subjects for JULY roll return","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 90;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_91(){$this->moe[91]=array("Content Type"=> 'metacontent', "Field Name"=>"TUITION WEEKS","LINC Name"=>"TUITION WEEKS","Field No"=>"91", "Description"=>"Number of weeks FF students are enrolled","Mandatory"=>"No","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 91;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_92(){
$data = $this->mappedData['NON-NQF QUAL'];	
	if (isset($data) || $this->test==true){
		
	$this->moe[92]=array("Content Type"=> 'metacontent', "Field Name"=>"NON-NQF QUAL","LINC Name"=>"NON-NQF QUAL","Field No"=>"92", "Description"=>"Highest Secondary School Attainment in Non-NQF Qualifications","Mandatory"=>"for Fulltime students Year 9+","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 92;



//If REASON in [L, E, X, C, O] and FTE= 1 and FUNDING YEAR LEVEL >=9 and TYPE in [RE, RA, AD, TPREOM, TPRAOM, FF,TPRE, TPRAE, TPAD ] and NON-NQF QUAL not in [00, 60, 61, 62, 70, 71, 72 , 80 ,81,82, 90, 91, 92]
if (in_array( $this->mappedData['REASON'], array('L', 'E', 'X', 'C', 'O')) && $this->mappedData['funding_year_level'] >=9 && in_array($this->mappedData['TYPE'], array('RE', 'RA', 'AD', 'TPREOM', 'TPRAOM', 'FF','TPRE', 'TPRAE', 'TPAD')) && !in_array($data, array ('00', '60', '61', '62', '70', '71', '72', '80', '81', '82', '90', '91', '92')) ){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '622 - Code for NON-NQF attainment incorrect';

}
else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}
}

public function check_93(){$this->moe[93]=array("Content Type"=> 'metacontent', "Field Name"=>"UE","LINC Name"=>"UE","Field No"=>"93", "Description"=>"University Entrance","Mandatory"=>"for Fulltime students Year 9+","Type"=>"Alpha (Yes or No)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 93;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

// If REASON in [L, E, X, C, O ] and FTE= 1 and FUNDING YEAR LEVEL >=9 and TYPE in [RE, RA, AD, TPREOM, TPRAOM, FF, TPRE, TPRAE, TPAD] and UE not in [Y,N]

if (in_array( $this->mappedData['REASON'], array('L', 'E', 'X', 'C', 'O')) && $this->mappedData['funding_year_level'] >=9 && in_array($this->mappedData['TYPE'], array('RE', 'RA', 'AD', 'TPREOM', 'TPRAOM', 'FF','TPRE', 'TPRAE', 'TPAD')) && !in_array($data, array ('Y', 'N') ) ){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '623 - Code for UE incorrect';

}
else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}



public function check_94(){$this->moe[94]=array("Content Type"=> 'metacontent', "Field Name"=>"EXCHANGE SCHEME", "LINC Name"=>"EXCHANGE SCHEME","Field No"=>"94", "Description"=>"Type of scheme or agreement an exchange student is affiliated to","Mandatory"=>"for Exchange Students","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 94;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

//If STUDENT TYPE=EX and EXCHANGE SCHEME not in [01, 02, 03, 04, 05, 07, 08, 09, 10, 11, 12, 13,14, 15, 99] and REASON=Null and [Rmonth in [M,J] or Funding Year Level >=9]

if (in_array( $this->mappedData['TYPE'], array('EX')) && is_null($this->mappedData['REASON']) && !in_array($data, array ('01', '02', '03', '04', '05', '07', '08', '09', '10', '11', '12', '13', '14', '15', '99') ) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)  ){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '624 - Exchange Student must have a valid Exchange Scheme';

}
else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}


public function check_95(){
	
	$this->moe[95]=array("Content Type"=> 'metacontent', "Field Name"=>"BOARDING STATUS", "LINC Name"=>"BOARDING STATUS","Field No"=>"95", "Description"=>"Student is a boarder","Mandatory"=>"for schools with boarding facilities","Type"=>"Alpha (Yes or No)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 95;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];
// If Boarding Status is Null and REASON=Null and [Rmonth in [M,J] or Funding Year Level >=9]
if (is_null($data) && is_null($this->mappedData['REASON']) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '634 - Boarding Status has to be Y or N';	
}
// If Boarding Status=Y and Zoning Status not NAPP and REASON=Null and [Rmonth in [M,J] or Funding Year Level >=9]

else if ($data == 'Y' && $this->mappedData['ZONING STATUS'] != 'NAPP' && is_null($this->mappedData['REASON'])  && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '635 - Zoning Status of students boarding at the school hostel must be NAPP';	
}
else {
$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	}
}

public function check_96(){$this->moe[96]=array("Content Type"=> 'metacontent', "ICON" => "envelop", "Field Name"=>"ADDRESS1", "Field Label"=>"Address line 1 (Required)", "LINC Name"=>"Address1","Field No"=>"96", "Description"=>"Students home address","Mandatory"=>"YES","Type"=>"Alpha-Numeric"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 96;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

//If ADDRESS1 is Blank or Null and REASON=Null and PRIVACY INDICATOR= NULL and [Rmonth in [M,J] or Funding Year Level >=9]
if ((is_null($data) || $data == '' || $data =='0') && is_null($this->mappedData['REASON']) && is_null($this->mappedData['PRIVACY INDICATOR']) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '625 - First Address field is mandatory';
}
 if (strpos($data, ',')===true && is_null($this->mappedData['REASON'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '629 - Address fields cannot contain commas';
}

else {
$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = str_replace('"', "", $data);
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
return $this->moe[$number]['valid'] ;}


public function check_97(){$this->moe[97]=array("Content Type"=> 'metacontent', "ICON" => "envelop", "Field Name"=>"ADDRESS2", "Field Label"=>"Address line 2", "LINC Name"=>"Address2","Field No"=>"97", "Description"=>"Students home address","Mandatory"=>"NO","Type"=>"Alpha-Numeric"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 97;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];
 if (strpos($data, ',')===true && is_null($this->mappedData['REASON'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '629 - Address fields cannot contain commas';
}
else {
$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
return $this->moe[$number]['valid'] ;	}


public function check_98(){$this->moe[98]=array("Content Type"=> 'metacontent', "ICON" => "envelop", "Field Name"=>"ADDRESS3", "Field Label"=>"Address line 3 (Required)", "LINC Name"=>"Address3","Field No"=>"98", "Description"=>"Students home address","Mandatory"=>"YES","Type"=>"Alpha-Numeric"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number =98;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];


if ((is_null($data) || $data == '' || $data =='0') && is_null($this->mappedData['REASON']) && is_null($this->mappedData['PRIVACY INDICATOR']) && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '626 - Third Address field is mandatory';
}
else if (strpos($data, ',')===true && is_null($this->mappedData['REASON'])){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '629 - Address fields cannot contain commas';
}
else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
return $this->moe[$number]['valid'] ;}


public function check_99(){$this->moe[99]=array("Content Type"=> 'metacontent', "ICON" => "envelop", "Field Name"=>"ADDRESS4", "Field Label"=>"Postcode", "LINC Name"=>"Address4","Field No"=>"99", "Description"=>"Students home address – Postcode only","Mandatory"=>"NO","Type"=>"Numeric"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 99;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

// If ADDRESS4 not numeric and not Null and REASON=Null and [Rmonth in [M,J] or Funding Year Level >=9]

if (!is_numeric($data) && !is_null($data) && is_null($this->mappedData['REASON'])  && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '627 - Fourth Address field must contain a 4-digit postcode';
}

// If ADDRESS4 not NULL and length of ADDRESS4 <>4 and REASON=Null and [Rmonth in [M,J] or Funding Year Level >=9]

else if (strlen($data) <>4 &&  !is_null($data) && is_null($this->mappedData['REASON'])  && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '628 - Fourth Address field can contain only 4-digit postcodes';
}
else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
return $this->moe[$number]['valid'] ;}



public function check_100(){$this->moe[100]=array("Content Type"=> 'metacontent', "Field Name"=>"ELIGIBILITY CRITERIA","LINC Name"=>"ELIGIBILITY CRITERIA","Field No"=>"100", "Description"=>"Criteria to determine if student is Domestic, international fee-paying or international fee-exempt","Mandatory"=>"NO","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 100;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];
// If ELIGIBILITY CRITERIA is not NULL and not in Ministry code list and [Rmonth in [M,J] or Funding Year Level >=9]

if (!is_null($data) && !in_array($data, array())  && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){ // need the code list
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = "644 - Student's Eligibility Criteria is incorrect";
}
else {

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	}
}

public function check_101(){$this->moe[101]=array("Content Type"=> 'metacontent', "Field Name"=>"VERIFICATION DOCUMENT", "LINC Name"=>"VERIFICATION DOCUMENT","Field No"=>"101", "Description"=>"Document used to verify the students name, DoB and eligibility status","Mandatory"=>"NO","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 101;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];
// If VERIFICATION DOCUMENT is not NULL and not in Ministry code list and [Rmonth in [M,J] or Funding Year Level >=9]
if (!is_null($data) && !in_array($data, array())  && (in_array($this->rmonth, array('M', 'J'))|| $this->mappedData['funding_year_level'] >=9)){ // need the code list
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = "645 - Student's Eligibility verification document is incorrect";
}
else {

	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	}
	
}


public function check_102(){$this->moe[102]=array("Content Type"=> 'metacontent', "Field Name"=>"SERIAL NUMBER", "LINC Name"=>"SERIAL NUMBER","Field No"=>"102", "Description"=>"Verification document serial number","Mandatory"=>"NO","Type"=>"Alpha-Numeric"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 102;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_103(){$this->moe[103]=array("Content Type"=> 'metacontent', "Field Name"=>"CURRENT YEAR LEVEL", "Field Label"=>"Current Year Level", "LINC Name"=>"current_year_level","Field No"=>"103", "Description"=>"The student's class year level","Mandatory"=>"YES","Type"=>"Integer"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 103;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

// If School Type = 23, 32, 34 and CURRENT YEAR LEVEL is not between 1 and 13 inclusive

if (in_array($this->school_type, array('23', '32', '34')) && ($data <1 || $data > 13)){
		
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '646 - Current Year Level is incorrect';
	$this->moe[$number]['placeholder'] = '646 - Current Year Level is incorrect';
	
	}
	// If School Type = 20, 21 and CURRENT YEAR LEVEL is not between 1 and 8 inclusive
else if (in_array($this->school_type, array('20', '21')) && ($data <0 || $data > 8)){
		
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '647 - Current Year Level is incorrect';
	$this->moe[$number]['placeholder'] = '647 - Current Year Level is incorrect';
	}	
	// If School Type = 30 or 40 and CURRENT YEAR LEVEL is not between 7 and 13 inclusive
	
	else if (in_array($this->school_type, array('30', '40')) && ($data <7 || $data > 13)){
		
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '648 - Current Year Level is incorrect';
	$this->moe[$number]['placeholder'] = '648 - Current Year Level is incorrect';
	
	}
	//If School Type = 22 and CURRENT YEAR LEVEL is not between 7 and 8 inclusive
else if (in_array($this->school_type, array('22')) && ($data <7 || $data > 8)){
		
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '649 - Current Year Level is incorrect';
	$this->moe[$number]['placeholder'] = '649 - Current Year Level is incorrect';
	
	}	
else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}

if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		$this->moe[$number]['input_field'] = '<form>
    <div data-role="fieldcontain" class="ui-hide-label">
        <input data-theme="b" type="range"data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" class="'.$this->moe[$number]['Content Type'].'"  min="0" max="15" >
    </div>
</form>';
}

public function check_104(){$this->moe[104]=array("Content Type"=> 'metacontent', "Field Name"=>"POST-SCHOOL ACTIVITY", "LINC Name"=>"POST-SCHOOL ACTIVITY","Field No"=>"104", "Description"=>"Activity reported for students permanently leaving school","Mandatory"=>"for leavers with reason in [L,E,X,O]","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 104;

$data = $this->mappedData['PRIVACY INDICATOR'];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_105(){
	$data = $this->mappedData[$this->moe[$number]['LINC Name']];
	if ($data ){
	$this->moe[105]=array("Content Type"=> 'metacontent', "Field Name"=>"PRIVACY INDICATOR", "LINC Name"=>"PRIVACY INDICATOR","Field No"=>"105", "Description"=>"Indicates that the student address is suppressed due to privacy reasons","Mandatory"=>"NO","Type"=>"Alpha"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 105;



//If REASON in [L, E, O, X] and FUNDING YEAR LEVEL >=9 and POST-SCHOOL ACTIVITY not in Ministry code list
if (!in_array ($data, array()) && in_array($this->mappedData['REASON'], array('L', 'E', 'O', 'X')) && $this->mappedData['funding_year_level']>=9){ // need the code lists.
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '643 - Student permanently Leaving school must have Post-School activity recorded';
}
// If PRIVACY INDICATOR is not NULL or 'Y'
else if (!is_null($data) || $data != 'y' || $data != 'Y'){
$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '650 - Privacy Indicator value is incorrect';
}

else {
$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	}
}
}
public function check_106(){$this->moe[106]=array("Content Type"=> 'metacontent', "Field Name"=>"MIDDLE NAME(S)", "LINC Name"=>"middle_name","Field No"=>"106", "Description"=>"Student's Middle Name(s)","Mandatory"=>"NO","Type"=>"ASCII plus macronised vowels"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 106;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_107(){$this->moe[107]=array( "Field Name"=>"PREFERRED FIRST NAME",  "ICON"=>"user-plus","Content Type"=> 'metacontent' ,"Field Label"=>"Preferred First Name",  "Placeholder"=>"Preferred first name...", "LINC Name"=>"preferred_name","Field No"=>"107", "Description"=>"May not be the legal name","Mandatory"=>"NO","Type"=>"ASCII plus macronised vowels"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 107;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
return $this->moe[$number]['valid'] ;	
	}


public function check_108(){$this->moe[108]=array("Field Name"=>"PREFERRED LAST NAME", "ICON"=>"user-plus", "LINC Name"=>"preferred_last_name", "Content Type"=> 'metacontent' ,"Field Label"=>"Preferred Last Name",  "Placeholder"=>"Preferred last name...", "Field No"=>"108", "Description"=>"May not be the legal name","Mandatory"=>"NO","Type"=>"ASCII plus macronised vowels"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 108;


$data = stripslashes($this->mappedData[$this->moe[$number]['LINC Name']]);

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
return $this->moe[$number]['valid'] ;	
	}


public function check_109(){$this->moe[109]=array("Field Name"=>"EXPIRY DATE","Field No"=>"109", "Description"=>"Verification Document Expiry Date","Mandatory"=>"NO","Type"=>"Date"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 109;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

// If Citizenship 1 not in [NZL, AUS] and Eligibility Criteria not in [20199, 20200, 20201, 60001, 60002, 60003] and EXPIRY DATE not NULL and date format is incorrect
$convert = date('Ymd', strtotime($data));
if (!is_null($data) && !in_array($this->mappedData['COUNTRY OF CITIZENSHIP'], array('NZL', 'AUS')) && !in_array($this->mappedData['Eligibility Criteria'], array('20199', '20200', '20201', '60001', '60002', '60003')) && !preg_match("/^\d{8}$/", $convert) ){
	
		$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = '657 - Format of Expiry Date is incorrect';
	 
	
}
// If Country of Citizenship = NZL and EXPIRY DATE is not NULL
else if ($this->mappedData['COUNTRY OF CITIZENSHIP'] == "NZL" && !is_null($data)){
		$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = '658 - NZ Citizens should not have an Expiry Date';
	 
}
// If Eligibility Criteria in [20199, 60001] and EXPIRY DATE is not NULL
else if (in_array($this->mappedData['Eligibility Criteria'], array('20199', '60001')) && !is_null($data)){
		$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = '660 - NZ Citizens should not have an Expiry Date';
	 
}

// If Eligibility Criteria in [20201, 60002] and EXPIRY DATE is not NULL
else if (in_array($this->mappedData['Eligibility Criteria'], array('20201', '60002')) && !is_null($data)){
		$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = '661 - Australian Citizens should not have an Expiry Date';
	 
}
// If Eligibility Criteria in [20200, 60003] and EXPIRY DATE is not NULL

else if (in_array($this->mappedData['Eligibility Criteria'], array('20200', '60003')) && !is_null($data)){
		$this->moe[$number]['valid'] = 'false';
		$this->moe[$number]['value'] = '662 - NZ Residents should not have an Expiry Date';
	 
}
// If TYPE in [FF, EX, NF] and EXPIRY DATE is not NULL and REASON is NULL and EXPIRY DATE < Roll Count Date
else if (in_array($this->mappedData['TYPE'], array('FF', 'EX', 'NF')) && is_null($this->mappedData['REASON']) &&!is_null($data)  && $data < $this->rollCountDate ){
		$this->moe[$number]['valid'] = 'true';
		$this->moe[$number]['value'] = $data;
		$this->moe[$number]['message'] =  "663 - Student's Verification Document has expired";
	 
}
else {

	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}

public function check_110(){$this->moe[110]=array("Field Name"=>"STP", "LINC Name"=>"STP","Field No"=>"110", "Description"=>"Indicates which Secondary Tertiary Programme the student is attending","Mandatory"=>"NO","Type"=>"Controlled value code list"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 110;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

// If STP is not NULL and age on 1st January>= 19

if (!is_null($data) && $this->returnAgeOnJan01 >=19){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '654 - Adult students cannot be attending an STP';
	
}
// If STP is not NULL and CURRENT YEAR LEVEL not in [11,12,13]

else if (!is_null($data) && !in_array($this->mappedData['CURRENT YEAR LEVEL'], array('11', '12', '13'))){
	
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = '655 - Students attending an STP must be in Current Year Level 11,12 or 13';
	
}

else {
	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	}
}

public function check_111(){$this->moe[111]=array("Field Name"=>"WITHHOLD CONTACT DETAILS", "LINC Name"=>"WITHHOLD CONTACT DETAILS",  "Content Type"=> 'metacontent', "Field No"=>"111", "Description"=>"Flag to indicate that contact details should not be provided to MSD","Mandatory"=>"NO","Type"=>"Alpha"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 111;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;}


public function check_112(){
	
	$this->moe[112]=array("Field Name"=>"HOME PHONE NUMBER", "ICON"=> 'phone', "Field Label"=>"Home Phone Number",  "Content Type"=> 'metacontent', "LINC Name"=>"Phone","Field No"=>"112", "Description"=>"Student's home phone number","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 112;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
		
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
return $this->moe[$number]['valid'] ;	}


public function check_113(){$this->moe[113]=array("Field Name"=>"CELL PHONE NUMBER", "ICON"=> 'mobile', "Field Label"=>"Mobile Phone Number",  "Content Type"=> 'metacontent', "LINC Name"=>"mobile_phone","Field No"=>"113", "Description"=>"Student's cell phone number","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 113;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
return $this->moe[$number]['valid'] ;	

}


public function check_114(){

	$this->moe[114]=array("Content Type"=> 'metacontent', "ICON"=> 'phone',"Field Name"=>"ALTERNATIVE PHONE NUMBER","LINC Name"=>"ALTERNATIVE PHONE NUMBER","Field No"=>"114", "Description"=>"Alternative phone number for the student or home","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 114;
$data = $this->mappedData[$this->moe[$number]['LINC Name']];


	$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	

	
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';

return $this->moe[$number]['valid'] ;	
	
	}


public function check_115(){$this->moe[115]=array("Field Name"=>"EMAIL ADDRESS",  "ICON"=> "mail", "Field Label"=>"Primary email address", "Content Type"=> 'metacontent',  "Placeholder"=>"Main contact email address", "LINC Name"=>"email_address","Field No"=>"115", "Description"=>"Student's email address (out of school email where possible)","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'Email addresses are useful to have stored. They are not however required by the Ministry of Education'
);

$number = 115;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

if (is_email($data)){
$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
}
else {
	$this->moe[$number]['valid'] = 'false';
	$this->moe[$number]['value'] = $this->moe[$number]['message'];	
}


if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';

	}


public function check_116(){$this->moe[116]=array("Field Name"=>"CONTACT 1 SURNAME", "ICON"=> "user-plus",  "Content Type"=> "metacontent","Field Label"=>"First Contact Last Name", "LINC Name"=>"contact_1_last_name","Field No"=>"116", "Description"=>"Surname of the first contact person or primary care giver, or combined name if not held separately.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 116;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_117(){$this->moe[117]=array("Field Name"=>"CONTACT 1 FIRSTNAME",  "ICON"=> "user-plus", "Content Type"=> "metacontent", "Field Label"=>"First Contact First Name", "LINC Name"=>"contact_1_first_name","Field No"=>"117", "Description"=>"First name of the first contact person or primary care giver, if held separately.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 117;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';	
	}


public function check_118(){$this->moe[118]=array("Field Name"=>"CONTACT 1 ADDRESS1",  "ICON"=> "envelop","Content Type"=> "metacontent", "Field Label"=>"First Contact Address line 1", "LINC Name"=>"contact_1_address1","Field No"=>"118", "Description"=>"First address line of the first contact person or primary care giver. If address is not split into individual lines, the whole address.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 118;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_119(){$this->moe[119]=array("Content Type"=> "metacontent",  "ICON"=> "envelop","Field Label"=>"First Contact Address line 2", "Field Name"=>"CONTACT 1 ADDRESS2", "LINC Name"=>"contact_1_address2","Field No"=>"119", "Description"=>"Second address line of the first contact person or primary care giver.","Mandatory"=>"NO","Type"=>"V"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 119;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_120(){$this->moe[120]=array("Content Type"=> 'metacontent',  "ICON"=> "envelop", "Field Label"=>"First Contact Address line 3","Field Name"=>"CONTACT 1 ADDRESS3", "LINC Name"=>"contact_1_address3","Field No"=>"120", "Description"=>"Third address line of the first contact person or primary care giver.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 120;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_121(){$this->moe[121]=array("Content Type"=> 'metacontent',  "ICON"=> "envelop", "Field Name"=>"CONTACT 1 ADDRESS4", "Field Label"=>"First Contact address line 4", "LINC Name"=>"contact_1_address4","Field No"=>"121", "Description"=>"Fourth address line of the first contact person or primary care giver.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 121;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';}


public function check_122(){$this->moe[122]=array("Content Type"=> 'metacontent', "ICON"=> "envelop",  "Field Label"=>"First Contact postcode", "Field Name"=>"CONTACT 1 ADDRESS5", "LINC Name"=>"contact_1_address5","Field No"=>"122", "Description"=>"Post Code for the first contact person or primary care giver.","Mandatory"=>"NO","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 122;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
}


public function check_123(){$this->moe[123]=array("Content Type"=> 'metacontent', "ICON"=> "mobile", "Field Label"=>"First contact mobile number", "Field Name"=>"CONTACT 1 PHONE NUMBER", "LINC Name"=>"contact_1_mobile", "Field No"=>"123", "Description"=>"Phone number for the first contact person or primary care giver.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 123;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_124(){$this->moe[124]=array("Content Type"=> 'metacontent', "ICON"=> "user-plus",  "Field Label"=>"Second contact last name", "Field Name"=>"CONTACT 2 SURNAME", "LINC Name"=>"contact_2_last_name","Field No"=>"124", "Description"=>"Surname of the second contact person or primary care giver, or combined name if not held separately.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 124;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_125(){$this->moe[125]=array("Content Type"=> 'metacontent',"ICON"=> "user-plus", "Field Label"=>"Second contact first name", "Field Name"=>"CONTACT 2 FIRSTNAME", "LINC Name"=>"contact_2_first_name","Field No"=>"125", "Description"=>"Second name of the second contact person or alternative caregiver, if held separately.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 125;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_126(){$this->moe[126]=array("Content Type"=> 'metacontent',"ICON"=> "envelop", "Field Label"=>"Second contact address line 1", "Field Name"=>"CONTACT 2 ADDRESS1", "LINC Name"=>"contact_2_address1", "Field No"=>"126", "Description"=>"First address line of the second contact person or alternative care giver. If address is not split into individual lines, the whole address.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 126;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_127(){$this->moe[127]=array("Content Type"=> 'metacontent', "ICON"=> "envelop", "Field Label"=>"Second contact address line 2", "Field Name"=>"CONTACT 2 ADDRESS2", "LINC Name"=>"contact_2_address2","Field No"=>"127", "Description"=>"Second address line of the second contact person or alternative care giver.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 127;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_128(){$this->moe[128]=array("Content Type"=> 'metacontent', "ICON"=> "envelop",  "Field Label"=>"Second contact address line 3", "Field Name"=>"CONTACT 2 ADDRESS3", "LINC Name"=>"contact_2_address3","Field No"=>"128", "Description"=>"Third address line of the second contact person or alternative care giver.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 128;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	
	$this->moe[$number]['value'] = $data;
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_129(){$this->moe[129]=array("Content Type"=> 'metacontent', "ICON"=> "envelop",  "Field Label"=>"Second contact address line 4", "Field Name"=>"CONTACT 2 ADDRESS4", "LINC Name"=>"contact_2_address4","Field No"=>"129", "Description"=>"Fourth address line of the second contact person or alternative care giver. If address is not split leave blank.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 129;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_130(){$this->moe[130]=array("Content Type"=> 'metacontent', "ICON"=> "envelop",  "Field Label"=>"Second contact postcode", "Field Name"=>"CONTACT 2 ADDRESS5", "LINC Name"=>"contact_2_address5","Field No"=>"130", "Description"=>"Post Code for the second contact person or alternative care giver.","Mandatory"=>"NO","Type"=>"Numeric (Natural number)"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 130;


$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}


public function check_131(){
	
	$this->moe[131]=array("Content Type"=> 'metacontent', "Field Name"=>"CONTACT 2 PHONE NUMBER", "ICON"=> 'mobile', "Field Label"=>"Second contact mobile number", "Field No"=>"131", "LINC Name"=>"contact_2_mobile", "Description"=>"Phone number for the second contact person or alternative care giver.","Mandatory"=>"NO","Type"=>"ASCII"
, 'valid'=>'',
'value' =>'', 'message' =>'',
'input_field'=>'',
'input_label'=>''
);

$number = 131;

$data = $this->mappedData[$this->moe[$number]['LINC Name']];

$this->moe[$number]['valid'] = 'true';
	$this->moe[$number]['value'] = $data;
	
	if ($this->moe[$number]['valid']=='false'){
	if ($this->moe[$number]['Mandatory']=="YES"){
		$warning = 'warning-2';	
	}
	else {
		$warning = 'warning';	
	}
	
	$this->moe[$number]['input_label'] = '<label id="'.$this->moe[$number]['LINC Name'] .$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="error"><i class="font-'.$this->moe[$number]['ICON'] .'"  ></i> '.$this->moe[$number]['Field Label'] .': <i class="font-'. $warning .'"  ></i></span>'.linc_popupmessage( $this->moe[$number]['LINC Name'],  $this->moe[$number]['Field Label'], $this->moe[$number]['Description']).'</label>';
				
		}
		else if ($this->moe[$number]['valid']=='true'){

		$this->moe[$number]['input_label'] =  '<label  id="'.$this->moe[$number]['LINC Name'].$this->person_id.'_label" for="'.$this->moe[$number]['LINC Name'] .$this->person_id.'"><span class="valid"><i class="font-'.$this->moe[$number]['ICON'].'"  ></i> '.$this->moe[$number]['Field Label'].': <i class="font-checkmark-3"  ></i></span></label>';
			
		}
		
	
$this->moe[$number]['input_field'] = '<input type="text" class="'.$this->moe[$number]['Content Type'].'" data-arraypos="'.$this->moe[$number]['Field No'].'" name="'.$this->moe[$number]['LINC Name'].'" data-id="'.$this->person_id.'" id="'.$this->moe[$number]['LINC Name'].$this->person_id.'" value="'.$this->moe[$number]['value'].'" data-theme="'.$theme.'" placeholder="'.$this->moe[$number]['Placeholder'].'"/>';
	}




public function check_all(){

$this->moe[1000]=array("Field Name"=>"Errors", "Field No"=>"1000", "Description"=>"List of general errors.", "Mandatory"=>"NO", "Type"=>"", 
'valid'=>'',
'value' =>'', 
'message' =>'',
'input_field'=>'',
'input_label'=>''
);


$this->moe[1001]=array("Field Name"=>"Warnings", "Field No"=>"1001", "Description"=>"List of general errors.", "Mandatory"=>"NO", "Type"=>"", 
'valid'=>'',
'value' =>'', 
'message' =>'',
'input_field'=>'',
'input_label'=>''
);

// If Rmonth="J" and any SUBJECT code appears more than once in a students record within the same instructional year level
$subjects = array (
'31'=>$this->moe[31]['value'],
'35'=>$this->moe[35]['value'],
'39'=>$this->moe[39]['value'],
'43'=>$this->moe[43]['value'],
'47'=>$this->moe[47]['value'],
'51'=>$this->moe[51]['value'],
'55'=>$this->moe[55]['value'],
'59'=>$this->moe[59]['value'],
'63'=>$this->moe[63]['value'],
'67'=>$this->moe[67]['value'],
'71'=>$this->moe[71]['value'],
'75'=>$this->moe[75]['value'],
'79'=>$this->moe[79]['value'],
'83'=>$this->moe[83]['value'],
'87'=>$this->moe[87]['value'],
);



// If Age of student is < 5 on roll count day and TYPE is RE
if ($this->ageOnReturnDate < 5 && $this->mappedData['TYPE'] == "RE"){
	$this->moe[1001]['message'] .= 'Student must be at least 5 years old on Roll count day to be included in the roll count for your school';
}

}

public function dataForTableM3(){
	$this->validate();
	
	$first = $this->moe[8];
	$funding = $this->moe[17];
	$type = $this->moe[18];
	$fte = $this->moe[23];
	if ($this->moe[25]['valid']== 'true'){
		$last = $this->moe[25];
	}
	$gender = $this->moe[6];
	$dob = $this->moe[7];
	if ($this->moe[110]['valid']== 'true'){
		$stp = $this->moe[110];
	}
	$data = array(
	'FIRST ATTENDANCE' => $first, 
	'FUNDING YEAR LEVEL'=> $funding, 
	'TYPE'=>$type, 
	'FTE'=>$fte, 
	'LAST ATTENDANCE'=>$last, 
	'GENDER' =>$gender, 
	'DOB'=>$dob,
	'STP'=>$stp);
	
	return $data;	
	
}

}


?>