"use strict";
var BlogControl = /** @class */ (function () {
    function BlogControl() {
        this.Replyaction = function () { };
        this.MDRender = function () { };
        BlogControl.Singleton = this;
    }
    //#region Method private
    /**                 */
    BlogControl.prototype.OnEventChangeClass = function (element, event, classadd, classremove) {
        element.addEventListener(event, function () {
            element.classList.remove(classremove);
            element.classList.add(classadd);
        }, false);
    };
    BlogControl.prototype.HookNavigationDropdown = function () {
        var mutex;
        if (navigator.userAgent.match(/mobile/i)) {
            $('#menu-mobile').on('mousedown', function () {
                $(document).off('mousedown', BlogControl.Singleton.hidelist);
                var nav = $('#float-top-navigation');
                nav.hasClass('list-on') ? nav.removeClass('list-on') : nav.addClass('list-on');
            }).on('mouseup', function () {
                $(document).on('mousedown', BlogControl.Singleton.hidelist);
            });
            $('#float-top-navigation .control').on('mousedown', function () {
                $(document).off('mousedown', BlogControl.Singleton.hidelist);
            }).on('mouseup', function () {
                $(document).on('mousedown', BlogControl.Singleton.hidelist);
            });
            $('#float-top-navigation .control .item-content').on('mousedown', function () {
                var nowdd = $(this).parent();
                !nowdd.hasClass('list-on') ? nowdd.addClass('list-on') : nowdd.removeClass('list-on');
                mutex == null ? mutex = nowdd : mutex.is(nowdd) ? null : mutex.removeClass('list-on'), mutex = nowdd;
            });
        }
        else {
            $('#float-top-navigation .control .item').on('mouseenter', function () {
                $(this).addClass('list-on');
            }).on('mouseleave', function () {
                $(this).removeClass('list-on');
            });
        }
    };
    //#endregion
    BlogControl.prototype.PlayFadeAni = function (elenameholder, elementSelector) {
        var anieles = document.getElementsByClassName(elenameholder);
        if (anieles != null)
            for (var i = 0; i < anieles.length; i++) {
                var ele = anieles[i];
                ele = ele.querySelector(elementSelector);
                if (ele != null) {
                    this.OnEventChangeClass(ele, "mouseleave", 'fadein', 'fadeout');
                    this.OnEventChangeClass(ele, "mouseleave", 'fadeout', 'fadein');
                }
            }
    };
    BlogControl.prototype.Post = function () {
        let commentcontent = document.getElementById('txaArticle');
        commentcontent.value = marked(document.getElementById('commentholder').value);
        zbp.comment.post();
    };
    BlogControl.prototype.OnReply = function (id) {
        this.Replyaction(id);
    };
    BlogControl.prototype.ShowMD = function () {
        var flag = !$('#commentform .controlpanel.control .mdbtn').hasClass('select');
        this.SwitchElementState('#commentform .controlpanel.control .mdbtn', flag);
        if (flag) {
            $('#commentholder-md-holder').show();
            $('#commentholder').hide();
            this.MDRender();
        }
        else {
            $('#commentholder-md-holder').hide();
            $('#commentholder').show();
        }
    };
    BlogControl.prototype.hidelist = function () {
        $('#float-top-navigation').removeClass('list-on');
    };
    BlogControl.prototype.SwitchElementState = function (elementname, flag) {
        var ele = $(elementname);
        flag ? ele.addClass('select') : ele.removeClass('select');
    };
    return BlogControl;
}());
///<reference path="blogcontrol.ts" />
var BC = new BlogControl();
var reloadcommentslist = false;
$(function () {
    BlogControl.Singleton.PlayFadeAni("article-item", ".image");
    BlogControl.Singleton.HookNavigationDropdown();
    BlogControl.Singleton.Replyaction = function (id) {
        // TODO: attach zblog
        zbp.plugin.unbind('comment.reply', 'system');
        var com = $('#comment-' + id);
        var aut = com.find('.name').html();
        var rep = $('#commentform');
        var repn = rep.find('.controlpanel.control .repname');
        repn.html('回复 ：<small>' + aut.toString() + '</small>');
        var cancel = rep.find('.controlpanel.control .cancel');
        cancel.show().on('click', function () {
            repn.html('');
            $(this).hide();
            window.location.hash = '#comment-' + id;
        });
        try {
            $('#txaArticle').focus();
        }
        catch (e) {
        }
        return false;
    };
    BlogControl.Singleton.MDRender = function () {
        var commentsmd = document.getElementById('commentholder-md');
        if (commentsmd != null) {
            commentsmd.innerHTML = marked(document.getElementById('commentholder').value);
        }
    };
    //#region zbp config
    function tocommentlist(p, o) {
      p = isNaN(p) ? $('#' + p).offset().top : p;
      $('body,html').animate({ scrollTop: p }, o ? 0 : 233);
      return false
    }
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
          tocommentlist('post-comment-list');
          $('#comments-paginate, #comment-list').fadeIn('slow');
          $('#AjaxCommentBegin').after(data)
        })
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
          reloadcommentslist = true;
          $.pjax.reload('#comments', { fragment: '#comments', timeout: 2400 })
        location.hash = '#comment-' + data.data.ID;
        zbp.$('#txaArticle').val('');
        zbp.userinfo.saveFromHtml()
      });
    var changeicon;
    $('#float-top-navigation .mainicon .icon').on('mouseenter', function () {
      if ($('ICON-Home').css('display') == null)
      changeicon = TweenMax.to("#ICON-Y", .24, { morphSVG: "#ICON-Home" });
    }).on('mouseleave', function () {
      changeicon.reverse();
    });
    //#endregion
});
