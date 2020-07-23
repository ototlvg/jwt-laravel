<template>
    <div class="app">
        <div class="container">
            <div class="form-container">
                <label for="codigo">Code</label>
                <input type="text" name="" id="codigo" v-model="codigo">
                <button @click="getToken">Enviar</button>
            </div>
            <div class="check-container">
                <button @click="checkCookie">Check</button>
            </div>

            <div class="get-user-container">
                <button @click="getUser">Get User</button>
            </div>

        </div>

    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                codigo: null
            };
        },
        computed: {
        },
        created() {

        },
        mounted: function () {
            // console.log('Hola mundo')
        },
        methods: {
            getToken(){
                let codigo= this.codigo
                // console.log(codigo)
                axios.post('/api/login', {
                    code: codigo
                })
                    .then(function (response) {
                        console.log(response);
                        document.cookie = `jwt=${response.data}`;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            checkCookie(){
                axios.post('/api/check-cookie', {
                    ignorar: 'ignorar'
                })
                    .then(function (response) {
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getUser(){
                axios.get('/api/getuser')
                    .then(function (response) {
                        // handle success
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            }

        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
@import 'normalize';
body{
    margin: 0 !important;
}

p{
    margin: 0;
}
</style>
