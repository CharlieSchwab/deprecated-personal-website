<template>

  <div id="CRUDPanel">

    <!-- CRUD Modal -->
    <div id="CRUDModal" class="modal fade" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <form :id="formID">
            <!-- Modal Header -->
            <div class="modal-header alt-bg">
              <h4 class="modal-title">
                <b>{{ modalTitle }}</b>
              </h4>
              <!-- close modal button -->
              <button v-on:click="closeCRUDModal()" type="button" class="close"><i class='fa fa-times-circle'></i></button>
            </div>

            <!-- Modal body-->
            <div class="modal-body">

              <!-- form content, cased in sub-components -->
              <component v-bind:is="currentModalForm" ref="CRUDForm"></component> 

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
          <button v-on:click="showCreateTagModal()" type="button" class="btn btn-lg main-btn float-right">
            <b><i class='fa fa-plus-circle'></i> Create New Tag</b>
          </button>
        </div>
      </div>
    </div>
  </div>


</template>

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
        currentModalForm: ""
      }
    },

    methods: {
      setCRUDModalText(modalTitle, formID, modalSubmitBtnID, modalSubmitBtnText){
        this.modalTitle = modalTitle;
        this.formID = formID;
        this.modalSubmitBtnID = modalSubmitBtnID;
        this.modalSubmitBtnText = modalSubmitBtnText;
      },

      showCreateProjectModal(){
        this.setCRUDModalText(
          "Create New Project",
          "createProjectForm",
          "createProjectBtn",
          "Create Project"
        );

        this.currentModalForm = PROJECT_FORM;
        $(CRUD_MODAL_ID).modal();
      },

      showUpdateProjectModal(){
        this.setCRUDModalText(
          "Update a Project",
          "updateProjectForm",
          "updateProjectBtn",
          "Update Project"
        );

        
      },

      showCreateTagModal(){
        this.setCRUDModalText(
          "Create New Tag",
          "createTagForm",
          "createTagBtn",
          "Create Tag"
        );

        this.currentModalForm = TAG_FORM;
        $(CRUD_MODAL_ID).modal();
      },



      submitCRUDOperation(){
        //grab form element ID, serialize its content and submit to whichever endpoint is set --> GO WITH THIS

        //LEAVE THIS ALONE
        // or retreive data from form component, and call UTIL function to submit a ajax request and return 
        // back with 200 or else (specific errors)
        var formData = this.$refs.CRUDForm;
        formData.setFormData('test');
      },

      closeCRUDModal(){
        $(CRUD_MODAL_ID).modal('toggle');

        this.setCRUDModalText("", "", "", "");
        this.currentModalForm = "";
      }
    }

  }
</script>