@extends('Element.head')

@section('sidebar')

@stop

@section('content')

<main>
    <div class="mt-2 pl-3 pr-3"><h4>開獎分佈</h4>
    <h3 class="pb-1 mb-3 font-italic border-bottom"></h3>
    <form class="form-horizontal" action="{{action('GameDistributController@run')}}" method="get">
        <div class="row pl-3">
            <div class="col-1.5 pl-2 mb-3">
                <label for="game_type">遊戲</label><br>
                {{Form::select('game', $support_game, $game, array('class' => 'custom-select d-block w-100'))}}
            </div>
            <div class="col-1.5 pl-2 mb-3">
                <label for="date">日期</label><br>
                <input type="date" class="form-control" id="date" name="date" value="{{ $date }}" />
            </div>
            <div class="col-0.5 pt-4 pl-2 mb-3">
                <button type="submit" class="btn btn-primary btn-block">送出</button>
            </div>
        </div>
    </form>
    <h3 class="pb-2 mb-3 font-italic border-bottom"></h3>
    <h4>查詢結果</h4>
    <div class="table-responsive">
        <table class="table table-sm table-hover" style="border:3px #cccccc solid;" cellpadding="10" border='1'>
            @foreach ($total as $title => $value)
                <thead class="table thead-dark">
                    <tr>
                        @switch ($title)
                            @case ('top_mid_under')
                                <th width="20%">上中下盤</th>
                            @break
                            @case ('odd_even_tie')
                                <th width="20%">奇偶和盤</th>
                            @break
                            @case ('five_elements')
                                <th width="20%">五行元素</th>
                            @break
                            @default
                        @endswitch
                        <th width="40%">次數</th>
                        <th width="40%">比例</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($value as $name => $data)
                        <tr>
                            @switch ($name)
                                @case ('top')
                                    <td align="center">上</td>
                                @break
                                @case ('mid')
                                    <td align="center">中</td>
                                @break
                                @case ('under')
                                    <td align="center">下</td>
                                @break
                                @case ('odd')
                                    <td align="center">奇</td>
                                @break
                                @case ('even')
                                    <td align="center">偶</td>
                                @break
                                @case ('tie')
                                    <td align="center">和</td>
                                @break
                                @case ('gold')
                                    <td align="center">金</td>
                                @break
                                @case ('wood')
                                    <td align="center">木</td>
                                @break
                                @case ('water')
                                    <td align="center">水</td>
                                @break
                                @case ('fire')
                                    <td align="center">火</td>
                                @break
                                @case ('earth')
                                    <td align="center">土</td>
                                @break
                                @default
                            @endswitch
                            <td align="center">{{ $data }}</td>
                            <td align="center">{{ $percent[$name] }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            @endforeach
        </table>
    </div>
</main>

@endsection
