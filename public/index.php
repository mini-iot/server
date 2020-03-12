<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/lib/Db.class.php';
require __DIR__ . '/lib/random_code.php';
use flight\Engine;
$app = new Engine();
Flight::set('flight.views.path', 'views');

$app->route('/test', function(){
    $request = Flight::request();
    echo $request->url;
});

$app->route('/', function(){
    if(isset($_SESSION['uid'])){
        $uname = $_SESSION['uname'];
        $uid = $_SESSION['uid'];
        $db = new Db();
        $devices = $db->query("Select * from devices where device_userid=:uid", array("uid"=>$uid));
        Flight::render('home', array('title' => 'mini-iot','devices'=>$devices),'body_content');
        Flight::render('admin', array('title' => 'Home Page','uname'=>$uname));
    }else{
        Flight::redirect('/user/singin');
        exit;
    }
});

$app->route('/device/all', function(){
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
        $uname = $_SESSION['uname'];
        $db = new Db();
        $devices = $db->query("Select * from devices where device_userid=:uid order by id desc", array("uid"=>$uid));
        Flight::render('device/all', array('title' => 'mini-iot','devices'=>$devices),'body_content');
        Flight::render('admin', array('title' => 'Home Page','uname'=>$uname));
    }else{
        Flight::redirect('/user/singin');
        exit;
    }
});

$app->route('GET /device/info/@id', function($id){
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
        $uname = $_SESSION['uname'];
        $db = new Db();
        $devices = $db->query("Select * from devices where device_userid=:uid and id=:id", array("uid"=>$uid,"id"=>$id));
        if(count($devices)>0){
            Flight::render('device/info', array('title' => 'mini-iot','device'=>$devices[0]),'body_content');
        }else{
            Flight::render('device/info', array('title' => 'mini-iot','device'=>null),'body_content');
        }
        Flight::render('admin', array('title' => 'Home Page','uname'=>$uname));
    }else{
        Flight::redirect('/user/singin');
        exit;
    }
});

$app->route('GET /device/new', function(){
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
        $uname = $_SESSION['uname'];
        Flight::render('device/new', array('title' => 'mini-iot'),'body_content');
        Flight::render('admin', array('title' => 'Home Page','uname'=>$uname));
    }else{
        Flight::redirect('/user/singin');
        exit;
    }
});

$app->route('POST /device/new', function(){
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
        $uname = $_SESSION['uname'];
        $device_key=random_code(16,"t,n");
        $device_name=Flight::request()->data->device_name;
        $db = new Db();
        $insert = $db->query("INSERT INTO devices(device_name,device_key,device_userid) VALUES(:n,:k,:u)", array("n"=>$device_name,"k"=>$device_key,"u"=>$uid));
        Flight::redirect('/device/all');
        exit;
    }else{
        Flight::redirect('/user/singin');
        exit;
    }
});

$app->route('GET /user/singin', function(){
    Flight::render('user/singin', array('msg' => ''));
});

$app->route('POST /user/singin', function(){
    $name = Flight::request()->data->name;
    $pwd = Flight::request()->data->pwd;
    $db = new Db();
    $users = $db->query("Select * from users where username=:n and userpwd=:p", array("n"=>$name,"p"=>md5($pwd)));
    if(count($users)>0){
        $_SESSION['uid']=$users[0]['id'];
        $_SESSION['uname']=$users[0]['username'];
        Flight::redirect('/');
    }else{
        Flight::render('user/singin', array('msg' => '密码错误'));
    }
    exit;
});

$app->route('GET /user/singup', function(){
    $msg="";
    Flight::render('user/singup', array('msg' => $msg));
});

$app->route('POST /user/singup', function(){
    $name = Flight::request()->data->name;
    $pwd = Flight::request()->data->pwd;
    $pwd2 = Flight::request()->data->pwd2;
    if($pwd!=$pwd2){
      Flight::render('user/singup', array('msg' => '密码不一致'));
      exit;
    }
    $db = new Db();
    $users = $db->query("Select * from users where username=:n", array("n"=>$name));
    if(count($users)>0){
        Flight::render('user/singup', array('msg' => '用户名已经存在'));
    }else{
        $auth_key=random_code(16,"t,n,s");
        $insert = $db->query("INSERT INTO users(username,userpwd,auth_key) VALUES(:n,:p,:k)", array("n"=>$name,"p"=>md5($pwd),"k"=>$auth_key));
        if($insert>0){
            Flight::redirect('/user/singupok');
            exit;
        }else{
            Flight::render('user/singup', array('msg' => '不知道发生了什么错误'));
        }
    }
});

$app->route('GET /user/singupok', function(){
    $msg="";
    Flight::render('user/singupok');
});

$app->route('/user/singout', function(){
    unset($_SESSION["uname"]);
    session_destroy();
    Flight::render('user/singout');
});

$app->route('POST /demo',function($route){
    header("Access-Control-Allow-Origin: *");
    $j = array('id' => 123);
//    $body = Flight::request()->getBody();
    $name = Flight::request()->data->name;
    Flight::json($name);
},true);

$app->route('/info', function(){
    // echo 'hello world!';
    $db = new Db();
    $count = [];
    $count['users'] = $db->query("Select count(*) as count from miniask_users")[0]['count'];
    $count['qs'] = $db->query("Select count(*) as count from miniask_qs")[0]['count'];
    $count['as'] = $db->query("Select count(*) as count from miniask_as")[0]['count'];

    Flight::view()->set('count', $count);
    Flight::render('info.php');
});


$app->route('POST /api/device/del', function(){
    $device_key = Flight::request()->data->device_key;
    $db = new Db();
    $delete = $db->query("DELETE FROM devices WHERE device_key = :k", array("k"=>$device_key));
    $db->query("DELETE FROM cmds WHERE device_key = :k", array("k"=>$device_key));
    $db->query("DELETE FROM status WHERE device_key = :k", array("k"=>$device_key));
    if($delete>0){
        Flight::json(true);
    }else{
        Flight::json("not found");
    }
});

$app->route('POST /api/device/online', function(){
    $device_key = Flight::request()->data->device_key;
    $db = new Db();
    $update=$db->query("UPDATE devices SET last_online = now() WHERE device_key = :k", array("k"=>$device_key));
    if($update>0){
        Flight::json(true);
    }else{
        Flight::json(false);
    }
});

$app->route('POST /api/device/status/save', function(){
    $device_key = Flight::request()->data->device_key;
    $name = Flight::request()->data->name;
    $value = Flight::request()->data->value;
    $db = new Db();
    $insert = $db->query("INSERT INTO status(name,value,device_key) VALUES(:n,:v,:k)", array("n"=>$name,"v"=>$value,"k"=>$device_key));
    if($insert>0){
        Flight::json(true);
    }else{
        Flight::json(false);
    }
});

$app->route('POST /api/device/status/all', function(){
    $device_key = Flight::request()->data->device_key;
    $db = new Db();
    $status = $db->query("select * FROM status WHERE device_key = :k", array("k"=>$device_key));
    Flight::json($status);
});

$app->route('POST /api/device/cmd/send', function(){
    $device_key = Flight::request()->data->device_key;
    $cmd = Flight::request()->data->cmd;
    $db = new Db();
    $insert = $db->query("INSERT INTO cmds(cmd,is_execute,device_key) VALUES(:c,0,:k)", array("c"=>$cmd,"k"=>$device_key));
    if($insert>0){
        Flight::json(true);
    }else{
        Flight::json(false);
    }
});

$app->route('POST /api/device/cmd/last', function(){
    $device_key = Flight::request()->data->device_key;
    $db = new Db();
    $cmds = $db->query("select * from cmds where device_key=:k order by id desc limit 0,1", array("k"=>$device_key));
    if($cmds>0){
        Flight::json($cmds[0]['cmd']);
    }else{
        Flight::json(false);
    }
});

$app->route('GET /update', function(){
  if(isset($_SESSION['uid'])){
      $uid = $_SESSION['uid'];
      $uname = $_SESSION['uname'];
      Flight::render('update', array('name' => 'update'),'body_content');
      Flight::render('admin', array('title' => 'Home Page','uname'=>$uname));
      exit;
  }else{
      Flight::redirect('/user/singin');
      exit;
  }
});

$app->route('GET /apipage/online', function(){
  if(isset($_SESSION['uid'])){
      $uid = $_SESSION['uid'];
      $uname = $_SESSION['uname'];
      Flight::render('apipage/online', array('name' => 'online'),'body_content');
      Flight::render('admin', array('title' => 'Home Page','uname'=>$uname));
      exit;
  }else{
      Flight::redirect('/user/singin');
      exit;
  }
});

Flight::map('notFound', function(){
    Flight::render('404');
});

Flight::before('start', function(&$params, &$output){
    header("Access-Control-Allow-Origin: *");
//    if (isset($_SERVER['HTTP_ORIGIN'])) {
//        // should do a check here to match $_SERVER['HTTP_ORIGIN'] to a
//        // whitelist of safe domains
//        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
//        header('Access-Control-Allow-Credentials: true');
//        header('Access-Control-Max-Age: 86400');    // cache for 1 day
//    }
//    // Access-Control headers are received during OPTIONS requests
//    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
//            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
//        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
//            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
//    }
});

$app->start();
?>
