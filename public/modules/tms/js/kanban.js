$(function () {
  const UPDATE_KANBAN = BASE_URL + '/tms/task-none-project/update-kanban';
  $('ul[id^="sort"]')
      .sortable({
          connectWith: ".sortable",
          receive: function (e, ui) {
              var taskGridId = $(ui.item)
                  .parent(".sortable")
                  .data("task-grid-id");
              var taskId = $(ui.item).data("task-id");
              var taskGridType = $(ui.item).data("task-grid-type");
              ajaxHandler(UPDATE_KANBAN, "POST" , {"taskId": taskId, "taskGridType": taskGridType, "taskGridId": taskGridId}).then(data => {
                  if(data.status !== 200){
                      alert('Có lỗi xảy ra vui lòng thực hiện lại')
                      window.location.reload();
                  }
              })
              .catch(error => alert('Error:', error));
          },
      })
      .disableSelection();
});
