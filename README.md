c2
==
### install
- modify src/www/config/databases.php
	- username
	- password
- modify src/www/config/constants.php
	- `LOC_PREFIC` to you base directory

### cloud
- visit http://stockmoney.0x271828.com/ for demos
- username: admin, password: admin
- stockAccountId: 323 nationalId: 323

### 代码结构

```
|   `-- system      //codeigniter框架代码
|   `-- www
|       |-- config    // 系统配置，主要是databases.php和constant.php
|       |-- controllers
|       |   |-- dashboard.php    // 后台管理 重点！
|       |   |-- index.php        // 直接跳转
|       |   |-- login.php        // 登录界面
|       |-- errors
|       |-- index.php
|       |-- lib
|       |-- libraries
|       |-- logs
|       |-- media   // js, image, css, 不重要
|       |-- models  // 数据库操作
|       |   |-- moneyaccount.php        // 资金账户
|       |   |-- stockaccount.php        // 证券账户（用户测试）
|       |   |-- userinfo.php            // 管理员等信息
|       |-- table.sql
|       |-- views
|           |-- dashboard
|           |   |-- cantfind
|           |   |   `-- cantfind.php
|           |   |-- dashboard_header.php
|           |   |-- destroy
|           |   |   `-- cancelaccount.php
|           |   |-- include_js.php
|           |   |-- money
|           |   |   `-- changemoney.php
|           |   |-- root_footer.php
|           |   |-- root.php
|           |   `-- useraccount
|           |       |-- changepassword.php
|           |       `-- newuser.php
|           `-- login.php
```

### interface
- C3
  - http://stockmoney.0x271828.com/api/getinfo?account=xxxxxx&token=xxxxxxx
```json
{
   result: '0',
   avail: 100,
   frozen: 100
}
```
  - http://stockmoney.0x271828.com/api/chpassword?account=xxxxxx&originpass=xxxx&nowpass=xxxx&token=xxxxxxx
```
{
	result: "0",
	error: "invalid token"
}
```

###interface with C3:
- token: md5('c3')
- result: "0" => error occurred

