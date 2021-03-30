<template>
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <div class="card card-default">
          <div class="card-header">Registrarse</div>
          <div class="card-body">
            <div class="alert alert-danger" v-if="has_error && !success">
                <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
                <p v-else>Error, no se pudo registrar su usuario. Si el problema continua, contacte al administrador.</p>
            </div>
            <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.name }">
                    <label style="color:black" for="name">Nombre</label>
                    <input type="text" id="name" class="form-control" placeholder="Nombre" v-model="name">
                    <span class="help-block" v-if="has_error && errors.name">{{ errors.name }}</span>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                    <label style="color:black" for="email">E-mail</label>
                    <input type="email" id="email" class="form-control" placeholder="ejemplo@espe.edu.ec" v-model="email">
                    <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                    <label style="color:black" for="password">Contraseña</label>
                    <input type="password" id="password" class="form-control" v-model="password">
                    <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                    <label style="color:black" for="password_confirmation">Confirme su contraseña</label>
                    <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation">
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.role }">
                  <label style="color:black" for="role">Rol</label>
                  <select class="custom-select" id="role" v-model="role">
                    <option value="alu">Alumno</option>
                    <option value="doc">Docente</option>
                    <option value="tics">TICs</option>
                    <option value="fin">Financier</option>
                    <option value="admin">Administrativo</option>
                    <option value="lab">Laboratorio</option>
                  </select>
                </div>

                <!--div class="form-group" v-bind:class="{ 'has-error': has_error && errors.role }">
                    <label style="color:black" for="role">Rol</label>
                    <input type="text" id="role" class="form-control" v-model="role">
                </div-->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        has_error: false,
        error: '',
        errors: {},
        success: false
      }
    },
    methods: {
      register() {
        var app = this
        this.$auth.register({
          data: {
            name: app.name,
            email: app.email,
            password: app.password,
            password_confirmation: app.password_confirmation,
            role: app.role
          },
          success: function () {
            app.success = true
            this.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
          },
          error: function (res) {
            app.has_error = true
            app.error = res.response.data.error
            app.errors = res.response.data.errors || {}
          }
        })
      }
    }
  }
</script>

<style>
<!--.container-fluid {
  background-image: url("../../assets/Espe-Latacunga.png");
  background-size: 100%;
  min-height: 100%; 
  height: 100%;
  position: fixed;
}-->
label {
  color: black;
}
</style>