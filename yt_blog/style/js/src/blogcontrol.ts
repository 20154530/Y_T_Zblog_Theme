class BlogControl {
  public static Singleton: BlogControl;
  public Replyaction: Function = function () { };
  public MDRender: Function = function () { };

  public constructor() {
    BlogControl.Singleton = this;
  }

  //#region Method private
  /**                 */
  public OnEventChangeClass(element: HTMLElement, event: string, classadd: string, classremove: string) {
    element.addEventListener(event, function () {
      element.classList.remove(classremove);
      element.classList.add(classadd);
    }, false);
  }

  /**
   * 导航菜单事件挂钩
   */
  public HookNavigationDropdown() {
    var mutex: JQuery<HTMLElement>;
    if (navigator.userAgent.match(/mobile/i)) {
      $('#menu-mobile').on('mousedown', function () {
        $(document).off('mousedown', BlogControl.Singleton.hidelist);
        let nav = $('#float-top-navigation');
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
        let nowdd = $(this).parent();
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
  }
  //#endregion

  public PlayFadeAni(elenameholder: string, elementSelector: string) {
    let anieles = document.getElementsByClassName(elenameholder);
    if (anieles != null)
      for (let i = 0; i < anieles.length; i++) {
        let ele = anieles[i] as HTMLElement;
        ele = ele.querySelector(elementSelector) as HTMLElement;
        if (ele != null) {
          this.OnEventChangeClass(ele, "mouseleave", 'fadein', 'fadeout');
          this.OnEventChangeClass(ele, "mouseleave", 'fadeout', 'fadein');
        }
      }
  }

  public Post(){
    // let commentcontent = document.getElementById('txaArticle');
    // commentcontent.value = marked(document.getElementById('commentholder').value);
    // zbp.comment.post();
  }

  public OnReply(id: number) {
    this.Replyaction(id);
  }

  public ShowMD() {
    let flag = !$('#commentform .controlpanel.control .mdbtn').hasClass('select');
    this.SwitchElementState('#commentform .controlpanel.control .mdbtn', flag);
    if (flag) {
      $('#commentholder-md-holder').show();
      $('#commentholder').hide();
      this.MDRender();
    } else {
      $('#commentholder-md-holder').hide();
      $('#commentholder').show();
    }
  }

  public hidelist() {
    $('#float-top-navigation').removeClass('list-on');
  }

  public SwitchElementState(elementname: string, flag: boolean) {
    let ele = $(elementname);
    flag ? ele.addClass('select') : ele.removeClass('select');
  }
}