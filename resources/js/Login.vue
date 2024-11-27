<template>

    <div v-if="!token" class="row">

        <div class="col-sm-4">
            <h2 align="center"> Login</h2>

            <form @submit.prevent="login">


                <div class="form-group" align="left">
                    <label>Email</label>
                    <input type="email" v-model="email" class="form-control" placeholder="Email">
                </div>


                <div class="form-group" align="left">
                    <label>Password</label>
                    <input type="password" v-model="password" class="form-control" placeholder="Password">
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
    <div v-if="token">
        <BreweriesList :token=token />
    </div>
</template>

<script>
import axios from 'axios';
import BreweriesList from './BreweriesList.vue';

export default {
    name: 'Login',
    components: {
        BreweriesList,
    },
    data() {
        return {
            token: null,
            email: '',
            password: ''
        }

    },
    created() {
    },
    methods: {
        login() {
            axios.post("http://127.0.0.1:8000/api/login", { email: this.email, password: this.password })
                .then(
                    ({ data }) => {
                        try {
                            if (data.token) {
                                this.token = data.token;
                            } else {
                                alert("Login failed")
                            }

                        } catch (err) {
                            alert("Error, please try again");
                        }
                    }
                )
        }
    }
}
</script>
