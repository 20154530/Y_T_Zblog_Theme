{* Template Name: article *}
<div class="article-detail flex-column">
  <div class="flex-column">
    <div class="title">{$article.Title}</div>
    <div class="sub-title flex-row">
      <span>
        <span>文章分类</span>
        <span>
          <a href="{$article.Category.Url}" class="m-pjax" rel="category tag">{$article.Category.Name}</a>
        </span>
      </span>
      <span>
        <span>创建时间</span>
        <span>{$article.Time('Y-m-d')}</span>
      </span>
      <span>
        <span>浏览次数</span>
        <span>{$article.ViewNums}</span>
      </span>
      <span>
        <span>评论</span>
        <span><a href="#comments">{$article.CommNums}</a> </span>
      </span>
    </div>
    <div class="content md-style">{$article.Content}</div>
    <div class="tags">
      <ul>
        <span class="segoe">&#xE8EC;</span>
        {if !$article.Tags}
        <a href="javascript:;" class="m-pjax" rel="tag">未标识</a>
        {else}
        {foreach $article.Tags as $tag}
        <a href="{$tag.Url}" class="m-pjax" rel="tag">{$tag.Name}</a>
        {/foreach}
        {/if}
      </ul>
    </div>
  </div>
  {if !$article.IsLock}
  {template:comments}
  {/if}
</div>