<template>
    <h2 align="center"> Breweries List</h2>

    <ul v-for="item in breweries">
        <li> {{ item.name }}</li>
    </ul>

</template>

<script>
import axios from 'axios';

export default {
    name: 'BreweriesList',
    data() {
        return {
            breweries: [],
        }
    },
    props: {
        token: {
            required: true,
            type: String,
        },
    },
    created() {
        axios.defaults.headers.common = { 'Authorization': `Bearer ${this.token}` }
        this.getBrewery();
    },
    methods: {
        getBrewery() {
            axios.get("http://127.0.0.1/api/breweries/list")
                .then(
                    ({ data }) => {
                        try {
                            if (data) {
                                this.breweries = data;
                            } else {
                                alert("Caricamento Fallito")
                            }

                        } catch (err) {
                            alert("Errore, ritenta");
                        }
                    }
                )
        }
    }
}
</script>
