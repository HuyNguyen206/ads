<template>
    <div class="row">
        <div class="col-md-4">
            <select @change="getChildCategory" class="form-control" name="category_id" v-model="category_id">
                <option value="null">--choose category--</option>
                <option  v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
            </select>
        </div>
        <div class="col-md-4">
            <select @change="getChildCategory($event,'sub')" class="form-control" name="sub_category_id" v-model="sub_category_id">
                <option value="null">--choose subcategory--</option>
                <option  v-for="subCategory in subCategories" :key="subCategory.id" :value="subCategory.id">{{subCategory.name}}</option>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" name="child_category_id" v-model="child_category_id">
                <option value="null">--choose childcategory--</option>
                <option v-for="childCategory in childCategories" :key="childCategory.id" :value="childCategory.id">{{childCategory.name}}</option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    name: "Category",
    props: ['categories', 'selected_category_id', 'selected_sub_category_id', 'selected_child_category_id'],
    data(){
        return {
            category_id:null,
            sub_category_id:null,
            child_category_id:null,
            subCategories:[],
            childCategories:[]
        }
    },
    methods:{
        async fetchCategoryByParentId(parentId) {
            try {
                const data = await axios.get(`/internal-api/categories/${parentId}`)
                return data
            }catch (e) {
              console.log(e)
            }
        },
        async getChildCategory(event, parent = 'root'){
            if (parent === 'root') {
                let {data} = await this.fetchCategoryByParentId(this.category_id)
                console.log(data)
                this.subCategories = data.data
            } else {
                let {data} = await this.fetchCategoryByParentId(this.sub_category_id)
                this.childCategories = data.data
            }

        }
    },
       async mounted() {
        if (this.selected_category_id) {
            this.category_id = this.selected_category_id
             await this.getChildCategory('',)
        }
         if (this.selected_sub_category_id) {
             this.sub_category_id = this.selected_sub_category_id
             await this.getChildCategory('','sub')
         }
         if (this.selected_child_category_id) {
             this.child_category_id = this.selected_child_category_id
         }
     }
}
</script>

<style scoped>

</style>
