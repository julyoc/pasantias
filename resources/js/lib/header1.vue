<template>
  <nav class="navbar navbar-expand-lg navbar-ligth bg-ligth">
    <img src="../../assets/espe-sede-Latacunga.png" class="navbar-brand log" alt="espe latacunga">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto" v-if="$auth.check(1)">
          <li class="nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
            <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
          </li>
      </ul>
      <ul class="navbar-nav mr-auto" v-if="$auth.check(2)">
          <li class="nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
            <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
          </li>
      </ul>
      <ul class="navbar-nav ml-auto" v-if="!$auth.check()">
          <li class="nav-item" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
            <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
          </li>
      </ul>
      <ul class="navbar-nav ml-auto" v-if="$auth.check()">
        <li class="nav-item">
          <a class="nav-link" href="profile">Cambiar contraseña</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto" v-if="role === 'adm'">
        <li class="nav-item">
          <a class="nav-link" href="admin">Administrar usuarios</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto" v-if="$auth.check() ">
        <li class="nav-item">
          <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</template>
<script>
  export default {
    data() {
      return {
        role:undefined,
        routes: {
          // UNLOGGED
          unlogged: [
            { name: 'Register', path: 'register' },
            { name: 'Login', path: 'login'}
          ],
          // LOGGED USER
          user: [
            { name: 'Dashboard', path: 'dashboard' },
          ],
          // LOGGED ADMIN
          admin: [
            { name: 'Dashboard', path: 'admin.dashboard' }
          ]
        }
      }
    },
    mounted() {
      //
       axios.get(`${window.location.origin}/api/v1/auth/user`).then(res => {
            this.role = res.data.data.role;
            console.log(res.data.data.role);
        });
    }
  }
</script>
<style>
.navbar {
  margin-bottom: 30px;
}
.log{
        padding-top: 1em;
        padding-bottom: 1em;
        width: 15em;
}
nav {
  border-bottom: 1px solid #a5a5a5ca;
}
</style>