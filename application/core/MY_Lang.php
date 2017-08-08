<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Lang extends CI_Lang {

	public function __construct()
	{
		parent::__construct();
	}

    public function line($line = '', $swap = null) {
    	
        $loaded_line    = parent::line($line);
        
        // If swap if not given, just return the line from the language file (default codeigniter functionality.)
        if(!$swap) return $loaded_line;

        // If an array is given
        if (is_array($swap)) {
            // Explode on '%s'
            $exploded_line = explode('%s', $loaded_line);

            // Loop through each exploded line
            foreach ($exploded_line as $key => $value) {
                // Check if the $swap is set
                if(isset($swap[$key])) {
                    // Append the swap variables
                    $exploded_line[$key] .= $swap[$key];
                }
            }
            // Return the implode of $exploded_line with appended swap variables
            return implode('', $exploded_line);
        }
        // A string is given, just do a simple str_replace on the loaded line
        else {
            return str_replace('%s', $swap, $loaded_line);
        }
    }
}