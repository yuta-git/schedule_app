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
	var calendarEl = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        initialDate: '2021-11-01',
        navLinks: true,
        businessHours: true,
        editable: true,
        locale: 'ja',
        events: [
          {
            title: 'カラオケ',
            start: '2021-11-03',
            color: 'green',     
            textColor: 'white' 
          },
          {
            title: 'ショッピング',
            start: '2021-11-13'
          },
          {
            title: '打ち合わせ',
            start: '2021-11-05T10:00:00',
            end: '2021-11-07T11:00:00',
            constraint: 'availableForMeeting'
          }
        ]
    });
	calendar.render();
});