{if $pagebar}
{$pagenumberpath="M40.59,24A16.59,16.59,0,1,1,24,7.41,16.59,16.59,0,0,1,40.59,24Z"}
{$pagenumberpath_out="M23.59,47.65A23.7,23.7,0,0,1,.78,30.13l3.52-.94A20,20,0,0,0,23.59,44a19.55,19.55,0,0,0,5.1-.88l1,3.5A22.47,22.47,0,0,1,23.59,47.65ZM47.28,24a23.45,23.45,0,0,0-7-16.79L37.72,9.79a20,20,0,0,1,.14,28.29l-.08.07,2.57,2.58A23.46,23.46,0,0,0,47.28,24ZM23.59,4a20.07,20.07,0,0,1,5.18.68l.94-3.52a23.7,23.7,0,0,0-29,16.73l3.52.93A20,20,0,0,1,23.59,4Z"}
{$pagenumberpathviewbox="0 0 48 48"}
{foreach $pagebar.buttons as $k=>$v}
{if $pagebar.PageNow==$k}
<li class="control current">
  {template:pagebar-navsvg}
  <a href="{$v}" class='m-pjax'>{$k}</a>
</li>
{elseif $k=='‹‹' and $pagebar.PageNow!=$pagebar.PageFirst}
{elseif $k=='‹‹' and $pagebar.PageNow==$pagebar.PageFirst}
{elseif $k=='››' and $pagebar.PageNow==$pagebar.PageLast}
{elseif $k=='››' and $pagebar.PageNow!=$pagebar.PageLast}
{elseif $k=='‹'}
<li class="control normal back">
  {template:pagebar-navsvg}
  <a href="{$v}" class="m-pjax segoe">&#xE72B;</a>
</li>
{elseif $k=='›'}
<li class="control normal fore">
  {template:pagebar-navsvg}
  <a href="{$v}" class="m-pjax segoe">&#xE72A;</a>
</li>
{else}
<li class="control normal">
  {template:pagebar-navsvg}
  <a href="{$v}" class='m-pjax '>{$k}</a>
</li>
{/if}
{/foreach}
{/if}