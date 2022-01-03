/* global $*/
const previewImage = (obj) => {
	let fileReader = new FileReader();
	fileReader.onload = function(){
		$('#preview').prop('src', fileReader.result);
	};
	fileReader.readAsDataURL(obj.files[0]);
}

// FullCalendar
/* global FullCalendar */
/* global location */
document.addEventListener('DOMContentLoaded', function() {
	$.ajax({
		//POST通信
		type: "get", //HTTP通信のメソッドをGETで指定
		//ここでデータの送信先URLを指定します。
		url: "/get_calendar", //通信先のURL
		dataType: "json", // データタイプをjsonで指定
	})
	//通信が成功したとき
	.then((res) => {
	  // カレンダーの再描画
	  var calendarEl = document.getElementById("calendar");
	  var calendar = new FullCalendar.Calendar(calendarEl, {
	    headerToolbar: {
	      left: "prev,next today",
	      center: "title",
	      right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
	    },
	    buttonText: {
	        today: '今月',
	        month: '月',
	        week: '今週',
	        day: '今日',
	        list: 'リスト'
    	},
    	views: {
		    timeGridWeek: {
				dayHeaderFormat: function (date) {
					const day = date.date.day;
					const weekNum = date.date.marker.getDay();
					const week = ['(日)', '(月)', '(火)', '(水)', '(木)', '(金)', '(土)'][weekNum];
					return day + ' ' + week;
				}
			}
	    },
    	dayCellContent: function(e) {
        	e.dayNumberText = e.dayNumberText.replace('日', '');
    	},
    	height: 'auto',
        navLinks: true,
        businessHours: true,
	    locale: "ja",
	    editable: true,
	    events: res['records'],
	    selectable: true,
	    height: 'auto',
	    eventClick: function(info) {
		    location.href = "/records/"+ info.event.id + "/edit";
		},
		dateClick: function(info) {
			let target_date = info.dateStr;
			location.href = "/create_record_from_calendar?date=" + target_date;
		}
	  });
	  calendar.render(); //カレンダーを再描画
	})
	//通信が失敗したとき
	.fail((error) => {
	  console.log(error.statusText);
	});
});



window.addEventListener('load', function(){

  const jsFunction = document.getElementById("js-function");
  const jsFunctionItem = document.getElementById("js-function-item");

  jsFunction.addEventListener('click', function(){
  	jsFunctionItem.classList.toggle('display-none');
  })
  
  const jsCustomers = document.getElementById("js-customers");
  const jsCustomersItem = document.getElementById("js-customers-item");

  jsCustomers.addEventListener('click', function(){
  	jsCustomersItem.classList.toggle('display-none');
  })

  const jsRegister = document.getElementById("js-register");
  const jsRegisterItem = document.getElementById("js-register-item");

  jsRegister.addEventListener('click', function(){
  	jsRegisterItem.classList.toggle('display-none');
  })

  
})