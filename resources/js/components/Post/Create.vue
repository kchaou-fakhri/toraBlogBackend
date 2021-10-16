<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Create Post</h1>
    </div>
<div v-if="iscreated == true" class="alert alert-success" role="alert">
 Post published successfully!
</div>
    <div class="card">
      <div class="card-body">
        <form class="needs-validation" novalidate>
          <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control"
                placeholder="Title Post"
                v-model="data.title"
                required
                id="validationCustom03"
              />
              <div class="invalid-feedback">Title is required</div>
            </div>
          </div>

          <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Post</label>
            <div class="col-sm-10">
              <textarea
                class="form-control"
                aria-label="With textarea"
                v-model="data.post"
                required
              ></textarea>
              <div class="invalid-feedback">Post is required</div>
            </div>
          </div>

          <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-10">
              <div class="custom-file">
                <input
                  type="file"
                  class="custom-file-input"
                  id="inputGroupFile"
                  ref="file"
                  v-on:change="handleFileUpload()"
                  required
                />
                <label class="custom-file-label" for="inputGroupFile04"
                  >Choose Image</label
                >
                <div class="invalid-feedback">Image is required</div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Type</label>
            <div class="col-sm-10">
              <div class="form-check col-sm-2 form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="inlineCheckbox1"
                  value="Poltics"
                  v-model="type"
                />
                <label for="inlineCheckbox1">Poltics</label>
              </div>

              <div class="form-check col-sm-2 form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="inlineCheckbox2"
                  value="Business"
                  v-model="type"
                />
                <label for="inlineCheckbox2">Business</label>
              </div>

              <div class="form-check col-sm-2 form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="inlineCheckbox3"
                  value="Health"
                  v-model="type"
                />
                <label class="" for="inlineCheckbox3">Health</label>
              </div>

              <div class="form-check col-sm-2 form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="inlineCheckbox4"
                  value="Entertainment"
                  v-model="type"
                />
                <label for="inlineCheckbox4">Entertainment</label>
              </div>

              <div class="form-check col-sm-2 form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="inlineCheckbox5"
                  value="Sports"
                  v-model="type"
                />
                <label for="inlineCheckbox5">Sports</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8"></div>
            <div class="col-sm-4 text-right">
              <button type="button" class="btn btn-danger">Cancel</button>
              <button type="submit" @click.prevent="create" class="btn btn-primary">
                Post
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {
        title: "",
        post: "",
        type: "",
        owner: "1",
        image: "",
      },

      type: [],
      iscreated : false,
    };
  },

  methods: {
     create() {
      this.getType();

      if (
        this.data.title != "" &&
        this.data.type != "" &&
        this.data.post != "" &&
        this.data.image != ""
      ) {
        let formData = new FormData();
        formData.append("title", this.data.title);
        formData.append("post", this.data.post);
        formData.append("owner", this.data.owner);
        formData.append("image", this.data.image);
        formData.append("type", this.data.type);

         axios
          .post("/api/post/create", formData)
          .then((response) => {
            if (response.status == 200) {
               this.iscreated = true
                           
            }
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    

     
    },

    handleFileUpload() {
      var type = Array.from(this.$refs.file.files[0].type);

      for (var i = 0; i < type.length; i++) {
        if (type[i] == "/") {
          type = this.$refs.file.files[0].type.substring(i + 1);
          break;
        }
      }

      if (
        type.trim() == "jpg" ||
        type.trim() == "png" ||
        type.trim() == "jpeg"
      ) {
        this.data.image = this.$refs.file.files[0];
      }
    },

    getType() {
      let userObjec = {
        type: this.type,
      };
      this.data.type = this.type.join();
    },
  },

  mounted() {
    (function () {
      "use strict";
      window.addEventListener(
        "load",
        function () {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName("needs-validation");

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener(
              "submit",
              function (event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add("was-validated");
              },
              false
            );
          });
        },
        false
      );
    })();
  },
};
</script>
