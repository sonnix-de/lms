<template>
  <div class="container">
    <div class="card" v-on:keyup="searchBooks" >
      <header class="card-header">
        <p class="card-header-title">
          Mediensuche
        </p>
      </header>
      <div class="card-content">
              <h2 class="subtitle">Suchkriterien</h2>
              <!-- form v-on:submit.prevent="onSubmit"-->
              <input-text v-bind:formdata="fh"  element="searchterm" caption="Suchbegriff"/>
              <input-text v-bind:formdata="fh"  element="title" caption="Titel"/>
              <input-text v-bind:formdata="fh"  element="author" caption="Autor"/>
              <!--a class="button is-success" :class="isLoadingClass" v-on:click="onSubmit()">Medien Suchen</a-->
      </div>
    </div>


    <div class="card">
        <table class="table is-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tr :v-for="book in books">
                <td> 
                     <router-link :to="{ name: 'book', params: { id: book.id }}">{{book.id}}</router-link>
                </td>
                <td>{{book.author}}</td>
                <td><router-link :to="{ name: 'book', params: { id: book.id }}">{{book.title}}</router-link>
                    </td>
                <td>{{book.status}}</td>
            </tr>
        </table>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      books: [],
      //book: {},
      isLoadingClass: "",
      //fherrors: {title:"Title-fehler",author:'wasAnderesAuthor'},
      fh: new FormHelper({
        title: "",
        author: "",
        searchterm: ""
      })
    };
  },

    props: ["restgetbooks"],

  created() {
    console.log("booksSearchComponent created");
    console.log(this.restgetbooks);
  },

  methods: {
    searchBooks(event) {
      if (this.fh.searchterm || this.fh.title || this.fh.author) {
        axios
          .get(this.restgetbooks, {
            params: {
              searchterm: this.fh.searchterm,
              author: this.fh.author,
              title: this.fh.title
            }
          })
          .then(response => (this.books = response.data.data));
      } else {
        this.books = [];
        axios
          .get(this.apiGetBooks)
          .then(response => (this.books = response.data.data));
      }
      console.log("searchterm:", this.searchterm);
      console.log(event);
    }
  },

  mounted() {
    console.log("bookSearchComponent Mounted");
  }
};
</script>
