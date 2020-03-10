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


  <div id="body-wrapper">
    <!-- Wrapper for the radial gradient background -->
    <aside class="main-sidebar">
      <section  class="sidebar">
        <ul class="sidebar-menu">
          <!--li class="header"></li-->
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

    <!-- End #sidebar -->
    <div id="main-content">
      <div class="h2Title bg_none pd_0">
        成员目标
      </div>
      <!-- End .clear -->

        <div class="content-box clearfix bg_none">

          <div class="layui-row layui-col-space10">

            <!-- 日期选择 -->
            <div class="layui-col-xs12 rp">
              <!-- 老的日期选择 -->
              <div class="time_con" style="display: none;">
                <select id="others_seasonperiod" class="list" onchange="selectOthersPeriod('1',this.value);">
                  <option value="1000">季度</option>
                  <option value="1" title="春季(3-5)">春季(3-5)</option>
                  <option value="2" title="暑假(6-8)">暑假(6-8)</option>
                  <option value="3" title="秋季(9-11)">秋季(9-11)</option>
                  <option value="4" title="寒假(12-2)">寒假(12-2)</option>
                </select>

                <select id="others_yearperiod" class="list" onchange="selectOthersPeriod('2',this.value);">
                  <option value="10000">年度</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                </select>
                
                <!-- <input name="others_weekdate" type="text" id="others_weekdate" class="layui-smallinput layui-input" style="width: 150px;height: 30px;display: inline-block;" /> -->
              </div>

              <!-- 日期选择 -->
              <div class="bg_fff">
                <ul>
                  <li class="bold_f">
                    年份：
                    <ul class="layui-inline">
                      <!--li class="layui-inline pd_10 active">2019</li-->
                      <li id="duration-2-2020" onclick="selectOthersPeriod('2',2020);" class="layui-inline pd_10">2020</li>
                      <li  id="duration-2-2019" onclick="selectOthersPeriod('2',2019);" class="layui-inline pd_10">2019</li>
                    </ul>
                  </li>
                  <li class="bold_f">季度：
                    <ul class="layui-inline">
                      <li id="duration-1-1" onclick="selectOthersPeriod('1',1);" class="layui-inline pd_10">春季课（3-5）</li>
                      <li id="duration-1-2" onclick="selectOthersPeriod('1',2);" class="layui-inline pd_10">暑假课（6-8）</li>
                      <li id="duration-1-3" onclick="selectOthersPeriod('1',3);" class="layui-inline pd_10">秋季课（9-11）</li>
                      <li id="duration-1-4" onclick="selectOthersPeriod('1',4);" class="layui-inline pd_10">寒假课（12-2）</li>
                    </ul>
                  </li>
                  <li class="bold_f">时间：
                    <input name="others_weekdate" type="text" id="others_weekdate" class="layui-smallinput layui-input" style="width: 150px;height: 25px;display: inline-block;" />
                  </li>
                </ul>
              </div>

              <div class="okr_mb">
                {{ $arr_others['name'] }}的OKR（<span id="others_period_show"></span>）
              </div>
              <div class="my_job">
                <div class="text-center c_333">{{ $arr_others['name'] }} <br> <span class="c_999">{{ $arr_others['position_name'] }}</span></div>
              </div>

              <!-- 任务和目标 -->
              <div class="layui-col-xs12 rp">
                <div class="layui-row layui-col-space10">
                  <div class="layui-col-xs6">
                    <div class="bg_fff">
                      <div class="titles">
                        本<span id="others_span_misson_duration">周</span>关注的任务 ({{ substr($arr_others_weekSatrtAndEnd[0],5,5) }} ~ {{ substr($arr_others_weekSatrtAndEnd[1],5,5) }})

                        <div class="layui-inline col_666 ft_12 mg_l78">（P1必须做，P2应该做）</div>

                        <div class="my_target" title="操作历史">
                          <a href="{{URL::action('MissionController@missionlog',['weekdate'=>$others_weekdate,'userid'=>$othersId])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                        </div>

                      </div>
                      <div class="contains top_border">
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
                    <div class="bg_fff">
                      <div class="titles">
                        目标

                        <div class="my_target" title="操作历史">
                          <a href="{{URL::action('ObjectiveController@mineObjectivelog',['durationflag'=>$others_perioditem,'duration'=>$others_period,'userid'=>$othersId])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                        </div>
                      </div>
                      <div class="contains top_border">
                        <ul id="others_tree" class="ztree">
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- 计划和指标 -->
              <div class="layui-col-xs12 rp">
                <div class="layui-row layui-col-space10">
                  <div class="layui-col-xs6">
                    <div class="bg_fff">
                      <div class="titles">
                        未来四<span id="others_span_plan_duration">周</span>计划

                        <div class="my_target" title="操作历史">
                          <a href="{{URL::action('PlanController@planlog',['weekdate'=>$others_weekdate,'userid'=>$othersId])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                        </div>
                      </div>
                      <div class="contains top_border">
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
                    <div class="bg_fff">
                      <div class="titles">
                        状态指标

                        <div class="layui-inline mg_l78">
                          <span class="layui-badge-dot layui-bg-green"></span>优秀
                          <span class="layui-badge-dot layui-bg-cyan"></span>良好
                          <span class="layui-badge-dot layui-bg-blue"></span>一般
                          <span class="layui-badge-dot layui-bg-gray"></span>差
                        </div>

                        <div class="my_target" title="操作历史">
                          <a href="{{URL::action('StateindexController@stateindexlog',['durationflag'=>$others_perioditem,'duration'=>$others_period,'userid'=>$othersId])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                        </div>

                      </div>
                      <div class="contains top_border">
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

          <div style="background-color: #fff; padding: 5px 0;">
            <div style="border: 1px solid #ddd;margin-top: 5px;margin-bottom:5px;"></div>
          </div>

          <div class="layui-row layui-col-space10">

            <div class="layui-col-xs12 rp">
              <!-- 老的日期选择 -->
              <div class="time_con rp" style="display: none;">
                <select id="my_seasonperiod" class="list active" onchange="selectMyPeriod('1',this.value);">
                  <option value="1000">季度</option>
                  <option value="1" title="春季(3-5)">春季(3-5)</option>
                  <option value="2" title="暑假(6-8)">暑假(6-8)</option>
                  <option value="3" title="秋季(9-11)">秋季(9-11)</option>
                  <option value="4" title="寒假(12-2)">寒假(12-2)</option>
                </select>

                <select id="my_yearperiod" class="list" onchange="selectMyPeriod('2',this.value);">
                  <option value="10000">年度</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                </select>
                
                <!-- <input name="my_weekdate" type="text" id="my_weekdate" class="layui-smallinput layui-input" style="width: 200px;display: inline-block;" /> -->
              </div>

              <!-- 日期选择 -->
              <div class="bg_fff">
                <ul>
                  <li class="bold_f">
                    年份：
                    <ul class="layui-inline">
                      <!--li class="layui-inline pd_10 active">2019</li-->
                      <li id="myduration-2-2020" onclick="selectMyPeriod('2',2020);" class="layui-inline pd_10">2020</li>
                      <li  id="myduration-2-2019" onclick="selectMyPeriod('2',2019);" class="layui-inline pd_10">2019</li>
                    </ul>
                  </li>
                  <li class="bold_f">季度：
                    <ul class="layui-inline">
                      <li id="myduration-1-1" onclick="selectMyPeriod('1',1);" class="layui-inline pd_10">春季课（3-5）</li>
                      <li id="myduration-1-2" onclick="selectMyPeriod('1',2);" class="layui-inline pd_10">暑假课（6-8）</li>
                      <li id="myduration-1-3" onclick="selectMyPeriod('1',3);" class="layui-inline pd_10">秋季课（9-11）</li>
                      <li id="myduration-1-4" onclick="selectMyPeriod('1',4);" class="layui-inline pd_10">寒假课（12-2）</li>
                    </ul>
                  </li>
                  <li class="bold_f">时间：
                    <input name="my_weekdate" type="text" id="my_weekdate" class="layui-smallinput layui-input" style="width: 150px;height: 25px;display: inline-block;" />
                  </li>
                </ul>
              </div>

              <!-- 部门okr -->
              <div class="layui-row layui-col-space10">
                <div class="okr_mb">
                  <span id="dptname">部门</span>的OKR（<span id="leader_period_show"></span>）
                </div>
              </div>

              <div class="layui-col-xs12 rp">
                  <div class="layui-row layui-col-space10">
                    <div class="layui-col-xs6">
                      <div class="bg_fff">
                        <div class="titles">
                          本<span id="leader_span_misson_duration">周</span>关注的任务 ({{ substr($arr_my_weekSatrtAndEnd[0],5,5) }} ~ {{ substr($arr_my_weekSatrtAndEnd[1],5,5) }})

                          <div class="layui-inline col_666 ft_12 mg_l78">（P1必须做，P2应该做）</div>
                          @if($arr_leader['id']!==session('idUser'))
                          <div class="my_target" title="操作历史">
                            <a href="{{URL::action('MissionController@missionlog',['weekdate'=>$my_weekdate,'userid'=>$arr_leader['id']])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                          </div>
                          @endif
                        </div>
                        <div class="contains top_border">
                          <ul>
                            @if($arr_leader['id']!==session('idUser'))
                            @foreach ($leader_all['arr_mission'] as $mission)
                              <li>P{{ $mission['importance']  }}：{{ $mission['description']  }}
                                <div class="this_cz">
                                  <span class="mbxq icon iconfont icon-pinglun" title="评论" flag="mission" itemid="{{ $mission['id'] }}" onclick="pop_comment_div(this,'{{ $mission['description'] }}')"></span>
                                </div>
                              </li>
                            @endforeach
                            @endif
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="layui-col-xs6">
                      <div class="bg_fff">
                        <div class="titles">
                          目标
                          @if($arr_leader['id']!==session('idUser'))
                          <div class="my_target" title="操作历史">
                            <a href="{{URL::action('ObjectiveController@mineObjectivelog',['durationflag'=>$my_perioditem,'duration'=>$my_period,'userid'=>$arr_leader['id']])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                          </div>
                          @endif
                        </div>
                        <div class="contains top_border">
                          <ul id="leader_tree" class="ztree">
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="layui-col-xs12 rp">
                <div class="layui-row layui-col-space10">
                  <div class="layui-col-xs6">
                    <div class="bg_fff">
                      <div class="titles">
                        未来四<span id="leader_span_plan_duration">周</span>计划
                        @if($arr_leader['id']!==session('idUser'))
                        <div class="my_target" title="操作历史">
                          <a href="{{URL::action('PlanController@planlog',['weekdate'=>$my_weekdate,'userid'=>$arr_leader['id']])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                        </div>
                        @endif
                      </div>
                      <div class="contains top_border">
                        <ul>
                          @if($arr_leader['id']!==session('idUser'))
                          @foreach ($leader_all['arr_plan'] as $plan)
                            <li>
                              {{ $plan['description']  }}
                              <div class="this_cz">
                                <span class="mbxq icon iconfont icon-pinglun" title="评论" flag="mission" itemid="{{ $plan['id'] }}" onclick="pop_comment_div(this,'{{ $plan['description'] }}')"></span>
                              </div>
                            </li>
                          @endforeach
                          @endif
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="layui-col-xs6">
                    <div class="bg_fff">
                      <div class="titles">
                        状态指标

                        <div class="layui-inline mg_l78">
                          <span class="layui-badge-dot layui-bg-green"></span>优秀
                          <span class="layui-badge-dot layui-bg-cyan"></span>良好
                          <span class="layui-badge-dot layui-bg-blue"></span>一般
                          <span class="layui-badge-dot layui-bg-gray"></span>差
                        </div>
                        @if($arr_leader['id']!==session('idUser'))
                        <div class="my_target" title="操作历史">
                          <a href="{{URL::action('StateindexController@stateindexlog',['durationflag'=>$my_perioditem,'duration'=>$my_period,'userid'=>$arr_leader['id']])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                        </div>
                        @endif
                      </div>
                      <div class="contains">
                        <ul>
                          @if($arr_leader['id']!==session('idUser'))
                          @foreach ($leader_all['arr_stateindex'] as $stateindex)
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
                          @endif
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div style="background-color: #fff; padding: 20px 0;">
                <hr>
              </div>

              <!-- 我的OKR -->
              <div class="layui-row layui-col-space10">
                <div class="okr_mb">
                  我的OKR（<span id="my_period_show"></span>）
                </div>
              </div>

              <div class="layui-col-xs12 rp">
                  <div class="layui-row layui-col-space10">
                    <div class="layui-col-xs6">
                      <div class="bg_fff">
                        <div class="titles">
                          本<span id="my_span_misson_duration">周</span>关注的任务 ({{ substr($arr_my_weekSatrtAndEnd[0],5,5) }} ~ {{ substr($arr_my_weekSatrtAndEnd[1],5,5) }})

                          <div class="layui-inline col_666 ft_12 mg_l78">（P1必须做，P2应该做）</div>

                          <div class="my_target" title="操作历史">
                            <a href="{{URL::action('MissionController@missionlog',['weekdate'=>$my_weekdate])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                          </div>

                        </div>
                        <div class="contains top_border">
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
                      <div class="bg_fff">
                        <div class="titles">
                          目标

                          <div class="my_target" title="操作历史">
                            <a href="{{URL::action('ObjectiveController@mineObjectivelog',['durationflag'=>$my_perioditem,'duration'=>$my_period])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                          </div>

                        </div>
                        <div class="contains top_border">
                          <ul id="my_tree" class="ztree">
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="layui-col-xs12 rp">
                <div class="layui-row layui-col-space10">
                  <div class="layui-col-xs6">
                    <div class="bg_fff">
                      <div class="titles">
                        未来四<span id="my_span_plan_duration">周</span>计划

                        <div class="my_target" title="操作历史">
                          <a href="{{URL::action('PlanController@planlog',['weekdate'=>$my_weekdate])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                        </div>

                      </div>
                      <div class="contains top_border">
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
                    <div class="bg_fff">
                      <div class="titles">
                        状态指标

                        <div class="layui-inline mg_l78">
                          <span class="layui-badge-dot layui-bg-green"></span>优秀
                          <span class="layui-badge-dot layui-bg-cyan"></span>良好
                          <span class="layui-badge-dot layui-bg-blue"></span>一般
                          <span class="layui-badge-dot layui-bg-gray"></span>差
                        </div>

                        <div class="my_target" title="操作历史">
                          <a href="{{URL::action('StateindexController@stateindexlog',['durationflag'=>$others_perioditem,'duration'=>$others_period])}}" target="_blank"><img src="/okr/resources/images/lishijilu.png" /></a>
                        </div>

                      </div>
                      <div class="contains top_border">
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

            </div>

          </div>
        </div>
    </div>
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

<script type="text/javascript">
    /*公司职位*/
    // var ygsetting = {
    //     view: {
    //       addDiyDom: addDiyDoms,
    //       showLine: false,
    //     },
    //   };
  
    // var ygnames = {!! $json_allUserDept !!};

  

   // var YGzNodes =[
   //    { id:1, pId:0, name:"研发部"},
   //    { id:11, userid:11, pId:1, name:"程丹","position_name":"测试工程师","click":"youClick('11')"},
   //    { id:12, pId:1, name:"北京办"},
   //    { id:121, userid:121, pId:12, name:"李彤","position_name":"flash","click":"youClick('121')"},
   //    { id:122, userid:122, pId:12, name:"陈晓刚","position_name":"php","click":"youClick('122')"},
   //    { id:13, pId:1, name:"设计组"},
   //    { id:131, userid:131, pId:13, name:"下哦你","position_name":"ps","click":"youClick('131')"},
   //    { id:132, userid:132, pId:13, name:"路径","position_name":"pps","click":"youClick('132')"},
   //  ];

    // var YGzNodes =[
    //     { id:1, pId:0, name:"研发部"},
    //     { id:12, pId:1, name:"北京办"},
    //     { id:13, pId:1, name:"设计组"},

    //     { id:11, userid:11, pId:1, name:"程丹","position_name":"测试工程师","click":"youClick('11')"},

    //     { id:121, userid:121, pId:12, name:"李彤","position_name":"flash","click":"youClick('121')"},
    //     { id:122, userid:122, pId:12, name:"陈晓刚","position_name":"php","click":"youClick('122')"},

    //     { id:131, userid:131, pId:13, name:"下哦你"},
    //     { id:132, userid:132, pId:13, name:"路径","position_name":"pps","click":"youClick('132')"},
    // ];

    var YGzNodes = {!! $json_allUserDept !!};

    function addDiyDoms(treeId, treeNode) {
        // if (treeNode.parentNode && treeNode.parentNode.id!=2) return;
        var aObj = $("#" + treeNode.tId + IDMark_A);
        var job = (typeof(treeNode.position_name) == "undefined") ? ("") : (treeNode.position_name);
        var editStr = "<span class='demoIcon'><span class='wks'>"+job+"</span></span>";
        aObj.after(editStr);
    }

    // 给刚点击的人加样式
    function setFontCss(treeId, treeNode) {
      return treeNode.userid == othersId ? {color:"#209ee4"} : {};
      // console.log(treeId + "  " + treeNode.userid + "  " + treeNode.id);
      // if(treeNode.userid=='24')alert("1111111111");
      // return treeNode.userid=='24' ? { color: "red"} : {};
      // return treeNode.userid=='24' ? { color: "red" } : {};

      // fontCss: { 'color': 'blue', 'font-family': '微软雅黑' };
      // return {color:"#209ee4"};
    };

    var YGsetting = {
      view: {
        addDiyDom: addDiyDoms,
        selectedMulti: false,
        fontCss: setFontCss,
        dblClickExpand: false,
        showLine: false,
      },
      data: {
        // key: {
        //   title:"t"
        // },
        simpleData: {
          enable: true
        }
      },
      callback: {
        onClick: onClick
        // beforeClick: beforeClick,
        // beforeCollapse: beforeCollapse,
        // beforeExpand: beforeExpand,
        // onCollapse: onCollapse,
        // onExpand: onExpand
      }
    };

    $(document).ready(function(){
        /*员工名称*/
        // $.fn.zTree.init($("#ygNameTree"), ygsetting, ygnames);

        
        // var setting = {
        //   view: {
        //     addDiyDom: addDiyDoms,
        //     fontCss: setFontCss,
        //     showLine: false,
        //   }
        // };
        // $.fn.zTree.init($("#ygNameTree"), setting, ygnames);

        // 打开当前员工的部门
        othersId = "{{ $arr_others['id'] }}";
        
        // for (var i=0;i<ygnames.length;i++) {
        //   for (var r=0;r<ygnames[i].children.length;r++) {
        //     if (othersId == ygnames[i].children[r].id) {
        //       ygnames[i].open="true";
        //       // ygnames[i].children[r].view.fontCss = {color:"red"};
        //       $.fn.zTree.init($("#ygNameTree"), setting, ygnames);
        //     } 
        //   }
        // }



        $.fn.zTree.init($("#ygNameTree"), YGsetting, YGzNodes);

        // 展开
        // zTree_Menu = $.fn.zTree.getZTreeObj("ygNameTree");
        // var node = zTree_Menu.getNodeByParam("id", othersIdPid );
        // // zTree_Menu.selectNode(node,true);//指定选中ID的节点
        // zTree_Menu.expandNode(node, true, false);//指定选中ID节点展

        // if($("#keyword").val()!="")openAllTreenode();

        if(othersId!=""){
          for (var i=0;i<YGzNodes.length;i++) {
              if (othersId == YGzNodes[i].userid) {
                  othersIdPid = YGzNodes[i].pId;
                  // alert(othersIdPid);
                  break;
              }
          }
          zTree_Menu = $.fn.zTree.getZTreeObj("ygNameTree");
          var node = zTree_Menu.getNodeByParam("id", othersIdPid );
          // zTree_Menu.selectNode(node,true);//指定选中ID的节点
          zTree_Menu.expandNode(node, true, false);//指定选中ID节点展
        }

    });
    $.sidebarMenu($('.sidebar-menu'));

    function openAllTreenode(){

        // 获取树对象
        var treeObj = $.fn.zTree.getZTreeObj("ygNameTree");
        /* 获取所有树节点 */
        var nodes = treeObj.transformToArray(treeObj.getNodes());
        console.log(nodes);
        // 展开除第一级之外的其他节点
        for (var i = 0, length_1 = nodes.length; i < length_1; i++) {
            if(typeof(nodes[i].userid) != "undefined"){
                console.log(nodes[i].userid);
                var node = treeObj.getNodeByParam("id", nodes[i].pId );
                treeObj.expandNode(node, true, false);//指定选中ID节点展
            }
        }

    }

    function onClick(e,treeId, treeNode) {
      var zTree = $.fn.zTree.getZTreeObj(treeId);
      zTree.expandNode(treeNode);
    }
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
   
    var my_zNodes = {!! $my_all['json_objective'] !!};
    var others_zNodes = {!! $others_all['json_objective'] !!};
    var leader_zNodes = '';
    @if($arr_leader['id']!==session('idUser'))
    leader_zNodes = {!! $leader_all['json_objective'] !!};
    @endif
    
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

    $(function(){
      // $('aside').style.height = $('body').style.height;
      $.fn.zTree.init($("#my_tree"), setting, my_zNodes);
      $.fn.zTree.init($("#others_tree"), setting, others_zNodes);
      $.fn.zTree.init($("#leader_tree"), setting, leader_zNodes);
      

      $("#cy_mb .treeview a:contains('成员目标')").parent().addClass('active');

      // 显示部门名称
      $("#dptname").html("{{ $arr_leader['dptname'] }}");

      document.onkeydown = function(e){  
        var ev = document.all ? window.event : e;
        if(ev.keyCode==13) {// 如（ev.ctrlKey && ev.keyCode==13）为ctrl+Center 触发
            if($('#tj_pl').css('display')=="block"){new_comment();}

            return false;
        }
      }
    })

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

    my_perioditem = "{{ $my_perioditem }}";
    my_period = "{{ $my_period }}";
    others_perioditem = "{{ $others_perioditem }}";
    others_period = "{{ $others_period }}";
    othersId = "{{ $arr_others['id'] }}";
	
    my_weekdate = "{{ $my_weekdate }}";
    others_weekdate = "{{ $others_weekdate }}";

    // 初始化日期选择
    function initPerild(){

        $("#my_seasonperiod").removeClass("active");
        $("#my_seasonperiod").val(1000);
        $("#my_yearperiod").removeClass("active");
        $("#my_yearperiod").val(10000);

        // $("#"+my_perioditem+"period").addClass("active");
        if (my_perioditem=="1"){
          $("#my_seasonperiod").addClass("active");
          $("#my_seasonperiod").val(my_period);
          $("#my_period_show").html($("#my_seasonperiod").find("option:selected").text());
          $("#leader_period_show").html($("#my_seasonperiod").find("option:selected").text());
          
          // $("#my_span_misson_duration").html("月");
          // $("#my_span_plan_duration").html("月");
        }
        if (my_perioditem=="2"){
          $("#my_yearperiod").addClass("active");
          $("#my_yearperiod").val(my_period);
          $("#my_period_show").html($("#my_yearperiod").find("option:selected").text());
          $("#leader_period_show").html($("#my_yearperiod").find("option:selected").text());
          
          // $("#my_span_misson_duration").html("季度");
          // $("#my_span_plan_duration").html("季度");
        }

        $("#others_seasonperiod").removeClass("active");
        $("#others_seasonperiod").val(1000);
        $("#others_yearperiod").removeClass("active");
        $("#others_yearperiod").val(10000);
        
        $("#"+others_perioditem+"period").addClass("active");

        if (others_perioditem=="1"){
          $("#others_seasonperiod").addClass("active");
          // console.log("others_period="+others_period);
          $("#others_seasonperiod").val(others_period);
          $("#others_period_show").html($("#others_seasonperiod").find("option:selected").text());
          // $("#others_span_misson_duration").html("月");
          // $("#others_span_plan_duration").html("月");
        }
        if (others_perioditem=="2"){
          $("#others_yearperiod").addClass("active");
          $("#others_yearperiod").val(others_period);
          $("#others_period_show").html($("#others_yearperiod").find("option:selected").text());
          // $("#others_span_misson_duration").html("季度");
          // $("#others_span_plan_duration").html("季度");
        }

        // 20200306新增，适应修改成平铺的样式
        // console.log("others_period="+others_period);
        // console.log("others_perioditem="+others_perioditem);

        $("#duration-"+others_perioditem+"-"+others_period).addClass("active");
        $("#myduration-"+my_perioditem+"-"+my_period).addClass("active");

    }

    initPerild();

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

    // 我的日期选择确定
    function selectMyPeriod(selectedperioditem,selectedperiod){
      console.log(selectedperioditem + " " +selectedperiod);

      my_perioditem=selectedperioditem;
      my_period=selectedperiod;

      my_weekdate = $("#my_weekdate").val();
      others_weekdate = $("#others_weekdate").val();
	  
      
      if(selectedperiod==1000 || selectedperiod==10000){return false;}
      window.location.href = "{{ route('objective.others') }}" + "?keyword={{ $keyword }}&othersId=" + othersId +  "&my_perioditem=" + my_perioditem + "&my_period=" + my_period + "&my_weekdate=" + my_weekdate +  "&others_perioditem=" + others_perioditem + "&others_period=" + others_period + "&others_weekdate=" + others_weekdate;
    }

    // 其他人的日期选择确定
    function selectOthersPeriod(selectedperioditem,selectedperiod){
      console.log(selectedperioditem + " " +selectedperiod);

      others_perioditem=selectedperioditem;
      others_period=selectedperiod;
	  
      my_weekdate = $("#my_weekdate").val();
      others_weekdate = $("#others_weekdate").val();

      if(selectedperiod==1000 || selectedperiod==10000){return false;}
      window.location.href = "{{ route('objective.others') }}" + "?keyword={{ $keyword }}&othersId="  + othersId +  "&my_perioditem=" + my_perioditem + "&my_period=" + my_period + "&my_weekdate=" + my_weekdate +  "&others_perioditem=" + others_perioditem + "&others_period=" + others_period + "&others_weekdate=" + others_weekdate;
    }

    function keywordSearch(){
      var keyword = $("#keyword").val();

      // if (!keyword) {
      //     layer.msg("请输入条件",{time:1000});
      //     return false;
      // }
      url = "{{ route('objective.others') }}";
	  
      my_weekdate = $("#my_weekdate").val();
      others_weekdate = $("#others_weekdate").val();

      window.location.href = "{{ route('objective.others') }}" + "?keyword="+keyword+"&othersId="  + othersId +  "&my_perioditem=" + my_perioditem + "&my_period=" + my_period + "&my_weekdate=" + my_weekdate +  "&others_perioditem=" + others_perioditem + "&others_period=" + others_period + "&others_weekdate=" + others_weekdate;
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
	  
      my_weekdate = $("#my_weekdate").val();
      others_weekdate = $("#others_weekdate").val();
	  
      window.location.href = "{{ route('objective.others') }}" + "?keyword="+keyword+"&othersId="  + othersId +  "&my_perioditem=" + my_perioditem + "&my_period=" + my_period + "&my_weekdate=" + my_weekdate +  "&others_perioditem=" + others_perioditem + "&others_period=" + others_period + "&others_weekdate=" + others_weekdate;
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
      if(cansubmit == 0){return false;}
      comment = $("#comment_input").val();
     
      console.log(comment);
      
      // return false;

      if (comment.trim()=="") {
        layer.msg("请输入评论内容",{time:1000});
        return false;
      }

      ajax_type = 'POST';
      submit_url = "{{ route('comment.store') }}";
      cansubmit = 0;
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
	
  	layui.use('laydate', function(){
  	  var laydate = layui.laydate;
  	  
  	  //执行一个laydate实例
  	  laydate.render({
  		  elem: '#my_weekdate' //指定元素
        ,done: function(value, date, endDate){
            selectMyPeriod(my_perioditem,my_period);
          }
  	  });
  	  laydate.render({
  		  elem: '#others_weekdate' //指定元素
        ,done: function(value, date, endDate){
            selectOthersPeriod(others_perioditem,others_period)
          }
  	  });
  	});
  	
  	if(my_weekdate==""){
  		$("#my_weekdate").val(getNowFormatDate());
  	}else{
  		$("#my_weekdate").val(my_weekdate);
  	}
  	
  	if(others_weekdate==""){
  		$("#others_weekdate").val(getNowFormatDate());
  	}else{
  		$("#others_weekdate").val(others_weekdate);
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
