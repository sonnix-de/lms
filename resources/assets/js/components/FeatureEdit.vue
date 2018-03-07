<template>
    <div class="card-body">
      <h5 class="card-title">{{title}} 
        <a href="#"><span class="oi oi-pencil small" title="pencil" aria-hidden="true"></span>
      </a>
      </h5>
      <p class="card-text">
        {{descr}}
      </p>
    </div>
</template>

<script>
export default {
  props: ["feature", "restRoute"],

  data() {
    return {
      title: "",
      descr: "",
      isLoadingClass: ""
    };
  },

  /**
   */
  created() {
    console.log("featureEdit created");
    console.log(this.restRoute);
    // wir holen uns die Features
    axios.get(this.restRoute).then(response => {
      this.title = response.data.title;
      this.descr = response.data.descr;
    });
  },

  methods: {
    /**
     * hier werde lediglich die Daten geholt und angezeigt.
     */
  },

  mounted() {
    console.log("Feature-display Mounted");
  }
};
</script>
