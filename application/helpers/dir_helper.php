<?php


if (!function_exists('dir_to_array')){
	function dir_to_array($dir, $separator = DIRECTORY_SEPARATOR, $paths = 'relative')
	{
		$result = array();
		$cdir = scandir($dir);
		foreach ($cdir as $key => $value)
		{
			if (!in_array($value, array(".", "..")))
			{
				if (is_dir($dir . $separator . $value))
				{
					$result[$value] = dir_to_array($dir . $separator . $value, $separator, $paths);
				}
				else
				{
					if ($paths == 'relative')
					{
						$result[] = $dir . '/' . $value;
					}
					elseif ($paths == 'absolute')
					{
						$result[] = base_url() . $dir . '/' . $value;
					}
				}
			}
		}
		return $result;
	}
}