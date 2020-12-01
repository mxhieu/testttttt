document.addEventListener("DOMContentLoaded", async function () {
    var calendarEl = document.getElementById("calendar");
    var defaultEvents = []
    await ajaxHandler('http://localhost:3000/api/v1/events', 'GET').then(data => {
        defaultEvents = data.data
        for (const item of defaultEvents) {
            item.start = new Date(item.start)
            item.end = new Date(item.end)
        }
    })
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: "vi",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
        },
        initialDate: "2020-11-12",
        editable: true,
        navLinks: true, // can click day/week names to navigate views
        dayMaxEvents: true, // allow "more" link when too many events
        events: defaultEvents,
        timeZone: "Asia/Ho_Chi_Minh",
        eventChange: async function (e) {
            let id = e.event._def.publicId
            let startAt = Date.parse(new Date(e.event._instance.range.start))
            let endAt = Date.parse(new Date(e.event._instance.range.end))
            await ajaxHandler('http://localhost:3000/event/update-calendar', 'POST', {
                'id': id,
                'startAt': startAt,
                'endAt': endAt,
            }).then(data => {
                if(data.status == 200){
                    toast(data.msg, "success")
                }else{
                    toast(data.msg, "error")
                }
            })
        },
        loading: function (bool) {
            document.getElementById("loading").style.display = bool
                ? "block"
                : "none";
        },
    });

    calendar.render();
});
