<template>
    <div class="lends">
         <div class="container">
            <div class="card">
                <header class="card-header">
                  <p class="card-header-title">Ausleihen</p>
                </header>
                <div class="card-content">
                  <!-- form v-on:submit.prevent="onSubmit"-->
                  <div v-on:keyup = "getUser" >
                    <input-text v-bind:formdata="fh"  element="id" caption="Ausleiher: (Nummer)"/>
                    <p v-text="info"></p>
                  </div>
              </div>
          </div>
      </div>
      <div class="container" v-if='id'>
          <ul v-for="(book,key) in books">
            <li>{{book.title}} <a class="btn danger" v-on:click="removeBook(key)">x</a></li>
          </ul>
          <div v-on:keyup = "addBook" >
            <input-text v-bind:formdata="fh" element="newbook" caption="neues Buch"></input-text>
          </div>
          {{id}}
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
      fh: new FormHelper({
        id: "1",
        idBook: "",
        newbook: ""
      })
    };
  },

  props: ["restGetUser","restGetBook"],

  methods: {
    getUser: function(event) {
      console.log(event.key);
      if (event.keyCode == 13) {
        if (this.fh.id) {
          axios
            .get(this.restGetUser+'/' + this.fh.id)
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
      /*
      axios
        .get("rest/get/isbn/" + this.formdata.isbn13)
        .then(response => {
          this.isLoadingClass = "";
          console.log(response.data);
          this.formdata.author = response.data.author;
          this.formdata.title = response.data.title;
          this.formdata.descr =
            "irgendeinwert, damit da auch mal was drin steht";
          this.formdata.isbn13 = response.data.isbn13;
          this.formdata.ErrObj.clear();
        })
        .catch(error => {
          this.isLoadingClass = "";
          alert(error.message);
          console.log(error);
        });
      */
      this.books.splice(bookid,1);
      console.log(bookid,": wird entfernt!");
    },

    addBook: function(event) {
      console.log(event.key);
      if (event.keyCode == 13) {
        if (this.fh.id) {
          axios
            .get(this.restGetBook+'/' + this.fh.newbook)
            .then(response => {
              let tmpbook = response.data;
              this.newbookid = tmpbook.id;
              //console.log (response.data);
              this.books.push(response.data);
              this.fh.newbook = "";
              this.newbook = "";
              console.log(this.books);
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
