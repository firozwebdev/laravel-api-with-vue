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
           <tr v-for="user in users">
               <td>{{ user.id }}</td>
               <td>{{ user.name }}</td>
               <td>{{ user.email }}</td>
               <td>
                   <a href="" class="btn btn-primary">Edit</a>
                   <a href="" class="btn btn-danger">Delete</a>
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
                    email: ''
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
            }
        }
    }
</script>
