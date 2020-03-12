<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <img src="../../assets/Espe-Latacunga.png" alt="background image" class="emg">
            </div>
            <div class="col-md-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <img src="../../assets/espe-sede-Latacunga.png" alt="espe extencion latacunga" class="col-md-9 log">
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form autocomplete="off" @submit.prevent="login" method="post">
                                <div class="form-group">
                                    <label for="name">Nombre de Usuario</label>
                                    <input type="text" id="name" class="form-control" placeholder="usuario" v-model="name" required>
                                </div>
                                <div class="form-group contq">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control" v-model="password" placeholder="contraseña" required>
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
                    fetchUser: true
                })
            }
        }
    };
</script>