<template>

  <div class="wrapper">
    <form class="form-signin">       
      <h2 class="form-signin-heading">Please login</h2>
      <input type="text" class="form-control" name="username" v-model="form.email" placeholder="Email Address" required="" autofocus="" />
      <input type="password" class="form-control"  v-model="form.password" name="password" placeholder="Password" required=""/>      
      <label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
      </label>
      <button @click.prevent="loginUser" class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    </form>
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



body {
	background: #eee !important;	
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