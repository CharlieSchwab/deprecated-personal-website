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
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style>

</style>

<script>

</script>