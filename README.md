# server

克隆
```
git clone https://github.com/mini-iot/server.git
cd server
```

安装
```
composer install
```

更改mysql配置
```
nano public/lib/settings.ini.php
```

启动
```
cd public
php -S localhost:3000
```

## 其他

```
sudo apt install php7.2-cli
sudo apt install php php-mysql
```

mysql的安装
```
sudo apt install mysql-server
```

查看是否安装正确
```
sudo netstat -tap | grep mysql
```

查看密码
```
sudo cat /etc/mysql/debian.cnf
```

登录 debian-sys-maint 并更改mysql密码

```
mysql -u debian-sys-maint -p
```

依次输入如下语句，变更mysql的root密码
```
use mysql;
update user set authentication_string=PASSWORD("root") where user='root';
update user set plugin="mysql_native_password";
flush privileges;
quit;
```

重启mysql
```
/etc/init.d/mysql restart;
```

然后使用root来登录
```
mysql -u root -p
```

composer的安装
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

如果你是使用apache服务器，则.htaccess设置为如下：
```
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [QSA,L]
</IfModule>
```
