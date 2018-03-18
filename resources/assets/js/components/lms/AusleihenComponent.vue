<template src="./AusleihenComponent.template.html"></template>
<script>
export default {
  data() {
    return {
      books: [],
      id_new_book: "",
      id_user: "",
      id_user_to_load: "",
      info: "",
      message: "",
    };
  },

  props: ["restGetUser", "restGetBook" , "restAusleihe"],

  methods: {
    fireGetUser: function(event) {
      if (event.keyCode == 13) {
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
          console.log("benutzer gefunden");
          console.log(this.info);
          // DOM not updated yet
          Vue.nextTick(function() {
            //this.$refs.refnewbook.focus();
            $("#newbookid").focus();
            console.log("focus ist gesetzt");
            console.log($("#newbookid").value);
          });
        })
        .catch(error => {
          this.info = "Fehler bei der Kundensuche!";
        });
    },

    cancelAusleihe: function() {

      this.id_user_to_load = "";
      this.id_user = "";

      /*
      this.$swal({
        title: 'Soll die Ausleihe abgebrochen werden?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ja, Ausleihe abbrechen!'
        }).then((result) => {
               if (result.value) {
            }
        })
        */
    },

    saveAusleiheAndSendMail: function()
    {
      this.saveAusleihe();
    },

    saveAusleihe: function() {

        let data = {id_user:this.id_user,books:this.books};
        axios.post(this.restAusleihe, data)
                .then(response => {
                    console.log(response);
                    this.id_user = "";
                    this.id_user_to_load = "";
                    this.books = [];
                    this.flash('Der Ausleihevorgang ist erfolgreich abgeschlossen worden', 'success', {  timeout: 3000});
                })
                .catch(error => {
                    console.log (error);
                    this.flash('Beim Speichern der Ausleihe ist ein Fehler aufgetreten', 'error', {  timeout: 13000});
                    //reject(error.response.data);
                });        

        return;

/*

 return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                    this.onSuccess(response.data);

                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data);

                    reject(error.response.data);
                });
        });



        axios
        .post(this.restGetBook + "/" + this.id_new_book)
        .then(response => {
          this.books.push(response.data);
          this.id_new_book = "";
          console.log(response.data);
        })
        .catch(error => {
          this.info = "fehler bei der Buchsuche";
        });

      // die Ids der Buecher kommen in ein Array
      this.books.forEach(function(book, index) {
        if (book.id == bookid) {
          indextoremove = index;
        }

      this.books.forEach(book => {
        
      });
      */
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
          console.log(response.data);
        })
        .catch(error => {
          this.info = "fehler bei der Buchsuche";
        });
    },

    removeBook(indextoremove) {
      this.books.splice(indextoremove, 1);
      
      // das wird nicht mehr gebraucht.
      /*
      let indextoremove = 0;
      this.books.forEach(function(book, index) {
        if (book.id == bookid) {
          indextoremove = index;
        }
      });
      */
    },

    created() {
      console.log("service-book-lends created ");
      Flash('test');
      console.log("service-book-lends fertig ");
    },

    mounted() {
      console.log("service-book-lends Mounted");
    },

    updated() {
      console.log("service-book-lends Mounted");
    }
  }
};
</script>
