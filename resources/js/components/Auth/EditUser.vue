<template>
<div>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Update Editer Profil</h1>
  </div>
  <div v-if="iscreated == true" class="alert alert-success" role="alert">
 Editer updated successfully!
</div>
<div v-if="ifErorr == true" class="alert alert-danger" role="alert">
 Something he not running please try again with another data
</div>
    <div class="card">
      <div class="card-body">
        <b-form @submit.stop.prevent="onSubmit">

            <!-- ****Input Name**** -->
          <b-form-group
            id="example-input-group-1"
            label="Name"
            label-for="example-input-1"
          >
            <b-form-input
              id="example-input-1"
              name="example-input-1"
              v-model="$v.form.name.$model"
              :state="validateState('name')"
              aria-describedby="input-1-live-feedback"
            ></b-form-input>

            <b-form-invalid-feedback id="input-1-live-feedback"
              >This is a required field and must be at least 3
              characters.</b-form-invalid-feedback
            >
          </b-form-group>

  <!-- ****Input Email**** -->
             <b-form-group
            id="example-input-group-1"
            label="Email"
            label-for="example-input-1"
          >
            <b-form-input
              id="example-input-1"
              name="example-input-1"
              type="email"
              v-model="$v.form.email.$model"
              :state="validateState('email')"
              aria-describedby="input-1-live-feedback"
            ></b-form-input>

            <b-form-invalid-feedback id="input-1-live-feedback"
              >Email is required</b-form-invalid-feedback
            >
          </b-form-group>

           <!-- ****Input Password**** -->
             <b-form-group
            id="example-input-group-1"
            label="Password"
            label-for="example-input-1"
          >
            <b-form-input
              id="example-input-1"
              name="example-input-1"
              
              v-model="$v.form.password.$model"
              :state="validateState('password')"
              aria-describedby="input-1-live-feedback"
            ></b-form-input>

            <b-form-invalid-feedback id="input-1-live-feedback"
              >Password is required and must be at least 6
              characters.</b-form-invalid-feedback
            >
          </b-form-group>
 
         

          <b-button type="submit" variant="success">Update</b-button>
          <b-button class="ml-2" @click="resetForm()">Reset</b-button>
        </b-form>
      </div>
    </div>
  </div>
</template>



<script>
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],
  data() {
    return {
     iscreated : false,
     ifErorr : '',
      form: {
        name: null,
        email : null,
        password: null,
      },
    };
  },
  validations: {
    form: {
      password: {
        required,
         minLength: minLength(6),
      },
      email : {
        required ,
         
      },
      name: {
        required,
        minLength: minLength(3),
      },
    },
  },
  methods: {
    validateState(name) {
      const { $dirty, $error } = this.$v.form[name];
      return $dirty ? !$error : null;
    },
    resetForm() {
      this.form = {
        id : null,
        name:     null,
        password: null,
        email:    null,
      };

      this.$nextTick(() => {
        this.$v.$reset();
      });
    },
    onSubmit() {
      this.$v.form.$touch();
      if (this.$v.form.$anyError) {
        return;
      }
        axios.post('/api/auth/update', this.form).then(() =>{
                console.log('saved');
                this.resetForm();
                
                this.iscreated = true;
                this.ifErorr = false
                setTimeout(() => {   this.iscreated = false; }, 5000);
                
            }).catch((error) =>{
                this.ifErorr = true
                this.errors = error.response.data.errors;
            })
    },
  },

   async created() {
    const axios = require("axios");
    await axios
      .get(
        "/api/auth/getbyid/" + this.$root.$route.params.id
      )
      .then((response) => {
        if (response.status == 200) {
          response.data.forEach((element) => {
            element.created_at = element.created_at.substr(
              0,
              element.created_at.indexOf("T")
            );
          });
          this.form.id = response.data[0].id;
           this.form.name = response.data[0].name;
            this.form.email = response.data[0].email;
        
         
          // this.ConvertType(this.post.type)
          //  this.addBrToPost();
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>