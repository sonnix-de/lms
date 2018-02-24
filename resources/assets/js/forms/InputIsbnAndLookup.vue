<template>

 <div class="field is-horizontal has-addons">
          <div class="field-label is-normal">
            <label class="label">ISBN Nr.</label>
          </div>
          <div class="field-body">
            <div class="field">
                <p class="control is-expanded">
                <input  class="input" 
                        style="width:70%" 
                        type="text" 
                        name=element 
                        v-model=formdata[element] 
                        placeholder="isbn-nr">
                <span class="is-small is-right">
                <a class="button is-info" :class="isLoadingClass"
                    v-on:click="onIsbnLookup()">
                  Isbn Daten abrufen
                </a>
                </span>
                </p>
            </div>
        </div>
 </div>
 
</template>



<script>
export default {
 data() {
    return {
      isLoadingClass : ""
    }
 },  
  props: ["element", "formdata", "caption"],
  mounted() {
    console.log("input text Component mounted.");
  },

 

methods: {
    onIsbnLookup()
    {
      this.isLoadingClass = "is-loading";

      axios.get('rest/get/isbn/' + this.formdata.isbn13)
      .then (response => 
      {
       this.isLoadingClass  = "";
        console.log (response.data);
        this.formdata.author = response.data.author;
        this.formdata.title = response.data.title;
        this.formdata.descr = "irgendeinwert, damit da auch mal was drin steht";
        this.formdata.isbn13 = response.data.isbn13;
        this.formdata.ErrObj.clear();
      })
      .catch (error => {
        this.isLoadingClass  = "";
        alert (error.message);
        console.log(error);
      });
      console.log('lookup isbn');
    }
}
};
</script>
