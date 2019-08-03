<template>
    <div id="CRUDPanel">
        <!-- CRUD Modal, where form data is entered and submitted -->
        <div id="CRUDModal" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form :id="formID" enctype="multipart/form-data">
                        <div class="modal-header alt-bg">
                            <h4 class="modal-title">
                                <b>{{ modalTitle }}</b>
                            </h4>
                            <button
                                v-on:click="closeCRUDModal()"
                                type="button" class="close">
                                <i class="fa fa-times-circle"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- warning prompt, for delete operations -->
                            <transition name="shake">
                                <div v-if = "isDeleteOperation" class='alert alert-warning no-margins mx-auto'>
                                    <b>Warning: Are you sure you want to delete this item?</b>
                                </div>
                            </transition>

                            <!-- error panel, if any errors exist -->
                            <transition name="shake">
                                <div 
                                    v-if="errorList.length > 0"
                                    class="alert alert-danger no-margins mx-auto">
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

                            <!-- form content, cased in sub-component that is dynamically loaded -->
                            <component
                                v-bind:is="currentModalForm"
                                ref="CRUDForm"
                            ></component>

                            <!--spinner-->
                            <div id="spinner-container">
                                <br />
                                <div id="loading" class="d-block mx-auto"></div>
                            </div>
                        </div>
                        <div class="modal-footer alt-bg">
                            <a
                                v-on:click="submitCRUDOperation()"
                                class="btn btn-lg main-btn pointer">
                                {{ modalSubmitBtnText }}
                            </a>
                            <button
                                v-on:click="closeCRUDModal()"
                                type="button" class="btn btn-outline-dark btn-lg">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--notification bar-->
        <transition name="fade">
            <div
                v-if="notificationMessage != ''"
                id="notificationMessage"
                class="alert no-margins"
                :class='{ "alert-danger": notificationType == "error", "alert-success": notificationType == "success"}'
            >
                <p class="text-center no-margins">
                    {{ notificationMessage }}
                    <i class='fa fa-times-circle fa-2x pointer float-right' @click="this.resetNotification"></i>
                </p>
            </div>
        </transition>
        <!-- CRUD Panel Page, shows data and contains trigger buttons -->
        <br />
        <div class="row no-margins">
            <div class="col-md-10 mx-auto">
                <div class="card rounded-edges padded">
                    <div class="card-body">
                        <h1 class="card-title">
                            Admin Dashboard
                            <div class="float-right">
                                <button
                                    @click="showCreateTagModal()"
                                    type="button" class="btn btn-lg btn-space main-btn" ><b>
                                        <i class="fa fa-plus-circle"></i> Create New Tag</b>
                                </button>
                                <button
                                    @click="showCreateProjectModal()"
                                    type="button" class="btn btn-lg btn-space main-btn">
                                    <b><i class="fa fa-plus-circle"></i> Create New Project</b>
                                </button>
                            </div>
                        </h1>
                        <hr />
                        <div class="row">
                            <div class="col">
                                <div class="card rounded-edges alt-bg">
                                    <div class="card-body">
                                        <h3 class="card-title">Tags</h3>
                                        <div class='scrollbar grey-scrollbar'>
                                            <div class='scrollbar-content'>
                                                <transition-group name="list">
                                                    <div class='card rounded-edges spaced' v-for="tag in tagData" v-bind:key="tag.id">
                                                        <div class='card-body'>
                                                        <div class='d-flex'>
                                                            <div>
                                                            <img class='small-logo' v-bind:src = tag.icon_filepath />
                                                            </div>
                                                            <div class='spaced'><b>{{tag.name}}</b></div>
                                                            <div class='spaced mx-auto'><div class='text-center badge badge-pill alt-bg'>{{tag.type}}</div></div>
                                                            <div class='ml-auto'>
                                                            <button class='btn btn-light grey-outline'  @click="updateTag(tag)"> Update</button>
                                                            <button class='btn btn-outline-danger' @click="deleteTag(tag)">Delete</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </transition-group>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card alt-bg">
                                  <div class='card-body'>
                                    <h3 class='card-title'>Projects</h3>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    #spinner-container {
        display: none;
    }
</style>

<script>
    import Vue from 'vue';
    //load URL endpoints from JSON
    import CRUDEndpoints from "../json/CRUDEndpoints.json";



    //constant strings
    const CRUD_MODAL_ID = "#CRUDModal",
        PROJECT_FORM = "project-form",
        TAG_FORM = "tag-form";

    var projectForm = require("./ProjectForm").default;
    var tagForm = require("./TagForm.vue").default;


    export default {
        //register sub-components
        components: {
            "tag-form": tagForm,
            "project-form": projectForm
        },


        data() {
            return {
                //cosmetic variables for the form's container
                modalTitle: "",
                formID: "",
                modalSubmitBtnID: "",
                modalSubmitBtnText: "",

                //display contoller, shows different Vue components based on type of form to display
                currentModalForm: "",
                targetURL: "",
                isDeleteOperation: false,
                
                notificationType: "",
                notificationMessage: "",
                errorList: [],

                //if update or delete operation, this will hold the object selected for the operation
                selectedDataObject: "",
                
                tagData: [],
                projectData: [],
            };
        },

        //retreive data
        beforeMount(){
          axios.get(CRUDEndpoints.tag.FETCH_URL).then(this.setTagData);
        },



        methods: {
            getVueObject(data){
              return JSON.parse(JSON.stringify(data));
            },


            setTagData(response){
              this.tagData = response.data.tags;
            },

            //this function will be called from the sub-component when its specific form is mounted (dyanamically created Vue object)
            onSubFormMounted() {
                //if a data object is currently selected, prefill the form with the object's corresponding data
                if (this.selectedDataObject != "") {
                    this.$refs.CRUDForm.setFormData(this.selectedDataObject);
                }
                //IMPORTANT: the modal will only be shown after the dynamic vue object has been mounted
                $(CRUD_MODAL_ID).modal();
                //if the form loaded is a delete operation, disable all inputs, including the subcomponent for image upload
                if(this.isDeleteOperation){
                    $('#' + this.formID + " input").prop('disabled', true);
                    $('#imageUpload').css('pointer-events', 'none');
                }
            },


            setCRUDModalText( modalTitle, formID, modalSubmitBtnID, modalSubmitBtnText) {
                this.modalTitle = modalTitle;
                this.formID = formID;
                this.modalSubmitBtnID = modalSubmitBtnID;
                this.modalSubmitBtnText = modalSubmitBtnText;
            },           


            //set text for modal, load the specific form subcomponent and set up targetURL
            showCreateProjectModal() {
                this.setCRUDModalText( "Create New Project", "createProjectForm", "createProjectBtn", "Create Project");
                this.selectedDataObject = "";
                this.targetURL = CRUDEndpoints.project.CREATE_URL;
                this.currentModalForm = PROJECT_FORM; //loads specific subcomponent and dynamically mounts it to DOM
                //on subform being loaded, the modal will be shown...
            },

            showCreateTagModal() {
                this.setCRUDModalText(
                    "Create New Tag",
                    "createTagForm",
                    "createTagBtn",
                    "Create Tag"
                );
                this.selectedDataObject = "";
                this.targetURL = CRUDEndpoints.tag.CREATE_URL;
                this.currentModalForm = TAG_FORM;//load "tag-form" vue sub-component, modal will show when vue sub-component is loaded
            },

            //TODO
            updateProject(project){

            },

            showUpdateProjectModal() {
                this.setCRUDModalText( "Update a Project", "updateProjectForm", "updateProjectBtn", "Update Project");
                this.targetURL = CRUDEndpoints.project.UPDATE_URL;
                this.currentModalForm = PROJECT_FORM;
            },

            updateTag(tag){
              this.selectedDataObject = this.getVueObject(tag);//set data before showing modal
              this.targetURL = CRUDEndpoints.tag.UPDATE_URL;
              this.showUpdateTagModal();
            },

            showUpdateTagModal() {
                this.setCRUDModalText(
                    "Update Tag",
                    "updateTagForm",
                    "updateTagBtn",
                    "Update Tag"
                );

                this.currentModalForm = TAG_FORM;//trigger loading of modal last after setting all data
            },

            deleteTag(tag){
                this.selectedDataObject = this.getVueObject(tag);
                this.targetURL = CRUDEndpoints.tag.DELETE_URL;
                this.isDeleteOperation = true;
                this.showDeleteTagModal();
            },

            showDeleteTagModal(){
                this.setCRUDModalText(
                    "Delete Tag",
                    "deleteTagForm",
                    "deleteTagBtn",
                    "Delete Tag"
                );
                this.currentModalForm = TAG_FORM;
            },

            //close CRUD modal, reset all viewModel data to default values
            closeCRUDModal() {
                $(CRUD_MODAL_ID).modal("toggle");

                this.setCRUDModalText("", "", "", ""); //reset form modal text
                this.errorList = []; //reset error list
                this.isDeleteOperation = false;
                this.selectedDataObject = ""; //reset selected data object
                this.currentModalForm = ""; //remove sub-component
            },

            // submit the current form (whichever type of form, Create, Update, or Delete)
            submitCRUDOperation() {
                this.errorList = []; //reset error(s)

                //load specific subform with $refs property
                var form = this.$refs.CRUDForm;
                //validate form, if errors exist, exit the function with logs
                var errorsInForm = form.validateFormData();
                if (errorsInForm.length > 0) {
                    this.errorList = errorsInForm;
                    return;
                }
                //load form contents into request body object
                var formData = form.getFormData();
                formData.append("_token", Laravel.csrfToken); //add csrf token

                //have to use XMLHttpRequest to send file(s) via AJAX
                var request = new XMLHttpRequest();
                //define event handlers for when request is submitted
                request.addEventListener(
                    "load",
                    this.CRUDOperationResponseReceived
                );
                request.addEventListener("error", this.CRUDOperationError);

                //send request to targetURL
                request.open("POST", this.targetURL, true);
                request.send(formData);

                $("#spinner-container").show();
            },

            //handler for when a response is received
            CRUDOperationResponseReceived(event) {
                $("#spinner-container").hide();
                var response = event.target;

                if (response.status != 200) {
                    this.errorList = [
                        { error: "Server Error: " + response.status + ": " + response.statusText }
                    ];
                    return;
                }
                //only accept JSON responses
                try {
                    var responseData = JSON.parse(response.response);
                } catch (err) {
                    this.errorList = [{ error: "Invalid Response Type" }];
                    return;
                }

                //if success, refresh data, then close modal and show notification
                if (responseData.success) {
                    axios.get(CRUDEndpoints.tag.FETCH_URL).then(this.setTagData);
                    this.closeCRUDModal();
                    this.showNotification("success", responseData.message);
                } else {
                    this.errorList = [{ error: responseData.message }];
                }
            },

            //handler for when no response is received
            CRUDOperationError(event) {
                $("#spinner-container").hide();
                this.errorList = [
                    {
                        error:
                            "Could not send request to server. (Might be down)"
                    }
                ];
            },

            //show notification right under navbar
            showNotification(type, message){
                window.scrollTo(0, 0);
                this.notificationType = type;
                this.notificationMessage = message;
                //hide notification after some time
                setTimeout(this.resetNotification, 5000);
            },

            resetNotification() {
                this.notificationMessage = "";
            }
        }
    };
</script>
