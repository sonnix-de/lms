<template>
  <div>
    <div  v-for="(log, index) in logs"
          v-bind:class="getClass(log)"
    >
          {{log.message}}
          <button type="button" class="close"  v-on:click="removeLog(log.id)">
          <span aria-hidden="true">&times;</span>
      </button>
    </div> 
  </div>
</template>

<script>
/**
Kleine Komponente um die Flash-Meldungen für das Programm zentral ausgeben zu können.
verwendet die Klasse FlashesUndLogs.js mit der global definierten Variable Flash.
 */

export default {
  data() {
    return {
      logs : Flash.getFlashes(),
    };
  },

 created() { },
  methods: {

    /**
     * Kleine Hilfsklasse, die aufgrund des logs die richtige rahmenklasse ermittelt.
     */
    getClass(log)
    {
      return "alert alert-" + log.severity;
    },

    removeLog(id)
    {
      Flash.removeFlash(id);
    }
  },

  mounted() {
  }
};
</script>
