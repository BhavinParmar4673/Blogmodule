/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

window.uploadImage = function() {
    return {
        defaultimg: "https://placehold.co/300x300/e2e8f0/e2e8f0",
        remove: false,
        preview: null,
        uploaded: null,
        updatePreview(el) {
            console.log(el);
            let reader,
                files = document.getElementById(el).files;

            if (files.length < 1) {
                return true;
            }
            reader = new FileReader();
            loaders.show();
            reader.onload = e => {
                this.preview = e.target.result;
                loaders.hide();
                this.remove = true;
            };
            reader.readAsDataURL(files[0]);
        },
        clearPreview(el) {
            document.getElementById(el).value = null;
            this.preview = this.uploaded ? this.uploaded : this.defaultimg;
            this.remove = false;
        },
        init(preview) {
            this.preview = preview ? preview : preview;
            this.uploaded = preview ? preview : preview;
        }
    };
};

import "admin-lte/plugins/datatables/jquery.dataTables.min.js";
import "admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js";
import "admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js";
import "admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js";
import "admin-lte/plugins/select2/js/select2.full.min.js";
import "admin-lte/plugins/jquery-validation/jquery.validate.min.js";
import "admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
