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
      <div class="layui-logo" style="padding-top: 17px;"><h2 style="color: #fff;">方田OKR管理系统</h2></div>
      <!-- <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item" style="opacity: 0">
          <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAdCAYAAADLnm6HAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjFDNTI5RjQ5NDIyNjExRTg5NEFFOEM2QTY0RTNGOTkzIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjFDNTI5RjRBNDIyNjExRTg5NEFFOEM2QTY0RTNGOTkzIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MUM1MjlGNDc0MjI2MTFFODk0QUU4QzZBNjRFM0Y5OTMiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MUM1MjlGNDg0MjI2MTFFODk0QUU4QzZBNjRFM0Y5OTMiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6SkV3MAAACf0lEQVR42rSXPWgUQRTH985NlFj4gUi0CIkINkoasZAgKVTUwhirYCyiQdBGGwmIpA6H2NgGIbHQ1iZqkSqGoOBntAkRo3KIED8IwkWT0/U38FbG5+ztHLc78IO9Nzfv/25m9r13hSiKAo+xBQ5CF+yBHdAKocxX4RO8hVcwDZPwOdWzCSCBIvTAfViN6h+rsrZHfDl1ksQPwWyU3ZgVn/9pFdQRrIMbcM61WfAansBL2d5vMrdJjqkT9sJuKDh8jMJF+OE6gg0w44h+Di5DW43j0rTJmjmHvxnR+ucImmFKfXERBmqdnwdF8bGofE+J5t8ARhxRbmtAWNPq2N2ROIAOWLEmHkNLhuIxLeI7Hkazw0yULGMF2nMQj2kXjXiUTCI5at3SW/BO3dwB6/mBJJxAktJOeX4jySeQBHXEWnMbVuTZ+B6H8/L5WKC2v9cRtT26LfuYZR+z7N1qzUblr9c+hiJRNFnRfg/yH0vWc5MJ4Itl2JWwIKZq2SuWvWLZq2qNLja2xlezJRPqDSjkeAkD9SZMGEO/OrMLOYoPKq1+YwxVyjSX8kQO4ofVhTeaYTy5X5XcXzAMazIQNul4CKqqVHfpcnzWUTimYW0DwsfhhcPvYFI/0AfLKe9xLTZL3b8OHx3CxveptIbkpEcA5k05DXdhEp7Ch5Sm5Bl0+nREaZlsHzyqoxuahzNy2YNGAtgO456iZbgpN79mPxF6pE7Tpl2Bq7Bezc3DPfgpRWpB2rUF78TssQNlxy9ckparudHX1CcAe/yGUdiaVYIK66hiD+ESPM+yNBY9vvMe+uBA1uKB9dfKNUyJLcE1WM6rOQgT/oDcgSEo592d/BFgALviMtKkFV2wAAAAAElFTkSuQmCC" class="layui-nav-img" style="position: absolute;
          left: -209px;
          top: -15px;">     
        </li>
        <li class="layui-nav-item" style="opacity: 0">
          <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAiCAYAAACnSgJKAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjFEMzJFMUEyNDIyNjExRTg5OUMyQURCRTgyMzUzRDBBIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjFEMzJFMUEzNDIyNjExRTg5OUMyQURCRTgyMzUzRDBBIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MUQzMkUxQTA0MjI2MTFFODk5QzJBREJFODIzNTNEMEEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MUQzMkUxQTE0MjI2MTFFODk5QzJBREJFODIzNTNEMEEiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz65zRvXAAAB0ElEQVR42uyXv0vDQBTHkyiCOmjASWxxUChFNwc37dKKQxehDkKn/gs661j8B7pIJxeLaxWkLf4FHcQujorg0vqDtoPS+D14keOZNGdz2CUPPpTk3nsf7tKDO9NxHEMxlkAOpMA6iAELDMAjuAMNcAGelDoKeQBJUAEDRy0GlJ8M6j1scAKcgE9ntBB1x9TH02H6LPsMuAQ7HmNiSW/BA3gDc2AVbNGn4XEN9kBPZdmnQN1jJjWQAqbPTEwar3nU1qlv4LKXWGEP5BX+GzJ5qpOjFCTPsIJ3sPlHsYuo+2D9Mn5yC7RYcnZEsUuW9WuR55ecJ5ZDil3KfhOSkypsm8Q1yeNsu1a4XCxFW0qoahK7VKXebXfpLdpxy8CWduCNoTfkfjb5fuQxlnyvWc77xWS5zQbbmuW8ny3LeXxplnv2s4wxRiSP5JH8X2ISbIM19n4DzGv0rLBn4XsV5y4n+ubj+OapgJxdcCg9H4Bnj7xFcC49n4Jq2OtSmp3BCj55BZaXDnNdcpkGXanpC0iwnAS9d6NLdaHlgiKbVR+cgSP67bPxokpfVfksaCpeEJuUr00uWACNAHGD8gzdcvcyuA+uQIeEHToa54ZcIj35FmAA5R0e3RAgbI8AAAAASUVORK5CYII=" class="layui-nav-img" style="position: absolute;
          left: -130px;
          top: -15px;">     
        </li>
        <li class="layui-nav-item" style="margin-right: 36px;">洋河赵坤老师，您好！</li>
        <li class="layui-nav-item reset"><a href="">退出登陆</a></li>
      </ul> -->
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
  </style>

  <div id="body-wrapper">

    @include('layouts._admin_sidebar')

    <!-- End #sidebar -->
    <div id="main-content">
      <div class="cons" style="display: none">
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
          <span class="rd">*</span>名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称： <input type="text" name="identity" lay-verify="identity" placeholder="填写部门名称" autocomplete="off" class="layui-input">
          </td>
          <td>
          <span class="rd">*</span>上级部门：
            <select id="basic" class="show-tick form-control">
              <option>品牌部</option>
              <option data-subtext="option subtext">人力资源</option>
              <option class="get-class">财务部门</option>
            </select>
          </td>
          </tr>
          <tr>
          <td>
          <span class="rd">*</span>部门领导： <select id="first-disabled" class="selectpicker" data-hide-disabled="true" data-live-search="true">
                  <option>Hidden</option>
                  <option>Apple</option>
                  <option>Orange</option>
                  <option>Corn</option>
                  <option>Carrot</option>
              </select>
          </td>
          <td>
          <span class="rd">*</span>状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态： <div class="rad_c"><input type="radio" name="ad_name" id="qiyong" class="mcr mcr-primary mcr-circle" />&nbsp;&nbsp;<label for="qiyong">启用</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="ad_name" id="tinyong" class="mcr mcr-primary mcr-circle" />&nbsp;&nbsp;<label for="tinyong">停用</label></div>
          </td> 
          </tr>
          </tbody>
          </table>
          </form>
        </div>
      </div>

      <div class="h2Title">
        <a href="jy_manage.html" class="nows">员工管理</a>
      </div>
      <!-- End .clear -->
      <div class="content-box">
        <div class="p_l8 jy_search">
          <button class="layui-btn layui-btn-normal add_yg">新增员工</button>
          <form style="float: right;">
            <input type="text" style="width: 315px;" name="identity" lay-verify="identity" placeholder="员工手机或姓名" autocomplete="off" class="layui-input">
            <img src=".//okr/resources/images/icons/search.png" class="jy_btn">
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
          <tr>
              <td>
                1
              </td>
              <td>
                李好
              </td>
              <td>
                总裁办
              </td>
              <td>
                15155102848
              </td>
              <td>
                15155102848@fangtian.me
              </td>
              <td>不知道</td>
              <td>不知道</td>
              <td>
                启用
              </td>
              <td>
                <a href="javascript:void(0)" class="layui-btn layui-btn-primary layui-btn-sm yg_zt">停用</a>
                <a href="javascript:void(0)" class="layui-btn layui-btn-primary layui-btn-sm yg_bj">编辑</a>
                <a href="javascript:void(0)" class="layui-btn layui-btn-primary layui-btn-sm yg_cz">重置密码</a>
              </td>
          </tr>
        </tbody>

        <tfoot>
          <tr>
            <td colspan="13" class="text-right" style="padding-right: 32px;">
              <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-10"><span class="layui-laypage-count">共 100 条</span><a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="0">上一页</a><span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>1</em></span><a href="javascript:;" data-page="2">2</a><a href="javascript:;" data-page="3">3</a><a href="javascript:;" data-page="4">4</a><a href="javascript:;" data-page="5">5</a><span class="layui-laypage-spr">…</span><a href="javascript:;" class="layui-laypage-last" title="尾页" data-page="10">10</a><a href="javascript:;" class="layui-laypage-next" data-page="2">下一页</a><span class="layui-laypage-limits"><select lay-ignore=""><option value="10" selected="">10 条/页</option><option value="20">20 条/页</option><option value="30">30 条/页</option><option value="40">40 条/页</option><option value="50">50 条/页</option></select></span><span class="layui-laypage-skip">到第<input type="text" min="1" value="1" class="layui-input">页<button type="button" class="layui-laypage-btn">确定</button></span></div>
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
<div class="models">
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
        <span class="rd">*</span>员工姓名： <input type="text" name="identity" lay-verify="identity" placeholder="填写部门名称" autocomplete="off" class="layui-input bm_name">
        </td>
        <td>
        <span class="rd">*</span>员工电话：
          <input type="text" name="identity" lay-verify="identity" placeholder="填写部门名称" autocomplete="off" class="layui-input bm_name">
        </td>
        </tr>
        <tr>
        <td>
          <span class="rd">*</span>员工邮箱： 
          <input type="text" name="identity" lay-verify="identity" placeholder="填写部门名称" autocomplete="off" class="layui-input bm_name">
        </td>
        <td>
          <span class="rd">*</span>员工岗位： 
          <select id="first-disabled" class="selectpicker bm_ld" data-hide-disabled="true" data-live-search="true">
            <option>请选择</option>
            <optgroup label="研发">
              <option>钱多多</option>
              <option>钱多多0</option>
            </optgroup>
            <optgroup label="品牌">
              <option>钱多多1</option>
              <option>钱多多2</option>
            </optgroup>
          </select>
        </td> 
        </tr>
        <tr>
        <td>
          <span class="rd">*</span>员工部门： 
          <input type="text" name="identity" lay-verify="identity" placeholder="填写部门" autocomplete="off" class="layui-input bm_name">
        </td>
        <td>
          <span class="rd">*</span>员工上级： 
          <select id="first-disabled" class="selectpicker bm_ld" data-hide-disabled="true" data-live-search="true">
            <option>请选择</option>
            <optgroup label="研发">
              <option>钱多多 电话：15155102848</option>
              <option>钱多多0</option>
            </optgroup>
            <optgroup label="品牌">
              <option>钱多多1</option>
              <option>钱多多2</option>
            </optgroup>
          </select>
        </td> 
        </tr>
        <tr>
        <td>
          <span class="rd">*</span>员工状态： 
          <div class="rad_c">
            <input type="radio" name="bm_zt" id="qiyong" class="mcr mcr-primary mcr-circle" checked />&nbsp;&nbsp;<label for="qiyong">启用</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="bm_zt" id="tinyong" class="mcr mcr-primary mcr-circle" />&nbsp;&nbsp;<label for="tinyong">停用</label>
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

<script type="text/javascript">

  $(function(){
    $("#iy_manage .treeview a:contains('员工管理')").parent().addClass('active');
    /*员工状态*/
    $(".yg_zt").on("click",function(){
      var zt = $(this).html();
      if (zt == "停用") {
        layer.msg("已停用");
        $(this).html("启用");
      }else{
        layer.msg("已启用");
        $(this).html("停用");
      }
    });
    /*编辑部门*/
    $(".yg_bj").on("click",function(){
      /*进来隐藏按钮*/
      $(".models").fadeIn();
    })
    /*删除部门*/
    $(".yg_cz").on("click",function(){
      layer.confirm('确认重置该员工密码？', {
        btn: ['确认','取消'] //按钮
      }, function(){
        layer.msg('已重置', {icon: 1});
      }, function(){
        layer.msg('已取消！', {icon: 1});
      });
    })
    /*关闭*/
    $(".layui-layer-close1,.layui-layer-btn1").on("click",function(){
      $(this).parent().parent().parent().hide();
    })
    /*新增部门*/
    $(".add_yg").on("click",function(){
      $(".models").fadeIn();
    });
    /*保存*/
    $(".layui-layer-btn0").on("click",function(){
      var bm_name = $(".bm_name").val();
      var sj_bm = $(".sj_bm").val();
      var bm_ld = $(".bm_ld").val();
      var bm_zt=$('input:radio[name="bm_zt"]:checked').val();

      if (!bm_name) {
        layer.msg("名称不能为空",{time:1000});
        return false;
      }
      if (!sj_bm) {
        layer.msg("上级部门不能为空",{time:1000});
        return false;
      }
      if (!bm_ld) {
        layer.msg("部门领导不能为空",{time:1000});
        return false;
      }
      if (!bm_zt) {
        layer.msg("请选择状态",{time:1000});
        return false;
      }
      alert("成功");
    })
  })
</script>
<script type="text/javascript" src="/okr/js/main.js"></script></body>
<!-- Download From www.exet.tk-->
</html>
