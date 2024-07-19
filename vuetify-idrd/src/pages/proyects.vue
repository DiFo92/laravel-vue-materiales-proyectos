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
                <v-text-field v-model="formData.departamento_id" label="Departamento" required></v-text-field>
                <v-text-field v-model="formData.ciudad_id" label="Ciudad" required></v-text-field>
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
      headers: [
        { text: 'Nombre', value: 'nombre' },
        { text: 'Departamento', value: 'departamento_id' },
        { text: 'Ciudad', value: 'ciudad_id' },
        { text: 'Acciones', value: 'actions', sortable: false }
      ],
      formData: {
        id: null,
        codigo: '',
        descripcion: '',
        precio: ''
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
    }
  },
  mounted() {
    this.fetchProyectos();
  }
}
</script>
