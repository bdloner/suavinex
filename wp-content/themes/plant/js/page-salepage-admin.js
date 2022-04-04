const logo_select = document.querySelector('body.template-salepage .acf-field-select[data-name="bank_logo"] select');
if (logo_select) {
  logo_select.addEventListener("change", function () {
    const logo_name = logo_select.options[logo_select.selectedIndex].innerHTML;
    const bank_name = document.querySelector('.acf-field-text[data-name="bank_name"] input');
    bank_name.value = logo_name.split(" ").pop();
  });
}
