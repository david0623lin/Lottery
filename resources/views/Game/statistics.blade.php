@extends('Element.head')

@section('sidebar')

@stop

@section('content')

<main>
    <div class="mt-2 pl-3 pr-3"><h4>玩法統計</h4>
    <h3 class="pb-1 mb-3 font-italic border-bottom"></h3>
    <form class="form-horizontal" action="{{action('GameStatisticsController@run')}}" method="get">
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
                    <th width="20%">次數</th>
                    <th width="80%">統計</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statistics as $value)
                    <tr>
                        <td align="center">
                            <?php  $total = count($value);?>
                            {{ $total }}
                        </td>   
                        <td>
                            @foreach($value as $code)
                                <table class="table-result" align="left" style="display:inline;">
                                    <td style="background-color: #F0F0F0;">{{$code}}</td>
                                </table>
                            @endforeach
                        </td>  
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

@endsection
