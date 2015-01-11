<?
class Date_time {

var $select_hours;
var $select_hours2;
var $select_next_years;

function __construct() 
{
	$this->make_select_hours();
	$this->make_select_hours2();
	$this->make_select_next_years();
}

static function get_date($input)
{
	switch ($input)
	{
		case "year":
        $output = date("Y");
        break;
		
		case "mounth":
        $output = date("m");
        break;
		
		case "day":
        $output = date("d");
        break;
		
		case "today":
        $output = date("Y-m-d");
        break;
		
		case "hours":
        $output = date("H");
        break;
		
		case "minutes":
        $output = date("s");
        break;
		
		case "seconds":
        $output = date("s");
        break;
		
		case "datetime":
        $output = date("Y-m-d H:i:s");
        break;
	}
	return $output;
}


function or_today($input)
{
	$date_new = explode("-", $input);
	if($date_new[2] == Date_time::get_date("day") AND $date_new[1] == Date_time::get_date("mounth") AND $date_new[0] == Date_time::get_date("year"))
    {
       $output = "сегодня";
    }
    elseif($date_new[2] == Date_time::get_date("day")-1 AND $date_new[1] == Date_time::get_date("mounth") AND $date_new[0] == Date_time::get_date("year"))
    {
       $date_new = "вчера";
    }
	return $output;
}

static function our_date_format($input)
{
	$date_new = explode("-", $input);
	$output = $date_new[2].".".$date_new[1].".".$date_new[0];
	return $output;
}

static function our_datetime_format($input)
{
	$date = explode(" ", $input);
	$date_new = explode("-", $date[0]);
	$output = $date_new[2].".".$date_new[1].".".$date_new[0];
	$output .= " ".$date[1];
	return $output;
}

static function our_datetime_format_mounth_nosec($input)
{
	$date = explode(" ", $input);
	$date_new = explode("-", $date[0]);
	$output = $date_new[2]." ".Date_time::get_mounth_name2($date_new[1])." ".$date_new[0];
	$date_new = explode(":", $date[1]);
	$output .= " ".$date_new[0].":".$date_new[1];
	return $output;
}

static function get_mounth_name($input)
{
	switch ($input)
	{
		case "1": case "01":
        $output = "январь";
        break;
		
		case "2": case "02":
        $output = "февраль";
        break;
		
		case "3": case "03":
        $output = "март";
        break;
		
		case "4": case "04":
        $output = "апрель";
        break;
		
		case "5": case "05":
        $output = "май";
        break;
		
		case "6": case "06":
        $output = "июнь";
        break;
		
		case "7": case "07":
        $output = "июль";
        break;
		
		case "8": case "08":
        $output = "август";
        break;
		
		case "9": case "09":
        $output = "сентябрь";
        break;
		
		case "10":
        $output = "октябрь";
        break;
		
		case "11":
        $output = "ноябрь";
        break;
		
		case "12":
        $output = "декабрь";
        break;
	}
	return $output;
}

static function get_mounth_name2($input)
{
	switch ($input)
	{
		case "1": case "01":
        $output = "января";
        break;
		
		case "2": case "02":
        $output = "февраля";
        break;
		
		case "3": case "03":
        $output = "марта";
        break;
		
		case "4": case "04":
        $output = "апреля";
        break;
		
		case "5": case "05":
        $output = "мая";
        break;
		
		case "6": case "06":
        $output = "июня";
        break;
		
		case "7": case "07":
        $output = "июля";
        break;
		
		case "8": case "08":
        $output = "августа";
        break;
		
		case "9": case "09":
        $output = "сентября";
        break;
		
		case "10":
        $output = "октября";
        break;
		
		case "11":
        $output = "ноября";
        break;
		
		case "12":
        $output = "декабря";
        break;
	}
	return $output;
}

function make_select_hours()
{
	for($i=0; $i<24; $i++)
	{
		$this->select_hours .= "<option value='$i'>$i</option>";
	}
}
function make_select_hours2()
{
	for($i=0; $i<24; $i++)
	{
		$this->select_hours2 .= "<option value='$i'>$i:00</option>";
	}
}
function make_select_next_years()
{
	$year = Date_time::get_date("year");
	$year_20 = $year + 5;
	for($i=$year; $i<$year_20; $i++)
	{
		$this->select_next_years .= "<option value='$i'>$i</option>";
	}
}

}