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

            <div class="get-payload-container">
                <button @click="getPayload">Get Payload</button>
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
                let este = this
                // console.log(codigo)
                axios.post('/api/login', {
                    code: codigo
                })
                    .then(function (response) {
                        // console.log(response.data);
                        // console.log(este.parseJwt(response.data))

                        // let jwtDecode = este.parseJwt(response.data)
                        // let secToExpire = jwtDecode.exp - jwtDecode.iat
                        // let msToExpire = secToExpire*1000
                        // let actualDate = new Date
                        // let expDate = new Date(actualDate.getTime() + msToExpire)
                        // console.log(expDate)
                        // console.log(expDate.toUTCString())

                        let expDate = este.getExpDate(response.data)
                        console.log(expDate)
                        document.cookie = `jwt=${response.data}; expires=${expDate}; path=/`;
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
            },
            getPayload(){
                axios.get('/api/getpayload')
                    .then(function (response) {
                        // handle success
                        console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log('HOla')
                        // console.dir(error);
                        console.dir(error.response);
                    })
                    .then(function () {
                        // always executed
                    });
            },

            parseJwt (token){
                var base64Url = token.split('.')[1];
                var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));

                return JSON.parse(jsonPayload);
            },

            getExpDate(token){ // Expiration
                let base64Url = token.split('.')[1];
                let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));

                let parsed =  JSON.parse(jsonPayload);

                let secToExpire = parsed.exp - parsed.iat
                let msToExpire = secToExpire*1000
                let actualDate = new Date
                let expDate = new Date(actualDate.getTime() + msToExpire)

                return expDate.toUTCString()
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
