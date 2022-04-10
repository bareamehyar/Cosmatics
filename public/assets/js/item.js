$(document).ready(function () {
    $(document).on("click", ".addColor", function () {
        let htmlElement = $("script#RowTemplate").html();
        $("#ColorInput").append($(htmlElement));
    });

    $(document).on("click", ".addSize", function () {
        let htmlElement = $("#RowTemplate2").html();
        $("#SizeInput").append($(htmlElement));
    });

});
