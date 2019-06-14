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
        <image-input ref="imageInput" imageInputLabelText='Tag Icon' imageInputElementName='icon' maxPreviewSize='400'></image-input>
        <div class="form-group row no-margins">
            <label for="showOnHomepage" class='col-md-12 text-center alt-bg'>
                <input id="showOnHomepage" type="checkbox" v-model="tag.show_on_homepage">
                <span>Show this Tag on the Home page?</span>
            </label>
        </div>
    </div>

</template>

<script>
    var imageInput = require('./ImageUpload.vue').default;

    export default{
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
            'image-input': imageInput
        },
        methods: {
            //will be used when loading existing data into form before updating
            setFormData(data){
                this.tag.name = "test";
                this.tag.type = "";
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