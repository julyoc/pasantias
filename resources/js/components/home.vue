<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <img src="../../assets/Espe-Latacunga.png" alt="Imagen de fondo" class="emg">
            </div>
            <div class="col-md-4 d-sm-none d-md-block">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <img src="../../assets/espe-sede-Latacunga.png" alt="ESPE Extensión Latacunga" class="col-md-9 log">
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form autocomplete="off" @submit.prevent="login" method="post">
                                <div class="form-group">
                                    <label for="email" style="color:black" >Nombre de Usuario</label>
                                    <input type="text" id="email" class="form-control" placeholder="Usuario" v-model="email" required>
                                </div>
                                <div class="form-group contq">
                                    <label for="password" style="color:black" >Contraseña</label>
                                    <input type="password" id="password" class="form-control" v-model="password" placeholder="Contraseña" required>
                                </div>
                                <br>
                                <div class="form-group ccc">
                                    <router-link to="/rec/pasword/1h1g1">Ha olvidado su contraseña?</router-link>
                                    <br><br>
                                    <router-link to="/register">Registrarse</router-link>
                                </div>
                                <div class="bbbtn">
                                    <button type="submit" class="btn btn-primary">Acceder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .emg{
        width: 99%;
    }
    .log{
        padding-top: 9em;
        padding-bottom: 4em;
        width: 100%;
    }
    .bbbtn{
        text-align: center;
        padding: 1em;
    }
    .contq{
        padding-top: 1em;
    }
    .ccc{
        text-align: center;
    }
</style>

<script>
    export default {
        data() {
            return {
                info: 'info gfdgfdgfd'
            }
        },
        mounted() {
            console.log('Component mounted.');
            tkn = JSON.parse(localStorage.getItem('laravel-jwt-auth')) | null;
            if (!tkn) this.$router.redirectTo('/dashboard')
        },
        methods: {
            login() {
                // get the redirect object
                var redirect = this.$auth.redirect()
                var app = this
                this.$auth.login({
                    data: {
                    email: app.email,
                    password: app.password
                    },
                    success: function() {
                        // handle redirection
                        app.success = true
                        const redirectTo = 'dashboard'
                        this.$router.push({name: redirectTo})
                    },
                    error: function() {
                        app.has_error = true
                        app.error = res.response.data.error
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            }
        }
    };
</script>