<template>
    <div class="container">
        <h1 class="title">{{data.title}}</h1>
        <p class="subtitle">{{data.teaser}}</p>
        <!-- paragraphen -->
        <div v-for="paragraph in data.content">
            <paragraph-component :para="paragraph"></paragraph-component>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      data:[]
      }
    },
  

  props: ["pagename"],
  /**
   * beim Erzeugen der komponente wird das Buch mit der ID geladen und
   * die Daten dem Formhelper zugewiesen.
   */
  created() {
    console.log("Page Component loaded");
    console.log(this.pagename);
    axios
      .get("rest/get/page/title/"+this.pagename)
      .then(
          response => {
            (this.data = response.data);
            //console.log (this.data.teaser);
            //console.log (this.data.content);
            this.data.content = JSON.parse(this.data.content);
          }
        );

    
  },

  methods: {
    mounted() {
      console.log("PageComponent Mounted");
    }
  }
};
</script>
