
@extends('layouts.app')


@section('head-content')
<title>Udip Patel - Personal Website - Home</title>
@stop

@section('body')
    @include('CRUD.createProject')
    @include('CRUD.createTag')
    
    <br><br>
    <div class='d-flex flex-md-row flex-column justify-content-center'>
        <div class='card col-md-5 spaced shadow'>
            <div class='card-body'>
                <h2 class='text-center'>Projects</h2>
                <hr>
                <button type="button" class="btn secondary-bg white-text float-right" data-toggle="modal" data-target="#createProjectModal">
                    <b><i class='fa fa-plus-circle'></i> Create New Project</b>
                </button>
            </div>
        </div>
        <div class='card col-md-5 spaced shadow'>
            <div class='card-body'>
                <h2 class='text-center'>Tags</h2>
                <hr>
                <button type="button" class="btn secondary-bg white-text float-right" data-toggle="modal" data-target="#createTagModal">
                    <b><i class='fa fa-plus-circle'></i> Create New Tag</b>
                </button>
            </div>
        </div>
    </div>
@stop

