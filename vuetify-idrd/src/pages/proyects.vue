<template>
  <v-container>
    <v-row>
      <v-col>
        <v-btn color="primary" @click="openDialog">Agregar Proyecto</v-btn>
        <v-dialog v-model="dialog" max-width="500px">
          <v-card>
            <v-card-title>
              <span class="headline">Gestión Proyecto</span>
            </v-card-title>
            <v-card-text>
              <v-form ref="form">
                <v-text-field v-model="formData.nombre" label="Nombre" required></v-text-field>
                <v-select
                label="Departamento"
                :items="itemsDepartamento"
                item-title="descripcion"
                item-value="id"
                v-model="formData.departamento_id"
                ></v-select>
                <v-select
                label="Ciudad"
                :items="itemsCiudad"
                item-title="descripcion"
                item-value="id"
                v-model="formData.ciudad_id"
                ></v-select>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialog = false">Cancelar</v-btn>
              <v-btn color="blue darken-1" text @click="saveProyecto">Guardar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-data-table :headers="headers" :items="proyects" class="elevation-1">
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>Proyectos</v-toolbar-title>
              <v-divider class="mx-4" inset vertical></v-divider>
              <v-spacer></v-spacer>
            </v-toolbar>
          </template>
          <template v-slot:item.departamento_id="{ item }">
            {{ getTextDepartamento(item.departamento_id) }}
          </template>
          <template v-slot:item.ciudad_id="{ item }">
            {{ getTextCiudad(item.ciudad_id) }}
          </template>
          <template v-slot:item.actions="{ item }">
            <v-icon small class="mr-2" @click="editProyecto(item)">mdi-pencil</v-icon>
            <v-icon small @click="deleteProyecto(item.id)">mdi-delete</v-icon>
          </template>
        </v-data-table>
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
      proyects: [],
      itemsDepartamento: [],
      itemsCiudad: [],
      headers: [
        { title: 'Nombre', value: 'nombre' },
        { title: 'Departamento', value: 'departamento_id' },
        { title: 'Ciudad', value: 'ciudad_id' },
        { title: 'Acciones', value: 'actions', sortable: false }
      ],
      formData: {
        id: null,
        nombre: '',
        departamento_id: null,
        ciudad_id: null

      }
    }
  },
  methods: {
    async fetchProyectos() {
      console.log('cargar mater')
      const response = await axios.get('/proyects');
      console.log(response.data)
      this.proyects = response.data.data;
    },
    async fetchDetailParameter() {
      const parameterDpto = 1;
      const response1 = await axios.get(`parametro-detalle/${parameterDpto}`);
      this.itemsDepartamento = response1.data;

      let parameterCity = 2;
      const response = await axios.get(`parametro-detalle/${parameterCity}`);
      this.itemsCiudad = response.data
    },
    openDialog() {
      this.formData = { id: null, name: '', quantity: '' };
      this.dialog = true;
    },
    async saveProyecto() {
      if (this.formData.id) {
        await axios.put(`/proyects/${this.formData.id}`, this.formData);
      } else {
        await axios.post('/proyects', this.formData);
      }
      this.dialog = false;
      this.fetchProyectos();
    },
    editProyecto(item) {
      this.formData = { ...item };
      this.dialog = true;
    },
    async deleteProyecto(id) {
      await axios.delete(`/proyects/${id}`);
      this.fetchProyectos();
    },
    getTextDepartamento(id){
      const detailParameter = this.itemsDepartamento.find(item => item.id == id);
      return detailParameter ? detailParameter.descripcion : '';
    },
    getTextCiudad(id){
      const detailParameter = this.itemsCiudad.find(item => item.id == id);
      return detailParameter ? detailParameter.descripcion : '';
    }
  },
  mounted() {
    this.fetchProyectos();
    this.fetchDetailParameter();
  }
}
</script>
