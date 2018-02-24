<template>
    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label">{{caption}}</label>
        </div>
        <div class="field-body">
            <div class="field">
                <p class="control">
                <input  class="input" 
                        type="text" 
                        name=element 
                        v-model=formdata[element] 
                        placeholder=caption>
                </p>
                <span class="help is-danger" >{{formdata.getError(element)}}</span>
            </div>
        </div>
    </div>
</template>



<script>
export default {
  props: ["element", "formdata", "caption"],
  mounted() {
    //console.log("input text Component mounted.");
  }
};
</script>
