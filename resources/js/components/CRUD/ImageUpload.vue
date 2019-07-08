<template>
  <div id="imageUpload">
    <div id="imageUploadContainer" :style="{ 'width': maxPreviewSize + 'px'}">
      <div v-if="showExistingImage">
        
      </div>
      <div v-else>
        <!-- show input box if file is empty -->
        <transition name="fadeOnShow">
          <div id="inputBox" v-if="file == ''">
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
            <img id="imagePreview" src="#" alt="No File">
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

#inputBox {
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

#imagePreview {
  width: 100%;
  height: 100%;
  padding: 5px;
  padding-bottom: 0 !important;
  border: 1px solid #ddd;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  object-fit: cover; /* auto-sizes the image size */

  background: repeating-linear-gradient(
    45deg,
    #fcfcfc,
    #fcfcfc 10px,
    #f4f4f4 10px,
    #f4f4f4 20px
  );
}
</style>

<script>
export default {
  name: "imageUpload",
  props: {
    imageInputLabelText: String,
    imageInputElementName: String,
    maxPreviewSize: String
  },
  data() {
    return {
      fileUploadError: "",
      file: "", //stores the uploaded file

      showExistingImage: false,
      existingImagePath: ""
    };
  },
  methods: {
    //simple getters
    getImageInputElementName() {
      return this.imageInputElementName;
    },

    getUploadedFile() {
      return this.file;
    },

    //set image src data
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