<?php

namespace App\Classes\Parser;

class preg
{
    public static function TWBG($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Safari/537.36");
        $html = curl_exec($ch);
        curl_close($ch);

        if (is_null($html)){
            echo '台灣賓果賓果 - 解析賽果失敗';
            exit;
        }

        $curl_html = preg_replace('/\s/', '', $html);

        $pattern_num = '/">第\d{9}/msu';
        preg_match_all($pattern_num, $curl_html, $matches_num);

        $pattern_result = "/class='bingo_[a-zA-Z0-9-_]*'>\d{1,2}/";
        preg_match_all($pattern_result, $curl_html, $matches_result);

        if (count($matches_num[0]) != (count($matches_result[0]) / 20)){
            echo '台灣賓果賓果 - 解析賽果資料異常';
            exit;
        }

        $i = 0;
        $all_result = array();

        foreach ($matches_result[0] as $v){
            $result = explode('>', $v)[1];
            $all_result[] = $result;

            if (count($all_result) == 20){
                $num = explode('第', $matches_num[0][$i])[1];
                $rets[$num]['code'] = json_encode($all_result);
                $rets[$num]['top_mid_under'] = self::top_mid_under($all_result);
                $rets[$num]['odd_even_tie'] = self::odd_even_tie($all_result);
                $rets[$num]['five_elements'] = self::five_elements($all_result);
                $all_result = array();
                $i = $i + 1;
            }
        }

        return $rets;
    }

    public static function top_mid_under($result)
    {
        $top = 0;
        $under = 0;

        foreach ($result as $number){
            if ($number > 0 && $number <= 40){
                $top = $top + 1;
            } else if ($number > 40 && $number <= 80){
                $under = $under + 1;
            }
        }

        if ($top > $under){
            $top_mid_under = '上';
        } else if ($top < $under){
            $top_mid_under = '下';
        } else if ($top == $under){
            $top_mid_under = '中';
        }

        return $top_mid_under;
    }

    public static function odd_even_tie($result)
    {
        $odd = 0;
        $even = 0;

        foreach ($result as $number){
            if (($number % 2) == 1){
                $odd = $odd + 1;
            } else {
                $even = $even + 1;
            }
        }

        if ($odd > $even){
            $odd_even_tie = '奇';
        } else if ($odd < $even){
            $odd_even_tie = '偶';
        } else if ($odd == $even){
            $odd_even_tie = '和';
        }

        return $odd_even_tie;
    }

    public static function five_elements($result)
    {
        $sum = 0;

        foreach ($result as $number){
            $sum = $sum + $number;
        }

        if ($sum >= 210 && $sum <= 695){
            $elements = '金';
        } else if ($sum >= 696 && $sum <= 763){
            $elements = '木';
        } else if ($sum >= 764 && $sum <= 855){
            $elements = '水';
        } else if ($sum >= 856 && $sum <= 923){
            $elements = '火';
        } else if ($sum >= 924 && $sum <= 1410){
            $elements = '土';
        }

        return $elements;
    }
}
