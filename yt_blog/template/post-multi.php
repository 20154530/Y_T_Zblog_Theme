{php}articleimg::getPics($article,300,160,4);{/php}
<div class="article-item flex-row-adapt">
  {if $article->IMAGE_COUNT>0}
  <a href="{$article.Url}" class="m-pjax image">
    <img src="{$article.IMAGE[0]}" alt="{$article.Title}">
  </a>
  {else}
  <!-- <a href="{$article.Url}" class="m-pjax image">
    <img src="{$zbp->Config('yt_blog')->thumbnail}" alt="{$article.Title}">
  </a> -->
  {/if}
  <div class="art-info flex-colum">
    <div class="title">
      <a class="m-pjax" href="{$article.Url}">{$article.Title}</a>
      {php}$description = trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),128)).'...';{/php}
      <p>{$description}</p>
    </div>
    <ul class="label flex-row-adapt">
      <li>
        <ul class="flex-row">
          <li>
            <span class="segoe">&#xED28;</span>
            <span>{$article.Time('Y-m-d')}</span>
          </li>
          <li>
            <span class="segoe">&#xE7B3;</span>
            <span>{$article.ViewNums}次浏览</span>
          </li>
          <li>
            <span class="segoe">&#xECAA;</span>
            <a href="{$article.Category.Url}" class="m-pjax" rel="category tag">{$article.Category.Name}</a>
          </li>
        </ul>
      </li>
      <li>
        <span class="segoe">&#xE8EC;</span>
        {if !$article.Tags}
        <a href="javascript:;" class="m-pjax" rel="tag">未标识</a>
        {else}
        {foreach $article.Tags as $tagno => $tag}
        {if $tagno <= 6} <a href="{$tag.Url}" class="m-pjax" rel="tag">{$tag.Name}</a>
          {/if}
          {/foreach}
          {/if}
      </li>
    </ul>
  </div>
</div>