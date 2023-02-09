<h1 class="text-light">Welcome to <?php echo $_settings->info('name') ?></h1>
<hr class="border-light">
<div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-light elevation-1"><i class="fas fa-th-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Number of Vehicles</span>
                <span class="info-box-number">
                  <?php
                    $vehicles = $conn->query("SELECT count(vehicle_number) as total FROM vehicles")->fetch_assoc()['total'];
                    echo number_format($vehicles);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Number of Employees</span>
                <span class="info-box-number">
                  <?php
                    $employees = $conn->query("SELECT count(employee_id) as total FROM `employees`")->fetch_assoc()['total'];
                    echo number_format($employees);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-th-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Number of Accounts</span>
                <span class="info-box-number">
                <?php
                    $accounts = $conn->query("SELECT count(account_id) as total FROM `accounts`")->fetch_assoc()['total'];
                    echo number_format($accounts);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <?php if($_settings->userdata('type') == 'admin' || $_settings->userdata('type') == 'manager'): ?>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Number of Users</span>
                <span class="info-box-number">
                <?php
                    $users = $conn->query("SELECT count(id) as total FROM `users` ")->fetch_assoc()['total'];
                    echo number_format((float)$users);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <?php endif; ?>
        </div>
