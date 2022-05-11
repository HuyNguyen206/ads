<template>
    <div v-if="isAlreadySave || isSaved">
        <p class="badge bg-success">Already save</p>
    </div>
    <div v-else>
        <button @click.prevent='saveAd' class="btn btn-info"><i class="fa-solid fa-heart" style="color: white"></i><span style="color: white">Save this ad</span></button>
        <p v-if="successMessage" class="alert alert-success">{{ successMessage }}</p>
    </div>

</template>

<script>
export default {
    name: "SaveAd",
    props:{
        adId:{
            type: Number
        },
        isAlreadySave:{
            type: Number,
            default: 0
        }
    },
    data(){
        return {
            successMessage: null,
            isSaved: 0
        }
    },
    methods:{
        saveAd(){
            axios.post(`/internal-api/ads/${this.adId}/save`)
            .then(res => {
                this.successMessage = res.data.message
                this.isSaved = true
            })
        }
    }
}
</script>

<style scoped>

</style>
