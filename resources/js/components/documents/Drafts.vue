<template>
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Archives</h1>
      <div class="breadcrumb mt-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-2">
            <li class="breadcrumb-item" aria-current="page">
              <a href="/home">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <a href="/documents">Documents</a>
            </li>
            <li class="breadcrumb-item active">Archives</li>
          </ol>
        </nav>
      </div>
      <div class="card mb-4">
        <div class="card-header">
          <div class="row">
            <div class="col mt-2">
              <router-link
                :to="{ name: 'DocumentsCreate' }"
                class="btn btn-primary"
              >
                <i class="fas fa-plus"></i> &nbsp;Create New Document
              </router-link>
              &nbsp;
              <router-link
                :to="{ name: 'TemplatesIndex' }"
                class="btn btn-primary"
              >
                <i class="fas fa-file-alt"></i> &nbsp;Templates
              </router-link>
            </div>
            <div class="col mt-2 d-grid justify-content-md-end">
              <input
                type="search"
                v-model="search"
                class="form-control mb-2"
                placeholder="Search for Documents"
                style="height: 40px !important"
              />
            </div>
          </div>
        </div>
        <div class="card-body">
          <div v-if="empty_document === true">
            <h3>No result found</h3>
          </div>
          <div v-else>
            <table
              class="table table-hover table-borderless table-secondary"
            >
              <thead class="table-dark">
                <tr>
                  <th>File Ref</th>
                  <th>Categories</th>
                  <th>Subjects</th>
                  <th>Created On</th>
                  <th>Created By</th>
                  <th colspan="2">Status &amp; Actions</th>
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
                <tr v-for="document in documents" :key="document.id">
                  <th scope="row">{{ document.file_ref }}</th>
                  <td>{{ document.category_id }}</td>
                  <td>{{ document.subject }}</td>
                  <td>{{ format_date(document.created_at) }}</td>
                  <td>{{ document.name }}</td>
                  <td>
                      <!-- <td> -->
                      <button
                        type="button"
                        class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                        @click="selectedDocument(document.id)"
                      >
                        Generate <i class="fas fa-file-pdf"></i>
                      </button>
                      <!-- Modal -->
                      <div
                        class="modal fade"
                        id="exampleModal"
                        tabindex="-1"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true"
                      >
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5
                                class="modal-title text-primary"
                                id="exampleModalLabel"
                              >
                                PDF Generation Confirmation!
                              </h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <form @submit.prevent="generatePDF(doc_id)">
                              <div class="modal-body">
                                <div class="mb-3">
                                  <h3><b> Warning! </b></h3>
                                  <p>
                                    The process is irreversible, once the PDF
                                    copy of this document has been generated,
                                    the document will be marked as "FINAL".
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
                                      class="btn btn-warning"
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
                      &nbsp;
                      <router-link
                        :to="{
                          name: 'DocumentsEdit',
                          params: { id: document.id },
                        }"
                        class="btn btn-warning btn-sm"
                        ><i class="fas fa-pen"></i>&nbsp;Edit</router-link
                      >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import moment from "moment";
import "jquery/dist/jquery.min.js";
import axios from "axios";

export default {
  data() {
    return {
      documents: [],
      select_doc: [],
      categories: [],
      fullname: "",
      empty_document: false,
      category_id: null,
      doc_id: "",
      url: "",
      search: null,
    };
  },
  watch: {
    search() {
      this.getDocuments();
    },
  },
  created() {
    this.getDocuments();
  },
  methods: {
    getDocuments() {
      axios
        .get("/api/drafts/", {
          params: {
            search: this.search,
          },
        })
        .then((result) => {
          this.documents = result.data.documents;
          this.empty_document = result.data.empty_documents;
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    selectedDocument(id) {
      this.doc_id = id;
    },
    generatePDF(id) {
      axios
        .get("/dompdf/" + id)
        .then((result) => {
          this.url = result.data;
          console.log(this.url);
          this.getDocuments();
        })
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