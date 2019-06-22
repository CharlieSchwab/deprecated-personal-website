<template>
    <div id='project-form'>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">
                <b>Project Name*</b>
            </label>

            <div class="col-md-6">
                <input v-model="project.name" type="text" class="form-control" name="name" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">
                <b>Project Description</b>
            </label>

            <div class="col-md-6">
                <input id="description" type="text" class="form-control" name="description">
            </div>
        </div>
    </div>
</template>

<script>
    var imageInput = require('./ImageUpload.vue').default;

    export default{
        data(){
            return {
                project: {
                    id: "",
                    name: "",
                    //TODO...
                }
            }
        },

        mounted: function(){
            this.$parent.onSubFormMounted();
        },

        components:{
            'image-input': imageInput
        },

        methods: {
            getVueObject(data){
                return JSON.parse(JSON.stringify(data));
            },

            //send back an errorList, if errorList is empty, THEN FORM is considered valid
            validateFormData(){
                var errorList = [];
                if(this.project.name == "") {
                    errorList.push( {error: "Name is a required field"} );
                }
                return errorList;
            },

            getFormData(){
                return 'test';
            },

            setFormData(data){
                this.project = data;
            }

        }
    }
</script>