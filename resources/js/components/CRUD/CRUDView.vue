<!-- the admin dashboard view, can list all data here and trigger operations from CRUDController -->
<template>
    <div id='CRUD-View'>
        <CRUD-modal :modalTitle='currentOperation' :modalSubmitBtnText='currentOperation' 
                    :isDeleteOperation='deleteCRUDObject' :currentModalForm='subFormType' 
                    :selectedDataObject='selectedDO' :targetURL='CRUDEndpoint'>
        </CRUD-modal>
        <button @click='showCRUDModal()'></button>

    </div>
</template>

<script>
    import CRUDEndpoints from "../json/CRUDEndpoints.json";

    const   PROJECT_FORM = "project-form",
            TAG_FORM = "tag-form",
            CRUD_MODAL='CRUD-modal';

    var CRUDModal = require("./CRUDModal").default;

    export default {
        components: {
            CRUD_MODAL: CRUDModal
        },

        data() {
            return {
                currentOperation: "",
                deleteCRUDObject: false,
                subFormType: "",
                selectedDO: {},
                CRUDEndpoint: ""
            };
        },

        methods: {
            showCRUDModal(){
                this.subFormType=TAG_FORM;
            }
        }
    }

</script>