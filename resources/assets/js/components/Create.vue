<template>
    <div class="container">
       <h2>Users Listing</h2>
       <form action="/users" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="" placeholder="Enter name" v-model="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="" placeholder="Enter email"  v-model="email">
                
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control"  type="text" name="password" id="" placeholder="Password"  v-model="password">
            </div>

            <div class="form-group">
               <button type="submit" class="btn btn-default" @click.prevent="addNewUser()">Save</button>
            </div>
       </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
               name: '',
               email: '',
               password: ''
            }
        },
       
        methods: {
            addNewUser(){
                console.log(this.name);
                console.log(this.email);
                console.log(this.password);
                axios.post('/api/users', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                }).then( response => {
                   console.log(response);
                }).catch( error => {
                    console.log(error);
                })
            }
        }
    }
</script>
