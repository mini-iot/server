<?php
$api="localhost:3000/api";
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Device info</h1>
            <a href="/device/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> 全部设备</a>
          </div>

          <?php
          if(isset($device)){
            ?>
     <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">设备详情</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>设备名称</th>
                      <th>设备密钥（禁止泄漏）</th>
                      <th>创建时间</th>
                      <th>最后在线时间</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                          <td><?php echo $device['device_name'] ?></td>
                          <td><?php echo $device['device_key'] ?></td>
                          <td><?php echo $device['create_time'] ?></td>
                          <td><?php echo $device['last_online'] ?></td>
                        </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
            
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">保存状态</h6>
            </div>
            <div class="card-body">
              <p>curl <?php echo $api ?>/device/status/save -X POST -d "name=xxx&value=xxx&device_key=<?php echo $device['device_key'] ?>"</p>
              <iframe name="savestatus"></iframe>
                <br><br>
              <form action="/api/device/status/save" method="post" target="savestatus" class="d-none d-sm-inline-block form-inline mr-auto ml-md-6 my-6 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                      <input type="text" name="name" class="form-control bg-light border-0 small" placeholder="输入名称" aria-label="Search" aria-describedby="basic-addon2" />
                      <input type="text" name="value" class="form-control bg-light border-0 small" placeholder="输入值" aria-label="Search" aria-describedby="basic-addon2" />
                      <input type="text" name="device_key" value="<?php echo $device['device_key'] ?>" class="form-control bg-light border-0 small" placeholder="输入设备密钥" aria-label="Search" aria-describedby="basic-addon2"/>
                      <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" value="保存" />
                      </div>
                    </div>
                  </form>
            </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">状态</h6>
            </div>
            <div class="card-body">
              <p>curl <?php echo $api ?>/device/status/all -X POST -d "device_key=<?php echo $device['device_key'] ?>"</p>
              <iframe name="status"></iframe><br><br>
              <form action="/api/device/status/all" method="post" target="status" class="d-none d-sm-inline-block form-inline mr-auto ml-md-6 my-6 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                      <input type="text" name="device_key" value="<?php echo $device['device_key'] ?>" class="form-control bg-light border-0 small" placeholder="输入设备密钥" aria-label="Search" aria-describedby="basic-addon2"/>
                      <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" value="查询" />
                      </div>
                    </div>
                  </form>
            </div>
          </div>
        
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">发送指令</h6>
            </div>
            <div class="card-body">
              <p>curl <?php echo $api ?>/device/cmd/send -X POST -d "cmd=xxx&device_key=<?php echo $device['device_key'] ?>"</p>
              <iframe name="msg"></iframe><br><br>
              <div class="table-responsive">
                <form action="/api/device/cmd/send" method="post" target="msg" class="d-none d-sm-inline-block form-inline mr-auto ml-md-6 my-6 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                      <input type="text" name="cmd" class="form-control bg-light border-0 small" placeholder="输入指令" aria-label="Search" aria-describedby="basic-addon2" />
                      <input type="text" name="device_key" value="<?php echo $device['device_key'] ?>" class="form-control bg-light border-0 small" placeholder="输入设备密钥" aria-label="Search" aria-describedby="basic-addon2"/>
                      <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" value="发送" />
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
            

        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">读取指令</h6>
            </div>
            <div class="card-body">
              <p>curl <?php echo $api ?>/device/cmd/last -X POST -d "device_key=<?php echo $device['device_key'] ?>"</p>
              <iframe name="lastcmd"></iframe><br><br>
              <div class="table-responsive">
                <form action="/api/device/cmd/last" method="post" target="lastcmd" class="d-none d-sm-inline-block form-inline mr-auto ml-md-6 my-6 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                      <input type="text" name="device_key" value="<?php echo $device['device_key'] ?>" class="form-control bg-light border-0 small" placeholder="输入设备密钥" aria-label="Search" aria-describedby="basic-addon2"/>
                      <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" value="读取" />
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>

<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">更新在线状态</h6>
            </div>
            <div class="card-body">
              <p>curl <?php echo $api ?>/device/online -X POST -d "device_key=<?php echo $device['device_key'] ?>"</p>
              <iframe name="online"></iframe><br><br>
              <div class="table-responsive">
                <form action="/api/device/online" method="post" target="online" class="d-none d-sm-inline-block form-inline mr-auto ml-md-6 my-6 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                      <input type="text" name="device_key" value="<?php echo $device['device_key'] ?>" class="form-control bg-light border-0 small" placeholder="输入设备密钥" aria-label="Search" aria-describedby="basic-addon2"/>
                      <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" value="更新" />
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>

     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">删除设备</h6>
            </div>
            <div class="card-body">
              <p>curl <?php echo $api ?>/device/del -X POST -d "device_key=<?php echo $device['device_key'] ?>"</p>
    <iframe name="delete"></iframe><br><br>
              <div class="table-responsive">
                <form action="/api/device/del" method="post" target="delete" class="d-none d-sm-inline-block form-inline mr-auto ml-md-6 my-6 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                      <input type="text" name="device_key" value="<?php echo $device['device_key'] ?>" class="form-control bg-light border-0 small" placeholder="输入设备密钥" aria-label="Search" aria-describedby="basic-addon2"/>
                      <div class="input-group-append">
                        <input class="btn btn-danger" type="submit" value="删除" />
                      </div>
                    </div>
                  </form>
            </div>
          </div>

        </div>
            <?php
          }else{
            ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">设备不存在</h6>
            </div>
            <div class="card-body">
              设备可能已删除
            </div>
          </div>
            <?php
          }
          ?>

          
        <!-- /.container-fluid -->
