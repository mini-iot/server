
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Devices</h1>
            <a href="/device/new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> 新增设备</a>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">全部设备</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>设备名称</th>
                      <th>创建时间</th>
                      <th>最后在线时间</th>
                      <th>详情</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach($devices as $device){
                        ?>
                        <tr>
                          <td><?php echo $device['device_name'] ?></td>
                          <td><?php echo $device['create_time'] ?></td>
                          <td><?php echo $device['last_online'] ?></td>
                          <td><a href="/device/info/<?php echo $device['id'] ?>">详情</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
