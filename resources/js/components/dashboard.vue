<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                User Dashboard
                {{jwt}}
            </div>
        </div>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        jwt: localStorage.getItem('laravel-jwt-auth')
      }
    },
    components: {
      //
    },
    mounted() {
        console.log(localStorage.getItem('laravel-jwt-auth'));
    }
  }
</script>