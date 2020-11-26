<template>
  <div class="home">
    <div class="text-center">
      <v-btn @click="logout()" color="grey" class="mt-3 mb-3"
        >Logout<v-icon>mdi-logout</v-icon></v-btn
      >
    </div>

    <!-- DatePicker -->
    <datePicker />
    <!-- ---------- -->

    <v-row class="justify-content-center">
      <v-col md="2" class="text-center">
        <v-btn
          v-if="$store.state.page > 1"
          @click="changePageLeft()"
          color="grey"
        >
          <v-icon>mdi-menu-left</v-icon>
        </v-btn>
      </v-col>
      <v-col md="3">
        <!--Modal addComputer -->
        <addComputer></addComputer>
        <!-- ---------------- -->
      </v-col>
      <v-col md="2" class="text-center">
        <v-btn
          v-if="
            $store.state.last_page > 1 &&
            $store.state.last_page != $store.state.page
          "
          color="grey"
          @click="changePageRight()"
        >
          <v-icon>mdi-menu-right</v-icon>
        </v-btn>
      </v-col>
    </v-row>

    <v-row>
      <v-col
        cols="auto"
        md="3"
        lg="3"
        v-for="(computerData, index) in getListComputers"
        :key="index"
      >
        <!-- component Computer -->
        <cardComputer :computer="computerData" :indexPC="index"></cardComputer>
        <!-- ------------------ -->
      </v-col>
    </v-row>
    <snackbar />
  </div>
</template>

<script src="./js/home.js"></script>
