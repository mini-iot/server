<link rel="stylesheet" type="text/css" href="../css/signup.css">
<div id="wrap"><div id="main"><div id="wrapper">
  <div id="logo_wrapper" class="standard_logo_wrapper mb24">
    <h1 style="height: 100%; display: table-cell; vertical-align: bottom;">
      私人气象传感网络<br><br>
      <img id="logo" class="standard_logo" src="../images/logo.jpeg" alt="Salesforce" border="0" name="logo">
    </h1>
  </div>
  <h2 id="header" class="mb12" style="display: none;"></h2>
  <div id="content" style="display: block;">
    <div id="chooser" style="display: block">
      <div class="loginError" id="chooser_error" style="display: block;"><?php echo $msg ?></div>


      <div id="theloginform" style="display: block;">
        <form name="login" method="post" id="login_form" onsubmit="" action="/user/singin">
          <div id="usernamegroup" class="inputgroup">
            <label for="username" class="label usernamelabel">账户</label>
            <div id="username_container">
              <div id="idcard-container" class="mt8 mb16" style="display: none">
                <div id="idcard">
                  <img id="idcard-avatar" class="avatar" alt="">
                  <a href="javascript:void(0);" id="clear_link" class="clearlink" onclick="LoginHint.clearExistingIdentity();">
                    <img alt="Log In with a Different Username" class="clearicon" src="/img/clear.png">
                  </a>
                  <span id="idcard-identity"></span>
                </div>
              </div>
              <input class="input r4 wide mb16 mt8 username" type="text" value="" name="name" id="username">
            </div>
          </div>
          <label for="password" class="label">密码</label>
          <input class="input r4 wide mb16 mt8 password" type="password" id="password" name="pwd" onkeypress="" autocomplete="off">
          <input class="button r4 wide primary" type="submit" id="Login" name="Login" value="登录">
        </form>
      </div>
    </div>
  </div>
</div>

<div id="signup" class="tc mt24" style="display: block;"><p class="di mr16">没有帐号？</p><a class="button secondary" id="signup_link" href="/user/singup">注册</a></div>
</div></div></div>
