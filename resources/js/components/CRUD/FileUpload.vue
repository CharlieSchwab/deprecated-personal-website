<template>
    <div id='fileUploadElement' v-bind:style="{ 'max-height': maxPreviewSize + 'px', 'width': maxPreviewSize + 'px' }">
        <file-pond :name="fileInputElementName" ref="pond" server="/imageUpload"
            label-idle="Drop files here ..." accepted-file-types="image/jpeg, image/png" v-bind:files="filePondFiles">
        </file-pond>
    </div>
</template>

<script>
    import vueFilePond from 'vue-filepond';
    import 'filepond/dist/filepond.min.css';
    // Import image preview plugin styles
    import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

    // Import image preview and file type validation plugins
    import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
    import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

    const filePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

    export default {
        name: 'fileUploadElement',
        data() {
            return {
                filePondFiles: []
            };
        },
        components:{
            filePond
        },
        props: {
            fileInputElementName: String,
            maxPreviewSize: String //could be a number if we need to enforce a number
        }
    }
</script>