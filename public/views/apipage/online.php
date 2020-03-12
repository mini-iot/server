<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">API::online</h1>
    <a href="/device/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> 全部设备</a>
  </div>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?php echo $name ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <code><pre>curl <?php echo $_SERVER['HTTP_HOST'] ?>/api/device/online -X POST -d "device_key=xxx"</pre></code>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
