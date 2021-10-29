<template>
<div>
      <div class="mnb-4" v-for="(item, index) in permissions" :key="index">
          <label>
            {{item.title}}
          </label>
          <select v-model="item.value">
            <option value="No">No</option>
            <option value="Yes">Yes</option>
          </select>
      </div>

      <button class="btn btn-success">Save </button>
</div>
    
</template>

<script>
import permissions from '../../data/permissions'
export default {
    data() {
       return {
           users : [],
           permissions,
           profil : '',

       } 
    },

    methods :{

      parsePermission(permissions){

        this.permissions.forEach(permission =>{

            permissions.forEach(per => {
              
              if(per.key === permission.key){
                per.value = permission.value
              }
            })
        })
      },

      async save(){
        
        const data = {
          id :this.$roote.params.id,
          permissions : this.permissions
        }
      const axios = require("axios");

//await axios.post('api/role/changepermission', data)
       await axios
          .post("api/role/changepermission", data)
          .then((response) => {
            if (response.status == 200) {
            console.log('yesssssssssss')
            }
          })
          .catch(function (error) {
            console.log(error);
          });

      },

    },

    mounted(){
        
       
    },

 async created() {
    const axios = require("axios");
    await axios
      .get("http://127.0.0.1:8000/api/getpermissions/" + this.$root.$route.params.id)
      .then((response) => {
        if (response.status == 200) {
          this.users = response.data;

            //this.permissions = this.users[0].permission
             this.parsePermission(this.users[0].permission)
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  },
  
  

    props : ['user']
}
</script>