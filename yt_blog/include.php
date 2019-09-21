<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin/search_config.php'; // searchplus
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin/articleimage.php'; // searchplus
RegisterPlugin("yt_blog", "ActivePlugin_yt_blog");
function ActivePlugin_yt_blog()
{
  Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu', 'yt_blog_AddMenu');
  Add_Filter_Plugin('Filter_Plugin_Search_Begin', 'yt_blog_SearchMain');
  Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','yt_blog_tags_set');
  Add_Filter_Plugin('Filter_Plugin_Category_Edit_Response', 'yt_blog_Category_Edit_Response');
  Add_Filter_Plugin('Filter_Plugin_Tag_Edit_Response', 'yt_blog_Tag_Edit_Response');
  Add_Filter_Plugin('Filter_Plugin_Edit_Response5', 'yt_blog_Edit_Response5');
}
function yt_blog_AddMenu(&$m)
{
  global $zbp;
  array_unshift($m, MakeTopMenu("root", '主题配置', $zbp->host . "zb_users/theme/yt_blog/main.php?act=explain", "", "topmenu_yt_blog"));
}

function yt_blog_SubMenu($id)
{
  $arySubMenu = array(
    0 => array('基本设置', 'config', 'left', false),
    1 => array('主题说明', 'explain', 'left', false),
  );
  foreach ($arySubMenu as $k => $v) {
    echo '<a href="?act=' . $v[1] . '" ' . ($v[3] == true ? 'target="_blank"' : '') . '><span class="m-' . $v[2] . ' ' . ($id == $v[1] ? 'm-now' : '') . '">' . $v[0] . '</span></a>';
  }
}

function yt_blog_tags_set(&$template)
{
  global $zbp;
  $template->SetTags('yt_blog_bannerurl', $zbp->Config('yt_blog')->bannerurl);
	
}

function InstallPlugin_yt_blog()
{
  global $zbp;
  if (!$zbp->Config('yt_blog')->HasKey('Version')) {
    $zbp->Config('yt_blog')->Version = '1.0';
    $zbp->Config('yt_blog')->bannerurl = $zbp->host .'res/img/EVA_2K-.jpg';//banner的地址
    $zbp->Config('yt_blog')->bannerdes = '图: 冲田总司 作者: 米法厨 Pixiv';//banner的描述
    $zbp->Config('yt_blog')->banneralign = 'center,28%';//banner的描述
    $zbp->SaveConfig('yt_blog');
  }
}
function yt_blog_Edit_Response5()
{
  global $zbp, $article;
  if ($zbp->Config('yt_blog')->seo == "a") {
    echo '<div><label for="meta_gjc"><span style="font-weight: bold;">关键词:</span></label><br></label><input style="width:99%;" type="text" name="meta_gjc" value="' . htmlspecialchars($article->Metas->gjc) . '"/></div>';
    echo '<div><label for="meta_ms"><span style="font-weight: bold;">描述:</span></label><br><input style="width:99%;" type="text" name="meta_ms" value="' . htmlspecialchars($article->Metas->ms) . '"/></div>';
    echo '<div><label for="meta_fjbt"><span style="font-weight: bold;">附加标题（留空即为不显示）:</span></label><br><input style="width:99%;" type="text" name="meta_fjbt" value="' . htmlspecialchars($article->Metas->fjbt) . '"/></div>';
  }
}
function yt_blog_Tag_Edit_Response()
{
  global $zbp, $tag;
  if ($zbp->Config('yt_blog')->seo == "a") {
    echo '<div><label for="meta_gjc"><span style="font-weight: bold;">关键词:</span></label><br></label><input style="width:293px;" type="text" name="meta_gjc" value="' . htmlspecialchars($tag->Metas->gjc) . '"/></div>';
    echo '<div><label for="meta_ms"><span style="font-weight: bold;">描述:</span></label><br><input style="width:293px;" type="text" name="meta_ms" value="' . htmlspecialchars($tag->Metas->ms) . '"/></div>';
    echo '<div><label for="meta_fjbt"><span style="font-weight: bold;">附加标题（留空即为不显示）:</span></label><br><input style="width:293px;" type="text" name="meta_fjbt" value="' . htmlspecialchars($tag->Metas->fjbt) . '"/></div>';
  }
}
function yt_blog_Category_Edit_Response()
{
  global $zbp, $cate;
  if ($zbp->Config('yt_blog')->seo == "a") {
    echo '<div><label for="meta_gjc"><span style="font-weight: bold;">关键词:</span></label><br></label><input style="width:293px;" type="text" name="meta_gjc" value="' . htmlspecialchars($cate->Metas->gjc) . '"/></div>';
    echo '<div><label for="meta_ms"><span style="font-weight: bold;">描述:</span></label><br><input style="width:293px;" type="text" name="meta_ms" value="' . htmlspecialchars($cate->Metas->ms) . '"/></div>';
    echo '<div><label for="meta_fjbt"><span style="font-weight: bold;">附加标题（留空即为不显示）:</span></label><br><input style="width:293px;" type="text" name="meta_fjbt" value="' . htmlspecialchars($cate->Metas->fjbt) . '"/></div>';
  }
}
//卸载主题
function UninstallPlugin_yt_blog()
{
  global $zbp;
	$zbp->DelConfig('yt_blog');
	$zbp->SetHint('good','模块清除成功'); 
}
?>