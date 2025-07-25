<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('obj2arr')) {

    function obj2arr($data) {
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = obj2arr($value);
            }
            return $result;
        }
        return $data;
    }

}

if (!function_exists('remove_null')) {

    function remove_null($data) {
        if (is_array($data)) :
            foreach ($data as $key => $value) :
                if (is_array($value)):
                    foreach ($value as $key2 => $value2) :
                        if (is_null($value2)):
                            $value[$key2] = '';
                        endif;
                    endforeach;
                elseif (is_null($value)):
                    $data[$key] = '';
                endif;
            endforeach;
            return $data;
        endif;
    }

}


if (!function_exists('json2arr')) {

    function json2arr($data) {
        $data = json_decode($data);
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = obj2arr($value);
            }
            return $result;
        }
        return $data;
    }

}
function time_Ago($time) { 
  
    // Calculate difference between current 
    // time and given timestamp in seconds 
    $diff     = time() - $time; 
      
    // Time difference in seconds 
    $sec     = $diff; 
      
    // Convert time difference in minutes 
    $min     = round($diff / 60 ); 
      
    // Convert time difference in hours 
    $hrs     = round($diff / 3600); 
      
    // Convert time difference in days 
    $days     = round($diff / 86400 ); 
      
    // Convert time difference in weeks 
    $weeks     = round($diff / 604800); 
      
    // Convert time difference in months 
    $mnths     = round($diff / 2600640 ); 
      
    // Convert time difference in years 
    $yrs     = round($diff / 31207680 ); 
      
    // Check for seconds 
    if($sec <= 60) { 
        echo "$sec seconds ago"; 
    } 
      
    // Check for minutes 
    else if($min <= 60) { 
        if($min==1) { 
            echo "one minute ago"; 
        } 
        else { 
            echo "$min minutes ago"; 
        } 
    } 
      
    // Check for hours 
    else if($hrs <= 24) { 
        if($hrs == 1) {  
            echo "an hour ago"; 
        } 
        else { 
            echo "$hrs hours ago"; 
        } 
    } 
      
    // Check for days 
    else if($days <= 7) { 
        if($days == 1) { 
            echo "Yesterday"; 
        } 
        else { 
            echo "$days days ago"; 
        } 
    } 
      
    // Check for weeks 
    else if($weeks <= 4.3) { 
        if($weeks == 1) { 
            echo "a week ago"; 
        } 
        else { 
            echo "$weeks weeks ago"; 
        } 
    } 
      
    // Check for months 
    else if($mnths <= 12) { 
        if($mnths == 1) { 
            echo "a month ago"; 
        } 
        else { 
            echo "$mnths months ago"; 
        } 
    } 
      
    // Check for years 
    else { 
        if($yrs == 1) { 
            echo "one year ago"; 
        } 
        else { 
            echo "$yrs years ago"; 
        } 
    } 
}
function get_avatar_url($photoPath) {
    $default = base_url('uploads/user-default.jpg');
    if (!empty($photoPath) && file_exists(FCPATH . $photoPath)) {
        return base_url($photoPath);
    }
    return $default;
}
