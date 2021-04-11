/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/assessment.js":
/***/ (function(module, exports) {

var assessment_id = $('#assessment_id').val();
var class_subject_detail_id = $('#class_subject_detail_id').val();
var page = $('#tab').val();

var attempt = 0;
// monitoring get student assessment data status
if (page == 'monitoring') {
    getStudentData();
    setInterval(function () {
        getStudentData();
    }, 5000);
}
function getStudentData() {
    // loader_overlay();
    $.ajax({
        url: "monitoring-student",
        type: 'POST',
        async: true,
        cache: false,
        data: {
            '_token': $('input[name=_token]').val()
        },
        success: function success(res) {
            // loader_overlay();
            var output = '';
            var student_male = res.student_male;
            var student_female = res.student_female;
            var mlen = student_male.length;
            var flen = student_female.length;
            output += '<tr class="bg-primary">\n                            <td colspan="6">Male</td>\n                        </tr>';
            var total_question = res.question_total;
            for (var i = 0; i < mlen; i++) {
                // console.log(student_male[i]['last_name'])

                output += '<tr>';
                output += '<td>' + (i + 1) + '. </td>';
                output += '<td>' + student_male[i]['last_name'] + ', ' + student_male[i]['first_name'] + ' ' + student_male[i]['middle_name'] + '</td>';
                output += '<td>0/' + total_question + '</td>';
                if (student_male[i]['time_start'] != null) {
                    output += '<td>' + student_male[i]['time_start'] + '</td>';
                } else {
                    output += '<td>00:00</td>';
                }

                if (student_male[i]['exam_status'] == 1) {
                    output += '<td><span class="badge badge-primary">on-going</span></td>';
                } else if (student_male[i]['exam_status'] == 2) {
                    output += '<td><span class="badge badge-warning">pending</span></td>';
                } else if (student_male[i]['exam_status'] == 3) {
                    output += '<td><span class="badge badge-success">done</span></td>';
                } else if (student_male[i]['exam_status'] == null) {
                    output += '<td><span class="badge badge-warning">pending</span></td>';
                }
                output += '<td class="text-center">\n                                <a class="btn btn-sm btn-primary btn-view-modal" data-id="">\n                                    <i class="fas fa-eye"></i>\n                                </a>\n                                <a class="btn btn-sm btn-danger btn-disapprove" data-id="">\n                                    reset\n                                </a>\n                            </td>';
            }
            output += '<tr class="bg-red">\n                            <td colspan="6">Female</td>\n                        </tr>';
            for (var i = 0; i < flen; i++) {
                // console.log(student_male[i]['last_name'])
                output += '<tr>';
                output += '<td>' + (i + 1) + '. </td>';
                output += '<td>' + student_female[i]['last_name'] + ', ' + student_female[i]['first_name'] + ' ' + student_female[i]['middle_name'] + '</td>';
                output += '<td>0/' + total_question + '</td>';
                if (student_female[i]['time_start'] != null) {
                    output += '<td>' + student_female[i]['time_start'] + '</td>';
                } else {
                    output += '<td>00:00</td>';
                }
                if (student_female[i]['exam_status'] == 1) {
                    output += '<td><span class="badge badge-primary">on-going</span></td>';
                } else if (student_female[i]['exam_status'] == 2) {
                    output += '<td><span class="badge badge-warning">pending</span></td>';
                } else if (student_female[i]['exam_status'] == 3) {
                    output += '<td><span class="badge badge-success">done</span></td>';
                } else if (student_female[i]['exam_status'] == null) {
                    output += '<td><span class="badge badge-warning">pending</span></td>';
                }
                output += '<td class="text-center">\n                                <a class="btn btn-sm btn-primary btn-view-modal" data-id="">\n                                    <i class="fas fa-eye"></i>\n                                </a>\n                                <a class="btn btn-sm btn-danger btn-disapprove" data-id="">\n                                    reset\n                                </a>\n                            </td>';
            }
            $('#table-monitoring tbody').html("");
            $('#table-monitoring tbody').html(output);
        }
    });
}

// question save
$('body').on('submit', '#js-question-form', function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: "/faculty/assessment/subject/questions/" + class_subject_detail_id + "/save-question",
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function success(res) {
            $('.help-block').html('');
            if (res.res_code == 1) {
                for (var err in res.res_error_msg) {
                    $('#js-' + err).html('<code> ' + res.res_error_msg[err] + ' </code>');
                }
                show_toast_alert({
                    heading: 'Error',
                    message: res.res_msg,
                    type: 'error'
                });
            } else {
                show_toast_alert({
                    heading: 'Success',
                    message: res.res_msg,
                    type: 'success'
                });

                location.reload();
                // fetch_data();
            }
        }
    });
});

// save instruction
$('body').on('submit', '#js-instruction-form', function (e) {
    e.preventDefault();

    var formData = new FormData($(this)[0]);
    $.ajax({
        url: "/faculty/assessment/subject/questions/" + class_subject_detail_id + "/save-instruction",
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function success(res) {
            $('.help-block').html('');
            if (res.res_code == 1) {
                show_toast_alert({
                    heading: 'Error',
                    message: res.res_msg,
                    type: 'error'
                });
            } else {
                show_toast_alert({
                    heading: 'Success',
                    message: res.res_msg,
                    type: 'success'
                });
                var slug = res.data;
                // let url = "{{ route('faculty.question', ": slug") }}";
                // let url = "faculty/assessment/subject/questions/"+slug;
                // url = url.replace('slug', slug);
                var url = location.protocol + '//' + location.host + "/faculty/assessment/subject/questions/" + assessment_id;
                window.location.href = url;

                // fetch_data();
            }
        }
    });
});
// event for assessment settings form
$('body').on('submit', '#js-assessment-create-form, #js-assessment-update-form', function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: "/faculty/assessment/subject/" + class_subject_detail_id + "/assessment-subject-save-data",
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function success(res) {
            $('.help-block').html('');
            if (res.res_code == 1) {
                show_toast_alert({
                    heading: 'Error',
                    message: res.res_msg,
                    type: 'error'
                });
            } else {
                show_toast_alert({
                    heading: 'Success',
                    message: res.res_msg,
                    type: 'success'
                });
                // fetch_data();
            }
        }
    });
});

// search assessment data
var page = 1;
function fetch_data() {
    var formData = new FormData($('#js-form_search')[0]);
    formData.append('page', page);
    loader_overlay();

    $.ajax({
        url: "/faculty/assessment/subject/" + assessment_id + "/edit-assessment",
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function success(res) {
            loader_overlay();
            $('.js-data-container').html(res);
        }
    });
}

$('body').on('click', '.js-btn_archived', function (e) {
    e.preventDefault();
    var self = $(this);
    var id = $(this).data('id');

    alertify.defaults.transition = "slide";
    alertify.defaults.theme.ok = "btn btn-primary ";
    alertify.defaults.theme.cancel = "btn btn-danger ";
    alertify.confirm('Confirmation', 'Are you sure you want to move this to archive?', function () {
        $.ajax({
            url: "/faculty/assessment/move-archive",
            type: 'POST',
            data: { _token: '{{ csrf_token() }}', id: id },
            success: function success(res) {
                $('.help-block').html('');
                if (res.res_code == 1) {
                    show_toast_alert({
                        heading: 'Error',
                        message: res.res_msg,
                        type: 'error'
                    });
                } else {
                    show_toast_alert({
                        heading: 'Success',
                        message: res.res_msg,
                        type: 'success'
                    });
                    $('.js-modal_holder .modal').modal('hide');
                    // fetch_data();
                    location.reload();
                    // self.closest('tr').remove();
                }
            }
        });
    }, function () {});
});

$('body').on('click', '.js-btn-publish', function (e) {
    e.preventDefault();
    var self = $(this);
    var id = $(this).data('id');
    var type = $(this).data('type');
    alertify.defaults.transition = "slide";
    alertify.defaults.theme.ok = "btn btn-primary ";
    alertify.defaults.theme.cancel = "btn btn-danger ";
    alertify.confirm('Confirmation', 'Are you sure you want to mark this as ' + type + '?', function () {
        $.ajax({
            url: "faculty/assessment/move-published",
            type: 'POST',
            data: { _token: '{{ csrf_token() }}', id: id, type: type },
            success: function success(res) {
                $('.help-block').html('');
                if (res.res_code == 1) {
                    show_toast_alert({
                        heading: 'Error',
                        message: res.res_msg,
                        type: 'error'
                    });
                } else {
                    show_toast_alert({
                        heading: 'Success',
                        message: res.res_msg,
                        type: 'success'
                    });

                    // fetch_data();
                    // self.closest('tr').remove();
                    location.reload();
                }
            }
        });
    }, function () {});
});

$('body').on('click', '#js-button-add, .js-btn_update_sy', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: "faculty/assessment/subject/" + class_subject_detail_id + "/modal-data&tab=" + page,
        type: 'POST',
        data: { _token: '{{ csrf_token() }}', id: id },
        success: function success(res) {
            $('.js-modal_holder').html(res);
            $('.js-modal_holder .modal').modal({ backdrop: 'static' });
        }
    });
});

$('body').on('submit', '#js-form_search', function (e) {
    e.preventDefault();
    fetch_data();
});
$('body').on('click', '.pagination a', function (e) {
    e.preventDefault();
    page = $(this).attr('href').split('=')[1];
    fetch_data();
});

$(document).on('change', 'select[name="question_type"]', function (e) {
    e.preventDefault();
    examType();
});
$(document).on('click', '#btn-question-type-selected', function (e) {
    e.preventDefault();
    examType();
});

// add button
var btn = 4;
$('#btn-add-option-multiple').click(function (e) {
    e.preventDefault();
    btn++;
    $('#multiple-choice').append('<li class="li-row">\n        <div class="input-group">\n            <span class="handle mt-1">\n                <i class="fas fa-ellipsis-v"></i>\n                <i class="fas fa-ellipsis-v"></i>\n            </span>                       \n            <input type="text" class="form-control form-control-sm" name="options[]">\n            &nbsp;&nbsp;&nbsp;\n            <div class="icheck-danger d-inline">\n                <input type="radio" name="multiple_answer" id="options' + btn + '" value="' + btn + '">\n                <label for="options' + btn + '"></label>\n            </div>\n            <div class="tools p-1">\n                <i class="fas fa-times-circle fa-lg delete-multiple-item"></i>\n            </div>\n        </div>\n    </li>');
});

$(document).on('click', '.delete-multiple-item', function () {
    $(this).closest('.li-row').remove();
});

// exam type
function examType() {
    loader_overlay();
    var question_type = $('select[name="question_type"]').val();
    if (question_type) {
        $('#btn-question-type-selected').addClass('d-none');
        setTimeout(function () {
            $('#js-loader-overlay').addClass('d-none');
        }, 1000);

        // alert(question_type)
        var url = location.protocol + '//' + location.host + "/faculty/assessment/subject/" + assessment_id + "/edit-assessment?tab=questions&question=" + question_type;
        window.location.href = url;
    }
}

$('#btn-add-option-match').click(function (e) {
    e.preventDefault();
    btn++;
    $('#match').append('<li class="li-row">\n            <div class="input-group">\n                <span class="handle mt-1">\n                    <i class="fas fa-ellipsis-v"></i>\n                    <i class="fas fa-ellipsis-v"></i>\n                </span>\n                <input type="text" class="form-control form-control-sm" name="matching_options[]">\n                &nbsp;&nbsp;&nbsp;&nbsp;\n                <input type="text" class="form-control form-control-sm" name="matching_answer[]">\n                <div class="tools p-1">\n                    <i class="fas fa-times-circle fa-lg delete-match-item"></i>\n                </div>\n            </div>\n        </li>');
});

$(document).on('click', '.delete-match-item', function () {
    $(this).closest('#match .li-row').remove();
});
$('#btn-add-option-ordering').click(function (e) {
    e.preventDefault();
    btn++;
    $('#ordering').append('<li class="li-row">\n            <div class="input-group">\n                <span class="handle mt-1">\n                    <i class="fas fa-ellipsis-v"></i>\n                    <i class="fas fa-ellipsis-v"></i>\n                </span>\n                <input type="text" class="form-control form-control-sm" name="ordering_option[]">\n                &nbsp;&nbsp;\n                <div class="tools p-1">\n                    <i class="fas fa-times-circle fa-lg delete-ordering-item"></i>\n                </div>\n            </div>\n        </li>');
});

$(document).on('click', '.delete-ordering-item', function (e) {
    e.preventDefault();
    $(this).closest('#ordering .li-row').remove();
});
$('#btn-add-option-identification').click(function (e) {
    e.preventDefault();

    $('#identification').append('<div class="identification col-md-12">\n                <div class="col-md-12">\n                    <hr>\n                </div>\n                <div class="form-group" id="js-question_identification">\n                    <div class="float-right">\n                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-entire-identification">\n                            <i class="fas fa-trash"></i> Delete\n                        </button>\n                    </div>\n                    <label class="mt-3" for="summernote">Question Setup</label>\n                    <textarea name="question_identification[]" class="js-question_identification"></textarea>\n                    <div class="help-block text-red" id="js-question_identification"></div>\n                </div>\n                <div class="row">\n                    <div class="col-md-9">\n                        <label for="identification_answer">Answer:</label>\n                        <input type="text" class="form-control form-control-sm" id="identification_answer" name="identification_answer[]">\n                        <div class="help-block text-red" id="js-identification_answer"></div>\n                    </div>\n                    <div class="col-md-3">\n                        <div class="form-group">\n                            <div class=\'js-points\'>\n                                <label for="points_per_question">Points this question:</label>\n                                <input type="number" class="form-control form-control-sm" id="points_per_question" name="points_per_question[]" value="1">\n                                <div class="help-block text-red" id="js-points_per_question"></div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>');

    // var div = $('<div>').appendTo($("#js-question_field"));
    // div.class('js-question_setup').summernote();
    $(".js-question_identification").summernote({
        toolbar: [['style', ['style']], ['font', ['bold', 'italic', 'underline', 'clear']], ['para', ['ul']], ['insert', ['table', 'link', 'picture']], ['view', ['fullscreen', 'help']]],
        height: 50,
        codemirror: {
            theme: 'monokai'
        },
        placeholder: 'Write here...',
        spellCheck: true

    });
});

$(document).on('click', '.btn-delete-entire-identification', function (e) {
    e.preventDefault();
    $(this).closest('#identification .identification').remove();
});

$('.select2').select2();
// $('.tab-setup').addClass('active')
// $('.nav-setup').addClass('active')
$('#publishdatetime, #expdatetime').datetimepicker({
    autoclose: true,
    format: 'yyyy-mm-dd hh:ii'
});
// $('#summernote').summernote()
$('#summernote').summernote({
    toolbar: [['style', ['style']], ['font', ['bold', 'italic', 'underline', 'clear']], ['para', ['ul']], ['insert', ['table', 'link']], ['view', ['fullscreen', 'help']]],
    height: 50,
    codemirror: {
        theme: 'monokai'
    },
    placeholder: 'Write here...',
    spellCheck: true
});
$('.js-question_setup, .js-question_identification').summernote({
    toolbar: [['style', ['style']], ['font', ['bold', 'italic', 'underline', 'clear']], ['para', ['ul']], ['insert', ['table', 'link', 'picture']], ['view', ['fullscreen', 'help']]],
    height: 50,
    codemirror: {
        theme: 'monokai'
    },
    placeholder: 'Write here...',
    spellCheck: true

});
$('.js-answer_option').summernote({
    airMode: true
});

/***/ }),

/***/ 1:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/assessment.js");


/***/ })

/******/ });