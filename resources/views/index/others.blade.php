<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>成员目标</title>
  <!--                       CSS                       -->
  
  @include('layouts._index_headerCss')

 </HEAD>
</head>
<body id="cy_mb">
     <div class="layui-layout layui-layout-admin">
    <div class="layui-header">
      <div class="layui-logo" style="padding-top: 17px;"><h2 style="color: #fff;">方田员工OKR管理系统</h2></div>
      <ul class="layui-nav layui-layout-left">
        <li class="layui-nav-item" style="cursor: pointer;margin-left: 50px;">
          <i class="fa fa-bars ycl_nav"></i>
        </li>
      </ul>
      <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item" style="margin-right: 36px;cursor: pointer;" onClick="logout();">退出</li>
      </ul>
      </div>
    </div>
  
  <!-- 修改密码 -->
  @include('layouts._index_changePwd')

  </div>
</div>

  <div id="body-wrapper">
    <!-- Wrapper for the radial gradient background -->
     <aside class="main-sidebar">
    <section  class="sidebar">
      <ul class="sidebar-menu">
        <li class="header"></li>
        <li class="treeview">
          <a href="{{ route('objective.mine') }}">
            <i class="icon iconfont icon-jiaoseguanli"></i>
            <span>我的目标</span>
            <!-- <i class="fa fa-angle-right pull-right"></i> -->
          </a>
        </li>
        <li class="treeview">
          <a href="{{ route('objective.others') }}">
            <i class="icon iconfont icon-zizhanghaoguanli"></i> <span>成员目标</span>
            <!-- <i class="fa fa-angle-right pull-right"></i> -->
          </a>
          <!-- <div class="side_content">
            <ul>
              <li><a href="tk_add.html"><i class="fangkuai"></i>添加题目</a></li>
            </ul>
          </div> -->
        </li>
      </ul>
      <div class="yg_sec">
            <form>
              <input type="text" id="keyword" name="keyword" lay-verify="identity" placeholder="员工手机、姓名" autocomplete="off" class="layui-input" value="{{ $keyword }}">
              <img src="/okr/resources/images/icons/search.png" class="jy_btn" onclick="keywordSearch();">
            </form>
      </div>
      <div class="trees">
        <ul id="ygNameTree" class="ztree"></ul>
      </div>
    </section>
  </aside>
  <style type="text/css">

</style>

<script>
      /*公司职位*/
  var ygsetting = {
      view: {
        addDiyDom: addDiyDoms,
        showLine: false,
      },
    };
  
  var ygnames = {!! $json_allUserDept !!};

  function addDiyDoms(treeId, treeNode) {
      // if (treeNode.parentNode && treeNode.parentNode.id!=2) return;
      var aObj = $("#" + treeNode.tId + IDMark_A);
      var job = (typeof(treeNode.position_name) == "undefined") ? ("") : (treeNode.position_name);
      var editStr = "<span class='demoIcon'><span class='wks'>"+job+"</span></span>";
      aObj.after(editStr);
  }

  $(document).ready(function(){
      /*员工名称*/
      // $.fn.zTree.init($("#ygNameTree"), ygsetting, ygnames);

      // 给刚点击的人加样式
      function setFontCss(treeId, treeNode) {
        return treeNode.userid == othersId ? {color:"#209ee4"} : {};
      };
      var setting = {
        view: {
          addDiyDom: addDiyDoms,
          fontCss: setFontCss,
          showLine: false,
        }
      };
      $.fn.zTree.init($("#ygNameTree"), setting, ygnames);

      // 打开当前员工的部门
      othersId = "{{ $arr_others['id'] }}";
      for (var i=0;i<ygnames.length;i++) {
        for (var r=0;r<ygnames[i].children.length;r++) {
          if (othersId == ygnames[i].children[r].id) {
            ygnames[i].open="true";
            // ygnames[i].children[r].view.fontCss = {color:"red"};
            $.fn.zTree.init($("#ygNameTree"), setting, ygnames);
          } 
        }
      }


  });
  $.sidebarMenu($('.sidebar-menu'))
</script>


    <!-- End #sidebar -->
    <div id="main-content">
      <div class="h2Title">
        成员目标
      </div>
      <!-- End .clear -->
      <div class="content-box">
        <div class="layui-row layui-col-space5">
          <div class="layui-col-xs6 lp">
            <div class="time_con">
              <select id="my_monthperiod" class="list" onchange="selectMyPeriod('month',this.value);">
                <option value="100">月度</option>
                <option value="01">一月</option>
                <option value="02">二月</option>
                <option value="03">三月</option>
                <option value="04">四月</option>
                <option value="05">五月</option>
                <option value="06">六月</option>
                <option value="07">七月</option>
                <option value="08">八月</option>
                <option value="09">九月</option>
                <option value="10">十月</option>
                <option value="11">十一月</option>
                <option value="12">十二月</option>
              </select>

              <select id="my_seasonperiod" class="list" onchange="selectMyPeriod('season',this.value);">
                <option value="1000">季度</option>
                <option value="1" title="1月-3月">第一季度</option>
                <option value="2" title="3月-6月">第二季度</option>
                <option value="3" title="6月-9月">第三季度</option>
                <option value="4" title="10月-12月">第四季度</option>
              </select>

              <select id="my_yearperiod" class="list" onchange="selectMyPeriod('year',this.value);">
                <option value="10000">年度</option>
                <option value="2018">2018</option>
              </select>
            </div>
            <div class="okr_mb">
              我的OKR（<span id="my_period_show"></span>）
            </div>
          </div>
          <div class="layui-col-xs6 rp">
            <div class="time_con">

              <select id="others_monthperiod" class="list" onchange="selectOthersPeriod('month',this.value);">
                <option value="100">月度</option>
                <option value="01">一月</option>
                <option value="02">二月</option>
                <option value="03">三月</option>
                <option value="04">四月</option>
                <option value="05">五月</option>
                <option value="06">六月</option>
                <option value="07">七月</option>
                <option value="08">八月</option>
                <option value="09">九月</option>
                <option value="10">十月</option>
                <option value="11">十一月</option>
                <option value="12">十二月</option>
              </select>

              <select id="others_seasonperiod" class="list" onchange="selectOthersPeriod('season',this.value);">
                <option value="1000">季度</option>
                <option value="1" title="1月-3月">第一季度</option>
                <option value="2" title="3月-6月">第二季度</option>
                <option value="3" title="6月-9月">第三季度</option>
                <option value="4" title="10月-12月">第四季度</option>
              </select>

              <select id="others_yearperiod" class="list" onchange="selectOthersPeriod('year',this.value);">
                <option value="10000">年度</option>
                <option value="2018">2018</option>
              </select>

              </div>
              <div class="okr_mb">
                {{ $arr_others['name'] }}的OKR（<span id="others_period_show"></span>）
              </div>
              <div class="my_job">
                <div class="text-center c_333">{{ $arr_others['name'] }} <br> <span class="c_999">{{ $arr_others['position_name'] }}</span></div>
              </div>
          </div>
        </div>
        <div class="layui-row layui-col-space5">
          <div class="layui-col-xs6 lp">
            <div class="layui-row layui-col-space5">
              <div class="layui-col-xs6">
                <div>
                  <div class="titles">
                    本<span id="my_span_misson_duration">周</span>关注的任务（P1必须做，P2应该做）
                  </div>
                  <div class="contains">
                    <ul>

                      @foreach ($my_all['arr_mission'] as $mission)
                        <li>P{{ $mission['importance'] }}：{{ $mission['description'] }}
                          <div class="this_cz">
                            <span class="mbxq icon iconfont icon-pinglun" title="评论" flag="mission" itemid="{{ $mission['id'] }}" onclick="pop_comment_div(this,'{{ $mission['description'] }}')"></span>
                          </div>
                        </li>
                      @endforeach

                    </ul>
                  </div>
                </div>
              </div>
              <div class="layui-col-xs6">
                <div>
                  <div class="titles">
                    目标
                  </div>
                  <div class="contains">
                    <ul id="my_tree" class="ztree">
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="layui-col-xs6 rp">
            <div class="layui-row layui-col-space5">
              <div class="layui-col-xs6">
                <div>
                  <div class="titles">
                    本<span id="others_span_misson_duration">周</span>关注的任务（P1必须做，P2应该做）
                  </div>
                  <div class="contains">
                    <ul>

                      @foreach ($others_all['arr_mission'] as $mission)
                        <li>P{{ $mission['importance']  }}：{{ $mission['description']  }}
                          <div class="this_cz">
                            <span class="mbxq icon iconfont icon-pinglun" title="评论" flag="mission" itemid="{{ $mission['id'] }}" onclick="pop_comment_div(this,'{{ $mission['description'] }}')"></span>
                          </div>
                        </li>
                      @endforeach

                    </ul>
                  </div>
                </div>
              </div>
              <div class="layui-col-xs6">
                <div>
                  <div class="titles">
                    目标
                  </div>
                  <div class="contains">
                    <ul id="others_tree" class="ztree">
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="layui-row layui-col-space5">
          <div class="layui-col-xs6 lp">
            <div class="layui-row layui-col-space5">
              <div class="layui-col-xs6">
                <div>
                  <div class="titles">
                    未来四<span id="my_span_plan_duration">周</span>计划
                  </div>
                  <div class="contains">
                    <ul>

                      @foreach ($my_all['arr_plan'] as $plan)
                        <li>
                          {{ $plan['description']  }}
                          <div class="this_cz">
                            <span class="mbxq icon iconfont icon-pinglun" title="评论" flag="mission" itemid="{{ $plan['id'] }}" onclick="pop_comment_div(this,'{{ $plan['description'] }}')"></span>
                          </div>
                        </li>
                      @endforeach                      
                      
                    </ul>
                  </div>
                </div>
              </div>
              <div class="layui-col-xs6">
                <div>
                  <div class="titles">
                    状态指标
                  </div>
                  <div class="contains">
                    <div class="text-right">
                      <span class="layui-badge-dot layui-bg-green"></span>优秀
                      <span class="layui-badge-dot layui-bg-cyan"></span>良好
                      <span class="layui-badge-dot layui-bg-blue"></span>一般
                      <span class="layui-badge-dot layui-bg-gray"></span>差
                    </div>
                    <ul>

                      @foreach ($my_all['arr_stateindex'] as $stateindex)
                      <li>

                        @switch($stateindex['state'])
                            @case(1)
                                <span class="layui-badge-dot layui-bg-green"></span>
                                @break

                            @case(2)
                               <span class="layui-badge-dot layui-bg-cyan"></span>
                                @break

                            @case(3)
                                <span class="layui-badge-dot layui-bg-blue"></span>
                                @break

                            @case(4)
                                <span class="layui-badge-dot layui-bg-gray"></span>
                                @break

                        @endswitch

                        {{ $stateindex['description']  }}
                        <!--div class="this_cz">
                          <span class="mbxq icon iconfont icon-pinglun" title="评论" flag="mission" itemid="{{ $stateindex['id'] }}" onclick="pop_comment_div(this,'{{ $stateindex['description'] }}')"></span>
                        </div-->
                      </li>
                      @endforeach
                     
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="layui-col-xs6 rp">
            <div class="layui-row layui-col-space5">
              <div class="layui-col-xs6">
                <div>
                  <div class="titles">
                    未来四<span id="others_span_plan_duration">周</span>计划
                  </div>
                  <div class="contains">
                    <ul>
                      
                      @foreach ($others_all['arr_plan'] as $plan)
                        <li>
                          {{ $plan['description']  }}
                          <div class="this_cz">
                            <span class="mbxq icon iconfont icon-pinglun" title="评论" flag="mission" itemid="{{ $plan['id'] }}" onclick="pop_comment_div(this,'{{ $plan['description'] }}')"></span>
                          </div>
                        </li>
                      @endforeach

                    </ul>
                  </div>
                </div>
              </div>
              <div class="layui-col-xs6">
                <div>
                  <div class="titles">
                    状态指标
                  </div>
                  <div class="contains">
                    <div class="text-right">
                      <span class="layui-badge-dot layui-bg-green"></span>优秀
                      <span class="layui-badge-dot layui-bg-cyan"></span>良好
                      <span class="layui-badge-dot layui-bg-blue"></span>一般
                      <span class="layui-badge-dot layui-bg-gray"></span>差
                    </div>
                    <ul>
                      
                      @foreach ($others_all['arr_stateindex'] as $stateindex)
                      <li>

                        @switch($stateindex['state'])
                            @case(1)
                                <span class="layui-badge-dot layui-bg-green"></span>
                                @break

                            @case(2)
                               <span class="layui-badge-dot layui-bg-cyan"></span>
                                @break

                            @case(3)
                                <span class="layui-badge-dot layui-bg-blue"></span>
                                @break

                            @case(4)
                                <span class="layui-badge-dot layui-bg-gray"></span>
                                @break

                        @endswitch

                        {{ $stateindex['description']  }}
                        <!--div class="this_cz">
                          <span class="mbxq icon iconfont icon-pinglun" title="评论" flag="mission" itemid="{{ $stateindex['id'] }}" onclick="pop_comment_div(this,'{{ $stateindex['description'] }}')"></span>
                        </div-->
                      </li>
                      @endforeach

                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
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

<!-- 信心指数 -->
<div class="models com_models tj_xxzs" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              信心指数
            </div>
            <div class="layui-form-item" id="confidentindexLog">
               
            </div>
          </form>

        </div>
      </div>
      <span class="layui-layer-setwin">
        <a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a>
      </span>
      
      <span class="layui-layer-resize"></span>
  </div>
</div>
<!-- end -->

<!-- 评论 -->
<div class="models pl_models" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
            <div style="margin-top: 20px;">
                <!-- 评论 -->
                <!-- <form> -->
                  <div style="padding-top: 10px;" class="mb_cont">
                    <div class="fzr">
                      <span class="ob_titles pl_models_titls" id="description_for_pl">
                        KR 1:每天报名人数不低于40人
                      </span>
                    </div>
                    <div>
                      <input type="text" id="comment_input" class="layui-input pl_ipt" placeholder="发表评论"><button class="layui-btn layui-btn-normal pl_btn" onclick="new_comment();">发表</button>
                    </div>
                    <div class="pl_cont" id="comment_showArea">
                    </div>
                <!-- </form> -->
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
<!-- end -->

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
        addDiyDom: addDiyDom,
        showIcon: false,
        fontCss: getFont,
        showLine: false,
      }
    };
    // var settings = {
    //   view: {
    //     addDiyDom: addDiyDoms,
    //     showIcon: false,
    //     fontCss: getFont
    //   }
    // };
    /* */
   
    var my_zNodes = {!! $my_all['json_objective'] !!};
    var others_zNodes = {!! $others_all['json_objective'] !!};
    
    function getFont(treeId, node) {
      return node.font ? node.font : {};
    }

    function addDiyDom(treeId, treeNode) {
      if (treeNode.parentNode && treeNode.parentNode.id!=2) return;
      var aObj = $("#" + treeNode.tId + IDMark_A);

      if (treeNode.flag == "objective") {

        if(treeNode.score==999){
          
        }else{
          dafen = "<span class='df_bj'>"+treeNode.score+"</span>";
          aObj.before(dafen);
        }
        // commentStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-pinglun pl' title='评论' onclick='pop_comment_div("+treeNode.id+");'></span></span>";
        commentStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-pinglun pl' title='评论' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick=pop_comment_div(this,'"+treeNode.description+"');></span></span>";
        aObj.after(commentStr);
      }

      if (treeNode.flag == "keyresult") {
        
        if(treeNode.score==999){
          
        }else{
          dafen = "<span class='df_bj'>"+treeNode.score+"</span>";
          aObj.before(dafen);
        }

        
        confidentindexStr = "<span class='demoIcon'><span class='xxzs' flag="+treeNode.flag+" itemid="+treeNode.id+" confidentindex='"+treeNode.confidentindex+"' onclick='pop_confidentindex_div(this);'>（"+treeNode.confidentindex+"）</span></span>";
             
        // commentStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-pinglun pl' title='评论'></span></span>";
        commentStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-pinglun pl' title='评论' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick=pop_comment_div(this,'"+treeNode.description+"');></span></span>";
        aObj.after(confidentindexStr + commentStr);
      }
    }

    $(function(){
      $.fn.zTree.init($("#my_tree"), setting, my_zNodes);
      $.fn.zTree.init($("#others_tree"), setting, others_zNodes);

      $("#cy_mb .treeview a:contains('成员目标')").parent().addClass('active');
    })


    my_perioditem = "{{ $my_perioditem }}";
    my_period = "{{ $my_period }}";
    others_perioditem = "{{ $others_perioditem }}";
    others_period = "{{ $others_period }}";
    othersId = "{{ $arr_others['id'] }}";


    // 初始化日期选择
    function initPerild(){

        $("#my_monthperiod").removeClass("active");
        $("#my_monthperiod").val(100);
        $("#my_seasonperiod").removeClass("active");
        $("#my_seasonperiod").val(1000);
        $("#my_yearperiod").removeClass("active");
        $("#my_yearperiod").val(10000);

        // $("#"+my_perioditem+"period").addClass("active");

        if (my_perioditem=="month"){
          $("#my_monthperiod").addClass("active");
          $("#my_monthperiod").val(my_period);
          $("#my_period_show").html($("#my_monthperiod").find("option:selected").text());
          $("#my_span_misson_duration").html("周");
          $("#my_span_plan_duration").html("周");   
        }
        if (my_perioditem=="season"){
          $("#my_seasonperiod").addClass("active");
          $("#my_seasonperiod").val(my_period);
          $("#my_period_show").html($("#my_seasonperiod").find("option:selected").text());
          $("#my_span_misson_duration").html("月");
          $("#my_span_plan_duration").html("月");
        }
        if (my_perioditem=="year"){
          $("#my_yearperiod").addClass("active");
          $("#my_yearperiod").val(my_period);
          $("#my_period_show").html($("#my_yearperiod").find("option:selected").text());
          $("#my_span_misson_duration").html("季度");
          $("#my_span_plan_duration").html("季度");
        }


        $("#others_monthperiod").removeClass("active");
        $("#others_monthperiod").val(100);
        $("#others_seasonperiod").removeClass("active");
        $("#others_seasonperiod").val(1000);
        $("#others_yearperiod").removeClass("active");
        $("#others_yearperiod").val(10000);
        
        $("#"+others_perioditem+"period").addClass("active");

        if (others_perioditem=="month"){
          $("#others_monthperiod").addClass("active");
          $("#others_monthperiod").val(others_period);
          $("#others_period_show").html($("#others_monthperiod").find("option:selected").text());
          $("#others_span_misson_duration").html("周");
          $("#others_span_plan_duration").html("周"); 
        }
        if (others_perioditem=="season"){
          $("#others_seasonperiod").addClass("active");
          $("#others_seasonperiod").val(others_period);
          $("#others_period_show").html($("#others_seasonperiod").find("option:selected").text());
          $("#others_span_misson_duration").html("月");
          $("#others_span_plan_duration").html("月");
        }
        if (others_perioditem=="year"){
          $("#others_yearperiod").addClass("active");
          $("#others_yearperiod").val(others_period);
          $("#others_period_show").html($("#others_yearperiod").find("option:selected").text());
          $("#others_span_misson_duration").html("季度");
          $("#others_span_plan_duration").html("季度");
        }
    }

    initPerild();
    // 我的日期选择确定
    function selectMyPeriod(selectedperioditem,selectedperiod){
      console.log(selectedperioditem + " " +selectedperiod);

      my_perioditem=selectedperioditem;
      my_period=selectedperiod;
      

      if(selectedperiod==100 || selectedperiod==1000 || selectedperiod==10000){return false;}
      window.location.href = "{{ route('objective.others') }}" + "?keyword={{ $keyword }}&othersId=" + othersId +  "&my_perioditem=" + my_perioditem + "&my_period=" + my_period +  "&others_perioditem=" + others_perioditem + "&others_period=" + others_period;
    }

    // 我的日期选择确定
    function selectOthersPeriod(selectedperioditem,selectedperiod){
      console.log(selectedperioditem + " " +selectedperiod);

      others_perioditem=selectedperioditem;
      others_period=selectedperiod;

      if(selectedperiod==100 || selectedperiod==1000 || selectedperiod==10000){return false;}
      window.location.href = "{{ route('objective.others') }}" + "?keyword={{ $keyword }}&othersId="  + othersId +  "&my_perioditem=" + my_perioditem + "&my_period=" + my_period +  "&others_perioditem=" + others_perioditem + "&others_period=" + others_period;
    }

    function keywordSearch(){
      var keyword = $("#keyword").val();

      // if (!keyword) {
      //     layer.msg("请输入条件",{time:1000});
      //     return false;
      // }
      url = "{{ route('objective.others') }}";

      window.location.href = "{{ route('objective.others') }}" + "?keyword="+keyword+"&othersId="  + othersId +  "&my_perioditem=" + my_perioditem + "&my_period=" + my_period +  "&others_perioditem=" + others_perioditem + "&others_period=" + others_period;
    }

    // 点击部门员工列表中的一个人
    function youClick(userid){
      // console.log(user_id);
      var keyword = $("#keyword").val();
   
      // if (!keyword) {
      //     layer.msg("请输入条件",{time:1000});
      //     return false;
      // }
      othersId = userid;
      // 点了某员工
      window.location.href = "{{ route('objective.others') }}" + "?keyword="+keyword+"&othersId="  + othersId +  "&my_perioditem=" + my_perioditem + "&my_period=" + my_period +  "&others_perioditem=" + others_perioditem + "&others_period=" + others_period;
    }


    //新增修改信心指数层
    function pop_confidentindex_div(btn){
      flag = $(btn).attr("flag");
      itemid = $(btn).attr("itemid");

      $.ajax({
        type: 'GET',
        url: '{{ route('keyresult.detail') }}',
        data: { id : itemid,},
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        success: function(data){
          console.log(data);

          // 显示信心指数
          $("#confidentindexLog").html(getConfidentindex(data.confidentindex));

          $(".tj_xxzs").show();
        },
      });
    }

    // 拼信心指数log html
    function getConfidentindex(confidentindexData){

      var str="<table class=\"layui-table\" lay-skin=\"nob\">";
      str+="<colgroup>";
      str+="<col width=\"150\">";
      str+="<col width=\"150\">";
      str+="</colgroup>";
      str+="<thead>";
      str+="<tr>";
      str+="<th colspan=\"3\">修改记录</th>";
      str+="</tr>";
      str+="</thead>";
      str+="<tbody>";
      
      for (var i = 0; i < confidentindexData.length; i++) {
         str+="<tr>";
         str+="<td>"+confidentindexData[i]['created_at']+"</td>";
         
         if(i==(confidentindexData.length-1)){
          str+="<td>初始信心 5/10</td>";
         }else{
          str+="<td>"+confidentindexData[i]['oldconfidentindex']+"修改为"+confidentindexData[i]['newconfidentindex']+"</td>";
         }
         
         str+="<td>"+confidentindexData[i]['description']+"</td> ";
         str+="</tr>";
      }

      str+="</tbody>";
      str+="</table>";
      str+="<tbody>";
      str+="<tbody>";

      // console.log(str);
      return str;
    }

    // 弹评论层
    function pop_comment_div(btn,description){
      flag = $(btn).attr("flag");
      itemid = $(btn).attr("itemid");

      console.log("flag:"+flag+" itemid:"+itemid);
      
      $("#description_for_pl").html(description);

      $.ajax({
        type: "GET",
        url: "{{ route('comment.index') }}",
        data: { okr_id : itemid},
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        success: function(data){
          console.log(data);
          if(data.status=="1"){

            $("#comment_showArea").html(getComment(data.comments));
            $(".pl_models").show();
          }
        },
      });
    }

    // 拼评论显示html
    function getComment(commentData){

      var str="";
      for (var i = 0; i < commentData.length; i++) {
        console.log(commentData[i]['comment']);
        str+="<ul>";
        str+="<li class=\"pl_list\">";
        str+="<div>";
        str+="<div class=\"left\">";
        str+="<div class=\"tx_img\">";
        str+=commentData[i]['user_name']['name'].substring(0,1);
        str+="</div>";
        str+="</div>";
        str+="<div class=\"left left_cont\">";
        str+="<div class=\"top\">";
        str+=commentData[i]['user_name']['name']+"<span class=\"pl_time\">&nbsp;&nbsp;"+commentData[i]['created_at']+"</span>";
        str+="</div>";
        str+="<div class=\"bottom\">";
        str+=commentData[i]['comment'];
        str+="</div>";
        str+="</div>";
        str+="</div>";
        str+="</li>";
        str+="</ul>";
      };

      // console.log(str);
      return str;

      /*
      str =
      '<li class="pl_list">
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
      </li>';
      */
    }

    // 发表评论
    function new_comment(){

      comment = $("#comment_input").val();
     
      console.log(comment);
      
      // return false;

      if (comment.trim()=="") {
        layer.msg("请输入评论内容",{time:1000});
        return false;
      }

      ajax_type = 'POST';
      submit_url = "{{ route('comment.store') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { okr_id : itemid, comment : comment, },
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        success: function(data){
          console.log(data);
          layer.msg(data.msg);
          if(data.status=="1"){
            // // window.location.reload();

            $.ajax({
              type: "GET",
              url: "{{ route('comment.index') }}",
              data: { okr_id : itemid},
              dataType: 'json',
              headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
              },
              success: function(data){
                console.log(data);
                if(data.status=="1"){
                  $("#comment_input").val('');
                  $("#comment_showArea").html(getComment(data.comments));
                  // $(".pl_models").show();
                }
              },
            });

          }
        },
      });
    }

    function logout(){
      window.location.href = "{{ route('index.logout') }}";
    }
</script>
<script type="text/javascript" src="/okr/js/main.js"></script></body>
<!-- Download From www.exet.tk-->
</html>
