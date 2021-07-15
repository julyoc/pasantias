<template>
    <div class="container-fluid" style="padding-top: 20px;">
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
                <span
                    class="glyphicon glyphicon-ok-sign"
                    aria-hidden="true"
                ></span>
                <span class="sr-only">Success:</span>
                Tiene el permiso para ingresar a esta página
                <!-- Show only the names of the users from a list -->
            </div>
            <!-- Vue table that iterates over a list of users -->
            <div class="row">
                <div class="col-md-6">
                    <button
                        @click="showModal"
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
            <hr>
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
                    <tr v-for="user in users">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td></td>
                        <td>
                            <div class="row">
                                <div class="offset-3"></div>
                                <div class="col-md-6">
                                    <button
                                        user="'user'"
                                        class="btn btn-primary"
                                        data-toggle="modal"
                                        data-target="#staticBackdrop"
                                        @click="sendInfo(user)"
                                        v-b-modal="'myModal'"
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
                id="staticBackdrop"
                class="modal fade"
                data-backdrop="static"
                data-keyboard="false"
                tabindex="-1"
                aria-labelledby="staticBackdropLabel"
                aria-hidden="true"
                v-show="isModalVisible"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button
                                type="button"
                                class="close color-black"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h2>
                                Cambiar contraseña de {{ selectedUser.name }}
                            </h2>
                            <div class="card-body">
                                <div
                                    class="alert alert-danger"
                                    v-if="has_error && !success"
                                >
                                    <p v-if="error == 'login_error'">
                                        Validation Errors.
                                    </p>
                                    <p v-else>
                                        Error, revise sus credenciales.
                                    </p>
                                </div>
                                <form
                                    autocomplete="off"
                                    @submit.prevent="adminpassword"
                                    method="post"
                                >
                                    <div
                                        class="form-group"
                                        v-bind:class="{
                                            'has-error':
                                                has_error && errors.password
                                        }"
                                    >
                                        <label
                                            style="color:black"
                                            for="password"
                                            >Ingrese la nueva contraseña</label
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
                                            'has-error':
                                                has_error && errors.password
                                        }"
                                    >
                                        <label
                                            style="color:black"
                                            for="password_confirmation"
                                            >Confirme su contraseña</label
                                        >
                                        <input
                                            type="password"
                                            id="password_confirmation"
                                            class="form-control"
                                            v-model="password_confirmation"
                                        />
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        data-dismiss="modal"
                                    >
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
                                class="close color-black"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div
                                    class="alert alert-danger"
                                    v-if="has_error && !success"
                                >
                                    <p
                                        v-if="
                                            error ==
                                                'registration_validation_error'
                                        "
                                    >
                                        Validation Errors.
                                    </p>
                                    <p v-else>
                                        Error, no se pudo registrar su usuario.
                                        Si el problema continua, contacte al
                                        administrador.
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
                                            'has-error':
                                                has_error && errors.name
                                        }"
                                    >
                                        <label style="color:black" for="name"
                                            >Nombre</label
                                        >
                                        <input
                                            type="text"
                                            id="name"
                                            class="form-control"
                                            placeholder="Nombre"
                                            v-model="name"
                                        />
                                        <span
                                            class="help-block"
                                            v-if="has_error && errors.name"
                                            >{{ errors.name }}</span
                                        >
                                    </div>
                                    <div
                                        class="form-group"
                                        v-bind:class="{
                                            'has-error':
                                                has_error && errors.email
                                        }"
                                    >
                                        <label style="color:black" for="email"
                                            >E-mail</label
                                        >
                                        <input
                                            type="email"
                                            id="email"
                                            class="form-control"
                                            placeholder="ejemplo@espe.edu.ec"
                                            v-model="email"
                                        />
                                        <span
                                            class="help-block"
                                            v-if="has_error && errors.email"
                                            >{{ errors.email }}</span
                                        >
                                    </div>
                                    <div
                                        class="form-group"
                                        v-bind:class="{
                                            'has-error':
                                                has_error && errors.password
                                        }"
                                    >
                                        <label
                                            style="color:black"
                                            for="password"
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
                                            'has-error':
                                                has_error && errors.password
                                        }"
                                    >
                                        <label
                                            style="color:black"
                                            for="password_confirmation"
                                            >Confirme su contraseña</label
                                        >
                                        <input
                                            type="password"
                                            id="password_confirmation"
                                            class="form-control"
                                            v-model="password_confirmation"
                                        />
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Submit
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
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            users: undefined,
            role: undefined,
            selectedUser: "",
            name: "",
            password: "",
            password_confirmation: "",
            has_error: false,
            error: "",
            errors: {},
            isModalVisible: false
        };
    },
    mounted() {
        axios
            .get(`${window.location.origin}/api/v1/auth/user`)
            .then(res => {
                this.role = res.data.data.role;
                console.log(res.data.data.role);
                console.log(this.items.doc);
            })
            .then(() => {
                if (this.role === "adm") {
                    axios
                        .get(`${window.location.origin}/api/v1/auth/listusers`)
                        .then(res => {
                            this.users = res.data.data;
                            console.log(res.data.data);
                        });
                    console.log("admin");
                }
            });

        axios
            .get(`${window.location.origin}/api/v1/auth/listusers`)
            .then(res => {
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
            if (this.role === "adm") {
                axios;

                axios
                    .post(
                        `${window.location.origin}/api/v1/auth/adminpassword`,
                        {
                            name: this.selectedUser.name,
                            password: this.password
                        }
                    )
                    .then(res => {
                        console.log("Try changed");
                        console.log(
                            "Trying : " + app.name + " + " + app.password
                        );
                    });
            } else {
                app.has_error = true;
                app.error = res.response.data.error;
                app.errors = res.response.data.errors || {};
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
                    role: app.role
                },
                success: function() {
                    app.success = true;
                    this.$router.push("admin");
                    router.push("");
                },
                error: function(res) {
                    app.has_error = true;
                    app.error = res.response.data.error;
                    app.errors = res.response.data.errors || {};
                }
            });
            router.push("admin");
        },
        showModal() {
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        }
    }
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
