<?php

class progressArray{


public function returnStandardOnDate($date, $startDate, $current_year, $funding_year){
	

$progress =$this->returnProgressArray($startDate, $current_year, $funding_year);
var_dump($progress);
 foreach ($progress	 as $p){
	 
	 $thisDate = DateTime::createFromFormat('Y-m-d', $date);
$periodDateBegin = DateTime::createFromFormat('Y-m-d', $p['prevDate']);
$periodDateEnd = DateTime::createFromFormat('Y-m-d', $p['date']);

if ($thisDate >= $periodDateBegin && $thisDate <= $periodDateEnd)
		{
		
			 $array = array ('index'=>$p['index'], 'statement'=> $p['statement'], 'statement2'=> $p['statement2'], 'level'=>$p['level'], 'cycle'=>$p['cycleNumber'], 'cycleid'=>$p['cycle'],'label'=>$p['label'], 'xaxis'=>$p['xaxis'], 'measure'=>$p['measure'], 'measure2'=>$p['measure2'], 'link_heading'=>$p['link_heading'], 'prevDate'=>$p['prevDate'], 'last'=>$p['last'], 'anniversary'=> $p['anniversary']);
			 break;
		}
		 
 }

 return $array;
}

public function returnProgressArray($startDate, $current_year, $funding_year ){
			
		$cycles = cycleArray();
		
		$d1 = new DateTime("NOW");
		$array = array();	
		$currentCycle = get_cycle_by_date($d1->format('Y-m-d'));

$d2 = new DateTime(date("Y-m-d", strtotime($startDate) )); // date stated school for the first time (usually their fifth birthday.
$monthsatschool = ($d1->diff($d2)->m + ($d1->diff($d2)->y*12)); // int(8)
$startmonth = date('m', strtotime($startDate));
$startyear = date('Y', strtotime($startDate));

$thisCycle = get_cycle_by_date($d2->format('Y-m-d'));

$prev = $thisCycle['end'];
$d2->modify('+6 months');
	
	
if ($d2->format('m') == 1){ // correct the problem where by adding six months will kick date into next year and skew the date for next standard.

	$d2->modify('-1 month');

}
else if ($d2->format('m') == 8  ){ // correct the problem where a student started at the beginning of the year and so needs to be measured against standard the following february.

	$d2->modify('-2 month');

}

$thisCycle = get_cycle_by_date($d2->format('Y-m-d'));
$setCurrent = false;
$current = 0;	
if ($thisCycle['cycleId'] == $currentCycle['cycleId']){
	$current = 1;	
	$setCurrent = true;
}


	$array[$thisCycle['cycleId']] = array('index'=>1, 'current'=>$current, 'level'=>0, 'prevDate'=>$prev, 'cycle'=>$thisCycle['cycleId'], 
	'xaxis'=> '6 months at school', 'xaxis2'=> '20 weeks at school', 'link_heading'=>'After-one-year', 'statement'=> 'One Year at School National Standard', 'statement2'=> '40 Weeks at School National Standard', 'label'=>'Less than six months at school.', 'measure'=>'one year', 'measure2'=>'40 weeks', 'Year'=>$thisCycle['Year'],
'date'=> $thisCycle['end'], 'cycleNumber'=>$thisCycle['cycleNumber'], 'anniversary'=> $d2->format('Y-m-d')); // six months after started. No standard.
$lastId =$thisCycle['cycleId'];
$thisCycle = get_cycle_by_date($d2->format('Y-m-d'));
$prev = $thisCycle['end'];
$d2->modify('+6 months');
$thisCycle = get_cycle_by_date($d2->format('Y-m-d'));
$month = $d2->format('m');
$year = $d2->format('Y');

if ($thisCycle['cycleId'] == $currentCycle['cycleId'] && $setCurrent !=true){
	$current = 1;	
	$setCurrent = true;
}
else {
	$current=0;	
}
$array[$thisCycle['cycleId']] = array('index'=>2,  'last'=> $lastId, 'current'=>$current, 'level'=>1, 'prevDate'=>$prev, 'cycle'=>$thisCycle['cycleId'], 'statement'=> 'One Year at School National Standard', 'statement2'=> '40 Weeks at School National Standard', 'xaxis'=> '1 year at school', 'xaxis2'=> '40 weeks at school', 'link_heading'=>'After-one-year', 'label'=>'Next OTJ will be for the One Year at School National Standard.', 'measure'=>'one year', 'measure2'=>'40 weeks','Year'=>$thisCycle['Year'],
'date'=> $thisCycle['end'], 'cycleNumber'=>$thisCycle['cycleNumber'], 'anniversary'=> $d2->format('Y-m-d')); // one year after starting 1 year at school standard.

$lastId =$thisCycle['cycleId'];
$prev = $thisCycle['end'];
	$d2->modify('+6 months');
	if ($d2->format('m') == 1){ // correct the problem where by adding six months will kick date into next year and skew the date for next standard.

	$d2->modify('-1 month');

}
$thisCycle = get_cycle_by_date($d2->format('Y-m-d'));
$month = $d2->format('m');
$year = $d2->format('Y');
if ($thisCycle['cycleId'] == $currentCycle['cycleId'] && $setCurrent !=true){
	$current = 1;	
	$setCurrent = true;
}
else {
	$current=0;	
}

$array[$thisCycle['cycleId']] = array('index'=>3,  'last'=> $lastId,  'current'=>$current, 'level'=>2, 'prevDate'=>$prev,'cycle'=>$thisCycle['cycleId'], 'statement'=> 'Two Years at School National Standard', 'statement2'=> '80 Weeks at School National Standard', 'measure2'=>'80 weeks', 'xaxis'=> '18 months at school', 'xaxis2'=> '60 weeks at school', 'link_heading'=>'After-two-years', 'label'=>'Next OTJ will be progress towards the Two Years at School National Standard.','measure'=>'two years', 'Year'=>$thisCycle['Year'],
'date'=> $thisCycle['end'], 'cycleNumber'=>$thisCycle['cycleNumber'], 'anniversary'=> $d2->format('Y-m-d'));// eighteen months after starting interim 2 years at school standard.
$lastId =$thisCycle['cycleId'];
$prev = $thisCycle['end'];
$d2->modify('+6 months');
if ($d2->format('m') == 1){ // correct the problem where by adding six months will kick date into next year and skew the date for next standard.

	$d2->modify('-1 month');

}
$thisCycle = get_cycle_by_date($d2->format('Y-m-d'));
$month = $d2->format('m');
$year = $d2->format('Y');
if ($thisCycle['cycleId'] == $currentCycle['cycleId'] && $setCurrent !=true){
	$current = 1;	
	$setCurrent = true;
}
else {
	$current=0;	
}


$array[$thisCycle['cycleId']] = array('index'=>4,  'last'=> $lastId, 'current'=>$current, 'level'=>2, 'prevDate'=>$prev,'cycle'=>$thisCycle['cycleId'], 'statement'=> 'Two Years at School National Standard','xaxis'=> '2 years at school',  'statement2'=> '80 Weeks at School National Standard', 'measure2'=>'80 weeks', 'xaxis2'=> '80 weeks at school',  'link_heading'=>'After-two-years', 'label'=>'Next OTJ will be for the Two Years at School National Standard.','measure'=>'two years', 'Year'=>$thisCycle['Year'],
'date'=> $thisCycle['end'], 'cycleNumber'=>$thisCycle['cycleNumber'], 'anniversary'=> $d2->format('Y-m-d'));// two years after starting 2 year at school standard.
$lastId =$thisCycle['cycleId'];
$prev = $thisCycle['end'];
$d2->modify('+6 months');
if ($d2->format('m') == 1){ // correct the problem where by adding six months will kick date into next year and skew the date for next standard.

	$d2->modify('-1 month');

}
$thisCycle = get_cycle_by_date($d2->format('Y-m-d'));
$month = $d2->format('m');
$year = $d2->format('Y');
if ($thisCycle['cycleId'] == $currentCycle['cycleId'] && $setCurrent !=true){
	$current = 1;	
	$setCurrent = true;
}
else {
	$current=0;	
}

$array[$thisCycle['cycleId']] = array('index'=>5,  'last'=> $lastId,  'current'=>$current, 'level'=>3, 'prevDate'=>$prev,'cycle'=>$thisCycle['cycleId'],'statement'=> 'Three Years at School National Standard','xaxis'=> '30 months at school', 'statement2'=> '120 Weeks at School National Standard', 'measure2'=>'120 weeks', 'xaxis2'=> '100 weeks at school',   'link_heading'=>'After-three-years','label'=>'Next OTJ will be progress towards the Three Years at School National Standard.','measure'=>'three years', 'Year'=>$thisCycle['Year'],
'date'=> $thisCycle['end'], 'cycleNumber'=>$thisCycle['cycleNumber'], 'anniversary'=> $d2->format('Y-m-d'));// thirty months after starting interim 3 years at school standard.
$lastId =$thisCycle['cycleId'];
$prev = $thisCycle['end'];
$d2->modify('+6 months');
if ($d2->format('m') == 1){ // correct the problem where by adding six months will kick date into next year and skew the date for next standard.

	$d2->modify('-1 month');

}
$thisCycle = get_cycle_by_date($d2->format('Y-m-d'));

if ($thisCycle['cycleId'] == $currentCycle['cycleId'] && $setCurrent !=true){
	$current = 1;	
	$setCurrent = true;
}
else {
	$current=0;	
}

$array[$thisCycle['cycleId']] = array('index'=>6,  'last'=> $lastId,  'current'=>$current, 'level'=>3, 'prevDate'=>$prev,'cycle'=>$thisCycle['cycleId'], 'statement'=> 'Three Years at School National Standard', 'xaxis'=> '3 years at school',  'statement2'=> '120 Weeks at School National Standard', 'measure2'=>'120 weeks',  'xaxis2'=> '120 weeks at school',  'link_heading'=>'After-three-years', 'label'=>'Next OTJ will be the Three Years at School National Standard.','measure'=>'three years', 'Year'=>$thisCycle['Year'],
'date'=> $thisCycle['end'], 'cycleNumber'=>$thisCycle['cycleNumber'], 'anniversary'=> $d2->format('Y-m-d'));// three years after starting 3 year at school standard.
$lastId =$thisCycle['cycleId'];
$prev = $thisCycle['end'];

$d2->modify('+6 months'); // add a further six months to the previous date
$thisCycle = get_cycle_by_date($d2->format('Y-m-d'));
if ($thisCycle['cycleNumber']==2){
	if (date('m', strtotime($prev))==7){
			$array[$thisCycle['cycleId']] = array('index'=>6,  'last'=> $lastId,  'current'=>$current, 'level'=>3, 'prevDate'=>$prev,'cycle'=>$thisCycle['cycleId'], 'statement'=> 'Three Years at School National Standard', 'xaxis'=> '3 years at school',  'statement2'=> '120 Weeks at School National Standard', 'measure2'=>'120 weeks',  'xaxis2'=> '120 weeks at school',  'link_heading'=>'After-three-years', 'label'=>'Next OTJ will be the Three Years at School National Standard.','measure'=>'three years', 'Year'=>$thisCycle['Year'],
'date'=> $thisCycle['end'], 'cycleNumber'=>$thisCycle['cycleNumber'], 'anniversary'=> $d2->format('Y-m-d'));// three years after starting 3 year at school standard.
	}
}
$lastId =$thisCycle['cycleId'];
// after three years at school need to work out whether the next cycle is an interim one of an end of year one.



$year4onwardsArray['41'] = array(
'index' => 7, 
'xaxis'=> 'Mid Year 4',
'xaxis2'=> 'Mid Year 4',
'level'=>4,
'link_heading'=>'End-of-year-4', 
'label' =>'Next OTJ will be progress towards the end of Year Four National Standard.',
'statement'=>'end of Year Four National Standard',
 'statement2'=> 'end of Year Four National Standard',
 'measure'=>'Year 4'  , 'measure2'=>'Year 4'

);
$year4onwardsArray['42'] = array(
'index' => 8, 
'xaxis'=> 'End Year 4',
'xaxis2'=> 'End Year 4',
'level'=>4,
'link_heading'=>'End-of-year-4', 
'label' =>'Next OTJ will be the end of Year Four National Standard.',
'statement'=>'end of Year Four National Standard',
'statement2'=>'end of Year Four National Standard',
 'measure'=>'Year 4'  , 'measure2'=>'Year 4'
);
$year4onwardsArray['51'] = array(
'index' => 9, 
'xaxis'=> 'Mid Year 5',
'xaxis2'=> 'Mid Year 5',
'level'=>5,
'link_heading'=>'End-of-year-5', 
'label' =>'Next OTJ will be progress towards the end of Year Five National Standard.',
'statement'=>'end of Year Five National Standard',
'statement2'=>'end of Year Five National Standard',
 'measure'=>'Year 5'  , 'measure2'=>'Year 5'
);
$year4onwardsArray['52'] = array(
'index' => 10, 
'xaxis'=> 'End Year 5',
'xaxis2'=> 'End Year 5',
'level'=>5,
'link_heading'=>'End-of-year-5', 
'label' =>'Next OTJ will be the end of Year Five National Standard.',
'statement'=>'end of Year Five National Standard',
'statement2'=>'end of Year Five National Standard',
 'measure'=>'Year 5'  , 'measure2'=>'Year 5'

);
$year4onwardsArray['61'] = array(
'index' => 11, 
'xaxis'=> 'Mid Year 6',
'xaxis2'=> 'Mid Year 6',
'level'=>6,
'link_heading'=>'End-of-year-6', 
'label' =>'Next OTJ will be progress towards the end of Year Six National Standard.',
'statement'=>'end of Year Six National Standard',
'statement2'=>'end of Year Six National Standard',
 'measure'=>'Year 6' , 'measure2'=>'Year 6'
);
$year4onwardsArray['62'] = array(
'index' => 12, 
'xaxis'=> 'End Year 6',
'xaxis2'=> 'End Year 6',
'level'=>6,
'link_heading'=>'End-of-year-6', 
'label' =>'Next OTJ will be the end of Year Six National Standard.',
'statement'=>'end of Year Six National Standard',
'statement2'=>'end of Year Six National Standard',

 'measure'=>'Year 6' , 'measure2'=>'Year 6'
);
$year4onwardsArray['71'] = array(
'index' => 13,
'xaxis'=> 'Mid Year 7',
'xaxis2'=> 'Mid Year 7', 
'level'=>7,
'link_heading'=>'End-of-year-7', 
'label' =>'Next OTJ will be progress towards the end of Year Seven National Standard.'
,
'statement'=>'end of Year Seven National Standard',
'statement2'=>'end of Year Seven National Standard',
 'measure'=>'Year 7' , 'measure2'=>'Year 7'
);
$year4onwardsArray['72'] = array(
'index' => 14, 
'xaxis'=> 'End Year 7',
'xaxis2'=> 'End Year 7',
'level'=>7,
'link_heading'=>'End-of-year-7', 
'label' =>'Next OTJ will be the end of Year Seven National Standard.',
'statement'=>'end of Year Seven National Standard',
'statement2'=>'end of Year Seven National Standard',
 'measure'=>'Year 7' , 'measure2'=>'Year 7'
);
$year4onwardsArray['81'] = array(
'index' => 15, 
'xaxis'=> 'Mid Year 8',
'xaxis2'=> 'Mid Year 8',
'level'=>8,
'link_heading'=>'End-of-year-8', 
'label' =>'Next OTJ will be progress towards the end of Year Eight National Standard.',
'statement'=>'end of Year Eight National Standard',
'statement2'=>'end of Year Eight National Standard',
 'measure'=>'Year 8',
  'measure2'=>'Year 8'

);
$year4onwardsArray['82'] = array(
'index' => 16, 
'xaxis'=> 'End Year 8',
'xaxis2'=> 'End Year 8',
'level'=>8,
'link_heading'=>'End-of-year-8', 
'label' =>'Next OTJ will be the end of Year Eight National Standard.',
'statement'=>'end of Year Eight National Standard',
'statement2'=>'end of Year Eight National Standard',
 'measure'=>'Year 8',
  'measure2'=>'Year 8'
);


	
	if ($d2->format('m') <=7 || $thisCycle['cycleNumber']==2 ){ // if this date is now  earlier than july, use it to find the cycle.
		$thisCycle = get_cycle_by_date($d2->format('Y-m-d'));
	
		$moe = $this->returnMoeLevelArray($d2->format('Y-m-d'), $startDate, $current_year, $funding_year); // yeargroup six months after the last OTJ
		
		$cycleNumber =1;
	}
	else {

		$moe = $this->returnMoeLevelArray($d2->format('Y-m-d'), $startDate, $current_year, $funding_year); // yeargroup at time of the last OTJ
		$cycleNumber =2;
	}


if ($thisCycle['cycleId'] == $currentCycle['cycleId']){
	$finalCycleYearThreeId =$thisCycle['cycleId'];
	$current = 1;	
	$setCurrent = true;
}
else {
	$current=0;	
}




	$startCycle = $thisCycle['Key'];
	$i=$moe['OTJ'];


	foreach ($cycles as $key=>$cycle){
		if ($i >8 ){
		}
		else {
			if ($cycle['Key']<$startCycle ){
			
		}
		else {
				if ($cycle['cycleId'] == $currentCycle['cycleId'] ){
					$current = 1;
					$setCurrent = true;	
				}
				else {
					$current=0;	
				}
				 if ($cycle['cycleNumber']==1){ // check whether cycle is start of year or end. Start means an interim report is due.
					 if($i>3){
						$array[$cycle['cycleId']] = array('index'=>$year4onwardsArray[$i.'1']['index'],  'last'=>$lastId, 'current'=>$current, 'level'=>$i,'prevDate'=>$cycle['start'],'cycle'=>$cycle['cycleId'], 'label'=>$year4onwardsArray[$i.'1']['label'], 'xaxis'=>$year4onwardsArray[$i.'1']['xaxis'] , 'xaxis2'=>$year4onwardsArray[$i.'1']['xaxis'] , 'date'=> $cycle['end'], 'anniversary'=>$cycle['end'], 'cycleNumber'=>$cycle['cycleNumber'], 'statement'=>$year4onwardsArray[$i.'1']['statement'], 'statement2'=>$year4onwardsArray[$i.'1']['statement2'], 'link_heading'=>$year4onwardsArray[$i.'1']['link_heading'], 'Year'=>$cycle['Year'], 'measure'=>$year4onwardsArray[$i.'1']['measure'], 'measure2'=>$year4onwardsArray[$i.'1']['measure2']);
						
						$prev = $cycle['end'];
						$lastId =$cycle['cycleId'];
					 }
				
				 }
				 else if ($cycle['cycleNumber']==2){ 
				  if($i>3){
						$array[$cycle['cycleId']] = array('index'=>$year4onwardsArray[$i.'2']['index'], 'last'=>$lastId,   'current'=>$current, 'level'=>$i,'prevDate'=>$cycle['start'],'cycle'=>$cycle['cycleId'], 'label'=>$year4onwardsArray[$i.'2']['label'], 'date'=> $cycle['end'], 'anniversary'=>$cycle['end'], 'xaxis'=>$year4onwardsArray[$i.'2']['xaxis'] , 'xaxis2'=>$year4onwardsArray[$i.'2']['xaxis'] , 'cycleNumber'=>$cycle['cycleNumber'], 'statement'=>$year4onwardsArray[$i.'2']['statement'],'statement2'=>$year4onwardsArray[$i.'2']['statement2'], 'link_heading'=>$year4onwardsArray[$i.'2']['link_heading'],'Year'=>$cycle['Year'], 'measure'=>$year4onwardsArray[$i.'2']['measure'], 'measure2'=>$year4onwardsArray[$i.'2']['measure2']);
					
					$prev =  $cycle['end'];
						$lastId =$cycle['cycleId'];
				  }
					$i++; 	
				 }
				
		}
		}
		
	}


		return $array;
		
	}
	
public function returnMoeLevelArray($date='', $startDate, $current, $funding){
	
	$array = $this->return_moe_standard_year($startDate, $current, $funding, $date);
	
	return $array;					
		
	}

private function return_moe_standard_year($startdate='', $currentYear, $fundingYear, $date=''){
	
	$moe = new MOEDates($startdate, $currentYear, $fundingYear, $date);
	
	$array = $moe->current_OTJ_due();
	
	return $array;

}

}
class MOEDates{

	private $startdate;
	private $startyear;
	private $startmonth;	
	private $startday;
	public $type;
	private $today;
	private $todayear;
	private $todaymonth;	
	private $todayday;
	private $currentYear;
	private $fundingYear;		
	
	
	
	public function __construct($startdate='', $currentYear, $fundingYear, $calculationDate){	
		
	
	
	if ($calculationDate){
			$this->today = date('Y-m-d', strtotime($calculationDate)); // Today.
			
			$todaysdate = explode("-", $calculationDate); 
			$this->todayyear =  $todaysdate[0]; // The year today.
			$this->todaymonth = $todaysdate[1];// The month today.
			$this->todayday = $todaysdate[2];// The day today.
			
			$yearnow = date('Y');
			
			$offset = $yearnow - $this->todayyear;
			
			
			$this->startdate= $startdate; // date the student started school.
			if ($currentYear - $offset<1){
			$this->currentYear =0;
			}
			else {
			$this->currentYear = $currentYear - $offset; // The student's current school year level eg 4
			}
			$this->fundingYear = $fundingYear - $offset; // The student's ministry year level eg 4
		
			$date = explode("-", $this->startdate);
			$this->startyear =  $date[0]; // Year they started school.
			$this->startmonth = $date[1]; // Month they started school.
			$this->startday = $date[2]; // Day they started school.
	}
	else { // use todays date if no dates has been passed through.
		
		$this->today = date('Y-m-d'); // Today.
			
			$todaysdate = explode("-", $this->today); 
			$this->todayyear =  $todaysdate[0]; // The year today.
			$this->todaymonth = $todaysdate[1];// The month today.
			$this->todayday = $todaysdate[2];// The day today.
			
			$this->startdate= $startdate; // date the student started school.
			$this->currentYear = $currentYear; // The student's current school year level eg 4
			$this->fundingYear = $fundingYear; // The student's ministry year level eg 4
		
			$date = explode("-", $this->startdate);
			$this->startyear =  $date[0]; // Year they started school.
			$this->startmonth = $date[1]; // Month they started school.
			$this->startday = $date[2]; // Day they started school.
	}
	if ($this->startmonth == 1 || $this->startmonth == 2){
		$this->type = "A";	// The ministry of Education identifies students as type A if they started school before March 1st ie in month 1 or 2 of the year. 
	}
	else if ($this->startmonth>2 && $this->startmonth <7){
		if ($this->currentYear == $this->fundingYear){
			$this->type ="B";	// The ministry of Education identifies students as type B if they started school between March 1st and July 1st. 
		}
		else if ($this->currentYear < $this->fundingYear){
			$this->type ="C";	// The ministry of Education identifies students as type C if they started school between March 1st and July 1st but have been held back a year eg they are funded as year 3 but are in school year 2. 	
		}
	}
	else {
		if ($this->currentYear == $this->fundingYear){
			$this->type ="D";	// The ministry of Education identifies students as type D if they started school after July 1. 
		}
		else if ($this->currentYear > $this->fundingYear){
			$this->type ="E";	// The ministry of Education identifies students as type E if they started school between March 1st and July 1st but have been promoted a year eg they are funded as year 3 but are in school year 4. 	
		}
	
	}
	
	}
	
	public function current_OTJ_due(){
	
	switch ($this->type){	
		case "A";	//Type A Student
			 if ($this->todaymonth <11 && $this->todayyear== $this->startyear){
				
				$array = array('OTJ'=>0, 'School'=>0, 'Ministry'=>false, 'type'=>'A', 'desc'=>'Type A started school before March 1 and is progressing through the school years as expected.');// do not include in ministry figures if it is not december and the start year is the same as the current year.
			}
			
			else {
				
				$array = array('OTJ'=>$this->currentYear, 'School'=>$this->currentYear, 'Ministry'=>true, 'type'=>'A', 'desc'=>'Type A started school before March 1 and is progressing through the school years as expected.');
			
			}
			
			
			
		break;
		case "B";	//Type B Student
			 if ($this->todayyear==$this->startyear){
				
				$array = array('OTJ'=>0, 'School'=>0, 'Ministry'=>false, 'type'=>'B', 'desc'=>'The Ministry of Education identifies students as type B if they started school between March 1st and July 1st. A child who started school for the first time last year and is identified as type B is measured against the National Standard for 1 year at school.');// do not include in ministry if the start year is the same as the current year.
			}
			else if (($this->todayyear-$this->startyear)==1){
				
				$array = array('OTJ'=>1, 'Ministry'=>true, 'type'=>'B', 'desc'=>'The Ministry of Education identifies students as type B if they started school between March 1st and July 1st. A child who started school for the first time last year and is identified as type B is measured against the National Standard for 1 year at school.'); // set the OTJ to 1 if the diffence between the start year and the current year is one.  
			}
						
			else {
				
				$array = array('OTJ'=>$this->currentYear, 'School'=>$this->currentYear, 'Ministry'=>true , 'type'=>'B', 'desc'=>'The Ministry of Education identifies students as type B if they started school between March 1st and July 1st. A child who started school for the first time last year and is identified as type B is measured against the National Standard for 1 year at school.');
			}
		break;
		case "C";	//Type C Student
			 if ($this->todayyear==$this->startyear || ($this->todayyear-$this->startyear)==1 && $this->todaymonth <=3){
				
				$array = array('OTJ'=>0, 'School'=>$this->currentYear, 'Ministry'=>false, 'type'=>'B', 'desc'=>'The Ministry of Education identifies students as type C if they started school between March 1st and July 1st and they have been held back at the end of the first year.'); // do not include in ministry if the start year is the same as the current year.
			}
			
			else if (($this->todayyear-$this->startyear)==1){
				
				$array = array('OTJ'=>1, 'School'=>$this->currentYear, 'Ministry'=>true , 'type'=>'C', 'desc'=>'The Ministry of Education identifies students as type C if they started school between March 1st and July 1st and they have been held back at the end of the first year.');// set the OTJ to 1 if the diffence between the start year and the currnet year is one.  
			}

			else {
				$array = array('OTJ'=>$this->currentYear, 'School'=>$this->currentYear, 'Ministry'=>true , 'type'=>'C', 'desc'=>'The Ministry of Education identifies students as type C if they started school between March 1st and July 1st and they have been held back at the end of the first year.');
			}
		break;
		case "D";	//Type D Student
		  if ($this->todayyear==$this->startyear || ($this->todayyear-$this->startyear)==1 && $this->todaymonth <=3){
				
				$array = array('OTJ'=>0, 'School'=>$this->currentYear, 'Ministry'=>false, 'type'=>'D', 'desc'=>'The Ministry of Education identifies students as type D if they started school after the 1st July and have progressed through the school levels as expected.'); // do not include in ministry if the start year is the same as the current year.
			}
			elseif (($this->todayyear-$this->startyear)==1){
				
				$array = array('OTJ'=>1, 'School'=>1, 'Ministry'=>true, 'type'=>'D', 'desc'=>'The Ministry of Education identifies students as type D if they started school after the 1st July and have progressed through the school levels as expected.'); // set the OTJ to 1 if the diffence between the start year and the currnet year is one.  
			}
						
			else {
				$array = array('OTJ'=>$this->currentYear, 'School'=>$this->currentYear, 'Ministry'=>true, 'type'=>'D', 'desc'=>'The Ministry of Education identifies students as type D if they started school after the 1st July and have progressed through the school levels as expected.');
			}
		break;
		case "E";	//Type E Student
			 if ($this->todayyear==$this->startyear || ($this->todayyear-$this->startyear)==1 && $this->todaymonth <=6){
				
				$array = array('OTJ'=>0, 'School'=>0, 'Ministry'=>false, 'type'=>'E', 'desc'=>'The Ministry of Education identifies students as type E if they started school after the 1st July and have been promoted at the end of the year.'); // do not include in ministry if the start year is the same as the current year.
			}
			elseif (($this->currentYear-$this->startyear)==1){
				
				$array = array('OTJ'=>1, 'School'=>1, 'Ministry'=>true, 'type'=>'E', 'desc'=>'The Ministry of Education identifies students as type E if they started school after the 1st July and have been promoted at the end of the year.'); // set the OTJ to 1 if the diffence between the start year and the currnet year is one.  
			}
			else if ($this->currentYear>4) {
				$array = array('OTJ'=>$this->currentYear, 'School'=>$this->currentYear, 'Ministry'=>true, 'type'=>'E', 'desc'=>'The Ministry of Education identifies students as type E if they started school after the 1st July and have been promoted at the end of the year.');
			}			
			else {
				$array = array('OTJ'=>$this->currentYear, 'School'=>$this->currentYear, 'Ministry'=>true, 'type'=>'E', 'desc'=>'The Ministry of Education identifies students as type E if they started school after the 1st July and have been promoted at the end of the year.');
			}
		break;
		default;
			$array = array('OTJ'=>$this->currentYear,'School'=>$this->currentYear, 'Ministry'=>true, 'type'=>$this->type, 'desc'=>'The Ministry of Education identifies students as type E if they started school after the 1st July and have been promoted at the end of the year.');
		break;	
	}
	
	return $array;
	
	}
	
	
}

class natStnds{
	
	private $person;
	private $subject;
	private $cycle;
	private $date;
	private $warning;
	

	public $natStnd = array(
	'year'=> '',
	'gender'=>'',
	'ethnicity'=>'',
	'support'=>array(), 
	'OTJ' =>'',
	'person'=> '',
	'cycle' => '',
	'warning'=>false,
	'previous'=>''
	);
	
	public function __construct($person, $subject, $date){
		
		$this->person = $person;
		$this->subject = $subject;
	
		
		if ($date){
			
			$this->date = $date;	;
			
		}
		else {
			$this->date =  date('Y-m-d');	
		}
		
		$gender = $this->person->returnGender();
		if ($gender =='M'){
			$gender = 'Male';
		}
		else if ($gender =='F'){
			$gender = 'Female';
		}

		
	$standard =$this->person->returnStandardScore($this->subject, $this->date);


	if ($standard['current']<$standard['previous'] && $standard['previous']<4 && $standard['previous']>0){
		$this->natStnd['warning'] = true;
		$this->warning=true;
		$this->natStnd['progress'] = 'Down'; 
	}
	else if ($standard['current']==$standard['previous'] && $standard['previous']>0){
		
		$this->natStnd['progress'] = 'No change'; 
	}	
	else if ($standard['current']>$standard['previous'] && $standard['previous']>0){
		
		$this->natStnd['progress'] = 'Up'; 
	}	
	if ($standard['current']==1){
		$otj='Well Below';	
	}
	else if ($standard['current']==2){
		$otj='Below';	
	}
	else if ($standard['current']==3){
		$otj='At';	
	}
	else if ($standard['current']==4){
		$otj='Above';	
	}
	
	$this->natStnd['label'] = 	$standard['label'];
	$this->natStnd['year'] = 	$standard['level'];
	$this->natStnd['index'] = $standard['index'];
	
	$this->natStnd['gender'] = $gender;
	$this->natStnd['ethnicity'] = $this->check_ethnicity();
	$this->natStnd['support'] = $this->check_support();
	$this->natStnd['OTJ'] = $otj;
	$this->natStnd['person'] = $this->person_details();
	$this->natStnd['cycle'] = $standard['cycle'];
	
	 if ( $standard['previous']==1){
						$this->natStnd['previous'] =  "Well below";
						 }
						 else if ( $standard['previous']==2){
								$this->natStnd['previous'] = "Below";
						 }
						 else if ( $standard['previous']==3){
								$this->natStnd['previous'] =  "At";
						 }
						 else if ( $standard['previous']==4){
								$this->natStnd['previous'] =  "Above";
						 }
	
}

private function person_details(){
	
	
	
	
		$labels = $this->person->checkLabels();
		
		$year = $this->person->metaArray['current_year_level'];
		$class = 'no-float '.$this->natStnd['OTJ'].' '. $this->natStnd['year'].' '. $this->cycle.' '.$this->warning.' ';
		
	//	$banner = $this->natStnd['label'];
		$banner = $this->natStnd['progress'];
		
		$content = array(
		'name'=>$this->person->returnName(), 
		'image'=>$this->person->returnImage('thumbnail'), 
		'url'=>'?accessId='.$this->person->id, 
		'year'=>$year,
		'class'=>$class, 
		'id'=>$this->person->id, 
		
		'labels'=>$labels,
		'external'=>true,
		'banner'=>$banner,
		'personType'=>$this->person->personType,
		'gender'=>$this->person->returnGender()	
		);
		$badge = new Badge($content);
		
		return $badge->returnBadge();

	 
}


private function check_ethnicity(){
	

		$ethnic =  $this->person->metaArray['ethnic_origin'];
	$ethnic1 =  $this->person->metaArray['ethnic_origin2'];
	$ethnic2 =  $this->person->metaArray['ethnic_origin3'];
	
	if (in_array($ethnic, array(211)) ||in_array($ethnic2, array(211)) ||in_array($ethnic3, array(211)) ){
		return 'Maori';
	}
	
	
	else if (in_array($ethnic, array(	351, 361, 341, 331, 321, 311, 371))){
		return "Pasifika";	
	}
	else if (in_array($ethnic, array(	411,412, 413, 414, 431, 421, 441, 442, 443, 444))){
		return "Asian";	
	}

	else if (in_array($ethnic, array(	511,521, 531))){
		return "MELAA";	
	}
	else if (in_array($ethnic, array(	611, 999))){
		return "Other";	
	}
	else if (in_array($ethnic, array(	128, 121, 127, 122, 123, 124, 125, 126, 129, 111))){
		return "NZ European";	
	}

	
}


private function check_support(){
	
}



	
}



?>