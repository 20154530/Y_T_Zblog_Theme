{* Template Name: footer *}
<footer>
  <div id="fixed-bottom-footer" class="flex-layout-row">
    <div class="footer-holder">
      <div class="footer-links">
        {if $type=='index'&&$page=='1'}
        <span class="title">友情链接</span>
        <div class="links">
          {module:link}
        </div>
        {else}
        <span class="title">最近发表</span>
        <div class="links">
          {module:previous}
        </div>
        {/if}
      </div>
      <div class="footer-copyright">
        <span>{$copyright}</span>
      </div>
    </div>
  </div>
</footer>
<!-- floatcontrol -->


<script src="{$host}zb_users/theme/yt_blog/style/js/jquery.totop.min.js"></script>
<script>
  $('.previous a').addClass('m-pjax');
</script>
</div>

</body>

</html>