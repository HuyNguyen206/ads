<template>
    <div class="col-md-4">
        <input type="file" class="" @change="previewImage" :name="name" accept="image/*">
    <div id="preview">
        <img :src="url" v-if="url" alt="" width="100" height="100">
    </div>
    </div>
</template>

<script>
export default {
    props:['name'],
    name: "ImagePreview",
    data(){
     return {
         url: ''
     }
    },
    methods:{
        previewImage(e){
            const file = e.target.files[0]
            this.url =URL.createObjectURL(file)
        }
    }
}
</script>

<style scoped>

</style>
