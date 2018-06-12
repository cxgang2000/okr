$(document).ready(function(){
	var heights = $("#main-content").height();
	$(".main-sidebar").css("height",heights+"px");

	/*导航*/
	$(".treeview").hover(function(){
		$(this).find(".side_content").show();
	},function(){
		$(this).find(".side_content").hide();
	})
	/*设置*/
	$(".dows").hover(function(){
      $(".layui-anim-upbit").show();
    },function(){
      $(".layui-anim-upbit").hide();
    })

    /*修改密码*/
    $(".xgmm").on("click",function(){
    	$(".mm_model").show();
    })

    /*显示隐藏密码*/
    $(".xs").on("click",function(){
    	var htmlty = $(this).html();
    	if (htmlty == "显示密码") {
    		$(".new_pass").prop('type','text');
    		$(this).html("隐藏密码");
    	}else{
    		$(".new_pass").prop('type','password');
    		$(this).html("显示密码");
    	}
    })

    /*关闭models*/
    $(".layui-layer-close1,.layui-layer-btn1").on("click",function(){
        $(this).parent().parent().parent().hide();
    })

    /*model点击编辑显示边框*/
    $(".models_bj").on("click",function(){
      $(this).parent().parent().next().find("ul").removeClass("ul_no");
      $(this).parent().parent().next().next().show();
    })

    /*取消编辑*/
    $(".models_qx").on("click",function(){
      $(this).parent().hide();
      $(this).parent().prev().find("ul").addClass("ul_no");
    })

    /*ztree 赋值*/

    /*点击不同 展示不同编辑框*/
      
	/*
    /*弹出目标框*/
	
    $("#treeDemo,#myTreeDemo").on("click",".mbxq",function(){
      $(".dy_mb_models").show();
    })
	
    /*弹出计划框*/
	
    $("#treeDemo,#myTreeDemo").on("click",".jhxq",function(){
      $(".jh_mb_models").show();
    })
	
    /*弹出结果框*/
	/*
    $("#treeDemo,#myTreeDemo").on("click",".jgxq",function(){
      $(".key_mb_models").show();
    })
	*/
    /*添加新记过*/
	
     $("#treeDemo,#myTreeDemo").on("click",".tj_jh",function(){
      $(".add_jh_models").show();
    })
	
     /*添加新结果*/
	 /*
     $("#treeDemo,#myTreeDemo").on("click",".tj_jg",function(){
      $(".add_jg_models").show();
    })
	*/

     /*鼠标*/
     /*$(".node_name").hover(function(){
      alert(1245)
      $(this).parent().find(".demoIcon").show();
     })*/

 /*end times*/
  layui.use('laydate', function(){
        var laydate = layui.laydate;
        laydate.render({
          elem: '#test6'
          ,range: true
        });
        laydate.render({
          elem: '#res_time'
          ,range: true
        });
        laydate.render({
          elem: '#key_time'
          ,range: true
        });
        laydate.render({
          elem: '#my_mb_times'
          ,range: true
        });
        laydate.render({
          elem: '#dy_res_time'
          ,range: true
        });
        laydate.render({
          elem: '#dy_jh_time'
          ,range: true
        });
        laydate.render({
          elem: '#dy_key_time'
          ,range: true
        });
        laydate.render({
          elem: '#add_key_time'
          ,range: true
        });
        laydate.render({
          elem: '#add_jh_time'
          ,range: true
        });
  });
}); 



 