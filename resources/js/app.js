//AXIOSS
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window._ = require('lodash');


//sweetalert2 && toast
import Swal from 'sweetalert2';
window.Swal = Swal;


// DataTables
require('datatables.net-bs4');
require('datatables.net-buttons-bs4');

//theme
require('../theme/js/app');

// Import the plugins

