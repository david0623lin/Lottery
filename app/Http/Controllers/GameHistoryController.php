<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class GameHistoryController extends Controller
{
    public function run(Request $request)
    {
        $game = $request->input('game', 'ALL');
        $date = $request->input('date', date('Y-m-d'));
        $num = $request->input('num', '');

        $support_game = config('game')['support'];

        $view_datas['support_game'] = $support_game;
        $view_datas['game'] = $game;
        $view_datas['date'] = $date;
        $view_datas['num'] = ($num != '') ? $num : '';
        $view_datas['result'] = array();
        $view_datas['count'] = '';

        if ($game == 'ALL' && $date == date('Y-m-d')){
            return view('Game.result', $view_datas);
        }
        
        $params['game'] = $game;
        $params['date'] = $date;
        $params['num'] = $num;

        $result = Result::getResults($params);
        $view_datas['result'] = $result;
        $view_datas['count'] = count($result);

        return view('Game.result', $view_datas);
    }
}
