<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">Edit Categories</div>
                            <div class="col-md-6 text-right"><router-link :to="{name: 'category'}" class="btn btn-primary btn-sm">All Categories</router-link></div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form @submit.prevent="updateCategory">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input v-model="category.name" type="text" class="form-control" name="name" id="name">
                                <span v-if="nameError" class="text-danger">{{ errorData.name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save Category</button>
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
                category: '',
                nameError: false,
                errorData: {}
            }
        },
        methods: {
            updateCategory() {
                axios.put('/api/category/'+this.category.slug, {
                    name: this.category.name
                })
                .then(res => {
                    if(Object.keys(res.data.error).length > 0) {
                        this.errorData = res.data.error
                        this.nameError = true
                        swtoaster('error', "Please check your entries.")
                    } else {
                        this.errorData = {}
                        this.nameError = false
                        this.category = res.data.category
                        this.$router.push('/category/edit/'+this.category.slug)
                        swtoaster('success', "Category successfully updated.")
                    }
                })
                .catch(err => {
                    console.log(err => console.log(err))
                })
            },
            getCategory() {
                let slug = this.$route.params.slug
                axios.get('/api/category/'+slug)
                    .then(res => {
                        this.category = res.data
                        console.log(this.category)
                    })
                    .catch(err => console.log(err))
            }
        },
        created() {
            this.getCategory()
        }
    }
</script>