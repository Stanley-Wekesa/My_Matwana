</style>
<!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
        <!-- Brand Logo -->
        <a href="<?php echo base_url ?>admin" class="brand-link bg-primary text-sm">
        <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 2.5rem;height: 2.5rem;max-height: unset">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
          <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
          </div>
          <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
          </div>
          <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
          <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
              <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                <!-- Sidebar user panel (optional) -->
                <div class="clearfix"></div>
                <!-- Sidebar Menu -->
                <nav class="mt-4">
                   <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item dropdown">
                      <a href="./" class="nav-link nav-home">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li>
                      <li class="nav-header">Business Management</li>
                      <?php if($_settings->userdata('type') == 'admin'): ?>
                        <li class="nav-item dropdown">
                          <a href="<?php echo base_url ?>admin/?page=companies" class="nav-link nav-mechanics">
                            <i class="nav-icon fas fa-industry"></i>
                            <p>
                              Companies
                            </p>
                          </a>
                        </li>
                      <?php endif; ?>
                      <li class="nav-item dropdown">
                        <a href="<?php echo base_url ?>admin/?page=employees" class="nav-link nav-mechanics">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                            Employees
                          </p>
                        </a>
                      </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=vehicles" class="nav-link nav-mechanics">
                        <i class="nav-icon fas fa-bus"></i>
                        <p>
                          Vehicles
                        </p>
                      </a>
                    </li>
                    <?php if($_settings->userdata('type') == 'admin'): ?>
                      <li class="nav-item dropdown">
                        <a href="<?php echo base_url ?>admin/?page=routes" class="nav-link nav-mechanics">
                          <i class="nav-icon fa fa-paw"></i>
                          <p>
                            Routes
                          </p>
                        </a>
                      </li>
                      <?php endif; ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=accounting" class="nav-link nav-mechanics">
                        <i class="nav-icon fa fa-balance-scale"></i>
                        <p>
                          Accounting
                        </p>
                      </a>
                    </li>
                      <?php if($_settings->userdata('type') == 'admin' || $_settings->userdata('type') == 'manager'): ?>
                        <li class="nav-item dropdown">
                          <a href="<?php echo base_url ?>admin/?page=report" class="nav-link nav-report">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                              Report
                            </p>
                          </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-header">Customer Management</li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=posts" class="nav-link nav-mechanics">
                        <i class="nav-icon fa fa-share-square"></i>
                        <p>
                          Posts
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=comments" class="nav-link nav-service_requests">
                        <i class="nav-icon fa fa-newspaper"></i>
                        <p>
                          Comments
                        </p>
                      </a>
                    </li>
                      <?php if($_settings->userdata('type') == 'admin' || $_settings->userdata('type') == 'manager'): ?>
                      <li class="nav-header">Personalized Settings</li>
                      <li class="nav-item dropdown">
                        <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user_list">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                            Users
                          </p>
                        </a>
                      </li>
                      <li class="nav-item dropdown">
                        <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                          <i class="nav-icon fas fa-cogs"></i>
                          <p>
                            Settings
                          </p>
                        </a>
                      </li>
                  <?php endif; ?>
                  </ul>
                </nav>
                <!-- /.sidebar-menu -->
              </div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar-corner"></div>
        </div>
        <!-- /.sidebar -->
      </aside>
      <script>
    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      page = page.split('/');
      page = page[0];
      if(s!='')
        page = page+'_'+s;

      if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

      }

    })
  </script>
