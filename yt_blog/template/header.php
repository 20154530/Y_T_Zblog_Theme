{* Template Name: head *}
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>
    {if $type=="index"}
    {$name}{$subname}
    {elseif $type=="category"&&$page=="1"}
    {$category.Name}
    {if $category.Metas.fjbt}
    {$category.Metas.fjbt}
    {/if}
    {$name}
    {elseif $type=="category"&&$page>"1"}
    {$category.Name}
    {if $category.Metas.fjbt}
    {$category.Metas.fjbt}
    {/if}
    {$name}第{$page}页
    {elseif $type=="tag"&&$page=="1"}
    {$tag.Name}
    {if $tag.Metas.fjbt}
    {$tag.Metas.fjbt}
    {/if}
    {$name}
    {elseif $type=="tag"&&$page>"1"}
    {$tag.Name}
    {if $tag.Metas.fjbt}
    {$tag.Metas.fjbt}
    {/if}
    {$name}第{$page}页
    {elseif $type=="date"&&$page=="1"}
    {$title}{$name}
    {elseif $type=="date"&&$page>"1"}
    {$title} {$name}
    {elseif $type=="article"}
    {$title}
    {if $article.Metas.fjbt}
    {$article.Metas.fjbt}
    {/if}
    {if $zbp->Config('yt_blog')->post_category=="a"}
    {$article.Category.Name}
    {/if}
    {$name}
    {elseif $type=="page"}
    {$title}
    {if $article.Metas.fjbt}
    {$article.Metas.fjbt}
    {/if}
    {$name}
    {if $zbp->Config('yt_blog')->page_subname=="a"}
    {$subname}
    {/if}
    {else}
    {$title}{$name}
    {/if}
  </title>
  {if $zbp->Config('yt_blog')->seo=="a"}
  {if $type=='index'}
  <meta name="keywords" content="{$zbp->Config('yt_blog')->keywords}" />
  <meta name="description" content="{$zbp->Config('yt_blog')->description}" />
  {elseif $type=='page'}
  {if $article.Metas.gjc}
  <meta name="keywords" content="{$article.Metas.gjc}" />
  {else}
  <meta name="keywords" content="{$title},{$name}" />
  {/if}
  {if $article.Metas.ms}
  <meta name="description" content="{$article.Metas.ms}" />
  {else}
  {php}$description = preg_replace('/[\r\n\s]+/', ' ',
  trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),135)).'...');{/php}
  <meta name="description" content="{$description}" />
  {/if}
  <meta name="author" content="{$article.Author.StaticName}" />
  {elseif $type=='article'}
  {if $article.Metas.gjc}
  <meta name="keywords" content="{$article.Metas.gjc}" />
  {else}
  <meta name="keywords" content="{foreach $article.Tags as $tag}{$tag.Name},{/foreach}" />
  {/if}
  {if $article.Metas.ms}
  <meta name="description" content="{$article.Metas.ms}" />
  {else}
  <meta name="description"
        content="{$article.Title}是{$name}中一篇关于{foreach $article.Tags as $tag}{$tag.Name}{/foreach}的文章，欢迎您阅读和评论,{$name}" />
  {/if}
  {elseif $type=='category'}
  {if $category.Metas.gjc}
  <meta name="keywords" content="{$category.Metas.gjc}" />
  {else}
  <meta name="keywords" content="{$title},{$name}">
  {/if}
  {if $category.Metas.ms}
  <meta name="description" content="{$category.Metas.ms}" />
  {else}
  <meta name="description" content="{$category.Intro}">
  {/if}
  {elseif $type=='tag'}
  {if $tag.Metas.gjc}
  <meta name="keywords" content="{$tag.Metas.gjc}" />
  {else}
  <meta name="keywords" content="{$title},{$name}">
  {/if}
  {if $tag.Metas.ms}
  <meta name="description" content="{$tag.Metas.ms}" />
  {else}
  <meta name="description" content="{$tag.Intro}">
  {/if}
  {else}
  <meta name="Keywords" content="{$title},{$name}" />
  <meta name="description" content="{$title}-{$name}" />
  {/if}
  {/if}
  <meta name="HandheldFriendly" content="True" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="{$zbp->Config('yt_blog')->tx}">
  <script src="{$host}zb_system/script/jquery-2.2.4.min.js" type="text/javascript"></script>
  <script src="{$host}zb_system/script/zblogphp.js" type="text/javascript"></script>
  <script src="{$host}zb_system/script/c_html_js_add.php" type="text/javascript"></script>
  <script src="{$host}zb_users/theme/yt_blog/style/js/pjax.js" type="text/javascript"></script>
  <script src="{$host}zb_users/theme/yt_blog/style/js/TweenMax.min.js"></script>
  <script src="{$host}zb_users/theme/yt_blog/style/js/MorphSVGPlugin.min.js"></script>
  <script src="{$host}zb_users/theme/yt_blog/style/js/control.js?k={php}echo mt_rand();{/php}"></script>
  <link rel="stylesheet" type="text/css" media="all" href="{$host}zb_users/theme/yt_blog/style/css/style.css" />
  <!--[if lt IE 9]>
	  <script src="{$host}zb_users/theme/yt_blog/stylejs/html5shiv.min.js"></script>
	  <script src="{$host}zb_users/theme/yt_blog/stylejs/respond.min.js"></script>
	<![endif]-->
  {if $type=='index'&&$page=='1'}
  <link rel="alternate" type="application/rss+xml" href="{$feedurl}" title="{$name}" />
  <link rel="EditURI" type="application/rsd+xml" title="RSD" href="{$host}zb_system/xml-rpc/?rsd" />
  <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="{$host}zb_system/xml-rpc/wlwmanifest.xml" />
  {/if}
  {$header}
</head>
{php}$accessurl = $_GET['url'];{/php}
<body xmlns="http://www.w3.org/2000/svg">
  <div id="float-top-navigation" class="flex-row">
    <div class="mainicon">
      <a class="m-pjax display-adapt" href="{$zbp->host}" title="回到主页">
        <svg class="icon" viewBox="0 0 96 48">
          <path id="ICON-Y" class="icon-color icon-yt"
                d="M41,11v8H39V9h2Zm5,12H42V19h2v2h2Zm3,0V39H47V21h2Zm5-2v2H50V21h2V19h2Zm3-10v8H55V9h2Z" />
          <path id="ICON-Home" style="display: none"
                d="M43.2,21.8a3.86,3.86,0,0,0-2-2,3.52,3.52,0,0,0-1.45-.3,3.6,3.6,0,0,0-1.46.3,3.86,3.86,0,0,0-2,2A3.68,3.68,0,0,0,36,23.25,3.73,3.73,0,0,0,39.75,27a3.68,3.68,0,0,0,1.45-.29,3.86,3.86,0,0,0,2-2,3.6,3.6,0,0,0,.3-1.46A3.52,3.52,0,0,0,43.2,21.8Zm-1.38,2.33a2.26,2.26,0,0,1-1.19,1.19,2.24,2.24,0,0,1-1.76,0,2.26,2.26,0,0,1-1.19-1.19,2.24,2.24,0,0,1,0-1.76,2.26,2.26,0,0,1,1.19-1.19,2.24,2.24,0,0,1,1.76,0,2.26,2.26,0,0,1,1.19,1.19,2.24,2.24,0,0,1,0,1.76Zm17.57,4.16a4.6,4.6,0,0,0-.72-1,5.18,5.18,0,0,0-1-.84,6.24,6.24,0,0,0,.6-1.53,6.85,6.85,0,0,0-.11-3.68,6.48,6.48,0,0,0-.92-1.84,3.61,3.61,0,0,0,1.1-.53,3.78,3.78,0,0,0,.87-.82A3.71,3.71,0,0,0,59.8,17a3.78,3.78,0,0,0,.2-1.2,3.52,3.52,0,0,0-.3-1.45,3.86,3.86,0,0,0-2-2,3.52,3.52,0,0,0-1.45-.3,3.6,3.6,0,0,0-1.46.3,3.86,3.86,0,0,0-2,2,3.68,3.68,0,0,0-.29,1.45,3.77,3.77,0,0,0,.09.8l-.42,0h-.42a6.6,6.6,0,0,0-2.62.53,6.79,6.79,0,0,0-3.6,3.6A6.6,6.6,0,0,0,45,23.25a6.69,6.69,0,0,0,.33,2.1,6.86,6.86,0,0,0,2.41,3.33,6.57,6.57,0,0,0,1.88,1,4.82,4.82,0,0,0-.12,1.1A5.24,5.24,0,0,0,54.75,36a5.21,5.21,0,0,0,2-.41,5.15,5.15,0,0,0,1.66-1.13A5.2,5.2,0,0,0,60,30.75a5,5,0,0,0-.16-1.27A4.87,4.87,0,0,0,59.39,28.29ZM54.18,14.87a2.26,2.26,0,0,1,1.19-1.19,2.24,2.24,0,0,1,1.76,0,2.26,2.26,0,0,1,1.19,1.19,2.24,2.24,0,0,1,0,1.76,2.26,2.26,0,0,1-1.19,1.19,2.16,2.16,0,0,1-.88.18H56a7.57,7.57,0,0,0-.74-.52,6,6,0,0,0-.8-.41,2.09,2.09,0,0,1-.43-1.3A2.16,2.16,0,0,1,54.18,14.87Zm-4,13.37a4.86,4.86,0,0,1-1.47-.75,5.23,5.23,0,0,1-1.15-1.15,5.45,5.45,0,0,1-.75-1.46,5.25,5.25,0,0,1-.26-1.63,5,5,0,0,1,.42-2.05A5.28,5.28,0,0,1,48,19.54a5.22,5.22,0,0,1,1.67-1.12,5,5,0,0,1,2-.42,5.31,5.31,0,0,1,1.77.3v0a7.55,7.55,0,0,1,.9.45,6.91,6.91,0,0,1,.81.59h0a5.37,5.37,0,0,1,1.26,1.76A5.14,5.14,0,0,1,57,23.25a5.07,5.07,0,0,1-.16,1.29,5.45,5.45,0,0,1-.48,1.21,5.16,5.16,0,0,0-1.61-.25,5,5,0,0,0-2.68.73A5.51,5.51,0,0,0,50.13,28.24Zm8.07,4a3.86,3.86,0,0,1-2,2,3.68,3.68,0,0,1-1.45.29A3.73,3.73,0,0,1,51,30.75a3.59,3.59,0,0,1,.29-1.41,4,4,0,0,1,.78-1.2,3.68,3.68,0,0,1,1.15-.83A3.23,3.23,0,0,1,54.63,27a4,4,0,0,1,1.5.28,3.91,3.91,0,0,1,1.23.78,3.84,3.84,0,0,1,.84,1.18,3.73,3.73,0,0,1,.3,1.51A3.6,3.6,0,0,1,58.2,32.21Z" />
          <path class="icon-color" d="M32,25H14V23H32Z" />
          <path class="icon-color" d="M82,25H64V23H82Z" />
        </svg>
      </a>
    </div>
    <div class="control flex-row-adapt">
      <div class="item">
        <span class="item-content flex-column">
          <span class="icon-holder segoe">&#xe8f1;</span>
          <span class="text-holder">文章分类</span>
        </span>
        <div class="dropdown">
          {php}$Catenews=$zbp->GetCategoryList(array('*'),null);{/php}
          {foreach $Catenews as $Catenew}
          <a href="{$Catenew.Url}" class="m-pjax dropdown-item">
            {$Catenew.Name}
          </a>
          {/foreach}
        </div>
      </div>
      <div class="item">
        <span class="item-content flex-column">
          <span class="icon-holder segoe">&#xe8ec;</span>
          <span class="text-holder">文章标签</span>
        </span>
        <div class="dropdown">
          {php}$tagArray =
          $zbp->GetTagList('','',array('tag_Count'=>'DESC'),array($zbp->Config('yt_blog')->tag_num),'');{/php}
          {foreach $tagArray as $tag}
          <a href="{$tag.Url}" title="{$tag.Name} Tag" class="m-pjax dropdown-item">
            {$tag.Name} ({$tag.Count})
          </a>
          {/foreach}
        </div>
      </div>
      <a class="m-pjax item" href="{$host}?id=2">
        <span class="item-content flex-column">
          <span class="icon-holder segoe">&#xed1e;</span>
          <span class="text-holder">留言区</span>
        </span>
      </a>
    </div>
    <div class="sundries flex-row">
      <div class="search-holder">
        <form class="search flex-row" role="search" name="search" method="post"
              action="{$host}zb_system/cmd.php?act=search">
          <input class="input" id="edtSearch" type="text" autocomplete="off" value="" name="q" placeholder="请输入关键字搜索">
          <input class="submit segoe" type="submit" value="&#xE721;" title="搜索">
        </form>
      </div>
      <a class="login-holder" href="{$zbp->host}zb_system/login.php" title="登录">
        {if $user.ID>0}
        <img class="login" src="{$zbp->host}zb_users/avatar/{$user.ID-1}.png">
        {else}
        <span class="login segoe">&#xe13d;</span>
        {/if}
      </a>
    </div>
    <span id="menu-mobile" class="segoe display-adapt-mobile">&#xe700;</span>
  </div>
  <div id="fixed-content-holder">
