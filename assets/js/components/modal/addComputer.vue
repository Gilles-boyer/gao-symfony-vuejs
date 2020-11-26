<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          icon
          color="primary"
          dark
          v-bind="attrs"
          v-on="on"
          title="Ajouter un Pc"
        >
          <v-icon>mdi-plus</v-icon><v-icon>mdi-desktop-classic</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="d-flex justify-content-between">
          <span class="headline">Ajouter un Ordinateur</span>
          <v-btn icon color="red" @click="close()">
            <v-icon>mdi-close-circle</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <v-container>

          <v-alert v-show="error" border="top" color="red lighten-2" dark>
            {{ error }}
          </v-alert>

            <v-row>
              <v-col cols="12">
                <v-text-field
                  label="Nom de l'ordinateur :"
                  :rules="[rules.required, rules.min]"
                  v-model="name"
                  required
                  @keyup="verifyData()"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green"
            class="mr-3 text-light"
            :disabled="disableCreer"
            @click="addComputer()"
          >
            Créer
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script src="./js/addComputer.js">
</script>
