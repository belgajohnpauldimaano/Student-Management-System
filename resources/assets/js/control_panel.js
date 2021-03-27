window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');
    require('../../../public/cms-new/dist/js/adminlte.min.js');
    require('../../../public/cms-new/plugins/jquery/jquery.min.js');
    require('../../../public/cms-new/plugins/bootstrap/js/bootstrap.bundle.min.js');
    require('../../../public/cms-new/plugins/jquery-ui/jquery-ui.min.js');
    require('../../../public/cms-new/plugins/select2/js/select2.min.js');
    require('../../../public/cms-new/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js');
    require('../../../public/cms-new/plugins/fastclick/fastclick.js');
    require('../../../public/cms-new/plugins/sparklines/sparkline.js');
    require('../../../public/cms/plugins/jquery-toast-plugin/jquery.toast.min.js');
    require('../../../public/cms/plugins/timepicker/bootstrap-timepicker.min.js');
    require('../../../public/cms/plugins/datepicker/bootstrap-datepicker.js');
    require('./enrollment.js');

} catch (e) { }

