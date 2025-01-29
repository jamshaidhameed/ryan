//Get Tenant Quries on Property Detail Page
$(document).on("click", ".tenant-quries", function (e) {
  e.preventDefault();

  var url = $(this).attr("href"),
    html_content = "",
    selected = $(this).data("selected"),
    getpropertyurl = $("input[name='getpropertyurl']").val();

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
              '" data-getpropertyurl="' +
              getpropertyurl +
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
    getproperty_url = $(this).data("getpropertyurl"),
    contract_period = $('input[name="contract_period"]').val(),
    start_from = $('input[name="start_from"]').val(),
    price = $('input[name="price"]').val();

  // $(".tent-contract")
  //   .find("form")
  //   .find('input[name="contract_period"]')
  //   .val(contract_period);
  // $(".tent-contract").find("form").find('input[name="price"]').val(price);
  // $(".tent-contract")
  //   .find("form")
  //   .find('input[name="start_from"]')
  //   .val(start_from);

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

// CMS page Delete
$(document).on("click", ".delete-cms", function (e) {
  e.preventDefault();
  var url = $(this).attr("href");

  $(".cms-delete").find("form").attr("action", url);
  $(".cms-delete").modal("show");
});

//View First Images on Inspection Form
$(document).on("click", ".first-btn-view", function (e) {
  e.preventDefault();

  $(".first-images").modal("show");
});

//Select Images
$(document).on("click", ".btn-select-images", function (e) {
  e.preventDefault();
  var images = "",
    btn = $(this);
  let checked = $(".tbl-first-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  btn.closest('input[name="selected_images[]"]').val(images);
  $(".first-images").modal("hide");
});

//Second Form Select
$(document).on("click", ".second-btn-view", function (e) {
  e.preventDefault();

  $(".second-images").modal("show");
});

//Select Images
$(document).on("click", ".btn-second-select-images", function (e) {
  e.preventDefault();
  var images = "";
  let checked = $(".tbl-second-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#second-images").val(images);
  $(".second-images").modal("hide");
});

//Third Form Select
$(document).on("click", ".third-btn-view", function (e) {
  e.preventDefault();

  $(".third-images").modal("show");
});

//Select Images
$(document).on("click", ".btn-third-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-third-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#thid-images").val(images);
  $(".third-images").modal("hide");
});

// Fourth Form

//Third Form Select
$(document).on("click", ".fourth-btn-view", function (e) {
  e.preventDefault();

  $(".fourth-images").modal("show");
});

//Select Images
$(document).on("click", ".btn-fourth-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-fourth-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#fourth-images").val(images);
  $(".fourth-images").modal("hide");
});

//FIfth Form
$(document).on("click", ".fourth-btn-view", function (e) {
  e.preventDefault();

  $(".fourth-images").modal("show");
});

//Select Images
$(document).on("click", ".fifth-btn-view", function (e) {
  $(".fifth-images").modal("show");
});
$(document).on("click", ".btn-fifth-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-fifth-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#fifth-images").val(images);
  $(".fifth-images").modal("hide");
});

// Sixth Form
$(document).on("click", ".sixth-btn-view", function (e) {
  e.preventDefault();

  $(".sixth-images").modal("show");
});

//Select Images
$(document).on("click", ".sixth-btn-view", function (e) {
  $(".sixth-images").modal("show");
});
$(document).on("click", ".btn-sixth-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-sixth-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#sixth-images").val(images);
  $(".sixth-images").modal("hide");
});

//Select Images
$(document).on("click", ".seventh-btn-view", function (e) {
  $(".seventh-images").modal("show");
});
$(document).on("click", ".btn-seventh-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-seventh-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#seventh-images").val(images);
  $(".seventh-images").modal("hide");
});

// Eight Form Modal
$(document).on("click", ".eight-btn-view", function (e) {
  $(".eight-images").modal("show");
});
$(document).on("click", ".btn-eight-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-eight-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#eight-images").val(images);
  $(".eight-images").modal("hide");
});

// Ninth Images Upload
$(document).on("click", ".ninth-btn-view", function (e) {
  $(".ninth-images").modal("show");
});
$(document).on("click", ".btn-ninth-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-ninth-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#ninth-images").val(images);
  $(".ninth-images").modal("hide");
});
// Tenth Images Upload
$(document).on("click", ".tenth-btn-view", function (e) {
  $(".tenth-images").modal("show");
});
$(document).on("click", ".btn-tenth-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-tenth-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#tenth-images").val(images);
  $(".tenth-images").modal("hide");
});
// Twelth Images Upload
$(document).on("click", ".twelth-btn-view", function (e) {
  $(".twelth-images").modal("show");
});
$(document).on("click", ".btn-twelth-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-twelth-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#twelth-images").val(images);
  $(".twelth-images").modal("hide");
});
// Thirteenth Images Upload
$(document).on("click", ".thirteen-btn-view", function (e) {
  $(".thirteen-images").modal("show");
});
$(document).on("click", ".btn-thirteen-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-thirteen-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#thirteen-images").val(images);
  $(".thirteen-images").modal("hide");
});
// Fourteenth Images Upload
$(document).on("click", ".fourteen-btn-view", function (e) {
  $(".fourteen-images").modal("show");
});
$(document).on("click", ".btn-fourteen-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-fourteen-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#fourteen-images").val(images);
  $(".fourteen-images").modal("hide");
});

// Fifteen Images Upload
$(document).on("click", ".fifteen-btn-view", function (e) {
  $(".fifteen-images").modal("show");
});
$(document).on("click", ".btn-fifteen-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-fifteen-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#fifteen-images").val(images);
  $(".fifteen-images").modal("hide");
});
// Sixteen Images Upload
$(document).on("click", ".sixteen-btn-view", function (e) {
  $(".sixteen-images").modal("show");
});
$(document).on("click", ".btn-sixteen-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-sixteen-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#sixteen-images").val(images);
  $(".sixteen-images").modal("hide");
});
// Seventeen Images Upload
$(document).on("click", ".seventeen-btn-view", function (e) {
  $(".seventeen-images").modal("show");
});
$(document).on("click", ".btn-seventeen-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-seventeen-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#seventeen-images").val(images);
  $(".seventeen-images").modal("hide");
});

// Eighteen Images Upload
$(document).on("click", ".eighteen-btn-view", function (e) {
  $(".eighteen-images").modal("show");
});
$(document).on("click", ".btn-eighteen-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-eighteen-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#eighteen-images").val(images);
  $(".eighteen-images").modal("hide");
});

// Nineteen Images Upload
$(document).on("click", ".ninteen-btn-view", function (e) {
  $(".ninteen-images").modal("show");
});
$(document).on("click", ".btn-ninteen-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-ninteen-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#ninteen-images").val(images);
  $(".ninteen-images").modal("hide");
});
// Twenty Images Upload
$(document).on("click", ".twenty-btn-view", function (e) {
  $(".twenty-images").modal("show");
});
$(document).on("click", ".btn-twenty-select-images", function (e) {
  e.preventDefault();
  var images = "";

  let checked = $(".tbl-twenty-images tbody").find(
    'input[type="checkbox"]:checked'
  );
  let values = checked
    .map(function () {
      return $(this).val();
    })
    .get();
  images = values.join(",");
  $("#twenty-images").val(images);
  $(".twenty-images").modal("hide");
});

//Remove Image

$(document).on("click", ".btn-r-img", function (e) {
  e.preventDefault();

  if (!confirm("Are you Sure to delete the Image ? ")) {
    return this;
  }
  var url = $(this).data("removelink"),
    img_name = $(this).data("id"),
    prop_id = $(this).data("propid"),
    token = $('input[name="csrf"]').val(),
    btn = $(this);

  $.ajax({
    type: "post",
    url: url,
    dataType: "json",
    data: {
      _token: token,
      id: prop_id,
      img: img_name,
    },
    success: function (data) {
      if (data.success) {
        btn.parent().parent().hide();
      }
    },
  });
});
