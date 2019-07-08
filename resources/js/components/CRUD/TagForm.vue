<template>
    <div id='tag-form'>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">
                <b class='alert alt-bg rounded-edges'>Tag Name*</b>
            </label>

            <div class="col-md-6">
                <input v-model="tag.name" type="text" class="form-control" name="name" autofocus>
            </div>
        </div>
        <div class='form-group row'>
            <label for='type' class='col-md-4 col-form-label text-md-right'>
                <b class='alert alt-bg rounded-edges'>Tag Type</b>
            </label>
            <div class='col-md-6'>
                <input v-model="tag.type" type="text" class="form-control" name="type"/>
            </div>
        </div>

        <div v-if="tag.icon_filepath == ''">
            <!-- show if Vue component for image input -->
            <image-input ref="imageInput" imageInputLabelText='Upload Tag Icon' imageInputElementName='icon' maxPreviewSize='300'></image-input>
            <br>
        </div>
        <div v-else>

        </div>
        <div class="form-group row no-margins">
            <label for="showOnHomepage" class='text-center alert alt-bg rounded-edges mx-auto no-margins'>
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
                    id: "",
                    name: "",
                    type: "",
                    icon_filepath: "",
                    show_on_homepage: false
                }
            }
        },

        mounted: function(){
            this.$parent.onSubFormMounted();//send signal to parent that this vue subcomponent has been loaded
        },

        components: {
            'image-input': imageInput
        },
        methods: {
            //hepler method: convert a Vue observer to json data
            getVueObject(data){
                return JSON.parse(JSON.stringify(data));
            },

            //send back an errorList, if errorList is empty, THEN FORM is considered valid
            validateFormData(){
                var errorList = [];
                //tag is the only required field
                if(this.tag.name == "") {
                    errorList.push( {error: "Name is a required field"} );
                }
                return errorList;
            },


            //return a FormData object which contains all inputs for this form
            getFormData(){
                var formData = new FormData();//data to send, iniitally empty
                
                var vueFormData = this.getVueObject(this.tag);//user-input
                
                //push user-input into formData, if a value besides empty string is given
                Object.keys(vueFormData).forEach(function(key){
                    if(vueFormData[key] != ""){
                        formData.append(key, vueFormData[key]);
                    } 
                });

                //add image to formdata using sub-component's functions, if any image was uploaded
                var uploadedImage = this.$refs.imageInput;
                if(uploadedImage.getUploadedFile() != ""){
                    formData.append(uploadedImage.getImageInputElementName(), uploadedImage.getUploadedFile());
                }

                return formData;                      
            },


            //will be used when loading existing data into form for update operation
            setFormData(data){
                this.tag = data;
            }

        }
    }
</script>-