var $d = $(document),
  b = document.getElementById("body"),
  $tbl_regular = $('#tbl-regular'),
  dt_regular = null,
  dt_special = null,
  t_regular = document.getElementById("tblbody-regular"),
  t_special = document.getElementById("tblbody-special"),
  msg_error = 'Still have a pending services',
  rev = document.querySelectorAll("remove"),
  dd = new Date(),
  c = false,
  c1 = false,
  _dt_regular = false,
  time_out = 500;

function otable() {
  showloader();

  $tbl_regular.dataTable().fnClearTable();
  $tbl_regular.dataTable().fnDestroy();

  dt_regular = $tbl_regular.DataTable({
    "ajax": {
      "type": "GET",
      "url": base_url + "_serve.txt",
      "dataSrc": "regular"
    },
    "columns": [
      {
        "data": function(data) {
          return data.number + dbutton(data.remarks, data.id);
        }
      }
    ],
    "scrollCollapse": true,
    "stripeClasses": [''],
    "info": false,
    "paging": false,
    "searching": false,
    "ordering": false,
    "fnCreatedRow": function(nRow, data, iDisplayIndex) {
      $(nRow).addClass(dremarks(data.remarks));
    },
    initComplete: function(oSettings, json) {
      c = false;
      c1 = false;
      _dt_regular = true;
      // hideloader();
    }
  });

  setTimeout(function() {
    hideloader();
  }, time_out);


}

otable();

function showloader() {
  if (!document.body.classList.contains('loading')) {
    b.classList.add("loading");
    b.insertAdjacentHTML('beforeend', '<span class="remove progressbar-infinite color-multi "></span><div class="remove progressbar-overlay"></div>');
  }
}

function hideloader() {
  if (document.body.classList.contains('loading')) {
    b.classList.remove("loading");
    // var elements = document.getElementsByClassName("remove");
    // for (i in elements) {
    //   elements[i].remove();
    // }
  }

  $(".remove").remove();
}

function btn_serve(t) {
  var cl;
  cl = t_regular.children;

  for (i = 0; i <= cl.length - 1; i++) {

    if (cl[i].className == "serving") {
      alert(msg_error);
      return false;
    }
  }
  cl = t_special.children;
  for (i = 0; i <= cl.length - 1; i++) {
    if (cl[i].className == "serving") {
      alert(msg_error);
      return false;
    }
  }

  postAjax(base_url + 'transaction/save_transaction', {
    id: t.dataset.id,
    status: "SERVING"
  }, function(data) {
    // dt_regular.ajax.reload();
    otable()
  });

  return false;
}
function btn_finish(t) {
  r = confirm("Are you sure you want to proceed?");
  if (r == true) {

    postAjax(base_url + 'transaction/save_transaction', {
      id: t.dataset.id,
      status: "FINISHED"
    }, function(data) {
      // dt_regular.ajax.reload();
      otable()
    });
  }
}

function btn_pending(t) {
  postAjax(base_url + 'transaction/save_transaction', {
    id: t.dataset.id,
    status: "PENDING"
  }, function(data) {
    // dt_regular.ajax.reload();
    otable()
  });
}

function dremarks(r) {
  if (r == "serving")
    c1 = true;

  // console.log("c1", c1);
  if (c1 == false) {
    // console.log("c2", c1);
    if (r == "serve") {
      // console.log("c3", c1);
      r = "fserve";
      // console.log("r", r);
      c1 = true;
    }
  }

  return r;
}

function dbutton(s, i) {
  var txt = '';

  if (s == "serving")
    c = true;

  if (c == false) {
    if (s == "serve") {
      s = "fserve";
      c = true;
    }
  }

  switch (s) {

    case "fserve":
      txt = '<i>serve?</i> ' + '<div class="btn-action">' + '<button type="button" class="btn btn-serve" data-id="' + i + '" onclick="btn_serve(this)">Serve?</button>' + '</div>';
      break;

    case "pending":
      txt = '<i>pending</i> ' + '<div class="btn-action">' + '<button type="button" class="btn btn-serve" data-id="' + i + '" onclick="btn_serve(this)">Serve</button>' + '</div>';
      break;

    case "serving":
      txt = '<i>serving</i> ' + '<div class="btn-action">' + '<button type="button" class="btn btn-pending" data-id="' + i + '" onclick="btn_pending(this)">Pending</button>' + '<button type="button" class="btn btn-finish" data-id="' + i + '" onclick="btn_finish(this)">Done</button>' + '</div>';
      break;
    default:

  }

  return txt;
}

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
//   getJSON(base_url + '_serve.txt?' + dd.getTime()).then(function(data) {
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

var getJSON = function(url) {
  return new Promise(function(resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open('get', url, true);
    xhr.responseType = 'json';
    xhr.onload = function() {
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
  url: base_url + '_transaction.php',
  noerror: true,
  initialize: function() {},
  connect: function() {
    this.ajax = new Ajax.Request(this.url, {
      method: 'get',
      parameters: {
        'timestamp': this.timestamp
      },
      onSuccess: function(transport) {
        var response = transport.responseText.evalJSON();
        this.comet1.timestamp = response['timestamp'];
        this.comet1.handleResponse(response);
        this.comet1.noerror = true;
      },
      onComplete: function(transport) {
        if (!this.comet1.noerror)
          setTimeout(function() {
            comet1.connect()
          }, 5000);
        else
          this.comet1.connect();
        this.comet1.noerror = false;
      }
    });
    this.ajax.comet1 = this;
  },
  disconnect: function() {},
  handleResponse: function(response) {
    if (_dt_regular == true) {
      otable()
    }
  },
  doRequest: function(request) {
    new Ajax.Request(this.url, {
      method: 'get',
      parameters: {
        'msg': request
      }
    });
  }
}
var comet1 = new Comet1();
comet1.connect();
