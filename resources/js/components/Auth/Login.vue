<template>

  <div id="padd" class="container-fluid">

        <!-- Outer Row -->
        <div class="card justify-content-center ">

         <div class="card-body">
           

       
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" v-model="form.email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" v-model="form.password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <a  @click.prevent="loginUser" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>
                                      
                                       
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    
                             </div>     
                       
        </div>

    </div>


</template>
<script>
export default {
    data(){
        return{
            form:{
                email: '',
                password: ''
            },
            errors: []
        }
    },
    methods:{

         setUser: function() {
       this.isLogIn = true;
      },
        async loginUser(){
           
    const axios = require("axios");
       await axios.post('/api/users/login', this.form).then(() =>{
       
              this.$router.go(0)
              console.log('saved');
             }).catch((error) =>{ //  this.setUser();
      
          
               // this.$router.push('/posts'); 
                  this.errors = error.response.data.errors;
            })
         }
    },
    
  props: ['isLogIn']
}
</script>


<style lang="scss">
  

#padd{
  
padding: 9% 27%;
}
body {
	background: rgb(226, 227, 231) !important;
}

.wrapper {	
	margin-top: 80px;
  margin-bottom: 80px;
}

.form-signin {
  max-width: 380px;
  padding: 15px 35px 45px;
  margin: 0 auto;
  background-color: #fff;
  border: 1px solid rgba(0,0,0,0.1);  

  .form-signin-heading,
	.checkbox {
	  margin-bottom: 30px;
	}

	.checkbox {
	  font-weight: normal;
	}

	.form-control {
	  position: relative;
	  font-size: 16px;
	  height: auto;
	  padding: 10px;
	

		&:focus {
		  z-index: 2;
		}
	}

	input[type="text"] {
	  margin-bottom: -1px;
	  border-bottom-left-radius: 0;
	  border-bottom-right-radius: 0;
	}

	input[type="password"] {
	  margin-bottom: 20px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
	}
}

</style>