<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $connection;
    protected $table = 'Result';
    protected $primarykey = 'id';
    public $timestamps = false;

    public static function setResults($game_type, $search_date, $rets)
    {
        if ($rets == array()){
            exit;
        }

        $last_num = self::getLastNum($game_type);

        foreach ($rets as $num => $all_result){
            if ($num <= $last_num){
                continue;
            }

            self::insert([
                'game' => $game_type,
                'date' => $search_date,
                'num' => $num,
                'result' => $all_result['code'],
                'top_mid_under' => $all_result['top_mid_under'],
                'odd_even_tie' => $all_result['odd_even_tie'],
                'five_elements' => $all_result['five_elements'],
                'create_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }

    public static function getLastNum($game_type)
    {
        $ret = self::select('num')->
            where('game', $game_type)->
            orderBy('num', 'desc')->
            get()->toArray();
        
        $last_num = ($ret != array()) ? $ret[0]['num'] : 0;

        return $last_num;
    }
}
