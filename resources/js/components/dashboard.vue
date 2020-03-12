<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                User Dashboard
                {{jwt}}
            </div>
            <div id="logout" class="form-group">
          <button v-on:click="logout">Logout!</button>
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
    methods: {
    logout(){
      var redirect = this.$auth.redirect()
                var app = this
                this.$auth.logout();
    }         
  },
    mounted() {
        console.log(localStorage.getItem('laravel-jwt-auth'));
    }
    
  }
</script>