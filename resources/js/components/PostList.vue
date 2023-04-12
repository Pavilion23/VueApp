<template>
    <div> 
        <form @submit.prevent="addPost">
           <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" v-model="post.title">
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Body" v-model="post.body"></textarea>
            </div> 
            <button type="submit" class="btn btn-success">Save</button>
            <button class="btn btn-warning" @click="clearForm()">Clear form</button>
        </form>
        
        <nav>
            <ul class="pagination justify-content-center">            
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="getPosts(pagination.first_page_url)">{{ First_page }}</a>
                </li>
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="getPosts(pagination.prev_page_url)">{{ Prev_page }}</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">{{ pagination.current_page }} of {{ pagination.last_page }}</a>
                </li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="getPosts(pagination.next_page_url)">{{ Next_page }}</a>
                </li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="getPosts(pagination.last_page_url)">{{ Last_page }}</a>
                </li>
            </ul>
        </nav> 

        <div class="card mb-2" v-for="post in posts" v-bind:key="post.id">
            <div class="card-body">
                <h4 class="card-title">{{ post.title }}</h4>
                <p class="card-text">{{ post.body }}</p>
                <button type="submit" class="btn btn-success" @click="updatePost(post)">Edit</button>
                <button type="submit" class="btn btn-warning" @click="deletePost(post.id)">Delete</button>                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                posts: [],
                pagination: {},
                post: {
                    id: '',
                    title: '',
                    body: ''
                },
                update: false,
                post_id: '',
                First_page: '<<',
                Prev_page: '<',
                Next_page: '>',
                Last_page: '>>'
            };
        },
       
        created () {
            this.getPosts();
        },
       
        methods: {
            getPosts (api_url) {
                let vm = this;
                api_url = api_url || '/api/posts';
                fetch(api_url)
                    .then(response => response.json())
                    .then(response => {
                        this.posts = response.data;
                        vm.paginator(response.meta, response.links);
                    })
                    .catch(err => console.log(err));
            },

            paginator (meta, links) {
                this.pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    first_page_url: links.first,
                    prev_page_url: links.prev,
                    next_page_url: links.next,
                    last_page_url: links.last
                };
            },

            addPost () {
                if (this.update === false) {
                    fetch('api/posts', {
                        method: 'post',
                        body: JSON.stringify(this.post),
                        headers: {'content-type': 'application/json'}
                    })
                    .then(responce => responce.json())
                    .then(data => {
                        this.clearForm();
                        this.getPosts();
                    })
                    .catch(err => console.log(err));
                } else {
                    fetch('api/posts', {
                        method: 'put',
                        body: JSON.stringify(this.post),
                        headers: {'content-type': 'application/json'}
                    })
                    .then(responce => responce.json())
                    .then(data => {
                        this.clearForm();
                        this.getPosts();
                    })
                    .catch(err => console.log(err));                    
                }
            },
            
            deletePost(id) {
                fetch('api/posts/' + id, {
                    method: 'delete'
                })
                .then(responce => responce.json())
                .then(data => {this.getPosts();})
                .catch(err => console.log(err));
            },

            updatePost(post) {
                this.update = true;
                this.post.id = post.id;
                this.post.post_id = post.id;
                this.post.title = post.title;
                this.post.body = post.body;
            },

            clearForm () {
                this.update = false;
                this.post.post_id = null;
                this.post.id = null;
                this.post.title = '';
                this.post.body = '';                
            },
        }
    };
</script>