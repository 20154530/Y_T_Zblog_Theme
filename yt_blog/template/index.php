{template:header}
{if $accessurl == 'img'}
{template:post-img}
{else}
<div id="fixed-top-banner">
  {php} $banneralign = explode(',', $zbp->Config('yt_blog')->banneralign) {/php}
  <div class="banner-img banner-imglayout"
       style="background-image: url({$zbp->Config('yt_blog')->bannerurl});background-position:{$banneralign[0]} {$banneralign[1]}">
  </div>
  <a class="m-pjax" title="查看大图" href="{$zbp->host}?url=img"><span class="banner-expand segoe">&#xe78b;</span></a>
</div>
<div id="component-content" class="flex-row">
  <div class="component-main">
    <div class="article-panel flex-colum">
      {foreach $articles as $article}
      {template:post-multi}
      {/foreach}
    </div>
    <nav class="component-pagenavi">
      <ul class="pagination flex-row">
        {template:pagebar}
      </ul>
    </nav>
  </div>
  <div class="component-part display-adapt">
    <div class="component-"></div>
  </div>
</div>
{/if}
{template:footer}