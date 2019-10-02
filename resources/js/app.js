
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from "vue-router";
import { Form, HasError, AlertError } from "vform";
import moment from "moment";
import VueProgressBar from "vue-progressbar";
import swal from "sweetalert";
import Gate from "./gate";
import VueTimepicker from "vue2-timepicker";
import VueDatepicker from "vue2-datepicker";
import "vue2-timepicker/dist/VueTimepicker.css";
window.VueTimepicker = VueTimepicker;
window.VueDatepicker = VueDatepicker;

import jsPDF from "jspdf";

window.Form = Form;
// window.jsPDF = jsPDF;

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
window.moment = moment;

Vue.prototype.$gate = new Gate(window.user);

Vue.use(VueRouter);

let routes = [
    { path: "/dashboard", component: require('./components/Dashboard.vue').default },
    { path: "/payment", component: require('./components/PaymentComponent.vue').default },
    { path: "/booking", component: require('./components/BookingComponent.vue').default },
    { path: "/complaints", component: require('./components/ComplaintsAdminViewComponent.vue').default },
    { path: "/settings", component: require('./components/SettingsComponent.vue').default },
    { path: "/feedback", component: require('./components/FeedbackComponent.vue').default },
    { path: "/regular", component: require('./components/RegularMembers.vue').default },
    { path: "/attendance", component: require('./components/AttendanceComponent.vue').default },
    { path: "/users", component: require('./components/Users.vue').default },
    { path: "/profile", component: require('./components/Profile.vue').default },
    { path: "/products", component: require('./components/products/Products.vue').default },
    { path: "*", component: require('./components/404.vue').default },
];

const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});

// Progressbar

Vue.use(VueProgressBar, {
    color: "rgb(143, 255, 199)",
    failedColor: "red",
    height: "2px"
});

// Sweet Alert

window.swal = swal;

// const Toast = Swal.mixin({
//     toast: true,
//     position: "top-end",
//     showConfirmButton: false,
//     timer: 3000
// });

// window.Toast = Toast;

// Global Filters

Vue.filter('capitalize', (value) => {
    if (!value) return "";
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});

Vue.filter('formattedDate', (date) => {
    return moment(date).format("MMMM Do YYYY");
});

Vue.filter('formattedDate2', (date) => {
    return moment(date).format("MMM Do YYYY");
});


// Custom Events

window.Fire = new Vue();


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component(
    "passport-clients",
    require("./components/passport/Clients.vue").default
);

Vue.component(
    "passport-authorized-clients",
    require("./components/passport/AuthorizedClients.vue").default
);

Vue.component(
    "passport-personal-access-tokens",
    require("./components/passport/PersonalAccessTokens.vue").default
);

Vue.component("page-not-found", require("./components/404.vue").default);
Vue.component("pagination", require("laravel-vue-pagination"));

Vue.component("parking-grid", require("./components/ParkingGrid.vue").default);
Vue.component("customer-complaint", require("./components/ComplaintComponent.vue").default);
Vue.component("parking-grid-admin", require("./components/ParkingGridAdminComponent.vue").default);


const app = new Vue({
    el: "#app",
    router,
    data: {
        search: ""
    },
    methods: {
        searchthis: _.debounce(() => {
            Fire.$emit("searching");
        }, 1000)
    },
}).$mount("#app");


$(".stars li").on("click", function() {
    var el = $(this);
    $("#ratingval").val(el.attr("title"));
    el.addClass("active")
        .siblings()
        .removeClass("active");
    $("#rating").val(el.attr("title")); // save value
});
