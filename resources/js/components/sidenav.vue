<!-- add: https://www.w3schools.com/howto/howto_js_sticky_header.asp -->

<template>
    <div>
        <div class="sidenav">
            <ul class="default-responsive-navlinks">
                <div class="row">
                    <div class="offset-3"></div>
                    <div class="col-md-6">
                        <router-link to="/">sorbet</router-link>
                    </div>
                </div>

                <hr />
                <div class="row">
                    <div class="offset-3"></div>
                    <div class="col-md-6">
                        <router-link to="/alumno.vue">about</router-link>
                    </div>
                </div>
                <hr />
                <li>
                    <router-link to="/Portfolio.vue">portfolio</router-link>
                </li>
                <li>
                    <router-link to="/Contact.vue">contact</router-link>
                </li>
                <li>
                    <router-link to="/misc.vue">misc</router-link>
                </li>
            </ul>
        </div>

        <div class="routerview">
            <router-view />
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    data() {
        return {};
    },
    methods: {}
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
