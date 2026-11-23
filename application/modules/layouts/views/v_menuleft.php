        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url('/'); ?>" class="site_title"><i class="fa fa-hospital-o"></i> <span>Pharmacy</span>
                <sup><?php echo 'v'.VERSION; ?></sup>
              </a>
            </div>

            <div class="clearfix"></div>
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Inventory <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('admin'); ?>">Masterlist</a></li>
                      <?php if ($this->session->userdata('profile') == 'admin') { ?>
                      <!-- <li><a href="<?php //echo base_url('inventory/in'); ?>">Inventory - IN</a></li> -->

                      <li>
                        <a>Inventory<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li class="sub_menu"><a href="<?php echo base_url('inventory/in'); ?>">IN</a>
                          </li>
                          <li><a href="<?php echo base_url('inventory/in_record'); ?>">Records</a>
                          </li>
                        </ul>
                      </li>

                      <li>
                        <a>Allocation<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li class="sub_menu"><a href="<?php echo base_url('inventory/allocation'); ?>">Allocate</a>
                          </li>
                          <li><a href="<?php echo base_url('inventory/allocation_record'); ?>">Records</a>
                          </li>
                        </ul>
                      </li>
                      <?php } ?>
                      <li>
                      <a>Grant<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li class="sub_menu"><a href="<?php echo base_url('inventory/dispense'); ?>">Dispense</a>
                          </li>
                          <li><a href="<?php echo base_url('inventory/dispense_record'); ?>">Records</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  <?php if ($this->session->userdata('profile') == 'admin') { ?>
                  </li>
                   <li><a href="<?php echo base_url('medicine'); ?>"><i class="fa fa-medkit"></i> Medicine</a>
                  </li>
                  <?php } ?>
                  <li><a><i class="fa fa-print"></i> Reports<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('report'); ?>">Masterlist</a></li>
                      <li><a href="<?php echo base_url('report/expirationdate'); ?>">Expiration Date</a></li>
                      <?php //if ($this->session->userdata('profile') == 'admin') { ?>
                      <li><a href="<?php echo base_url('report/barangay'); ?>">Barangay Allocation</a></li>
                      <?php //} ?>
                      <li><a href="<?php echo base_url('report/stockcard'); ?>">Stock Card</a></li>
                    </ul>
                  </li>

                  <?php if ($this->session->userdata('profile') == 'admin') { ?>
                  <!-- </li>
                   <li><a href="<?php //echo base_url('dashboard'); ?>"><i class="fa fa-bar-chart-o"></i> Statistics</a>
                  </li> -->
                  <li><a><i class="fa fa-bar-chart-o"></i> Statistics <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('dashboard'); ?>">RHU</a><li>
                      <li><a href="<?php echo base_url('dashboard/bs'); ?>">BS</a><li>
                      <li><a href="<?php echo base_url('dashboard/other'); ?>">HEMS, EHSD, SH, ...</a><li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($this->session->userdata('profile') == 'user') { ?>
                  </li>
                   <li><a href="<?php echo base_url('dashboard/statistics/'); ?>"><i class="fa fa-bar-chart-o"></i> Statistics</a>
                  </li>
                  <?php } ?>

                  <?php if ($this->session->userdata('profile') == 'admin') { ?>
                  </li>
                   <li><a href="<?php echo base_url('maintenance'); ?>"><i class="fa fa-edit"></i> Maintenance <span class="label label-success pull-right">New</span></a>
                  </li>
                  <?php } ?>

                  <!-- <li><a><i class="fa fa-sitemap"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li> -->
                </ul>
              </div>
             </div>
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url('build/images/logo.png'); ?>" alt=""><?php echo $this->session->userdata('name'); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li class="btn-profile"><a href="<?php echo base_url('account/profile'); ?>"> Profile</a></li>
                    <li><a href="<?php echo base_url('account/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown dropdown-notify hidden">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-red"></span>
                  </a>
                  <ul id="menu1" class="menu-notify dropdown-menu list-unstyled msg_list scrollbar" role="menu">
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
