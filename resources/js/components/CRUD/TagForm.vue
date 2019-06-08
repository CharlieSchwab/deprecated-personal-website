<template>
    <div id='tag-form'>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">
                <b class='alt-bg padded'>Tag Name*</b>
            </label>

            <div class="col-md-6">
                <input v-model="tag.name" type="text" class="form-control" name="name" required autofocus>
            </div>
        </div>
        <div class='form-group row'>
            <label for='type' class='col-md-4 col-form-label text-md-right'>
                <b class='alt-bg padded'>Tag Type</b>
            </label>
            <div class='col-md-6'>
                <input v-model="tag.type" type="text" class="form-control" name="type"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="icon" class="col-md-4 col-form-label text-md-right">
                <b class='alt-bg padded'>Tag Icon</b>
            </label>
            <br>
            <file-upload-element ref="fileUploadElement" fileInputElementName="icon" maxPreviewSize="300"></file-upload-element>
        </div>
        <div class="form-group row no-margins">
            <label for="showOnHomepage" class='col-md-12 text-center alt-bg'>
                <input id="showOnHomepage" type="checkbox" v-model="tag.show_on_homepage">
                <span>Show this Tag on the Home page?</span>
            </label>
        </div>
    </div>

</template>

<script>
    var fileUploadElement = require('./FileUpload.vue').default;

    export default{
        components: {
            'file-upload-element': fileUploadElement
        },
        data() {
            return {
                tag: {
                    name: "",
                    type: "",
                    show_on_homepage: false,
                    icon: ""
                }
            }
        },
        components: {
            fileUploadElement
        },
        methods: {
            setFormData(data){
                this.tag.name = "test";

            },

            getFormData(){
                return this.getVueObject(this.tag);
            },

            getVueObject(data){
                return JSON.parse(JSON.stringify(data));
            }
        }
    }
</script>-