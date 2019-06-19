<template>

  <div id="CRUDPanel">

    <!-- CRUD Modal -->
    <div id="CRUDModal" class="modal fade" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <form :id="formID" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header alt-bg">
              <h4 class="modal-title">
                <b>{{ modalTitle }}</b>
              </h4>
              <!-- close modal button -->
              <button v-on:click="closeCRUDModal()" type="button" class="close"><i
                  class='fa fa-times-circle'></i></button>
            </div>

            <!-- Modal body-->
            <div class="modal-body">

                            <!-- error panel, if any errors exist -->
              <transition name="shake">
                <div v-if="errorList.length > 0" class="alert alert-danger no-margins mx-auto">
                  <p class='no-margins'><b>There was a Problem with sending your request:</b></p>
                  <ul class='no-margins'>
                    <li v-for="error in errorList">
                      {{ error.error }}
                    </li>
                  </ul>
                </div>
              </transition>
              <br>
              <!-- form content, cased in sub-components -->
              <component v-bind:is="currentModalForm" ref="CRUDForm"></component>

              <!--spinner-->
              <div id="spinner-container">
                <br>
                <div id="loading" class=" d-block mx-auto"></div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer alt-bg">
              <a v-on:click="submitCRUDOperation()" class="btn btn-lg main-btn pointer">{{ modalSubmitBtnText }}</a>
              <button v-on:click="closeCRUDModal()" type="button" class="btn btn-outline-dark btn-lg">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- CRUD Panel Page -->

    <!--notification bar-->
    <transition name="fade">
      <div v-if="notificationMessage != ''" id="notificationMessage" class="alert alert-success no-margins">
        <p class='text-center no-margins'>{{ notificationMessage }}</p>
      </div>
    </transition>

    <br><br>
    <div class='d-flex flex-md-row flex-column justify-content-center'>
      <div class='card col-md-5 spaced shadow'>
        <div class='card-body'>
          <h2 class='text-center'>Projects</h2>
          <hr>
          <button v-on:click="showCreateProjectModal()" type="button" class="btn btn-lg main-btn float-right">
            <b><i class='fa fa-plus-circle'></i> Create New Project</b>
          </button>
        </div>
      </div>
      <div class='card col-md-5 spaced shadow'>
        <div class='card-body'>
          <h2 class='text-center'>Tags</h2>
          <hr>
          <button v-on:click="showUpdateTagModal()" type="button" class="btn btn-lg main-btn float-right">
            <b><i class='fa fa-plus-circle'></i> Create New Tag</b>
          </button>
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
  const CRUD_MODAL_ID = "#CRUDModal", PROJECT_FORM = "project-form", TAG_FORM = "tag-form";

  var projectForm = require('./ProjectForm').default;
  var tagForm = require('./TagForm.vue').default;

  export default {
    components: {
      'tag-form': tagForm,
      'project-form': projectForm,
    },

    data() {
      return {
        modalTitle: "",
        formID: "",
        modalSubmitBtnID: "",
        modalSubmitBtnText: "",
        //display contoller, shows different Vue components based on type of form to display
        currentModalForm: "",

        notificationMessageBackgroundColor: "",
        notificationMessage: "",
        errorList: []
      }
    },

    methods: {
      setCRUDModalText(modalTitle, formID, modalSubmitBtnID, modalSubmitBtnText) {
        this.modalTitle = modalTitle;
        this.formID = formID;
        this.modalSubmitBtnID = modalSubmitBtnID;
        this.modalSubmitBtnText = modalSubmitBtnText;
      },

      showCreateProjectModal() {
        this.setCRUDModalText(
          "Create New Project",
          "createProjectForm",
          "createProjectBtn",
          "Create Project"
        );

        this.currentModalForm = PROJECT_FORM;
        $(CRUD_MODAL_ID).modal();
      },

      showUpdateProjectModal() {
        this.setCRUDModalText(
          "Update a Project",
          "updateProjectForm",
          "updateProjectBtn",
          "Update Project"
        );
      },

      showCreateTagModal() {
        this.setCRUDModalText(
          "Create New Tag",
          "createTagForm",
          "createTagBtn",
          "Create Tag"
        );

        this.currentModalForm = TAG_FORM;
        $(CRUD_MODAL_ID).modal();
      },

      showUpdateTagModal(){
        this.setCRUDModalText(
          "Update Tag",
          "updateTagForm",
          "updateTagBtn",
          "Update Tag"
        );

        this.currentModalForm = TAG_FORM;
        //TODO: figure out a way to set form data in sub-component, even though it is just loaded after this line
        $(CRUD_MODAL_ID).modal();
      },

      resetNotification() {
        this.notificationMessage = "";
      },

      closeCRUDModal() {
        $(CRUD_MODAL_ID).modal('toggle');

        this.setCRUDModalText("", "", "", "");//reset form modal text
        this.errorList = []; //reset error list
        this.currentModalForm = ""; //remove sub-component
      },



      // submit the current form (whichever type of form, Create, Update, or Delete)
      submitCRUDOperation() {
        this.errorList = [];//reset error(s)
        //load specific form subcomponent, and its formData
        var form = this.$refs.CRUDForm;

        //validate form, if errors exist, show the errors and exit the function
        var errorsInForm = form.validateFormData();
        if (errorsInForm.length > 0) {
          this.errorList = errorsInForm;
          return;
        }

        //load form data into variable
        var formData = form.getFormData();
        formData.append("_token", Laravel.csrfToken);//add csrf token

        var request = new XMLHttpRequest();
        //define event handlers for when request is submitted
        request.addEventListener('load', this.CRUDOperationResponseReceived);
        request.addEventListener('error', this.CRUDOperationError);

        //send request to targetURL
        request.open('POST', form.getTargetURL(), true);
        request.send(formData);

        $('#spinner-container').show();
      },


      //handler for when a response is received
      CRUDOperationResponseReceived(event) {
        $('#spinner-container').hide();
        var response = event.target;

        //if response code is not 200 -> display error and exit function
        if (response.status != 200) {
          this.errorList = [{ error: response.status + ": " + response.statusText }];
          return;
        }
        //only accept JSON responses
        try{
          var responseData = JSON.parse(response.response)
        } catch(err){
          this.errorList = [{ error: "Invalid Response Type"}];
          return;
        }

        //if success, then close modal and show notification
        if (responseData.success) {
          this.closeCRUDModal();
          this.notificationMessageBackgroundColor = "success";
          this.notificationMessage = responseData.message;
          //hide notification after some time
          setTimeout(this.resetNotification, 5000);
        }
        else{
          this.errorList = [ {error: responseData.message} ];
        }
      },

      //handler for when no response is received
      CRUDOperationError(event) {
        $('#spinner-container').hide();
        this.errorList = [{ error: "Could not send request to server. (Might be down)" }];
      }
    }

  }
</script>