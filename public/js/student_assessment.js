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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/student_assessment.js":
/***/ (function(module, exports) {

var student_exam_status = $('#student_exam_status').val();
var student_information_id = $('#student_information_id').val();
var tab = $('#tab').val();

alertify.defaults.transition = "slide";
alertify.defaults.theme.ok = "btn btn-primary ";
alertify.defaults.theme.cancel = "btn btn-danger ";

$('body').on('click', '#js-button-take', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    // alert(id)
    alertify.confirm('Reminder', 'The time will start when you take the assessment. Take the assessment? ', function () {
        redirectAssessment(id);
    }, function () {});
});

$('body').on('click', '#js-button-view', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    // alert(id)
    redirectAssessment(id);
});

function redirectAssessment(id) {
    $.ajax({
        url: "/student/assessment/subject/" + id + "/take-assessment",
        type: 'POST',
        data: { _token: $('input[name=_token]').val(), id: id },
        success: function success(res) {
            if (res.res_code == 1) {
                show_toast_alert({
                    heading: 'Error',
                    message: res.res_msg,
                    type: 'error'
                });
            } else {
                var url = location.protocol + '//' + location.host + "/student/assessment/subject/" + id + "/redirect-assessment?tab=" + tab;
                // var url = "redirect-assessment?id="+id+"?tab="+tab;
                window.location.href = url;
            }
        }
    });
}

// assessment_questions        

// console.log(student_exam_id)
var page = 1;
function fetch_data() {

    var formData = new FormData($('#js-form_search')[0]);
    formData.append('page', page);
    loader_overlay();

    $.ajax({
        url: "student-assessment-subject-details",
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

var is_btn_click = false;

$('#studentExamBtn').click(function () {
    is_btn_click = true;
});

// $('#studentExamBtn').prop('disabled', true);
$('body').on('submit', '#js-studentExamForm', function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    if (is_btn_click === true) {
        saveAssessmentButton(formData);
    }

    if (is_btn_click === false) {
        saveData(formData);
    }
});
function saveAssessmentButton(formData) {

    alertify.confirm('Confirmation', 'Are you sure you want to submit it? It will not revert?', function () {
        saveData(formData);
    }, function () {});
}

var student_exam_id = $('#student_exam_id').val();
var time_assessment = $('#js_minutes').val();
if (time_assessment != 0) {
    if (student_exam_id) {
        examCountDown();
    }
}
// $('#studentExamBtn').attr('disabled' , true);
// localStorage.clear();
var timer2;
var remaining_min;
var remaining_sec;

function examCountDown() {

    var localMin = localStorage.getItem("endMin_" + student_exam_id + "");
    var localSec = localStorage.getItem("endSec_" + student_exam_id + "");

    try {
        remaining_min = localMin == undefined ? time_assessment : localMin;
        remaining_sec = localSec == undefined ? '00' : localSec;
    } catch (err) {
        console.log('error');
        remaining_min = time_assessment;
        remaining_sec = '00';
    }

    timer2 = remaining_min + ':' + remaining_sec;

    // var timer2 = time_assessment+':00';
    var interval = setInterval(function () {
        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);

        --seconds;
        minutes = seconds < 0 ? --minutes : minutes;

        seconds = seconds < 0 ? 59 : seconds;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        if (minutes < 0) {
            // localStorage.clear();
            reset();
            clearInterval(interval);
        } else {
            if (localMin == 0 && localSec == 0) {
                reset();
            }
            remaining_min = localStorage.setItem("endMin_" + student_exam_id + "", minutes);
            remaining_sec = localStorage.setItem("endSec_" + student_exam_id + "", seconds);
            $('.countdown').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
        }
        //minutes = (minutes < 10) ?  minutes : minutes;
        // console.log(minutes);
    }, 1000);
}

// reset()
function reset() {
    localStorage.removeItem("endMin_" + student_exam_id + "");
    localStorage.removeItem("endSec_" + student_exam_id + "");

    $('#assessmentTimesUp').modal({
        backdrop: 'static',
        keyboard: false
    });

    is_btn_click = false;
    $('#js-studentExamForm').submit();
}

function saveData(formData) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/student/assessment/subject/" + student_information_id + "/save-data",
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
                alertify.confirm('Assessment confirmation', '<div class="text-center"><h4>Assessment is successfully done</br>Your score is</h4><br/><h1>' + res.score + '/' + res.total_item + '</h1>' + '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#2ecc71"><path d="M32.25,37.625c-9.675,0 -17.46875,7.79375 -17.46875,17.46875v79.28125c0,2.28438 1.74687,4.03125 4.03125,4.03125c2.28438,0 4.03125,-1.74687 4.03125,-4.03125v-79.28125c0,-5.24063 4.16563,-9.40625 9.40625,-9.40625h107.5c5.24062,0 9.40625,4.16562 9.40625,9.40625v79.28125c0,2.28438 1.74687,4.03125 4.03125,4.03125c2.28438,0 4.03125,-1.74687 4.03125,-4.03125v-79.28125c0,-9.675 -7.79375,-17.46875 -17.46875,-17.46875zM85.53546,61.88336c-0.9548,0.01522 -1.92062,0.07926 -2.89484,0.19684c-12.3625,1.47812 -22.17187,11.5573 -23.51562,23.9198c-1.47812,16.39375 11.825,30.36875 28.21875,29.5625c13.30313,-0.67187 24.45678,-11.4224 25.3974,-24.72553c0.40312,-4.97187 -0.53803,-9.67343 -2.55365,-13.83905c-0.40313,-0.80625 -1.61145,-1.07657 -2.28333,-0.27032c-4.3,4.97187 -18.94897,21.36615 -18.94897,21.36615c-0.80625,0.80625 -1.8802,1.34375 -2.9552,1.34375h-0.13385c-1.20937,0 -2.28543,-0.53645 -3.09168,-1.61145l-9.2724,-11.9599c-1.20937,-1.47813 -1.20937,-3.76303 0,-5.24115c1.74687,-2.01562 4.70522,-1.88178 6.18335,0.13385l6.44843,8.33282c0,0 13.43907,-15.18542 17.0672,-19.21667c0.5375,-0.5375 0.40103,-1.47865 -0.13647,-1.88178c-4.70312,-3.88008 -10.84553,-6.21642 -17.52911,-6.10986zM5.375,145.125c-2.28438,0 -4.03125,1.74687 -4.03125,4.03125v4.03125c0,9.675 7.79375,17.46875 17.46875,17.46875h134.375c9.675,0 17.46875,-7.79375 17.46875,-17.46875v-4.03125c0,-2.28438 -1.74687,-4.03125 -4.03125,-4.03125h-47.03125c-2.28437,0 -4.03125,1.74687 -4.03125,4.03125c0,2.28438 1.74688,4.03125 4.03125,4.03125h43c0,5.24062 -4.16563,9.40625 -9.40625,9.40625h-134.375c-5.24062,0 -9.40625,-4.16563 -9.40625,-9.40625h43c2.28438,0 4.03125,-1.74687 4.03125,-4.03125c0,-2.28438 -1.74687,-4.03125 -4.03125,-4.03125zM72.5625,145.125c-2.28437,0 -4.03125,1.74687 -4.03125,4.03125c0,2.28438 1.74688,4.03125 4.03125,4.03125h26.875c2.28437,0 4.03125,-1.74687 4.03125,-4.03125c0,-2.28438 -1.74688,-4.03125 -4.03125,-4.03125z"></path></g></g></svg>' + '</div>', function () {
                    location.reload();
                }, function () {});
                // fetch_data();
            }
        }
    });
}

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/student_assessment.js");


/***/ })

/******/ });