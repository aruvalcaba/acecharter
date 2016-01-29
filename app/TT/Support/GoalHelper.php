<?php 

namespace TT\Support;

class GoalHelper {
    public static function format($goal) 
    {
        if( is_null($goal) )
        {
            return $goal;
        }

        else 
        {
            $goal = strtolower($goal);
            $goal = preg_replace('/\s+/',' ',$goal);
            $goal = str_replace(' ','_',$goal);

            return $goal;
        }
    }
}
