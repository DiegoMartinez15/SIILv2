<template>
  <div class="content">
    <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
      <v-overlay :value="loader" :z-index="'99999999'">
        <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
      </v-overlay>
      <v-card>
        <v-card-title>
          Listado de Coordinadores
          <div class="flex-grow-1"></div>
          <v-text-field v-model="searchCoordinador" label="Buscar Cordinadores" hide-details></v-text-field>
        </v-card-title>
        <v-data-table
          :headers="hTBCoordinadores"
          :items="arrayCoordinadores"
          :footer-props="{
            'items-per-page-options': [5,10, 20, 30,40],
            'items-per-page-text' : 'Registros Por Página'
          }"
          :items-per-page="5"
          :search="searchCoordinador"
          multi-sort
          class="elevation-1"
        >
          <!-- Template Para Modal de Actualizar y Agregar Area -->

          <template v-slot:top>
            <v-toolbar flat color="white">
              <div class="flex-grow-1"></div>
              <v-dialog v-model="modalCoordinador" persistent max-width="700px">
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
                      <v-form ref="formCoordinador" v-model="validForm" :lazy-validation="true">
                        <v-text-field
                          append-icon="mdi-folder-outline"
                          v-model="cordinador.nombre"
                          @keyup="errorsNombre = []"
                          :rules="[v => !!v || 'Nombre Es Requerido']"
                          label="Nombre"
                          required
                          :error-messages="errorsNombre"
                        ></v-text-field>

                       <v-select
                        v-model="cordinador.idusuario"
                        :lazy-validation="true"
                        :rules="[v => !!v || 'Este Campo Es Requerido']"
                        label="Seleccionar Usuario admin"
                        :items="listusuario"
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
                      @click="saveCordinador()"
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
                  @click="deleteCoordinador(item)"
                >
                  <v-icon>mdi-delete</v-icon>
                </v-btn>
              </template>

              <span>Eliminar Coordinador</span>
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
      arrayCoordinadores: [],
      hTBCoordinadores: [
        { text: "Nombre", value: "nombre" },
        { text: "Tipo", value: "idusuario" },
        { text: "Acciones", value: "action", sortable: false, align: "center" }
      ],
      loader: false,
      searchCoordinador: "",
      modalCoordinador: false,
      listusuario: [],
      cordinador: {
        id: null,
        nombre: "",
        idusuario: "",
        
      },
      validForm: true,
      snackbar: false,
      msjSnackBar: "",
      errorsNombre: [],
      editedCoordinador: 0
    };
  },
  computed: {
    formTitle() {
      return this.cordinador.id === null
        ? "Agregar cordinador"
        : "Actualizar cordinador";
    },
    btnTitle() {
      return this.cordinador.id === null ? "Guardar" : "Actualizar";
    }
  },
  methods: {
    fetchCoordinador() {
      let me = this;
      me.loader = true;
      
      axios.get('/coordinadores')
        .then(function(response) {
          me.arrayCoordinadores = response.data;
          me.loader = false;
        })
        .catch(function(error) {
          me.loader = false;
          console.log(error);
        });
    },
    fetchlistUsuario() {
      let me = this;
      me.loader = true;
      
      axios.get('/usuarios/getId')
        .then(function(response) {
          me.listusuario = response.data;
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
      me.modalCoordinador = false;
      setTimeout(() => {
        me.cordinador = {
          id: null,
          nombre: "",
          passwd: "",
          idusuario:"",
          
        };
        me.resetValidation();
      }, 300);
    },
    resetValidation() {
      let me = this;
      me.errorsNombre = [];
      me.$refs.formCoordinador.resetValidation();
    },
    showModalEditar(cordinador) {
      let me = this;
      me.editedCoordinador = me.arrayCoordinadores.indexOf(cordinador);
      me.cordinador = Object.assign({}, cordinador);
      me.modalCoordinador = true;
    },
    saveCordinador() {
      let me = this;
      if (me.$refs.formCoordinador.validate()) {
        let accion = me.cordinador.id == null ? "add" : "upd";
        me.loader = true;
        if(accion=="add"){
            console.log(me.cordinador);
           axios.post('/coordinadores/save', me.cordinador)
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
            axios.put('/coordinadores/update',me.cordinador)
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
    deleteCoordinador(cordinador) {
      let me = this;
      me.editedCoordinador = me.arrayCoordinadores.indexOf(cordinador);
      
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
        title: 'Eliminar cordinador ',
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
            axios.put(`/coordinadores/delete`, cordinador)
            .then(function(response) {
              me.verificarAccionDato(response.data, response.status, "del");
              me.loader = false;
            })
          }
        });
    },
    verificarAccionDato(cordinador, statusCode, accion) {
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
          this.fetchCoordinador(); 
          Toast.fire({
            icon: 'success',
            title: 'cordinador Registrado con Exito'
           });
          me.loader = false;
          break;
        case "upd":
          //Actualizo al array de areas el objecto que devuelve el Backend ya con los datos actualizados
          //Object.assign(me.arrayAreas[me.editedArea], area);
          this.fetchCoordinador(); 
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
              this.fetchCoordinador();
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
    me.fetchCoordinador();
    me.fetchlistUsuario();
  }
};
</script>