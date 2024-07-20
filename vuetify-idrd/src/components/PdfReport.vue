<template>
  <div>

    <!-- <h1>Generar y Descargar PDF en Vue</h1> -->
     <v-row>
      <v-col :cols="12">
        <v-data-table :headers="headers" :items="listadoProyectos" class="elevation-1">
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Previsualizar reporte</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
          </v-toolbar>
        </template>
      </v-data-table>
      </v-col>
      <v-col :cols="3">
        <v-btn color="warning" @click="goPage(``)">Inicio</v-btn>
      </v-col>
      <v-col :cols="6">
        <v-btn color="success" @click="downloadPDF">Descargar reporte PDF</v-btn>
      </v-col>
     </v-row>
    <br />
    <br />
  </div>
</template>

<script>
  import axios from '@/plugins/axios'

  import jsPDF from 'jspdf';
  export default{
    name: 'PdfReport',
    data() {
    return {
      headers: [
        { title: 'nombreProyecto', value: 'nombreProyecto' },
        { title: 'departamento', value: 'departamento' },
        { title: 'ciudad', value: 'ciudad' },
        { title: 'codigoMaterial', value: 'codigoMaterial' },
        { title: 'descripcionMaterial', value: 'descripcionMaterial' },
        { title: 'precioMaterial', value: 'precioMaterial' },
        { title: 'cantidadMaterial', value: 'cantidadMaterial' },
      ],
      listadoProyectos: [
        {
          nombreProyecto: "Proyecto A",
          departamento: "Santander",
          ciudad: "Facatativá",
          codigoMaterial: "52",
          descripcionMaterial: "Material A",
          precioMaterial: "52.00",
          cantidadMaterial: 50
        },
        {
          nombreProyecto: "Proyecto B",
          departamento: "Cundinamarca",
          ciudad: "Bogotá",
          codigoMaterial: "53",
          descripcionMaterial: "Material B",
          precioMaterial: "53.00",
          cantidadMaterial: 30
        },
      ]
    };
  },
    methods:{
      async fetchList() {
        const response = await axios.get('/report');
        console.log(response.data)
        this.listadoProyectos = response.data;
      },
      addHeader(doc) {
      doc.setFont('helvetica', 'bold');
      doc.setFontSize(12);
      doc.text('Listado de Proyectos - Materiales', 105, 10, null, null, 'center');
      doc.setFontSize(10);
      doc.line(10, 15, 200, 15); // Línea debajo del encabezado
    },
    addFooter(doc, pageNumber) {
      const pageHeight = doc.internal.pageSize.height;
      doc.setFont('helvetica', 'normal');
      doc.setFontSize(10);
      doc.text(`Página ${pageNumber}`, 105, pageHeight - 10, null, null, 'center');
    },
      downloadPDF(){
        console.log('Crear reporte')
         // Crear una nueva instancia de jsPDF
        const doc = new jsPDF();

        let y = 20; // Coordenada Y inicial debajo del encabezado
      const lineHeight = 10; // Altura de línea
      const pageHeight = doc.internal.pageSize.height; // Altura de la página
      let pageNumber = 1;

      this.addHeader(doc);
      this.addFooter(doc, pageNumber);

      this.listadoProyectos.forEach((proyecto, index) => {
        if (y + lineHeight * 7 > pageHeight - 20) { // Comprobar si hay suficiente espacio en la página actual
          doc.addPage();
          y = 20; // Reiniciar la coordenada Y para la nueva página
          pageNumber++;
          this.addHeader(doc);
          this.addFooter(doc, pageNumber);
        }

        // Añadir los datos del proyecto con nombres en negrita
        doc.setFont('helvetica', 'bold');
        doc.text(`Nombre del Proyecto:`, 10, y);
        doc.setFont('helvetica', 'normal');
        doc.text(proyecto.nombreProyecto, 60, y);
        y += lineHeight;

        doc.setFont('helvetica', 'bold');
        doc.text(`Departamento:`, 10, y);
        doc.setFont('helvetica', 'normal');
        doc.text(proyecto.departamento, 60, y);
        y += lineHeight;

        doc.setFont('helvetica', 'bold');
        doc.text(`Ciudad:`, 10, y);
        doc.setFont('helvetica', 'normal');
        doc.text(proyecto.ciudad, 60, y);
        y += lineHeight;

        doc.setFont('helvetica', 'bold');
        doc.text(`Código del Material:`, 10, y);
        doc.setFont('helvetica', 'normal');
        doc.text(proyecto.codigoMaterial, 60, y);
        y += lineHeight;

        doc.setFont('helvetica', 'bold');
        doc.text(`Descripción del Material:`, 10, y);
        doc.setFont('helvetica', 'normal');
        doc.text(proyecto.descripcionMaterial, 60, y);
        y += lineHeight;

        doc.setFont('helvetica', 'bold');
        doc.text(`Precio del Material:`, 10, y);
        doc.setFont('helvetica', 'normal');
        doc.text(proyecto.precioMaterial, 60, y);
        y += lineHeight;

        doc.setFont('helvetica', 'bold');
        doc.text(`Cantidad del Material:`, 10, y);
        doc.setFont('helvetica', 'normal');
        doc.text(proyecto.cantidadMaterial.toString(), 60, y);
        y += lineHeight;

        // Añadir una línea intermedia
        y += 5; // Espacio antes de la línea
        doc.line(10, y, 200, y); // Línea horizontal
        y += 15; // Espacio después de la línea
      });

        // Descargar el PDF con el nombre 'ejemplo.pdf'
        doc.save('reporte-materiales-proyectos.pdf');
      },
      goPage(page){
        this.$router.push(`/${page}`);
      }
    },
  mounted() {
    this.fetchList();
  }
  }
</script>

<style scoped lang="sass">
</style>
