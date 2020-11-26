<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          icon
          color="success"
          dark
          v-bind="attrs"
          v-on="on"
          title="Ajouter un Pc"
        >
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="d-flex justify-content-between">
          <span class="headline">Ajouter d'une Attribution</span>
          <v-btn icon color="red" @click="dialog = false">
            <v-icon>mdi-close-circle</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <v-alert v-show="error" border="top" color="red lighten-2" dark>
            {{ error }}
          </v-alert>

          <v-container>
            <v-row class="justify-content-center align-center">
              <v-col cols="10" align-self="center">
                <v-autocomplete
                  :items="getClient"
                  :filter="customFilter"
                  :menu-props="cache"
                  color="white"
                  v-model="userID"
                  :hide-no-data="true"
                  item-value="id"
                  item-text="name"
                  label="Client"
                ></v-autocomplete>
              </v-col>
              <v-col cols="2" align-self="center">
                <!-- Modal attribution with create user -->
                <addAttributionWithName
                  v-if="buttonCreate"
                  :attribution="attribu"
                  :idComputer="computerId"
                  @bool="dialog = $event"
                />
                <!-- ---------------------------------- -->
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green"
            class="mr-3 text-light"
            :disabled="invalid"
            @click="addAttribution"
          >
            Créer
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script src="./js/addAttributionWithAutocomplete.js">
</script>