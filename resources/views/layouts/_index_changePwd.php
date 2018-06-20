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
                    原始密码： <input type="password" id="oldpwd" name="oldpwd" lay-verify="identity" placeholder="填写原始密码" autocomplete="off" class="layui-input bm_name">
                    </td>
                  </tr>
                  <tr class="text-center">
                    <td style="width: 100%">
                    修改密码： <input type="password" id="newpwd" name="newpwd" lay-verify="identity" placeholder="填写新密码" autocomplete="off" class="layui-input new_pass"><span class="xs" style="position: absolute;right: 90px;cursor: pointer;">显示密码</span>
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
          <a class="layui-layer-btn0" onclick="changePwd();">保存</a>
          <a class="layui-layer-btn1">取消</a>
        </div>
        <span class="layui-layer-resize"></span>
      </div>
    </div>