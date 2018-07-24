<template>
    <div class="container">
       <h2>Users Listing</h2>
       <a href="/users/create" class="btn btn-success pull-right">Add New User</a>
       <table class="table table-bordered">
           <tr>
               <th>Id</th>
               <th>Name</th>
               <th>Email</th>
               <th>Action</th>
           </tr>
           <tr v-for="(user, index) in users">
               <td>{{ user.id }}</td>
               <td>{{ user.name }}</td>
               <td>{{ user.email }}</td>
               <td>{{ user.image }}</td>
               <td>
                   <a :href="'/users/'+user.id+'/edit'" class="btn btn-primary">Edit</a>
                   <a href="" class="btn btn-danger" @click.prevent="deleteUser(user.id, index)">Delete</a>
               </td>
           </tr>
       </table>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                users: {},
                user: {
                    id: 0,
                    name: '',
                    email: '',
                    
                }
            }
        },
        mounted() {
            this.getUsers();
        },
        methods: {
            getUsers(){
                axios.get('/api/users').then( response => {
                   this.users = response.data;
                })
            },
            deleteUser(id,index){
                 axios.delete('/api/users/'+id).then( response => {
                   console.log(response);
                   this.users.splice(index)
                }).catch( error => {
                    console.log(error);
                });
            }
        }
    }
</script>
