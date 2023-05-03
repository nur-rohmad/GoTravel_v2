$(function (e) {
    "use strict";

    $(".select-2").select2();
    // Select2
    $(".select2").select2({
        minimumResultsForSearch: Infinity,
        width: "100%",
    });

    // Select2 by showing the search
    $(".select2-show-search").select2({
        minimumResultsForSearch: "",
        width: "100%",
    });

    // select2-search__field
    $(".select2").on("click", () => {
        let selectField = document.querySelectorAll(".select2-search__field");
        selectField.forEach((element, index) => {
            element.focus();
        });
    });
});
