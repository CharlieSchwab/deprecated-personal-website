<template>
  <div id="imageUpload">
    <div id="imageUploadContainer" :style="{ 'max-width': maxPreviewSize + 'px'}">
      <div v-if="showExistingImage">
        <transition name="fadeOnShow">
          <div>
            <img id = "existingImage" class='striped-bg' v-bind:src="existingImagePath">
            <a class='btn update-btn d-block pointer' @click='showExistingImage = false'>Update Image</a>
          </div>
        </transition>
      </div>
      <div v-else>
        <div v-if="existingImagePath != ''">
          <i class='pointer fa fa-undo float-right' @click='revertImageUpdate' data-toggle='tooltip' data-placement='right' title='Revert to Existing Image'></i>
        </div>
        <!-- show input box if file is empty -->
        <transition name="fadeOnShow">
          <div id="imageUploadInputBox" v-if="file == ''">
            <label id="imageUploadLabel" for="icon" class="btn btn-primary">
              <b>{{ imageInputLabelText }}</b>
            </label>
            <br>
            <input
              id="image-input"
              type="file"
              :name="imageInputElementName"
              @change="handleFileUpload"
            >
          </div>
        </transition>
        <!-- show image preview if file is not empty -->
        <transition name="fadeOnShow">
          <div v-if="file != ''">
            <img id="imagePreview" class='striped-bg' src="#" alt="No File">
            <!-- reset image file if given -->
            <div :style="{ 'width': maxPreviewSize + 'px' }" class="mx-auto">
              <a @click="resetImageUpload" class="btn btn-dark white-text d-block pointer">Reset Image</a>
            </div>
          </div>
        </transition>
      </div>
    </div>
    <!-- if any errors exist, show alert -->
    <transition name="shake">
      <div v-if="fileUploadError" :style="{ 'width': maxPreviewSize + 'px' }" class="mx-auto">
        <p class="alert alert-danger text-center">{{ fileUploadError }}</p>
      </div>
    </transition>
  </div>
</template>

<style>
#imageUploadContainer {
  margin: auto;
  position: relative;
  overflow: hidden;
  z-index: 5;
}

#existingImage{
  width: 100%;
  height: 100%;
}

#imageUploadInputBox {
  height: 100px;
  background: repeating-linear-gradient(
    45deg,
    #fcfcfc,
    #fcfcfc 10px,
    #f4f4f4 10px,
    #f4f4f4 20px
  );
  border-radius: 20px;
}

#imageUploadLabel {
  position: absolute;
  opacity: 0.6;
  right: 20%;
  left: 20%;
  bottom: 25%;
}

#image-input {
  position: absolute;
  height: 100%;
  width: 100%;
  z-index: 10;
  opacity: 0;
  cursor: pointer;
}

.striped-bg{
  background: repeating-linear-gradient(
    45deg,
    #fcfcfc,
    #fcfcfc 10px,
    #f4f4f4 10px,
    #f4f4f4 20px
  )
}

.update-btn{
  background-color: #f8fafc;
  border-radius: 5px;
}
.update-btn:hover{
  background-color: #dfe1e2;
}

#imagePreview {
  width: 100%;
  height: 100%;
  padding: 5px;
  padding-bottom: 0 !important;
  border: 1px solid #ddd;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  object-fit: cover; /* auto-sizes the image size */
}
</style>

<script>
export default {
  name: "imageUpload",
  props: {
    imageInputLabelText: String,
    imageInputElementName: String,
    maxPreviewSize: String,
    existingImagePath: String
  },
  data() {
    return {
      fileUploadError: "",
      file: "", //stores the uploaded file
      showExistingImage: false//do not show any 'existing image' by default
    };
  },

  //after this component's creation (wait 1 tick) and check if existingImage path was passed in.
  // if so, show existing image
  created: function(){
    this.$nextTick(function(){
      if(this.existingImagePath != "") this.showExistingImage = true;
    });
  },

  methods: {
    //simple getters
    getImageInputElementName() {
      return this.imageInputElementName;
    },

    isUpdateOperation(){
      return !this.showExistingImage;
    },

    getUploadedFile() {
      return this.file;
    },

    //revert to existing image
    revertImageUpdate(){
      this.file = "";
      this.showExistingImage = true;
    },

    //set image src data once a image file is loaded
    showUploadedImage(file) {
      var reader = new FileReader();
      reader.onload = e => $("#imagePreview").attr("src", e.target.result);
      reader.readAsDataURL(file);
    },

    //reset uploaded image by resetting input value, component file attribute, and the image tag's src attribute
    resetImageUpload() {
      $("#image-input").value = "";
      this.file = "";
      $("#imagePreview").attr("src", "");
    },


    //handle file input, used to filter file types and handle 'cancel' events
    handleFileUpload(e) {
      //reset any errors
      this.fileUploadError = "";

      //validate the file
      var fileArray = e.target.files;
      if (!fileArray.length) {
        this.file = "";
        return;
      }

      var imageFile = fileArray[0];
      if (
        imageFile.type != "image/png" &&
        imageFile.type != "image/jpeg" &&
        imageFile.type != "image/svg+xml"
      ) {
        //reset file input
        $("#image-input").value = "";
        this.fileUploadError = "Error: Only png/jpg/svg accepted";
        return;
      }

      //show image preview and set component's data to store the file object
      this.showUploadedImage(imageFile);
      this.file = imageFile;
    }
  }
};
</script>