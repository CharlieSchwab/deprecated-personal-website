

require('./bootstrap');

require('particles.js');

require('imagesloaded')
/**
 * load vue with a navbar and other components
 */
window.Vue = require('vue');

Vue.component('hero-unit', require('./components/HeroUnit.vue').default);
Vue.component('portfolio-unit', require('./components/PortfolioUnit.vue').default);
Vue.component('skills-row', require('./components/SkillsRow.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 window.onload = function(){
    const app = new Vue({
        el: '#app',
    
        data: {
            imagesDoneLoading: false
        }
    });
 }



$(document).ready(function(){
    //when images are loaded, set vue observable accordingly
    $('#app').imagesLoaded(function(){
        app.imagesDoneLoading = true;

        //after loading, init all bootstrap tooltips
        setTimeout(function(){
            $('[data-toggle="tooltip"]').tooltip();
        }, 300);
    });




});