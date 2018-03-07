<template>
    <div class="lends">
         <div class="container">
            <div class="card">
                <header class="card-header">
                  <p class="card-header-title"></p>
                </header>
                <div class="card-content">
                  <!-- form v-on:submit.prevent="onSubmit"-->
                  <div v-on:keyup = "getUser" >
                    <input-text 
                      v-bind:formdata="fh"  
                      element="id" 
                      caption="Ausleiher: (Nummer)" 
                      placeholder="Geben Sie bitte die Nummer des Ausleihers ein"/>
                    <p v-text="info"></p>
                  </div>
              </div>
          </div>
      </div>
      <div class="container" v-if='id'>
            <div class="col-4">{{book.title}}</div> 
            <div class="col-1"><a class="btn btn danger" v-on:click="removeBook(key)">x</a></div>
          </div>
          <div v-on:keyup = "addBook" >
            <input-text v-bind:formdata="fh" element="newbook" caption="Medium" placeholder="Neue Medium-Nr"></input-text>
          </div>
      </div>
    </div>
</template>
  


<script>
export default {
  data() {
    return {
      books: [],
      newbook: "",
      id: "1",
      info: "info",
      fh: new FormHelper({        id: "1",        idBook: "",        newbook: ""
      })
    };
  },

  props: ["restGetUser", "restGetBook"],

  methods: {
    getUser: function(event) {
      console.log(event.key);
      if (event.keyCode == 13) {
        if (this.fh.id) {
          axios
            .get(this.restGetUser + "/" + this.fh.id)
            .then(response => {
              this.id = this.fh.id;
              this.info = response.data.name + "(" + response.data.email + ")";
            })
            .catch(error => {
              this.info = "fehler bei der Kundensuche!";
            });
        }
      } else {
        this.id = "";
        this.info = "";
      }
    },

    removeBook(bookid) {
      this.books.splice(bookid, 1);
      console.log(bookid, ": wird entfernt!");
    },

    addBook: function(event) {
      console.log(event.key);
      if (event.keyCode == 13) {
        if (this.fh.id) {
          axios
            .get(this.restGetBook + "/" + this.fh.newbook)
            .then(response => {
              let tmpbook = response.data;
              this.newbookid = tmpbook.id;
              this.books.push(response.data);
              this.fh.newbook = "";
              this.newbook = "";
            })
            .catch(error => {
              this.info = "fehler bei der Buchsuche";
            });
        }
      }
    }
  },

  created() {
    console.log(this.restGetUser);

    /*
    this.books = [];
    axios
      .get("rest/get/books")
      .then(response => (this.books = response.data.data));
    */
  },

  mounted() {
    console.log("service-book-lends Mounted");
  }
};
</script>
