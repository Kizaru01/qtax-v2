let $d = $(document),
  b = document.getElementById("body"),
  $tbl_regular = $("#tbl-regular"),
  $tbl_special = $("#tbl-special"),
  $tbl_regular1 = $("#tbl-regular1"),
  $tbl_special1 = $("#tbl-special1"),
  dt_regular = null,
  dt_special = null,
  dt_regular1 = null,
  dt_special1 = null,
  t_regular = document.getElementById("tblbody-regular"),
  t_special = document.getElementById("tblbody-special"),
  t_regular1 = document.getElementById("tblbody-regular1"),
  t_special1 = document.getElementById("tblbody-special1"),
  msg_error = "Still have a pending services",
  rev = document.querySelectorAll("remove"),
  dd = new Date(),
  c = false,
  cc = false,
  c1 = false,
  cc1 = false,
  c2 = false,
  cc2 = false,
  c3 = false,
  cc3 = false,
  _dt_regular = false,
  _dt_special = false,
  _dt_regular1 = false,
  _dt_special1 = false,
  time_out = 200;
time_out1 = 240;

// function otable() {
// showloader();

// $tbl_regular.dataTable().fnClearTable();
// $tbl_regular.dataTable().fnDestroy();

dt_special = $tbl_special.DataTable({
  ajax: {
    type: "GET",
    url: base_url + "_serve_verification.txt",
    dataSrc: "special",
  },
  columns: [
    {
      data: function (data) {
        return data.number + dbutton(data.remarks, data.id, data.window);
      },
    },
  ],
  scrollCollapse: true,
  stripeClasses: [""],
  info: false,
  paging: false,
  searching: false,
  ordering: false,
  fnCreatedRow: function (nRow, data, iDisplayIndex) {
    // $(nRow).addClass(dremarks(data.remarks));
    $(nRow).addClass(data.remarks);
    $(nRow).attr("data-id", data.id);
    $(nRow).addClass(if_serving(data.window, data.remarks));
  },
  initComplete: function (oSettings, json) {
    cc = false;
    cc1 = false;
    _dt_special = true;
    // hideloader();
  },
});

dt_regular = $tbl_regular.DataTable({
  ajax: {
    type: "GET",
    url: base_url + "_serve_verification.txt",
    dataSrc: "regular",
  },
  columns: [
    {
      data: function (data) {
        return data.number + dbutton(data.remarks, data.id, data.window);
      },
    },
  ],
  scrollCollapse: true,
  stripeClasses: [""],
  info: false,
  paging: false,
  searching: false,
  ordering: false,
  fnCreatedRow: function (nRow, data, iDisplayIndex) {
    // $(nRow).addClass(dremarks(data.remarks));
    $(nRow).addClass(data.remarks);
    $(nRow).attr("data-id", data.id);
    $(nRow).addClass(if_serving(data.window, data.remarks));
  },
  initComplete: function (oSettings, json) {
    c = false;
    c1 = false;
    _dt_regular = true;
    // hideloader();
  },
});

dt_regular1 = $tbl_regular1.DataTable({
  ajax: {
    type: "GET",
    url: base_url + "_serve_verification.txt",
    dataSrc: "regular1",
  },
  columns: [
    {
      data: function (data) {
        return data.number + dbutton(data.remarks, data.id, data.window);
      },
    },
  ],
  scrollCollapse: true,
  stripeClasses: [""],
  info: false,
  paging: false,
  searching: false,
  ordering: false,
  fnCreatedRow: function (nRow, data, iDisplayIndex) {
    // $(nRow).addClass(dremarks(data.remarks));
    $(nRow).addClass(data.remarks);
    $(nRow).attr("data-id", data.id);
    $(nRow).addClass(if_serving(data.window, data.remarks));
  },
  initComplete: function (oSettings, json) {
    c3 = false;
    cc3 = false;
    _dt_regular1 = true;
    // hideloader();
  },
});

dt_special1 = $tbl_special1.DataTable({
  ajax: {
    type: "GET",
    url: base_url + "_serve_verification.txt",
    dataSrc: "special1",
  },
  columns: [
    {
      data: function (data) {
        return data.number + dbutton(data.remarks, data.id, data.window);
      },
    },
  ],
  scrollCollapse: true,
  stripeClasses: [""],
  info: false,
  paging: false,
  searching: false,
  ordering: false,
  fnCreatedRow: function (nRow, data, iDisplayIndex) {
    // $(nRow).addClass(dremarks(data.remarks));
    $(nRow).addClass(data.remarks);
    $(nRow).attr("data-id", data.id);
    $(nRow).addClass(if_serving(data.window, data.remarks));
  },
  initComplete: function (oSettings, json) {
    c2 = false;
    cc2 = false;
    _dt_special1 = true;
    // hideloader();
  },
});

// setTimeout(function() {
//   hideloader();
// }, time_out);

// }

// otable();

// function dt_reload(t) {
//   var p = upto(t, "tbody");
//
//   dt_regular.ajax.reload( function ( json ) {
//
//     setTimeout(function() {
//
//       var a = p.querySelectorAll('tr');
//       for (i = 0; i < a.length; i++) {
//         if (a[i].className == "serve") {
//           a[i].className = "fserve";
//          a[i].innerHTML = '<td>' + a[i].textContent + '<i>serve?</i> ' + '<div class="btn-action">' + '<button type="button" class="btn btn-serve" data-id="' + a[i].dataset.id + '" onclick="btn_serve(this)">Serve?</button>' + '</div></td>';
//          return false;
//         }
//       }
//
//       hideloader();
//     }, time_out);
//
//
//   });
// }
//
//

function if_serving(w_no, remarks) {
  var txt = "";

  if (w_no == _w) {
    if (remarks != "pending") {
      txt = "imserving";
    }
  } else {
    // if (w_no != null) {
    if (w_no != "") {
      txt = "otherserving";
    }
  }
  return txt;
}

// function dt_reload(t) {
// var p = upto(t, "tbody");
//
// if (p.className == "b-left") {
//    dt_regular.ajax.reload();
//    console.log("reload dt_regular" );
// } else {
//   dt_special.ajax.reload();
//    console.log("reload dt_special" );
// }

// document.querySelector("table").getElementsByClassName('tr');

// var cl;
// cl = t_regular.children;
// for (i = 0; i <= cl.length - 1; i++) {
//   if (cl[i].className == "serving imserving") {
//     alert(msg_error);
//     return false;
//   }
// }
// cl = t_special.children;
// for (i = 0; i <= cl.length - 1; i++) {
//   if (cl[i].className == "serving imserving") {
//     alert(msg_error);
//     return false;
//   }
// }
// }
// $("#tlist").find("tr").eq(1).click(function(){
// document.getElementById("tbl-regular").getElementsByTagName("tr.serve:first-child td").onclick = function(e) {
//   alert("alert");
// };

// $(document).on('click', '#tblbody-regular tr.serve:first', function(e) {
//    // btn_serve(this);
//    btn_finish(this);
// });
//
// $(document).on('click', '#tblbody-special tr.serve:first', function(e) {
//   // btn_serve(this);
//   btn_finish(this);
// });
//
// $(document).on('click', '#tblbody-regular1 tr.serve:first', function(e) {
//    // btn_serve(this);
//    btn_finish(this);
// });
//
// $(document).on('click', '#tblbody-special1 tr.serve:first', function(e) {
//   // btn_serve(this);
//   btn_finish(this);
// });

function btn_call(t) {
  showloader();
  getJSON(base_url + "transaction/ajax_get_mic?id=prince").then(
    function (data) {
      hideloader();
    },
    function (status) {
      hideloader();
      alert("Something went wrong.");
    }
  );
}

function btn_serve(t) {
  var cl, cll;
  cl = document.querySelectorAll("tr");
  cll = cl.length;
  for (i = cll; i--; ) {
    if (cl[i].className == "serving imserving") {
      alert(msg_error);
      return false;
    }
  }
  r = confirm(
    `Are you sure you want to proceed [payment]: #${$(t).find("td").text()} ?`
  );
  if (r == true) {
    postAjax(
      base_url + "transaction/save_trasaction",
      {
        id: t.dataset.id,
        status: "FINISHED",
        window: _w,
      },
      function (data) {
        // dt_reload(t);
        if (_dt_special == true) dt_special.ajax.reload();
        if (_dt_regular == true) dt_regular.ajax.reload();
        if (_dt_special1 == true) dt_special1.ajax.reload();
        if (_dt_regular1 == true) dt_regular1.ajax.reload();
      }
    );
  }

  return false;
}

function btn_finish(t) {
  openModal(t);

  // r = confirm("Are you sure you want to proceed?");
  // if (r == true) {
  //   postAjax(
  //     base_url + "transaction/save_trasaction",
  //     {
  //       id: t.dataset.id,
  //       status: "FINISHED",
  //       window: _w,
  //     },
  //     function (data) {
  //       // dt_reload(t);
  //     }
  //   );
  // }
}

function btn_pending(t) {
  postAjax(
    base_url + "transaction/save_trasaction",
    {
      id: t.dataset.id,
      status: "PENDING",
      window: _w,
    },
    function (data) {
      // dt_reload(t);
    }
  );
}

// function dremarks(r) {
//   if (r == "serving")
//     c1 = true;
//
//   // console.log("c1", c1);
//   if (c1 == false) {
//     // console.log("c2", c1);
//     if (r == "serve") {
//       // console.log("c3", c1);
//       r = "fserve";
//       // console.log("r", r);
//       c1 = true;
//     }
//   }
//
//   return r;
// }

function dbutton(s, i, w) {
  var txt = "";

  //   console.log("sby", sby);

  // var ptxt = (sby == 'NO' ? "" : " [Payment ONLY]");
  // var ptxt = sby == "NO" ? "" : "";

  // if (s == "serving")
  //   c = true;
  //
  // if (c == false) {
  //   if (s == "serve") {
  //     s = "fserve";
  //     c = true;
  //   }
  // }

  switch (s) {
    case "pending":
      if (_w == w) {
        txt += `
                <div class="btn-action">
                  <button type="button" class="btn btn-serve" data-id="${i}" onclick="btn_serve(this)">Serve</button>
                </div>`;
      } else {
        if (w != "") {
          txt = `<i>pending at WINDOW ${w}</i>
                  <div class="btn-action">
                    <button type="button" class="btn btn-serve" data-id="${i}" onclick="btn_serve(this)">Serve ?</button>
                  </div>`;
        }
      }
      break;

    case "serving":
      if (w == _w) {
        txt = `
                <div class="btn-action">
                  <a href="javascript:void(0)" class="btn-call">
                    <i class="material-icons" data-id="${i}" onclick="btn_call(this)">mic</i>
                  </a>
                  <a href="javascript:void(0)" class="btn-call btn-pending" title="Pending">
                    <i class="material-icons" data-id="${i}" onclick="btn_pending(this)" style="color: #ff331f;">close</i>
                  </a>
                  <a href="javascript:void(0)" class="btn-call btn-finish" title="Done">
                    <i class="material-icons" data-id="${i}" onclick="btn_finish(this)" style="color: #07b025">done</i>
                  </a>
                </div>`;
      } else {
        txt = `<i>Now serving at WINDOW ${w}`;
      }
      break;

    // case "serve":
    //   if (sby == "NO") {
    //     txt = ``;
    //   } else {
    //     // txt = `<i>[Payment ONLY]</i>`;
    //     txt = ``;
    //   }
    //   break;
    default:
  }

  return txt;
}

function dbutton1(s, i, w) {
  var txt = "";

  // if (s == "serving")
  //   c = true;
  //
  // if (c == false) {
  //   if (s == "serve") {
  //     s = "fserve";
  //     c = true;
  //   }
  // }

  switch (s) {
    case "pending":
      if (_w == w) {
        txt += `<i>pending</i>
                <div class="btn-action">
                  <button type="button" class="btn btn-serve" data-id="${i}" onclick="btn_serve(this)">Serve</button>
                </div>`;
      } else {
        if (w != "") {
          txt = `<i>pending at WINDOW ${w}</i>
                  <div class="btn-action">
                    <button type="button" class="btn btn-serve" data-id="${i}" onclick="btn_serve(this)">Serve ?</button>
                  </div>`;
        }
      }
      break;

    case "serving":
      if (w == _w) {
        txt = `<i>serving</i>
                <div class="btn-action">
                  <a href="javascript:void(0)" class="btn-call">
                    <i class="material-icons" data-id="${i}" onclick="btn_call(this)">mic</i>
                  </a>
                  <button type="button" class="btn btn-pending" data-id="${i}" onclick="btn_pending(this)">Pending</button>
                  <button type="button" class="btn btn-finish" data-id="${i}" onclick="btn_finish(this)">Done</button>
                </div>`;
      } else {
        txt = `<i>Now serving at WINDOW ${w}`;
      }
      break;

    case "serve":
      txt = `
              <div class="btn-action">
                <button type="button" class="btn" data-id="${i}" onclick="btn_finish(this)">Proceed to Payment</button>
              </div>`;
      break;
    default:
  }

  return txt;
}

$(document).on("click", "#tblbody-regular tr.serve", function (e) {
  btn_serve(this);
});

$(document).on("click", "#tblbody-special tr.serve", function (e) {
  btn_serve(this);
});

$(document).on("click", "#tblbody-regular1 tr.serve", function (e) {
  btn_serve(this);
});

$(document).on("click", "#tblbody-special1 tr.serve", function (e) {
  btn_serve(this);
});

$(document).on("click", "#tblbody-taxbill tr.serve", function (e) {
  btn_serve(this);
});

// Get the modal element
var modal = document.getElementById("myModal");
function openModal(t) {
  let text = t.closest("td").innerText;
  modal.dataset.id = t.closest("tr").dataset.id;
  document.getElementById("queuing-number").innerText = text.replace(
    "mic close done",
    ""
  );

  modal.style.display = "block";
}
function closeModal() {
  modal.style.display = "none";
}

// Function for button action 1
function action_done(_this) {
  postAjax(
    base_url + "transaction/save_trasaction",
    {
      id: _this.closest(".modal").dataset.id,
      status: "DONE",
      window: _w,
    },
    function (data) {
      // dt_reload(t);
      closeModal();
    }
  );
}

// Function for button action 2
function action_proceed_to_payment(_this) {
  postAjax(
    base_url + "transaction/save_trasaction",
    {
      id: _this.closest(".modal").dataset.id,
      status: "FINISHED",
      window: _w,
    },
    function (data) {
      // dt_reload(t);
      closeModal();
    }
  );
}

// Close the modal if the user clicks outside of it
window.onclick = function (event) {
  if (event.target === modal) {
    closeModal();
  }
};

// function get_waiting() {
//   var html = "",
//     i,
//     l,
//     c,
//     r;
//
//   t_regular.innerHTML = "";
//   t_special.innerHTML = "";
//
//   showloader();
//
//   getJSON(base_url + '_serve_verification.txt?' + dd.getTime()).then(function(data) {
//     if (data.status = "yes") {
//
//       l = data.regular.length;
//       c = false;
//
//       if (l === undefined) {
//         html += '<tr><td class="no-data">No data available in table</td></tr>';
//       } else {
//         for (i = 0; i < l; i++) {
//
//           r = data.regular[i].remarks;
//
//           if (r == "serving")
//             c = true;
//
//           if (c == false) {
//             if (r == "serve") {
//               r = "fserve";
//               c = true;
//             }
//           }
//
//           html += '<tr class="' + r + '">' + '<td>' + data.regular[i].number + dbutton(r, data.regular[i].id) + ' </td>' + '</tr>';
//         }
//       }
//       t_regular.innerHTML = html;
//
//       html = "";
//
//       l = data.special.length;
//       c = false;
//
//       if (l === undefined) {
//         html += '<tr><td class="no-data">No data available in table</td></tr>';
//       } else {
//         for (i = 0; i < l; i++) {
//
//           r = data.special[i].remarks;
//
//           if (r == "serving")
//             c = true;
//
//           if (c == false) {
//             if (r == "serve") {
//               r = "fserve";
//               c = true;
//             }
//           }
//
//           html += '<tr class="' + r + '">' + '<td>' + data.special[i].number + dbutton(r, data.special[i].id) + ' </td>' + '</tr>';
//         }
//       }
//       t_special.innerHTML = html;
//
//       // ifclick = 0;
//     } else {}
//
//     setTimeout(function() {
//       hideloader();
//       // ifclick = 0;
//     }, time_out);
//
//   }, function(status) {
//     // alert('Something went wrong.');
//   });
// }

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

//viewing
Comet1 = Class.create();
Comet1.prototype = {
  timestamp: 0,
  url: base_url + "_transaction_verification.php",
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
          }, 3000);
        else this.comet1.connect();
        this.comet1.noerror = false;
      },
    });
    this.ajax.comet1 = this;
  },
  disconnect: function () {},
  handleResponse: function (response) {
    if (_dt_special == true) dt_special.ajax.reload();
    if (_dt_regular == true) dt_regular.ajax.reload();
    if (_dt_special1 == true) dt_special1.ajax.reload();
    if (_dt_regular1 == true) dt_regular1.ajax.reload();

    setTimeout(function () {
      if (document.querySelectorAll(".imserving").length > 0) {
        b.classList.add("currentserving");
      } else {
        b.classList.remove("currentserving");
      }

      // let a = document.querySelectorAll(".otherserving");
      // if (document.querySelectorAll(".pending").length > 0) {
      //   a.classList.add("servingat");
      // } else {
      //   $(".otherserving").removeClass("servingat");
      //   // if (a.classList.contains("servingat")) a.classList.remove('servingat');
      // }
    }, time_out1);

    // var a = document.getElementById("tblbody-regular").getElementsByClassName('tr');
    // if (a.length > 0) {
    // 	a.each(function(e) {
    //     console.log("e", e);
    // 		// var _this = $(this).text().trim();
    // 		// $itemstags.push(_this);
    // 	});
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
