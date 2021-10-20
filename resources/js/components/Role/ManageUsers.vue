<template>
    
</template>

<script>
export default {
    data() {
       return {
           users : [],
       } 
    },

    async created() {
    const axios = require("axios");
    await axios
      .get("api/auth/", )
      .then((response) => {
        if (response.status == 200) {
          this.users = response.data;
      
          this.users.forEach((element) => {
          
            element.created_at = element.created_at.substr(
              0,
              element.created_at.indexOf("T")
            );
          });

         // this.items = this.users;
           //this.totalRows = this.items.length;
        }
      })
      .catch(function (error) {
      
      });
  },

    props : ['user']
}
</script>