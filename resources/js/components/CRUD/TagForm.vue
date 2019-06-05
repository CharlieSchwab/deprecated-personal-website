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

            <div class="col-md-6">
                <input id="icon" type="file" class="form-control" name="icon">
            </div>
        </div>
    </div>

</template>

<script>
    export default{
        data() {
            return {
                tag: {
                    name: "",
                    type: "",
                    show_on_homepage: false,
                    icon_filepath: ""
                }
            }
        },

        methods: {
            getFormData(){
                return this.getVueObject(this.tag);
            },

            getVueObject(data){
                return JSON.parse(JSON.stringify(data));
            }
        }
    }
</script>