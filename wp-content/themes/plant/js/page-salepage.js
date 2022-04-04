// GETSIBLINGS
var getSiblings = function (elem) {
  var siblings = [];
  var sibling = elem.parentNode.firstChild;
  while (sibling) {
    if (sibling.nodeType === 1 && sibling !== elem) {
      siblings.push(sibling);
    }
    sibling = sibling.nextSibling;
  }
  return siblings;
};

// CLICK
document.addEventListener(
  "click",
  function (event) {
    // Product Select
    if (event.target.closest(".sp-product")) {
      if (!event.target.closest(".amount")) {
        var sp_id,
          sp_name,
          sp_price,
          sp_sum,
          sp_num,
          sp_all,
          sp_active = [];
        const sp_product = event.target.closest(".sp-product");
        sp_price = sp_product.querySelector(".sp-price").dataset.price;
        sp_name = sp_product.querySelector("h3").innerHTML;
        sp_id = sp_product.getAttribute("id");

        if (sp_product.classList.contains("active")) {
          sp_product.classList.remove("active");
          sp_product.querySelector(".info > .amount > .num").value = 0;
          if (document.getElementById("row-" + sp_id) != null) {
            document.getElementById("row-" + sp_id).remove();
          }
          allPrice();
        } else {
          if (sp_product.dataset.stock != 0) {
            sp_product.classList.add("active");
            sp_product.querySelector(".info > .amount > .num").value = 1;
            sp_num = sp_product.querySelector(".info > .amount > .num").value;
            sp_sum = sp_num * sp_price;
            createdTableRow(sp_id, sp_name, sp_num, sp_sum);
            if (sp_product.parentElement.dataset.selectone) {
              var sp_siblings = getSiblings(sp_product);
              sp_siblings.forEach((sp) => {
                sp.classList.remove("active");
                sp.querySelector(".info > .amount > .num").value = 0;
              });
              allPrice(sp_product);
            } else {
              allPrice();
            }
          }
        }
        sp_all = document.querySelectorAll(".sp-product");
        for (var n = 0; n < sp_all.length; n++) {
          if (sp_all[n].classList.contains("active")) {
            sp_active.push("yes");
          } else {
            sp_active.push("no");
          }
        }
        if (sp_active.includes("yes")) {
          document.getElementById("sum").classList.add("active");
        } else {
          document.getElementById("sum").classList.remove("active");
        }
      }
    }

    // Product Price
    var sprice, num, numCount, result, pid, pname, pnum, psum;
    var product_select = [];
    const limit_purchase = document.getElementById("sp-products").dataset.limit;

    if (event.target.closest(".minus") || event.target.closest(".plus")) {
      var stable = document.getElementById("sum");
      var stbody = stable.getElementsByTagName("tbody")[0];
      for (var i = 0, row; (row = stbody.rows[i]); i++) {
        product_select.push(stbody.rows[i].getAttribute("id"));
      }
      stable.classList.add("active");
    }

    if (event.target.closest(".minus")) {
      num = event.target.parentNode.querySelector(".num");
      numCount = num.value;
      result = 0;
      if (numCount > 0) {
        result = parseInt(numCount) - 1;
      }
      num.value = result;
      sprice = event.target.closest(".sp-product").querySelector(".sp-price").dataset.price;
      pname = event.target.closest(".sp-product").querySelector("h3").innerHTML;
      pid = event.target.closest(".sp-product").getAttribute("id");
      pnum = result;
      psum = result * sprice;

      if (!product_select.includes("row-" + pid) && pnum > 0) {
        createdTableRow(pid, pname, pnum, psum);
      } else {
        if (pnum > 0) {
          insertData(pid, pnum, psum);
        } else {
          document.getElementById(pid).click();
          if (document.getElementById("row-" + pid) != null) {
            document.getElementById("row-" + pid).remove();
          }
        }
      }
      allPrice();
    }

    if (event.target.closest(".plus")) {
      num = event.target.parentNode.querySelector(".num");
      sprice = event.target.closest(".sp-product").querySelector(".sp-price").dataset.price;
      pname = event.target.closest(".sp-product").querySelector("h3").innerHTML;
      pid = event.target.closest(".sp-product").getAttribute("id");
      stock = event.target.closest(".sp-product").dataset.stock;

      numCount = num.value;
      result = parseInt(numCount) + 1;
      if (limit_purchase && stock) {
        if (result > stock) result = stock;
      }
      num.value = result;
      pnum = result;
      psum = result * sprice;

      if (!product_select.includes("row-" + pid)) {
        createdTableRow(pid, pname, pnum, psum);
      } else {
        insertData(pid, pnum, psum);
      }

      allPrice();
    }

    // COPY
    if (event.target.closest("#acc-copy")) {
      const acc_copy = document.getElementById("acc-copy");
      document.getElementById("acc-no").select();
      if (document.execCommand("copy")) {
        acc_copy.classList.add("copied");
        var temp = setInterval(function () {
          acc_copy.classList.remove("copied");
          clearInterval(temp);
        }, 1200);
      }
    }
    // BUY NOW
    if (event.target.closest("#sp-buy")) {
      document.getElementById("sp-start").scrollIntoView({ behavior: "smooth" });
    }

    // Form Input
    if (event.target.closest("#name-1 input") || event.target.closest(".order_payment input")) {
      allPrice();
    }
  },
  false
);

// ADD PRODUCTS
var page_table, page_tbody, page_foot, num_decimals;
page_table = document.getElementById("sum");
page_tbody = page_table.getElementsByTagName("tbody")[0];
page_foot = page_table.getElementsByTagName("tfoot")[0];
num_decimals = document.getElementById("sp-products").dataset.decimals;
if (!num_decimals) num_decimals = 0;

function createdTableRow(id, name, num, price) {
  var tr, td_1, td_2, td_3;

  const selectone = document.getElementById("sp-products").dataset.selectone;

  tr = document.createElement("tr");
  td_1 = document.createElement("td");
  td_2 = document.createElement("td");
  td_3 = document.createElement("td");

  td_2.classList.add("amount");

  td_1.innerHTML += name;
  td_2.appendChild(document.createTextNode(num));
  td_3.appendChild(document.createTextNode(formatPrice(price)));

  tr.appendChild(td_1);
  tr.appendChild(td_2);
  tr.appendChild(td_3);

  tr.setAttribute("id", "row-" + id);

  if (selectone) {
    while (page_tbody.hasChildNodes()) {
      page_tbody.removeChild(page_tbody.firstChild);
    }
    page_tbody.appendChild(tr);
  } else {
    page_tbody.appendChild(tr);
  }
}

function insertData(id, num, price) {
  var tr = document.getElementById("row-" + id);
  tr.getElementsByTagName("td")[1].innerHTML = num;
  tr.getElementsByTagName("td")[2].innerHTML = formatPrice(price);
}

function formatPrice(price) {
  return Intl.NumberFormat("en", { minimumFractionDigits: num_decimals, maximumFractionDigits: num_decimals }).format(parseFloat(price));
}

function allPrice(product) {
  var data,
    shipping_option,
    shipping_cost,
    sum_cost,
    sum_cost_text,
    order_text = "",
    allshipping = [],
    allprice = [];

  if (product) {
    var price_product, num_product, sum_product, price_shipping, sum_shipping;
    price_product = product.querySelector(".sp-price").dataset.price;
    num_product = product.querySelector(".amount input").value;
    sum_product = price_product * num_product;
    allprice.push(sum_product);
    price_shipping = parseFloat(product.querySelector(".sp-price").dataset.shipping);
    sum_shipping = price_shipping * num_product;
    allshipping.push(sum_shipping);
    if (num_product > 0) {
      order_text = product.querySelector("h3").innerHTML;
      order_text += " (" + num_product + ") " + formatPrice(sum_product) + " \n";
    }
  } else {
    data = document.querySelectorAll(".sp-product");
    for (var i = 0; i < data.length; i++) {
      var price_product, num_product, sum_product, price_shipping, sum_shipping;
      price_product = data[i].childNodes[1].querySelector(".sp-price").dataset.price;
      num_product = data[i].childNodes[1].querySelector(".amount input").value;

      sum_product = price_product * num_product;
      allprice.push(sum_product);

      price_shipping = data[i].childNodes[1].querySelector(".sp-price").dataset.shipping;
      sum_shipping = price_shipping * num_product;
      allshipping.push(sum_shipping);

      if (num_product > 0) {
        order_text += data[i].childNodes[1].querySelector("h3").innerHTML;
        order_text += " (" + num_product + ") " + formatPrice(sum_product) + " \n";
      }
    }
  }

  shipping_option = document.querySelector(".shipping-option").value;
  const txt_free = document.getElementById("sum").dataset.free;

  if (!txt_free) txt_free = "Free!";

  switch (shipping_option) {
    case "free":
      shipping_cost = 0;
      document.querySelector("#shipping_num").innerHTML = txt_free;
      break;
    case "flat":
      shipping_cost = parseFloat(document.querySelector(".flat-cost").value);
      document.querySelector("#shipping_num").innerHTML = formatPrice(shipping_cost);
      break;
    case "flat_free":
      var flat_cost, cost_min;
      flat_cost = parseFloat(document.querySelector(".flat-free-cost").value);
      cost_min = parseFloat(document.querySelector(".flat-free-min").value);
      if (allprice.reduce(getSum, 0) >= cost_min) {
        shipping_cost = 0;
        document.querySelector("#shipping_num").innerHTML = txt_free;
      } else {
        shipping_cost = flat_cost;
        document.querySelector("#shipping_num").innerHTML = formatPrice(shipping_cost);
      }
      break;
    case "cal":
      var caldata,
        cod_cost = 0,
        start = 0,
        product = 0,
        free = 0;
      caldata = document.querySelector(".cal-option");

      if (caldata.dataset.start == "true") {
        start = parseFloat(caldata.value);
      }

      if (caldata.dataset.product == "true") {
        product = allshipping.reduce(getSum, 0);
      }

      const order_payment = document.querySelector(".order_payment");
      if (order_payment) {
        const inputs = document.querySelectorAll('input[type="radio"]:checked');
        const value = inputs.length > 0 ? inputs[0].value : null;
        if (value == "COD" && caldata.dataset.cod == "true") {
          if (caldata.dataset.codcost) cod_cost = parseFloat(caldata.dataset.codcost);
        }
      }

      if (caldata.dataset.free == "true") {
        free = caldata.dataset.min;
        if (allprice.reduce(getSum, 0) + cod_cost >= free) {
          shipping_cost = 0;
          document.querySelector("#shipping_num").innerHTML = txt_free;
        } else {
          shipping_cost = start + product + cod_cost;
          document.querySelector("#shipping_num").innerHTML = formatPrice(shipping_cost);
        }
      } else {
        shipping_cost = start + product + cod_cost;
        document.querySelector("#shipping_num").innerHTML = formatPrice(shipping_cost);
      }

      break;
    case "none":
      shipping_cost = 0;
      break;
    default:
      break;
  }

  sum_cost = shipping_cost + allprice.reduce(getSum, 0);
  console.log(shipping_cost);
  sum_cost_text = formatPrice(sum_cost);
  document.querySelector("#total_num").innerHTML = sum_cost_text;

  // Order fields
  order_text += document.querySelector("#shipping_text").innerHTML + " " + shipping_cost + " \n";
  order_text += document.querySelector("#total_text").innerHTML + " " + sum_cost_text;
  const order_total_input = document.querySelector(".order_total input");
  const order_summary_text = document.querySelector(".order_summary textarea");
  if (order_total_input) order_total_input.value = sum_cost;
  if (order_summary_text) order_summary_text.value = order_text;
}

function getSum(total, num) {
  return total + Number(num);
}

// AUTO SELECTED
var autoSeleted = (function () {
  var called = false;
  return function () {
    if (!called) {
      called = true;
      var product_num = parseInt(document.getElementById("products-num").dataset.num);
      if (product_num == 1) {
        document.getElementById("p-1").click();
      } else {
        product_num = product_num + 1;
        for (var p = 1; p < product_num; p++) {
          var product = document.getElementById("p-" + p);
          if (product.dataset.selected) {
            product.click();
          }
        }
      }
    }
  };
})();

// CHECK FORM LOADED
const observer = new MutationObserver(function (mutations, me) {
  autoSeleted();
  const forminator = document.querySelector('[id^="forminator-module-"]');
  if (forminator) {
    const order_summary = document.querySelector(".order_summary");
    const order_total = document.querySelector(".order_total");

    if (order_summary) {
      order_summary.parentElement.classList.add("hide");
      order_summary.querySelector("textarea").readOnly = true;
    }

    if (order_total) {
      order_total.parentElement.classList.add("hide");
      order_total.querySelector("input").readOnly = true;
    }
    const upload = document.getElementById("upload-1");
    const bank = document.getElementById("bank");
    if (upload && bank) {
      upload.insertAdjacentElement("afterbegin", bank);
      me.disconnect(); // stop observing
    }
    return;
  }
});
observer.observe(document, {
  childList: true,
  subtree: true,
});
// CHECK IF FORM IN VIEWPORT

const sp_form = document.getElementById("sp-form");
const sp_buy = document.getElementById("sp-buy");
if (sp_buy) {
  function isFormInViewport(el) {
    const rect = el.getBoundingClientRect();
    return rect.top <= (window.innerHeight || document.documentElement.clientHeight);
  }
  function check_form() {
    if (isFormInViewport(sp_form)) {
      sp_buy.classList.add("-hide");
    } else {
      sp_buy.classList.remove("-hide");
    }
  }
  document.addEventListener("DOMContentLoaded", check_form);
  window.addEventListener("scroll", check_form, { passive: true });
  window.addEventListener("resize", check_form, true);
}
