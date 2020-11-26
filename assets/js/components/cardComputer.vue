<template>
  <v-card>
    <v-card-title class="d-flex justify-md-space-between text-light bg-primary">
      <v-row>
        <v-col md="9">
          {{ computer.name }}
        </v-col>
        <v-col md="3">
          <!-- Modal delete computer -->
          <deleteComputer :pc="computer" :index="indexPC" />
          <!-- --------------------- -->
        </v-col>
      </v-row>
    </v-card-title>

    <v-card-text>
      <!--title col -->
      <v-row>
        <v-col align-self="center" md="3" class="font-weight-bold">
          {{ "Heure" }}
        </v-col>
        <v-col
          align-self="center"
          md="6"
          class="text-center font-weight-bold text-primary"
        >
          {{ "Nom du client" }}
        </v-col>
        <v-col md="3"> </v-col>
      </v-row>
      <!-- -------- -->
      <v-row v-for="(attribution, index) in computer.attributions" :key="index">
        <v-col align-self="center" md="3" class="font-weight-bold">
          {{ attribution.time }}h00
        </v-col>
        <v-col
          align-self="center"
          md="6"
          class="text-center font-weight-bold text-primary"
        >
          {{ attribution.client.name }}
        </v-col>
        <v-col align-self="center" class="text-center" md="3">
          <addAttributionWithAutocomplete 
            v-if="!attribution.client.name"
            :attribu="attribution"
            :computerId="computer.id"
          />
          <!-- modal delete Attribution -->
          <deleteAttribution
            v-if="attribution.client.name"
            :attribu="attribution"
          />
          <!-- ------------------------ -->
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
<script src="./js/cardComputer.js">
</script>