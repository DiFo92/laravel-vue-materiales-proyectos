<template>
  <v-container>
    <v-row>
      <v-col>
        <v-data-table :headers="headers" :items="proyectsMaterials" class="elevation-1">
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>Materiales - Proyectos</v-toolbar-title>
              <v-divider class="mx-4" inset vertical></v-divider>
              <v-spacer></v-spacer>
            </v-toolbar>
          </template>
          <template v-slot:item.proyecto_id="{ item }">
            {{ proyects.find(p => item.proyecto_id == p.id).nombre }}
          </template>
          <template v-slot:item.material_id="{ item }">
            {{ materials.find(m => item.material_id == m.id).descripcion }}
          </template>
          <!-- <template v-slot:item.actions="{ item }">
            <v-icon small class="mr-2" @click="editProyecto(item)">mdi-pencil</v-icon>
            <v-icon small @click="deleteProyecto(item.id)">mdi-delete</v-icon>
          </template> -->
        </v-data-table>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-dialog v-model="dialog" max-width="500px">
          <v-card>
            <v-card-title>
              <span class="headline">Asignación Proyectos - Material</span>
            </v-card-title>
            <v-card-text>
              <v-form ref="form">
                <v-select
                label="Proyecto"
                :items="proyects"
                item-title="nombre"
                item-value="id"
                v-model="formData.proyecto_id"
                ></v-select>
                <v-select
                label="Material"
                :items="materials"
                item-title="descripcion"
                item-value="id"
                v-model="formData.material_id"
                ></v-select>
                <v-text-field v-model="formData.cantidad" label="Cantidad" required></v-text-field>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialog = false">Cancelar</v-btn>
              <v-btn color="blue darken-1" text @click="saveProyectsMaterials">Guardar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-col>
    </v-row>
    <v-row>
      <v-col :cols="3">
        <v-btn color="warning" @click="goPage(``)">Inicio</v-btn>
      </v-col>
      <v-col :cols="6">
        <v-btn color="primary" @click="openDialog">Agregar Material - Proyecto</v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from '@/plugins/axios'
export default {
  data() {
    return {
      dialog: false,
      materials: [],
      proyects: [],
      proyectsMaterials: [],
      headers: [
        {title: 'Proyecto', value:'proyecto_id'},
        {title: 'Material', value:'material_id'},
        {title: 'Cantidad', value:'cantidad'},
      ],
      formData: {
        id: null,
        proyecto_id: null,
        material_id: null,
        cantidad: null,
      }
    }
  },
  methods: {
    async fetchMaterials() {
      console.log('cargar mater')
      const response = await axios.get('/materials');
      console.log(response.data)
      this.materials = response.data.data;
    },
    async fetchProyectos() {
      console.log('cargar mater')
      const response = await axios.get('/proyects');
      console.log(response.data)
      this.proyects = response.data.data;
    },
    async fetchProyectsMaterials() {
      console.log('cargar mater')
      const response = await axios.get('/proyects-materials');
      console.log(response.data)
      this.proyectsMaterials = response.data.data;
    },
    openDialog() {
      this.formData = { id: null, name: '', quantity: '' };
      this.dialog = true;
    },
    async saveProyectsMaterials() {
      if (this.formData.id) {
        await axios.put(`/proyects-materials/${this.formData.id}`, this.formData);
      } else {
        await axios.post('/proyects-materials', this.formData);
      }
      this.dialog = false;
      this.fetchProyectsMaterials();
    },
    goPage(page){
        this.$router.push(`/${page}`);
      }
  },
  mounted() {
    this.fetchMaterials();
    this.fetchProyectos();
    this.fetchProyectsMaterials();
  },
  setup () {


    return {}
  }
}
</script>

<style lang="scss" scoped>

</style>
