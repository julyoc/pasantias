<template>
  <div class="container-fluid" style="padding-top: 20px">
    <div v-if="role != 'adm'">
      <!-- Show that you don't have the permission to access this-->
      <div class="alert alert-danger" role="alert">
        <span
          class="glyphicon glyphicon-exclamation-sign"
          aria-hidden="true"
        ></span>
        <span class="sr-only">Error:</span>
        No tiene el permiso para acceder a esta página
      </div>
    </div>
    <div v-if="role === 'adm'">
      <!-- Show that you have the permission to access this-->
      <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
        <span class="sr-only">Success:</span>
        Tiene el permiso para ingresar a esta página
        <!-- Show only the names of the users from a list -->
      </div>
      <!-- Vue table that iterates over a list of users -->
      <div class="row">
        <div class="col-md-6">
          <button
            user="'user'"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#registerUser"
            v-b-modal="'myModal'"
            v-show="'isModalVisible'"
          >
            Crear nuevo usuario
          </button>
        </div>
        <div class="col-6">
          <button class="btn btn-danger" @click="$router.push('/')">
            Regresar
          </button>
        </div>
      </div>
      <hr />
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Email</th>
            <th>Administrador</th>
            <th>Contraseña</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" v-bind:key="user.name">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>
              <!-- Checkbox in row -->
              <input
                type="checkbox"
                user="'user'"
                @click="sendInfo(user)"
                @change="changeRole(user)"
                v-model="user.role"
                true-value="adm"
              />
            </td>
            <td>
              <div class="row">
                <div class="offset-3"></div>
                <div class="col-md-6">
                  <button
                    user="'user'"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#changePassword"
                    @click="sendInfo(user)"
                    v-b-modal="'myModal'"
                    v-show="'isModalVisible'"
                  >
                    Cambiar
                  </button>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div
        id="changePassword"
        class="modal fade"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header justify-content-center">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
              <img src="../../assets/espe-sede-Latacunga.png" width="300" height="auto">
                &times;
              </button>
            </div>
            <div class="modal-body" style="font-family:Roboto; font-size:26px">
              <h2>Cambiar contraseña de <u>{{ selectedUser.name }}</u></h2>
              <div class="card-body">
                <div class="alert alert-danger" v-if="has_error && !success">
                  <p v-if="error == 'login_error'">Validation Errors.</p>
                  <p v-else>Error, revise sus credenciales.</p>
                </div>
                <form
                  autocomplete="off"
                  @submit.prevent="adminpassword"
                  onsubmit="closeModal()"
                  v-if="!success"
                  method="post"
                >
                  <div
                    class="form-group"
                    v-bind:class="{
                      'has-error': has_error && errors.password,
                    }"
                  >
                    <label style="color: black" for="password"
                      >Contraseña</label
                    >
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      v-model="password"
                    />
                    <span
                      class="help-block"
                      v-if="has_error && errors.password"
                      >{{ errors.password }}</span
                    >
                  </div>
                  <div
                    class="form-group"
                    v-bind:class="{
                      'has-error': has_error && errors.password,
                    }"
                  >
                    <label style="color: black" for="password_confirmation"
                      >Confirme su contraseña</label
                    >
                    <input
                      type="password"
                      id="password_confirmation"
                      class="form-control"
                      v-model="password_confirmation"
                    />
                  </div>
                  <button type="submit" class="btn btn-primary">
                    Cambiar contraseña
                  </button>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>

      <div
        id="registerUser"
        class="modal fade"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
              <img src="../../assets/espe-sede-Latacunga.png" width="300" height="auto">
                &times;
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body">
                <div class="alert alert-danger" v-if="has_error && !success">
                  <p v-if="error == 'registration_validation_error'">
                    Validation Errors.
                  </p>
                  <p v-else>
                    Error, no se pudo registrar su usuario. Si el problema
                    continua, contacte al administrador.
                  </p>
                </div>
                <form
                  autocomplete="off"
                  @submit.prevent="register"
                  onsubmit="closeModal()"
                  v-if="!success"
                  method="post"
                >
                  <div
                    class="form-group"
                    v-bind:class="{
                      'has-error': has_error && errors.name,
                    }"
                  >
                    <label style="color: black" for="name">Nombre</label>
                    <input
                      type="text"
                      id="name"
                      class="form-control"
                      placeholder="Nombre"
                      v-model="name"
                    />
                    <span class="help-block" v-if="has_error && errors.name">{{
                      errors.name
                    }}</span>
                  </div>
                  <div
                    class="form-group"
                    v-bind:class="{
                      'has-error': has_error && errors.email,
                    }"
                  >
                    <label style="color: black" for="email">E-mail</label>
                    <input
                      type="email"
                      id="email"
                      class="form-control"
                      placeholder="ejemplo@espe.edu.ec"
                      v-model="email"
                    />
                    <span class="help-block" v-if="has_error && errors.email">{{
                      errors.email
                    }}</span>
                  </div>
                  <div
                    class="form-group"
                    v-bind:class="{
                      'has-error': has_error && errors.password,
                    }"
                  >
                    <label style="color: black" for="password"
                      >Contraseña</label
                    >
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      v-model="password"
                    />
                    <span
                      class="help-block"
                      v-if="has_error && errors.password"
                      >{{ errors.password }}</span
                    >
                  </div>
                  <div
                    class="form-group"
                    v-bind:class="{
                      'has-error': has_error && errors.password,
                    }"
                  >
                    <label style="color: black" for="password_confirmation"
                      >Confirme su contraseña</label
                    >
                    <input
                      type="password"
                      id="password_confirmation"
                      class="form-control"
                      v-model="password_confirmation"
                    />
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>

<div>
 <div id="showSuccess" class="modal fade">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header justify-content-center">
              <div class="icon-box">
               <i class="fas fa-clipboard-check"></i>
              </div>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
              <img src="../../assets/espe-sede-Latacunga.png" width="300" height="auto">
                &times;
              </button>
            </div>
            <div class="modal-body text-center" style="font-family:Roboto; font-size:26px">
              <h4><b>Cambio exitoso!</b></h4>
              <p>La contraseña de <u>{{selectedUser.name}}</u> fue cambiada</p>
              <button class="btn btn-success" data-dismiss="modal">
                <span>Continuar</span>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div id="noPassword" class="modal fade">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header justify-content-center">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
              <img src="../../assets/espe-sede-Latacunga.png" width="300" height="auto">
                &times;
              </button>
            </div>
            <div class="modal-body text-center" style="font-family:Roboto; font-size:26px">
              <h4 style="font-color:red"><b>Error!</b></h4>
              <p>Revise que las contraseñas sean iguales</p>
              <button class="btn btn-danger" data-dismiss="modal">
                <span>Volver</span>
               
              </button>
            </div>
          </div>
        </div>
      </div>

      <div id="giveAdmin" class="modal fade">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header justify-content-center">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
              <img src="../../assets/espe-sede-Latacunga.png" width="300" height="auto">
                &times;
              </button>
            </div>
            <div class="modal-body text-center" style="font-family:Roboto; font-size:26px">
              <h4><b>Permisos de administrador concedidos!</b></h4>
              <p>El usuario <u>{{selectedUser.name}}</u> tiene permisos de administrador.</p>
              <button class="btn btn-success" data-dismiss="modal">
                <span>Volver</span>

              </button>
            </div>
          </div>
        </div>
      </div>

      <div id="retireAdmin" class="modal fade">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header justify-content-center">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
              <img src="../../assets/espe-sede-Latacunga.png" width="300" height="auto">
                &times;
              </button>
            </div>
            <div class="modal-body text-center" style="font-family:Roboto; font-size:26px">
              <h4><b>Permisos de administrador retirados!</b></h4>
              <p>Los permisos de administrador de <u>{{selectedUser.name}}</u> han sido retirados.</p>
              <button class="btn btn-danger" data-dismiss="modal">
                <span>Volver</span>

              </button>
            </div>
          </div>
        </div>
      </div>

    </div>

     
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      users: undefined,
      role: "",
      selectedUser: "",
      name: "",
      password: "",
      email: "",
      password_confirmation: "",
      has_error: false,
      error: "",
      success: undefined,
      errors: {},
      isModalVisible: false,
    };
  },
  mounted() {
    axios
      .get(`${window.location.origin}/api/v1/auth/user`)
      .then((res) => {
        this.role = res.data.data.role;
        console.log(res.data.data.role);
      })
      .then(() => {
        if (this.role === "adm") {
          axios
            .get(`${window.location.origin}/api/v1/auth/listusers`)
            .then((res) => {
              this.users = res.data.data;
              console.log(this.users);
              console.log(res.data.data);
            });
          console.log("admin");
        }
      });

    axios.get(`${window.location.origin}/api/v1/auth/listusers`).then((res) => {
      this.users = res.data.data;
    });
    console.log("admin");
  },
  methods: {
    sendInfo(user) {
      this.selectedUser = user;
      console.log(user);
    },
    adminpassword() {
      var app = this;

      console.log("Trying : " + app.name + " + " + app.password);
      //console.log(app.password);
      this.name = this.selectedUser.name;
      console.log(this.$auth);
      if (app.password === app.password_confirmation) {
        if (this.role === "adm") {
          axios;

          axios
            .post(`${window.location.origin}/api/v1/auth/adminpassword`, {
              name: this.selectedUser.name,
              password: this.password,
            })
            .then((res) => {
              console.log("Try changed");
              console.log("Trying : " + app.name + " + " + app.password);
              $("#changePassword").modal("hide");
              $("#showSuccess").modal("show");
              $("#password").value="";
              $("#password_confirmation").value="";
            });
        } else {
          app.has_error = true;
          app.error = res.response.data.error;
          app.errors = res.response.data.errors || {};
        }
        app.password = "";
        app.password_confirmation = "";
      } else {
        $("#changePassword").modal("hide");
        $("#noPassword").modal("show");
      }
    },

    register() {
      var app = this;
      this.$auth.register({
        data: {
          name: app.name,
          email: app.email,
          password: app.password,
          password_confirmation: app.password_confirmation,
          role: "user",
        },
        success: function () {
          app.success = true;
          this.$router.push("admin");
          router.push("");
          
        },
        error: function (res) {
          app.has_error = true;
          app.error = res.response.data.error;
          app.errors = res.response.data.errors || {};
        },
      });
      router.push("admin");
    },

    changeRole(user) {
      console.log(user);
      console.log(user.role);
      var UserRole = user.role;
      console.log(UserRole);
      if (UserRole != "adm") {
        console.log("Quitar permiso");
        axios;

        axios
          .post(`${window.location.origin}/api/v1/auth/requestadmin`, {
            name: user.name,
            role: "user",
          })
          .then((res) => {
            console.log("User set");
            $("#retireAdmin").modal("show");
          });
      } else {
        console.log("Dar permiso");
        axios
          .post(`${window.location.origin}/api/v1/auth/requestadmin`, {
            name: user.name,
            role: "adm",
          })
          .then((res) => {
            console.log("Admin set");
            $("#giveAdmin").modal("show");
          });
      }

      console.log("Change role");
      console.log(user);
      console.log(user.role);
    },

  },
};
</script>
<!--style>
.container-fluid {
  background-image: url("../../assets/latacunga-fachada.jpg");
  background-repeat: no-repeat;
  background-size: 120%;
  min-height: 100%; 
  height: 100%;
  position: fixed;
}
</style-->
