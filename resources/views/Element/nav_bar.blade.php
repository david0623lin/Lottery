<nav class="navbar navbar-expand-lg  bg-dark navbar-dark">
	<a class="navbar-brand" href="#">彩票後台</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="main_nav">
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">賽果中心 </a>
				<ul class="dropdown-menu" role="menu">
					<li><a class="dropdown-item" href="{{action('GameHistoryController@run')}}">開獎結果</a></li>
					<li><a class="dropdown-item" href="{{action('GameStatisticsController@run')}}">玩法統計</a></li>
					<li><a class="dropdown-item" href="{{action('GameDistributController@run')}}">開獎分佈</a></li>
				</ul>
			</li>
		</ul>
	</div> <!-- navbar-collapse.// -->
</nav>