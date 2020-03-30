<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 recpass">
                <form @submit="recuperar">
                    <div class="form-group">
                        <label for=""><strong>Correo Institucional</strong></label>
                        <input type="email" name="correo" class="form-control" id="" required>
                    </div>
                    <div class="form-group">
                        <span>Su contraseña se enviaria a su correo institucional</span>
                    </div>
                    <div class="form-group ccc">
                        <input type="submit" class="btn btn-primary" value="Recuperar">
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</template>

<style>
    .recpass{
        background-color: #4e5152;
        border-radius: 0.25em;
    }
    label, span{
        color: white;
    }
    .ccc{
        text-align: center;
    }
</style>

<script>
export default {
    data() {
            return {
                info: ''
            }
    },
    mounted() {
        console.log('Component mounted.');
    },
    methods: {
        recuperar: () => {
            console.log('recuperar');
        }
    }
}
</script>