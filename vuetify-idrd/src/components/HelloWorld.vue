<template>
  <v-container class="fill-height">
    <v-responsive
      class="align-centerfill-height mx-auto"
      max-width="900"
    >
      <div class="text-center">
        <div class="text-body-2 font-weight-light mb-n1">Prueba técnica</div>

        <h1 class="text-h2 font-weight-bold">IDRD</h1>
      </div>

      <div class="py-4" />

      <v-row>


        <v-col cols="6">
          <v-card
            append-icon="mdi-open-in-new"
            class="py-4"
            color="surface-variant"
            prepend-icon="mdi-text-box-outline"
            rel="noopener noreferrer"
            rounded="lg"
            subtitle="Gestión de los materiales disponibles"
            title="Materiales"
            variant="text"
            @click="goPage(`materials`)"
          >
            <v-overlay
              opacity=".06"
              scrim="primary"
              contained
              model-value
              persistent
            />
          </v-card>
        </v-col>

        <v-col cols="6">
          <v-card
            append-icon="mdi-open-in-new"
            class="py-4"
            color="surface-variant"
            prepend-icon="mdi-star-circle-outline"
            rel="noopener noreferrer"
            rounded="lg"
            subtitle="Gestione los proyectos."
            title="Proyectos"
            variant="text"
            @click="goPage(`proyects`)"
          >
            <v-overlay
              opacity=".06"
              scrim="primary"
              contained
              model-value
              persistent
            />
          </v-card>
        </v-col>

        <v-col cols="12">
          <v-card
            append-icon="mdi-open-in-new"
            class="py-4"
            color="surface-variant"
            to="pages/materials"
            prepend-icon="mdi-widgets-outline"
            rel="noopener noreferrer"
            rounded="lg"
            subtitle="Gestione los materiales utilizados en cada proyecto"
            title="Materiales proyectos"
            variant="text"
            @click="goPage(`proyects-materials`)"
          >
            <v-overlay
              opacity=".06"
              scrim="primary"
              contained
              model-value
              persistent
            />
          </v-card>
        </v-col>

      </v-row>
    </v-responsive>
  </v-container>
</template>

<script>
  export default{
    methods:{
      goPage(page){
        this.$router.push(`/${page}`);
      }
    }
  }
</script>
