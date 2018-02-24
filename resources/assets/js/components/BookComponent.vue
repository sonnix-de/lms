<template>
  <div class="container">
    <div class="book">
      <article class="message">
        <h1>Buch</h1>
        
        <form v-on:submit.prevent="onSubmit">
        <input-text v-bind:formdata="fh"  element="id" caption="id"/>
        <input-text v-bind:formdata="fh"  element="title" caption="Titel"/>
        <input-text v-bind:formdata="fh"  element="author" caption="Autor"/>
        <input-text-area v-bind:formdata="fh"  element="content" caption="Inhalt"/>
        <input-isbn-lookup v-bind:formdata="fh"  element="isbn13" caption="Isbn"/>

        <a class="button is-success" :class="isLoadingClass" v-on:click="onSubmit()">Speichern </a>
        
      </form>
      </article>
    </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      //book: {},
      isLoadingClass : "",
      //fherrors: {title:"Title-fehler",author:'wasAnderesAuthor'},
      fh: new FormHelper({
        id: "",
        title: "",
        author: "",
        content: "",
        isbn13: ""
      })
    };
  },

  props: ["id"],
  /**
   * beim Erzeugen der komponente wird das Buch mit der ID geladen und
   * die Daten dem Formhelper zugewiesen.
   */
  created() {
    console.log("bookComponent created");
    console.log ("buch wird gesucht...");
    axios
      .get("rest/get/book/id/" + this.id)
      .then(response => (this.fh.setData(response.data)));
  },

  methods: {
    /** 
     * Speichern der Eingabe 
     * Der FormHelper kümmert sich um die Details.
     * Diese Routine weist dem Formhelper die Daten zu und 
     * schaltet die Aninmation ein und aus. 
     * Auch im Fehlerfall!
     * 
    */
    onSubmit() {
      this.isLoadingClass = "is-loading"; // für die Animation des Buttons
      this.fh
        .post("rest/post/book/update")
        .then(response=>
          {
          this.isLoadingClass = "";
          this.fh.setData(response);
          }
          )
       .catch (error => {
         this.isLoadingClass = ""; // Animation ausschalten
      });          
    }
  },

  mounted() {
    //console.log("book Mounted");
  }
};
</script>
