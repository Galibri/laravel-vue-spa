<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">Create Categories</div>
                            <div class="col-md-6 text-right"><router-link :to="{name: 'category'}" class="btn btn-primary btn-sm">All Categories</router-link></div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form @submit.prevent="createCategory">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input v-model="categoryName" type="text" class="form-control" name="name" id="name">
                                <span v-if="nameError" class="text-danger">{{ errorData.name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categoryName: '',
                nameError: false,
                errorData: {}
            }
        },
        methods: {
             createCategory() {
                 axios.post('/api/category', {
                     name: this.categoryName
                 })
                 .then(res => {
                     if(Object.keys(res.data.error).length > 0) {
                         this.errorData = res.data.error
                         this.nameError = true
                         swtoaster('error', "Please check your entries.")
                     } else {
                         this.errorData = {}
                         this.categoryName = ''
                         this.nameError = false
                         swtoaster('success', "Category successfully created.")
                     }
                 })
                 .catch(err => {
                     console.log(err => console.log(err))
                 })
             }
        }
    }
</script>