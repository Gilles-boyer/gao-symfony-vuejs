<template>
  <div class="text-center">
    <v-snackbar
      v-model="$store.state.snackbar"
      :multi-line="multiLine"
      timeout="2000" 
      :centered="true"
    >
      {{ $store.state.confirmation }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="green"
          text
          v-bind="attrs"
          @click="$store.state.snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </div>
</template>
<script src = "./js/snackbarConfirmation.js">
</script>