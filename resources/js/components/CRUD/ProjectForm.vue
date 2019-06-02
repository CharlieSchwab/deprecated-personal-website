<template>
    <div id='project-form'>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">
                <b>Project Name*</b>
            </label>

            <div class="col-md-6">
                <input type="text" class="form-control @error('project') is-invalid @enderror" name="name" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">
                <b>Project Description</b>
            </label>

            <div class="col-md-6">
                <input id="description" type="text" class="form-control @error('icon') is-invalid @enderror" name="description">
            </div>
        </div>
    </div>

</template>

