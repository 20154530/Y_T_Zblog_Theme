{* Template Name: commentform *}
<form id="commentform" class="commentform flex-column" target="_self" method="post" action="{$article.CommentPostUrl}">
  <input id="inpId" type="hidden" name="inpId" value="{$article.ID}" />
  <input id="inpRevID" type="hidden" name="inpRevID" value="0" />
  <div class="controlpanel control flex-row">
    <label class="repname"></label>
    <span id="cancel-comment-reply-link" class="segoe cancel" title="取消回复">&#xE711;</span>
    <div class="flex-spring"></div>
    <svg class="mdbtn" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 16 16" width="16" height="16"
         version="1.1" onclick="BlogControl.Singleton.ShowMD();">
      <title>预览Markdown</title>
      <path fill-rule="evenodd"
            d="M 14.85 3 H 1.15 C 0.52 3 0 3.52 0 4.15 v 7.69 C 0 12.48 0.52 13 1.15 13 h 13.69 c 0.64 0 1.15 -0.52 1.15 -1.15 v -7.7 C 16 3.52 15.48 3 14.85 3 Z M 9 11 H 7 V 8 L 5.5 9.92 L 4 8 v 3 H 2 V 5 h 2 l 1.5 2 L 7 5 h 2 v 6 Z m 2.99 0.5 L 9.5 8 H 11 V 5 h 2 v 3 h 1.5 l -2.51 3.5 Z">
      </path>
    </svg>
  </div>

  <textarea id="txaArticle" name="txaArticle" style="display:none"></textarea>
  <textarea id="commentholder" class="commentholder-format" tabindex="1" placeholder="在这里输入评论...." required></textarea>
  <div id="commentholder-md-holder" style="display: none">
    <div id="commentholder-md" class="commentholder-format render-md"></div>
  </div>
  <div class="controlpanel info flex-row-adapt">
    <div class="flex-row">
      {if $user.ID>0}
      <input type="hidden" name="inpName" id="inpName" value="{$user.Name}" />
      <input type="hidden" name="inpEmail" id="inpEmail" value="{$user.Email}" />
      <input type="hidden" name="inpHomePage" id="inpHomePage" value="{$user.HomePage}" />
      {else}
      <label id="author_name" for="inpName">
        <input id="inpName" type="text" tabindex="2" value="" name="inpName" placeholder="▪ 昵称[必填]" required>
      </label>
      <label id="author_email" for="inpEmail">
        <input id="inpEmail" type="text" tabindex="3" value="" name="inpEmail" placeholder="▪ 邮箱[必填]" required>
      </label>
      <label id="author_website" for="inpHomePage">
        <input id="inpHomePage" type="text" tabindex="4" value="" name="inpHomePage" placeholder="▪ 网址[可不填]">
      </label>
      {/if}
    </div>
    <p class="flex-spring display-adapt"></p>
    <label class="btn-sub flex-row" for="submit">
      <span class='segoe' title="提交评论">&#xE97A;</span>
      <input id="submit" class="comment-submit" name="sumbit" type="submit" tabindex="5" onclick="BlogControl.Singleton.Post();" value="提交" />
    </label>
  </div>
</form>