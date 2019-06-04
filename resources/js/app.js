

require('./bootstrap');

require('particles.js');

require('imagesloaded')
/**
 * load vue with a navbar and other components
 */
window.Vue = require('vue');

const HOMEPAGE = "/";
const DASHBOARD = "/dashboard";
const ALLPROJECTS = "/allprojects";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


window.onload = function () {
    var currentPage = window.location.pathname;
    var app;

    //initialize vue app with specific components, based on the current page
    if (currentPage == HOMEPAGE) {

        var heroUnit = require('./components/HomePage/HeroUnit.vue').default;
        var portfolioUnit = require('./components/HomePage/PortfolioUnit.vue').default;
        var skillsRow = require('./components/HomePage/SkillsRow.vue').default;

        app = new Vue({
            el: '#app',
            components: {
                'hero-unit': heroUnit,
                'portfolio-unit': portfolioUnit,
                'skills-row': skillsRow
            },
            data: {
                imagesDoneLoading: false
            }
        });
    }
    else if (currentPage == DASHBOARD) {

        var CRUDPanel = require('./components/CRUD/CRUDPanel.vue').default;
        var tagForm = require('./components/CRUD/TagForm.vue').default;
        var projectForm = require('./components/CRUD/ProjectForm.vue').default;

        app = new Vue({
            el: '#app',
            components: {
                'tag-form': tagForm,
                'project-form': projectForm,
                'crud-panel': CRUDPanel
            }
        });
    }
    else if (currentPage == ALLPROJECTS) {
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