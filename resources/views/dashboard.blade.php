
@extends('layouts.app')


@section('head-content')
<title>Udip Patel - Personal Website - Home</title>
@stop

@section('body')
    <crud-view></crud-view>
    <br>
@stop

@section('scripts')
    <script>
        //set CSRFToken to be available for all JS scripts using this page
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
@stop