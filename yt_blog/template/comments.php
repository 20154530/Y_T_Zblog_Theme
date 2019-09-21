{* Template Name: comments *}
<div id="comments" class="comments">
  <div class="comment">
    {if $socialcomment}
    {$socialcomment}
    {else}
    <div id="post-comment-list">
      <div id="comment-holder" class="">
        {if $article.CommNums}
        <label id="AjaxCommentBegin"></label>
        <div id="comment-list">
          <ol class="commentlist">
            {foreach $comments as $key => $comment}
            {template:comment}
            {/foreach}
          </ol>
        </div>
        <nav id="comments-paginate" class="navigation">
          {template:comments-pagebar}
        </nav>
        <label id="AjaxCommentEnd"></label>
        {/if}
        {template:commentpost}
      </div>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/default.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/highlight.min.js"></script>
      <script src="{$host}zb_users/theme/yt_blog/style/js/marked.min.js"></script>
      <script type="text/javascript">
      marked.setOptions({
        langPrefix: ''
      });
      $(function() {
        hljsrender();
      });
      </script>
    </div>
    {/if}
  </div>
</div>