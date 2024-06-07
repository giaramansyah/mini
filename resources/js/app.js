jQuery.fn.extend({
    drawTable: function (settings) {
        var _this = this;
        var _setting = $.extend(
            {
                data: {},
                method: "GET",
                url: null,
                columns: null,
                onCompleteCallback: null,
                onFooterCallback: null,
            },
            settings
        );
        var _options = {};
        _options.serverSide = true;
        _options.processing = true;
        _options.responsive = true;
        _options.autoWidth = false;
        _options.order = [];
        _options.pagingType = "full_numbers";
        _options.dom =
            '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"<"row mx-0 justify-content-end"<"col-auto pl-0"B><"col-auto pr-0"f>>>><"row"<"col-sm-12"t>><"row justify-content-center"<"col-auto text-center"ip>>';
        _options.language = {
            url: "/locale/datatables/json",
        };
        
        _options.buttons = [
            {
                extend: "collection",
                className: "btn-sm",
                buttons: [
                    {
                        extend: "csvHtml5",
                        exportOptions: {
                            columns: [".DT_RowIndex", ".sorting"],
                        },
                    },
                    {
                        extend: "excelHtml5",
                        exportOptions: {
                            columns: [".DT_RowIndex", ".sorting"],
                        },
                    },
                    {
                        extend: "pdfHtml5",
                        exportOptions: {
                            columns: [".DT_RowIndex", ".sorting"],
                        },
                    },
                ],
            },
            {
                extend: "print",
                exportOptions: {
                    columns: [".DT_RowIndex", ".sorting"],
                },
            },
        ];

        if (_setting.url !== null) {
            _options.ajax = {
                method: _setting.method,
                url: _setting.url,
                dataType: "json",
                data: _setting.data,
                beforeSend: function(){
                    _this.find('tbody').html(
                        '<tr class="odd">' +
                            '<td valign="top" colspan="'+_setting.columns.length+'" class="dataTables_empty">' +
                                '<img src="/assets/img/loading.gif" height="40">' +
                            '</td>' +
                        '</tr>'
                    );
                }
            };
        }

        if (_setting.columns !== null) {
            _options.columns = _setting.columns;
        }

        if (_setting.onCompleteCallback !== null) {
            _options.fnInitComplete = _setting.onCompleteCallback;
        }

        if (_setting.onFooterCallback !== null) {
            _options.footerCallback = _setting.onFooterCallback;
        }

        var _table = _this.DataTable(_options);

        return _table;
    },

    inputAlphanum: function () {
        var _this = this;

        _this.each(function (index, selector) {
            var _this2 = $(selector);

            _this2.on("keypress", function (event) {
                var _regex = new RegExp("^[a-zA-Z0-9]+$");
                var _value = String.fromCharCode(
                    !event.charCode ? event.which : event.charCode
                );

                if (_regex.test(_value)) {
                    return true;
                }

                event.preventDefault();

                return false;
            });

            _this2.on("blur", function () {
                var _value = _this2.val();

                _value = _value.replace(/[\W_]+/g, "");

                _this2.val(_value);
            });
        });
    },

    inputNumeric: function (format = false, decimal = false) {
        var _this = this;

        _this.each(function (index, selector) {
            var _this2 = $(selector);

            _this2.on("keypress", function (event) {
                var _value = String.fromCharCode(
                    !event.charCode ? event.which : event.charCode
                );

                if (decimal) {
                    var _regex = new RegExp("^[0-9.]+$");
                } else {
                    var _regex = new RegExp("^[0-9]+$");
                    var _valueLength = _this2.val().length;

                    _this2.focus();
                    _this2[0].setSelectionRange(_valueLength, _valueLength);
                }

                if (_regex.test(_value)) {
                    return true;
                }

                event.preventDefault();

                return false;
            });

            _this2.on("keyup", function () {
                var _value = _this2.val();

                if (decimal) {
                    _value = _value.replace(/[^0-9\.]/g, "");
                } else {
                    _value = _value.replace(/[^0-9]/g, "");
                }

                if (format) {
                    var split = _value.split(".");
                    _value = split[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                    if (split.length > 1 && decimal) {
                        _value += "." + split[1];
                    }
                }

                _this2.val(_value);
            });

            _this2.on("blur", function () {
                var _value = _this2.val();

                if (decimal) {
                    _value = _value.replace(/[^0-9\.]/g, "");
                    if (_value.length > 0) {
                        var split = _value.split(".");
                        if (split.length > 1) {
                            _value = parseFloat(_value).toFixed(2);
                        } else {
                            _value += ".00";
                        }
                    } else {
                        _value = "0.00";
                    }
                } else {
                    _value = _value.replace(/[^0-9]/g, "");
                }

                if (format) {
                    var split = _value.split(".");
                    _value = split[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                    if (split.length > 1 && decimal) {
                        _value += "." + split[1];
                    }
                }

                _this2.val(_value);
            });
        });
    },

    viewData: function (settings) {
        var _this = this;
        var _setting = $.extend(
            {
                data: {
                    id: _this.val(),
                },
                url: null,
                display: [],
            },
            settings
        );

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: _setting.url,
            data: _setting.data,
            beforeSend: function () {
                $.each(_setting.display, function (index, value) {
                    value.val("");
                });
            },
            success: function (response) {
                if (response.status) {
                    var data = response.data;
                    $.each(_setting.display, function (index, value) {
                        value.val(data[value]);
                    });
                }
            },
        });
    },

    datePicker: function (single = false, settings) {
        var _this = this;
        var _locale = $('html').attr('lang');
        var _setting = $.extend(
            {
                singleDatePicker: single,
                maxDate: moment(),
                autoApply: true,
                maxSpan: {
                    days: 90
                },
            },
            settings
        );
        var _callback = function(start, end, label) {
            if(single) {
                var _element = _this.parent().find('input.single-date');
                _element.val(start.format('YYYY-MM-DD'));
            } else {
                var _element1 = _this.parent().find('input.start-date');
                _element1.val(start.format('YYYY-MM-DD'));
                var _element2 = _this.parent().find('input.end-date');
                _element2.val(end.format('YYYY-MM-DD'));
            }
        };

        if(_locale == "id") {
            _setting.locale = {
                format: "DD MMM YYYY",
                weekLabel: "M",
                daysOfWeek: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
                monthNames: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "Sepetember", "Oktober", "November", "Desember"],
                firstDay: 1
            }
        }

        if(_locale == "en") {
            _setting.locale = {
                format: "DD MMM YYYY",
                weekLabel: "W",
                daysOfWeek: ["Su","Mo","Tu","We","Th","Fr","Sa"],
                monthNames: ["January","February","March","April","May","June","July","August","September","October","November","December"],
                firstDay: 1
            }
        }

        if(single) {
            var _element = _this.parent().find('input.single-date');
            if(_element.val() != "") {
                _setting.startDate = moment(_element.val());
            }
        } else {
            var _element1 = _this.parent().find('input.start-date');
            if(_element1.val() != "") {
                _setting.startDate = moment(_element1.val());
            }
            var _element2 = _this.parent().find('input.end-date');
            if(_element2.val() != "") {
                _setting.endDate = moment(_element2.val());
            }
        }

        _this.daterangepicker(_setting, _callback)
    },
});

$('[data-toggle="tooltip"]').tooltip();
$(".select2").select2({ width: "element" });
$(".form-alphanum").inputAlphanum();
$(".form-numeric").inputNumeric();
$(".form-currency").inputNumeric(true, false);
$(".form-decimal").inputNumeric(false, true);
$(".form-numeric-all").inputNumeric(true, true);
$(".form-date").datePicker(true);
$(".form-date-range").datePicker(false);
bsCustomFileInput.init();
