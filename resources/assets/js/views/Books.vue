<template>
    <div>
        <h1 class="title">Medien</h1>

        <books-search-component></books-search-component>
        <!-- nur wenn elemente ausgewählt wurden .. -->        
        <!-- books-component></books-component -->
    </div>
</template>

<script>
export default {
  
  mounted() {
    console.log("BooksMounted");
  }
};
</script>