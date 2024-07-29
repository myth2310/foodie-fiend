function getData(url, callback) {
  const xhr = new XMLHttpRequest();
  xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
  xhr.open("GET", url, true);
  xhr.onload = function () {
    xhr.status >= 200 && xhr.status < 300
      ? callback(JSON.parse(xhr.responseText))
      : console.error("Request failed: ", xhr.status);
  };
  xhr.send();
}

function addData(url, payload) {
  const xhr = new XMLHttpRequest();
  xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
  xhr.open("POST", url, true);
  xhr.onload = () => {
    xhr.status >= 200 && xhr.status < 300
      ? // Missing
        (document.getElementById().innerText = xhr.responseText)
      : console.error("Request failed with status: ", xhr.status);
  };
  xhr.onerror = (err) => {
    console.error("Request failed: ", err);
  };
  xhr.send(JSON.stringify(payload));
}
