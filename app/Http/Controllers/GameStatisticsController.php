<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class GameStatisticsController extends Controller
{
    public function run(Request $request)
    {
        $game = $request->input('game', 'ALL');
        $date = $request->input('date', date('Y-m-d'));
        $type = $request->input('type', 'default');

        $support_game = config('game')['support'];
        $support_type = config('game')['type'];

        $view_datas['support_game'] = $support_game;
        $view_datas['game'] = $game;
        $view_datas['date'] = $date;
        $view_datas['support_type'] = $support_type;
        $view_datas['type'] = $type;
        $view_datas['statistics'] = array();

        if ($game == 'ALL' && $date == date('Y-m-d') && $type == 'default'){
            return view('Game.statistics', $view_datas);
        }
        
        $params['game'] = $game;
        $params['date'] = $date;
        $params['num'] = '';

        $result = Result::getResults($params);
        $statistics = array();
      
        switch ($type){
            case 'top_mid_under':
                $statistics = self::top_mid_under($result);
            break;
            case 'odd_even_tie':
                $statistics = self::odd_even_tie($result);
            break;
            case 'five_elements_gold':
                $statistics = self::five_elements_gold($result);
            break;
            case 'five_elements_wood':
                $statistics = self::five_elements_wood($result);
            break;
            case 'five_elements_water':
                $statistics = self::five_elements_water($result);
            break;
            case 'five_elements_fire':
                $statistics = self::five_elements_fire($result);
            break;
            case 'five_elements_earth':
                $statistics = self::five_elements_earth($result);
            break;
            default:
        }

        $view_datas['statistics'] = $statistics;

        return view('Game.statistics', $view_datas);
    }

    public static function top_mid_under($result)
    {
        $value_str = '';

        foreach($result as $key => $value){
            if ($value_str == ''){
                if ($value['top_mid_under'] == '上' || $value['top_mid_under'] == '下'){
                    $value_str = $value['top_mid_under'];
                } else {
                    $statistics[] = array($value['top_mid_under']);
                }
            } else {
                if ($value['top_mid_under'] == '上' || $value['top_mid_under'] == '下') {
                    $value_str = $value_str. ','. $value['top_mid_under'];

                    if ($key == (count($result) - 1)){
                        $statistics[] = explode(',', $value_str);
                    }
                } else {
                    $statistics[] = explode(',', $value_str);
                    $statistics[] = array($value['top_mid_under']);
                    $value_str = '';
                }
            }
        }

        return $statistics;
    }

    public static function odd_even_tie($result)
    {
        $value_str = '';

        foreach($result as $key => $value){
            if ($value_str == ''){
                if ($value['odd_even_tie'] == '奇' || $value['odd_even_tie'] == '偶'){
                    $value_str = $value['odd_even_tie'];
                } else {
                    $statistics[] = array($value['odd_even_tie']);
                }
            } else {
                if ($value['odd_even_tie'] == '奇' || $value['odd_even_tie'] == '偶') {
                    $value_str = $value_str. ','. $value['odd_even_tie'];

                    if ($key == (count($result) - 1)){
                        $statistics[] = explode(',', $value_str);
                    }
                } else {
                    $statistics[] = explode(',', $value_str);
                    $statistics[] = array($value['odd_even_tie']);
                    $value_str = '';
                }
            }
        }

        return $statistics;
    }

    public static function five_elements_gold($result)
    {
        $value_str = '';

        foreach($result as $key => $value){
            if ($value_str == ''){
                switch ($value['five_elements']){
                    case '木':
                    case '水':
                    case '火':
                    case '土':
                        $value_str = $value['five_elements'];
                    break;
                    case '金':
                        $statistics[] = array($value['five_elements']);
                    break;
                    default:
                }
            } else {
                switch ($value['five_elements']){
                    case '木':
                    case '水':
                    case '火':
                    case '土':
                        $value_str = $value_str. ','. $value['five_elements'];

                        if ($key == (count($result) - 1)){
                            $statistics[] = explode(',', $value_str);
                        }
                    break;
                    case '金':
                        $statistics[] = explode(',', $value_str);
                        $statistics[] = array($value['five_elements']);
                        $value_str = '';
                    break;
                    default:
                }
            }
        }

        return $statistics;
    }

    public static function five_elements_wood($result)
    {
        $value_str = '';

        foreach($result as $key => $value){
            if ($value_str == ''){
                switch ($value['five_elements']){
                    case '金':
                    case '水':
                    case '火':
                    case '土':
                        $value_str = $value['five_elements'];
                    break;
                    case '木':
                        $statistics[] = array($value['five_elements']);
                    break;
                    default:
                }
            } else {
                switch ($value['five_elements']){
                    case '金':
                    case '水':
                    case '火':
                    case '土':
                        $value_str = $value_str. ','. $value['five_elements'];

                        if ($key == (count($result) - 1)){
                            $statistics[] = explode(',', $value_str);
                        }
                    break;
                    case '木':
                        $statistics[] = explode(',', $value_str);
                        $statistics[] = array($value['five_elements']);
                        $value_str = '';
                    break;
                    default:
                }
            }
        }

        return $statistics;
    }

    public static function five_elements_water($result)
    {
        $value_str = '';

        foreach($result as $key => $value){
            if ($value_str == ''){
                switch ($value['five_elements']){
                    case '金':
                    case '木':
                    case '火':
                    case '土':
                        $value_str = $value['five_elements'];
                    break;
                    case '水':
                        $statistics[] = array($value['five_elements']);
                    break;
                    default:
                }
            } else {
                switch ($value['five_elements']){
                    case '金':
                    case '木':
                    case '火':
                    case '土':
                        $value_str = $value_str. ','. $value['five_elements'];

                        if ($key == (count($result) - 1)){
                            $statistics[] = explode(',', $value_str);
                        }
                    break;
                    case '水':
                        $statistics[] = explode(',', $value_str);
                        $statistics[] = array($value['five_elements']);
                        $value_str = '';
                    break;
                    default:
                }
            }
        }

        return $statistics;
    }

    public static function five_elements_fire($result)
    {
        $value_str = '';

        foreach($result as $key => $value){
            if ($value_str == ''){
                switch ($value['five_elements']){
                    case '金':
                    case '木':
                    case '水':
                    case '土':
                        $value_str = $value['five_elements'];
                    break;
                    case '火':
                        $statistics[] = array($value['five_elements']);
                    break;
                    default:
                }
            } else {
                switch ($value['five_elements']){
                    case '金':
                    case '木':
                    case '水':
                    case '土':
                        $value_str = $value_str. ','. $value['five_elements'];

                        if ($key == (count($result) - 1)){
                            $statistics[] = explode(',', $value_str);
                        }
                    break;
                    case '火':
                        $statistics[] = explode(',', $value_str);
                        $statistics[] = array($value['five_elements']);
                        $value_str = '';
                    break;
                    default:
                }
            }
        }

        return $statistics;
    }

    public static function five_elements_earth($result)
    {
        $value_str = '';

        foreach($result as $key => $value){
            if ($value_str == ''){
                switch ($value['five_elements']){
                    case '金':
                    case '木':
                    case '水':
                    case '火':
                        $value_str = $value['five_elements'];
                    break;
                    case '土':
                        $statistics[] = array($value['five_elements']);
                    break;
                    default:
                }
            } else {
                switch ($value['five_elements']){
                    case '金':
                    case '木':
                    case '水':
                    case '火':
                        $value_str = $value_str. ','. $value['five_elements'];

                        if ($key == (count($result) - 1)){
                            $statistics[] = explode(',', $value_str);
                        }
                    break;
                    case '土':
                        $statistics[] = explode(',', $value_str);
                        $statistics[] = array($value['five_elements']);
                        $value_str = '';
                    break;
                    default:
                }
            }
        }

        return $statistics;
    }
}
