<template>
  <v-row justify="center">
    <v-dialog v-model="create" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs2 }">
        <v-btn
          icon
          color="success"
          dark
          v-bind="attrs2"
          v-on="on"
          title="Ajouter un Utilisateur"
        >
          <div @click="closeModal">
            <v-icon>mdi-plus</v-icon>
            <v-icon>mdi-account</v-icon>
          </div>
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="d-flex justify-content-between">
          <span class="headline">Ajouter d'une Attribution</span>
          <v-btn icon color="red" @click="create = false">
            <v-icon>mdi-close-circle</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-alert v-show="error" border="top" color="red lighten-2" dark>
              {{ error }}
            </v-alert>

            <v-row class="justify-content-center align-center">
              <v-col cols="12" align-self="center">
                <v-text-field
                  label="Nom de L'utilisateur :"
                  :rules="[rules.required, rules.min]"
                  v-model="firstName"
                  required
                  @keyup="verifyData()"
                ></v-text-field>
              </v-col>
              <v-col cols="12" align-self="center">
                <v-text-field
                  label="Prénom de L'utilisateur :"
                  :rules="[rules.required, rules.min]"
                  v-model="lastName"
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
            @click="addAttribution"
          >
            Créer
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script src="./js/addAttributionWithName.js">
</script>