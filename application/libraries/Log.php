<?php
class loging{
	/*
	WRITE LOG TI FILE AS DEFINED in $logpath & $logname
	7 ALL
	6 DEBUG/INFO
	5 DATA LOG
	4 EXCEPTION ERROR
	3 INTEGRASI NORMAL
	2 INTEGRASI ERROR
	1 FATAL ERROR
	*/
	public $logpath;
	public $logname;
	public function log_write($text, $level = 6){
		$path = $this->logpath;
		$name = $this->logname;
		$filename = $path.$name.”_”.date(‘Y-m-d’).’.txt’;
		try
		{
			if(!file_exists($filename))
			{
				fopen($filename, ‘w’);
			}
			$file_content = date(‘Y-m-d H:i:s’).’ : ‘.$text.PHP_EOL;
			file_put_contents($filename, $file_content, FILE_APPEND);
		}
		catch(Exception $ex)
		{
			echo $ex->getMessage();
		}
	}
}
?>