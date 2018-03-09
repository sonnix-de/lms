<template>
    <div class="lends">
         <div class="container">
              <!-- wenn noch kein User geladen ist: -->
              <div v-if="id_user == 0">
                <div v-on:keyup = "fireGetUser" class="row">
                    <div class="col-7">
                      <input class="input" 
                            type="text" 
                            v-model=id_user_to_load 
                            placeholder="Geben Sie bitte die Nummer des Ausleihers ein"/>
                    </div>
                    <div class="col-5">
                        <a class="btn btn-success" v-on:click="getUser">Laden</a>
                    </div>
                </div>
              </div>
              <!-- wenn ein User geladen ist -->
              <div v-if="id_user > 0">

                  <div class="row">
                      <div class="col-7">
                          <p v-text="info"></p>
                      </div>
                  </div>
                  <!-- ---------------------------------------------- -->
                  <!-- jetzt kommen die Medien, die wir laden wollen -->
                  <!-- ---------------------------------------------- -->
                  <!-- geladene Medien -->
                  <hr/>
                  <div v-for="book in books" class="row">
                        <div class="col-5">{{ book.title}}</div>
                        <div class="col-5">{{ book.author}}</div>
                        <div class="col-1">
                          <a class="btn btn-danger" v-on:click="removeBook(book.id)">{{book.id}} x</a>
                        </div>                        
                  </div>
                  <div v-on:keyup = "fireAddBook" class="row">
                        <input class="input" 
                              type="text" 
                              ref="refnewbook"
                              id="newbookid"
                              v-model="id_new_book"
                              placeholder="Neue Medium-Nr"/>
                        <a class="btn btn-default" v-on:click="addBook">Buch laden</a>
                  </div>
                  <!-- ---------------------------------------------- -->
                  <!-- Abschluss -->
                  <!-- ---------------------------------------------- -->                  
                  <div class="row">
                    <p>
                    <hr/><br/><br/>
                    <a class="btn btn-success" v-on:click="saveAusleihe">Ausleihe speichern</a>
                    <a class="btn btn-danger" v-on:click="cancelAusleihe">Ausleihe abbreichen</a>
                    </p>
                    <hr/>
                    <p>
                    <input type="text" name="email">
                    <input type="checkbox" name="sendemail"><label>Ausleihe auch per E-Mail schicken</label>
                    </p>
                </div>

              </div>
      </div>
    </div>
</template>
  


<script>
export default {
  data() {
    return {
      books: [],
      id_new_book: "",
      id_user: "",
      id_user_to_load : "",
      info: "infotestte",
      fh: new FormHelper({ id: "", idBook: "", newbook: ""  })
    };
  },

  props: ["restGetUser", "restGetBook"],

  methods: {
    fireGetUser: function(event) {
      if (event.keyCode == 13) 
      {
        this.getUser();
      }
    },

    getUser: function() {
        if (!this.id_user_to_load) {
          return;
        }
        axios
          .get(this.restGetUser + "/" + this.id_user_to_load)
          .then(response => {
            this.info = response.data.name + "(" + response.data.email + ")";
            this.id_user = this.id_user_to_load;
            //
            console.log ('benutzer gefunden');
            console.log (this.info);
          // DOM not updated yet
          Vue.nextTick(function () {
            //this.$refs.refnewbook.focus();
            $('#newbookid').focus();
            console.log("focus ist gesetzt");
            console.log($('#newbookid').value);
          });
            

          })
          .catch(error => {
            this.info = "Fehler bei der Kundensuche!";
          });
    },

    cancelAusleihe: function() {
      this.id_user_to_load = "";
      this.id_user = "";
    },

   saveAusleihe: function()
   {

   },

    fireAddBook: function(event) {
      if (event.keyCode == 13) {        
        this.addBook();
      }
    },
    /**
     * Ein Medium zur Liste hinzufügen:
     */
    addBook: function(event) {
        if (!this.id_new_book) {
          return;
        }
        axios
          .get(this.restGetBook + "/" + this.id_new_book)
          .then(response => {
            this.books.push(response.data);
            this.id_new_book = "";
            console.log (response.data);
          })
          .catch(error => {
            this.info = "fehler bei der Buchsuche";
          });
      
    },

    removeBook(bookid) {
      let indextoremove = 0;
      this.books.forEach(function(book, index) {
        if (book.id == bookid)
        {
          indextoremove = index;
          //this.books.splice(index, 1);
          //return;
        }
      });
      this.books.splice(indextoremove, 1);
      //console.log (this.books.indexOf(bookid));
      //console.log (this.books);
      
      console.log(bookid, ": wird entfernt!");

    },

  created() {
    console.log('hier müssen wahrscheinlich noch die bereits ausgeliehen ');

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
}
}
</script>
