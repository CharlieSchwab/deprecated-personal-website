<template>
    <div id='tag-form'>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">
                <b class='alert alt-bg'>Tag Name*</b>
            </label>

            <div class="col-md-6">
                <input v-model="tag.name" type="text" class="form-control" name="name" autofocus>
            </div>
        </div>
        <div class='form-group row'>
            <label for='type' class='col-md-4 col-form-label text-md-right'>
                <b class='alert alt-bg'>Tag Type</b>
            </label>
            <div class='col-md-6'>
                <input v-model="tag.type" type="text" class="form-control" name="type"/>
            </div>
        </div>
        
        <image-input ref="imageInput" imageInputLabelText='Upload Tag Icon' imageInputElementName='icon' maxPreviewSize='300'></image-input>
        <br>
        <div class="form-group row no-margins">
            <label for="showOnHomepage" class='text-center alert alt-bg mx-auto no-margins'>
                <input id="showOnHomepage" type="checkbox" v-model="tag.show_on_homepage">
                <span>Show this Tag on the Home page?</span>
            </label>
        </div>
    </div>

</template>

<script>
    var imageInput = require('./ImageUpload.vue').default;
    var targetRoute = "/createTag";


    export default{
        data() {
            return {
                tag: {
                    id: "",
                    name: "",
                    type: "",
                    icon_filepath: "",
                    show_on_homepage: false
                },

                targetURL: targetRoute
            }
        },
        components: {
            'image-input': imageInput
        },
        methods: {
            //convert a Vue observer to json data
            getVueObject(data){
                return JSON.parse(JSON.stringify(data));
            },

            //get the URL to POST this form to
            getTargetURL(){
                return this.targetURL;
            },

            //send back an errorList, if errorList is empty, THEN FORM is considered valid
            validateFormData(){
                var errorList = [];
                if(this.tag.name == "") {
                    errorList.push( {error: "Name is a required field"} );
                }
                return errorList;
            },


            //return a FormData object which contains all inputs for this form
            getFormData(){
                var formData = new FormData();//data to send
                
                var vueFormData = this.getVueObject(this.tag);//user-input
                
                //append user-input into formData, if given
                Object.keys(vueFormData).forEach(function(key){
                    if(vueFormData[key] != ""){
                        formData.append(key, vueFormData[key]);
                    } 
                });

                //add image to formdata using sub-component's functions, if any image was uploaded
                //NOTE: also could've used "formData.set(..)""
                var uploadedImage = this.$refs.imageInput;
                if(uploadedImage.getUploadedFile() != ""){
                    formData.append(uploadedImage.getImageInputElementName(), uploadedImage.getUploadedFile());
                }

                return formData;                      
            },


            //will be used when loading existing data into form for update operation
            setFormData(data){
                this.tag.name = "test";
                this.tag.type = "";
                //TODO...
            }

        }
    }
</script>-