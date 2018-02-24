<template>
  <article class="message">
    <div class="message-header">{{para.title}}</div>
    <div class="message-body">{{para.text}}</div>
  </article>
</template>

<script>
export default {
  props: ["para"],

  methods: {
    mounted() {
      console.log("PageComponent Mounted");
    }
  }
};
</script>
