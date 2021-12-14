<template>
  <main>
    <div class="container-fluid px-4">
      <div v-if="showMessage">
        <div class="alert alert-success">{{ message }}</div>
      </div>
      <h1 class="mt-4">Templates</h1>
      <div class="breadcrumb mt-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-2">
            <li class="breadcrumb-item" aria-current="page">
              <a href="/home">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Templates</li>
          </ol>
        </nav>
      </div>
      <div class="card mb-4">
        <div class="card-body">
          The list consist of registered templates to speed up the process of
          writing correspondenses. If you want to start a new document, go this
          link:
          <router-link :to="{ name: 'DocumentsCreate' }">
            New Document
          </router-link>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-header">
          <div class="row">
            <!-- <div class="col">
              <i class="fas fa-table me-1"></i>
              Templates Data Table
            </div> -->
            <div class="col mt-2">
              <router-link
                :to="{ name: 'TemplatesCreate' }"
                class="btn btn-primary btn-sm"
              >
               <i class="fas fa-plus"></i> &nbsp;Create New Templates
              </router-link>
            </div>
            <div class="col mt-2 d-grid justify-content-md-end">
              <input
                type="search"
                v-model="search"
                class="form-control mb-2"
                placeholder="Search for Templates"
              />
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-hover table-borderless table-secondary">
            <thead class="table-dark">
              <tr>
                <th>id</th>
                <th>Categories</th>
                <th>Subjects</th>
                <th>Crated At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <!-- <tfoot>
              <tr>
                <th>id</th>
                <th>Categories</th>
                <th>Subjects</th>
                <th>Crated At</th>
                <th>Actions</th>
              </tr>
            </tfoot> -->
            <tbody>
              <tr
                v-for="template in templates"
                :key="template.id"
                :to="{ name: 'DocumentsCreate' }"
                tag="tr"
              >
                <th scope="row">#{{ template.id }}</th>
                <td>{{ template.category_id }}</td>
                <td>{{ template.subject }}</td>
                <td>{{ format_date(template.created_at) }}</td>
                <td>
                  <router-link
                    :to="{
                      name: 'DocumentsCreateFromTemplate',
                      params: { id: template.id },
                    }"
                    class="btn btn-success btn-sm"
                    ><i class="fas fa-arrow-right"></i>&nbsp;Select</router-link
                  >
                  &nbsp;
                  <router-link
                    :to="{ name: 'TemplatesEdit', params: { id: template.id } }"
                    class="btn btn-warning btn-sm"
                    ><i class="fas fa-pen"></i>&nbsp;Edit</router-link
                  >
                  &nbsp;
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import moment from "moment";
import "jquery/dist/jquery.min.js";
//Datatable Modules
// import "datatables.net-dt/js/dataTables.dataTables";
// import "datatables.net-dt/css/jquery.dataTables.min.css";
// import {DataTable} from "simple-datatables"
import axios from "axios";
// import $ from 'jquery';

// const myTable = document.querySelector("#datatablesSimple");
// const dataTable = new DataTable(myTable);

export default {
  data() {
    return {
      templates: [],
      search: null,
    };
  },
  watch: {
    search() {
      this.getTemplates();
    }
  },
  created() {
    this.getTemplates();
  },
  methods: {
    getTemplates() {
      axios
        .get("/api/templates", {
          params: {
            search: this.search
          }
        })
        .then((result) => {
          this.templates = result.data;
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    createDocument() {
      this.$router.push({ nanme: "DocumentsCreate" });
    },
    format_date(value) {
      if (value) {
        return moment(String(value)).format("DD MMMM, YYYY");
      }
    },
  },
};
</script>
<style scoped>
</style>