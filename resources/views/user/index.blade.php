<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>员工管理</title>
  
  @include('layouts._admin_headerCss')

</head>
<body id="iy_manage">
     <div class="layui-layout layui-layout-admin">
    <div class="layui-header">
      <div class="layui-logo" style="padding-top: 17px;"><h2 style="color: #fff;">方田OKR管理系统</h2><!--a href="{{ route('admin.logout') }}">退出</a--></div>
      
      </div>
    </div>
    <style type="text/css">
    .layui-nav .reset.layui-nav-item a{
      display: block;
      padding: 0px 3px;
      color: #fff;
      opacity: 1;
      width: 64px;
      height: 28px;
      line-height: 28px;
      transition: all .3s;
      -webkit-transition: all .3s;
      border: 1px solid #fff;
      border-radius: 2px;
    }
    #pid{
      width: 200px;
      display: inline-block;
    }
  </style>

  <div id="body-wrapper">

    @include('layouts._admin_sidebar')

    <!-- End #sidebar -->
    <div id="main-content">
      <div class="h2Title">
        员工管理
      </div>
      <!-- End .clear -->
      <div class="content-box">
        <div class="p_l8 jy_search">
          <button class="layui-btn layui-btn-normal add_yg">新增员工</button>
          <form style="float: right;">
            <input type="text" style="width: 315px;" id="phoneorname" name="phoneorname" lay-verify="identity" placeholder="员工手机或姓名" autocomplete="off" class="layui-input">
            <img src="/okr/resources/images/icons/search.png" class="jy_btn" onclick="search_user();">
          </form>
        </div>

        <table class="layui-table kj_table" id="kj_table" lay-even="" cellspacing="0" cellpadding="0">
        <!-- <colgroup>
          <col width="73px">
          <col width="170px">
          <col width="160px">
          <col width="83px">
          <col width="66px">
          <col width="69px">
          <col width="68px">
          <col width="99px">
          <col width="93px">
          <col width="93px">
          <col width="149px">
          <col width="238px">
        </colgroup> -->
        <thead>
          <tr>
            <th>序号</th>
            <th>姓名</th>
            <th>部门</th>
            <th>手机号</th>
            <th>邮件</th>
            <th>直接上级</th>
            <th>岗位</th>
            <th>状态</th>
            <th width="300">操作</th>
          </tr>
        </thead>
        <tbody>
          <!-- border_type  type_active 选择时 样式 -->
          
          @foreach ($user as $k=>$one)
          
          <tr>
              <td>
                {{ $k+1 }}
              </td>
              <td>
                {{ $one->name }}
              </td>
              <td>
                {{ $one->department->name }}
              </td>
              <td>
                {{ $one->phone }}
              </td>
              <td>
                {{ $one->email }}
              </td>
              <td>
              	{{ $one->pname->name }}
              </td>
              <td>
              	@foreach ($arr_position as $psnkey=>$psnval)
                	@if($psnkey==$one->position_id)
                    	{{ $psnval }}
                    @endif
                @endforeach
              </td>
              <td>
                @if ($one->status === 1)
        					停用
        				@endif
                @if ($one->status === 0)
        					启用
        				@endif
              </td>
              <td>
                <a href="javascript:void(0)" class="layui-btn layui-btn-primary layui-btn-sm yg_zt" onclick="editstatus_user('{{ route('user.editstatus' , $one->id ) }}','{{ $one->status }}')">
                	  @if ($one->status === 1)
                        启用
                    @endif
                    @if ($one->status === 0)
                        停用
                    @endif
                </a>
                <a href="javascript:void(0)" class="layui-btn layui-btn-primary layui-btn-sm yg_bj" onclick="edit_user('{{ route('user.edit',$one->id) }}','{{ route('user.update',$one->id) }}')">编辑</a>
                <a href="javascript:void(0)" class="layui-btn layui-btn-primary layui-btn-sm yg_cz" onclick="resetpwd_user('{{ route('user.resetpwd' , $one->id ) }}')">重置密码</a>
              </td>
          </tr>
          
          @endforeach
          
        </tbody>

        <tfoot>
          <tr>
            <td colspan="13" class="text-right" style="padding-right: 32px;">
              {!! $user->appends(array('phoneorname'=>$phoneorname))->render() !!}
              
            </td>
          </tr>
        </tfoot>
      </table>
    </div>

    <!-- End Notifications -->
    
  <div >

  </div>

    <!-- End #footer -->
  </div>
  <!-- End #main-content -->


</div>

<!-- models -->
<div class="models" id="newdiv">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
        <form>
        <table class="layui-table jy_table_layer">
        <colgroup>
        <col width="27">
        <col width="169">
        <col width="45">
        <col width="47">
        <col width="46">
        <col width="55">
        <col width="58">
        <col width="49">
        <col width="54">
        </colgroup>
        <thead>
        <tr>
        <th colspan="2">员工管理</th>
        </tr> 
        </thead>
        <tbody>
        <tr>
        <td>
        <span class="rd">*</span>员工姓名： <input type="text" id="name" name="name" lay-verify="identity" placeholder="填写员工姓名" autocomplete="off" class="layui-input bm_name">
        </td>
        <td>
        <span class="rd">*</span>员工电话：
          <input type="text" id="phone" name="phone" lay-verify="identity" placeholder="填写员工电话" autocomplete="off" class="layui-input bm_name">
        </td>
        </tr>
        <tr>
        <td>
          <span class="rd">*</span>员工邮箱： 
          <input type="text" id="email" name="email" lay-verify="identity" placeholder="填写员工邮箱" autocomplete="off" class="layui-input bm_name">
        </td>
        <td>
          <span class="rd">*</span>员工岗位： 
          <select id="position_id" name="position_id" class="selectpicker bm_ld" data-hide-disabled="true" data-live-search="true">
            @foreach ($arr_position as $key=>$one)
            	<option value="{{ $key }}">{{ $one }}</option>
            @endforeach
          </select>
        </td> 
        </tr>
        <tr>
        <td>
          <span class="rd">*</span>员工部门： 
          <select id="department_id" name="department_id" class="show-tick form-control sj_bm">
            @foreach ($all_dpt as $one)
            	<option value="{{ $one->id }}">{{ $one->name }}</option>
            @endforeach
          </select>
        </td>
        <td>
        	<?php
            //var_dump($arr_litedpt);die();
			?>
          <span class="rd">*</span>员工上级： 
          <select id="pid" name="pid" class="selectpicker bm_ld" data-hide-disabled="true" >
			      <option value="0">无</option>
            
          	@foreach ($arr_allUserDept as $one)
            	<optgroup label="{{ $one['name'] }}">
                @foreach ($one['users'] as $dptuser)
                	<option value="{{ $dptuser['id'] }}">{{ $dptuser['name'] }}</option>
                @endforeach
            @endforeach
            
          </select>
        </td> 
        </tr>
        <tr>
        <td>
          <span class="rd">*</span>员工状态： 
          <div class="rad_c">
            <input type="radio" name="status" value="0" class="mcr mcr-primary mcr-circle" checked />&nbsp;&nbsp;<label for="qiyong">启用</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="status" value="1" class="mcr mcr-primary mcr-circle" />&nbsp;&nbsp;<label for="tinyong">停用</label>
          </div>
        </td>
        <td>
          <span class="rd"></span>部门领导： 
          <div class="rad_c">
            <input type="checkbox" id="isleader" name="isleader" value="1" class="mcr mcr-primary mcr-circle" />
          </div>
        </td>  
        </tr>
        </tbody>
        </table>
        </form>
        </div>
      </div>
      <span class="layui-layer-setwin">
        <a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a>
      </span>
      <div class="layui-layer-btn layui-layer-btn-">
        <a class="layui-layer-btn0">保存</a>
        <a class="layui-layer-btn1">取消</a>
      </div>
      <span class="layui-layer-resize"></span>
  </div>
</div>
<!-- models end -->

@if (Session::has('del_user'))                                             
    <script>layer.msg('{{ session()->get("del_user") }}');</script>
@endif

<script type="text/javascript">

function del_user(id){
	layer.confirm('员工？这是个严肃的问题', {
		btn: ['决心删除','再考虑考虑'] //按钮
	}, function(){
		//layer.msg('已删除', {icon: 1});
		
		eval("delform_"+id).submit();
		
	}, function(){
		layer.msg('留得青山在不怕没柴烧！', {icon: 1});
	});
}

function edit_user(geturl,updateurl){
	//alert(url);return false;
	$.ajax({
		type: 'GET',
		url: geturl,
		//data: { id : id},
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': '{{csrf_token()}}'
		},

		success: function(data){
			console.log(data);
			$("#name").val(data.name);			
			$("#phone").val(data.phone);			
			$("#email").val(data.email);
			//$("#pid").val(data.pid);
			$('#pid').selectpicker('val', data.pid);
						
			//$("#position_id").val(data.position_id);
			$('#position_id').selectpicker('val', data.position_id);
			
			$("#department_id").val(data.department_id);

			
			$(":radio[name='status'][value='" + data.status + "']").prop("checked", "checked");
      $("#isleader").prop("checked", "")
			if(data.isleader=="1")$("#isleader").prop("checked", "checked");
			
			// $("#editform").attr('action',updateurl);
			
			ajax_type = 'PATCH';
			submit_url = updateurl;
			//$(".layui-layer-btn0").on("click",submit_user);
			//$(".layui-layer-btn0").click(submit_user);
			
			$("#newdiv").fadeIn();
				
		},
	});
}

function submit_user(){
	// alert("submit_user");
	var name = $("#name").val();
	var phone = $("#phone").val();
	var email = $("#email").val();
	var position_id = $("#position_id").val();
	var department_id = $("#department_id").val();
	var isleader = $('input:checkbox[name="isleader"]:checked').val();
	if (typeof isleader === "undefined") {isleader=0;}
	var pid = $("#pid").val();
	var status = $('input:radio[name="status"]:checked').val();

	//var name = "aaa";
	//var pid = "1";
	//var status = "bb";
	
	//alert(name+" "+pid+" "+status);
	
	if (!name) {
		layer.msg("名称不能为空",{time:1000});
		return false;
	}
	if (!phone) {
		layer.msg("电话不能为空",{time:1000});
		return false;
	}
  if(phone.length != 11)
  {
    layer.msg("请输入11位的电话",{time:1000});
    return false;
  }
	if (!email) {
		layer.msg("邮箱不能为空",{time:1000});
		return false;
	}
	if (!position_id) {
		layer.msg("岗位不能为空",{time:1000});
		return false;
	}
	if (!department_id) {
		layer.msg("部门不能为空",{time:1000});
		return false;
	}
	if (!pid) {
		layer.msg("上级员工不能为空",{time:1000});
		return false;
	}
	if (!status) {
		layer.msg("请选择状态",{time:1000});
		return false;
	}

	$.ajax({
		type: ajax_type,
		url: submit_url,
		//data: { name : name, pid : pid, status : status,'_token': "{{csrf_token()}}"},
		data: { name : name, phone : phone, email : email, position_id : position_id, department_id : department_id, pid : pid, isleader : isleader, status : status},
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': '{{csrf_token()}}'
		},
		success: function(data){
			console.log(data);
			layer.msg(data.msg);
			if(data.status=="1"){window.location.reload();}
		},
	});
}


function editstatus_user(editstatusurl,editstatus){

	if(editstatus=="0"){
		editstatus="1";
	}else{
		editstatus="0";
	}

	$.ajax({
		type: 'PATCH',
		url: editstatusurl,
		//data: { name : name, pid : pid, status : status,'_token': "{{csrf_token()}}"},
		data: { status : editstatus},
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': '{{csrf_token()}}'
		},
		success: function(data){
			console.log(data);
			layer.msg(data.msg);
			if(data.status=="1"){window.location.reload();}
		},
	});
}

function resetpwd_user(resetpwdurl){
	$.ajax({
		type: 'PATCH',
		url: resetpwdurl,
		//data: { name : name, pid : pid, status : status,'_token': "{{csrf_token()}}"},
		//data: { status : editstatus},
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': '{{csrf_token()}}'
		},
		success: function(data){
			console.log(data);
			layer.msg(data.msg);
			if(data.status=="1"){window.location.reload();}
		},
	});
}

function search_user(){
	if($("#phoneorname").val()==""){
		layer.msg("请输入条件",{time:1000});
		return false;	
	}
	
	searchurl = "{{ route('user.index') }}";
	//alert(searchurl);
	window.location.href = searchurl+ "?phoneorname="+$("#phoneorname").val();
	
}


$(function(){
    $("#iy_manage .treeview a:contains('员工管理')").parent().addClass('active');
	
    /*关闭*/
    $(".layui-layer-close1,.layui-layer-btn1").on("click",function(){
      $(this).parent().parent().parent().hide();
    })
	
    /*新增部门*/
    $(".add_yg").on("click",function(){
      //$(".models").fadeIn();
  	  ajax_type = 'POST';
  	  submit_url = "{{ route('user.store') }}";
  	  //$(".layui-layer-btn0").on("click",submit_user);
	  //$(".layui-layer-btn0").click(submit_user);
  	  
	  $("#name").val("");
	  $("#phone").val("");
	  $("#email").val("");
	  //alert($("#pid").val());
	  $("#pid").val(0);
	  $('#pid').selectpicker('refresh');
	  //alert($("#pid").val());
	  $("#position_id").val(0);
	  $('#position_id').selectpicker('refresh');
	  $("#department_id").val(0);
	  
	  $(":radio[name='status'][value='0']").prop("checked", "checked");
	  $("#isleader").prop("checked", "");
	  
  	  $("#newdiv").fadeIn();
    });
	
	$(".layui-layer-btn0").on("click",submit_user);
	
})

</script>
<script type="text/javascript" src="/okr/js/main.js"></script></body>
<!-- Download From www.exet.tk-->
</html>
