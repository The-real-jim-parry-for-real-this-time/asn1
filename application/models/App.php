<?php

/**
 * Domain-specific lookup tables
 */
class App extends CI_Model
{
	private $airports;
	private $manufacturers;

	public function __construct()
	{
        parent::__construct();
        $airportsRaw = file_get_contents('https://wacky.jlparry.com/info/airports/');
		$airplanesRaw = file_get_contents('https://wacky.jlparry.com/info/airplanes/');
		foreach ($airportsRaw as $airport){
			$this->airports[] = $airport['airport'];
		}
		foreach ($airplanesRaw as $airplane){
			$this->manufacturers[] = $airplane['manufacturer'];
		}
	}

	public function airports($which = null) {
        return isset($which) ?
            (isset($this->airports[$which]) ? $this->airports[$which] : '') :
            $this->airports;
	}
	
	public function manufacturers($which = null) {
		return isset($which) ?
			(isset($this->manufacturers[$which]) ? $this->manufacturers[$which] : '') :
			$this->manufacturers;
	}

}
