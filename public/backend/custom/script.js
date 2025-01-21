//Get Tenant Quries on Property Detail Page
$(document).on("click", ".tenant-quries", function (e) {
  e.preventDefault();

  var url = $(this).attr("href"),
    html_content = "",
    selected = $(this).data("selected");

  $.ajax({
    url: url,
    type: "get",
    dataType: "json",
    success: function (data) {
      if (data) {
        // selected = data.selected;

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

          if (selected == 1) {
            html_content +=
              '<td><a type="button" class="btn btn-primary btn-sm btn-outline disabled" href="">Choose</a></td>';
          } else if (selected == 0) {
            html_content +=
              '<td><a type="button" class="btn btn-primary btn-sm btn-outline btn-choose" data-property="' +
              row.property_id +
              '" data-tenant="' +
              row.tenant_id +
              '" data-eid="' +
              row.id +
              '" href="" data-dismiss="modal">Choose</a></td>';
          }
          // else {
          //   html_content +=
          //     '<td><a type="button" class="btn btn-primary btn-sm btn-outline disabled" data-property="' +
          //     row.property_id +
          //     '" data-tenant="' +
          //     row.tenant_id +
          //     '" data-eid="' +
          //     row.id +
          //     '" href="" data-dismiss="modal">Choose</a></td>';
          // }

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
    e_id = $(this).data("eid"),
    getproperty_url = $(this).data("getpropertyurl");
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
    url: getproperty_url + "/" + e_id,
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
    html_content = "",
    payment_url = $(this).data("paymentroute");

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
              '<td><span class="badge badge-danger  font-weight-100">Not Paid</span></td><td><a type="button" href="' +
              payment_url +
              "/" +
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

//Assign Technical Peron

$(document).on("click", ".assign-technical-person", function (e) {
  e.preventDefault();

  var id = $(this).data("id");

  $(".assign-technision").find("form").find('input[name="ticket_id"]').val(id);
  $(".assign-technision").modal("show");
});

//Landlord Invoices

$(document).on("click", ".landlord-invoices", function (e) {
  e.preventDefault();

  var url = $(this).attr("href"),
    html_data = "",
    payment_url = $(this).data("paymentroute");

  $.ajax({
    type: "get",
    url: url,
    dataType: "json",
    success: function (data) {
      if (data) {
        $.each(data, function () {
          var row = this;
          html_data +=
            "<tr> <td>" +
            row.invoice_number +
            "</td><td>" +
            row.month +
            "</td><td>" +
            row.amount +
            "</td>";

          if (row.status == "paid") {
            html_data +=
              '<td><span class="badge badge-success  font-weight-100">Paid</span></td><td><button class="btn btn-primary btn-outline disabled">Pay</button></td>';
          } else {
            html_data +=
              '<td><span class="badge badge-danger  font-weight-100">Not Paid</span></td><td><a type="button" href="' +
              payment_url +
              "/" +
              row.id +
              '" class="btn btn-primary btn-outline btn-landlord-invoice-pay" onClick="return confirm(`Are you Sure to Pay this Invoice ? `)" >Pay</a></td>';
          }
          html_data += "</tr>";
        });
      }

      $(".landlord-invoices-modal").find("table tbody").empty();
      $(".landlord-invoices-modal").find("table tbody").html(html_data);
    },
  });

  $(".landlord-invoices-modal").modal("show");
});

//Click on Landlord Invoice Pay
$(document).on("click", ".btn-landlord-invoice-pay", function (e) {
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

        $(".landlord-invoices-modal").modal("hide");
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

//Issue Ticket Cost
$(document).on("click", ".btn-issue-invoice-pay", function (e) {
  e.preventDefault();

  var id = $(this).data("id");
  $(".issue-ticket-pay-modal")
    .find("form")
    .find('input[name="ticket_id"]')
    .val(id);
  $(".issue-ticket-pay-modal").modal("show");
});

//Terminate Tenant Contract
$(document).on("click", ".btn-tenant-terminate", function (e) {
  e.preventDefault();

  var id = $(this).data("id");

  $(".tenant-terminate").find("form").find('input[name="e_id"]').val(id);
  $(".tenant-terminate").modal("show");
});

//Terminate Landlord Contract

$(document).on("click", ".btn-landlord-terminate", function (e) {
  e.preventDefault();

  var id = $(this).data("id");

  $(".landlord-terminate").find("form").find('input[name="e_id"]').val(id);
  $(".landlord-terminate").modal("show");
});

//Commision Details
$(document).on("click", ".btn-commision-details", function (e) {
  e.preventDefault();
  var id = $(this).data("id"),
    verified = $(this).data("verified"),
    amount = $(this).data("amount");
  $(".commision-details").find("form").find('input[name="e_id"]').val(id);
  $(".commision-details").find("form").find('input[name="amount"]').val(amount);
  if (verified == "yes") {
    $(".commision-details")
      .find("form")
      .find('input[name="amount"]')
      .prop("disabled", true);
    $(".commision-details")
      .find("form")
      .find("#payment-status")
      .html('<span class="badge badge-success font-weight-100">Paid</span>');
    $(".commision-details")
      .find("form")
      .find(".btn-commision")
      .text("Already paid")
      .prop("disabled", true);
  } else {
    $(".commision-details")
      .find("form")
      .find("#payment-status")
      .html('<span class="badge badge-danger font-weight-100">Not paid</span>');
    $(".commision-details").find("form").find(".btn-commision").text("Pay");
  }
  $(".commision-details").modal("show");
});

//View Reason

$(document).on("click", ".reason-btn", function (e) {
  e.preventDefault();
  var resean = $(this).data("resean"),
    terminated_on = $(this).data("terminatedon");
  $(".terminate-reason")
    .find(".reason-text")
    .html(
      resean +
        '<br> <span class="badge badge-success font-weight-100">' +
        terminated_on +
        "</span>"
    );
  $(".terminate-reason").modal("show");
});

//Create Inspection
$(document).on("click", ".btn-store-inspection", function (e) {
  e.preventDefault();
  var url = $(this).attr("href");
  $(".create-inspection-modal").find("form").attr("action", url);
  $(".create-inspection-modal").modal("show");
});

//Update Inspection
$(document).on("click", ".btn-update-inspection", function (e) {
  e.preventDefault();
  var url = $(this).attr("href"),
    type = $(this).data("insptype"),
    assing_to = $(this).data("assignto"),
    inspection_date = $(this).data("insdate"),
    note = $(this).data("note");
  $(".create-inspection-modal").find("form").attr("action", url);
  $(".create-inspection-modal")
    .find("form")
    .find(".modal-title")
    .text("Update Inspection");
  $(".create-inspection-modal")
    .find("form")
    .find('select[name="inspection_type"]')
    .val(type);
  $(".create-inspection-modal")
    .find("form")
    .find('input[name="inspection_date"]')
    .val(inspection_date);
  $(".create-inspection-modal")
    .find("form")
    .find('select[name="inspected_by"]')
    .val(assing_to);
  $(".create-inspection-modal")
    .find("form")
    .find('textarea[name="inspection_notes"]')
    .val(note);
  $(".create-inspection-modal").find("form").find(".btn-save").text("Update");
  $(".create-inspection-modal").find(".modal-title").text("Update Inspection");
  $(".create-inspection-modal").modal("show");
});
