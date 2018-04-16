$(document).ready(function () {
    const productId = $("#product-id").val();
    let href = $(".addCartContainer form").attr("action");
    let action =  $(".addCartContainer form");
    let elSizeId = $(".sizes input[type=radio]:checked").data("id")
let elSizeOld = $(".sizes input[type=radio]:checked").data("id");

elSizeOld = elSizeOld.toString();
elSizeId = elSizeId.toString();

href = href.replace(productId, "");
href = href + elSizeId;

function fillHref(){
    href.replace(elSizeId, "");
    elSizeId = $(".sizes input[type=radio]:checked").data("id").toString();
    elSizeId = elSizeId.toString();
    href = href + elSizeId;
    action.attr("action", href);
    elSizeOld = elSizeId;
    console.log(href);
}

$(".sizes input[type=radio]").change(function () {
    fillHref();
});
});