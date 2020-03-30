<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                User Dashboard
                {{jwt}}
                <br>
                {{servicios}}
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  export default {
    data() {
      return {
        jwt: localStorage.getItem('laravel-jwt-auth'),
        servicios: undefined
      }
    },
    components: {
      //
    },
    mounted() {
        console.log(localStorage.getItem('laravel-jwt-auth'));
        axios.get(`${window.location.origin}/api/v2/serv`).then(res => this.servicios = res.data);
    }
  }
</script>