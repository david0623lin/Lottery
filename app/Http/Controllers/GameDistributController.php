<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class GameDistributController extends Controller
{
    public function run(Request $request)
    {
        $game = $request->input('game', 'ALL');
        $date = $request->input('date', date('Y-m-d'));

        $support_game = config('game')['support'];


        $view_datas['support_game'] = $support_game;
        $view_datas['game'] = $game;
        $view_datas['date'] = $date;
        $view_datas['total'] = array();

        if ($game == 'ALL' && $date == date('Y-m-d')){
            return view('Game.distribut', $view_datas);
        }
        
        $params['game'] = $game;
        $params['date'] = $date;
        $params['num'] = '';

        $total['top_mid_under']['top'] = 0;
        $total['top_mid_under']['mid'] = 0;
        $total['top_mid_under']['under'] = 0;

        $total['odd_even_tie']['odd'] = 0;
        $total['odd_even_tie']['even'] = 0;
        $total['odd_even_tie']['tie'] = 0;

        $total['five_elements']['gold'] = 0;
        $total['five_elements']['wood'] = 0;
        $total['five_elements']['water'] = 0;
        $total['five_elements']['fire'] = 0;
        $total['five_elements']['earth'] = 0;

        $result = Result::getResults($params);

        foreach ($result as $value){
            switch ($value['top_mid_under']){
                case '上':
                    $total['top_mid_under']['top'] = $total['top_mid_under']['top'] + 1;
                break;
                case '中':
                    $total['top_mid_under']['mid'] = $total['top_mid_under']['mid'] + 1;
                break;
                case '下':
                    $total['top_mid_under']['under'] = $total['top_mid_under']['under'] + 1;
                break;
                default:
            }

            switch ($value['odd_even_tie']){
                case '奇':
                    $total['odd_even_tie']['odd'] = $total['odd_even_tie']['odd'] + 1;
                break;
                case '偶':
                    $total['odd_even_tie']['even'] = $total['odd_even_tie']['even'] + 1;
                break;
                case '和':
                    $total['odd_even_tie']['tie'] = $total['odd_even_tie']['tie'] + 1;
                break;
                default:
            }

            switch ($value['five_elements']){
                case '金':
                    $total['five_elements']['gold'] = $total['five_elements']['gold'] + 1;
                break;
                case '木':
                    $total['five_elements']['wood'] = $total['five_elements']['wood'] + 1;
                break;
                case '水':
                    $total['five_elements']['water'] = $total['five_elements']['water'] + 1;
                break;
                case '火':
                    $total['five_elements']['fire'] = $total['five_elements']['fire'] + 1;
                break;
                case '土':
                    $total['five_elements']['earth'] = $total['five_elements']['earth'] + 1;
                break;
                default:
            }
        }

        $count = Result::getResultCount($params);
        $view_datas['percent']['top'] = round(round($total['top_mid_under']['top'] / $count, 3), 2) * 100;
        $view_datas['percent']['mid'] = round(round($total['top_mid_under']['mid'] / $count, 3), 2) * 100;
        $view_datas['percent']['under'] = round(round($total['top_mid_under']['under'] / $count, 3), 2) * 100;
        $view_datas['percent']['odd'] = round(round($total['odd_even_tie']['odd'] / $count, 3), 2) * 100;
        $view_datas['percent']['even'] = round(round($total['odd_even_tie']['even'] / $count, 3), 2) * 100;
        $view_datas['percent']['tie'] = round(round($total['odd_even_tie']['tie'] / $count, 3), 2) * 100;
        $view_datas['percent']['gold'] = round(round($total['five_elements']['gold'] / $count, 3), 2) * 100;
        $view_datas['percent']['wood'] = round(round($total['five_elements']['wood'] / $count, 3), 2) * 100;
        $view_datas['percent']['water'] = round(round($total['five_elements']['water'] / $count, 3), 2) * 100;
        $view_datas['percent']['fire'] = round(round($total['five_elements']['fire'] / $count, 3), 2) * 100;
        $view_datas['percent']['earth'] = round(round($total['five_elements']['earth'] / $count, 3), 2) * 100;

        $view_datas['total'] = $total;


        return view('Game.distribut', $view_datas);
    }
}
