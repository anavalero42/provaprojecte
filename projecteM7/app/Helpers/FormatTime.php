<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class FormatTime {
    public static function LongTimeFilter($date){
        if ($date == null){
            return "Sense data";
        }
        $start_date = $date;
        $since_start = $start_date->diff(new \DateTime(date("Y-m-d")." ".date("H:i:s")));
        // var_dump($since_start->s);
        if ($since_start->y != 0){
            $result = $since_start->y . ' anys';
        }
        elseif ($since_start->m != 0){
            $result = $since_start->m . ' mesos';
        }
        elseif ($since_start->d != 0){
            $result = $since_start->d . ' dies';
        }
        elseif ($since_start->h != 0){
            $result = $since_start->h . ' hores';
        }
        elseif ($since_start->i != 0){
            $result = $since_start->i .  ' minuts';
        }
        elseif ($since_start->s != 0){
            $result = $since_start->s . ' segons';
        }
        return "Fa ".$result; 
    }
}
?>