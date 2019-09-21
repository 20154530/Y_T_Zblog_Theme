{* Template Name: 404Page *}
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
  <meta http-equiv="Cache-Control" content="no-transform" />
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <meta name="applicable-device" content="pc,mobile">
  <meta name="viewport" content="width=device-width,initial-scale=1.33,minimum-scale=1.0,maximum-scale=1.0">
  <title>404 - 对不起，您查找的页面不存在！</title>
</head>

<body>
  <div id="main">
    <header id="header">
      <h1><span class="icon">!</span>404<span class="sub">not found</span></h1>
    </header>
    <div id="content">
      <h2>您打开的这个的页面不存在！</h2>
      <p>当您看到这个页面，表示您的访问出错，这个错误是您打开的页面不存在，请确认您输入的地址是正确的，如果是在本站点击后出现这个页面，请联系站长进行处理，或者请通过下边的搜索重新查找资源，{$name}感谢您的支持!</p>
      <div class="buttons">
        <span><a class="button" href="#" onClick="history.go(-1);return true;">返回上页</a></span>
        <span><a class="button" href="{$host}">返回首页</a></span>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</body>

</html>