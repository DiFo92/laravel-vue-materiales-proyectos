<template>
  <v-container>
    <v-row>
      <v-col>
        <v-dialog v-model="dialog" max-width="500px">
          <v-card>
            <v-card-title>
              <span class="headline">Gestión Material</span>
            </v-card-title>
            <v-card-text>
              <v-form ref="form">
                <v-text-field v-model="formData.codigo" label="Código" required></v-text-field>
                <v-text-field v-model="formData.descripcion" label="Descripción" required></v-text-field>
                <v-text-field v-model="formData.precio" label="Precio" required></v-text-field>
                <v-select
                label="Unidad"
                :items="itemsUnd"
                item-title="descripcion"
                item-value="id"
                v-model="formData.unidad_id"
                ></v-select>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialog = false">Cancelar</v-btn>
              <v-btn color="blue darken-1" text @click="saveMaterial">Guardar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-data-table :headers="headers" :items="materials" class="elevation-1">
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>Materiales</v-toolbar-title>
              <v-divider class="mx-4" inset vertical></v-divider>
              <v-spacer></v-spacer>
            </v-toolbar>
          </template>
          <template v-slot:item.unidad_id="{ item }">
            {{ getTextDetailParameter(item.unidad_id) }}
          </template>
          <template v-slot:item.actions="{ item }">
            <v-icon small class="mr-2" @click="editMaterial(item)">mdi-pencil</v-icon>
            <v-icon small @click="deleteMaterial(item.id)">mdi-delete</v-icon>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
    <v-row>
      <v-col :cols="3">
        <v-btn color="warning" @click="goPage(``)">Inicio</v-btn>
      </v-col>
      <v-col>
        <v-btn color="primary" @click="openDialog">Agregar Material</v-btn>
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
      itemsUnd: [],
      headers: [
        { title: 'Código', value: 'codigo' },
        { title: 'Descripción', value: 'descripcion' },
        { title: 'Precio', value: 'precio' },
        { title: 'Unidad', value: 'unidad_id' },
        { title: 'Acciones', value: 'actions', sortable: false }
      ],
      formData: {
        id: null,
        codigo: '',
        descripcion: '',
        precio: '',
        unidad_id: null
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
    async fetchDetailParameter(parameter = 3) {
      const response = await axios.get(`parametro-detalle/${parameter}`);
      console.log(response.data)
      this.itemsUnd = response.data
    },
    openDialog() {
      this.formData = { id: null, name: '', quantity: '' };
      this.dialog = true;
    },
    async saveMaterial() {
      if (this.formData.id) {
        await axios.put(`/materials/${this.formData.id}`, this.formData);
      } else {
        await axios.post('/materials', this.formData);
      }
      this.dialog = false;
      this.fetchMaterials();
    },
    editMaterial(item) {
      this.formData = { ...item };
      this.dialog = true;
    },
    async deleteMaterial(id) {
      await axios.delete(`/materials/${id}`);
      this.fetchMaterials();
    },
    getTextDetailParameter(id){
      const detailParameter = this.itemsUnd.find(item => item.id == id);
      return detailParameter ? detailParameter.descripcion : '';
    },
    goPage(page){
        this.$router.push(`/${page}`);
      }
  },
  mounted() {
    this.fetchDetailParameter();
    this.fetchMaterials();
  }
}
</script>
