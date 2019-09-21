{* Template Name: comment *}
<li class="comment-item flex-column" id="comment-{$comment.ID}">
  <div class="media flex-row">
    <div class="avatar">
      <img alt='avatar' src='res\img\Cybran_Y-01.png' height='48' width='48' />
    </div>
    <div class="flex-column">
      <a class="name" href="{$comment.Author.HomePage}">
        {$comment.Author.Name}
      </a>
      <span class="pub-time">{$comment.Time('Y-m-d H:i')}</span>
      <div calss="rep md-style">{$comment.Content}</div>
    </div>
  </div>
  <span class="btn-reply">
    <a rel='nofollow' class='comment-reply-link' href='#respond'
       onclick="BlogControl.Singleton.OnReply('{$comment.ID}')">回复</a>
  </span>
  <ol class="children">
    {foreach $comment.Comments as $comment}
    {template:comment}
    {/foreach}
  </ol>
</li>