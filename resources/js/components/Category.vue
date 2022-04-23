<template>
    <div class="row">
        <div class="col-md-4">
            <select class="form-control" name="category_id">
                <option value=""> choose category</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" name="sub_category_id">
                <option value="">choose subcategory</option>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" name="child_category_id">
                <option value="">choose childcategory</option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    name: "Category",
    props: ['categories']
}
</script>

<style scoped>

</style>
