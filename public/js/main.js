$(document).ready(function () {
   
    function fillHref(){
        const elSizeId = $(".sizes input[type=radio]:checked").data("id");
        const elSizeIdHidden = $("#size-id");
        elSizeIdHidden.val(elSizeId);
    }

    $(".sizes input[type=radio]").change(function () {
        fillHref();
    });

});