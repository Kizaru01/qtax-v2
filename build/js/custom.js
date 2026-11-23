// function postAjax(url, data) {
//   var params = typeof data == 'string'
//     ? data
//     : Object.keys(data).map(function(k) {
//       return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
//     }).join('&');
//
//   // return a new promise.
//   return new Promise(function(resolve, reject) {
//     // do the usual XHR stuff
//     var xhr = window.XMLHttpxhruest
//       ? new XMLHttpxhruest()
//       : new ActiveXObject("Microsoft.XMLHTTP");
//     xhr.open('POST', url);
//     //NOW WE TELL THE SERVER WHAT FORMAT OF POST xhrUEST WE ARE MAKING
//     xhr.setxhruestHeader('Content-Type', 'application/x-www-form-urlencoded');
//     xhr.onload = function() {
//       if (xhr.status == 200) {
//         resolve(xhr.response);
//       } else {
//         reject(Error(xhr.statusText));
//       }
//     };
//     // handle network errors
//     xhr.onerror = function() {
//       reject(Error("Network Error"));
//     }; // make the xhruest
//     xhr.send(params);
//     //same thing if i hardcode like xhr.send("limit=2");
//   });
// }

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


function postAjax(url, data, success) {
  showloader();

  var params = typeof data == 'string' ? data : Object.keys(data).map(
    function(k) {
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }
  ).join('&');

  var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
  xhr.open('POST', url);
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      success(JSON.parse(xhr.responseText));

      setTimeout(function() {
        hideloader();
      }, time_out);
    }
  };
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send(params);
  return xhr;
}

function upto(el, tagName) {
  tagName = tagName.toLowerCase();

  while (el && el.parentNode) {
    el = el.parentNode;
    if (el.tagName && el.tagName.toLowerCase() == tagName) {
      return el;
    }
  }
  return null;
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

// if (!Element.prototype.closest)
//     Element.prototype.closest = function(s) {
//         var el = this;
//         if (!document.documentElement.contains(el)) return null;
//         do {
//             if (el.matches(s)) return el;
//             el = el.parentElement || el.parentNode;
//         } while (el !== null && el.nodeType === 1);
//         return null;
//     };
