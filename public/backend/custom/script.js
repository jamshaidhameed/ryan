//Get Tenant Quries on Property Detail Page
$(document).on("click", ".tenant-quries", function (e) {
  e.preventDefault();

  var url = $(this).attr("href"),
    html_content = "",
    selected = "";

  $.ajax({
    url: url,
    type: "get",
    dataType: "json",
    success: function (data) {
      if (data) {
        selected = data.selected;

        $.each(data.all, function () {
          var row = this;
          html_content +=
            "<tr> <td>" +
            row.enquiry_no +
            "</td><td>" +
            row.tenant.first_name +
            row.tenant.last_name +
            "</td><td>" +
            row.tenant.email +
            "</td><td>" +
            row.tenant.phone +
            "</td><td>" +
            row.message +
            "</td>";

          if (row.tenant.status == 0) {
            html_content +=
              '<td><span class="badge badge-warning font-weight-100">Not Registered</span></td>';
          } else {
            html_content +=
              '<td><span class="badge badge-success font-weight-100">Registered</span></td>';
          }

          if (selected && selected.id == row.id) {
            html_content +=
              '<td><a type="button" class="btn btn-primary btn-sm btn-outline disabled" href="">Choose</a></td>';
          } else if (!selected) {
            html_content +=
              '<td><a type="button" class="btn btn-primary btn-sm btn-outline btn-choose" data-property="' +
              row.property_id +
              '" data-tenant="' +
              row.tenant_id +
              '" data-eid="' +
              row.id +
              '" href="" data-dismiss="modal">Choose</a></td>';
          } else {
            html_content +=
              '<td><a type="button" class="btn btn-primary btn-sm btn-outline disabled" data-property="' +
              row.property_id +
              '" data-tenant="' +
              row.tenant_id +
              '" data-eid="' +
              row.id +
              '" href="" data-dismiss="modal">Choose</a></td>';
          }

          $(".tent-modal").find("table tbody").empty();
          $(".tent-modal").find("table tbody").html(html_content);
        });
      }
    },
  });

  $(".tent-modal").modal();
});

// Load Tenant Contract Modal

$(document).on("click", ".btn-choose", function (e) {
  e.preventDefault();

  var property_id = $(this).data("property"),
    tenant_id = $(this).data("tenant"),
    e_id = $(this).data("eid");
  $(".tent-contract").find("form").find('input[name="e_id"]').val(e_id);
  $(".tent-contract")
    .find("form")
    .find('input[name="property_id"]')
    .val(property_id);
  $(".tent-contract")
    .find("form")
    .find('input[name="tenant_id"]')
    .val(tenant_id);

  $.ajax({
    url: "/admin/property/enquiry/" + e_id,
    type: "get",
    dataType: "json",
    success: function (data) {
      if (data.enquiry) {
        $(".tent-contract")
          .find("form")
          .find('input[name="first_name"]')
          .val(data.enquiry.tenant.first_name);
        $(".tent-contract")
          .find("form")
          .find('input[name="last_name"]')
          .val(data.enquiry.tenant.last_name);

        $(".tent-contract")
          .find("form")
          .find('input[name="email"]')
          .val(data.enquiry.tenant.email);
        $(".tent-contract")
          .find("form")
          .find('input[name="phone"]')
          .val(data.enquiry.tenant.phone);
      }

      if (!data.landlord_contract) {
        $(".tent-contract")
          .find("form")
          .find(".msg")
          .text(
            "We could`t find a active landlord contract for this property. Please be aware of this."
          );
      }
    },
  });

  $(".tent-contract").modal();
});

//Property Invoices

$(document).on("click", ".btn-invoices", function (e) {
  e.preventDefault();
  var url = $(this).attr("href"),
    html_content = "";

  $.ajax({
    type: "get",
    url: url,
    dataType: "json",
    success: function (data) {
      if (data) {
        $.each(data, function () {
          var row = this;
          html_content +=
            "<tr> <td>" +
            row.invoice_number +
            "</td><td>" +
            row.month +
            "</td><td>" +
            row.amount +
            "</td>";

          if (row.status == "paid") {
            html_content +=
              '<td><span class="badge badge-success  font-weight-100">Paid</span></td><td><button class="btn btn-primary btn-outline disabled">Pay</button></td>';
          } else {
            html_content +=
              '<td><span class="badge badge-danger  font-weight-100">Not Paid</span></td><td><a type="button" href="/admin/booking/tenant/invoices/pay/' +
              row.id +
              '" class="btn btn-primary btn-outline btn-pay-invoice" onClick="return confirm(`Are you Sure to Pay this Invoice ? `)" >Pay</a></td>';
          }
          html_content += "</tr>";
        });
      }

      $(".invoices-modal").find("table tbody").empty();
      $(".invoices-modal").find("table tbody").html(html_content);
    },
  });
  $(".invoices-modal").modal();
});

//Payment Button

$(document).on("click", ".btn-pay-invoice", function (e) {
  e.preventDefault();
  var url = $(this).attr("href");

  $.ajax({
    type: "get",
    url: url,
    dataType: "json",
    success: function (data) {
      if (data.success) {
        swal({
          title: "Success",
          text: data.message,
          type: "success",
          confirmButtonClass: "btn-success",
          confirmButtonText: "OK",
        });

        $(".invoices-modal").modal("hide");
      } else {
        swal({
          title: "Error",
          text: data.message,
          type: "error",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "OK",
        });
      }
    },
  });
});

//Lanlord Contract Start

$(document).on("click", ".landlord-contract", function (e) {
  e.preventDefault();
  var id = $(this).data("id"),
    price = $(this).data("price");

  $(".landlord-contract-modal")
    .find("form")
    .find('input[name="prop_id"]')
    .val(id);
  $(".landlord-contract-modal")
    .find("form")
    .find('input[name="price"]')
    .val(price);
  $(".landlord-contract-modal").modal("show");
});
