<template>
  <div class="container-fluid px-4">
    <h3 class="mt-4">New Template</h3>
    <div class="breadcrumb mt-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-2">
          <li class="breadcrumb-item" aria-current="page">
            <a href="/home">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="/templates">Templates</a>
          </li>
          <li class="breadcrumb-item active">{{ template.id }}</li>
        </ol>
      </nav>
    </div>
    <form @submit.prevent="updateDocument()">
      <div class="card mb-4">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="form-group mt-2">
                <div class="row align-items-center">
                  <div class="col-lg-3">
                    <label for="file_ref">Category:</label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <select
                        v-model="form.category_id"
                        name="category"
                        class="form-select"
                        aria-label="Default select example"
                      >
                        <option
                          v-for="category in categories"
                          :key="category.id"
                          :value="category.name"
                        >
                          {{ category.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="card">
            <div class="card-header">Body</div>
            <div class="card-body">
              <div class="form-group">
                <label for="subject">Subject:</label>
                <input
                  id="subject"
                  v-model="form.subject"
                  type="subject"
                  class="form-control"
                  name="subject"
                  required
                  autocomplete="off"
                />
              </div>
              <div class="form-group mt-2">
                <ckeditor
                  :editor="editor"
                  v-model="form.content"
                  :config="editorConfig"
                  @ready="ckEditorReady"
                ></ckeditor>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row align-items-center">
            <div class="col">
              <div class="col">
                <button
                  type="button"
                  class="btn btn-danger"
                  data-bs-toggle="modal"
                  data-bs-target="#exampleModal"
                >
                  Delete this template
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
                          Template Delete Confirmation!
                        </h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <form @submit.prevent="deleteTemplate(template.id)">
                        <div class="modal-body">
                          <div class="mb-3">
                            Are you sure you want to deleteTemplate this
                            template:
                            <br />
                            ID: {{ template.id }}
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
                                class="btn btn-danger"
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
            </div>
            <div class="col-lg">
              <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import Multiselect from "@vueform/multiselect";

export default {
  components: {
    Multiselect,
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        //
      },
      categories: [],
      template: [],
      form: {
        category_id: "",
        subject: "",
        content: "",
      },
    };
  },
  created() {
    this.getCategories();
    this.getTemplate();
  },
  methods: {
    getCategories() {
      axios
        .get("/api/documents/categories")
        .then((result) => {
          this.categories = result.data;
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    updateDocument() {
      axios
        .put("/api/templates/" + this.$route.params.id, {
          category_id: this.form.category_id,
          subject: this.form.subject,
          content: this.form.content,
        })
        .then((result) => {
          this.message = result.data;
          this.$router.push("/templates");
        });

      // storeAttns();
    },
    getTemplate() {
      axios
        .get("/api/templates/" + this.$route.params.id)
        .then((result) => {
          this.form = result.data.data;
          this.template = result.data.data;
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    deleteTemplate(id) {
      axios.delete("/api/templates/" + id).then((result) => {
        this.message = result.data,
        this.$router.push("/templates");
      });
    },
    // deleteTemplate(id) {
    //   axios.post(`/api/template/${id}`, { params: `${id}`, _method: 'delete'})
    //   .then((result) => {
    //     // this.message = result.data
    //     this.$router.push("/templates");
    //   });
    // },
  },
};
</script>
<style>
</style>