// For all custom jQuery codes
jQuery(document).ready(function ($) {
  /* Auto Update Cart */
  $("div.woocommerce").on("change", ".qty", function () {
    $('[name="update_cart"]').prop("disabled", false);
    $('[name="update_cart"]').trigger("click");
  });
});
