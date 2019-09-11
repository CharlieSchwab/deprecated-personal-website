@extends('layouts.app')

@section('page-title')
<title>Udip Patel - Personal Website - Home</title>
@stop

@section('head-content')

@stop

@section('body')
<hero-unit></hero-unit>
<div class='separation-line alt-bg'></div>
<div class='d-flex flex-column'>
  <br>
  <div class='container'>
    <h3>
      <i class='fas fa-tools'></i> <b>Frameworks/Tools</b>
    </h3>
  </div>

  <skills-row></skills-row>
</div>
<portfolio-unit></portfolio-unit>
<br>
<div class = 'd-flex flex-column'>
  <div class='container'>
    <h3>
      <i class='fas fa-laptop-code'></i> <b>How this Website Works</b>
    </h3>
  </div>
  <br>
  <video class='demo-video' playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4">
  </video>
</div>
<br>
@stop

@section('scripts')
<script>
  $('document').ready(function() {
    $('#nav-home-link').addClass('active');

    /* simple hover action for any cards */
    $('.card').hover(
      function() {
        $(this).addClass('shadow-lg');
      },
      function() {
        $(this).removeClass('shadow-lg');
      }
    );
  });
</script>
@stop