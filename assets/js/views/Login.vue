<template>
  <v-row justify-md="center" class="mt-16">
    <v-alert v-show="error" border="top" color="red lighten-2" dark>
      {{ error }}
    </v-alert>
    <v-col md="3" class="bg-white">
      <v-form ref="form" v-model="valid" lazy-validation class="text-center">
        <v-text-field
          v-model="email"
          :rules="emailRules"
          label="Email"
          required
        ></v-text-field>

        <v-text-field
          v-model="password"
          :counter="6"
          :rules="passwordRules"
          label="Password"
          type="password"
          required
        ></v-text-field>

        <v-btn
          :disabled="!valid"
          color="success"
          class="text-center"
          @click="validate"
        >
          LOGIN
        </v-btn>
      </v-form>
    </v-col>
  </v-row>
</template>
<script src= "./js/login.js">
</script>