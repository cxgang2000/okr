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
    });
    $(".models_qx").on("click",function(){
        $(this).parent().parent().parent().parent().parent().parent().hide();
    });

    /*评分model*/
    $(".ztree").on("click",".pf",function(){
        $(".dafen_models").show();
    })
    /*评论model*/
    //$(".ztree").on("click",".icon-pinglun",function(){
    //    $(".pl_models").show();
    //})
    /*删除model*/
    //$(".ztree").on("click",".icon-laji",function(){
        /*判断如果是直接删除就直接show 否则就间接show 以随机数代替*/
    //    var nums =Math.ceil(Math.random()*10);
    //    if (nums > 5 ) {
            /*直接删*/
    //        $(".zjsc_models").show();
    //    }else{
            /*不能删*/
    //        $(".bnsc_models").show();
    //    } 
    //})

    /*新增mb*/
    $(".xzmb").on("click",function(){
        $(".tj_mb").show();
    })
    /*新增kr*/
    //$(".ztree").on("click",".tj_jh,.xq",function(){
    //    $(".tj_jg").show();
    //})
    /*信心指数*/
    //$(".ztree").on("click",".xxzs",function(){
    //    $(".tj_xxzs").show();
    //})
    /*添加未来计划*/
    $(".wl_jh").on("click",function(){
        $(".tj_jh").show();
    })
    /*添加关注任务*/
    $(".tj_gz_icon").on("click",function(){
        $(".tj_gz").show();
    })
    /*添加状态*/
    $(".tj_zt_icon").on("click",function(){
        $(".tj_ztzb").show();
    })
    /*删除*/
    $(".this_cz .icon-laji").on("click",function(){
        /*直接删*/
        $(".zjsc_models").show();
    })
    /*评论*/
    //$("#cy_mb .icon-pinglun").on("click",function(){
    //    $(".pl_models").show();
    //})
	
	/*隐藏*/
    $(".ycl_nav").on("click",function(){
        if ($(".main-sidebar").is(":hidden")) {
            $(".main-sidebar").show();
            $("#main-content").css("margin-left","200px");
        }else{
            $(".main-sidebar").hide();
            $("#main-content").css("margin","0");
        }
        
    })
    /*select 切换*/
    $(".time_con .list").on("click",function(){
        $(this).addClass("active").siblings(".active").removeClass("active");
    })
}); 

 