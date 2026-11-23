const t_time1 = document.getElementById("txt-time1"),
  t_date = document.getElementById("txt-date"),
  w1to6 = document.getElementById("waiting1to6"),
  p1to6 = document.getElementById("pending1to6");

let x = document.getElementById("bell"),
  dt_serving = null,
  _dt_serving = false,
  dt_serving_count = 0,
  // dt_serving_payment = null,
  // _dt_serving_payment = false,
  // dt_serving_count_payment = 0,
  _oras = null,
  _d = null,
  dd = new Date(),
  html,
  html1,
  i,
  weekday = new Array(
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday"
  ),
  // _month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  _m = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ],
  video_list = [],
  video_index = 0,
  video_player = document.getElementById("videoplayer");

var getJSON = function (url) {
  return new Promise(function (resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open("get", url, true);
    xhr.responseType = "json";
    xhr.onload = function () {
      var status = xhr.status;
      if (status == 200) {
        resolve(xhr.response);
      } else {
        reject(status);
      }
    };
    xhr.send();
  });
};

//document ready
// document.onreadystatechange = () => {
//   if (document.readyState === 'complete') {
getJSON(base_url + "viewing/ajax_get_file").then(
  function (data) {
    if ((data.status = "yes")) {
      video_list = data.content;
      video_player.setAttribute("src", video_list[video_index]);
      var promise = video_player.play();
      video_player.volume = 0.9;

      if (promise !== undefined) {
        promise
          .then((_) => {
            // Autoplay started!
          })
          .catch((error) => {
            // Autoplay was prevented.
            // Show a "Play" button so that user can start playback.
          });
      }
    }
  },
  function (status) {
    // alert('Something went wrong.');
  }
);
//   }
// };

const playAudio = () => x.play();
const pauseAudio = () => x.pause();
const onvideoended = () => {
  if (video_index < video_list.length - 1) {
    video_index++;
  } else {
    video_index = 0;
  }
  video_player.setAttribute("src", video_list[video_index]);
  // video_player.play();

  var promise = video_player.play();

  if (promise !== undefined) {
    promise
      .then((_) => {
        // Autoplay started!
        // video_player.play();
      })
      .catch((error) => {
        // Autoplay was prevented.
        // Show a "Play" button so that user can start playback.
      });
  }
};

var myVar = setInterval(myTimer, 1000);

function myTimer() {
  var d = new Date();
  t_time1.innerHTML = d.toLocaleTimeString().replace(/:(\d{2}) (?=[AP]M)/, " ");
}

function ifpayment(p) {
  return (p = p == "NO" ? "" : "PAYMENT ONLY");
}

function iftype(p, type, status) {
  txt = "";

  if (type == "REGULAR") {
    txt = "Assessment";
  } else if (type == "SPECIAL") {
    txt = "Assessment - PWDs, Senior, Pregnant";
  } else if (type == "REGULAR5-10") {
    txt = "Payment";
  } else if (type == "SPECIAL5-10") {
    txt = "Payment - PWDs, Senior, Pregnant";
  }

  // txt = "(PAYMENT) PWDs, Senior, Pregnant";
  // if (p == "YES") {
  //   if (type == "SPECIAL-TAX") {
  //     txt = "(PAYMENT) PWDs, Senior, Pregnant";
  //   } else if (type == "REGULAR-TAX") {
  //     txt = "Tax Bill/ Closure";
  //   } else {
  //     txt = "Payment Only";
  //   }
  // } else {
  //   if (type == "REGULAR-TAX" || type == "SPECIAL-TAX") {
  //     txt = "Tax Bill/ Closure";
  //   } else if (type == "REGULAR") {
  //     txt = status == "VERIFY" ? "Assessment - verifiying" : "Payment";
  //   } else if (type == "SPECIAL") {
  //     txt = "(Assessment) PWDs, Senior, Pregnant";
  //   } else if (type == "SPECIAL5-10") {
  //     txt = "(Assessment 5-10) PWDs, Senior, Pregnant";
  //   } else if (type == "RELEASING-REGULAR" || type == "RELEASING-SPECIAL") {
  //     txt = "Releasing";
  //   }
  // }
  return txt;
}

// $(function() {
// t_date.innerHTML =  weekday[dd.getDay()] + "<br>" + dd.getUTCDate() + " " + _m[dd.getUTCMonth()] + " " + dd.getUTCFullYear().toString().substr(-2);
t_date.innerHTML =
  dd.getUTCDate() +
  " " +
  _m[dd.getUTCMonth()] +
  " " +
  dd.getUTCFullYear().toString().substr(-2);

dt_serving = $("#dt_serving").DataTable({
  ajax: {
    type: "GET",
    // "url": base_url + "transaction/ajax_get_cassessment",
    url: base_url + "_getviewing.txt",
    dataSrc: "serving",
  },
  columns: [
    {
      data: function (data) {
        return `
                <div class="col-left">${data.number} <span>${iftype(
          data.ifpayment,
          data.type,
          data.status
        )}</span></div>
                <div class="col-right">${data.window}<span>window</span></div>
                `;
      },
    },
  ],
  scrollCollapse: true,
  info: false,
  paging: false,
  searching: false,
  ordering: false,
  fnCreatedRow: function (nRow, data, iDisplayIndex) {
    $(nRow).attr("data-id", data.id);
    $(nRow).attr("data-id", data.id);
    $(nRow).addClass("payment-" + data.ifpayment);
  },
  initComplete: function (oSettings, json) {
    // get_waiting();
    _dt_serving = true;
  },
});

// dt_serving_payment = $("#dt_serving_payment").DataTable({
//   ajax: {
//     type: "GET",
//     // "url": base_url + "transaction/ajax_get_cassessment",
//     url: base_url + "_getviewing.txt",
//     dataSrc: "serving_payment",
//   },
//   columns: [
//     {
//       data: function (data) {
//         return `
//                 <div class="col-left">${data.number} <span>${iftype(
//           data.ifpayment,
//           data.type,
//           data.status
//         )}</span></div>
//                 <div class="col-right">${data.window}<span>window</span></div>
//                 `;
//       },
//     },
//   ],
//   scrollCollapse: true,
//   info: false,
//   paging: false,
//   searching: false,
//   ordering: false,
//   fnCreatedRow: function (nRow, data, iDisplayIndex) {
//     $(nRow).attr("data-id", data.id);
//     $(nRow).attr("data-id", data.id);
//     $(nRow).addClass("payment-" + data.ifpayment);
//   },
//   initComplete: function (oSettings, json) {
//     // get_waiting();
//     _dt_serving_payment = true;
//   },
// });

// });

/*
function get_waiting() {
  getJSON(base_url + '_getwaiting.txt?' + dd.getTime()).then(function(data) {
    if (data.status = "yes") {

      var _wl = data.waiting1to6.length,
        _pl = data.pending1to6.length;

      //waiting
      if (data.waiting1to6 != 0) {
        html = [];
        for (i = 0; i < _wl; i++) {
          if (i == 0 || i == 3)
            html.push(`<ul class='vcol-list-50 bright'>`);
            html.push(`<li><span>${(i + 1)}. </span>${data.waiting1to6[i].number}</li>`);
          if (i == 2 || i == 5)
            html.push(`</ul>`);
          }
        w1to6.innerHTML = html.join('');
      } else {
        w1to6.innerHTML = `&nbsp;`
      }

      //pending
      if (data.pending1to6 != 0) {
        html1 = [];
        for (i = 0; i < _pl; i++) {

          if (i == 0 || i == 3)
            html1.push(`<ul class='vcol-list-50 bright'>`);
            html1.push(`<li><span>${(i + 1)}. </span>${data.pending1to6[i].number}</li>`);
          if (i == 2 || i == 5)
            html1.push(`</ul>`);
          }
        p1to6.innerHTML = html1.join('');
      } else {
        p1to6.innerHTML = `&nbsp;`
      }

    } else {}

  }, function(status) {
    // alert('Something went wrong.');
  });
}
*/

//viewing
Comet1 = Class.create();
Comet1.prototype = {
  timestamp: 0,
  url: base_url + "_viewing.php",
  noerror: true,
  initialize: function () {},
  connect: function () {
    this.ajax = new Ajax.Request(this.url, {
      method: "get",
      parameters: {
        timestamp: this.timestamp,
      },
      onSuccess: function (transport) {
        var response = transport.responseText.evalJSON();
        this.comet1.timestamp = response["timestamp"];
        this.comet1.handleResponse(response);
        this.comet1.noerror = true;
      },
      onComplete: function (transport) {
        if (!this.comet1.noerror)
          setTimeout(function () {
            comet1.connect();
          }, 5000);
        else this.comet1.connect();
        this.comet1.noerror = false;
      },
    });
    this.ajax.comet1 = this;
  },
  disconnect: function () {},
  handleResponse: function (response) {
    if (_dt_serving == true) {
      // get_waiting();
      dt_serving.ajax.reload(function (json) {
        if (dt_serving.data().count() > dt_serving_count) {
          // x.play();

          var promise = x.play();

          if (promise !== undefined) {
            promise
              .then((_) => {
                // Autoplay started!
              })
              .catch((error) => {
                // Autoplay was prevented.
                // Show a "Play" button so that user can start playback.
              });
          }
        }
        dt_serving_count = dt_serving.data().count();
      });
    }
    // if (_dt_serving_payment == true) {
    //   // get_waiting();
    //   dt_serving_payment.ajax.reload(function (json) {
    //     if (dt_serving_payment.data().count() > dt_serving_count_payment) {
    //       // x.play();

    //       var promise = x.play();

    //       if (promise !== undefined) {
    //         promise
    //           .then((_) => {
    //             // Autoplay started!
    //           })
    //           .catch((error) => {
    //             // Autoplay was prevented.
    //             // Show a "Play" button so that user can start playback.
    //           });
    //       }
    //     }
    //     dt_serving_count_payment = dt_serving_payment.data().count();
    //   });
    // }
  },
  doRequest: function (request) {
    new Ajax.Request(this.url, {
      method: "get",
      parameters: {
        msg: request,
      },
    });
  },
};
var comet1 = new Comet1();
comet1.connect();

//mic
var Comet4 = Class.create();
Comet4.prototype = {
  timestamp: 0,
  url: base_url + "_mic_check.php",
  noerror: true,
  initialize: function () {},
  connect: function () {
    this.ajax = new Ajax.Request(this.url, {
      method: "get",
      parameters: {
        timestamp: this.timestamp,
      },
      onSuccess: function (transport) {
        // handle the server response
        var response = transport.responseText.evalJSON();
        this.comet4.timestamp = response["timestamp"];
        this.comet4.handleResponse(response);
        this.comet4.noerror = true;
      },
      onComplete: function (transport) {
        if (!this.comet4.noerror)
          setTimeout(function () {
            comet4.connect();
          }, 5000);
        else this.comet4.connect();
        this.comet4.noerror = false;
      },
    });
    this.ajax.comet4 = this;
  },
  disconnect: function () {},
  handleResponse: function (response) {
    var promise = x.play();

    if (promise !== undefined) {
      promise
        .then((_) => {
          // Autoplay started!
        })
        .catch((error) => {
          // Autoplay was prevented.
          // Show a "Play" button so that user can start playback.
        });
    }
  },
  doRequest: function (request) {
    new Ajax.Request(this.url, {
      method: "get",
      parameters: {
        msg: request,
      },
    });
  },
};
var comet4 = new Comet4();
comet4.connect();
