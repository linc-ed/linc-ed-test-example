<?php
/**
 * Field name: NSN
 * Field number: 3
 * Natural number, Mandatory , unless the student has left the school or has the STUDENT TYPE = EM or NF
 */

error_reporting(E_ALL);
date_default_timezone_set('Pacific/Auckland');

require_once(dirname(__FILE__).'/../../../moe/natstnds.php');


if (!function_exists('cycleArray')){
function cycleArray(){

$cycleArray[20061] = array('Key'=>20061,'Year'=> 2006, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>1, 'start'=>'2006-01-01', 'end'=> '2006-07-01');
$cycleArray[20062] = array('Key'=>20062,'Year'=> 2006, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>2, 'start'=>'2006-07-02', 'end'=> '2006-12-31');
$cycleArray[20071] = array('Key'=>20071,'Year'=> 2007, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>3, 'start'=>'2007-01-01', 'end'=> '2007-07-01');
$cycleArray[20072] = array('Key'=>20072,'Year'=> 2007, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>4, 'start'=>'2007-07-02', 'end'=> '2007-12-31');
$cycleArray[20081] = array('Key'=>20081,'Year'=> 2008, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>5, 'start'=>'2008-01-01', 'end'=> '2008-07-01');
$cycleArray[20082] = array('Key'=>20082,'Year'=> 2008, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>7, 'start'=>'2008-07-02', 'end'=> '2008-12-31');
$cycleArray[20091] = array('Key'=>20091,'Year'=> 2009, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>8, 'start'=>'2009-01-01', 'end'=> '2009-07-01');
$cycleArray[20092] = array('Key'=>20092,'Year'=> 2009, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>10, 'start'=>'2009-07-02', 'end'=> '2009-12-31');
$cycleArray[20101] = array('Key'=>20101,'Year'=> 2010, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>11, 'start'=>'2010-01-01', 'end'=> '2010-07-01');
$cycleArray[20102] = array('Key'=>20102,'Year'=> 2010, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>13, 'start'=>'2010-07-02', 'end'=> '2010-12-31');
$cycleArray[20111] = array('Key'=>20111,'Year'=> 2011, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>14, 'start'=>'2011-01-01', 'end'=> '2011-07-01');
$cycleArray[20112] = array('Key'=>20112,'Year'=> 2011, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>15, 'start'=>'2011-07-02', 'end'=> '2011-12-31');
$cycleArray[20121] = array('Key'=>20121,'Year'=> 2012, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>16, 'start'=>'2012-01-01', 'end'=> '2012-07-01');
$cycleArray[20122] = array('Key'=>20122,'Year'=> 2012, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>18, 'start'=>'2012-07-02', 'end'=> '2012-12-31');
$cycleArray[20131] = array('Key'=>20131,'Year'=> 2013, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>19, 'start'=>'2013-01-01', 'end'=> '2013-07-01');
$cycleArray[20132] = array('Key'=>20132,'Year'=> 2013, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>21, 'start'=>'2013-07-02', 'end'=> '2013-12-31');
$cycleArray[20141] = array('Key'=>20141,'Year'=> 2014, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>22, 'start'=>'2014-01-01', 'end'=> '2014-07-01');
$cycleArray[20142] = array('Key'=>20142,'Year'=> 2014, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>23, 'start'=>'2014-07-02', 'end'=> '2014-12-31');
$cycleArray[20151] = array('Key'=>20151,'Year'=> 2015, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>24, 'start'=>'2015-01-01', 'end'=> '2015-07-01');
$cycleArray[20152] = array('Key'=>20152,'Year'=> 2015, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>25, 'start'=>'2015-07-02', 'end'=> '2015-12-31');
$cycleArray[20161] = array('Key'=>20161,'Year'=> 2016, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>26, 'start'=>'2016-01-01', 'end'=> '2016-07-01');
$cycleArray[20162] = array('Key'=>20162,'Year'=> 2016, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>27, 'start'=>'2016-07-02', 'end'=> '2016-12-31');
$cycleArray[20171] = array('Key'=>20171,'Year'=> 2017, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>28, 'start'=>'2017-01-01', 'end'=> '2017-07-01');
$cycleArray[20172] = array('Key'=>20172,'Year'=> 2017, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>29, 'start'=>'2017-07-02', 'end'=> '2017-12-31');
$cycleArray[20181] = array('Key'=>20182,'Year'=> 2018, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>30, 'start'=>'2018-01-01', 'end'=> '2018-07-01');
$cycleArray[20182] = array('Key'=>20182,'Year'=> 2018, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>31, 'start'=>'2018-07-02', 'end'=> '2018-12-31');
$cycleArray[20191] = array('Key'=>20191,'Year'=> 2019, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>32, 'start'=>'2019-01-01', 'end'=> '2019-07-01');
$cycleArray[20192] = array('Key'=>20192,'Year'=> 2019, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>33, 'start'=>'2019-07-02', 'end'=> '2019-12-31');
$cycleArray[20201] = array('Key'=>20201,'Year'=> 2020, 'Name'=>'Mid-Year', 'cycleNumber'=>1, 'cycleId'=>34, 'start'=>'2020-01-01', 'end'=> '2020-07-01');
$cycleArray[20202] = array('Key'=>20202,'Year'=> 2020, 'Name'=>'Year-End', 'cycleNumber'=>2, 'cycleId'=>35, 'start'=>'2020-07-02', 'end'=> '2020-12-31');

return $cycleArray;
	
	
}
}

function get_cycle_by_date($searchdate){
	
	$date = DateTime::createFromFormat('Y-m-d', $searchdate);
	foreach (cycleArray() as $key=>$cycle){
		
			$startdate = DateTime::createFromFormat('Y-m-d', $cycle['start']);
			$enddate = DateTime::createFromFormat('Y-m-d', $cycle['end']);

		if ($date >= $startdate && $date <= $enddate)
				{
						 return $cycle;
						
				}

}

}

class validator_NatStnds extends PHPUnit_Framework_TestCase {

	

	//Reset the student and school data before each test method
	public function setUp() {
		
	}

	public function testNationalStandardYear2ANormal() {
		//Student type NF
		$date = date('Y-m-d');
		$year = date('Y');
		$year2start = $year - 1;
		$startDate = $year2start.'-02-19'; // start date is before 1st march.
		$current_year = '2';
		$funding_year = '2';
		$progress = new progressArray();
		$prog = $progress->returnStandardOnDate($date, $startDate, $current_year, $funding_year);
		
		$valid = $prog['label'];
		$this->assertSame($valid, 'Next OTJ will be for the Two Years at School National Standard.');
	}

	public function testNationalStandardYear2BNormal() {
		//Student type NF
		$date = date('Y-m-d');
		$year = date('Y');
		$year2start = $year - 1;
		$startDate = $year2start.'-04-19'; // start date is before 1st march.
		$current_year = '2';
		$funding_year = '2';
		$progress = new progressArray();
		$prog = $progress->returnStandardOnDate($date, $startDate, $current_year, $funding_year);
		
		$valid = $prog['label'];
		$this->assertSame($valid, 'Next OTJ will be progress towards the Two Years at School National Standard.');
	}

	public function testNationalStandardYear2CNormal() {
		//Student type NF
		$date = date('Y-m-d');
		$year = date('Y');
		$year2start = $year - 1;
		$startDate = $year2start.'-08-19'; // start date is before 1st march.
		$current_year = '1';
		$funding_year = '1';
		$progress = new progressArray();
		$prog = $progress->returnStandardOnDate($date, $startDate, $current_year, $funding_year);
		
		$valid = $prog['label'];
		$this->assertSame($valid, 'Next OTJ will be for the One Year at School National Standard.');
	}

	public function testNationalStandardYear5BHeldBack() {
		//Student type NF
		$date = date('Y-m-d');
		$year = date('Y');
		$year2start = $year - 4;
		$startDate = $year2start.'-03-19'; // start date is before 1st march.
		$current_year = '4';
		$funding_year = '5';
		$progress = new progressArray();
		$prog = $progress->returnStandardOnDate($date, $startDate, $current_year, $funding_year);
		
		$valid = $prog['label'];
		$this->assertSame($valid, 'Next OTJ will be the end of Year Four National Standard.');
	}

public function testNationalStandardYear5CPromoted() {
		//Student type NF
		$date = date('Y-m-d');
		$year = date('Y');
		$year2start = $year - 4;
		$startDate = $year2start.'-08-19'; // start date is before 1st march.
		$current_year = '5';
		$funding_year = '4';
		$progress = new progressArray();
		$prog = $progress->returnStandardOnDate($date, $startDate, $current_year, $funding_year);
		$valid = $prog['label'];
		$this->assertSame($valid, 'Next OTJ will be the end of Year Five National Standard.');
	}

	public function testNationalStandardFebruaryBirthday() {
		//Student type NF
		$date = date('Y-m-d');
		$year = date('Y');
		$year2start = $year;
		$startDate = $year2start.'-02-02'; // start date is before 1st march.
		$current_year = '1';
		$funding_year = '1';
		$progress = new progressArray();
		$prog = $progress->returnStandardOnDate($date, $startDate, $current_year, $funding_year);
		$valid = $prog['label'];
		$this->assertSame($valid, 'Next OTJ will be the end of Year Five National Standard.');
	}


}