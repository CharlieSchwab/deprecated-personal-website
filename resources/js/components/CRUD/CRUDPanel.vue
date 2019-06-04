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
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body-->
            <div class="modal-body">

              <!-- form content -->
              
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
  export default {
    data() {

      return {
        CRUD_MODAL_ID: "#CRUDModal",
        modalTitle: "",
        formID: "",
        formType: "",
        modalSubmitBtnID: "",
        modalSubmitBtnText: "",
      }
    },

    methods: {
      showCreateProjectModal(){
        this.modalTitle = "Create New Project";
        this.formID = "createProjectForm";
        this.formType = "projectForm";// will be used to load ProjectForm.vue
        this.modalSubmitBtnID = "createProjectBtn";
        this.modalSubmitBtnText = "Create Project";

        $(this.CRUD_MODAL_ID).modal();
      },

      showCreateTagModal(){
        this.modalTitle = "Create New Tag";
        this.formID = "createTagForm";
        this.formType = "tagForm";// will be used to load ProjectForm.vue
        this.modalSubmitBtnID = "createTagBtn";
        this.modalSubmitBtnText = "Create Tag";

        $(this.CRUD_MODAL_ID).modal();
      }
    }

  }
</script>