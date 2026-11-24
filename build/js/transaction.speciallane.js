let $d = $(document),
  b = document.getElementById("body"),
  $tbl_special = $('#tbl-other'),
  dt_other = null,
  t_other = document.getElementById("tblbody-other"),
  msg_error = 'Still have a pending services',
  rev = document.querySelectorAll("remove"),
  dd = new Date(),
  c = false,
  cc = false,
  c1 = false,
  _dt_other = false,
  time_out = 200;
  time_out1 = 240;


// function otable() {
  // showloader();

  // $tbl_regular.dataTable().fnClearTable();
  // $tbl_regular.dataTable().fnDestroy();

  dt_other = $tbl_special.DataTable({
    "ajax": {
      "type": "GET",
      "url": base_url + "_serve.txt",
      "dataSrc": "other"
    },
    "columns": [
      {
        "data": function(data) {
          return data.number + dbutton(data.remarks, data.id, data.window);
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
      // $(nRow).addClass(dremarks(data.remarks));
      $(nRow).addClass(data.remarks);
      $(nRow).attr('data-id', data.id);
      $(nRow).addClass(if_serving(data.window,data.remarks));
    },
    initComplete: function(oSettings, json) {
      cc = false;
      _dt_other = true;
      // hideloader();
    }
  });


function if_serving(w_no,remarks) {
    var txt = '';

    if (w_no == _w) {
      if (remarks != "pending") {
          txt = 'imserving';
      }
    } else {
      // if (w_no != null) {
      if (w_no != '') {
        txt = 'otherserving'
      }
    }
    return txt;
  }

$(document).on('click', '#tblbody-other tr.serve:first', function(e) {
   btn_serve(this);
});


function btn_call(t) {
  showloader();
  getJSON(base_url + 'transaction/ajax_get_mic?id=prince').then(function(data) {
    hideloader();
  }, function(status) {
    hideloader();
    alert('Something went wrong.');
  });
}

function btn_serve(t) {
  var cl, cll;
  cl = document.querySelectorAll('tr');
  cll = cl.length;
  for (i = cll; i--; ) {
    if (cl[i].className == "serving imserving") {
      alert(msg_error);
      return false;
    }
  }

  postAjax(base_url + 'transaction/save_transaction', {
    id: t.dataset.id,
    status: "SERVING",
    window: _w
  }, function(data) {
    // dt_reload(t);
  });

  return false;
}

function btn_finish(t) {
  r = confirm("Are you sure you want to proceed?");
  if (r == true) {

    postAjax(base_url + 'transaction/save_transaction', {
      id: t.dataset.id,
      status: "FINISHED",
      window: _w
    }, function(data) {
       // dt_reload(t);
    });
  }
}

function btn_pending(t) {
  postAjax(base_url + 'transaction/save_transaction', {
    id: t.dataset.id,
    status: "PENDING",
    window: _w
  }, function(data) {
     // dt_reload(t);
  });
}



function dbutton(s, i , w) {
  var txt = '';


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
    default:

  }

  return txt;
}


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
          }, 3000);
        else
          this.comet1.connect();
        this.comet1.noerror = false;
      }
    });
    this.ajax.comet1 = this;
  },
  disconnect: function() {},
  handleResponse: function(response) {
    if (_dt_other == true) dt_other.ajax.reload();

    setTimeout(function() {
      if (document.querySelectorAll('.imserving').length > 0 ) {
        b.classList.add('currentserving');
      } else {
        b.classList.remove('currentserving');
      }

      let a = document.querySelectorAll('.otherserving');
      if (document.querySelectorAll('.pending').length > 0 ) {
        a.classList.add('servingat');
      } else {
        a.classList.remove('servingat');
      }
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
