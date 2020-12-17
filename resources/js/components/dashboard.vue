<template>
    <div class="container-fluid">
        <Header-1></Header-1>
        <div class="row">
          <div class="col-md-3">
            <div class="row">
              <div class="offset-1"></div>
              <div class="col-md">
              <img src="../../assets/Moodle-chapeau_Grande.png" alt="moodle" class="im">
              </div>
              <br>
            </div>
            <div class="row">
              <br>
              <div class="offset-3"></div>
              <div class="col-md-6">
              <button class="btn btn-link" onclick="location.href='http://moodleltga.espe.edu.ec/moodle/login/index.php'">Moodle Ingenieria</button><hr><button class="btn btn-link" data-toggle="modal">Moodle Tecnologias</button>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="offset-3"></div>
              <div class="col-md-6">
              <button class="btn btn-link" data-toggle="modal" data-target="#staticBackdrop" :disabled="role != 'doc'">Docente</button>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="offset-3"></div>
              <div class="col-md-6">
              <button class="btn btn-link" data-toggle="modal" data-target="#staticBackdrop" :disabled="role != 'tics'">Utics</button>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="offset-3"></div>
              <div class="col-md-6">
              <button class="btn btn-link" data-toggle="modal" data-target="#staticBackdrop" :disabled="role != 'fin'">Financiero</button>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="offset-3"></div>
              <div class="col-md-6">
              <button class="btn btn-link" data-toggle="modal" data-target="#staticBackdrop" :disabled="role != 'admin'">Administrativo</button>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="offset-3"></div>
              <div class="col-md-6">
              <button class="btn btn-link" data-toggle="modal" data-target="#staticBackdrop" :disabled="role != 'lab'">Laboratorios</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="row">
              <div class="col-6">
                <div class="row">
                  <div class="col">
                    <img src="../../assets/img1.png" class="img-fluid" alt="img1">
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <img src="../../assets/img2.png" class="img-fluid" width="94.5%" alt="img2">
                  </div>
                </div>
              </div>
              <div class="col-6 tl">
                <img src="../../assets/img3.png" class="img-fluid" width="86%" alt="img3">
              </div>
            </div>
          </div>
        </div>
        <div id="staticBackdrop" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{role === 'alu'? 'Alumno': role === 'doc'? 'Docente': role === 'tics'? 'UTics': role === 'fin'? 'Financiero' : role === 'admin'? 'Administrativo': 'Laboratorios'}}</h5>
                <button type="button" class="close color-black" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" v-if="role == 'alu'"></div>
              <div class="modal-body" v-if="role == 'doc'"></div>
              <div class="modal-body" v-if="role == 'tics'"></div>
              <div class="modal-body" v-if="role == 'fin'"></div>
              <div class="modal-body" v-if="role == 'admin'"></div>
              <div class="modal-body" v-if="role == 'lab'"></div>
              <div class="modal-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item" v-for="itm in items[role]">
                    <a :href="itm.url">{{itm.name}}</a>
                  </li>
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import Header1 from '../lib/header1.vue';
  import 'jquery';
  import 'popper.js';
  import 'bootstrap';
  export default {
    data() {
      return {
        jwt: localStorage.getItem('laravel-jwt-auth'),
        role: undefined,
        items: {
          alu: [{}],
          doc: [{name:'SG-RAD', url:"#"}],
          tics: [{name:'OTRS', url:"#"}],
          fin: [{name:'Sistema Financiero',url:"#"}],
          admin: [{name: 'Biblioteca', url: '#'}, {name: 'Unidad de admisión y registro', url: '#'}],
          lab: [{name:'SG-RAD',url:"#"}]
        }
      }
    },
    components: {
        Header1
    },
    mounted() {
        console.log(localStorage.getItem('laravel-jwt-auth'));
        localStorage.setItem('userInfo',JSON.stringify('laravel-jwt-auth'))
        axios.get(`${window.location.origin}/api/v1/auth/user`).then(res => {
          this.role = res.data.data.role; 
          console.log(res.data.data.role);
        });
    }
  }
</script>

<style>
.im {
  height: 7em;
}
div {
  text-align: center;
  padding: 0;
}
.tl {
  text-align: left;
}
.color-black{
  color: black;
}
</style>
