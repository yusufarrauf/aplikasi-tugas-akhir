require("./bootstrap");
import VueAxios from "vue-axios";
import Swal from "sweetalert2";
import moment from "moment";
import Datepicker from "vuejs-datepicker";
import { total, pageTotal } from "datatables";
window.Swal = Swal;
window.total = total;
window.pageTotal = pageTotal;
window.Datepicker = Datepicker;

// Pop-Up Notifikasi
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});
window.Toast = Toast;
// End Pop-Up Notifikasi

window.Vue = require("vue");
import { Form, HasError, AlertError, AlertErrors, AlertSuccess } from "vform";
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);
import VueRouter from "vue-router";
Vue.use(VueRouter, VueAxios);
import VueProgressBar from "vue-progressbar";
Vue.use(VueProgressBar, {
    color: "rgb(143, 255, 199",
    failedColor: "red",
    height: "3px"
});
window.Fire = new Vue();

window.documentTitle = document.title.split("-")[0] + " - ";
let routes = [
    {
        path: "/dashboard",
        component: require("./components/Dashboard.vue").default
    },
    {
        path: "/data-krani",
        component: require("./components/Data Krani.vue").default
    },
    {
        path: "/data-kendaraan",
        component: require("./components/Data Kendaraan.vue").default
    },
    {
        path: "/data-supir",
        component: require("./components/Data Supir.vue").default
    },
    {
        path: "/bongkar-muat",
        component: require("./components/Input Bongkar Muat.vue").default
    },
    {
        path: "/laporan-bongkar-muat",
        component: require("./components/Laporan Bongkar Muat.vue").default
    },
    {
        path: "/data-bongkar-muat",
        component: require("./components/Data Bongkar Muat.vue").default
    }
];
const router = new VueRouter({
    mode: "history",
    routes
});
Vue.filter("currency", function(value) {
    let rp = (value / 1).toFixed(0).replace(".", ",");
    return rp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});
Vue.filter("uppercase", function(value) {
    return value[0].toUpperCase() + value.slice(1);
});
Vue.filter("dateReformat", function(value) {
    var month = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
    ];
    var datevalue = new Date(value);
    var newdate = datevalue.getDate();
    var newmonth = datevalue.getMonth();
    var newyear = datevalue.getFullYear();
    return newdate + " " + month[newmonth] + " " + newyear;
});
Vue.filter("dateClock", function(value) {
    var datevalue = new Date(value);
    var newHour = datevalue.getHours();
    var newMinutes = datevalue.getMinutes();
    return  newHour + ":" + newMinutes;
});
const app = new Vue({
    el: "#app",
    router
});
// Script
