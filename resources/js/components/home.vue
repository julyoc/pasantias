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
                            <div class="alert alert-danger" v-if="has_error && !success">
                                <p v-if="error == 'login_error'">Error de validacion.</p>
                                <p v-else>Error, correo o contraseña incorrectos.</p>
                            </div>
                            <form autocomplete="off" @submit.prevent="login" method="post">
                                <div class="form-group">
                                    <label for="name" style="color:black" >Nombre de Usuario</label>
                                    <input type="name" id="name" class="form-control" placeholder="Usuario" v-model="name" required>
                                </div>
                                <div class="form-group contq">
                                    <label for="password" style="color:black" >Contraseña</label>
                                    <input type="password" id="password" class="form-control" v-model="password" placeholder="Contraseña" required>
                                </div>
                                <br>
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
const zxcvbn = require('zxcvbn');
    export default {
        data() {
            return {
                name: null,
                password: null,
                success: false,
                has_error: false,
                error: ''
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
                    name: app.name,
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
                    fetchUser: true,
                    
                })
            },
            computed: {
                        passwordStrength(){
                            return zxcvbn( this.form.password );
                        }
                    },
        }
        
    };
</script>