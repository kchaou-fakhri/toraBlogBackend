<template>
  <div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">
      DataTables is a third party plugin that is used to generate the demo table
      below. For more information about DataTables, please visit the
      <a target="_blank" href="https://datatables.net"
        >official DataTables documentation</a
      >.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
      </div>
      <div class="card-body">
          <b-container fluid>
    <b-table
      id="table-transition-example"
      :items="items"
      :fields="fields"
      
      :bordered="border"
        :per-page="perPage"
      :current-page="currentPage"
      small
      primary-key="a"
   
     
    ></b-table>
      <template #cell(name)="row">
        {{ row.value.first }} {{ row.value.last }}
      </template>

      <template #cell(actions)="row">
        <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
          Info modal
        </b-button>
        <b-button size="sm" @click="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>
      </template>
      </b-container>
  </div>
     
       <b-pagination
      v-model="currentPage"
      
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="my-table"
      align="center"
    ></b-pagination>

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      perPage: 5,
      posts : [],
      border : true,
      fields: [
          { key: 'id', sortable: true },
          { key: 'title', sortable: true },
          { key: 'post', sortable: true },
          { key: 'type', sortable: true    },
          { key: 'created_at', sortable: true    },
          { key: 'actions', label: 'Actions' }

        ],
      currentPage: 1,
      items: [],
    };
  },
  computed: {
    rows() {
      return this.items.length;
    },
  },

    async created() {
    const axios = require("axios");
    await axios
      .get("http://localhost:8000/api/post/")
      .then((response) => {
        if (response.status == 200) {
          this.posts = response.data;
        

          this.posts.forEach((element) => {
              element.post = element.post.slice(0,60) +'...';
              if(element.title.length> 30){
 element.title = element.post.slice(0,40) + '...';
              }
               
            element.created_at = element.created_at.substr(
              0,
              element.created_at.indexOf("T")
              
            );
            
          });

            this.items = this.posts;
            console.log(this.items)
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>