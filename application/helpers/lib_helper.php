<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib {
	
	protected static $_instance;
	
	// Instances or factory
	public static function instance () {
		
		if (self::$_instance === NULL)
			self::$_instance	= new self();
		
		return self::$_instance;
		
	}

	/**
	* Load kohana config in shorter way
	*
	* @access	public
	* @param	array
	* @return	array
	*/	
	public static function config($config = array(),$return = FALSE) {
		// Return load function
		return CI::$APP->config->load($config, $return);
	}
	
	/**
	* Load array and return to object 
	*
	* @access	public
	* @param	array
	* @return	object
	*/	
	public static function to_object($arr = NULL, $all = TRUE) {        
        if(!is_array($arr)):
            return $arr;
        endif;
        
        $object = new stdClass();
        
        foreach ($arr as $k=>$v):
            $k = strtolower(trim($k));
            if (!empty($k)):
                if ($all):
                    $object->$k = self::to_object($v);
                else:
                    $object->$k = $v;
                endif;
            endif;
        endforeach;
        return $object;
    }

	// Used for Traversing HTML ul li
	public static function traverse($class='',$url='',$parent_id='',$level='',$data='') {

		if(!count((array) $data) > 0)
			return array();

		$last  = '';
		$html  = '';
		$i = 0;
		$j = count($data);
		$children = $data;
		if ($j != 0 && $data) {
			$html = '<ul class="'.$class.'">';
			foreach ($data as $val) {
				if ($val) {
					$i++;
					$active = (CI::$APP->uri->segment(2) == $val->url) ? 'class="active"' : '';
					$val->id = ($val->field_id) ? $val->field_id : $val->id;
					if ($val->parent_id == $parent_id) {
					//if ($val->sub_level) {
						$html	.= '<li>';
						$html   .= '<a href="'.$url.'/'.$val->url.'/'.$val->prefix.'" '.$active.'>'.ucfirst(strip_tags($val->subject)).'</a>';
						$html	.= self::traverse('listing submenu', $url, $val->id, $val->sub_level, $children);
						$html	.= '</li>';
					//}
					} 
					//echo $level;
				}
			}
			$html .= '</ul>';
		}
		
		return $html;
	}

	public static function _explode_keywords($string = '', $delimiter = ', ') {
		if (empty($string))
			return;
		
		//$return = preg_replace('/\s+/',' ',$string);
		$return = explode(' ', trim(strip_tags($string),"\x00..\x1F"));
		$return = str_replace(array(',', '.'), '', $return);
		$return = implode(', ', $return);
		$return = preg_replace('/\s+/',' ',$return);
		
		if (!empty($return))
			return trim(Text::limit_words($return,64,''),"\x00..\x1F");
	}
	
	public static function _clear_whitespace($string = '') {
		$return = strip_tags($string);
		return preg_replace('/\s+/',' ', $return);
	}
	
	public static function _trim_strip($string='') {
		return trim(strip_tags($string),"\n\r\x00..\x1F");
	}
	
	public static function recursive_remove_directory($directory, $empty=FALSE) {
        if(substr($directory,-1) == '/') :
            $directory = substr($directory,0,-1);
        endif;
        if(!file_exists($directory) || !is_dir($directory)) :
            return FALSE;
        elseif(is_readable($directory)) :
            $handle = opendir($directory);
            while (FALSE !== ($item = readdir($handle))) :
                if($item != '.' && $item != '..') :
                    $path = $directory.'/'.$item;
                        if(is_dir($path)) :
                            self::recursive_remove_directory($path);
                        else:
                            unlink($path);
                        endif;
                endif;
            endwhile;
            closedir($handle);
            if($empty == FALSE) :
                if(!rmdir($directory)):
                    return FALSE;       
                endif;
            endif;
        endif;
        return TRUE;
    }
	
	public static function multi_attach_mail($to, $files, $sendermail){
        // email fields: to, from, subject, and so on
        $from = "Files attach <".$sendermail.">"; 
        $subject = date("d.M H:i")." F=".count($files); 
        $message = date("Y.m.d H:i:s")."\n".count($files)." attachments";
        $headers = "From: $from";
        // boundary 
        $semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
        // headers for attachment 
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
        // multipart boundary 
        $message = "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
        // preparing attachments
        for($i=0;$i<count($files);$i++){
            if(is_file($files[$i])){
                $message .= "--{$mime_boundary}\n";
                $fp =    @fopen($files[$i],"rb");
            $data =    @fread($fp,filesize($files[$i]));
                        @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\n" . 
                "Content-Description: ".basename($files[$i])."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                }
            }
        $message .= "--{$mime_boundary}--";
        $returnpath = "-f" . $sendermail;
        $ok = @mail($to, $subject, $message, $headers, $returnpath); 
        if($ok){ return $i; } else { return 0; }
    }
}

