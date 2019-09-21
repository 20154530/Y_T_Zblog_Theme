{if $pagebar}
{foreach $pagebar.buttons as $k=>$v}
{if $pagebar.PageNow==$k}
<span class='page-numbers current'>{$k}</span>
{elseif $k=='‹‹' and $pagebar.PageNow!=$pagebar.PageFirst}
{elseif $k=='‹‹' and $pagebar.PageNow==$pagebar.PageFirst}
{elseif $k=='››' and $pagebar.PageNow==$pagebar.PageLast}
{elseif $k=='››' and $pagebar.PageNow!=$pagebar.PageLast}
{elseif $k=='‹'}
<a href="{$v}" class="prev page-numbers">上一页</a>
{elseif $k=='›'}
<a href="{$v}" class="next page-numbers">下一页</a>
{else}
<a href="{$v}" class='page-numbers'>{$k}</a>
{/if}
{/foreach}
{/if}