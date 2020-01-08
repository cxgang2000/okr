<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>我的目标</title>
  <!--                       CSS                       -->

  @include('layouts._index_headerCss')

 </HEAD>
</head>
<body id="my_mb">
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
            </li>
          </ul>
          <!--div class="yg_sec">
                <form>
                  <input type="text" name="identity" lay-verify="identity" placeholder="员工手机、姓名" autocomplete="off" class="layui-input">
                  <img src="/okr/resources/images/icons/search.png" class="jy_btn">
                </form>
          </div>
          <div class="trees">
            <ul id="ygNameTree" class="ztree"></ul>
          </div-->
        </section>
      </aside>

      <!-- End #sidebar -->
      <div id="main-content">

        <div class="h2Title">
          我的目标
        </div>
        <!-- End .clear -->
        <div class="content-box">
          <div class="layui-tab">
            <ul class="layui-tab-title">
              <!--li id="duration-0" onclick="setDurationFlag(0);">月度</li-->
              <li id="duration-1" onclick="setDurationFlag(1);">季度</li>
              <!--li id="duration-3" onclick="setDurationFlag(3);">半年</li-->
              <li id="duration-2" onclick="setDurationFlag(2);">年度</li>
            </ul>
            <div class="layui-tab-content">
              <!--div id="duration-div-0" class="layui-tab-item layui-show">
                <div class="layui-tab">
                  <ul  class="layui-tab-title">
                    <li id="duration-0-01" onclick="setDuration('01');">一月</li>
                    <li id="duration-0-02" onclick="setDuration('02');">二月</li>
                    <li id="duration-0-03" onclick="setDuration('03');">三月</li>
                    <li id="duration-0-04" onclick="setDuration('04');">四月</li>
                    <li id="duration-0-05" onclick="setDuration('05');">五月</li>
                    <li id="duration-0-06" onclick="setDuration('06');">六月</li>
                    <li id="duration-0-07" onclick="setDuration('07');">七月</li>
                    <li id="duration-0-08" onclick="setDuration('08');">八月</li>
                    <li id="duration-0-09" onclick="setDuration('09');">九月</li>
                    <li id="duration-0-10" onclick="setDuration('10');">十月</li>
                    <li id="duration-0-11" onclick="setDuration('11');">十一月</li>
                    <li id="duration-0-12" onclick="setDuration('12');">十二月</li>
                  </ul>
                </div>
              </div-->
              <div id="duration-div-1" class="layui-tab-item">
                <div class="layui-tab">
                  <ul class="layui-tab-title">
                    <li id="duration-1-1" onclick="setDuration('1');">春季(3-5)</li>
                    <li id="duration-1-2" onclick="setDuration('2');">暑假(6-8)</li>
                    <li id="duration-1-3" onclick="setDuration('3');">秋季(9-11)</li>
                    <li id="duration-1-4" onclick="setDuration('4');">寒假(12-2)</li>
                  </ul>
                </div>
              </div>
              <!--div id="duration-div-3" class="layui-tab-item">
                <div class="layui-tab">
                  <ul class="layui-tab-title">
                    <li id="duration-3-001" onclick="setDuration('001');">上半年（1月～6月）</li>
                    <li id="duration-3-002" onclick="setDuration('002');">下半年（7月～12月）</li>
                  </ul>
                </div>
              </div-->
              <div id="duration-div-2" class="layui-tab-item">
                <div class="layui-tab">
                  <ul class="layui-tab-title">
                    <li id="duration-2-2018" onclick="setDuration('2018');">2018</li>
                    <li id="duration-2-2019" onclick="setDuration('2019');">2019</li>
                    <li id="duration-2-2020" onclick="setDuration('2020');">2020</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>











          <div class="layui-row layui-col-space5">
              <div class="layui-col-xs12 rp">
                
                  <div class="okr_mb">
                    部门的OKR（<span id="others_period_show"></span>）
                  </div>

              </div>
              <div class="layui-col-xs12 rp">
                <div class="layui-row layui-col-space5">
                  <div class="layui-col-xs6">
                    <div>
                      <div class="titles">
                        本<span id="others_span_misson_duration">周</span>关注的任务 ({{ substr($arr_weekSatrtAndEnd[0],5,5) }} ~ {{ substr($arr_weekSatrtAndEnd[1],5,5) }})
                        <a href="{{URL::action('MissionController@missionlog',['weekdate'=>$weekdate,'userid'=>$arr_others['id']])}}" target="_blank"><span>操作历史</span></a>
                      </div>
                      <div class="contains">
                        <div style="float:right;">（P1必须做，P2应该做）</div>
                        <br>
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
                        <a href="{{URL::action('ObjectiveController@mineObjectivelog',['durationflag'=>$durationflag,'duration'=>$duration,'userid'=>$arr_others['id']])}}" target="_blank"><span>操作历史</span></a>
                      </div>
                      <div class="contains">
                        <ul id="others_tree" class="ztree">
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="layui-col-xs12 rp">
                <div class="layui-row layui-col-space5">
                  <div class="layui-col-xs6">
                    <div>
                      <div class="titles">
                        未来四<span id="others_span_plan_duration">周</span>计划
                        <a href="{{URL::action('PlanController@planlog',['weekdate'=>$weekdate,'userid'=>$arr_others['id']])}}" target="_blank"><span>操作历史</span></a>
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
                        <a href="{{URL::action('StateindexController@stateindexlog',['durationflag'=>$durationflag,'duration'=>$duration,'userid'=>$arr_others['id']])}}" target="_blank"><span>操作历史</span></a>
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





















          <!-- 具体内容div -->
          <div class="layui-tab-content" >
            <!-- 1y 每个月份 目标值ztree不一样顾就没有写太多 以一月份为例-->
            <div class="okr_mb">
              我的OKR（<span id="my_period_show"></span>）
            </div>
            <div>
              <input style="width: 200px;display: inline-block;" name="weekdate" type="text" id="weekdate" class="layui-smallinput layui-input" /><input name="datesearch" type="button" value="搜索" class="layui-btn layui-btn-lg layui-btn-normal" style="height: 36px;
    margin-left: 10px;" onclick="setDurationFlag(durationflag);"/>
            </div>
            <div class="layui-tab-item layui-show">
                <div class="layui-row layui-col-space5">
                  <div class="layui-col-xs6">
                    <div>
                      <div class="titles">
                        本<span id="span_misson_duration">周</span>关注的任务 ({{ substr($arr_weekSatrtAndEnd[0],5,5) }} ~ {{ substr($arr_weekSatrtAndEnd[1],5,5) }})
                        
                        <a href="{{URL::action('MissionController@missionlog',['weekdate'=>$weekdate])}}" target="_blank"><span>操作历史</span></a>
                        
                        <span class="lf_icon tj_gz_icon">+</span>
                      </div>
                      <div class="contains">
                      	<div style="float:right;">（P1必须做，P2应该做）</div>
                        <br>
                        <ul>

                          @foreach ($arr_mission as $mission)
                          <li>
                            P{{ $mission['importance']  }}：{{ $mission['description']  }}
                            <!--div class="this_cz">
                              <i class="icon iconfont icon-bianji bz_rw"  flag="mission" itemid="{{ $mission['id']  }}" onclick="detail_mission(this);"></i>
                              <i class="icon iconfont icon-laji" description="{{ $mission['description'] }}" flag="mission" itemid="{{ $mission['id']  }}" onclick="pop_del_div(this);"></i>
                            </div-->
                            <div class="this_cz" onmouseover="show_gz('{{ $mission['id']  }}');" onmouseout= "hide_gz('{{ $mission['id']  }}');">
                              ...
                            </div>
                            <div id="gz_{{ $mission['id']  }}" style="position:absolute;display:none;border:1px solid silver;background:silver;">

                                <span flag="mission" itemid="{{ $mission['id']  }}" onclick="detail_mission(this);" style="cursor: pointer;">编辑</span>
                                <br>
                                <span description="{{ $mission['description'] }}" flag="mission" itemid="{{ $mission['id']  }}" onclick="pop_del_div(this);" style="cursor: pointer;">删除</span>
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
                        <a href="{{URL::action('ObjectiveController@mineObjectivelog',['durationflag'=>$durationflag,'duration'=>$duration])}}" target="_blank"><span>操作历史</span></a>
                        <span class="lf_icon xzmb">新增目标</span>
                      </div>
                      <div class="contains">
                        <ul id="treeDemo" class="ztree"></ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="layui-row layui-col-space5">
                  <div class="layui-col-xs6">
                    <div>
                      <div class="titles">
                        未来四<span id="span_plan_duration">周</span>计划
                        <a href="{{URL::action('PlanController@planlog',['weekdate'=>$weekdate])}}" target="_blank"><span>操作历史</span></a>
                        
                        <span class="lf_icon wl_jh">+</span>
                      </div>
                      
                      <div class="contains">
                        <ul>

                          @foreach ($arr_plan as $key=>$plan)
                          <li>
                            {{ $plan['description']  }}{{ $key+1 }}
                            <div class="this_cz">
                              <i class="icon iconfont icon-bianji wl_sz" flag="plan" itemid="{{ $plan['id']  }}" onclick="detail_plan(this);"></i>    
                              <i class="icon iconfont icon-laji" description="{{ $plan['description']  }}" flag="plan" itemid="{{ $plan['id']  }}" onclick="pop_del_div(this);"></i>
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
                        <a href="{{URL::action('StateindexController@stateindexlog',['durationflag'=>$durationflag,'duration'=>$duration])}}" target="_blank"><span>操作历史</span></a>
                        <span class="lf_icon tj_zt_icon">+</span>
                      </div>
                      <div class="contains">
                        <div class="text-right">
                          <span class="layui-badge-dot layui-bg-green"></span>优秀
                          <span class="layui-badge-dot layui-bg-cyan"></span>良好
                          <span class="layui-badge-dot layui-bg-blue"></span>一般
                          <span class="layui-badge-dot layui-bg-gray"></span>差
                        </div>
                        <ul>

                          @foreach ($arr_stateindex as $stateindex)
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
                            <div class="this_cz">
                              <i class="icon iconfont icon-bianji wl_sz" flag="stateindex" itemid="{{ $stateindex['id'] }}" onclick="detail_stateindex(this);"></i>    
                              <i class="icon iconfont icon-laji" description="{{ $stateindex['description'] }}" flag="stateindex" itemid="{{ $stateindex['id'] }}" onclick="pop_del_div(this);"></i>
                            </div>
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
    <!-- End Notifications -->
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->

<!-- 打分 -->
<div class="models dafen_models" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
                <form>
                  <!-- 目标内容 -->
                    <div class="dafen_titles">
                      请给当前<span id="score_item"></span>的完成情况打分（0-1）                      
                    </div>
                    <div class="layui-layer-btn layui-layer-btn- dafen_btn">
                      <div class="layui-input-inline">

                        <!--input type="number" placeholder="请打分" autocomplete="off" class="layui-input" min="0" max="1" step="0.1" value="0.5" id="score"-->
                        
                        <select class="sel_model" id="score">
                          <option value="-1">请打分</option>
                          <option value="0">0</option>
                          <option value="0.1">0.1</option>
                          <option value="0.2">0.2</option>
                          <option value="0.3">0.3</option>
                          <option value="0.4">0.4</option>
                          <option value="0.5">0.5</option>
                          <option value="0.6">0.6</option>
                          <option value="0.7">0.7</option>
                          <option value="0.8">0.8</option>
                          <option value="0.9">0.9</option>
                          <option value="1">1</option>
                        </select>

                      </div>
                      <a class="layui-layer-btn" onclick="setscore();">确认</a>
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

<!-- 有关键结果不能删除 -->
<div class="models bnsc_models" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles">
                      当前目标下包含关键结果，请先删除关键结果！
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">知道了</a>
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

<!-- 直接删除 -->
<div class="models zjsc_models" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles" id="del_div_title">
               确认删除【KR1:增开10场入学测试及家长会】？
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="delete_item();">确定</a>
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

<!-- 添加未来计划 -->
<div class="models com_models tj_jh" id="tj_jh" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              添加计划
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">未来计划：</label>
              <div class="layui-input-block">
                <input type="text" id="p_description" name="p_description" lay-verify="title" autocomplete="off" placeholder="输入未来四周计划" class="layui-input">
              </div>
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="new_plan();">保存</a>
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

<!-- 编辑未来计划 -->
<div class="models com_models bj_jh" id="bj_jh" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              编辑计划
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">未来计划：</label>
              <div class="layui-input-block">
                <input type="text" id="p_description_u" name="p_description_u" lay-verify="title" autocomplete="off" placeholder="输入未来四周计划" class="layui-input">
              </div>
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="edit_plan();">保存</a>
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

<!-- 添加关键结果 -->
<div class="models com_models tj_jg" id="tj_jg" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              添加关键结果(Key Results)
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">关键结果：</label>
              <div class="layui-input-block">
                <input type="text" id="kr_description" name="kr_description" lay-verify="title" autocomplete="off" placeholder="输入关键结果" class="layui-input">
              </div>
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="new_keyresult();">保存</a>
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

<!-- 编辑关键结果 -->
<div class="models com_models bj_jg" id="bj_jg" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              编辑关键结果(Key Results)
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">关键结果：</label>
              <div class="layui-input-block">
                <input type="text" id="kr_description_u" name="kr_description" lay-verify="title" autocomplete="off" placeholder="输入关键结果" class="layui-input">
              </div>
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="edit_keyresult();">保存</a>
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

<!-- 添加目标 -->
<div class="models com_models tj_mb" id="tj_mb" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              添加目标(Objective)
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">我的目标：</label>
              <div class="layui-input-block">
                <input type="text" id="o_description" name="o_description" lay-verify="title" autocomplete="off" placeholder="输入我的目标" class="layui-input">
              </div>
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="new_objective();">保存</a>
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

<!-- 修改目标 -->
<div class="models com_models bj_mb" id="bj_mb" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              编辑目标(Objective)
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">我的目标：</label>
              <div class="layui-input-block">
                <input type="text" id="o_description_u" name="o_description" lay-verify="title" autocomplete="off" placeholder="输入我的目标" class="layui-input">
              </div>
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="edit_objective();">保存</a>
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

<!-- 添加关注的任务 -->
<div class="models com_models tj_gz" id="tj_gz" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              添加关注
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">
                <select class="sel_model" id="m_importance">
                  <!--option value="0">重要程度</option-->
                  <option value="1" title="必须要做">P1</option>
                  <option value="2" title="应该要做">P2</option>
                </select>
              </label>
              <div class="layui-input-block">
                <input id="m_description" type="text" name="title" lay-verify="title" autocomplete="off" placeholder="输入本周关注的任务" class="layui-input">
              </div>
            </div>
            <div>
              未来四周计划
              @foreach ($arr_plan as $key=>$plan)
              <li>

                {{ $key+1 }} . {{ $plan['description']  }}{{ $key+1 }}
                <input name="" type="button" value="选择" onclick='set_m_description("{{ $plan['description']  }}")'/>

              </li>
              <br>
              @endforeach
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="new_mission();">保存</a>
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

<!-- 编辑关注的任务 -->
<div class="models com_models bj_gz" id="bj_gz" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              编辑关注
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">
                <select class="sel_model" id="m_importance_u">
                  <!--option value="0">重要程度</option-->
                  <option value="1" title="必须要做">P1</option>
                  <option value="2" title="应该要做">P2</option>
                </select>
              </label>
              <div class="layui-input-block">
                <input id="m_description_u" type="text" name="title" lay-verify="title" autocomplete="off" placeholder="输入本周关注的任务" class="layui-input">
              </div>
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="edit_mission();">保存</a>
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

<!-- 添加状态指标 -->
<div class="models com_models tj_ztzb" id="tj_ztzb" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              添加状态指标
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">
                <select class="sel_model" id=s_state>
                  <!--option value="0">状态</option-->
                  <option value="1" title="优秀">优秀</option>
                  <option value="2" title="良好">良好</option>
                  <option value="3" title="一般">一般</option>
                  <option value="4" title="差">差</option>
                </select>
              </label>
              <div class="layui-input-block">
                <input type="text" id="s_description" lay-verify="title" autocomplete="off" placeholder="请输入状态指标" class="layui-input">
              </div>
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="new_stateindex();">保存</a>
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

<!-- 编辑状态指标 -->
<div class="models com_models bj_ztzb" id="bj_ztzb" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              编辑状态指标
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">
                <select class="sel_model" id="s_state_u">
                  <!--option value="0">状态</option-->
                  <option value="1" title="优秀">优秀</option>
                  <option value="2" title="良好">良好</option>
                  <option value="3" title="一般">一般</option>
                  <option value="4" title="差">差</option>
                </select>
              </label>
              <div class="layui-input-block">
                <input type="text" id="s_description_u" lay-verify="title" autocomplete="off" placeholder="请输入状态指标" class="layui-input">
              </div>
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="edit_stateindex();" >保存</a>
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

<!-- 信心指数 -->
<div class="models com_models tj_xxzs" id="tj_xxzs" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
          <form>
            <!-- 目标内容 -->
            <div class="dafen_titles com_titles">
              信心指数
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">
                <select class="sel_model" id="newconfidentindex">
                  <option value="0">信心指数</option>
                  <option value="1/10">1/10</option>
                  <option value="2/10">2/10</option>
                  <option value="3/10">3/10</option>
                  <option value="4/10">4/10</option>
                  <option value="5/10">5/10</option>
                  <option value="6/10">6/10</option>
                  <option value="7/10">7/10</option>
                  <option value="8/10">8/10</option>
                  <option value="9/10">9/10</option>
                  <option value="10/10">10/10</option>
                </select>
              </label>
              <div class="layui-input-block">
                <input type="text" id="description" name="description" lay-verify="title" autocomplete="off" placeholder="请输入修改原因" class="layui-input">
                <input type="hidden" id="oldconfidentindex" name="oldconfidentindex">
              </div>
            </div>
            <div class="layui-layer-btn layui-layer-btn- dafen_btn">
              <a class="layui-layer-btn models_qx">取消</a>
              <a class="layui-btn layui-btn-normal" onclick="edit_confidentindex();">保存</a>
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

<!-- 修改记录 -->
<div class="models com_models xxzs_jl" id="xxzs_jl" style="display: none;">
    <div class="modes_con">
      <div class="layui-layer-content">
        <div class="models_mid text-center">
            <div class="layui-form-item">
              <table class="layui-table" lay-skin="nob">
                <colgroup>
                  <col width="150">
                  <col width="150">
                </colgroup>
                <thead>
                  <tr>
                    <th colspan="3">修改记录</th>
                  </tr> 
                </thead>
                <tbody>
                  <tr>
                    <td>1989-10-14</td>
                    <td>6/10修改为8/10</td>
                    <td>修改错误了</td> 
                  </tr>
                  <tr>
                    <td>1989-10-14</td>
                    <td>6/10修改为8/10</td>
                    <td>修改错误了修改错误了修改错误了修改错误了修改错误了修改错误了修改错误了</td> 
                  </tr>
                </tbody>
              </table> 
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

<!-- 评论 -->
<div id="tj_pl" class="models pl_models" style="display: none;">
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

<script>
  /*公司职位*/
  // var ygsetting = {
  //     view: {
  //       addDiyDom: addDiyDoms
  //     },
  //   };

  // var ygnames =[
  //     { name:"财务部",job:"财务",
  //       children: [
  //         { name:"0",job:"主管"},
  //         { name:"1",job:"职员"},
  //         { name:"2",job:"职员"}
  //       ]},
  // ];

  // function addDiyDoms(treeId, treeNode) {
  //     if (treeNode.parentNode && treeNode.parentNode.id!=2) return;
  //     var aObj = $("#" + treeNode.tId + IDMark_A);
  //     var job = treeNode.job;
  //       var editStr = "<span class='demoIcon'><span class='wks'>"+job+"</span></span>";
  //       aObj.after(editStr);
  // }

  // $(document).ready(function(){
  //   /*员工名称*/
  //   $.fn.zTree.init($("#ygNameTree"), ygsetting, ygnames);
  // });

  // $.sidebarMenu($('.sidebar-menu'))
</script>

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
    /*一月份*/
    var setting = {
      view: {
        addDiyDom: addDiyDom,
        showIcon: false,
        fontCss: getFont,
        showLine: false,
        dblClickExpand: false,
      },
      callback: {
        onClick: onClick,
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

    var Otherssetting = {
      view: {
        addDiyDom: addDiyDomOther,
        showIcon: false,
        fontCss: getFont,
        showLine: false,
        dblClickExpand: false,
      },
      callback: {
        onClick: onClick,
      }
    };

    var zNodes = {!! $json_objective !!};
    console.log(zNodes);
    var others_zNodes = {!! $others_all['json_objective'] !!};

    function onClick(e,treeId, treeNode) {
      var zTree = $.fn.zTree.getZTreeObj(treeId);
      zTree.expandNode(treeNode);
    }
    
    function html_encode(str) { 
        var s = ""; 
        if (str.length == 0) return ""; 
        s = str.replace(/&/g, "&gt;"); 
        s = s.replace(/</g, "&lt;"); 
        s = s.replace(/>/g, "&gt;"); 
        s = s.replace(/ /g, "&nbsp;"); 
        s = s.replace(/\'/g, "&#39;"); 
        s = s.replace(/\"/g, "&quot;"); 
        s = s.replace(/\n/g, "<br>"); 
        return s; 
    }

    function set_m_description(str){
      // str = html_encode1(str);
      $('#m_description').val(str);
    }

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
        //alert(treeNode.name);
        //alert(html_encode(treeNode.name));
        
        scoreStr = "<span class='demoIcon'><span class='pf' title='评分' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='pop_score_div(this);'>评分</span></span>";
        addkrStr = "<span class='demoIcon'><span title='添加KR' onclick='pop_new_kr("+treeNode.id+")'>加KR</span></span>";
        if(treeNode.score==999){
          delStr = "";
          editStr = "<span class='demoIcon'><span class='icon iconfont icon-bianji xq' title='编辑' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='detail_objective(this);'></span></span>";
          if(treeNode.canDel==1){
            delStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-laji del' title='删除' description="+html_encode(treeNode.name)+" flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='pop_del_div(this);'></span></span>";
          }
        }else{
          editStr = "";
          delStr = "";
        }        
        commentStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-pinglun pl' title='评论' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick=pop_comment_div(this,'"+html_encode(treeNode.description)+"');></span></span>";
        aObj.after(scoreStr + editStr + delStr + commentStr + addkrStr);
      }

      if (treeNode.flag == "keyresult") {
        
        if(treeNode.score==999){
          
        }else{
          dafen = "<span class='df_bj'>"+treeNode.score+"</span>";
          aObj.before(dafen);
        }

        scoreStr = "<span class='demoIcon'><span class='pf' title='评分' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='pop_score_div(this);'>评分</span></span>";
        confidentindexStr = "<span class='demoIcon'><span class='xxzs' flag="+treeNode.flag+" itemid="+treeNode.id+" confidentindex='"+treeNode.confidentindex+"' onclick='pop_confidentindex_div(this);'>（"+treeNode.confidentindex+"）</span></span>";
        if(treeNode.score==999){
          delStr = "";
          editStr = "<span class='demoIcon'><span class='icon iconfont icon-bianji xq' title='编辑' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='detail_keyresult(this);'></span></span>";
          if(treeNode.canDel==1){
            delStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-laji del' title='删除' description="+html_encode(treeNode.name)+" flag="+treeNode.flag+" itemid="+treeNode.id+" onclick='pop_del_div(this);'></span></span>";
          }
        }else{
          editStr = "";
          delStr = "";
        }        
        commentStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-pinglun pl' title='评论' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick=pop_comment_div(this,'"+html_encode(treeNode.description)+"');></span></span>";
        aObj.after(scoreStr + confidentindexStr + editStr + delStr + commentStr);
      }
    }

    function addDiyDomOther(treeId, treeNode) {
      if (treeNode.parentNode && treeNode.parentNode.id!=2) return;
      var aObj = $("#" + treeNode.tId + IDMark_A);

      if (treeNode.flag == "objective") {

        if(treeNode.score==999){
          
        }else{
          dafen = "<span class='df_bj'>"+treeNode.score+"</span>";
          aObj.before(dafen);
        }
        // commentStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-pinglun pl' title='评论' onclick='pop_comment_div("+treeNode.id+");'></span></span>";
        commentStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-pinglun pl' title='评论' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick=pop_comment_div(this,'"+html_encode(treeNode.description)+"');></span></span>";
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
        commentStr = "<span class='demoIcon'><span class='mbxq icon iconfont icon-pinglun pl' title='评论' flag="+treeNode.flag+" itemid="+treeNode.id+" onclick=pop_comment_div(this,'"+html_encode(treeNode.description)+"');></span></span>";
        aObj.after(confidentindexStr + commentStr);
      }
    }

    // 显示关注...隐藏层
    function show_gz(str){

      tmpid = "gz_"+str;

      objDiv = $("#"+tmpid+""); 
      $(objDiv).css("display","block"); 
      // $(objDiv).css("left", event.clientX-210); 
      // $(objDiv).css("top", event.clientY-77); 

    }
    function hide_gz(str){
      // return false;
      tmpid = "gz_"+str;
      objDiv = $("#"+tmpid+""); 
      $(objDiv).css("display", "none"); 
    }

    function openFirstTreenode(){
        // 获取树对象
        var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
        /* 获取所有树节点 */
        var nodes = treeObj.transformToArray(treeObj.getNodes());
        // 关闭所有节点
        for (var i = 0, length_1 = nodes.length; i < length_1; i++) {
            treeObj.expandNode(nodes[i], false);//第二个参数为false证明是折叠
        }
        //展开第一级节点
        treeObj.expandNode(nodes[3], true);//第二个参数为true证明是展开
    }

    $(function(){
      $.fn.zTree.init($("#treeDemo"), setting, zNodes);
      // $.fn.zTree.init($("#myTreeDemo"), setting, zNodes);
      $.fn.zTree.init($("#others_tree"), Otherssetting, others_zNodes);

      openFirstTreenode();

      $("#my_mb .treeview a:contains('我的目标')").parent().addClass('active');
      $(".yg_sec").hide();
      $(".trees").hide();
      /*新增目标*/
      $(".add_mb").on("click",function(){
        $(".mb_models").fadeIn();
      })
      /*切换不同的日器选择*/
      $(".time_con .list").on("click",function(){
        $(this).addClass("active").siblings(".active").removeClass("active");
      })
       //日期确定
       $(".laydate-btns-confirm").on("click",function(){

       })

      document.onkeydown = function(e){  
        var ev = document.all ? window.event : e;
        if(ev.keyCode==13) {// 如（ev.ctrlKey && ev.keyCode==13）为ctrl+Center 触发
            // alert("huiche");
            if($('#tj_gz').css('display')=="block"){new_mission();}
            if($('#bj_gz').css('display')=="block"){edit_mission();}

            if($('#tj_jh').css('display')=="block"){new_plan();}
            if($('#bj_jh').css('display')=="block"){edit_plan();}

            if($('#tj_ztzb').css('display')=="block"){new_stateindex();}
            if($('#bj_ztzb').css('display')=="block"){edit_stateindex();}

            if($('#tj_mb').css('display')=="block"){new_objective();}
            if($('#bj_mb').css('display')=="block"){edit_objective();}

            if($('#tj_jg').css('display')=="block"){new_keyresult();}
            if($('#bj_jg').css('display')=="block"){edit_keyresult();}

            if($('#tj_xxzs').css('display')=="block"){edit_confidentindex();}

            if($('#tj_pl').css('display')=="block"){new_comment();}

            return false;
        }
      }

    })


    durationflag = '{{ $durationflag }}';
    duration = '{{ $duration }}';
	  weekdate = '{{ $weekdate }}';
	
	
    init_durationFlag();
    $("#duration-"+durationflag).addClass("layui-this");
    // if(durationflag==0)
    // {
    //   $("#duration-div-0").addClass("layui-show");
    //   $("#duration-0-"+duration).addClass("layui-this");
    //   $("#span_misson_duration").html("周");
    //   $("#span_plan_duration").html("周");      
    // }
    if(durationflag==1)
    {
      $("#duration-div-1").addClass("layui-show");
      $("#duration-1-"+duration).addClass("layui-this");
      // $("#span_misson_duration").html("月");
      // $("#span_plan_duration").html("月");
    }
    // if(durationflag==3)
    // {
    //   $("#duration-div-3").addClass("layui-show");
    //   $("#duration-3-"+duration).addClass("layui-this");
    //   // $("#span_misson_duration").html("月");
    //   // $("#span_plan_duration").html("月");
    // }
    if(durationflag==2)
    {
      $("#duration-div-2").addClass("layui-show");
      $("#duration-2-"+duration).addClass("layui-this");
      //$("#span_misson_duration").html("季度");
      //$("#span_plan_duration").html("季度");
    }

    $("#my_period_show").html($("#duration-"+durationflag+"-"+duration).html());
    $("#others_period_show").html($("#duration-"+durationflag+"-"+duration).html());
    
    // 初始化月度层
    function init_durationFlag0(){
      $("#duration-0-01").removeClass("layui-this");
      $("#duration-0-02").removeClass("layui-this");
      $("#duration-0-03").removeClass("layui-this");
      $("#duration-0-04").removeClass("layui-this");
      $("#duration-0-05").removeClass("layui-this");
      $("#duration-0-06").removeClass("layui-this");
      $("#duration-0-07").removeClass("layui-this");
      $("#duration-0-08").removeClass("layui-this");
      $("#duration-0-09").removeClass("layui-this");
      $("#duration-0-10").removeClass("layui-this");
      $("#duration-0-11").removeClass("layui-this");
      $("#duration-0-12").removeClass("layui-this");

      $("#duration-div-0").removeClass("layui-show");

    }
    
    // 初始化季度层
    function init_durationFlag1(){
      $("#duration-1-1").removeClass("layui-this");
      $("#duration-1-2").removeClass("layui-this");
      $("#duration-1-3").removeClass("layui-this");
      $("#duration-1-4").removeClass("layui-this");

      $("#duration-div-1").removeClass("layui-show");
    }

    // 初始化半年度层
    function init_durationFlag3(){
      //alert("init_durationFlag3");
      $("#duration-3-001").removeClass("layui-this");
      $("#duration-3-002").removeClass("layui-this");
      $("#duration-div-3").removeClass("layui-show");
    }

    // 初始化年层
    function init_durationFlag2(){
      $("#duration-2-2018").removeClass("layui-this");
      $("#duration-div-2").removeClass("layui-show");
    }

    // 初始化月度季度年度显示层
    function init_durationFlag(){
      // $("#duration-0").removeClass("layui-this");
      $("#duration-1").removeClass("layui-this");
      // $("#duration-3").removeClass("layui-this");
      $("#duration-2").removeClass("layui-this");

      // $("#duration-div-0").removeClass("layui-show");
      $("#duration-div-1").removeClass("layui-show");
      // $("#duration-div-3").removeClass("layui-show");
      $("#duration-div-2").removeClass("layui-show");
    }

    // 确定当前的季节
    function which_season(){
      var now   = new Date();
      var month = now.getMonth()+1;
      if(month<10){month="0"+month;}

      if(month=="03" || month=="04" || month=="05"){season = "1";}
      if(month=="06" || month=="07" || month=="08"){season = "2";}
      if(month=="09" || month=="10" || month=="11"){season = "3";}
      if(month=="12" || month=="01" || month=="02"){season = "4";}
      return season;
    }


    function setDurationFlag(index){
		// alert(index);
      // init_durationFlag();
      
      // $("#duration-"+index).addClass("layui-this");

      durationflag = index;
      
      // var now   = new Date();
      // var month = now.getMonth()+1;
      // if(month<10){month="0"+month;}

      // if(month=="03" || month=="04" || month=="05"){season = "1";}
      // if(month=="06" || month=="07" || month=="08"){season = "2";}
      // if(month=="09" || month=="10" || month=="11"){season = "3";}
      // if(month=="12" || month=="01" || month=="02"){season = "4";}
      
      season = which_season();
      // season = "1";
      // alert(season);

      // if(month=="01" || month=="02" || month=="03" || month=="04" || month=="05" || month=="06"){halfyear = "001";}
      // if(month=="07" || month=="08" || month=="09" || month=="10" || month=="11" || month=="12"){halfyear = "002";}

      var now   = new Date();
      var year  = now.getFullYear();
      // console.log(month + " "+season+" "+year);

      // if(index==0){
      //   duration = month;
      //   init_durationFlag0();
      //   $("#duration-0-"+duration).addClass("layui-this");
      // }
      if(index==1){
        duration = season;
        init_durationFlag1();
        $("#duration-1-"+duration).addClass("layui-this");
      }
      // if(index==3){
      //   duration = halfyear;
      //   init_durationFlag3();
      //   $("#duration-3-"+duration).addClass("layui-this");
      // }
      if(index==2){
        duration = year;
        $("#duration-2-"+duration).addClass("layui-this");
      }
      
	    weekdate = $("#weekdate").val();
      console.log("durationflag="+durationflag+" duration="+duration);
      window.location.href = "{{ route('objective.mine') }}" + "?durationflag=" + durationflag + "&duration=" + duration + "&weekdate=" + weekdate;
    }

    function setDuration(index){

      duration = index;
      // if(duration=="01" || duration=="02" || duration=="03" || duration=="04" || duration=="05" || duration=="06" || duration=="07" || duration=="08" || duration=="09" || duration=="10" || duration=="11" || duration=="12"){
      //   durationflag = "0";
      // }
      if(duration=="1" || duration=="2" || duration=="3" || duration=="4"){
        durationflag = "1";
      }
      // if(duration=="001" || duration=="002"){
      //   durationflag = "3";
      // }
      if(parseInt(duration)>=2018){
        durationflag = "2";
      }
      // alert('durationflag='+durationflag);
      
  	  weekdate = $("#weekdate").val();
        console.log("durationflag="+durationflag+" duration"+index);
        window.location.href = "{{ route('objective.mine') }}" + "?durationflag=" + durationflag + "&duration=" + duration + "&weekdate=" + weekdate;
      }

    // 评分
    function pop_score_div(btn){
      console.log($(btn).attr("flag")+" "+$(btn).attr("itemid"));

      flag = $(btn).attr("flag");
      itemid = $(btn).attr("itemid");

      if(flag=="objective"){$("#score_item").html("目标");}
      if(flag=="keyresult"){$("#score_item").html("关键结果");}
      
      $(".dafen_models").show();
    }

    // 评分
    function setscore(){
      
      var score=$("#score").val();
      if (score=="-1") {
        layer.msg("请选择分数",{time:1000});
        return false;
      }

      switch(flag)
      {
        case "objective":
          submit_url =  "{{ route('objective.score') }}";
          break;
        case "keyresult":
          submit_url =  "{{ route('keyresult.score') }}";
          break;
      }
      console.log(submit_url);
      // alert(submit_url);return false;
      $.ajax({
        type: "POST",
        url: submit_url,
        data: { id:itemid ,score : $("#score").val()},
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

    //目标新增
    function new_objective(){
      // alert("submit_user");
      var o_description = $("#o_description").val();
      
      console.log(o_description);
      console.log("durationflag="+durationflag+" duration="+duration);

      if (o_description.trim()=="") {
        layer.msg("目标不能为空",{time:1000});
        return false;
      }
      
      ajax_type = 'POST';
      submit_url = "{{ route('objective.store') }}";
      // submit_url = "{{ route('keyresult.store') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        //data: { name : name, pid : pid, status : status,'_token': "{{csrf_token()}}"},
        data: { o_description : o_description, durationflag : durationflag, duration:duration},
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
          
          $("#o_description_u").val(data.description);

          ajax_type = 'PATCH';
          //submit_url = updateurl;
          $(".bj_mb").show();

        },
      });
    }

    //目标编辑
    function edit_objective(){
      // alert("submit_user");
      var o_description = $("#o_description_u").val();
      
      console.log(o_description);

      if (o_description.trim()=="") {
        layer.msg("目标不能为空",{time:1000});
        return false;
      }
      
      ajax_type = 'POST';
      submit_url = "{{ route('objective.update') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { o_id : itemid, o_description : o_description},
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


    var pid="";
    //新增结果弹层
    function pop_new_kr(oid){
      pid=oid;

      $(".tj_jg").show();
    }

    // 关键结果新增
    function new_keyresult(){
      // alert("submit_user");
      var kr_description = $("#kr_description").val();

      if (kr_description.trim()=="") {
        layer.msg("关键结果不能为空",{time:1000});
        return false;
      }
      
      ajax_type = 'POST';
      // submit_url = "{{ route('objective.store') }}";
      submit_url = "{{ route('keyresult.store') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { kr_description : kr_description, pid:pid},
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

          //描述
          $("#kr_description_u").val(data.description);

          ajax_type = 'PATCH';
          //submit_url = updateurl;

          $(".bj_jg").show();
            
        },
      });
    }

    // 关键结果编辑
    function edit_keyresult(){
      // alert("submit_user");
      var kr_description = $("#kr_description_u").val();

      if (kr_description.trim()=="") {
        layer.msg("关键结果不能为空",{time:1000});
        return false;
      }

      ajax_type = 'POST';
      submit_url = "{{ route('keyresult.update') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { kr_id : itemid, kr_description : kr_description},
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

    //删除
    function delete_item(){
      switch(flag)
      {
        case "objective":
          geturl =  "{{ route('objective.delete') }}";
          break;
        case "keyresult":
          geturl =  "{{ route('keyresult.delete') }}";
          break;
        case "mission":
          geturl =  "{{ route('mission.delete') }}";
          break;
        case "plan":
          geturl =  "{{ route('plan.delete') }}";
          break;
        case "stateindex":
          geturl =  "{{ route('stateindex.delete') }}";
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
          layer.msg(data.msg);
          if(data.status=="1"){window.location.reload();}
        },
      });
    }

    // 删除弹层
    function pop_del_div(btn){
      flag = $(btn).attr("flag");
      itemid = $(btn).attr("itemid");
      description = $(btn).attr("description");

      $("#del_div_title").html("确认删除【"+description+"】？");

      $(".zjsc_models").show();
    }


    //新增修改信心指数层
    function pop_confidentindex_div(btn){
      flag = $(btn).attr("flag");
      itemid = $(btn).attr("itemid");
      confidentindex = $(btn).attr("confidentindex");

      $("#oldconfidentindex").val(confidentindex);
      $("#newconfidentindex").val(confidentindex);
      

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

    // 信心指数编辑
    function edit_confidentindex(){
      // alert("submit_user");
      var oldconfidentindex = $("#oldconfidentindex").val();
      var newconfidentindex = $("#newconfidentindex").val()
      var description = $("#description").val();

      if (newconfidentindex=="0") {
        layer.msg("信心指数不能为空",{time:1000});
        return false;
      }
      if (description.trim()=='') {
        layer.msg("请输入修改原因",{time:1000});
        return false;
      }

      ajax_type = 'POST';
      submit_url = "{{ route('keyresult.updateConfidentindex') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { okr_id : itemid, oldconfidentindex : oldconfidentindex, newconfidentindex : newconfidentindex, description : description},
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


    // 关注任务新增
    function new_mission(){
      // alert("submit_user");
      var m_description = $("#m_description").val();
      var m_importance = $("#m_importance").val();

      if (m_description.trim()=="") {
        layer.msg("本周关注的任务不能为空",{time:1000});
        return false;
      }
      if (m_importance=="0") {
        layer.msg("请选择重要程度",{time:1000});
        return false;
      }
      
      
      ajax_type = 'POST';
      // submit_url = "{{ route('objective.store') }}";
      submit_url = "{{ route('mission.store') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { durationflag : durationflag, duration:duration, m_description : m_description, m_importance  : m_importance},
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

    // 关注任务详情
    function detail_mission(btn){
      flag = $(btn).attr("flag");
      itemid = $(btn).attr("itemid");

      geturl =  "{{ route('mission.detail') }}";

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

          //描述
          $("#m_description_u").val(data.description);
          $("#m_importance_u").val(data.importance);

          ajax_type = 'PATCH';
          //submit_url = updateurl;

          $(".bj_gz").show();
            
        },
      });
    }

    // 关注任务编辑
    function edit_mission(){
      // alert("submit_user");
      var m_description = $("#m_description_u").val();
      var m_importance = $("#m_importance_u").val();
      
      if (m_description.trim()=="") {
        layer.msg("本周关注的任务不能为空",{time:1000});
        return false;
      }
      if (m_importance=="0") {
        layer.msg("请选择重要程度",{time:1000});
        return false;
      }

      ajax_type = 'POST';
      submit_url = "{{ route('mission.update') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { id : itemid, m_description : m_description,m_importance:m_importance},
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


    // 未来四周计划新增
    function new_plan(){
      // alert("submit_user");
      var p_description = $("#p_description").val();

      if (p_description.trim()=="") {
        layer.msg("未来四周计划不能为空",{time:1000});
        return false;
      }
      
      ajax_type = 'POST';
      // submit_url = "{{ route('objective.store') }}";
      submit_url = "{{ route('plan.store') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { durationflag : durationflag, duration:duration, p_description : p_description},
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

    // 未来四周计划详情
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

          //描述
          $("#p_description_u").val(data.description);

          ajax_type = 'PATCH';
          //submit_url = updateurl;

          $(".bj_jh").show();
            
        },
      });
    }

    // 未来四周计划编辑
    function edit_plan(){
      // alert("submit_user");
      var p_description = $("#p_description_u").val();

      if (p_description.trim()=="") {
        layer.msg("未来四周计划不能为空",{time:1000});
        return false;
      }

      ajax_type = 'POST';
      submit_url = "{{ route('plan.update') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { id : itemid, p_description : p_description},
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


    // 状态指标新增
    function new_stateindex(){
      // alert("submit_user");
      var s_description = $("#s_description").val();
      var s_state = $("#s_state").val();

      if (s_description.trim()=="") {
        layer.msg("状态指标不能为空",{time:1000});
        return false;
      }
      if (s_state=="0") {
        layer.msg("请选择状态",{time:1000});
        return false;
      }      
      
      ajax_type = 'POST';
      // submit_url = "{{ route('objective.store') }}";
      submit_url = "{{ route('stateindex.store') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { durationflag : durationflag, duration:duration, s_description : s_description, s_state : s_state},
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

    // 状态指标详情
    function detail_stateindex(btn){
      flag = $(btn).attr("flag");
      itemid = $(btn).attr("itemid");

      geturl =  "{{ route('stateindex.detail') }}";

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

          //描述
          $("#s_description_u").val(data.description);
          $("#s_state_u").val(data.state);

          ajax_type = 'PATCH';
          //submit_url = updateurl;

          $(".bj_ztzb").show();
            
        },
      });
    }

    // 状态指标编辑
    function edit_stateindex(){
      // alert("submit_user");
      var s_description = $("#s_description_u").val();
      var s_state = $("#s_state_u").val();

      if (s_description.trim()=="") {
        layer.msg("状态指标不能为空",{time:1000});
        return false;
      }
      if (s_state=="0") {
        layer.msg("请选择状态",{time:1000});
        return false;
      }  

      ajax_type = 'POST';
      submit_url = "{{ route('stateindex.update') }}";

      $.ajax({
        type: ajax_type,
        url: submit_url,
        data: { id : itemid, s_description : s_description, s_state : s_state},
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
            // window.location.reload();

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

  	layui.use('laydate', function(){
  	  var laydate = layui.laydate;
  	  
  	  //执行一个laydate实例
  	  laydate.render({
  		elem: '#weekdate' //指定元素
  	  });
  	});
  	
  	if(weekdate==""){
  		$("#weekdate").val(getNowFormatDate());
  	}else{
  		$("#weekdate").val(weekdate);
  	}
	
	  function getNowFormatDate() {
        var date = new Date();
        var seperator1 = "-";
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var strDate = date.getDate();
        if (month >= 1 && month <= 9) {
            month = "0" + month;
        }
        if (strDate >= 0 && strDate <= 9) {
            strDate = "0" + strDate;
        }
        var currentdate = year + seperator1 + month + seperator1 + strDate;
        return currentdate;
    }
</script>
<script type="text/javascript" src="/okr/js/main.js"></script>
</body>
<!-- Download From www.exet.tk-->
</html>