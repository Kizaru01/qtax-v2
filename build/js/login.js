var p,
  $body = $("body"),
  $document = $(document);
$(function () {
  $("#login_form").on("submit", function () {
    if ($("body .ui-pnotify > .alert-info").length == 0) {
      $.ajax({
        dataType: "json",
        type: "post",
        url: base_url + "account/ajax_signin",
        data: $("#login_form").serialize() + "&isLogin=" + 1,
        beforeSend: function () {
          $("#btn_signin").attr("disabled", "disabled");
          showloader();
        },
        success: function (a) {
          if (a.status == "yes") {
            $(".glyphicon-remove").trigger("click");
            $("#btn_signin").removeAttr("disabled");
            $("#btn_signin").removeAttr("disabled");
            $("#login_form")[0].reset();
            notification("Successfully logged in! Redirecting...");

            if (a.type == "NUMBER") {
              window.location.href = base_url + "number/";
            } else {
              window.location.href = base_url + "transaction/serve";
            }
          } else {
            $("#btn_signin").removeAttr("disabled");
            $("#login_form")[0].reset();
            $(".glyphicon-remove").trigger("click");
            $("#a_username").focus();
            notification("Invalid Username and Password!");
          }
          hideloader();
        },
        error: function (b, a) {
          $(".glyphicon-remove").trigger("click");
          notification("Connection problems occurred... ");
          // new PNotify({
          //     title: "Error",
          //     text: "Connection problems occurred... Unable to connect to the Internet! The Internet connection has been lost.",
          //     type: "error",
          //     styling: "bootstrap3",
          //     delay: 2000
          // });
          $("#btn_signin").removeAttr("disabled");
          $("#login_form")[0].reset();
          $("#a_username").focus();
          hideloader();
        },
      });
      return false;
    }
  });

  $body.delegate("#mdl-mrefresh", "click", function () {
    getAjax(base_url + "account/creset", function (data) {
      var data = JSON.parse(data),
        $modal = $(".modal"),
        $modaloverlay = $(".modal-overlay");
      console.log(data[0].status);
      if (data[0].status == "1") {
        $modal.addClass("modal-in");
        $modaloverlay.addClass("modal-overlay-visible");
      } else {
        $modal.removeClass("modal-in");
        $modaloverlay.removeClass("modal-overlay-visible");
      }
    });
    return false;
  });
});

function showloader() {
  if ($body.children(".progressbar, .progressbar-infinite").length) return;
  $body.append('<span class="progressbar-infinite color-multi "></span>');
}

function hideloader() {
  if ($body.length === 0) return;
  var progressbar, progressbar1;
  progressbar = $body.children(".progressbar-infinite");
  progressbar1 = $body.children(".progressbar-overlay");
  if (progressbar.length === 0) return;
  progressbar.remove();
  progressbar1.remove();
}

function notification(str) {
  document.getElementById("notifications").innerHTML = "<div>" + str + "</div>";

  if (!$("#notifications").hasClass("open")) {
    $("#notifications").addClass("open");
  }
  setTimeout(function () {
    $("#notifications").removeClass("open");
  }, 5000);
}

// var Comet = Class.create();
// Comet.prototype = {
//   timestamp: 0,
//   url: base_url + 'creset.php',
//   noerror: true,
//   initialize: function() {},
//   connect: function() {
//     this.ajax = new Ajax.Request(this.url, {
//       method: 'get',
//       parameters: {
//         'timestamp': this.timestamp
//       },
//       onSuccess: function(transport) {
//         var response = transport.responseText.evalJSON();
//         this.comet.timestamp = response['timestamp'];
//         this.comet.handleResponse(response);
//         this.comet.noerror = true;
//       },
//       onComplete: function(transport) {
//         if (!this.comet.noerror)
//           setTimeout(function() {
//             comet.connect()
//           }, 1000);
//         else
//           this.comet.connect();
//         this.comet.noerror = false;
//       }
//     });
//     this.ajax.comet = this;
//   },
//   disconnect: function() {},
//   handleResponse: function(response) {
//     getAjax(base_url + 'account/creset', function(data) {
//       var data = JSON.parse(data),
//       $modal = $('.modal'),
//       $modaloverlay = $('.modal-overlay');
//       console.log(data[0].status);
//       if (data[0].status == '1') {
//         $modal.addClass('modal-in');
//         $modaloverlay.addClass('modal-overlay-visible');
//       } else {
//         $modal.removeClass('modal-in');
//         $modaloverlay.removeClass('modal-overlay-visible');
//       }
//     });
//   },
//   doRequest: function(request) {
//     new Ajax.Request(this.url, {
//       method: 'get',
//       parameters: {
//         'msg': request
//       }
//     });
//   }
// }
// var comet = new Comet();
// comet.connect();
