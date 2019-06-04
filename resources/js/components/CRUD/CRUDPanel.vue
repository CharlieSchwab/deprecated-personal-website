<template>

  <div id="CRUDPanel">

    <!-- CRUD Modal -->
    <div class="modal fade" id="CRUDModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form :id="formID">
            <!-- Modal Header -->
            <div class="modal-header main-bg">
              <h4 class="modal-title white-text">
                <b>{{ modalTitle }}</b>
              </h4>
              <!-- close modal button -->
              <button v-on:click="closeCRUDModal()" type="button" class="close">&times;</button>
            </div>

            <!-- Modal body-->
            <div class="modal-body">

              <!-- form content, cased in sub-components -->
              <project-form v-if="showProjectForm"></project-form>
              <tag-form v-if="showTagForm"></tag-form>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer alt-bg">
              <a :id="modalSubmitBtnID" class="btn btn-secondary btn-lg white-text pointer">{{ modalSubmitBtnText }}</a>
              <button type="button" class="btn btn-outline-dark btn-lg" data-dismiss="modal">Close</button>
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
          <button v-on:click="showCreateProjectModal" type="button" class="btn secondary-bg white-text float-right">
            <b><i class='fa fa-plus-circle'></i> Create New Project</b>
          </button>
        </div>
      </div>
      <div class='card col-md-5 spaced shadow'>
        <div class='card-body'>
          <h2 class='text-center'>Tags</h2>
          <hr>
          <button v-on:click="showCreateTagModal" type="button" class="btn secondary-bg white-text float-right">
            <b><i class='fa fa-plus-circle'></i> Create New Tag</b>
          </button>
        </div>
      </div>
    </div>
  </div>


</template>

<script>
  import projectForm from './ProjectForm.vue';
  import tagForm from './TagForm.vue';

  export default {
    components: {
      'tag-form': tagForm,
      'project-form': projectForm,
    },

    data() {
      return {
        //text data for CRUD Modal
        CRUD_MODAL_ID: "#CRUDModal",
        modalTitle: "",
        formID: "",
        modalSubmitBtnID: "",
        modalSubmitBtnText: "",
        
        //simple display controllers to show/hide sub-components
        showProjectForm: false,
        showTagForm: false
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

        this.showProjectForm = true;
        $(this.CRUD_MODAL_ID).modal();
      },

      showCreateTagModal(){
        this.setCRUDModalText(
          "Create New Tag",
          "createTagForm",
          "createTagBtn",
          "Create Tag"
        );

        this.showTagForm = true;
        $(this.CRUD_MODAL_ID).modal();
      },

      closeCRUDModal(){
        $(this.CRUD_MODAL_ID).modal('toggle');

        this.setCRUDModalText("", "", "", "");
        this.showProjectForm = false;
        this.showTagForm = false;
      }
    }

  }
</script>