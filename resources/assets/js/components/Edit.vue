<template>
    <div class="container">
       <h2>Edit User</h2>
       <form action="/users" method="put" class="form-horizontal" >
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
               file: '',
               
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
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },

            UpdateUser(){
                console.log(this.name);

                let formData = new FormData();
                formData.append('name',this.name);
                formData.append('email',this.email);
               // formData.append('password',this.password);
                formData.append('image', this.file, this.file.name);
                formData.append('_method', 'PUT'); // Sending put method to laravel though we use post method in axios below
               

               
                axios.post('/api/users/'+this.id,formData, {  //axios.put method sends Laravel null value or Laravel put method can not take value from axiox put request.
                   
                    headers: {'Content-Type': 'multipart/form-data'},
                }).then( response => {
                   console.log(response);
                }).catch( error => {
                    console.log(error);
                })

               
              
               
            }
        }
    }
</script>
