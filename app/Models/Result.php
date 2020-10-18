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

        $last_num = self::getLastNum($game_type, $search_date);

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

    public static function getLastNum($game_type, $search_date)
    {
        $ret = self::select('num')->
            where('game', $game_type)->
            where('date', $search_date)->
            orderBy('num', 'desc')->
            get()->toArray();
        
        $last_num = ($ret != array()) ? $ret[0]['num'] : 0;

        return $last_num;
    }

    public static function getResults($params, $orderby = 'desc')
    {
        $query = self::where(function($query) use ($params){
            $query->where('game', $params['game']);
            $query->where('date', $params['date']);
            ($params['num'] != '') and $query->where('num', $params['num']);
        });

        $query->orderBy('num', $orderby);
        $results = $query->get()->toArray();

        return $results;
    }

    public static function getResultCount($params)
    {
        $query = self::where(function($query) use ($params){
            $query->where('game', $params['game']);
            $query->where('date', $params['date']);
        });

        $count = $query->count();

        return $count;
    }
}
