<template>
    <div class="container">
        <div class="row">
            <div class="card-panel col s6 offset-s3 z-depth-1">
                <h3 class="center">
                    Code Finances
                </h3>
                <div class="row" v-if="error.error">
                    <div class="col s12">
                        <div class="card-panel red">
                            <span class="white-text">{{error.message}}</span>
                        </div>
                    </div>
                </div>
                <form method="POST" @submit.prevent="login()">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" name="email" v-model="user.email" required autofocus>
                            <label for="email" class="active">E-Mail</label> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" class="validate" v-model="user.password" required>
                            <label for="password" class="active">Senha</label> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn">Login</button>
                        </div>
                    </div>
                </form>        
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import store from '../store/store';
    //import Auth from '../services/auth'; 
    
    export default {
        data() {
            return {
                user: {
                    email: '',
                    password: ''
                },
                error: {
                    error: false,
                    message: ''
                }
            }
        },
        methods: {
            login() {
                store.dispatch('login', this.user)
                    .then(() => this.$router.go({name: 'dashboard'}))
                    .catch((responseError) => {
                        console.log(responseError);
                        switch (responseError.status){
                            case 401:
                                this.error.message = responseError.data.message;
                                break;
                            default:
                                this.error.message = "Login FAILED";
                        }
                        this.error.error = true;
                    })
            }
        }
    }

</script>