<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>我的目标</title>

	@include('layouts._index_headerCss')

 </HEAD>
</head>
<body id="my_mb">
     <div class="layui-layout layui-layout-admin">
    <div class="layui-header">
      <div class="layui-logo" style="padding-top: 17px;"><h2 style="color: #fff;">方田员工OKR管理系统</h2></div>
      <ul class="layui-nav layui-layout-right">
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
        <li class="layui-nav-item" style="margin-right: 36px;opacity: 0;">洋河赵坤老师，您好！</li>
        <li class="layui-nav-item dows">
          <a href=""><i class="icon iconfont icon-shezhi" style="color: #fff;font-size: 30px;"></i></a>
          <dl class="layui-nav-child layui-anim layui-anim-upbit">
            <dd><a href="javascript:void(0)" class="xgmm">修改密码</a></dd>
            <dd><a href="javascript:void(0)">退出登录</a></dd>
          </dl>
        </li>
      </ul>
      </div>
    </div>
<!-- 修改密码 -->
    <div class="models mm_model">
    <div class="modes_con" style="width: 440px;left: 35%">
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
        <th colspan="2">密码修改</th>
        </tr> 
        </thead>
        <tbody>
        <tr class="text-center">
        <td style="width: 100%">
        原始密码： <input type="password" name="identity" lay-verify="identity" placeholder="填写原始密码" autocomplete="off" class="layui-input bm_name">
        </td>
        </tr>
        <tr class="text-center">
        <td style="width: 100%">
        修改密码： <input type="password" name="identity" lay-verify="identity" placeholder="填写新密码" autocomplete="off" class="layui-input new_pass"><span class="xs" style="position: absolute;right: 90px;cursor: pointer;">显示密码</span>
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

  <div id="body-wrapper">
    <!-- Wrapper for the radial gradient background -->
     <aside class="main-sidebar">
    <section  class="sidebar">
      <ul class="sidebar-menu">
        <li class="header"></li>
        <li class="treeview">
          <a href="jy_manage.html">
            <i class="fa fa-files-o"></i>
            <span>我的目标</span>
            <!-- <i class="fa fa-angle-right pull-right"></i> -->
          </a>
        </li>
        <li class="treeview">
          <a href="kj_add.html">
            <i class="fa fa-th"></i> <span>成员目标</span>
            <!-- <i class="fa fa-angle-right pull-right"></i> -->
          </a>
          <!-- <div class="side_content">
            <ul>
              <li><a href="tk_add.html"><i class="fangkuai"></i>添加题目</a></li>
            </ul>
          </div> -->
        </li>
      </ul>
    </section>
  </aside>
  <style type="text/css">
.main-sidebar{
  position: absolute;
  top:56px;
  left: 0;
  height: 100%;
  min-height: 100%;
  width: 230px;
  z-index: 810;
  background-color: #fff;
 }
</style>
  <script>
$.sidebarMenu($('.sidebar-menu'))
</script>


    <!-- End #sidebar -->
    <div id="main-content">
      <div class="h2Title">
        <a href="jy_manage.html" class="nows">我的目标</a>
      </div>
      <!-- End .clear -->
      <div class="content-box">
        <div class="layui-tab">
          <ul class="layui-tab-title">
            <li class="layui-this">我负责的</li>
            <li>我参与的</li>
          </ul>
          <div class="p_l8 jy_search" style="text-align: right;">
            <button class="layui-btn layui-btn-normal add_mb" style="width: 80px;height: 33px;">新增目标</button>
          </div>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
              <div class="time_con">
                <select class="list active">
                  <option>本周</option>
                  <option>上周</option>
                  <option>下周</option>
                </select>

                <select class="list">
                  <option>月度</option>
                  <option>全部</option>
                  <option>一月</option>
                  <option>二月</option>
                  <option>三月</option>
                  <option>四月</option>
                  <option>五月</option>
                  <option>六月</option>
                  <option>七月</option>
                  <option>八月</option>
                  <option>九月</option>
                  <option>十月</option>
                  <option>十一月</option>
                  <option>十二月</option>
                </select>

                <select class="list">
                  <option>季度</option>
                  <option>全部</option>
                  <option title="1月-3月">第一季度</option>
                  <option title="3月-6月">第二季度</option>
                  <option title="6月-9月">第三季度</option>
                  <option title="10月-12月">第四季度</option>
                </select>


                <div class="ot_time list">
                  <select>
                    <option>其他时间</option>
                  </select>
                  <input type="text" class="layui-input" id="test6" placeholder="其他时间" style="border: none;opacity: 0;" readonly>
                </div>
              </div>
              <div class="trees">
                <div class="titles">（2018年5月14日~5月18日）OKR指标</div>
                <ul id="treeDemo" class="ztree"></ul>
                {!! $objective->render() !!}
              </div>
            </div>
            <div class="layui-tab-item">
              <div class="time_con">
                <select class="list active">
                  <option>本周</option>
                  <option>上周</option>
                  <option>下周</option>
                </select>

                <select class="list">
                  <option>月度</option>
                  <option>全部</option>
                  <option>一月</option>
                  <option>二月</option>
                  <option>三月</option>
                  <option>四月</option>
                  <option>五月</option>
                  <option>六月</option>
                  <option>七月</option>
                  <option>八月</option>
                  <option>九月</option>
                  <option>十月</option>
                  <option>十一月</option>
                  <option>十二月</option>
                </select>

                <select class="list">
                  <option>季度</option>
                  <option>全部</option>
                  <option title="1月-3月">第一季度</option>
                  <option title="3月-6月">第二季度</option>
                  <option title="6月-9月">第三季度</option>
                  <option title="10月-12月">第四季度</option>
                </select>


                <div class="ot_time list">
                  <select>
                    <option>其他时间</option>
                  </select>
                  <input type="text" class="layui-input" id="my_mb_times" placeholder="其他时间" style="border: none;opacity: 0;" readonly>
                </div>
              </div>
              <div class="trees">
                <div class="titles">（2018年5月30日~6月30日）OKR指标</div>
                <!--ul id="myTreeDemo" class="ztree"></ul-->
              </div>
            </div>
          </div>
        </div>

    </div>

    <!-- End Notifications -->
    
  <div >

  </div>

    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>

<!-- 新增目标 models -->
<div class="models mb_models">
    <div class="modes_con" style="height: 800px;overflow: scroll;">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
            <div style="margin-top: 20px;">
              <h2>新增目标</h2>

              <div>
                <form>
                  <!-- 目标内容 -->
                  <div>
                    <div class="fzr">
                      <span class="ob_titles">
                        目标内容（O）
                      </span>
                    </div>
                    <div class="mb_cont">
                      <ul>
                        <li>
                          <i class="icon iconfont icon-copy1"></i>
                          <input id="o_name" name="o_name" type="text" class="layui-input" placeholder="请输入项目名字">
                        </li>
                        <li>
                          <i class="icon iconfont icon-calendar1"></i>
                          <input type="text" class="layui-input" id="res_time" placeholder="时间" readonly>
                        </li>
                        <li>
                          <i class="icon iconfont icon-adduser1"></i>
                          <select id="o_executor_id" name="o_executor_id" class="selectpicker mb_cyr" data-hide-disabled="true" data-live-search="true">
                                <option>添加负责人</option>
                                @foreach ($arr_allUserDept as $one)
                                    <optgroup label="{{ $one['name'] }}">
                                    @foreach ($one['users'] as $dptuser)
                                        <option value="{{ $dptuser['id'] }}">{{ $dptuser['name'] }}</option>
                                    @endforeach
                                @endforeach
                          </select>
                        </li>
                        <li>
                          <i class="icon iconfont icon-addusergroup1"></i>
                          <select id="o_partake_id" name="o_partake_id" class="selectpicker mb_cyr" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                          
                          		@foreach ($arr_allUserDept as $one)
                                    <optgroup label="{{ $one['name'] }}">
                                    @foreach ($one['users'] as $dptuser)
                                        <option value="{{ $dptuser['id'] }}">{{ $dptuser['name'] }}</option>
                                    @endforeach
                                @endforeach

                          </select>
                        </li>
                        <li>
                          <i class="icon iconfont icon-edit"></i>
                          <textarea id="o_description" name="o_description" placeholder="添加描述"></textarea>
                        </li>
                      </ul>
                    </div>
                  </div>

                    <div class="layui-layer-btn layui-layer-btn-">
                      <a class="layui-layer-btn0" onclick="submit_objective();">保存</a>
                      <a class="layui-layer-btn1">取消</a>
                    </div>

                </form>
              </div>
            </div>
        </div>
      </div>
      <span class="layui-layer-setwin">
        <a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a>
      </span>
      
      <span class="layui-layer-resize"></span>
  </div>
</div>
<!-- models end -->

<!-- 评论 -->
<div class="models pl_models">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
            <div style="margin-top: 20px;">
                <!-- 评论 -->
                <form>
                  <div style="padding-top: 10px;" class="mb_cont">
                    <div class="fzr">
                      <span class="ob_titles pl_models_titls">
                        评论
                      </span>
                    </div>
                    <div>
                      <input type="text" class="layui-input pl_ipt" placeholder="发表评论"><button class="layui-btn layui-btn-normal pl_btn">发表</button>
                    </div>
                    <div class="pl_cont">
                      <ul>
                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
        <span class="layui-layer-setwin">
          <a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a>
        </span>
        
        <span class="layui-layer-resize"></span>
      </div>    
  </div>
</div>
<!-- end -->


<!-- 目标model 详情 -->
<div class="models dy_mb_models" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
            <div style="margin-top: 40px;">
              <div>
                <form>
                  <!-- 目标内容 -->
                  <div>
                    <div class="fzr">
                      <span class="ob_titles cir_tile">
                        目标
                      </span>
                      <span class="ob_titles model_mb_titles" id="o_name_u">
                        每天报名人数不低于40人
                      </span>
                      <span class='wks model_mb_zt' id="o_dateStatus_u">已完成</span>
                      <!-- 评分的颜色两种 一种是正常s_color  一种逾期f_color  -->
                      &nbsp;&nbsp;&nbsp;&nbsp;<span class="s_color" id="o_score_u">0.6</span>
                      <!-- <span class="f_color">&nbsp;&nbsp;&nbsp;&nbsp;0.6</span> -->

                      <!-- 删除编辑 有权改就显示按钮 没有权限就不显示 -->
                      <span class="bj_cont">
                        <a href="javascript:void(0)" class="bj_btn models_del">删除</a>
                        <a href="javascript:void(0)" class="bj_btn models_bj">编辑</a>
                      </span>
                    </div>
                    <div class="mb_cont">
                      <!-- 给ul添加class ul_bj 显示边框 -->
                      <ul class="ul_no" id="o_edit_ul">
                        <li>
                          <i class="icon iconfont icon-adduser1"></i>
                          <span id="o_executor_id_u"></span>
                        </li>

                        <li>
                          <i class="icon iconfont icon-calendar1"></i>
                          <input type="text" class="layui-input" id="dy_res_time" placeholder="时间" readonly>
                        </li>

                        <li>
                          <i class="icon iconfont icon-addusergroup1"></i>
                          <select id="o_partake_id_u" name="o_partake_id_u" class="selectpicker mb_cyr" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                            
                            	@foreach ($arr_allUserDept as $one)
                                    <optgroup label="{{ $one['name'] }}">
                                    @foreach ($one['users'] as $dptuser)
                                        <option value="{{ $dptuser['id'] }}">{{ $dptuser['name'] }}</option>
                                    @endforeach
                                @endforeach
                            
                          </select>
                        </li>
                        <li>
                          <i class="icon iconfont icon-edit"></i>
                          <textarea id="o_description_u" name="o_description_u" placeholder="添加描述"  style="resize:none"></textarea>
                        </li>
                      </ul>
                    </div>
                    <div id="o_edit_btn" class="layui-layer-btn layui-layer-btn-" style="display: none;">
                      <a class="layui-layer-btn bc">保存</a>
                      <a class="layui-layer-btn models_qx">取消</a>
                    </div>
                  </div>
                </form>
                <!-- 评论 -->
                <form>
                  <div style="border-top: 1px solid #ddd;padding-top: 10px;" class="mb_cont">
                    <div class="fzr">
                      <span class="ob_titles">
                        评论
                      </span>
                    </div>
                    <div>
                      <input type="text" class="layui-input pl_ipt" placeholder="发表评论"><button class="layui-btn layui-btn-normal pl_btn">发表</button>
                    </div>
                    <div class="pl_cont">
                      <ul>
                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
      <span class="layui-layer-setwin">
        <a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a>
      </span>
      
      <span class="layui-layer-resize"></span>
  </div>
</div>

<!-- 计划model 详情 -->
<div class="models jh_mb_models" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
            <div style="margin-top: 40px;">
              <div>
                <form>
                  <!-- 目标内容 -->
                  <div>
                    <div class="fzr">
                      <span class="ob_titles cir_tile">
                        计划
                      </span>
                      <span class="ob_titles model_mb_titles">
                        每天报名人数不低于40人
                      </span>
                      <span class='ywc model_mb_zt'>已完成</span>
                      <!-- 评分的颜色两种 一种是正常s_color  一种逾期f_color  -->
                      <span class="s_color">&nbsp;&nbsp;&nbsp;&nbsp;0.6</span>
                      <!-- <span class="f_color">&nbsp;&nbsp;&nbsp;&nbsp;0.6</span> -->

                      <!-- 删除编辑 有权改就显示按钮 没有权限就不显示 -->
                      <span class="bj_cont">
                        <a href="javascript:void(0)" class="bj_btn models_del">删除</a>
                        <a href="javascript:void(0)" class="bj_btn models_bj">编辑</a>
                      </span>
                    </div>
                    <div class="mb_cont">
                      <!-- 给ul添加class ul_bj 显示边框 -->
                      <ul class="ul_no">
                        <li>
                          <i class="icon iconfont icon-adduser1"></i>
                          <select class="selectpicker mb_cyr" data-hide-disabled="true" data-live-search="true">
                                <option>添加负责人</option>
                                <option>Apple</option>
                                <option>Orange</option>
                                <option>Corn</option>
                                <option>Carrot</option>
                          </select>
                        </li>

                        <li>
                          <i class="icon iconfont icon-calendar1"></i>
                          <input type="text" class="layui-input" id="dy_jh_time" placeholder="时间" readonly>
                        </li>

                        <li>
                          <i class="icon iconfont icon-addusergroup1"></i>
                          <select class="selectpicker mb_cyr" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                            <optgroup label="filter1">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                            <optgroup label="filter2">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                            <optgroup label="filter3">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                          </select>
                        </li>
                        <li>
                          <i class="icon iconfont icon-edit"></i>
                          <textarea placeholder="添加描述"  style="resize:none"></textarea>
                        </li>
                      </ul>
                    </div>
                    <div class="layui-layer-btn layui-layer-btn-" style="display: none;">
                      <a class="layui-layer-btn bc">保存</a>
                      <a class="layui-layer-btn models_qx">取消</a>
                    </div>
                  </div>
                </form>
                <!-- 评论 -->
                <form>
                  <div style="border-top: 1px solid #ddd;padding-top: 10px;" class="mb_cont">
                    <div class="fzr">
                      <span class="ob_titles">
                        评论
                      </span>
                    </div>
                    <div>
                      <input type="text" class="layui-input pl_ipt" placeholder="发表评论"><button class="layui-btn layui-btn-normal pl_btn">发表</button>
                    </div>
                    <div class="pl_cont">
                      <ul>
                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
      <span class="layui-layer-setwin">
        <a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a>
      </span>
      
      <span class="layui-layer-resize"></span>
  </div>
</div>

<!-- 结果model 详情 -->
<div class="models key_mb_models" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
            <div style="margin-top: 40px;">
              <div>
                <form>
                  <!-- 目标内容 -->
                  <div>
                    <div class="fzr">
                      <span class="ob_titles cir_tile">
                        结果
                      </span>
                      <span class="ob_titles model_mb_titles">
                        每天报名人数不低于40人
                      </span>
                      <span class='ywc model_mb_zt'>已完成</span>
                      <!-- 评分的颜色两种 一种是正常s_color  一种逾期f_color  -->
                      <span class="s_color">&nbsp;&nbsp;&nbsp;&nbsp;0.6</span>
                      <!-- <span class="f_color">&nbsp;&nbsp;&nbsp;&nbsp;0.6</span> -->

                      <!-- 删除编辑 有权改就显示按钮 没有权限就不显示 -->
                      <span class="bj_cont">
                        <a href="javascript:void(0)" class="bj_btn models_del">删除</a>
                        <a href="javascript:void(0)" class="bj_btn models_bj">编辑</a>
                      </span>
                    </div>
                    <div class="mb_cont">
                      <!-- 给ul添加class ul_bj 显示边框 -->
                      <ul class="ul_no">
                        <li>
                          <i class="icon iconfont icon-adduser1"></i>
                          <select class="selectpicker mb_cyr" data-hide-disabled="true" data-live-search="true">
                                <option>添加负责人</option>
                                <option>Apple</option>
                                <option>Orange</option>
                                <option>Corn</option>
                                <option>Carrot</option>
                          </select>
                        </li>

                        <li>
                          <i class="icon iconfont icon-calendar1"></i>
                          <input type="text" class="layui-input" id="dy_key_time" placeholder="时间" readonly>
                        </li>

                        <li>
                          <i class="icon iconfont icon-addusergroup1"></i>
                          <select class="selectpicker mb_cyr" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                            <optgroup label="filter1">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                            <optgroup label="filter2">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                            <optgroup label="filter3">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                          </select>
                        </li>
                        <li>
                          <i class="icon iconfont icon-edit"></i>
                          <textarea placeholder="添加描述"  style="resize:none"></textarea>
                        </li>
                      </ul>
                    </div>
                    <div class="layui-layer-btn layui-layer-btn-" style="display: none;">
                      <a class="layui-layer-btn bc">保存</a>
                      <a class="layui-layer-btn models_qx">取消</a>
                    </div>
                  </div>
                </form>
                <!-- 评论 -->
                <form>
                  <div style="border-top: 1px solid #ddd;padding-top: 10px;" class="mb_cont">
                    <div class="fzr">
                      <span class="ob_titles">
                        评论
                      </span>
                    </div>
                    <div>
                      <input type="text" class="layui-input pl_ipt" placeholder="发表评论"><button class="layui-btn layui-btn-normal pl_btn">发表</button>
                    </div>
                    <div class="pl_cont">
                      <ul>
                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>

                        <li class="pl_list">
                          <div>
                            <div class="left">
                              <div class="tx_img">
                                王
                              </div>
                            </div>
                            <div class="left left_cont">
                              <div class="top">
                                  刘凯<span class="pl_time">&nbsp;&nbsp;2018-5-25&nbsp;12:25:25</span>
                              </div>
                              <div class="bottom">
                                该处产品有问题！
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
      <span class="layui-layer-setwin">
        <a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a>
      </span>
      
      <span class="layui-layer-resize"></span>
  </div>
</div>


<!-- 新增关键结果 -->
<div class="models add_jh_models">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
            <div style="margin-top: 20px;">
              <div>
                <form>
                  <!-- 目标内容 -->
                  <!-- 关键结果 -->
                  <div>
                    <div class="fzr">
                      <span class="ob_titles">
                        关键结果（K）
                      </span>
                    </div>
                    <div class="mb_cont">
                      <ul>
                        <li>
                          <i class="icon iconfont icon-copy1"></i>
                          <input type="text" class="layui-input" placeholder="输入关键结果名称">
                        </li>
                        <li>
                          <i class="icon iconfont icon-calendar1"></i>
                          <input type="text" class="layui-input" id="add_key_time" placeholder="时间" readonly>
                        </li>
                        <li>
                          <i class="icon iconfont icon-adduser1"></i>
                          <select class="selectpicker mb_cyr" data-hide-disabled="true" data-live-search="true">
                                <option>添加负责人</option>
                                <option>Apple</option>
                                <option>Orange</option>
                                <option>Corn</option>
                                <option>Carrot</option>
                          </select>
                        </li>
                        <li>
                          <i class="icon iconfont icon-addusergroup1"></i>
                          <select class="selectpicker mb_cyr" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                            <optgroup label="filter1">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                            <optgroup label="filter2">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                            <optgroup label="filter3">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                          </select>
                        </li>
                        <li>
                          <i class="icon iconfont icon-edit"></i>
                          <textarea placeholder="添加描述"></textarea>
                        </li>
                      </ul>
                    </div>
                    <div class="text-right mb_cont">
                      <button class="layui-btn layui-btn-normal add_bm">添加</button>
                    </div>

                    <div class="mb_cont">
                      <table class="layui-table jy_table_layer">
                        <tr>
                          <td class="c_209">短信购买费用咨询</td>
                          <td>2018/12/20 12:00~2018/12/29 18:00</td>
                          <td>刘贝丨 <span class="pointer" title="钱多,很多人">钱多多…</span></td>
                          <td class="dels pointer">删除</td>
                        </tr>
                      </table>
                    </div>
                    <div class="layui-layer-btn layui-layer-btn-">
                      <a class="layui-layer-btn0">保存</a>
                      <a class="layui-layer-btn1">取消</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
      <span class="layui-layer-setwin">
        <a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a>
      </span>
      <span class="layui-layer-resize"></span>
  </div>
</div>
<!-- 添加计划 -->

<div class="models add_jg_models">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
            <div style="margin-top: 20px;">
              <div>
                <form>
                  <!-- 目标内容 -->
                  <!-- 关键结果 -->
                  <div>
                    <div class="fzr">
                      <span class="ob_titles">
                        添加计划
                      </span>
                    </div>
                    <div class="mb_cont">
                      <ul>
                        <li>
                          <i class="icon iconfont icon-copy1"></i>
                          <input type="text" class="layui-input" placeholder="输入关键结果名称">
                        </li>
                        <li>
                          <i class="icon iconfont icon-calendar1"></i>
                          <input type="text" class="layui-input" id="add_jh_time" placeholder="时间" readonly>
                        </li>
                        <li>
                          <i class="icon iconfont icon-adduser1"></i>
                          <select class="selectpicker mb_cyr" data-hide-disabled="true" data-live-search="true">
                                <option>添加负责人</option>
                                <option>Apple</option>
                                <option>Orange</option>
                                <option>Corn</option>
                                <option>Carrot</option>
                          </select>
                        </li>
                        <li>
                          <i class="icon iconfont icon-addusergroup1"></i>
                          <select class="selectpicker mb_cyr" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
                            <optgroup label="filter1">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                            <optgroup label="filter2">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                            <optgroup label="filter3">
                              <option>option1</option>
                              <option>option2</option>
                              <option>option3</option>
                              <option>option4</option>
                            </optgroup>
                          </select>
                        </li>
                        <li>
                          <i class="icon iconfont icon-edit"></i>
                          <textarea placeholder="添加描述"></textarea>
                        </li>
                      </ul>
                    </div>
                    <div class="text-right mb_cont">
                      <button class="layui-btn layui-btn-normal add_bm">添加</button>
                    </div>

                    <div class="mb_cont">
                      <table class="layui-table jy_table_layer">
                        <tr>
                          <td class="c_209">短信购买费用咨询</td>
                          <td>2018/12/20 12:00~2018/12/29 18:00</td>
                          <td>刘贝丨 <span class="pointer" title="钱多,很多人">钱多多…</span></td>
                          <td class="dels pointer">删除</td>
                        </tr>
                      </table>
                    </div>
                    <div class="layui-layer-btn layui-layer-btn-">
                      <a class="layui-layer-btn0">保存</a>
                      <a class="layui-layer-btn1">取消</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
      <span class="layui-layer-setwin">
        <a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a>
      </span>
      <span class="layui-layer-resize"></span>
  </div>
</div>

<script type="text/javascript">
  /*zthree*/
  var IDMark_Switch = "_switch",
    IDMark_Icon = "_ico",
    IDMark_Span = "_span",
    IDMark_Input = "_input",
    IDMark_Check = "_check",
    IDMark_Edit = "_edit",
    IDMark_Remove = "_remove",
    IDMark_Ul = "_ul",
    IDMark_A = "_a";
    
    var setting = {
      view: {
        addDiyDom: aaaa,
        showIcon: false,
        fontCss: getFont
      }
    };
    
	
	
	
	
	var zNodes = {!! $json_objective !!};

    function getFont(treeId, node) {
      return node.font ? node.font : {};
    }


	function aaaa(treeId, treeNode) {
		//if (treeNode.parentNode && treeNode.parentNode.id!=2) return;
		var aObj = $("#" + treeNode.tId + IDMark_A);
		
		dateStatusStr="";
		switch(treeNode.dateStatus)
		{
			case 1:
			  dateStatusStr="<span class='demoIcon'><span class='wks'>未开始</span></span>";
			  break;
			case 2:
			  dateStatusStr="<span class='demoIcon'><span class='jxz'>进行中</span></span>";
			  break;
			case 3:
			  dateStatusStr="<span class='demoIcon'><span class='ywc'>已完成</span></span>";
			  break;
			case 4:
			  dateStatusStr="<span class='demoIcon'><span class='yyq'>已逾期</span></span>";
			  break;
			default:
		}
		
		console.log(treeNode.id+" "+treeNode.dateStatus+" "+treeNode.score);
		scoreStatusStr="";
		//进行中的或已逾期未评分的可以评分
		if(treeNode.dateStatus==2 || (treeNode.dateStatus==4 && treeNode.score==999)){
			scoreStatusStr = "<span class='demoIcon'><span class='jxz pf' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='score(this);'>评分</span></span>";
		}else{
			//有分数线是分数
			if(treeNode.score!=999){
				scoreStatusStr = "<span class='demoIcon'><span>"+treeNode.score+"</span></span>";
			}
		}
		
		
		nextlevelStatusStr="";
		detailStatusStr="";
		switch(treeNode.flag)
		{
			case "objective":
			  nextlevelStatusStr="<span class='demoIcon'><span title='添加KR' class='icon iconfont icon-jiahao tj_jh'></span></span>";
			  detailStatusStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-chaxun' title='详情' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='detail(this);'></span></span>";
			  break;
			case "keyresult":
			  nextlevelStatusStr="<span class='demoIcon'><span title='添加计划' class='icon iconfont icon-jiahao tj_jg'></span></span>";
			  detailStatusStr = "<span class='demoIcon'><span class='jgxq icon iconfont icon-chaxun' title='详情' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='detail(this);'></span></span>";
			  break;
			case "plan":
			  nextlevelStatusStr="";
			  detailStatusStr = "<span class='demoIcon'><span class='jhxq icon iconfont icon-chaxun' title='详情' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='detail(this);'></span></span>";
			  break;
		}
		
		aObj.after(dateStatusStr + scoreStatusStr + nextlevelStatusStr + detailStatusStr);

	}
	
	// 评分
	function score(btn){
		console.log($(btn).attr("flag")+" "+$(btn).attr("itemid"));
		layer.prompt({title: '请给该项目的完成情况打分（0-1）'}, function(score, index){
			if(isNaN(score) || (parseFloat(score)>1 || parseFloat(score)<0)){
				layer.msg("请输入0-1之间的数字");
				return false;
			}
			
			flag = $(btn).attr("flag");
			itemid = $(btn).attr("itemid");
			switch(flag)
			{
				case "objective":
				  submit_url =  "{{ route('objective.score') }}";
				  break;
				case "keyresult":
				  submit_url =  "{{ route('keyresult.score') }}";
				  break;
				case "plan":
				  submit_url =  "{{ route('plan.score') }}";
				  break;
			}
			console.log(submit_url);

			$.ajax({
				type: "POST",
				url: submit_url,
				data: { id:itemid ,score : score},
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
		});
	}

  $(function(){
    $.fn.zTree.init($("#treeDemo"), setting, zNodes);
   
    $("#my_mb .treeview a:contains('我的目标')").parent().addClass('active');
    
	
	/*新增目标*/
    $(".add_mb").on("click",function(){
		
		ajax_type = 'POST';
  	  	submit_url = "{{ route('objective.store') }}";
		
      $(".mb_models").fadeIn();
    })
	
	
	/*评分*/
	/*
	$("#treeDemo").on("click",".pf", function(){
		layer.prompt({title: '请给该项目的完成情况打分（0-1）'}, function(pass, index){
			$.ajax({
				type: "PATCH",
				url: submit_url,
				data: { score : name},
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
		});
	});
	*/
	
    /*切换不同的日器选择*/
    $(".time_con .list").on("click",function(){
      $(this).addClass("active").siblings(".active").removeClass("active");
    })
     //日期确定
     $(".laydate-btns-confirm").on("click",function(){

     })
  })
  
  
//目标新增
function submit_objective(){
	// alert("submit_user");
	var o_name = $("#o_name").val();
	var o_date = $("#res_time").val();
	var o_executor_id = $("#o_executor_id").val();
	var o_partake_id = $("#o_partake_id").val();
	var o_description = $("#o_description").val();
	
	console.log(o_date);
	console.log(o_executor_id);
	console.log(o_partake_id);

	if (!o_name) {
		layer.msg("名字不能为空",{time:1000});
		return false;
	}
	if (!o_date) {
		layer.msg("时间不能为空",{time:1000});
		return false;
	}
	if (!o_executor_id) {
		layer.msg("负责人不能为空",{time:1000});
		return false;
	}
	if (!o_partake_id) {
		layer.msg("参与者不能为空",{time:1000});
		return false;
	}

	$.ajax({
		type: ajax_type,
		url: submit_url,
		//data: { name : name, pid : pid, status : status,'_token': "{{csrf_token()}}"},
		data: { o_name : o_name, o_date : o_date, o_executor_id : o_executor_id, o_partake_id : o_partake_id, o_description : o_description},
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

// 详情
function detail(btn){
	flag = $(btn).attr("flag");
	itemid = $(btn).attr("itemid");
	switch(flag)
	{
		case "objective":
		  geturl =  "{{ route('objective.detail') }}";
		  break;
		case "keyresult":
		  geturl =  "{{ route('keyresult.detail') }}";
		  break;
		case "plan":
		  geturl =  "{{ route('plan.detail') }}";
		  break;
	}
	console.log(geturl);
	
	$.ajax({
		type: 'GET',
		url: geturl,
		data: { id : itemid},
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': '{{csrf_token()}}'
		},

		success: function(data){
			console.log(data);
			
			//名称
			$("#o_name_u").html(data.name);
			//时间
			$("#dy_res_time").val(data.startdate+" - "+data.enddate);
			//描述
			$("#o_description_u").val(data.description);
			//负责人
			$("#o_executor_id_u").html(data.executor['name']);
			//参与者
			//$("#o_partake_id_u").val([3,6]);
			$("#o_partake_id_u").val(data.newpartake);
			$('#o_partake_id_u').selectpicker('refresh');
			//状态
			switch(data.dateStatus)
			{
				case 1:
				  //dateStatusStr="<span class='demoIcon'><span class='wks'>未开始</span></span>";
				  $("#o_dateStatus_u").html("未开始");
				  $("#o_dateStatus_u").attr("class","wks model_mb_zt");
				  break;
				case 2:
				  //dateStatusStr="<span class='demoIcon'><span class='jxz'>进行中</span></span>";
				  $("#o_dateStatus_u").html("进行中");
				  $("#o_dateStatus_u").attr("class","jxz model_mb_zt");
				  break;
				case 3:
				  //dateStatusStr="<span class='demoIcon'><span class='ywc'>已完成</span></span>";
				  $("#o_dateStatus_u").html("已完成");
				  $("#o_dateStatus_u").attr("class","ywc model_mb_zt");
				  break;
				case 4:
				  //dateStatusStr="<span class='demoIcon'><span class='yyq'>已逾期</span></span>";
				  $("#o_dateStatus_u").html("已逾期");
				  $("#o_dateStatus_u").attr("class","yyq model_mb_zt");
				  break;
				default:
			}
			//分数
			
			if(data.score!=999){
				$("#o_score_u").html(data.score);
			}
			
			ajax_type = 'PATCH';
			//submit_url = updateurl;
			
			// 目标编辑层初始化
			$("#o_edit_btn").hide();
			$("#o_edit_ul").addClass("ul_no");
			
			$(".dy_mb_models").show();
				
		},
	});

}
  
</script>
<script type="text/javascript" src="/okr/js/main.js"></script></body>
<!-- Download From www.exet.tk-->
</html>
