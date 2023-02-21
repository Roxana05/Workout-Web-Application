global.$ = global.jQuery = $;
const modalScreenWrapper = $(".modal_screen_wrap");
const btnNav = $(".mobile-menu-button");
const sidebar = $(".sidebar");

$(function () {

    $('.event-checkbox').on('change', function () {
        console.log($(this));
        updateEventCompletionStatus($(this));
    });

    function updateEventCompletionStatus(clicked) {
        let user_event = clicked.data("user_event");
        let url = clicked.data("path_url");
        let option = clicked[0].checked;
        $.ajax({
            url: url,
            type: "get",
            dataType: "html",
            data: {user_event: user_event,  option: option},
            success: function (response) {},
            error: function (xhr, status) {
                if (status === "401") {
                    location.reload();
                } else {
                    alert("An unknown error occurred");
                }
            }
        });
    }

    if (btnNav.length) {
        btnNav.on("click", function (event) {
            event.preventDefault();

            sidebar.toggleClass("-translate-x-full");

            if (!sidebar.hasClass("-translate-x-full")) {
                let site = jQuery(".site");
                let div = jQuery("<div>");
                div.addClass("fixed inset-0 bg-member3-light bg-opacity-50 overflow-y-auto h-full w-full");
                site.append(div);
                div.on("click", function () {
                    sidebar.addClass("-translate-x-full");
                    div.remove();
                });
            }
        });
    }

    $(".choose_event").on('change', function () {
        console.log($(this)[0].options[$(this)[0].value].title);

        if ($(this)[0].options[$(this)[0].value].title === 'weight') {
            $(".duration")[0].disabled = true;
            $(".reps")[0].disabled = false;
            $(".weight")[0].disabled = false;
        }

        if ($(this)[0].options[$(this)[0].value].title === 'cardio') {
            $(".duration")[0].disabled = false;
            $(".reps")[0].disabled = true;
            $(".weight")[0].disabled = true;
        }
    });

});