$(document).on("click", ".call-modal", function(e) {
    e.preventDefault();
    // return false;
    var el = $(this);

    if (el.data("requestRunning")) {
        console.log("0");
        return;
    }
    el.data("requestRunning", true);

    var url = el.data("url");
    var target = el.data("target-modal");

    $.ajax({
        type: "GET",
        url: url
    })
        .always(function() {
            $("#load-modal").html(" ");
            el.data("requestRunning", false);
        })
        .done(function(res) {
            $("#load-modal").html(res.html);
            // $('body').append(res.html);
            el.attr({
                "data-toggle": "modal",
                "data-target": target
            });
            $(target).modal("toggle");
        });
});

$(document).on("hidden.bs.modal", function(e) {
    var el = $(e.target);
    if (el.parents().is("#load-modal")) {
        $("#load-modal").html(" ");
    }
});

$(document).on("click", ".change-status", function(e) {
    var el = $(this);
    var url = el.data("url");
    var id = el.val();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: id,
            status: el.prop("checked")
        }
    })
        .always(function(respons) {})
        .done(function(respons) {
            console.log(respons);
            toastr.success(respons.message);
        })
        .fail(function(respons) {
            toastr.error("something went wrong");
        });
});
