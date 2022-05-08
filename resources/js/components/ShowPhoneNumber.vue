<template>
<div>
    <button v-if="showNumber" class="btn btn-outline-dark" @click="showNumber = !showNumber"><i class="fa-solid fa-phone me-1"></i>Show number</button>
    <button v-else class="btn btn-outline-dark" @click="showNumber = !showNumber">{{number}}</button>
</div>
</template>

<script>
export default {
    name: "ShowPhoneNumber",
    props:['number'],
    data(){
        return {
            showNumber:this.number
        }
    }
}
</script>

<style scoped>

</style>
