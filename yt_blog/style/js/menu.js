/* 评论框相关 */
var reloadcommentslist = false;
function c(p, o) {
  p = isNaN(p) ? $('#' + p).offset().top : p;
  $('body,html').animate({ scrollTop: p }, o ? 0 : 233);
  return false
}
zbp.plugin.unbind('comment.reply', 'system');
zbp.plugin.on('comment.reply', 'yt_blog', function (i) {
  $('#inpRevID').val(i);
  var p = $('#comment-' + i);
  var o = p.find('.author_name').html();
  $('#reply-name').html(o);
  cancel = $('#cancel-comment-reply-link'), cancel.show();
  $('#reply-title').show();
  cancel.click(function () {
    $('#inpRevID').val(0);
    $('#reply-name').html('');
    $('#reply-title').hide();
    $(this).hide();
    window.location.hash = '#comment-' + i;
    return false;
  });
  try {
    $('#txaArticle').focus()
  } catch (e) {
  }
  return false
});
zbp.plugin.on(
  'comment.postsuccess', 'system',
  function (formData, retString, textStatus, jqXhr) {
    var objSubmit = $('#inpId').parent('form').find(':submit');
    objSubmit.removeClass('loading')
      .removeAttr('disabled')
      .val(objSubmit.data('orig'));
    var data = $.parseJSON(retString);
    if (data.err.code !== 0) {
      alert(data.err.msg);
      throw 'ERROR - ' + data.err.msg
    }
    if (formData.replyid == '0') {
      $('#comment-list .commentlist').prepend(data.data.html);
    } else {
      $('#comment-' + formData.replyid + ' .children').append(data.data.html);
    }
    if (!document.body.querySelector('#comments')
      .classList.contains('list')) {
      reloadcommentslist = true;
      $.pjax.reload('#comments', { fragment: '#comments', timeout: 2400 })
    }
    location.hash = '#comment-' + data.data.ID;
    zbp.$('#txaArticle').val('');
    zbp.userinfo.saveFromHtml()
  });
zbp.plugin.on('comment.postsuccess', 'yt_blog', function () {
  $('#cancel-comment-reply-link').click();
});
zbp.plugin.on('comment.get', 'system', function (postid, page) {
  $('#cancel-comment-reply-link').trigger('click');
  $.get(
    bloghost + 'zb_system/cmd.php?act=getcmt&postid=' + postid +
    '&page=' + page,
    function (data) {
      $('#AjaxCommentBegin').nextUntil('#AjaxCommentEnd').remove();
      $('#comments-paginate, #comment-list').fadeOut('slow');
      var q = $('#comment-list').html();
      var p = $('#comments-paginate').html();
      $('#comment-list').html(q);
      $('#comments-paginate').html(p);
      c('post-comment-list');
      $('#comments-paginate, #comment-list').fadeIn('slow');
      $('#AjaxCommentBegin').after(data)
    })
});
/* 评论markdown */
var CommentControl;
var CC = function () { };
CC.prototype.post = function () {
  let commentcontent = document.getElementById('txaArticle');
  commentcontent.value = marked(document.getElementById('commentholder').value);
  zbp.comment.post();
};
CC.prototype.showmd = function () {
  if ($('#commentholder-md-holder').css('display') == 'none') {
    document.getElementById('commentholder-md').innerHTML =
      marked(document.getElementById('commentholder').value);
    $('#commentholder-md-holder').css('display', 'block');
    $('#commentholder').css('display', 'none');
    $('.comment-control.top .btn').addClass('pressed');
  } else {
    $('#commentholder-md-holder').css('display', 'none');
    $('#commentholder').css('display', 'block');
    $('.comment-control.top .btn').removeClass('pressed');
  }
};
CommentControl = new CC;

function hljsrender() {
  document.querySelectorAll('pre code').forEach((block) => {
    hljs.highlightBlock(block);
  });
}

/* 界面控制*/
function navigationbarswitch() {
  $('#float-top-navigation').hasClass('list-on') ?
    $('#float-top-navigation').removeClass('list-on') :
    $('#float-top-navigation').addClass('list-on');
}

$(function () {
  var sUserAgent = navigator.userAgent.toLowerCase();
  var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
  var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
  var bIsMidp = sUserAgent.match(/midp/i) == "midp";
  var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
  var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
  var bIsAndroid = sUserAgent.match(/android/i) == "android";
  var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
  var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";

  if (!(bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM)) {
    ytblog.bannerheight = 320;
  } else {
    ytblog.bannerheight = 240;
  }
});