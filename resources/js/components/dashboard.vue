<template>
    <div class="container-fluid">
        <Header-1></Header-1>
        <div class="container">
            
            <div class="row">
                <div class="col-md-4">
                    <a :href="this.items.sgrad">
                        <div class="card">
                            <div class="card-header">
                                <img
                                    class="card-img-top"
                                    src="../../assets/sg-ecp.png"
                                />
                            </div>
                        </div>
                    </a>
                </div>
                <hr />

                <div class="col-md-4">
                    <a :href="this.items.otrs">
                        <div class="card">
                            <div class="card-header">
                                <img
                                    class="card-img-top"
                                    src="../../assets/sg-otrs.png"
                                />
                            </div>
                        </div>
                    </a>
                </div>
                <hr />
                <div class="col-md-4">
                    <a :href="this.items.ecp">
                        <div class="card">
                            <div class="card-header">
                                <img
                                    class="card-img-top"
                                    src="../../assets/sg-ecp.png"
                                />
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-4">
                    <a :href="this.items.telefonia">
                        <div class="card">
                            <div class="card-header">
                                <img
                                    class="card-img-top"
                                    src="../../assets/sg-tel.png"
                                />
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a :href="this.items.fin">
                        <div class="card">
                            <div class="card-header">
                                <img
                                    class="card-img-top"
                                    src="../../assets/sg-fin.png"
                                />
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a :href="this.items.educacioncontinua">
                        <div class="card">
                            <div class="card-header">
                                <img
                                    class="card-img-top"
                                    src="../../assets/sg-uec.png"
                                />
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <hr />
            <div class="row" style="justify-content: center">
                <div class="col-md-4">
                    <a :href="this.items.reporteshistoricos">
                        <div class="card">
                            <div class="card-header">
                                <img
                                    class="card-img-top"
                                    src="../../assets/sg-ri.png"
                                />
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import Header1 from "../lib/header1.vue";
import "jquery";
import "popper.js";
import "bootstrap";

export default {
    token: localStorage.getItem("laravel-jwt-auth"),
    //console.log(this.token),
    //tok:(token.toString()),
    al: String("qwerty"),
    moodle: "http://moodleltga.espe.edu.ec/moodle/login/index.php/",
    data() {
        return {
            jwt: localStorage.getItem("laravel-jwt-auth"),
            moodle:
                "http://moodleltga.espe.edu.ec/moodle/" +
                localStorage.getItem("laravel-jwt-auth"),
            role: undefined,
            /*items: {
          alu: [{name:'Moodle Ingenierias', url:""+((localStorage.getItem('laravel-jwt-auth')))}],
          doc: [{name:'SG-RAD', url:"http://webltga.espe.edu.ec/sg-rad/"+((localStorage.getItem('laravel-jwt-auth')))}],
          tics: [{name:'OTRS', url:"http://espel.espe.edu.ec/otrs/index.pl/"+((localStorage.getItem('laravel-jwt-auth')))}],
          fin: [{name:'Sistema Financiero',url:"http://webltga.espe.edu.ec/comprobantes/"+((localStorage.getItem('laravel-jwt-auth')))}],
          admin: [{name: 'Biblioteca', url: "http://webltga.espe.edu.ec/record/app/acceso.php/"+((localStorage.getItem('laravel-jwt-auth')))}],
          lab: [{name:'SG-RAD',url:"http://webltga.espe.edu.ec/sg-lab/"+((localStorage.getItem('laravel-jwt-auth')))}]
        }*/
            items: {
                sgrad:
                    "http://webltga.espe.edu.ec/sg-rad/index.php?r=site/login&token=" +
                    localStorage.getItem("laravel-jwt-auth"),
                otrs:
                    "http://webltga.espe.edu.ec/sg-otrs/index.php?r=site/login&token=" +
                    localStorage.getItem("laravel-jwt-auth"),

                fin:
                    "http://webltga.espe.edu.ec/comprobantes/index.php?r=site/login&token=" +
                    localStorage.getItem("laravel-jwt-auth"),

                ecp:
                    "http://webltga.espe.edu.ec/sg-ecp/index.php?r=site/login&token=" +
                    localStorage.getItem("laravel-jwt-auth"),

                telefonia:
                    "http://webltga.espe.edu.ec/sg-telefonia/index.php?r=site/login&token=" +
                    localStorage.getItem("laravel-jwt-auth"),
                reporteshistoricos:
                    "http://webltga.espe.edu.ec/sg-ri/index.php?r=site/login&token=" +
                    localStorage.getItem("laravel-jwt-auth"),
                educacioncontinua:
                    "http://webltga.espe.edu.ec/sg-uec/index.php?r=site/login&token=" +
                    localStorage.getItem("laravel-jwt-auth")
            }
        };
    },
    components: {
        Header1
    },
    mounted() {
        console.log(this.token),
            console.log("data" + localStorage.getItem("laravel-jwt-auth"));
        localStorage.setItem("userInfo", JSON.stringify("laravel-jwt-auth"));
        axios.get(`${window.location.origin}/api/v1/auth/user`).then(res => {
            this.role = res.data.data.role;
            console.log(res.data.data.role);
            console.log(this.items.doc);
        });
    }
};
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
.color-black {
    color: black;
}
</style>
