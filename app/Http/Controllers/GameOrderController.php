<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class GameOrderController extends Controller
{
    public function run(Request $request)
    {
        $game = $request->input('game', 'ALL');
        $date = $request->input('date', date('Y-m-d'));
        $type = $request->input('type', 'default');
        $count = $request->input('count', '5');

        $support_game = config('game')['support'];
        $support_type = config('game')['type'];

        $view_datas['support_game'] = $support_game;
        $view_datas['game'] = $game;
        $view_datas['date'] = $date;
        $view_datas['support_type'] = $support_type;
        $view_datas['type'] = $type;
        $view_datas['count_list'] = array('5' => 5, '10' => 10, '15' => 15);
        $view_datas['count'] = $count;
        $view_datas['order_list'] = array();

        if ($game == 'ALL' && $date == date('Y-m-d') && $type == 'default'){
            return view('Game.order', $view_datas);
        }

        $params['game'] = $game;
        $params['date'] = $date;
        $params['num'] = '';

        $result = Result::getResults($params, 'asc');
        $keep_count = 0;
        $money = 10;
        $keep_money = 0;
        $win_gold = 0;
        $max_count = $count + 10;
        $order_list = array();

            switch ($type){
                case 'top_mid_under':
                    // $odd = 4.35;

                    // foreach ($result as  $value) {
                    //     if ($value['top_mid_under'] != '中') {
                    //         $keep_count = $keep_count + 1;

                    //         if ($keep_count > $count and $keep_count <= $max_count) {
                    //             $keep_money = $keep_money + $money;
                    //             $win_gold = $odd * $money - $keep_money;
                    //             $money = $money * 2;
                    //         } elseif ($keep_count > $max_count) {
                    //             $win_gold = '-'. $win_gold;
                    //         }
                    //     } else {
                    //         if ($win_gold == 0) {
                    //             $keep_count = 0;
                    //         } else {
                    //             $order_list[] = $win_gold;
                    //             $win_gold = 0;
                    //             $keep_count = 0;
                    //         }
                    //     }
                    // }
                break;
                case 'odd_even_tie':
                   
                break;
                case 'five_elements_gold':
                 
                break;
                case 'five_elements_wood':
                 
                break;
                case 'five_elements_water':
                 
                break;
                case 'five_elements_fire':
                 
                break;
                case 'five_elements_earth':
                    $odd = 9.35;
                    $keep_count = 0;
                    $keep_money = 0;

                    foreach ($result as $value) {
                        if ($value['five_elements'] != '土') {
                            if ($keep_count > $count and $keep_count < $max_count) {
                                $win_gold = $keep_money = $keep_money + $money; // 累計下注金額

                                $order_list[] = array(
                                    'gold' => $money,
                                    'keep_money' => $keep_money,
                                    'win_gold' => '-'. $keep_money,
                                );
                                $money = $money * 2;
                            } else if ($keep_count > $max_count){
                                $keep_money = $keep_money + $money;

                                $order_list[] = array(
                                    'gold' => $money,
                                    'keep_money' => $keep_money,
                                    'win_gold' => '-'. $keep_money,
                                );
                                
                                $win_gold = 0;
                                $keep_count = 0;
                                $keep_money = 0;
                                $money = 10;
                            }
                            $keep_count = $keep_count + 1; // 連續數量
                        } else {
                            if ($win_gold == 0) {
                                $keep_count = 0;
                                $money = 10;
                            } else {
                                $keep_money = $keep_money + $money;

                                $order_list[] = array(
                                    'gold' => $money,
                                    'keep_money' => $keep_money,
                                    'win_gold' => $money * $odd - $keep_money,
                                );

                                $win_gold = 0;
                                $keep_count = 0;
                                $keep_money = 0;
                                $money = 10;
                            }
                        }
                    }
                break;
                default:
            }

        $view_datas['order_list'] = $order_list;

        return view('Game.order', $view_datas);
    }
}
