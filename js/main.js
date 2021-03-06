$(document).ready(function () {
    $('.dropdown-toggle').dropdown();
    $('.my-popover').popover({
        placement: 'top',
        html: true,
        trigger: 'hover'
    });
    jQuery.timeago.settings.allowFuture = true;
    jQuery("time.timeago").timeago();

    $('.hash-select').on('change', function(e) {
        $(this).children("option:selected").each(function () {
            $($(this).data("hash-taget")).text($(this).data("hash"));
        });
        return true;
    });

    $('button.pem').click(function(){
        var pem = window.open("pem.php?sha256=" + $(this).data("sha-digest"),'PEM','width=600,height=800');
        return false;
    });

    $('#type-select a').click(function (e) {
        var name = $(this).data("type");
        $("#type-button").html(name + " <span class='caret'>");
        $("#type-select .active").removeClass("active");
        $(this).parent().addClass("active");
        $("#type").attr("value", name);
        e.preventDefault();
    });
});