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
        navLinks: true,
        businessHours: true,
	    locale: "ja",
	    editable: true,
	    events: res['records'],
	    selectable: true,
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

// document.addEventListener('DOMContentLoaded', function() {
// 	var calendarEl = document.getElementById('calendar');
// 	var calendar = new FullCalendar.Calendar(calendarEl, {
//         headerToolbar: {
//             left: 'prev,next today',
//             center: 'title',
//             right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
//         },
//         initialDate: '2021-11-01',
//         navLinks: true,
//         businessHours: true,
//         editable: true,
//         locale: 'ja',
//         events: [
//           {
//             title: 'カラオケ',
//             start: '2021-11-03',
//             color: 'green',     
//             textColor: 'white' 
//           },
//           {
//             title: 'ショッピング',
//             start: '2021-11-13'
//           },
//           {
//             title: '打ち合わせ',
//             start: '2021-11-05T10:00:00',
//             end: '2021-11-07T11:00:00',
//             constraint: 'availableForMeeting'
//           }
//         ]
//     });
// 	calendar.render();
// });