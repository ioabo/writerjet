<template>
  <main>
    <div class="container-fluid px-4">
      <div v-if="showMessage">
        <div class="alert alert-success">{{ message }}</div>
      </div>
      <h1 class="mt-4">Users</h1>
      <div class="breadcrumb mt-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-2">
            <li class="breadcrumb-item" aria-current="page">
              <a href="/home">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </nav>
      </div>
      <div class="card mb-4">
        <!-- <div class="card-body">
          The list consist of registered templates to speed up the process of
          writing correspondenses. If you want to start a new document, go this
          link:
          <router-link :to="{ name: 'DocumentsCreate' }">
            New Document
          </router-link>
        </div> -->
      </div>
      <div class="card mb-4">
        <div class="card-header">
          <div class="row">
            <!-- <div class="col">
              <i class="fas fa-table me-1"></i>
              Templates Data Table
            </div> -->
            <!-- <div class="col mt-2">
              <router-link
                :to="{ name: 'TemplatesCreate' }"
                class="btn btn-primary btn-sm"
              >
               <i class="fas fa-plus"></i> &nbsp;Create New Templates
              </router-link>
            </div> -->
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
          <table class="table table-borderless table-secondary">
            <thead class="table-dark">
              <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Status</th>
                <th>email</th>
                <th>Joined At</th>
                <th colspan="2">Status / Actions</th>
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
                v-for="user in users"
                :key="user.id"
                :to="{ name: 'DocumentsCreate' }"
                tag="tr"
              >
                <th scope="row">{{ user.name }}</th>
                <td>{{ user.type }}</td>
                <td>{{ user.registration_status }}</td>
                <td>{{ user.email }}</td>
                <td>{{ format_date(user.created_at) }}</td>
                <td>
                  <div v-if="user.registration_status === 'Pending'">
                    <!-- <td> -->
                    <button
                      type="button"
                      class="btn btn-primary btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#activateModal"
                      @click.prevent="selectedUser(user.id)"
                    >
                      Activate
                    </button>
                    <!-- Modal -->
                    <div
                      class="modal fade"
                      id="activateModal"
                      tabindex="-1"
                      aria-labelledby="activateModalLabel"
                      aria-hidden="true"
                    >
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5
                              class="modal-title text-primary"
                              id="activateModalLabel"
                            >
                              User Activation
                            </h5>
                            <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button>
                          </div>
                          <form @submit.prevent="activateUser(user_id)">
                            <div class="modal-body">
                              <div class="mb-3">
                                <h4><b> Confirmation </b></h4>
                                <p>
                                  This will allow user to access links in
                                  accordence to his/her user type
                                </p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="row">
                                <div class="col">
                                  <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                  >
                                    Cancel
                                  </button>
                                </div>
                                <div class="col">
                                  <button
                                    type="submit"
                                    class="btn btn-primary"
                                    data-bs-dismiss="modal"
                                  >
                                    Confirm
                                  </button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- end modal -->
                    <!-- </td>
                    <td> -->
                  </div>
                  <div v-else>Activated</div>
                </td>
                <td>
                  <div v-if="user.type === 'Administrator'">
                    <button
                      type="button"
                      class="btn btn-danger btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#demote"
                      @click.prevent="selectedUser(user.id)"
                    >
                      Demote
                    </button>
                    <!-- Modal -->
                    <div
                      class="modal fade"
                      id="demote"
                      tabindex="-1"
                      aria-labelledby="demoteModalLabel"
                      aria-hidden="true"
                    >
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5
                              class="modal-title text-primary"
                              id="demoteModalLabel"
                            >
                              Demote User
                            </h5>
                            <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button>
                          </div>
                          <form @submit.prevent="demoteUser(user_id)">
                            <div class="modal-body">
                              <div class="mb-3">
                                <h4><b> Comirm Demotion </b></h4>
                                <p>
                                  This will be limited this user from system
                                  administrative options
                                </p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="row">
                                <div class="col">
                                  <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                  >
                                    Cancel
                                  </button>
                                </div>
                                <div class="col">
                                  <button
                                    type="submit"
                                    class="btn btn-primary"
                                    data-bs-dismiss="modal"
                                  >
                                    Confirm
                                  </button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- end modal -->
                  </div>
                  <div v-else>
                    <button
                      type="button"
                      class="btn btn-success btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#promoteModal"
                      @click.prevent="selectedUser(user.id)"
                    >
                      Make Admin
                    </button>
                    <!-- Modal -->
                    <div
                      class="modal fade"
                      id="promoteModal"
                      tabindex="-1"
                      aria-labelledby="promoteModalLabel"
                      aria-hidden="true"
                    >
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5
                              class="modal-title text-primary"
                              id="promoteModalLabel"
                            >
                              Promote User
                            </h5>
                            <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button>
                          </div>
                          <form @submit.prevent="promoteUser(user_id)">
                            <div class="modal-body">
                              <div class="mb-3">
                                <h4>Are you sure you want to <b>promote</b> this user?</h4>
                                <p>
                                  This will grant this user with system administrative options.
                                </p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="row">
                                <div class="col">
                                  <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                  >
                                    Cancel
                                  </button>
                                </div>
                                <div class="col">
                                  <button
                                    type="submit"
                                    class="btn btn-primary"
                                    data-bs-dismiss="modal"
                                  >
                                    Confirm
                                  </button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- end modal -->
                  </div>
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
      users: [],
      user_id: "",
      search: null,
    };
  },
  watch: {
    search() {
      this.getUsers();
    },
  },
  created() {
    this.getUsers();
  },
  methods: {
    getUsers() {
      axios
        .get("/api/users")
        .then((result) => {
          this.users = result.data;
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    createDocument() {
      this.$router.push({ nanme: "DocumentsCreate" });
    },
    selectedUser(id) {
      this.user_id = id;
      console.log(this.user_id);
    },
    promoteUser(id) {
      axios
        .get("/api/promote/" + id)
        .then(this.getUsers())
        .catch((error) => {
          console.log(console.error);
        });
    },
    demoteUser(id) {
      axios
        .get("/api/demote/" + id)
        .then(this.getUsers())
        .catch((error) => {
          console.log(console.error);
        });
    },
    activateUser(id) {
      axios
        .get("/api/activate/" + id)
        .then(this.getUsers())
        .catch((error) => {
          console.log(console.error);
        });
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