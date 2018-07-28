<template>
    <div class="container">
       <h2>Create User</h2>
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
                <label for="email">Image</label>
                 <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                
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
               users: [], 
               name: '',
               email: '',
               file: '',
               password: ''
            }
        },
       
        methods: {
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },

            addNewUser(){
                

                let formData = new FormData();
                formData.append('name',this.name);
                formData.append('email',this.email);
                formData.append('password',this.password);
            
                formData.append('image', this.file, this.file.name);
                
                axios.post('/api/users', formData,{
                    
                     headers: {'Content-Type': 'multipart/form-data'},
                }).then( response => {
                   window.location.href='/users';
                   console.log(response);
                }).catch( error => {
                    console.log(error);
                })
            }
        }
    }
</script>
