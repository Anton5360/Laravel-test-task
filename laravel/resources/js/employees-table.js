require('./bootstrap');

window.Vue = require('vue').default;

import EmployeesTable from './components/employees-page/EmployeesTable';
import Empty from './components/employees-page/includes/Empty';


const app = new Vue({
    el: '#app',
    components: {
        'employees-table': EmployeesTable,
        'empty': Empty,
    }
});
