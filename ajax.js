

// file ajax.js
var recReq = getXmlHttpRequestObject();
var _documentid='content';

//-- membentuk instant XMLHttpRequest ---
function getXmlHttpRequestObject() {
if (window.XMLHttpRequest) {
return new XMLHttpRequest();
} else if(window.ActiveXObject) {
return new ActiveXObject("Microsoft.XMLHTTP");
} else {
alert('Status: Cound not create XmlHttpRequest Object. Consider upgrading your browser.');
}
}

function LoadData(){
document.getElementById(_documentid).innerHTML = 'Loading.... Please wait';
if (recReq.readyState == 4 || recReq.readyState == 0) {
recReq.open("GET", 'get_data.php', true);
recReq.onreadystatechange = function() {
if (recReq.readyState == 4 && recReq.status == 200) {
document.getElementById(_documentid).innerHTML = recReq.responseText;
}
}
recReq.send(null);
}
}
