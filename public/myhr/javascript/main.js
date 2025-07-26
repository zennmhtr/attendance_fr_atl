/*
 * clear_text
 * custom select
 * tabs
 * suggest input
 * tf panel
 * back Page
 * setTimeIn
 * hide popup 
 * preloader
 */



(function ($) {
  "use strict";

  /* clear text
  ------------------------------------------------------------------------------------- */
  const clear_text = function () {
    $(".icon-clear").on("click", function () {
      $(".value_input").val("");
    });
  };
    /* custom select
  ------------------------------------------------------------------------------------- */
  const custom_select = function () {
    var langArray = [];
    $(".default-select option").each(function () {
      var img = $(this).attr("data-thumbnail");
      var text = this.innerText;
      var value = $(this).val();
      var item =
        '<li><img src="' +
        img +
        '" alt="" value="' +
        value +
        '"/><span>' +
        text +
        "</span> </li>";
      langArray.push(item);
    });

    $("#box-select").html(langArray);

    $(".btn-select").html(langArray[0]);
    $(".btn-select").attr("value", "en");

    $("#box-select li").click(function () {
      var img = $(this).find("img").attr("src");
      var value = $(this).find("img").attr("value");
      var text = this.innerText;
      var item =
        '<li><img src="' + img + '" alt="" /><span>' + text + "</span></li>";
      $(".btn-select").html(item);
      $(".btn-select").attr("value", value);
      $(".banks-select").toggle();
    });

    $(".btn-select").click(function () {
      $(".banks-select").toggle();
    });

    var sessionLang = localStorage.getItem("lang");
    if (sessionLang) {
      var langIndex = langArray.indexOf(sessionLang);
      $(".btn-select").html(langArray[langIndex]);
      $(".btn-select").attr("value", sessionLang);
    } else {
      var langIndex = langArray.indexOf("ch");
      $(".btn-select").html(langArray[langIndex]);
    }
  };
    /* tabs
  ------------------------------------------------------------------------------------- */
  const tfTabs = function () {
    $(".tf-tab").each(function () {
      $(this).find(".content-tab").children().hide();
      $(this).find(".content-tab").children().first().show();
      $(this)
        .find(".menu-tabs")
        .children(".nav-tab")
        .on("click", function (e) {
          e.preventDefault();
          var liActive = $(this).index();
          var contentActive = $(this)
            .siblings()
            .removeClass("active")
            .parents(".tf-tab")
            .find(".content-tab")
            .children()
            .eq(liActive);
          contentActive.addClass("active").fadeIn("slow");
          contentActive.siblings().removeClass("active");
          $(this)
            .addClass("active")
            .parents(".tf-tab")
            .find(".content-tab")
            .children()
            .eq(liActive)
            .siblings()
            .hide();
        });
    });
  };
   /* suggest input
  ------------------------------------------------------------------------------------- */
  const suggestInput = function () {
    $(".tag-money").on("click", function () {
      var val = $(this).text();
      $(".value_input").val(val);
    });
  };
   /* tf panel
  ------------------------------------------------------------------------------------- */
  const tfPanel = function () {
    var panelUp = $(".up");
    var panelDown = $(".down");
    var panelLeft = $(".left");
    var panelRight = $(".right");
    var panelScanQR = $(".scan");
    if (panelUp.length) {
      const open = function () {
        panelUp.addClass("panel-open");
      };
      const close = function () {
        panelUp.removeClass("panel-open");
      };

      $("#btn-popup-up").on("click", function () {
        open();
      });
      $(".panel_overlay, .clear-panel").on("click", function () {
        close();
      });
    }
    if (panelDown.length) {
      const open = function () {
        panelDown.addClass("panel-open");
      };
      const close = function () {
        panelDown.removeClass("panel-open");
      };

      $("#btn-popup-down").on("click", function () {
        open();
      });
      $(".panel_overlay, .clear-panel").on("click", function () {
        close();
      });
    }
    if (panelLeft.length) {
      const open = function () {
        panelLeft.addClass("panel-open");
      };
      const close = function () {
        panelLeft.removeClass("panel-open");
      };

      $("#btn-popup-left").on("click", function () {
        open();
      });
      $(".panel_overlay, .clear-panel").on("click", function () {
        close();
      });
    }
    if (panelRight.length) {
      const open = function () {
        panelRight.addClass("panel-open");
      };
      const close = function () {
        panelRight.removeClass("panel-open");
      };

      $("#btn-popup-right").on("click", function () {
        open();
      });
      $(".panel_overlay, .clear-panel").on("click", function () {
        close();
      });
    }
    if (panelScanQR.length) {
      const close = function () {
        panelScanQR.addClass("panel-close");
        panelScanQR.removeClass("panel-open");
      };
      $(".panel_overlay").on("click", function () {
        close();
      });
    }
   
    if ($(".logout").length){
      $("#btn-logout").on("click", function () {
        $(".logout").addClass("panel-open");
      })
      $(".panel_overlay, .clear-panel").on("click", function () {
        $(".logout").removeClass("panel-open");
      })
      }
    if ($(".lock-app").length){
      $("#btn-lock").on("click", function () {
        $(".lock-app").addClass("panel-open");
      })
      $(".panel_overlay, .clear-panel").on("click", function () {
        $(".lock-app").removeClass("panel-open");
      })
      }
      if ($(".repicient").length){
        $(".btn-repicient").on("click", function () {
          $(".repicient").addClass("panel-open");
        })
        $(".panel_overlay, .clear-panel").on("click", function () {
          $(".repicient").removeClass("panel-open");
        })
        }


    if ($(".card-popup").length){
        $(".btn-card-popup").on("click", function () {
          $(".card-popup").addClass("panel-open");
        })
        $(".panel_overlay, .clear-panel").on("click", function () {
          $(".card-popup").removeClass("panel-open");
        })
        }
    if ($(".recharge").length){
    $("#btn-recharge").on("click", function () {
      $(".recharge").addClass("panel-open");
    })
    $(".overlay-inner, .close").on("click", function () {
      $(".recharge").removeClass("panel-open");
    })
    }
   
  };
  /* back Page
  ------------------------------------------------------------------------------------- */
  const backPage = function () {
    $(".back-btn").on("click", function (e) {
      e.preventDefault();
      window.history.back();
    });
  };
   /* setTimeIn
  ------------------------------------------------------------------------------------- */
  const setTimeIn = function () {
    if ($(".scan").length > 0) {
      setTimeout(function () {
        $(".scan").addClass("panel-open");
      }, 0);
    }
    if ($("#modalhome1").length > 0) {
      let showPopup = sessionStorage.getItem("showPopup");
      if (!JSON.parse(showPopup)) {
        setTimeout(function () {
          $("#modalhome1").modal('show');
        }, 3000);
      }
    }
  };
   /* hide popup 
  ------------------------------------------------------------------------------------- */
  const hidePopupNoti = function () {
    $(".btn-hide-modal").on("click", function () {
      sessionStorage.setItem("showPopup", true);
    });
  };
  
  

  
   /* preloader
  ------------------------------------------------------------------------------------- */
  const preloader = function () {
    setTimeout(function () {
      $(".preload").fadeOut("slow", function () {
        $(this).remove();
      });
    }, 150);
  };
  $(function () {
    clear_text();
    custom_select();
    tfTabs();
    suggestInput();
    tfPanel();
    backPage();
    setTimeIn();
    hidePopupNoti();
    preloader();
  });
})(jQuery);
