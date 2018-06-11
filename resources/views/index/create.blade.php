<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>方田网申登陆页</title>
	<link rel="stylesheet" href="/okr/resources/layer/css/layui.css" type="text/css" media="screen" />

	<link rel="stylesheet" href="/okr/resources/bootstrap/css/bootstrap.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/okr/resources/css/style.css">
	<script type="text/javascript" src="/okr/resources/layer/layui.all.js"></script>
	<!-- <script type="text/javascript" src="/okr/resources/scripts/jquery-1.3.2.min.js"></script> -->
	<script type="text/javascript" src="/okr/resources/scripts/jquery-2.1.4.min.js"></script>
	<style type="text/css">
	input:focus {
		outline: none!important;
		box-shadow: none!important;
	}
</style>
</head>

<body id="login">
	<div class="login_cont">
		<h2 class="text-center login_titles">方田OKR管理后台</h2>

		<div class="input_cont">
			<div class="form_cont">
				<form name="form1" method="post" action="{{ route('index.login') }}">
                {{ csrf_field() }}
					<div class="form-group">
						<input type="email" class="form-control reset-input" id="name" placeholder="请输入账户">
					</div>
					<div class="form-group">
						<input type="password" class="form-control reset-input password" id="password" placeholder="请输入密码">
					</div>
					<button type="button" class="btn btn-lg btn-block btn-reset sub">登录</button>

					<div class="form-group text-center">
						<!-- <a href="#">忘记密码？</a> -->
					</div>
				</form>
			</div>
		</div>
	</div>


@if (count($errors) > 0)
    @foreach($errors->all() as $error)
    	<script>layer.msg('{{ $error }}');</script>
    @endforeach
@endif


<script type="text/javascript">
$(function(){
	$(".sub").on("click",function(){
		
		//form1.submit();
		//return false;
		
		
		var name = $("#name").val();
		var password = $("#password").val();

		if (!name) {
			layer.msg("账户不能为空",{time:1000});
			return false;
		}
		if (!password) {
			layer.msg("密码不能为空",{time:1000});
			return false;
		}
		
		//form1.submit();
		
		$.ajax({
			type: "POST",
			url: "{{ route('index.login') }}",
			data: { name : name, password : password},
			dataType: 'json',
			headers: {
				'X-CSRF-TOKEN': '{{csrf_token()}}'
			},
			success: function(data){
				console.log(data);
				
				if(data.status=="1"){
					window.location.href=data.msg;
				}else{
					layer.msg(data.msg);
				}
			},
		});
		
	})
})
</script>
<script type="text/javascript" src="/okr/js/main.js"></script></body>
<!-- Download From www.exet.tk-->
</html>
