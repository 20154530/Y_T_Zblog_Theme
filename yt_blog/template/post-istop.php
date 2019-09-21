{php}articleimg::getPics($article,300,160,4);{/php}
<div class="article-item">
  <div class="article-item-holder">
    <div class="articleBody flex-layout-row">
      <div class="articleThumb">
        {if $article->IMAGE_COUNT>0}
        <a href="{$article.Url}" class="m-pjax"><img src="{$article.IMAGE[0]}" alt="{$article.Title}"
            class="wp-post-image" width="400" height="200" /></a>
        {else}
        <a href="{$article.Url}" class="m-pjax"><img src="{$zbp->Config('yt_blog')->thumbnail}" alt="{$article.Title}"
            class="wp-post-image" width="400" height="200" /></a>
        {/if}
      </div>
      <div class="articleFeed">
        <a class="m-pjax articleTitle" href="{$article.Url}">{$article.Title}</a>
        {php}$description = trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),128)).'...';{/php}
        <p>{$description}</p>
      </div>
    </div>
    <div class="articleFooter">
      <ul>
        <li>
          <span class="segoe">&#xED28;</span>
          <span>{$article.Time('Y-m-d')}</span>
        </li>
        <li>
          <span class="segoe">&#xE7B3;</span>
          <span>{$article.ViewNums}次浏览</span>
        </li>
      </ul>
      <ul>
        <li>
          <span class="segoe">&#xECAA;</span>
          <a href="{$article.Category.Url}" class="m-pjax" rel="category tag">{$article.Category.Name}</a>
        </li>
        <li>
          <span class="segoe">&#xE8EC;</span>
          {if !$article.Tags}
          <a href="javascript:;" class="m-pjax" rel="tag">未标识</a>
          {else}
          {foreach $article.Tags as $tag}
          <a href="{$tag.Url}" class="m-pjax" rel="tag">{$tag.Name}</a>
          {/foreach}
          {/if}
        </li>
      </ul>
    </div>
    <div class="articleOpt colorTransition">
      <a href="{$article.Url}" class="m-pjax">
        <span class="segoe article-more">&#xE974;</span>
      </a>
    </div>
  </div>
</div>