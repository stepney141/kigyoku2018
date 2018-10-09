/*学校公式サイトへのリンク
アクセスしているデバイスを判定し、飛ばすリンク先を変えている*/
function isSmartphone() {
    var ua = navigator.userAgent;
    if (ua.indexOf('Android') == -1 ||
            ua.indexOf('iPhone') == -1 ||
            ua.indexOf('iPad') == -1) {
        return false;
    } else {
        return true;
    }
}
/*学校公式サイトへのリンク　おわり*/


/*食券販売状況の表示(2016年度版流用)*/
function loadTicket(){
	xmlHttpInfo = new XMLHttpRequest();
	xmlHttpInfo.onreadystatechange = checkTicket;
	xmlHttpInfo.open("GET", "c/ticket.txt", true);
	xmlHttpInfo.send(null);
}

function checkTicket(){
  if (xmlHttpInfo.readyState == 4 && xmlHttpInfo.status == 200){
	var res_text = Encoding.convert(xmlHttpInfo.responseText, 'AUTO', 'AUTO');
	var ticketArray = res_text.split(",");
	document.getElementById("ticket0").innerHTML = ticketArray[0];
	document.getElementById("ticket1").innerHTML = ticketArray[1];
	document.getElementById("ticket2").innerHTML = ticketArray[2];
	document.getElementById("ticket3").innerHTML = ticketArray[3];
	document.getElementById("ticket4").innerHTML = ticketArray[4];
	document.getElementById("ticket5").innerHTML = ticketArray[5];
	document.getElementById("ticket6").innerHTML = ticketArray[6];
	document.getElementById("ticket7").innerHTML = ticketArray[7];
	document.getElementById("ticket8").innerHTML = ticketArray[8];
	document.getElementById("ticket9").innerHTML = ticketArray[9];
	document.getElementById("ticket10").innerHTML = ticketArray[10];
	document.getElementById("ticket11").innerHTML = ticketArray[11];
	document.getElementById("ticket12").innerHTML = ticketArray[12];
	document.getElementById("ticket13").innerHTML = ticketArray[13];
	document.getElementById("ticket14").innerHTML = ticketArray[14];
	document.getElementById("ticket15").innerHTML = ticketArray[15];
  }
}
/*食券販売状況の表示　おわり*/


/*イベント情報の表示(2016年度版流用)*/
function loadEvent(){
	xmlHttpEvent = new XMLHttpRequest();
	xmlHttpEvent.onreadystatechange = checkEvent;
	xmlHttpEvent.open("GET", "c/event.php", true);
	xmlHttpEvent.send(null);
}

function checkEvent(){
  if (xmlHttpEvent.readyState == 4 && xmlHttpEvent.status == 200){
	var res_text = Encoding.convert(xmlHttpEvent.responseText, 'AUTO', 'AUTO');
	var eventArray = res_text.split(",");
	document.getElementById("event0").innerHTML = eventArray[0];
	document.getElementById("event1").innerHTML = eventArray[1];
	document.getElementById("event2").innerHTML = eventArray[2];
	document.getElementById("event3").innerHTML = eventArray[3];
	document.getElementById("event4").innerHTML = eventArray[4];
	document.getElementById("event5").innerHTML = eventArray[5];
	document.getElementById("event6").innerHTML = eventArray[6];
	document.getElementById("event7").innerHTML = eventArray[7];
	document.getElementById("event8").innerHTML = eventArray[8];
	document.getElementById("event9").innerHTML = eventArray[9];
	document.getElementById("event10").innerHTML = eventArray[10];
	document.getElementById("event11").innerHTML = eventArray[11];
  }
}
/*イベント情報の表示　おわり*/
