<?php
namespace StationPlaylist;

/**
 * Studio Playlist Collection Class
 *
 * @author Ken Verhaegen <contact@kenverhaegen.be>
 * @copyright 2014 LANarea
 * @license TBA
 */
class SplCollection
{
	public $config = [];

	public function __construct($config_path='spl.config.php')
	{
		$this->loadConfig($config_path);
		// die(var_dump($this-config));
	}

	public function buildLibrary($save_to_path)
	{
		if(!isset($save_to_path)) {
			return "No path given";
		} else {
			return "Lib built";
		}
	}

	public function getConfig($key=null)
	{
		if(NULL !== $key && array_key_exists($key,$this->config))
		{
			return $this->config[$key];
		}
		return $this->config;
	}
	
	
	private function loadConfig($config_path)
	{
		try
		{
			if($config_content = include($config_path))
			{
				if(is_array($config_content))
				{
					$this->config = $config_content;
				}
				else
				{
					throw new \Exception('Config file didn\'t return a valid array (' . $config_path . ')');
				}
			}
			else
			{
				throw new \Exception('Config couldn\'t be loaded from : ' . $config_path);
			}
		}
		catch (\Exception $e)
		{
			die('Caught exception: ' .  $e->getMessage() . PHP_EOL);
		}
	}
}