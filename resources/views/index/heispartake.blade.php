<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>成员目标</title>
  <!--                       CSS                       -->

  @include('layouts._index_headerCss')

</head>
<body id="cy_mb">
     <div class="layui-layout layui-layout-admin">
      <div class="layui-header">
        <div class="layui-logo" style="padding-top: 17px;"><h2 style="color: #fff;">方田员工OKR管理系统</h2></div>
          <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item" style="opacity: 0">
                
            </li>
            <li class="layui-nav-item" style="opacity: 0">
              
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
      @include('layouts._index_changePwd')

      <div id="body-wrapper">
        <!-- Wrapper for the radial gradient background -->
          <aside class="main-sidebar">
            <section  class="sidebar">
              <ul class="sidebar-menu">
                <li class="header"></li>
                <li class="treeview">
                  <a href="{{ route('objective.iamexecutor',"1") }}">
                    <i class="fa fa-files-o"></i>
                    <span>我的目标</span>
                    <!-- <i class="fa fa-angle-right pull-right"></i> -->
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ route('objective.heisexecutor',"1") }}">
                    <i class="fa fa-th"></i> <span>成员目标</span>
                  </a>
                    <!-- <i class="fa fa-angle-right pull-right"></i> -->
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
              成员目标
            </div>
            <!-- End .clear -->
            <div class="content-box" style="display: flex;">
              <!-- 公司员工搜索 -->
              <div style="width: 261px;padding: 0 15px;border-right: 1px solid #ddd;margin-right: 15px;">
                <div class="yg_sec">
                  <input type="text" style="width: 230px;" id="keyword" name="keyword" lay-verify="identity" placeholder="员工手机或姓名" autocomplete="off" class="layui-input" value="{{ $keyword }}">
                  <img src="/okr/resources/images/icons/search.png" class="jy_btn" onclick="keywordSearch();">
                </div>
                <div class="trees">
                  <ul id="ygNameTree" class="ztree"></ul>
                </div>
              </div>
              <div class="layui-tab my_cont">
                <ul class="layui-tab-title">
                  <!--a href="{{ route('objective.heisexecutor',$p1) }}" class="nows"><li class="layui-this">成员负责的</li></a-->
                  <a href="javascript:;" onclick="clickTabTitle(1);"  class="nows"><li>成员负责的</li></a>
                  <li class="layui-this">成员参与的</li>
                </ul>
                <div class="my_job">
                  <div class="text-center c_333">{{ $executor['name'] }} <br> <span class="c_999">{{ $executor['position_name'] }}</span></div>
                </div>
                <div class="layui-tab-content">
                  <div class="layui-tab-item layui-show">
                    <div class="time_con">
                      <select id="weekperiod" class="list active" onchange="selectPeriod('week',this.value);">
                        <option value="0">周度</option>
                        <option value="1">本周</option>
                        <option value="2">上周</option>
                        <option value="3">下周</option>
                      </select>

                      <select id="monthperiod" class="list" onchange="selectPeriod('month',this.value);">
                        <option value="100">月度</option>
                        <option value="101">一月</option>
                        <option value="102">二月</option>
                        <option value="103">三月</option>
                        <option value="104">四月</option>
                        <option value="105">五月</option>
                        <option value="106">六月</option>
                        <option value="107">七月</option>
                        <option value="108">八月</option>
                        <option value="109">九月</option>
                        <option value="110">十月</option>
                        <option value="111">十一月</option>
                        <option value="112">十二月</option>
                      </select>

                      <select id="seasonperiod" class="list" onchange="selectPeriod('season',this.value);">
                        <option value="1000">季度</option>
                        <option value="1001" title="1月-3月">第一季度</option>
                        <option value="1002" title="3月-6月">第二季度</option>
                        <option value="1003" title="6月-9月">第三季度</option>
                        <option value="1004" title="10月-12月">第四季度</option>
                      </select>

                      <div id="othersperiod" class="ot_time list">
                        <select>
                          <option value="10000">其他时间</option>
                        </select>
                        <input type="text" class="layui-input" id="otherstime" placeholder="其他时间" style="border: none;opacity: 0;" readonly >
                      </div>
                    </div>
                    <div class="trees">
                      <div class="titles">（{{ $arr_period[0] }}~{{ $arr_period[1] }}）OKR指标
                      </div>
                      <ul id="cyfz" class="ztree"></ul>
                      {!! $objective->appends(array('keyword'=>$keyword,'user_id'=>$user_id,'perioditem'=>$perioditem,'period'=>$period))->render() !!}
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
                          <a id="o_del_btn" href="javascript:void(0)" class="bj_btn models_del" onClick="delete_objective(del_o_id);">删除</a>
                          <a id="o_edit_btn" href="javascript:void(0)" class="bj_btn models_bj">编辑</a>
                        </span>
                      </div>
                      <div class="mb_cont">
                        <!-- 给ul添加class ul_bj 显示边框 -->
                        <ul class="ul_no" id="o_edit_ul">
                          <li>
                            <i class="icon iconfont icon-adduser1"></i>
                            <!-- <span id="o_executor_id_u"></span> -->
                            <input id="o_executor_id_u" type="text" class="layui-input" readonly value="">
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
                            <textarea id="o_description_u" name="o_description_u" placeholder=""  style="resize:none"></textarea>
                          </li>
                        </ul>
                      </div>
                      <div id="o_savecancel_div" class="layui-layer-btn layui-layer-btn-" style="display: none;">
                        <a class="layui-layer-btn bc" onclick="edit_objective();">保存</a>
                        <a class="layui-layer-btn models_qx">取消</a>
                      </div>
                    </div>
                  </form>
                  <!-- 评论 -->
                  <div style="border-top: 1px solid #ddd;padding-top: 10px;" class="mb_cont">
                    <div class="fzr">
                      <span class="ob_titles">
                        评论
                      </span>
                    </div>
                    <div>
                      <input type="text" id="o_comment_input" class="layui-input pl_ipt" placeholder="发表评论"><button id="o_comment_id" okr_id="" class="layui-btn layui-btn-normal pl_btn" onclick="new_comment(this);">发表</button>
                    </div>
                    <div class="pl_cont" id="o_comment_showArea">
                    </div>
                  </div>
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
                        <span class="ob_titles model_mb_titles" id="kr_name_u">
                          每天报名人数不低于40人
                        </span>
                        <span class='ywc model_mb_zt' id="kr_dateStatus_u">已完成</span>
                        <!-- 评分的颜色两种 一种是正常s_color  一种逾期f_color  -->
                        &nbsp;&nbsp;&nbsp;&nbsp;<span class="s_color" id="kr_score_u">0.6</span>
                        <!-- <span class="f_color">&nbsp;&nbsp;&nbsp;&nbsp;0.6</span> -->

                        <!-- 删除编辑 有权改就显示按钮 没有权限就不显示 -->
                        <span class="bj_cont">
                          <a id="kr_del_btn" href="javascript:void(0)" class="bj_btn models_del" onClick="delete_keyresult(del_kr_id);">删除</a>
                          <a id="kr_edit_btn" href="javascript:void(0)" class="bj_btn models_bj">编辑</a>
                        </span>
                      </div>
                      <div class="mb_cont">
                        <!-- 给ul添加class ul_bj 显示边框 -->
                        <ul class="ul_no" id="kr_edit_ul">
                          <li>
                            <i class="icon iconfont icon-adduser1"></i>
                            <!-- <span id="kr_executor_id_u">{{ $executor['name'] }}</span> -->
                            <input id="kr_executor_id_u" type="text" class="layui-input" readonly value="{{ $executor['name'] }}">
                          </li>

                          <li>
                            <i class="icon iconfont icon-calendar1"></i>
                            <input type="text" class="layui-input" id="dy_key_time" placeholder="时间" readonly>
                          </li>

                          <li>
                            <i class="icon iconfont icon-addusergroup1"></i>
                            <select id="kr_partake_id_u" name="kr_partake_id_u" class="selectpicker mb_cyr" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
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
                            <textarea id="kr_description_u" name="kr_description_u" placeholder=""  style="resize:none"></textarea>
                          </li>
                        </ul>
                      </div>
                      <div id="kr_savecancel_div" class="layui-layer-btn layui-layer-btn-" style="display: none;">
                        <a class="layui-layer-btn bc" onclick="edit_keyresult();">保存</a>
                        <a class="layui-layer-btn models_qx">取消</a>
                      </div>
                    </div>
                  </form>
                  <!-- 评论 -->
                  <div style="border-top: 1px solid #ddd;padding-top: 10px;" class="mb_cont">
                    <div class="fzr">
                      <span class="ob_titles">
                        评论
                      </span>
                    </div>
                    <div>
                      <input type="text" id="kr_comment_input" class="layui-input pl_ipt" placeholder="发表评论"><button id="kr_comment_id" class="layui-btn layui-btn-normal pl_btn" onclick="new_comment(this);">发表</button>
                    </div>
                    <div class="pl_cont" id="kr_comment_showArea">
                    </div>
                  </div>
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
                        <span class="ob_titles model_mb_titles" id="p_name_u">
                          每天报名人数不低于40人
                        </span>
                        <span class='ywc model_mb_zt' id="p_dateStatus_u">已完成</span>
                        <!-- 评分的颜色两种 一种是正常s_color  一种逾期f_color  -->
                        &nbsp;&nbsp;&nbsp;&nbsp;<span class="s_color" id="p_score_u">0.6</span>
                        <!-- <span class="f_color">&nbsp;&nbsp;&nbsp;&nbsp;0.6</span> -->

                        <!-- 删除编辑 有权改就显示按钮 没有权限就不显示 -->
                        <span class="bj_cont">
                          <a id="plan_del_btn" href="javascript:void(0)" class="bj_btn models_del" onClick="delete_plan(del_plan_id);">删除</a>
                          <a id="plan_edit_btn" href="javascript:void(0)" class="bj_btn models_bj">编辑</a>
                        </span>
                      </div>
                      <div class="mb_cont">
                        <!-- 给ul添加class ul_bj 显示边框 -->
                        <ul class="ul_no" id="p_edit_ul">
                          <li>
                            <i class="icon iconfont icon-adduser1"></i>
                            <!-- <span id="p_executor_id_u">{{ $executor['name'] }}</span> -->
                            <input id="p_executor_id_u" type="text" class="layui-input" readonly value="{{ $executor['name'] }}">
                          </li>

                          <li>
                            <i class="icon iconfont icon-calendar1"></i>
                            <input type="text" class="layui-input" id="dy_jh_time" placeholder="时间" readonly>
                          </li>

                          <li>
                            <i class="icon iconfont icon-addusergroup1"></i>
                            <select id="p_partake_id_u" name="p_partake_id_u" class="selectpicker mb_cyr" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
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
                            <textarea id="p_description_u" name="p_description_u" placeholder=""  style="resize:none"></textarea>
                          </li>
                        </ul>
                      </div>
                      <div id="p_savecancel_div" class="layui-layer-btn layui-layer-btn-" style="display: none;">
                        <a class="layui-layer-btn bc" onclick="edit_plan();">保存</a>
                        <a class="layui-layer-btn models_qx">取消</a>
                      </div>
                    </div>
                  </form>
                  <!-- 评论 -->
                  <div style="border-top: 1px solid #ddd;padding-top: 10px;" class="mb_cont">
                    <div class="fzr">
                      <span class="ob_titles">
                        评论
                      </span>
                    </div>
                    <div>
                      <input type="text" id="p_comment_input" class="layui-input pl_ipt" placeholder="发表评论"><button id="p_comment_id" class="layui-btn layui-btn-normal pl_btn" onclick="new_comment(this);">发表</button>
                    </div>
                    <div class="pl_cont" id="p_comment_showArea">
                    </div>
                  </div>
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
  /*公司职位*/
  var ygsetting = {
      view: {
        addDiyDom: addDiyDoms
      },
    };
  // var ygnames =[
  //     { name:"财务部", open:true,job:"",
  //       children: [
  //         { name:"朱小舟",job:"主管",click:"alert('aaa')",},
  //         { name:"朱小舟",job:"职员"},
  //         { name:"朱小舟",job:"职员"}
  //       ]},
  // ];

  var ygnames = {!! $json_allUserDept !!};

  function addDiyDoms(treeId, treeNode) {
      // if (treeNode.parentNode && treeNode.parentNode.id!=2) return;
      var aObj = $("#" + treeNode.tId + IDMark_A);
      var job = (typeof(treeNode.position_name) == "undefined") ? ("") : (treeNode.position_name);
      var editStr = "<span class='demoIcon'><span class='wks'>"+job+"</span></span>";
      aObj.after(editStr);
  }



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
    
    
    /*成员负责的*/
    var cyfzsetting = {
      view: {
        addDiyDom: addDiyDom,
        showIcon: false,
        fontCss: getFont
      }
    };

    var cyfz = {!! $json_objective !!};

    function getFont(treeId, node) {
      return node.font ? node.font : {};
    }

    function addDiyDom(treeId, treeNode) {
      // if (treeNode.parentNode && treeNode.parentNode.id!=2) return;
      // var aObj = $("#" + treeNode.tId + IDMark_A);
      // var name = treeNode.name;
      // var editStr = "<span class='demoIcon'><span class='pl_btn_zt' data-names='"+name+"'><i class='icon iconfont icon-pinglun'></i>评论</span></span>";
      //   aObj.after(editStr);

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
      // if(treeNode.dateStatus==2 || (treeNode.dateStatus==4 && treeNode.score==999)){
      //  scoreStatusStr = "<span class='demoIcon'><span class='jxz pf' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='score(this);'>评分</span></span>";
      // }else{
        //有分数线是分数
        if(treeNode.score!=999){
          scoreStatusStr = "<span class='demoIcon'><span>"+treeNode.score+"</span></span>";
        }
      // }
      
      
      nextlevelStatusStr="";
      detailStatusStr="";
      switch(treeNode.flag)
      {
        case "objective":
          // nextlevelStatusStr="<span class='demoIcon'><span title='添加KR' class='icon iconfont icon-jiahao tj_jg' onclick='pop_new_kr("+treeNode.id+")'></span></span>";
          detailStatusStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-chaxun' title='详情' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='detail_objective(this);'></span></span>";
          break;
        case "keyresult":
          // nextlevelStatusStr="<span class='demoIcon'><span title='添加计划' class='icon iconfont icon-jiahao tj_jh' onclick='pop_new_p("+treeNode.id+")'></span></span>";
          detailStatusStr = "<span class='demoIcon'><span class='jgxq icon iconfont icon-chaxun' title='详情' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='detail_keyresult(this);'></span></span>";
          break;
        case "plan":
          // nextlevelStatusStr="";
          detailStatusStr = "<span class='demoIcon'><span class='jhxq icon iconfont icon-chaxun' title='详情' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='detail_plan(this);'></span></span>";
          break;
      }
      
      aObj.after(dateStatusStr + scoreStatusStr + nextlevelStatusStr + detailStatusStr);
    }



    $(document).ready(function(){
      /*员工名称*/
      $.fn.zTree.init($("#ygNameTree"), ygsetting, ygnames);
      
      /*员工负责的*/
      $.fn.zTree.init($("#cyfz"), cyfzsetting, cyfz);

      var laydate = layui.laydate;
      var otherstime = laydate.render({
              elem: '#otherstime',
              range:true,
              //min:'2018-06-17',
              //max:'2018-06-27',
              done: function(value, date, endDate) {
                      console.log(value);
                      selectPeriod('others',value);
                    }
          });
    
    });


  var perioditem;
  var period;
  $(function(){
      $("#cy_mb .treeview a:contains('成员目标')").parent().addClass('active');


      var laydate = layui.laydate;
      var otherstime = laydate.render({
              elem: '#otherstime',
              range:true,
              btns: ['confirm'],
              //min:'2018-06-17',
              //max:'2018-06-27',
              done: function(value, date, endDate) {
                      console.log(value);
                      selectPeriod('others',value);
                    }
          });

      // 定位日期段所属项目和具体选择的日期段
      perioditem = "{{ $perioditem }}";
      period = {{ $period }};

      initPerild();

      // 目标编辑时间
      dy_res_time_laydate = laydate.render({
           elem: '#dy_res_time',
           range: true,
          });

      // 关键结果编辑时间
      dy_key_time_laydate = laydate.render({
           elem: '#dy_key_time',
           range: true,
          });
      // console.log(dy_key_time_laydate);

      // 计划编辑时间
      dy_jh_time_laydate = laydate.render({
           elem: '#dy_jh_time',
           range: true,
          });

      // 打开当前员工的部门
      var user_id = '{{ $user_id }}';
      for (var i=0;i<ygnames.length;i++) {
        for (var r=0;r<ygnames[i].children.length;r++) {
          if (user_id == ygnames[i].children[r].id) {
            ygnames[i].open="true";
            $.fn.zTree.init($("#ygNameTree"), ygsetting, ygnames);
          } 
        }
      }

  })


    // 初始化日期选择
    function initPerild(){
        $("#weekperiod").removeClass("active");
        $("#weekperiod").val(0);
        $("#monthperiod").removeClass("active");
        $("#monthperiod").val(100);
        $("#seasonperiod").removeClass("active");
        $("#seasonperiod").val(1000);
        $("#othersperiod").removeClass("active");
        $("#othersperiod").val(10000);
        
        $("#"+perioditem+"period").addClass("active");
        if (period>0 && period<100){$("#weekperiod").val(period);}
        if (period>100 && period<1000){$("#monthperiod").val(period);}
        if (period>1000 && period<10000){$("#seasonperiod").val(period);}
    }

    // 目标详情
    function detail_objective(btn){
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
          $("#o_executor_id_u").val(data.executor['name']);
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
          }else{
            $("#o_score_u").html(""); 
          }

          // // 删除按钮
          // $("#o_del_btn").show();
          // if(data.canDel['0']==0){
          //   $("#o_del_btn").hide();
          // }else{
          //   // $("#o_del_btn").click("delete_objective("+itemid+")");
          //   // // $("#o_del_btn").attr("href","delete_objective("+itemid+")");
          //   // console.log($("#o_del_btn").click());

          //   // $("#o_del_btn").click("delete_objective()");
          //   del_o_id = itemid;
          // }

          // // 编辑按钮
          // $("#o_edit_btn").show();
          // if(data.dateStatus==3 || data.dateStatus==4){
          //   $("#o_edit_btn").hide();
          // }
          
          ajax_type = 'PATCH';
          //submit_url = updateurl;
          
          // 删除按钮 编辑按钮 隐藏
          $("#o_del_btn").hide();
          $("#o_edit_btn").hide();

          // 目标编辑层初始化
          $("#o_savecancel_div").hide();
          $("#o_edit_ul").addClass("ul_no");
          

          $("#o_comment_id").attr("okr_id",itemid);
          // 显示评论
          $("#o_comment_showArea").html(getComment(data.comments));

          $(".dy_mb_models").show();

        },
      });
    }

    // 关键结果详情
    function detail_keyresult(btn){
      flag = $(btn).attr("flag");
      itemid = $(btn).attr("itemid");

      geturl =  "{{ route('keyresult.detail') }}";

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
          $("#kr_name_u").html(data.name);
          //时间
          $("#dy_key_time").val(data.startdate+" - "+data.enddate);
          // console.log(data.objective.startdate.split("-"));
          startdate = data.objective.startdate.split("-");
          enddate = data.objective.enddate.split("-");
          dy_key_time_laydate.config.min = {year: startdate[0], month: startdate[1]-1, date: startdate[2],};
          dy_key_time_laydate.config.max = {year: enddate[0], month: enddate[1]-1, date: enddate[2],};
          //描述
          $("#kr_description_u").val(data.description);
          //负责人
          // $("#kr_executor_id_u").html(data.executor['name']);
          //参与者
          //$("#o_partake_id_u").val([3,6]);
          $("#kr_partake_id_u").val(data.newpartake);
          $('#kr_partake_id_u').selectpicker('refresh');
          //状态
          switch(data.dateStatus)
          {
            case 1:
              //dateStatusStr="<span class='demoIcon'><span class='wks'>未开始</span></span>";
              $("#kr_dateStatus_u").html("未开始");
              $("#kr_dateStatus_u").attr("class","wks model_mb_zt");
              break;
            case 2:
              //dateStatusStr="<span class='demoIcon'><span class='jxz'>进行中</span></span>";
              $("#kr_dateStatus_u").html("进行中");
              $("#kr_dateStatus_u").attr("class","jxz model_mb_zt");
              break;
            case 3:
              //dateStatusStr="<span class='demoIcon'><span class='ywc'>已完成</span></span>";
              $("#kr_dateStatus_u").html("已完成");
              $("#kr_dateStatus_u").attr("class","ywc model_mb_zt");
              break;
            case 4:
              //dateStatusStr="<span class='demoIcon'><span class='yyq'>已逾期</span></span>";
              $("#kr_dateStatus_u").html("已逾期");
              $("#kr_dateStatus_u").attr("class","yyq model_mb_zt");
              break;
            default:
          }
          //分数
          
          if(data.score!=999){
            $("#kr_score_u").html(data.score);
          }else{
            $("#kr_score_u").html(""); 
          }

          // // 删除按钮
          // $("#kr_del_btn").show();
          // if(data.canDel['0']==0){
          //   $("#kr_del_btn").hide();
          // }else{
          //   del_kr_id = itemid;
          // }
          
          // // 编辑按钮
          // $("#kr_edit_btn").show();
          // if(data.dateStatus==3 || data.dateStatus==4){
          //   $("#kr_edit_btn").hide();
          // }

          ajax_type = 'PATCH';
          //submit_url = updateurl;
          
          // 目标编辑层初始化
          $("#kr_savecancel_div").hide();
          $("#kr_edit_ul").addClass("ul_no");
          
          // 删除按钮 编辑按钮 隐藏
          $("#kr_del_btn").hide();
          $("#kr_edit_btn").hide();

          $("#kr_comment_id").attr("okr_id",itemid);
          // 显示评论
          $("#kr_comment_showArea").html(getComment(data.comments));

          $(".key_mb_models").show();
            
        },
      });
    }

    // 计划详情
    function detail_plan(btn){
      flag = $(btn).attr("flag");
      itemid = $(btn).attr("itemid");

      geturl =  "{{ route('plan.detail') }}";

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
          $("#p_name_u").html(data.name);
          //时间
          $("#dy_jh_time").val(data.startdate+" - "+data.enddate);
          startdate = data.keyresult.startdate.split("-");
          enddate = data.keyresult.enddate.split("-");
          dy_jh_time_laydate.config.min = {year: startdate[0], month: startdate[1]-1, date: startdate[2],};
          dy_jh_time_laydate.config.max = {year: enddate[0], month: enddate[1]-1, date: enddate[2],};
          //描述
          $("#p_description_u").val(data.description);
          //负责人
          // $("#kr_executor_id_u").html(data.executor['name']);
          //参与者
          //$("#o_partake_id_u").val([3,6]);
          $("#p_partake_id_u").val(data.newpartake);
          $('#p_partake_id_u').selectpicker('refresh');
          //状态
          switch(data.dateStatus)
          {
            case 1:
              //dateStatusStr="<span class='demoIcon'><span class='wks'>未开始</span></span>";
              $("#p_dateStatus_u").html("未开始");
              $("#p_dateStatus_u").attr("class","wks model_mb_zt");
              break;
            case 2:
              //dateStatusStr="<span class='demoIcon'><span class='jxz'>进行中</span></span>";
              $("#p_dateStatus_u").html("进行中");
              $("#p_dateStatus_u").attr("class","jxz model_mb_zt");
              break;
            case 3:
              //dateStatusStr="<span class='demoIcon'><span class='ywc'>已完成</span></span>";
              $("#p_dateStatus_u").html("已完成");
              $("#p_dateStatus_u").attr("class","ywc model_mb_zt");
              break;
            case 4:
              //dateStatusStr="<span class='demoIcon'><span class='yyq'>已逾期</span></span>";
              $("#p_dateStatus_u").html("已逾期");
              $("#p_dateStatus_u").attr("class","yyq model_mb_zt");
              break;
            default:
          }
          //分数
          
          if(data.score!=999){
            $("#p_score_u").html(data.score);
          }else{
            $("#p_score_u").html(""); 
          }

          // // 删除按钮
          // $("#plan_del_btn").show();
          // if(data.canDel['0']==0){
          //   $("#plan_del_btn").hide();
          // }else{
          //   del_plan_id = itemid;
          // }
          
          // // 编辑按钮
          // $("#plan_edit_btn").show();
          // if(data.dateStatus==3 || data.dateStatus==4){
          //   $("#plan_edit_btn").hide();
          // }
          
          ajax_type = 'PATCH';
          //submit_url = updateurl;
          
          // 目标编辑层初始化
          $("#p_savecancel_div").hide();
          $("#p_edit_ul").addClass("ul_no");

          // 删除按钮 编辑按钮 隐藏
          $("#plan_del_btn").hide();
          $("#plan_edit_btn").hide();

          $("#p_comment_id").attr("okr_id",itemid);
          // 显示评论
          $("#p_comment_showArea").html(getComment(data.comments));
          
          $(".jh_mb_models").show();
            
        },
      });
    }

  // 日期选择确定
  function selectPeriod(selectedperioditem,selectedperiod){
    console.log(selectedperioditem + " " +selectedperiod);
    if(selectedperiod==0 || selectedperiod==100 || selectedperiod==1000 || selectedperiod==10000){return false;}
    window.location.href = "{{ route('objective.heisexecutor',$p1) }}" + "?keyword={{ $keyword }}&user_id={{ $user_id }}" +  "&perioditem=" + selectedperioditem + "&period=" + selectedperiod;
  }

  function keywordSearch(){
    var keyword = $("#keyword").val();

    // if (!keyword) {
    //     layer.msg("请输入条件",{time:1000});
    //     return false;
    // }
    url = "{{ route('objective.heisexecutor',$p1) }}";

    window.location.href = url + "?keyword=" + keyword;
  }

  var user_id = "{{ $user_id }}";
  // 点击部门员工列表中的一个人
  function youClick(user_id){
    user_id = user_id;
    // console.log(user_id);
    var keyword = $("#keyword").val();
 
    // if (!keyword) {
    //     layer.msg("请输入条件",{time:1000});
    //     return false;
    // }
    url = "{{ route('objective.heisexecutor',$p1) }}";

    // 点了某员工
    window.location.href = url + "?keyword=" + keyword + "&user_id=" + user_id;
  }

  function clickTabTitle(flagindex){
    // var user_id = user_id;
    var keyword = $("#keyword").val();
    // alert(user_id);
    // if (!keyword) {
    //     layer.msg("请输入条件",{time:1000});
    //     return false;
    // }
    if(flagindex==1)url = "{{ route('objective.heisexecutor',1) }}";
    if(flagindex==2)url = "{{ route('objective.heisexecutor',2) }}";

    // 点了某员工
    window.location.href = url + "?keyword=" + keyword + "&user_id=" + user_id;
  }


    // 发表评论
    function new_comment(btn){
      // alert("submit_user");
      var okr_id = $(btn).attr("okr_id");
      var btn_id = $(btn).attr("id");
      
      console.log(okr_id);
      console.log(btn_id);

      if(btn_id=="o_comment_id"){
        comment = $("#o_comment_input").val();
      }
      if(btn_id=="kr_comment_id"){
        comment = $("#kr_comment_input").val();
      }
      if(btn_id=="p_comment_id"){
        comment = $("#p_comment_input").val();
      }
      console.log(comment);
      
      // return false;

      if (!comment) {
        layer.msg("请输入评论内容",{time:1000});
        return false;
      }

      ajax_type = 'POST';
      submit_url = "{{ route('comment.store') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { okr_id : okr_id, comment : comment, },
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

</script>
<script type="text/javascript" src="/okr/js/main.js"></script>

</html>
