<template>

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label">{{caption}}</label>
        </div>
        <div class="field-body">
            <div class="field">
                <p class="control is-expanded">
                <textarea  class="input" type="text" 
                        name=element
                        v-model=formdata[element] 
                        t=""
                        >
                        {{formdata[element] }}
                </textarea>
                </p>
            </div>
        </div>
    </div>
</template>



<script>
export default {
  props: ["element", "formdata", "caption"],
  mounted() {
    console.log("input text Area Component mounted.");
    this.formdata[this.element]="irgendeinwert";
    console.log(this.formdata[this.element]);
  }
};
</script>
