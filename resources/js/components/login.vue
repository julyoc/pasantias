<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <div class="card card-default">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div
                            class="alert alert-danger"
                            v-if="has_error && !success"
                        >
                            <p v-if="error == 'login_error'">
                                Validation Errors.
                            </p>
                            <p v-else>Error, revise sus credenciales.</p>
                        </div>
                        <form
                            autocomplete="off"
                            @submit.prevent="login"
                            method="post"
                        >
                            <div class="form-group">
                                <label for="username">E-mail</label>
                                <input
                                    
                                    id="username"
                                    class="form-control"
                                    required
                                />
                            </div>
                            <div class="form-group contq">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    v-model="password"
                                    required
                                />
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Signin
                            </button>
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
            username: null,
            password: null,
            success: false,
            has_error: false,
            error: ""
        };
    },
    mounted() {
        //
    },
    methods: {
        login() {
            // get the redirect object
            var redirect = this.$auth.redirect();
            var app = this;
            this.$auth.login({
                data: {
                    username: app.username,
                    password: app.password
                },
                success: function() {
                    // handle redirection
                    app.success = true;
                    const redirectTo = "dashboard";
                    this.$router.push({ name: redirectTo });
                },
                error: function() {
                    app.has_error = true;
                    app.error = res.response.data.error;
                },
                rememberMe: true,
                fetchUser: true
            });
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
