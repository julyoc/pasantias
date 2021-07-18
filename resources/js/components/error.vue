<!-- vue hello world -->
<template>
    <div class="container">
        <hr />
        <div class="row">
            <hr />
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Si es que ve esta página de manera incorrecta,
                            contacte al administrador
                        </h3>
                    </div>
                    <div class="panel-body centered">
                        <div class="alert alert-danger" role="alert">
                            <strong>Error!</strong>
                            <p v-bind:value="[user, resource]">
                                {{ user.name }} no tiene acceso para el recurso
                                {{ resource }}
                            </p>
                            <img
                                v-if="resource === 'sg-rad'"
                                src="../../assets/sg-rad.png"
                            />
                            <img
                                v-if="resource === 'sg-otrs'"
                                src="../../assets/sg-otrs.png"
                            />
                            <img
                                v-if="resource === 'sg-ecp'"
                                src="../../assets/sg-ecp.png"
                            />
                            <img
                                v-if="resource === 'sg-tel'"
                                src="../../assets/sg-tel.png"
                            />
                            <img
                                v-if="resource === 'sg-fin'"
                                src="../../assets/sg-fin.png"
                            />
                            <img
                                v-if="resource === 'sg-uec'"
                                src="../../assets/sg-uec.png"
                            />
                            <img
                                v-if="resource === 'sg-ri'"
                                src="../../assets/sg-ri.png"
                            />
                        </div>
                        
                        <strong> Redirigiendo a la página de inicio...</strong>
<hr>
                        <div class="col" style="text-align:center" >
                            <button
                                class="btn btn-danger centered"
                                @click="$router.push('/')"
                            >
                                Volver a la página de inicio
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
    token: localStorage.getItem("laravel-jwt-auth"),

    name: "error",
    data() {
        return {
            message: "",
            user: undefined,
            resource: this.$route.params.resource,
            items: {
                sgrad: "../../assets/sg-rad.png",
                otrs: "../../assets/otrs.png",
                fin: "../../assets/sg-fin.png",
                ecp: "../../assets/sg-ecp.png",
                telefonia: "../../assets/sg-tel.png",
                reporteshistoricos: "../../assets/sg-ri.png",
                educacioncontinua: "../../assets/sg-uec.png"
            }
        };
    },
    mounted() {
        console.log(this.token);
        console.log;
        localStorage.setItem("userInfo", JSON.stringify("laravel-jwt-auth"));
        axios.get(`${window.location.origin}/api/v1/auth/user`).then(res => {
            this.user = res.data.data;
            console.log(this.user);
        });
        console.log(this.resource);
        this.interval = setInterval(
            function() {
                this.$router.push({ path: "/" });
            }.bind(this),
            10000
        );
    },

    methods: {
        //Timeout in seconds
    }
};
</script>
```
