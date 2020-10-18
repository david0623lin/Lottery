@extends('Element.head')

@section('sidebar')

@stop

@section('content')

<main>
    <div class="mt-2 pl-3 pr-3"><h4>期別查詢</h4>
    <h3 class="pb-1 mb-3 font-italic border-bottom"></h3>
    <form class="form-horizontal" action="{{action('GameHistoryController@run')}}" method="get">
        <div class="row pl-3">
            <div class="col-1.5 pl-2 mb-3">
                <label for="game_type">遊戲</label><br>
                {{Form::select('game', $support_game, $game, array('class' => 'custom-select d-block w-100'))}}
            </div>
            <div class="col-1.5 pl-2 mb-3">
                <label for="date">日期</label><br>
                <input type="date" class="form-control" id="date" name="date" value="{{ $date }}" />
            </div>
            <div class="col-1.5 pl-2 mb-3">
                <label for="game_num">期數</label><br>
                {{Form::text('num', $num, array('class' => 'form-control'))}}
            </div>
            <div class="col-0.5 pt-4 pl-2 mb-3">
                <button type="submit" class="btn btn-primary btn-block">送出</button>
            </div>
        </div>
    </form>
    <h3 class="pb-2 mb-3 font-italic border-bottom"></h3>
    <h4>查詢結果</h4><p>共 {{ $count }} 期</p>
    <div class="table-responsive">
        <table class="table table-sm table-hover" style="border:3px #cccccc solid;" cellpadding="10" border='1'>
            <thead class="table thead-dark">
                <tr>
                    <th>期數</th>
                    <th>賽果</th>
                    <th>上中下盤</th>
                    <th>奇偶和盤</th>
                    <th>五行元素</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $ret)
                    <tr>
                        <td align="center">第 {{ $ret['num'] }} 期</td>
                        <td>
                            <table class="table-result">
                                <tr>
                                    <?php $value = json_decode($ret['result'], true);?>
                                    @foreach($value as $code)
                                        <td style="background-color: #E8E8E8;">{{$code}}</td>
                                    @endforeach
                                </tr>
                            </table>
                        </td>

                        @if ($ret['top_mid_under'] == '中')
                            <td align="center"><b><font color="red">{{ $ret['top_mid_under'] }}</font></b></td>
                        @else
                            <td align="center">{{ $ret['top_mid_under'] }}</td>
                        @endif

                        @if ($ret['odd_even_tie'] == '和')
                            <td align="center"><b><font color="red">{{ $ret['odd_even_tie'] }}</font></b></td>
                        @else
                            <td align="center">{{ $ret['odd_even_tie'] }}</td>
                        @endif

                        @switch ($ret['five_elements'])
                            @case ('金')
                                <td align="center"><font color="#FFD306">{{ $ret['five_elements'] }}</font></td>
                            @break
                            @case ('木')
                                <td align="center"><font color="#9F5000">{{ $ret['five_elements'] }}</font></td>
                            @break
                            @case ('水')
                                <td align="center"><font color="#5555FF">{{ $ret['five_elements'] }}</font></td>
                            @break
                            @case ('火')
                                <td align="center"><font color="#E63F00">{{ $ret['five_elements'] }}</font></td>
                            @break
                            @case ('土')
                                <td align="center"><font color="#EA7500">{{ $ret['five_elements'] }}</font></td>
                            @break
                        @endswitch
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

@endsection
