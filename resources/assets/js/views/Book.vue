<template>
    <div>
         <book-component :id="$route.params.id"></book-component>
    </div>
</template>


<script>
export default {
  mounted() {
    console.log("Book View Mounted");
    //console.log($route);
  }
};
</script>