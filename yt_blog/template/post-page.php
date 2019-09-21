<div class="article-detail message">
  <div class="title">{$article.Title}</div>
  {if !$article.IsLock}
  {template:comments}
  {/if}
</div>