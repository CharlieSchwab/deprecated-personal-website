@component('layouts.CRUDpanel')
    @slot('modalId')
      createProjectModal
    @endslot

    @slot('formID')
      createProjectForm
    @endslot

    @slot('CRUDendpoint')
      /createProject
    @endslot

    @slot('modalTitle')
      Create New Project
    @endslot

    @slot('modalSubmitBtnText')
      Create Project
    @endslot

    @slot('modalSubmitBtnID')
      createProjectBtn
    @endslot

    <!-- form content -->    
    <project-form></project-form>
@endcomponent