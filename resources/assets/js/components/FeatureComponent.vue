<template>
  <div>

    <div v-if="editmode == false">
      <!------------------------ Anzeigen ------------------------>
      <div class="card-body">
        <h5 class="card-title"><a :href="url">{{title}}</a>
          <a href="#" v-on:click="onEdit">
            <span class="oi oi-pencil small" title="pencil" aria-hidden="true"></span>
          </a>
        </h5>
        <p class="card-text">
          {{descr}}
        </p>
      </div>

    </div>

    <div v-else>
      <!------------------------ Editieren ------------------------>
      <div class="card-body ">
        <h5 class="card-title">Feature bearbeiten:{{title}}   </h5>
        <form v-on:submit.prevent="onSubmit">
          <input-text v-bind:formdata="fh"  element="key" caption="key"/>
          <input-text v-bind:formdata="fh"  element="title" caption="Titel"/>
          <input-text v-bind:formdata="fh"  element="descr" caption="Beschreibung"/>
          <input-text v-bind:formdata="fh"  element="route" caption="Route"/>
        <a class="btn button btn-success" :class="isLoadingClass" v-on:click="onSave">Save</a>
      </form>
        <p>
            
        </p>
      </div>
    </div>

    <!------------------------ Ende ------------------------>

  </div>
</template>

<script>
export default {
  props: ["feature", "restRouteToRead","restRouteToPost"],

  data() {
    return {
      editmode: false,
      title: "",
      descr: "",
      route: "",
      url:"",
      isLoadingClass: "",
      // form-Definition:   
       fh: new FormHelper({ key: "",  title: "",  descr: "", route: ""})
    };
  },

  /**
   * lesen der Daten von der Datenbank:
   */
  created() {
    this.readData();
    console.log (this.url);
    console.log ('ich werde gerufen');
  },

  methods: {

    readData()
    {
     axios.get(this.restRouteToRead).then(
       response => {
              this.key = response.data.key;
              this.title = response.data.title;
              this.descr = response.data.descr;
              this.route = response.data.route;
              this.url = response.data.url;
              }
      );
      
    },

    /** 
     * beim Editieren müssen die Variablen befüllt werden 
    */
    onEdit(event) {
      this.readData();
      this.editmode = true;
      this.fh.key = this.key;
      this.fh.title = this.title;
      this.fh.descr = this.descr;
      this.fh.route = this.route;      
      console.log(this.restRouteToPost);
    },

    /**
     * Speichern der aktuallisierten Daten
     */
    onSave(event) {
      // zuerst speichern wir:
      this.isLoadingClass = "is-loading"; // für die Animation des Buttons
      this.fh
        .post(this.restRouteToPost)
        .then(response=>
          {
            this.fh.setData(response);
            this.editmode = false;
            // lese die Daten neu ein!
          }
        )
        .catch (error => {
         this.isLoadingClass = ""; // Animation ausschalten
         console.log('wir haben einen Fehler!');
         
      });    
      this.readData();            
      this.isLoadingClass = "";
    }
  },

  mounted() {
    console.log("Feature-display Mounted");
  }
};
</script>
