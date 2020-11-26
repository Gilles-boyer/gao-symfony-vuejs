<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="red" dark v-bind="attrs" v-on="on">
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="headline d-flex justify-content-between">
          {{ "Supprimer un Ordinateur" }}
          <v-btn icon color="red" @click="dialog = false">
            <v-icon>mdi-close-circle</v-icon>
          </v-btn>
        </v-card-title>

        <v-card-text
          >Etes-vous sure de vouloir supprime l'Ordinateur :
          <strong class="text-danger"> {{ pc.name }}</strong> ?</v-card-text
        >
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="dialog = false">
            Annuler
          </v-btn>
          <v-btn color="red darken-1" text @click="deleteComputer()">
            Supprimer
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script src="./js/deleteComputer.js">
</script>