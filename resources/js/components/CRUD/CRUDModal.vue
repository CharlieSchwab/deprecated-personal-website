<!-- CRUD Operations Controller, a pop-up modal that can dynamically display and submit varying forms -->
<template>
    <div id="CRUDModal" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form enctype="multipart/form-data">
                    <div class="modal-header alt-bg">
                        <h4 class="modal-title">
                            <b>{{ modalTitle }}</b>
                        </h4>
                        <button @click="closeCRUDModal()" type='button' class='close'>
                            <i class='fa fa-times-circle'></i>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <!-- warning prompt for delete operation -->
                        <tansition name="shake">
                            <div v-if= "isDeleteOperation" class='alert alert-warning no-margins mx-auto'>
                                <b>Warning: Are you sure you want to delete this item</b>
                            </div>
                        </tansition>
                        <!-- error panel, if any errors exist -->
                        <transition name="shake">
                            <div v-if="errorList.length > 0" class="alert alert-danger no-margins mx-auto">
                                <p class="no-margins">
                                    <b>There was a Problem with sending your request:</b>
                                </p>
                                <ul class="no-margins">
                                    <li v-for="error in errorList">
                                        {{ error.error }}
                                    </li>
                                </ul>
                            </div>
                        </transition>
                        <br />
                        <!-- form content, dyanamic subcomponent, pass in data, if it exists-->
                        <component v-bind:is="currentModalForm" :dataObject ="selectedDataObject"/>

                        <!--spinner-->
                        <div id="spinner-container">
                            <br />
                            <div id="loading" class="d-block mx-auto"></div>
                        </div>                    
                    </div>
                    <div class="modal-footer alt-bg">
                        <a @click="submitCRUDOperation()" class="btn btn-lg main-btn pointer">{{ modalSubmitBtnText }}</a>
                        <button @click="closeCRUDModal()" type="button" class="btn btn-outline-dark btn-lg">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
    #spinner-container{
        display: none;
    }
</style>

<script>
    const   PROJECT_FORM = "project-form",
            TAG_FORM = "tag-form";

    var projectForm = require("./ProjectForm.vue").default;
    var tagForm = require("./TagForm.vue").default;

    export default {
        components: {
            TAG_FORM: tagForm,
            PROJECT_FORM: projectForm
        },

        props: {
            modalTitle: String,
            modalSubmitBtnText: String,
            isDeleteOperation: Boolean,
            currentModalForm: String,
            selectedDataObject: Object,
            targetURL: String
        },

        data() {
            return {
                errorList: []
            };
        },

        methods: {
            closeCRUDModal(){
                this.$emit('closeCRUDModal');
            },

            submitCRUDOperation() {
                this.errorList = [];//reset error(s)


            }
        }
    }
    
</script>