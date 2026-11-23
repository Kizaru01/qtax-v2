const b_regular = document.getElementById("btn-regular"),
  b_special = document.getElementById("btn-special"),
  b_regular1 = document.getElementById("btn-regular1"),
  b_special1 = document.getElementById("btn-special1"),
  b_pregular = document.getElementById("btn-pregular"),
  b_pspecial = document.getElementById("btn-pspecial"),
  b_pregular1 = document.getElementById("btn-pregular1"),
  b_pspecial1 = document.getElementById("btn-pspecial1");

b_regular_tax = document.getElementById("btn-regular-tax");
b_special_tax = document.getElementById("btn-special-tax");

function save(t, p) {
  let a = p == "YES" ? "PAYMENT ONLY" : "";
  ("");
  // swal({
  //   title: t,
  //   text: " Are you sure you want to add? " + a,
  //   icon: "warning",
  //   buttons: true,
  //   dangerMode: true,
  // })
  // .then((willDelete) => {
  //   if (willDelete) {
  // swal("Poof! Your imaginary file has been deleted!", {
  //   icon: "success",
  // });

  getJSON(base_url + "number/ajax_save?status=" + t + "&ifpayment=" + p).then(
    function (data) {
      if ((data.status = "yes")) {
        document.getElementById("tnumber").innerHTML = data.content;
        document.getElementById(
          "tdescription"
        ).innerHTML = `<strong>${a}</strong><br> ${data.apptpye}`;
        document.getElementById("tdate").innerHTML = data.date;
        document.getElementById("ttime").innerHTML = data.time;
        // document.getElementById("ttime").innerHTML = data.apptpye;
        printContent("printable1");
      } else {
      }
    },
    function (status) {
      alert("Something went wrong.");
    }
  );

  //   }
  // });

  return false;
}

$(document).delegate("#btn-regular", "click", function () {
  save("REGULAR", "NO");
});

$(document).delegate("#btn-special", "click", function () {
  save("SPECIAL", "NO");
});

$(document).delegate("#btn-regular1", "click", function () {
  save("REGULAR5-10", "NO");
});

$(document).delegate("#btn-special1", "click", function () {
  save("SPECIAL5-10", "NO");
});

$(document).delegate("#btn-pregular", "click", function () {
  save("PREGULAR", "YES");
});

$(document).delegate("#btn-pspecial", "click", function () {
  save("PSPECIAL", "YES");
});

$(document).delegate("#btn-pregular1", "click", function () {
  save("PREGULAR5-10", "YES");
});

$(document).delegate("#btn-pspecial1", "click", function () {
  save("PSPECIAL5-10", "YES");
});
$(document).delegate("#btn-regular-releasing", "click", function () {
  save("RELEASING-REGULAR", "NO");
});
$(document).delegate("#btn-special-releasing", "click", function () {
  save("RELEASING-SPECIAL", "NO");
});

// BLPD
// $(document).delegate("#btn-pregular-blpd", "click", function () {
//   save("ASSESSMENT", "NO");
// });

// $(document).delegate("#btn-pspecial-blpd", "click", function () {
//   save("ASSESSMENT-SPECIAL", "NO");
// });

// $(document).delegate("#btn-pregular1-blpd", "click", function () {
//   save("ASSESSMENT5-10", "NO");
// });

// $(document).delegate("#btn-pspecial1-blpd", "click", function () {
//   save("ASSESSMENT5-10-SPECIAL", "NO");
// });

// Others
$(document).delegate("#btn-other", "click", function () {
  save("OTHER", "NO");
});

$(document).delegate("#btn-regular-tax", "click", function () {
  save("REGULAR-TAX", "YES");
});

$(document).delegate("#btn-special-tax", "click", function () {
  save("SPECIAL-TAX", "YES");
});

function printContent(el) {
  var restorepage = document.body.innerHTML,
    printContent = document.getElementById(el).innerHTML;
  document.body.innerHTML = printContent;
  window.print();
  document.body.innerHTML = restorepage;
}
