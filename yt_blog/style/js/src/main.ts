///<reference path="blogcontrol.ts" />

var BC = new BlogControl();
var reloadcommentslist = false;

$(function () {
  BlogControl.Singleton.PlayFadeAni("article-item", ".image");
  BlogControl.Singleton.HookNavigationDropdown();
  BlogControl.Singleton.Replyaction = function (id: number) {
    // TODO: attach zblog
    // zbp.plugin.unbind('comment.reply', 'system');
    let com = $('#comment-' + id);
    let aut = com.find('.name').html();
    let rep = $('#commentform');
    let repn = rep.find('.controlpanel.control .repname');
    repn.html('回复 ：<small>' + aut.toString() + '</small>');
    let cancel = rep.find('.controlpanel.control .cancel');
    cancel.show().on('click', function () {
      repn.html('');
      $(this).hide();
      window.location.hash = '#comment-' + id;
    });

    try {
      $('#txaArticle').focus()
    } catch (e) {
    }
    return false;
  }
  BlogControl.Singleton.MDRender = function () {
    let commentsmd = document.getElementById('commentholder-md');
    if (commentsmd != null) {
      // commentsmd.innerHTML = marked(document.getElementById('commentholder').value);
    }
  }
  //#region zbp config
  // function tocommentlist(p, o) {
  //   p = isNaN(p) ? $('#' + p).offset().top : p;
  //   $('body,html').animate({ scrollTop: p }, o ? 0 : 233);
  //   return false
  // }
  // zbp.plugin.on('comment.postsuccess', 'yt_blog', function () {
  //   $('#cancel-comment-reply-link').click();
  // });
  // zbp.plugin.on('comment.get', 'system', function (postid, page) {
  //   $('#cancel-comment-reply-link').trigger('click');
  //   $.get(
  //     bloghost + 'zb_system/cmd.php?act=getcmt&postid=' + postid +
  //     '&page=' + page,
  //     function (data) {
  //       $('#AjaxCommentBegin').nextUntil('#AjaxCommentEnd').remove();
  //       $('#comments-paginate, #comment-list').fadeOut('slow');
  //       var q = $('#comment-list').html();
  //       var p = $('#comments-paginate').html();
  //       $('#comment-list').html(q);
  //       $('#comments-paginate').html(p);
  //       tocommentlist('post-comment-list');
  //       $('#comments-paginate, #comment-list').fadeIn('slow');
  //       $('#AjaxCommentBegin').after(data)
  //     })
  // });
  // zbp.plugin.on(
  //   'comment.postsuccess', 'system',
  //   function (formData, retString, textStatus, jqXhr) {
  //     var objSubmit = $('#inpId').parent('form').find(':submit');
  //     objSubmit.removeClass('loading')
  //       .removeAttr('disabled')
  //       .val(objSubmit.data('orig'));
  //     var data = $.parseJSON(retString);
  //     if (data.err.code !== 0) {
  //       alert(data.err.msg);
  //       throw 'ERROR - ' + data.err.msg
  //     }
  //     if (formData.replyid == '0') {
  //       $('#comment-list .commentlist').prepend(data.data.html);
  //     } else {
  //       $('#comment-' + formData.replyid + ' .children').append(data.data.html);
  //     }
  //       reloadcommentslist = true;
  //       $.pjax.reload('#comments', { fragment: '#comments', timeout: 2400 })
  //     location.hash = '#comment-' + data.data.ID;
  //     zbp.$('#txaArticle').val('');
  //     zbp.userinfo.saveFromHtml()
  //   });
  // var changeicon;
  // $('#float-top-navigation .mainicon .icon').on('mouseenter', function () {
  //   if ($('ICON-Home').css('display') == null)
  //   changeicon = TweenMax.to("#ICON-Y", .24, { morphSVG: "#ICON-Home" });
  // }).on('mouseleave', function () {
  //   changeicon.reverse();
  // });

  //#endregion
});