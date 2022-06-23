function getXHR() {
  if(window.XMLHttpRequest) {
    return new XMLHttpRequest();
  } else if(window.ActiveXObject) {
    return new ActiveXObject('MSXML2.XMLHTTP.3.0');
  } else {
    return null;
  }
}
