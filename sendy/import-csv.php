<?php require_once('includes/helpers/EmailAddressValidator.php');?>
<?php require_once('includes/helpers/parsecsv.php');?>
<?php 	include('includes/config.php');	//--------------------------------------------------------------//	function dbConnect() { //Connect to database	//--------------------------------------------------------------//	    // Access global variables	    global $mysqli;	    global $dbHost;	    global $dbUser;	    global $dbPass;	    global $dbName;	    global $dbPort;	    	    // Attempt to connect to database server	    if(isset($dbPort)) $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);	    else $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);		    // If connection failed...	    if ($mysqli->connect_error) {	        fail();	    }	    	    global $charset; mysqli_set_charset($mysqli, isset($charset) ? $charset : "utf8");	    	    return $mysqli;	}	//--------------------------------------------------------------//	function fail() { //Database connection fails	//--------------------------------------------------------------//	    print 'Database error';	    exit;	}	// connect to database	dbConnect();?>
<?php

//setup cron
$q = 'SELECT id, cron_csv FROM login LIMIT 1';
$r = mysqli_query($mysqli, $q);
if ($r)
{
    while($row = mysqli_fetch_array($r))
    {
		$cron = $row['cron_csv'];
		$userid = $row['id'];
		
		if($cron==0)
		{
			$q2 = 'UPDATE login SET cron_csv=1 WHERE id = '.$userid;
			$r2 = mysqli_query($mysqli, $q2);
			if ($r2) exit;
		}
    }  
}

//Get the first CSV file
if(!isset($server_path))
{
	$server_path_array = explode('import-csv.php', $_SERVER['SCRIPT_FILENAME']);
	$server_path = $server_path_array[0];
}
$csvfile = '';
if ($handle = opendir($server_path.'uploads/csvs')) 
{
    while (false !== ($file = readdir($handle))) 
    {
    	if($file!='.' && $file!='..' && $file!='.DS_Store' && $file!='.svn')
    	{
    		$csvfile = $server_path.'uploads/csvs/'.$file;
    		break;
    	}
    }
    closedir($handle);
}
if($csvfile=='') exit; //Nothing to process, quit here.

//Initialize data
$data_array = explode('-', $file);
$userID = $data_array[0];
$listID = str_replace('.csv', '', $data_array[1]);

//Check if CSV is currently processing
$q = 'SELECT lists.app, lists.currently_processing, lists.prev_count, lists.total_records, lists.gdpr, login.timezone FROM lists, login WHERE lists.id = '.$listID.' AND login.app = lists.app';
$r = mysqli_query($mysqli, $q);
if ($r) 
{
	while($row = mysqli_fetch_array($r)) 
	{
		$timezone = $row['timezone'];
		$current_processing = $row['currently_processing'];
		$prev_count = $row['prev_count'];
		$total_records = $row['total_records'];
		$gdpr = $row['gdpr'];
		$app = $row['app'];
		
		//set timezone
		if($timezone=='') date_default_timezone_set(date_default_timezone_get());
		else date_default_timezone_set($timezone);
	}
}

//get comma separated lists belonging to this app
$q2 = 'SELECT id FROM lists WHERE app = '.$app;
$r2 = mysqli_query($mysqli, $q2);
if ($r2)
{
	$all_lists = '';
    while($row = mysqli_fetch_array($r2)) $all_lists .= $row['id'].',';
    $all_lists = substr($all_lists, 0, -1);
}

//If CSV is not processed before, process it
if(!$current_processing)
{
	$csv = new parseCSV();
	if(isset($_GET['offset'])) $csv->offset = $_GET['offset'];
	$csv->heading = false;
	$csv->auto($csvfile);
	$databasetable = "subscribers";
	$fieldseparator = ",";
	$time = time();

	//Set currently_processing status to 1 'lists' table and prev_count
	set_currently_processing(1);
	if(!isset($_GET['offset'])) set_prev_count();
	
	//Process the CSV
	foreach ($csv->data as $key => $line)
	{		
		//get the columns	
		$linearray = array();
		if(count($csv->data)==1)
		{
			$file = fopen($csvfile,"r");
			$size = filesize($csvfile);
			$csvcontent = fread($file,$size);
			fclose($file);
			$linearray = explode($fieldseparator,$csvcontent);
			$columns = count($linearray);
			$columns_additional = $columns - 2;
		}
		else
		{
			foreach($line as $val) array_push($linearray, $val);
			$columns = count($linearray);
			$columns_additional = $columns - 2;
		}
		
		//check for duplicates
		$q = 'SELECT custom_fields FROM subscribers WHERE list = '.$listID.' AND (email = "'.$linearray[0].'" || email = "'.trim($linearray[1]).'")';
		$r = mysqli_query($mysqli, $q);
		if (mysqli_num_rows($r) > 0) //if so, update subscriber
		{
			while($row = mysqli_fetch_array($r))
		    {
				$custom_values = $row['custom_fields'];
		    } 
			
			//Get the list of custom fields for this list
			$q2 = 'SELECT custom_fields FROM lists WHERE id = '.$listID;
			$r2 = mysqli_query($mysqli, $q2);
			if ($r2)
			{
				$custom_fields = '';
				
			    while($row = mysqli_fetch_array($r2))
			    {
					$custom_fields = $row['custom_fields'];
			    }  
			    
			    //if there are custom fields in this list,
			    if($custom_fields!='')
			    {
			    	$custom_fields_value = '';
				    $custom_fields_array = explode('%s%', $custom_fields);
				    $custom_fields_count = count($custom_fields_array);
				    
				    $custom_values_array = explode('%s%', $custom_values);
				    
				    //prepare custom field string
				    for($i=2;$i<$columns_additional+2;$i++)
				    {
				    	$custom_fields_array2 = explode(':', $custom_fields_array[$i-2]);
				    	//if custom field format is Date
						if($custom_fields_array2[1]=='Date')
						{
							if($linearray[$i]=="") $value = $linearray[$i];
							else
							{
								$date_value1 = strtotime($linearray[$i]);
								$date_value2 = strftime("%b %d, %Y 12am", $date_value1);
								$value = strtotime($date_value2);
							}
							$custom_fields_value .= $linearray[$i]=='' ? $custom_values_array[$i-2] : $value;
						    $custom_fields_value .= '%s%';
						}
						//else if custom field format is Text
						else
						{
						    $custom_fields_value .= $linearray[$i]=='' ? $custom_values_array[$i-2] : strip_tags($linearray[$i]);
						    $custom_fields_value .= '%s%';
						}
				    }
			    }
			}
			
			if($columns==1)
			{
				$email = trim($linearray[0]);
			}
			else if($columns==2)
			{
				$name = strip_tags($linearray[0]);
				$email = trim($linearray[1]);
			}
			else if($columns==$custom_fields_count+2)
			{
				$name = strip_tags($linearray[0]);
				$email = trim($linearray[1]);
			}
			
			$gdpr_status = $gdpr ? ', gdpr = '.$gdpr : '';
		    
			if(!isset($name) || $name=='')
				$q = 'UPDATE subscribers SET custom_fields = "'.substr($custom_fields_value, 0, -3).'" '.$gdpr_status.' WHERE email = "'.$email.'" AND list = '.$listID;
			else
				$q = 'UPDATE subscribers SET name = "'.$name.'", custom_fields = "'.substr($custom_fields_value, 0, -3).'" '.$gdpr_status.' WHERE email = "'.$email.'" AND list = '.$listID;

			mysqli_query($mysqli, $q);
			
			skipped_emails(trim($linearray[1]), 'Exists');
		}
		else
		{			
			//Get the list of custom fields for this list
			$q2 = 'SELECT custom_fields FROM lists WHERE id = '.$listID;
			$r2 = mysqli_query($mysqli, $q2);
			if ($r2)
			{
				$custom_fields = '';
				
			    while($row = mysqli_fetch_array($r2))
			    {
					$custom_fields = $row['custom_fields'];
			    }  
			    
			    //if there are custom fields in this list,
			    if($custom_fields!='')
			    {
			    	$custom_fields_value = '';
				    $custom_fields_array = explode('%s%', $custom_fields);
				    $custom_fields_count = count($custom_fields_array);
				    
				    //prepare custom field string
				    for($i=2;$i<$columns_additional+2;$i++)
				    {
				    	$custom_fields_array2 = explode(':', $custom_fields_array[$i-2]);
				    	//if custom field format is Date
						if($custom_fields_array2[1]=='Date')
						{
							if($linearray[$i]=="") $value = $linearray[$i];
							else
							{
								$date_value1 = strtotime($linearray[$i]);
								$date_value2 = strftime("%b %d, %Y 12am", $date_value1);
								$value = strtotime($date_value2);
							}
							$custom_fields_value .= $value;
						    $custom_fields_value .= '%s%';
						}
						//else if custom field format is Text
						else
						{
						    $custom_fields_value .= strip_tags($linearray[$i]);
						    $custom_fields_value .= '%s%';
						}
				    }
			    }
			}
			
			//Check if user set the list to unsubscribe from all lists
			$q = 'SELECT unsubscribe_all_list FROM lists WHERE id = '.$listID;
			$r = mysqli_query($mysqli, $q);
			if ($r) while($row = mysqli_fetch_array($r)) $unsubscribe_all_list = $row['unsubscribe_all_list'];
			
			//See if we should check for unsubscribe status in all lists
			$unsubscribe_line = $unsubscribe_all_list ? '(complaint = 1 OR unsubscribed = 1)' : 'complaint = 1';
			
			//get email's domain
			$email_explode = explode('@', trim($linearray[0]));
			$email_explode2 = explode('@', trim($linearray[1]));
			$email_domain = $email_explode[1];
			$email_domain2 = $email_explode2[1];
	
			//Check if this email is previously marked as bounced, if so, we shouldn't add it
			$q = 'SELECT email from subscribers WHERE ( (email = "'.$linearray[0].'" || email = " '.$linearray[1].'" || email = "'.$linearray[1].'") AND bounced = 1 ) OR ( (email = "'.$linearray[0].'" || email = " '.$linearray[1].'" || email = "'.$linearray[1].'") AND list IN ('.$all_lists.') AND '.$unsubscribe_line.')';
			$r = mysqli_query($mysqli, $q);
			if (mysqli_num_rows($r) == 0)
			{
				$q2 = '(SELECT id FROM suppression_list WHERE (email = "'.$linearray[0].'" || email = " '.$linearray[1].'" || email = "'.$linearray[1].'") AND app = '.$app.') 
					UNION 
					(SELECT id FROM blocked_domains WHERE (domain = "'.$email_domain.'" || domain = "'.$email_domain2.'") AND app = '.$app.')';
				$r2 = mysqli_query($mysqli, $q2);
				if (mysqli_num_rows($r2) == 0)
				{
					$validator = new EmailAddressValidator;
					
					//if CSV has only 1 column, insert into email column
					if($columns==1)
					{
						if ($validator->check_email_address(trim($linearray[0]))) 
						{
							//insert email into database
							$query = 'INSERT INTO '.$databasetable.' (userID, email, list, timestamp, gdpr) values('.$userID.', "'.trim($linearray[0]).'", '.$listID.', '.$time.', '.$gdpr.')';
							mysqli_query($mysqli, $query);
							$inserted_id = mysqli_insert_id($mysqli);
						}
						else skipped_emails(trim($linearray[0]), 'Malformed');
					}
					//if CSV has 2 columns, insert into name and email columns
					else if($columns==2)
					{
						if ($validator->check_email_address(trim($linearray[1]))) 
						{
							//insert name & email into database
							$query = 'INSERT INTO '.$databasetable.' (userID, name, email, list, timestamp, gdpr) values('.$userID.', "'.strip_tags($linearray[0]).'", "'.trim($linearray[1]).'", '.$listID.', '.$time.', '.$gdpr.')';
							mysqli_query($mysqli, $query);
							$inserted_id = mysqli_insert_id($mysqli);
						}
						else skipped_emails(trim($linearray[1]), 'Malformed');
					}
					//if number of CSV columns matches database, insert name, email and all custom fields
					else if($columns==$custom_fields_count+2)
					{
						if ($validator->check_email_address(trim($linearray[1]))) 
						{
							//insert name & email into database
							$query = 'INSERT INTO '.$databasetable.' (userID, name, email, list, timestamp, gdpr) values('.$userID.', "'.strip_tags($linearray[0]).'", "'.trim($linearray[1]).'", '.$listID.', '.$time.', '.$gdpr.')';
							mysqli_query($mysqli, $query);
							$inserted_id = mysqli_insert_id($mysqli);
							
							//update custom fields values
						    $q3 = 'UPDATE '.$databasetable.' SET custom_fields = "'.substr($custom_fields_value, 0, -3).'" WHERE id = '.$inserted_id;
						    $r3 = mysqli_query($mysqli, $q3);
						    if ($r3){}
						}
						else skipped_emails(trim($linearray[1]), 'Malformed');
					}
					else
					{
						exit;
					}
				}
				else
				{
					//Update block_attempts count				
					$q3 = 'UPDATE suppression_list SET block_attempts = block_attempts+1, timestamp = "'.$time.'" WHERE (email = "'.$linearray[0].'" || email = " '.$linearray[1].'" || email = "'.$linearray[1].'") AND app = '.$app;
					$q4 = 'UPDATE blocked_domains SET block_attempts = block_attempts+1, timestamp = "'.$time.'" WHERE (domain = "'.$email_domain.'" || domain = "'.$email_domain2.'") AND app = '.$app;
					mysqli_query($mysqli, $q3);
					mysqli_query($mysqli, $q4);
					
					skipped_emails(trim($linearray[1]), 'Suppressed');
				}
			}
			else
			{
				skipped_emails(trim($linearray[1]), 'Bounced');
			}
		}
		
		//Check if all are imported		
		if(isset($_GET['offset']))
		{
			if($key+1 == $total_records-$_GET['offset'])
			{
				//set currently_processing to 0
				$q = 'UPDATE lists SET currently_processing=0, prev_count=0, total_records=0, gdpr=0 WHERE id = '.$listID;
				mysqli_query($mysqli, $q);				
				
				//delete CSV file
				unlink($csvfile);
			}
		}
		else
		{
			if($key+1 == $total_records)
			{
				//set currently_processing to 0
				$q = 'UPDATE lists SET currently_processing=0, prev_count=0, total_records=0, gdpr=0 WHERE id = '.$listID;
				mysqli_query($mysqli, $q);
				
				//delete CSV file
				unlink($csvfile);
			}
		}
	}
	
	finish_importing();
}
//Otherwise, check if CSV import timed out
else 
{
	$q = 'SELECT COUNT(*) FROM subscribers WHERE list = '.$listID.' AND unsubscribed = 0 AND bounced = 0 AND complaint = 0 AND confirmed = 1';
	$r = mysqli_query($mysqli, $q);
	if($r) while($row = mysqli_fetch_array($r)) $before_count = $row['COUNT(*)'];
	sleep(8);
	$q2 = 'SELECT COUNT(*) FROM subscribers WHERE list = '.$listID.' AND unsubscribed = 0 AND bounced = 0 AND complaint = 0 AND confirmed = 1';
	$r2 = mysqli_query($mysqli, $q2);
	if($r2) while($row = mysqli_fetch_array($r2)) $after_count = $row['COUNT(*)'];
	
	if($before_count==$after_count)
	{
		//Set currently_processing status to 0 in 'lists' table
		set_currently_processing(0);
		
		//Calculate offset
		$offset = $after_count-$prev_count;
	
		//continue importing
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, APP_PATH.'/import-csv.php?offset='.$offset);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$data = curl_exec($ch);
		
		exit;
	}
}

//--------------------------------------------------------------//
function finish_importing()
//--------------------------------------------------------------//
{
	global $mysqli;
	global $listID;
	global $csvfile;
	
	//Once everything is imported, reset count and remove CSV
	//set currently_processing to 0
	$q = 'UPDATE lists SET currently_processing=0, prev_count=0, total_records=0, gdpr=0 WHERE id = '.$listID;
	mysqli_query($mysqli, $q);
	//delete CSV file
	unlink($csvfile);
}

//--------------------------------------------------------------//
function set_currently_processing($val)
//--------------------------------------------------------------//
{
	global $listID;	
	global $mysqli;
	
	$q = 'UPDATE lists SET currently_processing='.$val.' WHERE id = '.$listID;
	mysqli_query($mysqli, $q);
}

//--------------------------------------------------------------//
function set_prev_count()
//--------------------------------------------------------------//
{
	global $listID;
	global $mysqli;
	
	$q = 'SELECT COUNT(id) FROM subscribers WHERE list = '.$listID.' AND unsubscribed = 0 AND bounced = 0 AND complaint = 0 AND confirmed = 1';
	$r = mysqli_query($mysqli, $q);
	if ($r) while($row = mysqli_fetch_array($r)) $count = $row['COUNT(id)'];
	
	$q2 = 'UPDATE lists SET prev_count = '.$count.' WHERE id = '.$listID;
	$r2 = mysqli_query($mysqli, $q2);
}

//--------------------------------------------------------------//
function skipped_emails($email, $reason)
//--------------------------------------------------------------//
{
	global $mysqli;
	global $app;
	global $listID;
	
	if($reason=='Malformed') $reason = 1;
	if($reason=='Bounced') $reason = 2;
	if($reason=='Exists') $reason = 3;
	if($reason=='Suppressed') $reason = 4;
	
	$q = 'INSERT INTO skipped_emails (app, list, email, reason) VALUES ('.$app.', '.$listID.', "'.$email.'", '.$reason.')';
	mysqli_query($mysqli, $q);
}
?>