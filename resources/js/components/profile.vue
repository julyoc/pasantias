<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <div class="card card-default">
                    <div class="card-header">Cambiar contraseña</div>
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
                            @submit.prevent="updatepass"
                            method="post"
                        >
                            <div
                                class="form-group"
                                v-bind:class="{
                                    'has-error': has_error && errors.password
                                }"
                            >
                                <label style="color:black" for="password"
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
                                    'has-error': has_error && errors.password
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
                            <button type="submit" class="btn btn-primary">
                                Change Password
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
            password: "",
            password_confirmation: "",
            has_error: false,
            error: "",
            errors: {}
        };
    },

    methods: {
        updatepass() {
            var app = this;
            console.log("Trying : " + app.password + " hachi");
            //console.log(app.password);
            console.log(this.$auth);
            if (this.password === this.password_confirmation) {
                axios
                    .get(`${window.location.origin}/api/v1/auth/user`)
                    .then(res => {
                        this.role = res.data.data.name;
                        console.log(res.data.data.name);
                        axios
                            .post(
                                `${window.location.origin}/api/v1/auth/updatepass`,
                                {
                                    password: this.password
                                }
                            )
                            .then(res => {
                                console.log("Try changed");
                                this.$auth.logout();
                            });
                        d;
                    });
            } else {
                app.has_error = true;
                app.error = res.response.data.error;
                app.errors = res.response.data.errors || {};
            }
        }
    }
};
</script>
