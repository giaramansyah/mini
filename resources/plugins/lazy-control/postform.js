/*!
 * PostForm v1.0.0
 * Copyright 2022 TirekWeed95
 */
(function (global, factory) {
    if (typeof exports === "object" && typeof module !== "undefined") {
        factory(exports, require("jquery"));
    } else if (typeof define === "function" && define.amd) {
        define(["exports", "jquery"], factory);
    } else {
        factory((global.PostForm = {}), global.jQuery);
    }
})(this, function (exports, $) {
    "use strict";

    function _interopDefaultLegacy(e) {
        return e && typeof e === "object" && "default" in e
            ? e
            : { default: e };
    }

    var $_default = _interopDefaultLegacy($);

    var ELEMENT = "form.form-lazy-control";
    var X_CSR_TOKEN = 'meta[name="csrf-token"]';
    var DATA_ACTION = "action";
    var DATA_METHOD = "method";
    var DATA_VALIDATE = "validate";
    var ERR_SPAN = "span";
    var ERR_SPAN_CLASS = "is-invalid";
    var ERR_CLASS = "invalid-feedback";
    var FORM_CONTROL = ".form-group";
    var FORM_CONTROL_GROUP = ".input-group";
    var FORM_CONTROL_ROW = ".form-group.row div";
    var FORM_LOADING = ".form-loading";
    var FORM_BUTTON = ".form-button";
    var FORM_ALERT = ".form-alert";
    var Defaults = {
        action: null,
        json: null,
        data: null,
        validate: {},
        method: "post",
    };
    var Static = {
        content: "content",
        username: "username",
        password: "password",
        file: "file",
        image: "image",
        post: "post",
        upload: "upload",
    };

    var PostForm = (function () {
        function PostForm(element, settings) {
            this._element = element;
            this._settings = $_default["default"].extend(
                {},
                Defaults,
                settings
            );
            this._toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
            });
        }

        var _proto = PostForm.prototype;

        _proto._generate = function _generate() {
            var _appender = getAppender();
            var _scrambler = getScrambler();

            var append = _appender
                .map((char) => {
                    var elem = char.join("");
                    return String.fromCharCode(parseInt(elem, 2));
                })
                .join("");
            var arr = [];
            for (var i = 0; i < _scrambler.length; i++) {
                var j = parseInt(_scrambler[i].at(2));
                _scrambler[i].pop();
                arr[j] = append + _scrambler[i].join("");
                arr[j] = String.fromCharCode(parseInt(arr[j], "16"));
            }

            return arr.join("").substring(7);
        };

        _proto._secure = function _secure(data) {
            let iv = CryptoJS.lib.WordArray.random(16),
                key = CryptoJS.enc.Base64.parse(this._generate());
            let options = {
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7,
            };
            let encrypted = CryptoJS.AES.encrypt(data, key, options);
            encrypted = encrypted.toString();
            iv = CryptoJS.enc.Base64.stringify(iv);
            let result = {
                iv: iv,
                value: encrypted,
                mac: CryptoJS.HmacSHA256(iv + encrypted, key).toString(),
            };
            result = JSON.stringify(result);
            result = CryptoJS.enc.Utf8.parse(result);
            return CryptoJS.enc.Base64.stringify(result);
        };

        _proto._serializeObject = function _serializeObject() {
            var _object = {};
            var _origin = $_default["default"](this._element).serializeArray();

            $_default["default"].each(_origin, function () {
                if (
                    this.name.indexOf("[") >= 0 &&
                    this.name.indexOf("]") >= 0
                ) {
                    var split = this.name.split("[");
                    var newName = split[0];
                    var arrValue = split[1].replace("]", "");

                    if (!_object[newName]) {
                        _object[newName] = {};
                    }

                    if (_object[newName][arrValue]) {
                        _object[newName][arrValue].push(this.value);
                    } else {
                        _object[newName][arrValue] = [this.value];
                    }
                } else {
                    if (_object[this.name]) {
                        if (!_object[this.name].push) {
                            _object[this.name] = [_object[this.name]];
                        }
                        _object[this.name].push(this.value || "");
                    } else {
                        _object[this.name] = this.value || "";
                    }
                }
            });

            return this._secure(btoa(JSON.stringify(_object)));
        };

        _proto._formData = function _formData() {
            var _data = new FormData();
            var _files = $_default["default"](this._element).find(
                "input[type=file]"
            );

            _data.append("json", this._serializeObject());
            $_default["default"].each(_files, function () {
                _data.append(
                    this.name,
                    $_default["default"](this)[0].files[0] || []
                );
            });

            return _data;
        };

        _proto._ajaxFrom = function _ajaxForm() {
            var _this = this;

            $_default["default"].ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $_default["default"](X_CSR_TOKEN).attr(
                        Static.content
                    ),
                },
            });
            $_default["default"].ajax({
                type: "POST",
                url: _this._settings.action,
                data: { json: _this._settings.json },
                beforeSend: function () {
                    $_default["default"](_this._element)
                        .find(FORM_LOADING)
                        .show();
                    $_default["default"](_this._element)
                        .find(FORM_BUTTON)
                        .hide();
                },
                success: function (response) {
                    _this._toast.fire({
                        icon: response.alert,
                        text: response.message,
                        willClose: () => {
                            if (response.status) {
                                if ("redirect" in response) {
                                    $_default["default"](_this._element)
                                        .find(FORM_LOADING)
                                        .hide();
                                    $_default["default"](_this._element)
                                        .find(FORM_BUTTON)
                                        .show();
                                    window.location.href = response.redirect;
                                } else {
                                    $_default["default"](_this._element)
                                        .find(FORM_LOADING)
                                        .hide();
                                    $_default["default"](_this._element)
                                        .find(FORM_BUTTON)
                                        .show();
                                }
                            } else {
                                $_default["default"](_this._element)
                                    .find(FORM_LOADING)
                                    .hide();
                                $_default["default"](_this._element)
                                    .find(FORM_BUTTON)
                                    .show();
                            }
                        },
                    });
                },
                error: function () {
                    _this._toast.fire({
                        icon: "error",
                        text: "Internal Server Error",
                        willClose: () => {
                            $_default["default"](_this._element)
                                .find(FORM_LOADING)
                                .hide();
                            $_default["default"](_this._element)
                                .find(FORM_BUTTON)
                                .show();
                        },
                    });
                },
            });
        };

        _proto._ajaxUpload = function _ajaxUpload() {
            var _this = this;

            $_default["default"].ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $_default["default"](
                        'meta[name="csrf-token"]'
                    ).attr("content"),
                },
            });
            $_default["default"].ajax({
                type: "POST",
                url: _this._settings.action,
                data: _this._settings.data,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $_default["default"](_this._element)
                        .find(FORM_LOADING)
                        .show();
                    $_default["default"](_this._element)
                        .find(FORM_BUTTON)
                        .hide();
                    $_default["default"](_this._element)
                        .find(FORM_ALERT)
                        .hide();
                    $_default["default"](_this._element)
                        .find(FORM_ALERT)
                        .find(".alert")
                        .removeClass("alert-success alert-error");
                },
                success: function (response) {
                    _this._toast.fire({
                        icon: response.alert,
                        text: response.message,
                        willClose: () => {
                            $_default["default"](_this._element)
                                .find(FORM_ALERT)
                                .removeClass("text-info");
                            if (response.status) {
                                if ("redirect" in response) {
                                    window.location.href = response.redirect;
                                } else {
                                    $_default["default"](_this._element)
                                        .find(FORM_LOADING)
                                        .hide();
                                    $_default["default"](_this._element)
                                        .find(FORM_BUTTON)
                                        .show();
                                    $_default["default"](_this._element)
                                        .find(FORM_ALERT)
                                        .find(".alert")
                                        .addClass("alert-success");
                                    $_default["default"](_this._element)
                                        .find(FORM_ALERT)
                                        .find(".alert")
                                        .text(response.message);
                                    $_default["default"](_this._element)
                                        .find(FORM_ALERT)
                                        .show();
                                    $_default["default"](_this._element)
                                        .find("input,select")
                                        .val("");
                                    $_default["default"](_this._element)
                                        .find("input,select")
                                        .trigger("change");
                                    $_default["default"](_this._element)
                                        .find(".custom-file-label")
                                        .text("");
                                }
                            } else {
                                $_default["default"](_this._element)
                                    .find(FORM_LOADING)
                                    .hide();
                                $_default["default"](_this._element)
                                    .find(FORM_BUTTON)
                                    .show();
                                $_default["default"](_this._element)
                                    .find(FORM_ALERT)
                                    .find(".alert")
                                    .addClass("alert-error");
                                $_default["default"](_this._element)
                                    .find(FORM_ALERT)
                                    .find(".alert")
                                    .text(response.message);
                                $_default["default"](_this._element)
                                    .find(FORM_ALERT)
                                    .show();
                            }
                        },
                    });
                },
                error: function () {
                    _this._toast.fire({
                        icon: "error",
                        text: "Internal Server Error",
                        willClose: () => {
                            $_default["default"](_this._element)
                                .find(FORM_LOADING)
                                .hide();
                            $_default["default"](_this._element)
                                .find(FORM_BUTTON)
                                .show();
                            $_default["default"](_this._element)
                                .find(FORM_ALERT)
                                .find(".alert")
                                .addClass("alert-error");
                            $_default["default"](_this._element)
                                .find(FORM_ALERT)
                                .find(".alert")
                                .text("Internal Server Error");
                            $_default["default"](_this._element)
                                .find(FORM_ALERT)
                                .show();
                        },
                    });
                },
            });
        };

        _proto._addCustomValidation = function _addCustomValidation() {
            var _this2 = this;
            var _obj = {};

            var fields = $_default["default"](_this2._element).find(
                'input[password], input[equal-to], input[format]'
            );

            if(fields.length > 0) {
                fields.each(function() {
                    var name = $_default["default"](this).attr("name");
                    
                    if(this.hasAttribute('password')) {
                        _obj[name] = {
                            required: true,
                            minlength: 8,
                            alphanumupp: true,
                        };
                    }
                    
                    if(this.hasAttribute('equal-to') && typeof $_default["default"](this).attr('equal-to') !== 'undefined') {
                        var target = $_default["default"](this).attr('equal-to');
                        _obj[name] = {
                            required: true,
                            minlength: 8,
                            equalTo: target,
                            alphanumupp: true,
                        };
                    }

                    if(this.hasAttribute('format') && typeof $_default["default"](this).attr('format') !== 'undefined') {
                        var format = $_default["default"](this).attr('format');
                        _obj[name] =  {
                            required: true,
                        };
                        _obj[name][format] = true;
                    }
                });
            }

            return _obj;
        }

        _proto._init = function _init() {
            var _this2 = this;
            var options = {
                lang: $_default["default"]("html").attr("lang"),
                errorElement: ERR_SPAN,
                errorPlacement: function (error, element) {
                    error.addClass(ERR_CLASS);
                    if (element.closest(FORM_CONTROL_GROUP).length) {
                        element.closest(FORM_CONTROL_GROUP).append(error);
                    } else if (element.closest(FORM_CONTROL_ROW).length) {
                        element.closest(FORM_CONTROL_ROW).append(error);
                    } else {
                        element.closest(FORM_CONTROL).append(error);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $_default["default"](element).addClass(ERR_SPAN_CLASS);
                },
                unhighlight: function (element, errorClass, validClass) {
                    $_default["default"](element).removeClass(ERR_SPAN_CLASS);
                },
                submitHandler: function () {
                    if (
                        $_default["default"](_this2._element).data(
                            DATA_ACTION
                        ) !== "undefined"
                    ) {
                        _this2._settings.action = $_default["default"](
                            _this2._element
                        ).data(DATA_ACTION);
                    } else {
                        _this2._settings.action =
                            $_default["default"](location).attr("href");
                    }

                    if (_this2._settings.method === Static.post) {
                        _this2._settings.json = _this2._serializeObject();
                        _this2._ajaxFrom();
                    }

                    if (_this2._settings.method === Static.upload) {
                        _this2._settings.data = _this2._formData();
                        _this2._ajaxUpload();
                    }
                },
            };

            options.rules = _this2._addCustomValidation();

            _this2._element.validate(options);
        };

        $_default["default"].validator.addMethod("alphanum", function (value) {
            return /[a-zA-Z]/.test(value) && /\d/.test(value);
        });

        $_default["default"].validator.addMethod("alphanumupp", function (value) {
            return /[a-z]/.test(value) && /[A-Z]/.test(value) && /\d/.test(value);
        });

        PostForm._jQueryInterface = function _jQueryInterface() {
            var options = {};

            if (
                typeof $_default["default"](this).data(DATA_METHOD) !==
                "undefined"
            ) {
                options.method = $_default["default"](this).data(DATA_METHOD);
            }

            if (
                typeof $_default["default"](this).data(DATA_VALIDATE) !==
                "undefined"
            ) {
                options.validate = {};
                var validate = $_default["default"](this).data(DATA_VALIDATE);
                validate = validate.split(",");

                if (
                    $_default["default"].inArray(Static.username, validate) > -1
                ) {
                    options.validate.username = true;
                }

                if (
                    $_default["default"].inArray(Static.password, validate) > -1
                ) {
                    options.validate.password = true;
                }

                if ($_default["default"].inArray(Static.file, validate) > -1) {
                    options.validate.file = true;
                }

                if ($_default["default"].inArray(Static.image, validate) > -1) {
                    options.validate.image = true;
                }

                if (
                    $_default["default"].inArray(Static.max_amount, validate) >
                    -1
                ) {
                    options.validate.max_amount = true;
                }

                if (
                    $_default["default"].inArray(
                        Static.max_amount_request,
                        validate
                    ) > -1
                ) {
                    options.validate.max_amount_request = true;
                }

                if (
                    $_default["default"].inArray(
                        Static.max_amount_approve,
                        validate
                    ) > -1
                ) {
                    options.validate.max_amount_approve = true;
                }
            }

            var _options = $_default["default"].extend({}, Defaults, options);
            var data = new PostForm($_default["default"](this), _options);
            data._init();
        };

        return PostForm;
    })();

    $_default["default"](ELEMENT).each(function () {
        $_default["default"](this).submit(function (event) {
            event.preventDefault();
        });
        PostForm._jQueryInterface.call($_default["default"](this));
    });

    $_default["default"].fn["PostForm"] = PostForm._jQueryInterface;
    $_default["default"].fn["PostForm"].Constructor = PostForm;

    exports.PostForm = PostForm;
    Object.defineProperty(exports, "__esModule", { value: true });
});
