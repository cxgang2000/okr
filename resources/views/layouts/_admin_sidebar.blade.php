		<aside class="main-sidebar">
            <section  class="sidebar">
              <ul class="sidebar-menu">
                <li class="header"></li>
                <li class="treeview">
                  <a href="/department">
                    <i class="fa fa-files-o"></i>
                    <span>部门管理</span>
                    <!-- <i class="fa fa-angle-right pull-right"></i> -->
                  </a>
                </li>
                <li class="treeview">
                  <a href="/user">
                    <i class="fa fa-th"></i> <span>员工管理</span>
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