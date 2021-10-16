<template>
<div>
         <dashboard  v-if="isLogIn == true"></dashboard>
          <router-view v-else></router-view>
        
   </div>      

</template>

<script>
 import dashboard from "./Pages/Dashboard.vue"
export default {
  data(){

    return{
      user : '',
      isLogIn : false
    }
  },
  components : {
     dashboard
  },
  mounted(){
  const axios = require('axios');
       axios.get('/api/user').then((result) => {
         this.isLogIn = true;
        
       }).catch((err) => {
         
       });
  
         }
        

  

   
}
</script>