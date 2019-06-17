<template>
    <div id='imageUpload' class='form-group row'>
        <label for="icon" class="col-md-4 col-form-label text-md-right">
            <b class='alt-bg padded'>{{ imageInputLabelText }}</b>
        </label>
        <br>
        <input id='image-input' type='file' :name='imageInputElementName' @change='handleFileUpload'>
        <br>
        <div v-if="fileUploadError" class='alert alert-danger mx-auto'>
            {{ fileUploadError }}
        </div>
    </div>
</template>

<script>
    export default{
        name: 'imageUpload',
        props: {
            imageInputLabelText: String,
            imageInputElementName: String,
            maxPreviewSize: String
        },
        data() {
            return {
                fileUploadError: "",
                file: "",//stores the uploaded file
            }
        },
        methods: {
            //handle file input, used to filter file types and handle 'cancel' events
            handleFileUpload(e){
                //reset any errors
                this.fileUploadError = "";

                //validate the file
                var fileArray = e.target.files;
                if(!fileArray.length){
                    this.file = "";
                    return;
                }

                var imageFile = fileArray[0];
                if(imageFile.type != "image/png" && imageFile.type != "image/jpeg" && imageFile.type != "image/svg+xml"){
                    //reset file input
                    $('#image-input').value = "";
                    this.fileUploadError = "Invalid File type (only png/jpg/svg accepted)";
                    return;
                }

                //set this
                this.file = imageFile;
            },

            //simple getters
            getImageInputElementName(){
                return this.imageInputElementName;
            },

            getUploadedFile(){
                return this.file;
            }
        }
    }
</script>