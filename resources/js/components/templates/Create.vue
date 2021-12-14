<template>
  <div class="container-fluid px-4">
    <h3 class="mt-4">New Template</h3>
    <div class="breadcrumb mt-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-2">
            <li class="breadcrumb-item" aria-current="page">
              <a href="/home">Dashboard</a>
            </li>
            <li class="breadcrumb-item active"><a href="/templates">Templates</a></li>
            <li class="breadcrumb-item active">Add New Template</li>
          </ol>
        </nav>
      </div>
    <form @submit.prevent="storeDocument()">
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
                  v-model="form.editorData"
                  :config="editorConfig"
                  @ready="ckEditorReady"
                ></ckeditor>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row align-items-center">
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
      form: {
        staffs: [],
        category_id: "",
        subject: "",
        editorData: "",
      },
    };
  },
  created() {
    this.getCategories();
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
    storeDocument() {
      axios
        .post("/api/templates", {
          category_id: this.form.category_id,
          subject: this.form.subject,
          content: this.form.editorData,
        })
        .then((result) => {
          this.$router.push('/templates');
        });

      // storeAttns();
    },
  },
  
};

</script>
<style>
</style>