@component('layouts.CRUDpanel')
    @slot('modalId')
        createTagModal
    @endslot

    @slot('formID')
        createTagForm
    @endslot

    @slot('CRUDendpoint')
        /createTag
    @endslot

    @slot('modalTitle')
        Create New Tag
    @endslot

    @slot('modalSubmitBtnText')
        Create Tag
    @endslot

    @slot('modalSubmitBtnID')
        createTagBtn
    @endslot

    <!-- form content -->  
    <tag-form></tag-form>  
    
@endcomponent