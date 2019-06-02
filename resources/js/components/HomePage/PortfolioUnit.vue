<template>
  <div id="portfolio-unit">
    <div class='space-y'></div>
    <br>
    
    <div class='container'>
      <h3>
        <i class="far fa-star"></i>
        <b>Featured Projects</b>
      </h3>
    </div>

    <!-- flex row when above md, flex column when below md -->
    <div class="d-flex flex-md-row flex-column justify-content-center">
      <div class='card shadow spaced'
        v-for='project of projects'>
        <div class='card-body'>
            <div class='text-center'>
              <h4>
                <b>{{project.project_name}}</b>
              </h4>
              <!-- all skills used for this project -->
              <span v-for='skill in project.skills_used'
                  class='badge badge-pill alt-bg skills-for-project spaced-min'>
                  {{skill}}
              </span>
            </div>            
            <hr>
            <p>
              <b>{{project.brief_description}}</b>
              <div v-for='line in project.full_description'>
                <p class='no-margins'>{{line}}</p>
              </div>
            </p>
        </div>
      </div>
    </div>

    <div class='space-y'></div>
    <div class='space-y'></div>
  </div>
</template>

<style>
  .skills-for-project {
    font-size: 16px !important;
    color: #505050;
    cursor:pointer;
  }
</style>

<script>
    import projects_json from '../json/portfolio.json';
    export default{
        data(){
            //preprocess the full description to split into lines (separate by commas and periods)
            projects_json.data.map(el => {
              return el.full_description = el.full_description.split(/[,.]/);
            });
            return{
                projects: projects_json.data
            }
        }
    }
</script>