@extends('Element.head')

@section('sidebar')

@stop

@section('content')

<main>
    <div class="mt-2 pl-3 pr-3"><h4>模擬下注</h4>
    <h3 class="pb-1 mb-3 font-italic border-bottom"></h3>
    <form class="form-horizontal" action="{{action('GameOrderController@run')}}" method="get">
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
                <label for="type">玩法</label><br>
                {{Form::select('type', $support_type, $type, array('class' => 'custom-select d-block w-100'))}}
            </div>
            <div class="col-1.5 pl-2 mb-3">
                <label for="count">玩法</label><br>
                {{Form::select('count', $count_list, $count, array('class' => 'custom-select d-block w-100'))}}
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
            <thead class="table thead-dark">
                <tr>
                    <th width="33%">下注金額</th>
                    <th width="33%">累計下注金額</th>
                    <th width="33%">輸贏金額</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_list as $value)
                    <tr>
                        <td align="center">{{ $value['gold'] }}</td>
                        <td align="center">{{ $value['keep_money'] }}</td>
                        <td align="center">{{ $value['win_gold'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

@endsection
