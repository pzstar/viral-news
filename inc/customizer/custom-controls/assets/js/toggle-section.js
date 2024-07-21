jQuery(document).ready(function ($) {
    $("body").on("click", ".ht--switch-section.ht--switch", function () {
        var controlName = $(this).siblings("input").data("customize-setting-link");
        var controlValue = $(this).siblings("input").val();
        var iconClass = "dashicons-visibility";
        if (controlValue === "off") {
            iconClass = "dashicons-hidden";
            $("[data-control=" + controlName + "]")
                .parent()
                .addClass("ht--section-hidden")
                .removeClass("ht--section-visible");
        } else {
            $("[data-control=" + controlName + "]")
                .parent()
                .addClass("ht--section-visible")
                .removeClass("ht--section-hidden");
        }
        $("[data-control=" + controlName + "]")
            .children()
            .attr("class", "dashicons " + iconClass);
    });
});
