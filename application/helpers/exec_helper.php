<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



if (!function_exists('exec_timeout'))
{
	//http://blog.dubbelboer.com/2012/08/24/execute-with-timeout.html
	function exec_timeout($cmd, $timeout) {
		// File descriptors passed to the process.
		$descriptors = array(
		0 => array('pipe', 'r'),  // stdin
		1 => array('pipe', 'w'),  // stdout
		2 => array('pipe', 'w')   // stderr
		);

		// Start the process.
		//$process = proc_open('exec ' . $cmd, $descriptors, $pipes);
		$process = proc_open($cmd, $descriptors, $pipes);

		if (!is_resource($process)) {
			throw new \Exception('Could not execute process');
		}

		// Set the stdout stream to none-blocking.
		stream_set_blocking($pipes[1], 0);

		// Turn the timeout into microseconds.
		$timeout = $timeout * 1000000;

		// Output buffer.
		$buffer = '';

		$status = proc_get_status($process);
		
		// While we have time to wait.
		while ($timeout > 0) {
			$start = microtime(true);

			// Wait until we have output or the timer expired.
			$read  = array($pipes[1]);
			$other = array();
			stream_select($read, $other, $other, 0, $timeout);

			// Get the status of the process.
			// Do this before we read from the stream,
			// this way we can't lose the last bit of output if the process dies between these functions.
			$status = proc_get_status($process);

			//var_dump($status);
			
			// Read the contents from the buffer.
			// This function will always return immediately as the stream is none-blocking.
			$buffer .= stream_get_contents($pipes[1]);

			if (!$status['running']) {
				// Break from this loop if the process exited before the timeout.
				break;
			}

			// Subtract the number of microseconds that we waited.
			$timeout -= (microtime(true) - $start) * 1000000;
			//echo $timeout;
			//echo "\n";
			flush();
		}
		//echo "Out Of while loop \n";
		//flush();
		
		//var_dump($buffer);
		flush();
		
		//echo "Check For Errors \n";
		//flush();
		// Check if there were any errors.
		/*
		$errors = stream_get_contents($pipes[2]);
		var_dump($errors);
		if (!empty($errors)) {
			throw new \Exception($errors);
		}
		flush();
		*/
		
		//echo "Trying to kill the process \n";
		proc_terminate($process, 9);
		//flush();
		// Kill the process in case the timeout expired and it's still running.
		// If the process already exited this won't do anything.
		//proc_terminate($process, 9);

		// Close all streams.
		fclose($pipes[0]);
		fclose($pipes[1]);
		fclose($pipes[2]);

		proc_close($process);

		return $buffer;
	}
}

if (!function_exists('extractMsgFromShell'))
{
	function extractMsgFromShell($str) {
		$data = explode("\n", $str);
		foreach ($data as $row){
			if(startsWith($row, "MSGTOPHP")){
				$msg = str_replace("MSGTOPHP", "", $row);
				$msg = trim($msg);
				$msg = explode("~#", $msg);
				return $msg;
			}
		}
	}
}	

?>