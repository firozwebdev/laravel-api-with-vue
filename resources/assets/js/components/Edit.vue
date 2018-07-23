<template>
    <div class="container">
       <h2>Edit User</h2>
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
               <button type="submit" class="btn btn-default" @click.prevent="UpdateUser()">Update</button>
            </div>
       </form>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data(){
            return {
               name: '',
               email: '',
              
            }
        },
        mounted(){
             axios.get('/api/users/'+this.id, {
                   
            }).then( response => {
               var user = response.data;
                   this.name = user.name;
                   this.email = user.email;
                  
            }).catch( error => {
                console.log(error);
            })
        },
       
        methods: {
            UpdateUser(){
              axios.put('/api/users/'+this.id, {
                  name: this.name,
                  email: this.email
              }).then(response => {
                  console.log(response);
              }).catch(error => {
                  console.log(error);
              });
               
            }
        }
    }
</script>
