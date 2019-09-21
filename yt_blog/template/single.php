{template:header}
<div id="fixed-content-holder">
  <div id="component-content" class="flex-row">
    <div class="component-main">
      <div class="article-panel flex-colum">
        {if $article.Type==ZC_POST_TYPE_ARTICLE}
        {template:post-single}
        {else}
        {template:post-page}
        {/if}
      </div>
    </div>
  </div>
  {template:footer}