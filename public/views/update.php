<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $name ?></h1>
    <a href="/device/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> 全部设备</a>
  </div>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">2017 人体温度数据库和折线图</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        体温数据库express(nodejs)+mongodb，每个体温计对应一个序列号，可以查看体温折线图canvas(HTML5)，体温异常可自动触发推送(微信)。
      </div>
    </div>
  </div>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">2018 DHT温湿度仪表盘</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        由于体温数据库已被公司商业化，因此现在个人项目变为DHT温湿度仪表盘。可用来远程查看室内温度及变化。
      </div>
    </div>
  </div>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">2019 树梅派家庭气象服务器</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        emqx(MQTT Broker)+paho.mqtt(python)+mongodb 安装在树梅派上，通过MQTT协议，保存数据，并显示家庭气象信息(vue-echarts)。
      </div>
    </div>
  </div>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">2020 私人气象网络</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        因成本原因（虚拟主机比云服务器便宜），用Flight框架(PHP7.3)+mysql重写了该系统。设备端可通过POST方式跨域调用API。每个设备会生成一个设备密钥，通过调用API，可保存设备状态，及对设备发送指令。增加一个管理界面，可在线管理设备。
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
