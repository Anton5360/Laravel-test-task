<template>
    <div class="container py-5">
        <slot name="success"></slot>
        <slot name="error"></slot>

        <div class="row">
            <div class="col">
                <h3><a :href="employeeListRoute">All employees list</a></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>Departments</h2>
            </div>
            <div class="col-3 mb-3" v-for="department in departments">
                <a :href="employeeListRoute + '/' + department.id">{{ department.title }}</a>
            </div>
        </div>
        <hr>
        <div class="row mb-5">
            <div class="col">
                <div class="form-group">
                    <label for="pagination">Employees per page</label>
                    <select class="form-control w-25" id="pagination"
                            @change="changeTableInfo(false)" v-model="copyOfEmployeesPerPage">
                        <option :value="quantity" v-for="quantity in paginationQuantities">{{ quantity }}</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="pages">Page</label>
                    <select class="form-control w-25" id="pages" @change="changeTableInfo" v-model="copyOfCurrentPage">
                        <option :value="quantity" v-for="quantity in pagesQuantity">{{ quantity }}</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <h4 class="mb-3">Upload XML</h4>
                <form class="d-flex" :action="uploadXmlRoute" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="file" ref="xml" name="xml">
                    <button class="btn btn-primary" type="submit">Upload</button>
                </form>
            </div>
        </div>
        <table class="table">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Department</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Middle name</th>
                <th scope="col">Birthdate</th>
                <th scope="col">Position</th>
                <th scope="col">Salary type</th>
                <th scope="col">Work hours</th>
                <th scope="col">Salary</th>
            </tr>
            <tr scope="row" v-for="employee in employees">
                <td>{{ employee.id }}</td>
                <td>{{ employee.department.title }}</td>
                <td>{{ employee.first_name }}</td>
                <td>{{ employee.last_name }}</td>
                <td>{{ employee.middle_name }}</td>
                <td>{{ employee.birthdate }}</td>
                <td>{{ employee.position }}</td>
                <td>{{ employee.salary_type }}</td>
                <td>{{ employee.work_hours }}</td>
                <td>{{ employee.salary }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            employees: {
                type: Array,
                required: true
            },
            employeesPerPage: {
                type: Number,
                required: true
            },
            pagesQuantity: {
                type: Number,
                required: true
            },
            currentPage: {
                type: Number,
                required: true
            },
            uploadXmlRoute: {
                type: String,
                required: true
            },
            departments: {
                type: Object,
                required: true
            },
            employeeListRoute: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                copyOfEmployeesPerPage: null,
                copyOfCurrentPage: null,
                paginationQuantities: [10, 25, 50, 100],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        mounted() {
            this.copyOfEmployeesPerPage = this.employeesPerPage;
            this.copyOfCurrentPage = this.currentPage;
        },
        methods: {
            changeTableInfo(isNeededCurrentPage = true) {
                let neededPage = isNeededCurrentPage ? this.copyOfCurrentPage : 1;

                window.location.href = this.getUrlFullUrlWithoutParams() + '?quantity=' + this.copyOfEmployeesPerPage + '&page=' + neededPage;
            },
            getUrlFullUrlWithoutParams() {
                return window.location.href.split('?')[0];
            },
        }
    }
</script>


