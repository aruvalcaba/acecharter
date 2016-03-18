<?php 

namespace TT\Support;

class AcademicHelper {
    public static function format($academic) 
    {
        if( is_null($academic) )
        {
            return $academic;
        }

        else 
        {
            $academic = strtolower($academic);
            $academic = preg_replace('/\s+/',' ',$academic);
            $academic = str_replace(' ','_',$academic);

            return $academic;
        }
    }

    public static function unformat($academic)
    {
        if( is_null($academic) )
        {
            return $academic;
        }
        
        else
        {
            $academic = str_replace('_',' ',$academic);
            return ucwords($academic);
        }
    }
}
