<template>
    <div class="row">
        <div class="col-md-4">
            <select @change="getStateByCountryId" class="form-control" name="country_id" v-model="country_id">
                <option value="null">--choose country--</option>
                <option  v-for="country in countries" :key="country.id" :value="country.id">{{country.name}}</option>
            </select>
        </div>
        <div class="col-md-4">
            <select @change="getCitiesByStateId" class="form-control" name="state_id" v-model="state_id">
                <option value="null">--choose state--</option>
                <option  v-for="state in states" :key="state.id" :value="state.id">{{state.name}}</option>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" name="city_id" v-model="city_id">
                <option value="null">--choose city--</option>
                <option v-for="city in cities" :key="city.id" :value="city.id">{{city.name}}</option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    name: "Address",
    props: ['countries', 'selected_country_id', 'selected_state_id', 'selected_city_id'],
    data(){
        return {
            country_id:null,
            state_id:null,
            city_id:null,
            states:[],
            cities:[]
        }
    },
    methods:{
        async getStateByCountryId() {
            try {
                const {data} = await axios.get(`/internal-api/address/get-states/${this.country_id}`)
                this.states = data.data
            }catch (e) {
              console.log(e)
            }
        },

        async getCitiesByStateId() {
            try {
                const {data} = await axios.get(`/internal-api/address/get-cities/${this.state_id}`)
                this.cities = data.data
            }catch (e) {
              console.log(e)
            }
        },
    },
    async mounted() {
        if (this.selected_country_id) {
            this.country_id = this.selected_country_id
            await this.getStateByCountryId()
        }
        if (this.selected_state_id) {
            this.state_id = this.selected_state_id
            await this.getCitiesByStateId()
        }
        if (this.selected_city_id) {
            this.city_id = this.selected_city_id
        }
    }
}
</script>

<style scoped>

</style>
