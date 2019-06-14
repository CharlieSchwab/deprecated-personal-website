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
                fileUploadError: ""
            }
        },
        methods: {
            handleFileUpload(e){
                //reset any errors
                this.fileUploadError = "";

                var fileArray = e.target.files;

                if(!fileArray.length){
                    this.fileUploadError = "No file Uploaded"
                    return;
                }

                var imageFile = fileArray[0];
                if(imageFile.type != "image/png" && imageFile.type != "image/jpeg" && imageFile.type != "image/svg+xml"){
                    //reset file input
                    $('#image-input').value = "";
                    this.fileUploadError = "Invalid File type (only png/jpg/svg accepted)";
                    return;
                }
            }
        }
    }
</script>