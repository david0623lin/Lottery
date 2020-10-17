<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\Parser\preg;
use App\Models\Result;

class ParserResults extends Command
{
    protected $signature = 'parser:results {game_type?}{search_date?}';
    protected $description = '賽果擷取';

    public function handle()
    {
        $game_type = $this->argument('game_type');
        $search_date = $this->argument('search_date');

        if (empty($search_date)){
            $search_date = date('Y-m-d');
        }

        $rets = array();

        switch ($game_type){
            case 'TWBG':
                $url = 'https://www.9696ty.com/96/bingo/reloadnumber.php?date='. $search_date;
                $rets = preg::TWBG($url);
            break;
            default;
                $this->info('不支援的遊戲');
            break;
        }

        Result::setResults($game_type, $search_date, $rets);
    }
}
