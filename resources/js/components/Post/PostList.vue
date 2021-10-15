<template>
  <div class="card">
    <div class="card-body">
      <b-container fluid>
        <!-- User Interface controls -->
        <b-row>
          <b-col lg="6" class="my-1">
            <b-form-group
              label="Sort"
              label-for="sort-by-select"
              label-cols-sm="3"
              label-align-sm="right"
              label-size="sm"
              class="mb-0"
              v-slot="{ ariaDescribedby }"
            >
              <b-input-group size="sm">
                <b-form-select
                  id="sort-by-select"
                  v-model="sortBy"
                  :options="sortOptions"
                  :aria-describedby="ariaDescribedby"
                  class="w-75"
                >
                  <template #first>
                    <option value="">-- none --</option>
                  </template>
                </b-form-select>

                <b-form-select
                  v-model="sortDesc"
                  :disabled="!sortBy"
                  :aria-describedby="ariaDescribedby"
                  size="sm"
                  class="w-25"
                >
                  <option :value="false">Asc</option>
                  <option :value="true">Desc</option>
                </b-form-select>
              </b-input-group>
            </b-form-group>
          </b-col>

          <b-col lg="6" class="my-1">
            <b-form-group
              label="Initial sort"
              label-for="initial-sort-select"
              label-cols-sm="3"
              label-align-sm="right"
              label-size="sm"
              class="mb-0"
            >
              <b-form-select
                id="initial-sort-select"
                v-model="sortDirection"
                :options="['asc', 'desc', 'last']"
                size="sm"
              ></b-form-select>
            </b-form-group>
          </b-col>

          <b-col lg="6" class="my-1">
            <b-form-group
              label="Filter"
              label-for="filter-input"
              label-cols-sm="3"
              label-align-sm="right"
              label-size="sm"
              class="mb-0"
            >
              <b-input-group size="sm">
                <b-form-input
                  id="filter-input"
                  v-model="filter"
                  type="search"
                  placeholder="Type to Search"
                ></b-form-input>

                <b-input-group-append>
                  <b-button :disabled="!filter" @click="filter = ''"
                    >Clear</b-button
                  >
                </b-input-group-append>
              </b-input-group>
            </b-form-group>
          </b-col>

          <b-col lg="6" class="my-1">
            <b-form-group
              v-model="sortDirection"
              label="Filter On"
              description="Leave all unchecked to filter on all data"
              label-cols-sm="3"
              label-align-sm="right"
              label-size="sm"
              class="mb-0"
              v-slot="{ ariaDescribedby }"
            >
              <b-form-checkbox-group
                v-model="filterOn"
                :aria-describedby="ariaDescribedby"
                class="mt-1"
              >
                <b-form-checkbox value="title">Title</b-form-checkbox>
                <b-form-checkbox value="type">type</b-form-checkbox>
              </b-form-checkbox-group>
            </b-form-group>
          </b-col>

          <b-col sm="5" md="6" class="my-1">
            <b-form-group
              label="Per page"
              label-for="per-page-select"
              label-cols-sm="6"
              label-cols-md="4"
              label-cols-lg="3"
              label-align-sm="right"
              label-size="sm"
              class="mb-0"
            >
              <b-form-select
                id="per-page-select"
                v-model="perPage"
                :options="pageOptions"
                size="sm"
              ></b-form-select>
            </b-form-group>
          </b-col>

          <b-col sm="7" md="6" class="my-1"> </b-col>
        </b-row>

        <!-- Main table element -->
        <b-table
          :items="items"
          :fields="fields"
          :current-page="currentPage"
          :per-page="perPage"
          :filter="filter"
          :filter-included-fields="filterOn"
          :sort-by.sync="sortBy"
          :sort-desc.sync="sortDesc"
          :sort-direction="sortDirection"
          stacked="md"
          bordered
          show-empty
          small
          @filtered="onFiltered"
        >
          <template #cell(name)="row">
            {{ row.value.first }} {{ row.value.last }}
          </template>

          <template #cell(actions)="row">
            <b-button pill variant="primary" size="sm" @click="info(row.item)">
              <i class="fas fa-external-link-alt"></i>
            </b-button>
            <b-button
              pill
              variant="danger"
              size="sm"
             @click="showDeleteModel(row.item)"
            >
              <i class="far fa-trash-alt"></i>
            </b-button>
          </template>

          <template #row-details="row">
            <b-card>
              <ul>
                <li v-for="(value, key) in row.item" :key="key">
                  {{ key }}: {{ value }}
                </li>
              </ul>
            </b-card>
          </template>
        </b-table>

        <b-pagination
          v-model="currentPage"
          :total-rows="totalRows"
          :per-page="perPage"
          align="center"
          class="my-0"
        ></b-pagination>

        <!-- Info modal -->
       
      </b-container>
    </div>

     <div>
      <b-modal id="delete" hide-footer centered title="">
        <i class="far fa-times-circle"></i>
        <h4>Are you sure?</h4>
        <p>
          Do you really want to delete these item? This process cannot be
          undone.
        </p>

        <div class="float-center">
          <button class="btn btn-secondary">Cancel</button>

          <button @click="deleted" class="btn btn-danger">Delete</button>
        </div>
      </b-modal>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      posts: [],
      items: [],
      data : '',
      fields: [
        { key: "id", label: "Id", sortable: true, sortDirection: "desc" },
        { key: "title", label: "Title", sortable: true },
        { key: "post", label: "Post", sortable: true },
        { key: "created_at", label: "Posted", sortable: true },
        { key: "type", label: "Type", sortable: true },

        { key: "actions", label: "Actions" },
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: 5,
      pageOptions: [5, 10, 15, { value: 100, text: "Show a lot" }],
      sortBy: "",
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: [],
      infoModal: {
        id: "info-modal",
        title: "",
        content: "",
      },
    };
  },
  computed: {
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter((f) => f.sortable)
        .map((f) => {
          return { text: f.label, value: f.key };
        });
    },
  },
  mounted() {
    // Set the initial number of items
    this.totalRows = this.items.length;
  },
  methods: {
    info(item) {
      this.$router.push("/editpost/" + item.id);
    },
showDeleteModel(item){
        this.$bvModal.show('delete');
        this.data = item;
    },
    async deleted() {
      var item = this.data
      const axios = require("axios");
      await axios

        .post("/api/post/delete/" + item.id)
        .then((response) => {
          if (response.status == 200) {
            for (var i = 0; i < this.posts.length; i++) {
              if (this.posts[i].id === item.id) {
                this.posts.splice(i, 1);
              }
            }
            this.$bvModal.hide('delete');
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    resetInfoModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  },
  

  async created() {
    const axios = require("axios");
    await axios
      .get("api/post/", )
      .then((response) => {
        if (response.status == 200) {
          this.posts = response.data;

          this.posts.forEach((element) => {
            element.post = element.post.slice(0, 50) + "...";
            if (element.title.length > 30) {
              element.title = element.post.slice(0, 30) + "...";
            }

            element.created_at = element.created_at.substr(
              0,
              element.created_at.indexOf("T")
            );
          });

          this.items = this.posts;
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>

 

 <style scoped>
@import url("./style.css");
</style>