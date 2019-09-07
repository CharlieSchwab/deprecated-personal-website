

require('./bootstrap');

require('particles.js');

require('imagesloaded')
/**
 * load vue with a navbar and other components
 */
window.Vue = require('vue');

const HOMEPAGE = "/";
const DASHBOARD = "/dashboard";
const DEMOVIDEO = "/how-it-works";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.onload = function () {
    var currentPage = window.location.pathname;
    var app;
    var pathToComponent;

    //DID NOT WANT TO USE VUE ROUTER, so settled for simple if-stmts to load specific components for specific pages
    if (currentPage == HOMEPAGE) {
        pathToComponent = './components/HomePage/';

        app = new Vue({
            el: '#app',
            components: {
                'hero-unit': () => import(pathToComponent + 'HeroUnit.vue'),
                'portfolio-unit': () => import(pathToComponent + 'PortfolioUnit.vue'),
                'skills-row': () => import(pathToComponent + 'SkillsRow.vue')
            },
            data: {
                imagesDoneLoading: false
            }
        });
    }
    else if (currentPage == DASHBOARD) {
        pathToComponent = './components/CRUD/';

        app = new Vue({
            el: '#app',
            components: {
                'crud-view': () => import(pathToComponent + 'CRUDView.vue')
            }
        });
    }
    else if (currentPage == DEMOVIDEO) {
        //TODO
    }
    else {

    }
}



$(document).ready(function () {
    //when images are loaded, set vue observable accordingly
    $('#app').imagesLoaded(function () {
        app.imagesDoneLoading = true;

        //after loading, init all bootstrap tooltips
        setTimeout(function () {
            $('[data-toggle="tooltip"]').tooltip();
        }, 300);
    });





});