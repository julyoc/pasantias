<template>
    <div class="container-fluid">
        <Header-1></Header-1>
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="offset-1"></div>
                    <div class="col-md">
                        <img
                            src="../../assets/Moodle-chapeau_Grande.png"
                            alt="moodle"
                            class="im"
                        />
                    </div>
                    <br />
                </div>
                
                <hr />
                <div class="row">
                    <div class="offset-3"></div>
                    <div class="col-md-6">
                        <Sidenav></Sidenav>
                    </div>
                </div>

            </div>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col">
                                <img
                                    src="../../assets/img1.png"
                                    class="img-fluid"
                                    alt="img1"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <img
                                    src="../../assets/img2.png"
                                    class="img-fluid"
                                    width="94.5%"
                                    alt="img2"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-6 tl">
                        <img
                            src="../../assets/img3.png"
                            class="img-fluid"
                            width="86%"
                            alt="img3"
                        />
                    </div>
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
import Sidenav from './sidenav.vue';
export default {
    token: localStorage.getItem("laravel-jwt-auth"),
    //console.log(this.token),
    //tok:(token.toString()),
    al: String("qwerty"),
    moodle: "http://moodleltga.espe.edu.ec/moodle/login/index.php/",
    data() {
        return {
            /*items: {
                alu: [
                    {
                        name: "Moodle Ingenierias",
                        url: "" + localStorage.getItem("laravel-jwt-auth")
                    }
                ],
                doc: [
                    {
                        name: "SG-RAD",
                        url:
                            "http://localhost/sg-rad/index.php?r=site/login&token=" +
                            localStorage.getItem("laravel-jwt-auth")
                    }
                ],
                tics: [
                    {
                        name: "OTRS",
                        url:
                            "http://localhost:4200/otrs/" +
                            localStorage.getItem("laravel-jwt-auth")
                    }
                ],
                fin: [
                    {
                        name: "Sistema Financiero",
                        url:
                            "http://localhost:4200/comprobantes/" +
                            localStorage.getItem("laravel-jwt-auth")
                    }
                ],
                admin: [
                    {
                        name: "Biblioteca",
                        url:
                            "http://localhost:4200/record/" +
                            localStorage.getItem("laravel-jwt-auth")
                    }
                ],
                lab: [
                    {
                        name: "SG-Telefonia",
                        url:
                            "http://localhost/sg-telefonia/index.php?r=site/login&token=" +
                            localStorage.getItem("laravel-jwt-auth")
                    }
                ]
            }*/
        };
    },
    components: {
        Header1,
        Sidenav
    },
    mounted() {
        console.log(this.token),
            console.log("data" + localStorage.getItem("laravel-jwt-auth"));
        localStorage.setItem("userInfo", JSON.stringify("laravel-jwt-auth"));
        axios.get(`${window.location.origin}/api/v1/auth/user`).then(res => {
            this.role = res.data.data.role;
            console.log(res.data.data.role);
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
