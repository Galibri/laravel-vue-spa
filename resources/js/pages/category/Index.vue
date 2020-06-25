<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">Categories</div>
                            <div class="col-md-6 text-right"><router-link :to="{name: 'create-category'}" class="btn btn-primary btn-sm">Add Category</router-link></div>
                        </div>
                    </div>

                    <div class="card-body" v-if="hasData">
                        <table class="table table-dashed">
                            <thead>
                                <tr>
                                    <th style="width: 100px">ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th style="width: 150px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in categories.data" :key="category.id">
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.name }}</td>
                                    <td>{{ category.slug }}</td>
                                    <td>
                                        <router-link :to="{name: 'edit-category', params: {slug: category.slug}}" class="btn btn-warning btn-sm">Edit</router-link>
                                        <a href="#" @click.prevent="deleteCategory(category.slug)" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul v-if="paginationExist" class="pagination">
                                <li class="page-item" v-bind:class="{disabled: categories.prev_page_url == null}">
                                    <a @click.prevent="managePageUrl(categories.prev_page_url)" class="page-link" href="#">Previous</a>
                                </li>

                                <li class="page-item" v-bind:class="{disabled: categories.next_page_url == null}">
                                    <a @click.prevent="managePageUrl(categories.next_page_url)" class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="card-body text-center" v-else>
                        <h3>No data found.</h3>
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
                categories: [],
                pageUrl: '/api/category',
                hasData: false
            }
        },
        methods: {
            getCategories() {
                axios.get(this.pageUrl)
                    .then(res => {
                        this.categories = res.data
                        this.dataExists()
                    })
                    .catch(err => console.log(err))
            },
            managePageUrl(page_url) {
                this.pageUrl = page_url
                this.getCategories()
            },
            dataExists() {
                this.hasData = Object.keys(this.categories.data).length > 0
            },
            deleteCategory(slug) {
                axios.delete('/api/category/'+slug)
                    .then(res => {
                        if(res.data.result == 'success') {
                            swtoaster('success', "Category successfully deleted.")
                            this.getCategories()
                        } else {
                            swtoaster('error', "Please try again later")
                        }
                    })
                    .catch()
            }
        },
        mounted() {
            this.getCategories()
        },
        computed: {
            paginationExist() {
                return !(this.categories.prev_page_url == null && this.categories.next_page_url == null)
            }
        }
    }
</script>