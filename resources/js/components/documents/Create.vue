<template>
  <div class="container-fluid px-4">
    <h3 class="mt-4">New Document</h3>
    <div class="card border-1 mt-5">
      <div class="card-header">
        <div class="row">
          <div class="row">
            <div class="col"></div>
            <div class="col">
              <a href="" class="offset-md-11">Back</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form @submit.prevent="">
          <div class="row">
            <div class="col">
              <div class="form-floating mb-3">
                <Multiselect
                  id="from"
                  v-model="form.from"
                  mode="tags"
                  class="form-control"
                  placeholder=""
                  label="From:"
                  :options="options"
                  :searchable="true"
                  :createTag="true"
                />
                <label for="from">From:</label>
              </div>
              <div class="form-floating mb-3">
                <select
                  v-model="form.file_ref"
                  class="form-control"
                  aria-label="Default select example"
                >
                  <option
                    v-for="ministry in ministries"
                    :key="ministry.id"
                    :value="ministry.id"
                  >
                    {{ ministry.code }}
                  </option>
                </select>
                <label for="file_ref">File Ref:</label>
              </div>
              <div class="form-floating mb-3">
                <!-- <datepicker
                  id="date_issued"
                  v-model="form.date_issued"
                  class="form-control"
                  placeholder=""
                  :locale="locale"
                  :upperLimit="to"
                  :lowerLimit="from"
                  :clearable="false"
                  :typeable="true"
                  autocomplete="off"
                  label="Date"
                /> -->
                <input
                  id="date_issued"
                  v-model="form.date_issued"
                  type="date"
                  class="form-control"
                  name="date_issued"
                  placeholder="name@example.com"
                  required
                  autofocus
                  autocomplete="off"
                />
                <label for="date_issued">Date:</label>
              </div>
            </div>
            <!-- end of col -->
            <div class="col">
              <div class="form-floating mb-3">
                <Multiselect
                  id="to"
                  v-model="form.to"
                  mode="tags"
                  class="form-control"
                  placeholder=""
                  label="To:"
                  :options="options"
                  :searchable="true"
                  :createTag="true"
                />
                <label for="tags-basic">To:</label>
              </div>
              <div class="form-floating mb-3">
                <Multiselect
                  id="attn"
                  v-model="form.attn"
                  mode="tags"
                  class="form-control"
                  placeholder=""
                  label="Attn:"
                  :options="options"
                  :searchable="true"
                  :createTag="true"
                />
                <label for="attn">Attn:</label>
              </div>
              <div class="form-floating mb-3">
                <Multiselect
                  id="cc"
                  v-model="form.cc"
                  mode="tags"
                  class="form-control"
                  placeholder=""
                  label="Cc:"
                  :fields="fields"
                  :options="options2"
                  :searchable="true"
                  :createTag="true"
                />
                <label for="cc">Cc:</label>
              </div>
            </div>
            <!-- end of col -->
          </div>
          <!-- end of row -->
          <div class="row">
            <div class="col">
              <div class="form-floating mb-3">
                <input
                  id="subject"
                  type="subject"
                  class="form-control"
                  name="subject"
                  value=""
                  required
                  placeholder="name@example.com"
                  autofocus
                  autocomplete="off"
                />
                <label for="subject">Subject:</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-floating mb-3">
                <ckeditor
                  :editor="editor"
                  v-model="editorData"
                  :config="editorConfig"
                ></ckeditor>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-1 offset-md-11">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </div>
            <!-- end of col -->
          </div>
          <!-- end of row -->
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import Datepicker from "vue3-datepicker";
import Multiselect from "@vueform/multiselect";
//import Form from 'vform';
export default {
  components: {
    Datepicker,
    Multiselect,
  },
  data() {
    return {
      editor: ClassicEditor,
      editorData: "<p>Content of the editor.</p>",
      editorConfig: {
        // The configuration of the editor.
      },
      date_issued: new Date(),
      ministries: [],
      code: [],
      options: [],
      optionsProxy: [],
      selectedResources: [],
      showLoadingSpinner: false,
      form: {
        from: "",
        file_ref: "",
        date_issued: "",
        from: [],
        to: [],
        cc: [],
        attn: [],
      },
    };
  },
  created() {
    this.getMinistries();
    const value = "";
    this.cdnRequest();
  },
  methods: {
    getMinistries() {
      axios
        .get("/api/documents/ministries")
        .then((result) => {
          this.ministries = result.data;
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    customLabel(option) {
      return `${option.name} — ${option.version}`;
    },
    updateSelected(value) {
      value.forEach((resource) => {
        // Adds selected resources to array
        this.selectedResources.push(resource);
      });
      // Clears selected array
      // This prevents the tags from being displayed
      this.optionsProxy = [];
    },
    cdnRequest() {
      axios.get("/api/documents/ministries").then(
        (response) => {
          // get body data
          this.options = [];
          response.body.results.forEach((object) => {
            this.options.push(object);
          });
          this.showLoadingSpinner = false;
        },
        (response) => {
          // error callback
        }
      );
    },
    // searchQuery(value) {
    //   this.showLoadingSpinner = true;
    //   // GET
    //   this.cdnRequest(value);
    // },
    removeDependency(index) {
      this.selectedResources.splice(index, 1);
    },
  },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>