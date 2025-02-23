/*!
 * Remark (http://getbootstrapadmin.com/remark)
 * Copyright 2017 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */

!(function (global, factory) {
    if ("function" == typeof define && define.amd)
        define("/tables/datatable", ["jquery", "Site"], factory);
    else if ("undefined" != typeof exports)
        factory(require("jquery"), require("Site"));
    else {
        var mod = { exports: {} };
        factory(global.jQuery, global.Site),
            (global.tablesDatatable = mod.exports);
    }
})(this, function (_jquery, _Site) {
    "use strict";
    var _jquery2 = babelHelpers.interopRequireDefault(_jquery),
        Site = babelHelpers.interopRequireWildcard(_Site);
    (0, _jquery2.default)(document).ready(function ($) {
        Site.run();
    }),
        (function () {
            var offsetTop = 0;
            (0, _jquery2.default)(".site-navbar").length > 0 &&
                (offsetTop = (0, _jquery2.default)(".site-navbar")
                    .eq(0)
                    .innerHeight());
            (0, _jquery2.default)("#exampleFixedHeader").DataTable({
                responsive: !0,
                fixedHeader: { header: !0, headerOffset: offsetTop },
                paging: !1,
                dom: "t",
            });
        })(),
        (0, _jquery2.default)(document).ready(function () {
            var defaults = Plugin.getDefaults("dataTable"),
                options = _jquery2.default.extend(!0, {}, defaults, {
                    pageLength: 1000,
                    initComplete: function () {
                        this.api()
                            .columns()
                            .every(function () {
                                var column = this,
                                    select = (0, _jquery2.default)(
                                        '<select class="form-control w-full"><option value=""></option></select>'
                                    )
                                        .appendTo(
                                            (0, _jquery2.default)(
                                                column.footer()
                                            ).empty()
                                        )
                                        .on("change", function () {
                                            var val =
                                                _jquery2.default.fn.dataTable.util.escapeRegex(
                                                    (0, _jquery2.default)(
                                                        this
                                                    ).val()
                                                );
                                            column
                                                .search(
                                                    val ? "^" + val + "$" : "",
                                                    !0,
                                                    !1
                                                )
                                                .draw();
                                        });
                                column
                                    .data()
                                    .unique()
                                    .sort()
                                    .each(function (d, j) {
                                        select.append(
                                            '<option value="' +
                                                d +
                                                '">' +
                                                d +
                                                "</option>"
                                        );
                                    });
                            });
                    },
                });
            (0, _jquery2.default)("#exampleTableSearch").DataTable(options);
        }),
        (0, _jquery2.default)(document).ready(function () {
            var defaults = Plugin.getDefaults("dataTable"),
                options = _jquery2.default.extend(!0, {}, defaults, {
                    aoColumnDefs: [{ bSortable: !1, aTargets: [-1] }],
                    iDisplayLength: 5,
                    aLengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"],
                    ],
                    sDom: '<"dt-panelmenu clearfix"Bfr>t<"dt-panelfooter clearfix"ip>',
                    buttons: ["copy", "excel", "csv", "pdf", "print"],
                });
            (0, _jquery2.default)("#exampleTableTools").dataTable(options);
        }),
        function ($) {
            var EditableTable = {
                options: {
                    addButton: "#addToTable",
                    table: "#exampleAddRow",
                    dialog: {
                        wrapper: "#dialog",
                        cancelButton: "#dialogCancel",
                        confirmButton: "#dialogConfirm",
                    },
                },
                initialize: function () {
                    this.setVars().build().events();
                },
                setVars: function () {
                    return (
                        (this.$table = $(this.options.table)),
                        (this.$addButton = $(this.options.addButton)),
                        (this.dialog = {}),
                        (this.dialog.$wrapper = $(this.options.dialog.wrapper)),
                        (this.dialog.$cancel = $(
                            this.options.dialog.cancelButton
                        )),
                        (this.dialog.$confirm = $(
                            this.options.dialog.confirmButton
                        )),
                        this
                    );
                },
                build: function () {
                    return (
                        (this.datatable = this.$table.DataTable({
                            aoColumns: [null, null, null, { bSortable: !1 }],
                            language: {
                                sSearchPlaceholder: "Search..",
                                lengthMenu: "_MENU_",
                                search: "_INPUT_",
                            },
                        })),
                        (window.dt = this.datatable),
                        this
                    );
                },
                events: function () {
                    var _self = this;
                    return (
                        this.$table
                            .on("click", "a.save-row", function (e) {
                                e.preventDefault(),
                                    _self.rowSave($(this).closest("tr"));
                            })
                            .on("click", "a.cancel-row", function (e) {
                                e.preventDefault(),
                                    _self.rowCancel($(this).closest("tr"));
                            })
                            .on("click", "a.edit-row", function (e) {
                                e.preventDefault(),
                                    _self.rowEdit($(this).closest("tr"));
                            })
                            .on("click", "a.remove-row", function (e) {
                                e.preventDefault();
                                var $row = $(this).closest("tr");
                                bootbox.dialog({
                                    message:
                                        "Are you sure that you want to delete this row?",
                                    title: "ARE YOU SURE?",
                                    buttons: {
                                        danger: {
                                            label: "Confirm",
                                            className: "btn-danger",
                                            callback: function () {
                                                _self.rowRemove($row);
                                            },
                                        },
                                        main: {
                                            label: "Cancel",
                                            className: "btn-primary",
                                            callback: function () {},
                                        },
                                    },
                                });
                            }),
                        this.$addButton.on("click", function (e) {
                            e.preventDefault(), _self.rowAdd();
                        }),
                        this.dialog.$cancel.on("click", function (e) {
                            e.preventDefault(), $.magnificPopup.close();
                        }),
                        this
                    );
                },
                rowAdd: function () {
                    this.$addButton.attr({ disabled: "disabled" });
                    var actions, data, $row;
                    (actions = [
                        '<a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row" data-toggle="tooltip" data-original-title="Save" hidden><i class="icon wb-wrench" aria-hidden="true"></i></a>',
                        '<a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row" data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon wb-close" aria-hidden="true"></i></a>',
                        '<a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>',
                        '<a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove"><i class="icon wb-trash" aria-hidden="true"></i></a>',
                    ].join(" ")),
                        (data = this.datatable.row.add(["", "", "", actions])),
                        ($row = this.datatable.row(data[0]).nodes().to$())
                            .addClass("adding")
                            .find("td:last")
                            .addClass("actions"),
                        this.rowEdit($row),
                        this.datatable.order([0, "asc"]).draw();
                },
                rowCancel: function ($row) {
                    var $actions, data;
                    $row.hasClass("adding")
                        ? this.rowRemove($row)
                        : (($actions = $row.find("td.actions"))
                              .find(".cancel-row")
                              .tooltip("hide"),
                          $actions.get(0) && this.rowSetActionsDefault($row),
                          (data = this.datatable.row($row.get(0)).data()),
                          this.datatable.row($row.get(0)).data(data),
                          this.handleTooltip($row),
                          this.datatable.draw());
                },
                rowEdit: function ($row) {
                    var data,
                        _self = this;
                    (data = this.datatable.row($row.get(0)).data()),
                        $row.children("td").each(function (i) {
                            var $this = $(this);
                            $this.hasClass("actions")
                                ? _self.rowSetActionsEditing($row)
                                : $this.html(
                                      '<input type="text" class="form-control input-block" value="' +
                                          data[i] +
                                          '"/>'
                                  );
                        });
                },
                rowSave: function ($row) {
                    var $actions,
                        _self = this,
                        values = [];
                    $row.hasClass("adding") &&
                        (this.$addButton.removeAttr("disabled"),
                        $row.removeClass("adding")),
                        (values = $row.find("td").map(function () {
                            var $this = $(this);
                            return $this.hasClass("actions")
                                ? (_self.rowSetActionsDefault($row),
                                  _self.datatable.cell(this).data())
                                : $.trim($this.find("input").val());
                        })),
                        ($actions = $row.find("td.actions"))
                            .find(".save-row")
                            .tooltip("hide"),
                        $actions.get(0) && this.rowSetActionsDefault($row),
                        this.datatable.row($row.get(0)).data(values),
                        this.handleTooltip($row),
                        this.datatable.draw();
                },
                rowRemove: function ($row) {
                    $row.hasClass("adding") &&
                        this.$addButton.removeAttr("disabled"),
                        this.datatable.row($row.get(0)).remove().draw();
                },
                rowSetActionsEditing: function ($row) {
                    $row.find(".on-editing").removeAttr("hidden"),
                        $row.find(".on-default").attr("hidden", !0);
                },
                rowSetActionsDefault: function ($row) {
                    $row.find(".on-editing").attr("hidden", !0),
                        $row.find(".on-default").removeAttr("hidden");
                },
                handleTooltip: function ($row) {
                    $row.find('[data-toggle="tooltip"]').tooltip();
                },
            };
            $(function () {
                EditableTable.initialize();
            });
        }.apply(void 0, [jQuery]);
});
