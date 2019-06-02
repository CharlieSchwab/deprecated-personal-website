<template>
  <div id="skills-row" class="row mx-auto">
    <div id="tags">
      <img
        data-toggle="tooltip"
        data-placement="bottom"
        class="skill-img"
        v-for="skill of skills.data"
        v-bind:title="skill.name"
        v-bind:src="'/assets/logos/' + skill.image"
      >
    </div>
    <div class='space-y'></div>
    
  </div>
</template>


<script>
  //static files can be imported in the component
  import json from "../json/skills.json";
  export default {
    data() {
      return {
        skills: json
      };
    }
  };
</script>