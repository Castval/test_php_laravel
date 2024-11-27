<template>
    <Login />
</template>

<script>
import Login from './Login.vue';

export default {
    components: {
        Login,
    },
    data() {
        return {
            timerCount: 10,
            condition: null,
        }
    },
    methods: {
        test(value, color) {

        },
    },
    created() {

    },


};
</script>
