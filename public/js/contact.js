var table = $("#ContactTable").DataTable({
    processing: true,
    serverSide: true,
    stateSave: true,
    lengthMenu: [10, 25, 50],
    responsive: true,
    ajax: {
        url: $("#ContactTable").attr("data-url"),
        dataType: "json",
        type: "POST",
        data: function(d) {
            return $.extend({}, d, {});
        }
    },
    order: [[0, "desc"]],
    columns: [
        {
            data: "name"
        },
        {
            data: "email"
        },
        {
            data: "message"
        },
        {
            data: "action"
        }
    ]
});


