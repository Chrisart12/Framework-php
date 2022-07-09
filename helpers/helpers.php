<?php 

    function dd($eltment){
        var_dump($eltment);
        die();
    }

    function formateDate($date) {
        if ($date) {
            return date('d/m/Y H:i', strtotime($date));
        }
        
    }

    if(!function_exists('cutString')) {
	
        function cutString($string, int $offset, int $length)
        {
            if (strlen($string) <= $length) {
                $newString = substr($string, $offset, $length);
            } else {
                $newString = substr($string, $offset, $length) . "...";
            }
    
            return $newString;
            
        }
    }

    if(!function_exists('show')) {
	
        function show($element)
        {
            echo '<pre>';
            var_dump($element);
            echo '</pre>';
            die;
            
        }
    }

?>