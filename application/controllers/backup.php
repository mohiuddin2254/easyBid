<?php 

function backup_database()
			 {
			 	$timezone = "Asia/Dhaka";
				date_default_timezone_set($timezone);
				$bd_date = date('Y-m-d');
				$this->load->dbutil();
			
				if ($this->dbutil->database_exists('pms'))
				{
				  $prefs = array(
									'tables'      => array(),  // Array of tables to backup.
									//'ignore'      => array(),           // List of tables to omit from the backup
									'format'      => 'zip',             // gzip, zip, txt
									//'filename'    => 'test.sql',    // File name - NEEDED ONLY WITH ZIP FILES
									'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
									'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
									'newline'     => "\n"               // Newline character used in backup file
									);
					$backup =& $this->dbutil->backup($prefs);
					/***********************************************************************************
					 * Back up System For Windows  *
					 *******************************/
					
					//Load the file helper and write the file to your server 
					$path = "D:\\xampp\\htdocs\\pms\\pms_backup\\".$bd_date; // For Windows
					
				    if(!is_dir($path)) //create the folder if it's not already exists
				    {
				      mkdir($path,0700,TRUE);
				    } 
					$this->load->helper('file');
					write_file($path.'\\pms.zip', $backup); // For Windows
					
					/*********** End Of Windows Backup **************************************************/
					
					
					/****************************
					 * Back up System For Linux *
					 ****************************/
					/* Load the file helper and write the file to your server */
					//chmod("/opt/lampp/htdocs/backup", 0700);
					/*
					$path = "/opt/lampp/htdocs/cashCarry/dataBase/".$bd_date; // For Linux
				    if(!is_dir($path)) //create the folder if it's not already exists
				    {
				      mkdir($path,0700,TRUE);
				    } 
					$this->load->helper('file');
					write_file($path.'/cash_carry.sql', $backup); // For Linux
					
					$prev_month = date("m",strtotime(date("Y-m-d", strtotime($bd_date)) . " -1 month"));
					$prev_year = date("Y",strtotime(date("Y-m-d", strtotime($bd_date)) . " -1 month"));
					$num_of_days = cal_days_in_month(CAL_GREGORIAN, $prev_month, $prev_year).'</br>';
					
					for($all_date = 1; $all_date < $num_of_days; $all_date++)
					{
						$temp_date = date("Y-m-d",strtotime($prev_year.'-'.$prev_month.'-'.$all_date));
						if (is_dir('/opt/lampp/htdocs/cashCarry/dataBase/'.$temp_date)) {
							unlink('/opt/lampp/htdocs/cashCarry/dataBase/'.$temp_date.'/cash_carry.sql');
							rmdir('/opt/lampp/htdocs/cashCarry/dataBase/'.$temp_date);
						}
					}
					/*********** End Of Windows Backup **************************************************/

					return true;
				}
				return false;
			 }
			 
?>