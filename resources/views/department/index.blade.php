<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>部门管理</title>
  
    @include('layouts._admin_headerCss')

</head>
<body id="iy_manage">
     <div class="layui-layout layui-layout-admin">
    <div class="layui-header">
      <div class="layui-logo" style="padding-top: 17px;"><h2 style="color: #fff;">方田OKR管理系统</h2></div>
      
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
  
<!--
@if (count($errors) > 0)
    @foreach($errors->all() as $error)
    	<script>layer.msg('{{ $error }}', {icon: 1});</script>
    @endforeach
@endif
-->
  
  <div id="body-wrapper">

    @include('layouts._admin_sidebar')
	<!-- End #sidebar -->

    <div id="main-content">

      <div class="h2Title">
        部门管理
      </div>
      <!-- End .clear -->
      <div class="content-box">
        <div class="p_l8 jy_search">
          <button class="layui-btn layui-btn-normal add_bm">新增部门</button>
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
            <th>名称</th>
            <th>上级部门</th>
            <th>部门领导</th>
            <th>状态</th>
            <th width="300">操作</th>
          </tr>
        </thead>
        <tbody>
          <!-- border_type  type_active 选择时 样式 -->
          
          @foreach ($arr_dpt as $k=>$one)
          
          <tr @if ($one['status'] === 1)class="ty"@endif >
              <td>
                {{ ($department->currentPage()-1)*$department->perPage()+$k+1 }}
              </td>
              <td>
                {{ $one['name'] }}
              </td>
              <td>
              	@if ($one['pid'] == 0)
                	无
                @else
                	{{ $one['pname']['name'] }}
                @endif
              </td>
              <td>
                {{ $one['leader'] }}
              </td>
              <td>
                @if ($one['status'] === 1)
        					停用
        				@endif
                @if ($one['status'] === 0)
        					启用
        				@endif                
              </td>
              <td>
                <a href="javascript:void(0)" class="layui-btn layui-btn-primary layui-btn-sm bm_bj" onclick="edit_dpt('{{ route('department.edit',$one['id']) }}','{{ route('department.update',$one['id']) }}')">编辑</a>
                <a href="javascript:void(0)" class="layui-btn layui-btn-primary layui-btn-sm bm_del" onclick="del_dpt('{{ $one['id'] }}')">删除</a>
                
                  <form name="delform_{{ $one['id'] }}" action="{{ route('department.destroy', $one['id']) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <!--button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button-->
                  </form>

              </td>
          </tr>
          
          @endforeach
          
        </tbody>

        <tfoot>
          <tr>
            <td colspan="13" class="text-right" style="padding-right: 32px;">
              {!! $department->render() !!}
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
          <!--form method="POST" name="form1" action="{{ route('department.store') }}"-->
          {{ csrf_field() }}
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
                <th colspan="2" id="dpt_div_title">部门管理</th>
              </tr> 
            </thead>
            <tbody>
              <tr>
                <td>
                  <span class="rd">*</span>名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称： <input type="text" id="name" name="name" lay-verify="identity" placeholder="填写部门名称" autocomplete="off" class="layui-input bm_name">
                </td>
                <td>
                  <span class="rd">*</span>上级部门：
                  <select name="pid" id="pid" class="show-tick form-control sj_bm">
                    <option value="0">无</option>
                      @foreach ($arr_all_dpt as $one)
                      	<option value="{{ $one->id }}">{{ $one->name }}</option>
                      @endforeach
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <span class="rd">*</span>状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态： 
                  <div class="rad_c">
                    <input type="radio" name="status" value="0" class="mcr mcr-primary mcr-circle" checked />&nbsp;&nbsp;<label for="qiyong">启用</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="status" value="1" class="mcr mcr-primary mcr-circle" />&nbsp;&nbsp;<label for="tinyong">停用</label>
                  </div>
                </td>
                <td>
                  
                </td> 
              </tr>
            </tbody>
          </table>
          <!--/form-->
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


@if (Session::has('del_department'))                                             
    <script>layer.msg('{{ session()->get("del_department") }}');</script>
@endif

<script type="text/javascript">

function del_dpt(id){
	layer.confirm('部门删除？这是个严肃的问题', {
		btn: ['决心删除','再考虑考虑'] //按钮
	}, function(){
		//layer.msg('已删除', {icon: 1});
		
		eval("delform_"+id).submit();
		
	}, function(){
		layer.msg('留得青山在不怕没柴烧！', {icon: 1});
	});
}

var edit_dpt_id="";
function edit_dpt(geturl,updateurl){
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
      edit_dpt_id=data.id;
			$("#name").val(data.name);			
			$("#pid").val(data.pid);
      // 部门编辑，在上级部门中置灰被编辑的部门
      $("#pid option[value="+edit_dpt_id+"]").attr("disabled","disabled");
			$(":radio[name='status'][value='" + data.status + "']").prop("checked", "checked");
			
			// $("#editform").attr('action',updateurl);
			
      		ajax_type = 'PATCH';
      		submit_url = updateurl;
	  		//$(".layui-layer-btn0").on("click",submit_dpt);
			
      $("#dpt_div_title").html("编辑部门");  

      $("#newdiv").fadeIn();
			
		},
	});
}

function submit_dpt(){
	// alert("submit_dpt");
	var name = $("#name").val();
	var pid = $("#pid").val();
	var status = $('input:radio[name="status"]:checked').val();

	//var name = "aaa";
	//var pid = "1";
	//var status = "bb";
	
	//alert(name+" "+pid+" "+status);

	if (name.trim()=="") {
		layer.msg("名称不能为空",{time:1000});
		return false;
	}
	if (!pid) {
		layer.msg("上级部门不能为空",{time:1000});
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
		data: { name : name, pid : pid, status : status},
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': '{{csrf_token()}}'
		},
		success: function(data){
			console.log(data);
			layer.msg(data.msg);
      // $("#pid option[value="+edit_dpt_id+"]").attr("disabled","");
			if(data.status=="1"){window.location.reload();}
		},
	});
}

$(function(){
    $("#iy_manage .treeview a:contains('部门管理')").parent().addClass('active');
	
    /*关闭*/
    $(".layui-layer-close1,.layui-layer-btn1").on("click",function(){
      $(this).parent().parent().parent().hide();
    })
	
    /*新增部门*/
    $(".add_bm").on("click",function(){
      //$(".models").fadeIn();
  	  ajax_type = 'POST';
  	  submit_url = "{{ route('department.store') }}";
  	  //$(".layui-layer-btn0").on("click",submit_dpt);
  	  
  	  $("#name").val("");
  	  $("#pid").val(0);
      // 新增部门，恢复被置灰的上级部门
      if(edit_dpt_id!=""){
        $("#pid option[value="+edit_dpt_id+"]").attr("disabled",false);
      }
	  
      $("#dpt_div_title").html("新增部门");

  	  $("#newdiv").fadeIn();
    });
	
	$(".layui-layer-btn0").on("click",submit_dpt);
})

</script>
<script type="text/javascript" src="/okr/js/main.js"></script></body>
<!-- Download From www.exet.tk-->
</html>
