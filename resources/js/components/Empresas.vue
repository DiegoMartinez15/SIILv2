<template>
  <div class="content">
    <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
      <v-overlay :value="loader" :z-index="'99999999'">
        <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
      </v-overlay>
      <v-card>
        <v-card-title>
          Listado de Empresas
          <div class="flex-grow-1"></div>
          <v-text-field v-model="searchEmpresa" label="Buscar Empresa" hide-details></v-text-field>
        </v-card-title>
        <v-data-table
          :headers="hTBEmpresas"
          :items="arrayEmpresas"
          :footer-props="{
            'items-per-page-options': [5,10, 20, 30,40],
            'items-per-page-text' : 'Registros Por Página'
          }"
          :items-per-page="5"
          :search="searchEmpresa"
          multi-sort
          class="elevation-1"
        >
          <!-- Template Para Modal de Actualizar y Agregar Area -->

          <template v-slot:top>
            <v-toolbar flat color="white">
              <div class="flex-grow-1"></div>
              <v-dialog v-model="modalEmpresa" persistent max-width="700px">
                <template v-slot:activator="{ on }">
                  <v-btn elevation="10" color="grey darken-3" dark class="mb-2" v-on="on">
                    Agregar&nbsp;
                    <v-icon>mdi-plus-box-multiple-outline</v-icon>
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title class="headline grey lighten-2" primary-titles>
                    <span class="headline" v-text="formTitle"></span>
                  </v-card-title>
                  <v-card-text>
                    <v-container>
                      <v-form ref="formEmpresa" v-model="validForm" :lazy-validation="true">
                        <v-text-field
                          append-icon="mdi-folder-outline"
                          v-model="empresa.nombre"
                          @keyup="errorsNombre = []"
                          :rules="[v => !!v || 'Nombre Es Requerido']"
                          label="Nombre"
                          required
                          :error-messages="errorsNombre"
                        ></v-text-field> 

                        <v-text-field
                          append-icon="mdi-folder-outline"
                          v-model="empresa.direccion"
                          @keyup="errorsNombre = []"
                          :rules="[v => !!v || 'La Direccion Es Requerida']"
                          label="Direccion"
                          required
                          :error-messages="errorsNombre"
                        ></v-text-field> 

                        <v-text-field
                          append-icon="mdi-folder-outline"
                          v-model="empresa.telefono"
                          @keyup="errorsNombre = []"
                          :rules="[v => !!v || 'El Telefono Es Requerido']"
                          label="Telefono"
                          required
                          :error-messages="errorsNombre"
                        ></v-text-field> 

                        <v-text-field
                          append-icon="mdi-folder-outline"
                          v-model="empresa.encargado"
                          @keyup="errorsNombre = []"
                          :rules="[v => !!v || 'El Encargado Es Requerido']"
                          label="Encargado"
                          required
                          :error-messages="errorsNombre"
                        ></v-text-field> 

                        <v-select
                        v-model="empresa.idarea"
                        label="Seleccionar Area"
                         :rules="[v => !!v || 'Este Campor es requerido']"
                        :items="listarea"
                        :item-text="'nombre'"
                        :item-value="'id'"
                    
                      ></v-select>

                      <v-select
                        v-model="empresa.idcoordinador"
                        label="Seleccionar Coordinador"
                        :rules="[v => !!v || 'Este Campor es requerido']"
                        :items="listcoordinadores"
                        :item-text="'nombre'"
                        :item-value="'id'"
                    
                      ></v-select>
                      </v-form>
                    </v-container>
                  </v-card-text>
                  <v-divider></v-divider>
                  <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn color="red darken-1" text @click="cerrarModal">Cerrar</v-btn>
                    <v-btn
                      color="info darken-1"
                      :disabled="!validForm"
                      @click="saveEmpresa()"
                      text
                      v-text="btnTitle"
                    ></v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-toolbar>
          </template>

       
          <!-- Template que va en la tabla en la columna de Acciones (Editar,Desactivar) -->

          <template v-slot:item.action="{item}" v-slot:activator="{ on }">
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-btn
                  color="success"
                  elevation="8"
                  small
                  dark
                  :disabled="item.id < 0"
                  v-on="on"
                  @click="showModalEditar(item)"
                >
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </template>
              <span>Actualizar Datos</span>
            </v-tooltip>
            <v-tooltip top v-if="item.nombre !='null'">
              <template v-slot:activator="{ on }" >
                <v-btn
                  color="info"
                  class="mx-1"
                  elevation="8"
                  small
                  dark
                  :disabled="item.id < 0"
                  v-on="on"
                  @click="deleteEmpresa(item)"
                >
                  <v-icon>mdi-delete</v-icon>
                </v-btn>
              </template>

              <span>Eliminar Empresa</span>
            </v-tooltip>
            
          </template>
        </v-data-table>
      </v-card>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      arrayEmpresas: [],
      hTBEmpresas: [
        { text: "Nombre", value: "nombre" },
        { text: "Direccion", value: "direccion" },
        { text: "Telefono", value: "telefono" },
        { text: "Encargado", value: "encargado" },
        { text: "Area", value: "idarea" },
        
        { text: "Acciones", value: "action", sortable: false, align: "center" }
      ],
      loader: false,
      searchEmpresa: "",
      modalEmpresa: false,
      listcoordinadores:[],
      listarea:[],
      empresa: {
        id: null,
        nombre: "",
        direccion:"",
        telefono:"",
        encargado:"",
        idarea: "",
        idcoordinador: ""
        
      },
      validForm: true,
      snackbar: false,
      msjSnackBar: "",
      errorsNombre: [],
      editedEmpresa: 0
    };
  },
  computed: {
    formTitle() {
      return this.empresa.id === null
        ? "Agregar empresa"
        : "Actualizar empresa";
    },
    btnTitle() {
      return this.empresa.id === null ? "Guardar" : "Actualizar";
    }
  },
  methods: {
    fetchEmpresa() {
      let me = this;
      me.loader = true;
      
      axios.get('/empresas')
        .then(function(response) {
          me.arrayEmpresas = response.data;
          me.loader = false;
        })
        .catch(function(error) {
          me.loader = false;
          console.log(error);
        });
    },
    fetchCoordinador() {
      let me = this;
      me.loader = true;
      
      axios.get('/coordinadores')
        .then(function(response) {
          me.listcoordinadores = response.data;
          me.loader = false;
        })
        .catch(function(error) {
          me.loader = false;
          console.log(error);
        });
    },
     fetchArea() {
      let me = this;
      me.loader = true;
      
      axios.get('/areas')
        .then(function(response) {
          me.listarea = response.data;
          me.loader = false;
        })
        .catch(function(error) {
          me.loader = false;
          console.log(error);
        });
    },
  

    setMessageToSnackBar(msj, estado) {
      let me = this;
      me.snackbar = estado;
      me.msjSnackBar = msj;
    },
    cerrarModal() {
      let me = this;
      me.modalEmpresa = false;
      setTimeout(() => {
        me.empresa = {
          id: null,
        nombre: "",
        direccion:"",
        telefono:"",
        idarea: "",
        idcoordinador: ""
          
        };

        
        me.resetValidation();
      }, 300);
    },
    resetValidation() {
      let me = this;
      me.errorsNombre = [];
      me.$refs.formEmpresa.resetValidation();
    },
    showModalEditar(empresa) {
      let me = this;
      me.editedEmpresa = me.arrayEmpresas.indexOf(empresa);
      me.empresa = Object.assign({}, empresa);
      me.modalEmpresa = true;
    },
    saveEmpresa() {
      let me = this;
      if (me.$refs.formEmpresa.validate()) {
        let accion = me.empresa.id == null ? "add" : "upd";
        me.loader = true;
        if(accion=="add"){
            console.log(me.empresa);
           axios.post('/empresas/save', me.empresa)
            .then(function(response) {
            me.verificarAccionDato(response.data, response.status, accion);
            me.cerrarModal();
          })
          .catch(function(error) {
            console.log(error);
            //409 Conflicts Error (Proveedor Ya Existente En la BD)
            if (error.response.status == 409) {
              me.setMessageToSnackBar("Area Ya Existe", true);
              me.errorsNombre = ["Nombre De Area Existente"];
            } else {
              me.$swal("Error", "Ocurrio Un Error Intente Nuevamente", "error");
            }
            me.loader = false;
          });
        }else{
            //para actualizar
            console.log(me.empresa);
            axios.put('/empresas/update',me.empresa)
               .then(function(response) {
                   console.log(response.data);
                    me.verificarAccionDato(response.data, response.status, accion);
                    me.cerrarModal();
            })
          .catch(function(error) {
            console.log(error);
            me.loader = false;
          });
        }
      
      }
    },
    deleteEmpresa(empresa) {
      let me = this;
      me.editedEmpresa = me.arrayEmpresas.indexOf(empresa);
      
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        });
        //personalizando nueva confirmacion
        Swal.fire({
        title: 'Eliminar empresa ',
        text: "Una vez realizada la acción no se podra revertir !",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: "No"
        }).then((result) => {
        if (result.value) {
            me.loader = true;
            axios.put(`/empresas/delete`, empresa)
            .then(function(response) {
              me.verificarAccionDato(response.data, response.status, "del");
              me.loader = false;
            })
          }
        });
    },
    verificarAccionDato(empresa, statusCode, accion) {
      let me = this;
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        });
      switch (accion) {
        case "add":
          //Agrego al array de areas el objecto que devuelve el Backend
          //me.arrayAreas.unshift(area);
          this.fetchEmpresa(); 
          Toast.fire({
            icon: 'success',
            title: 'cordinador Registrado con Exito'
           });
          me.loader = false;
          break;
        case "upd":
          //Actualizo al array de areas el objecto que devuelve el Backend ya con los datos actualizados
          //Object.assign(me.arrayAreas[me.editedArea], area);
          this.fetchEmpresa(); 
           Toast.fire({
            icon: 'success',
            title: 'cordinador Actualizado con Exito'
           });
          me.loader = false;
          break;
        case "del":
          if (statusCode == 200) {
            try {
              //Se elimina del array de Areas Activos si todo esta bien en el backend
              //me.arrayAreas.splice(me.editedArea, 1);
             // me.arrayAreas[me.editedArea].estado = '0';
              //Se Lanza mensaje Final
              this.fetchEmpresa();
              Toast.fire({
                icon: 'success',
                title: 'cordinador Eliminado'
              });
            } catch (error) {
              console.log(error);
            }
          } else {
             Toast.fire({
                icon: 'error',
                title: 'Ocurrió un error, intente de nuevo'
              });
          }
          break;
      }
    }
  },
  mounted() {
    let me = this;
    me.fetchEmpresa();
    me.fetchCoordinador();
    me.fetchArea();
  }
};
</script>