<template>
  <div class="container-fluid px-4">
    <h3 class="mt-4">New Document From Template</h3>
    <div class="breadcrumb mt-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-2">
          <li class="breadcrumb-item" aria-current="page">
            <a href="/home">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="/templates">Templates</a>
          </li>
          <li class="breadcrumb-item active">Add New Document</li>
        </ol>
      </nav>
    </div>
    <form @submit.prevent="storeDocument()">
      <div class="card mb-4">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <div class="form-group mt-2">
                <div class="row align-items-center">
                  <div class="col-lg-3">
                    <label for="category">Category:</label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input
                        type="text"
                        v-model="from_template.category_id"
                        class="form-control"
                        id="category_id"
                        name="category_id"
                        readonly
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="form-group mt-2">
                <div
                  class="row align-items-center"
                  v-if="
                    form.category_id != 'Reinstatement' ||
                    form.category_id === ''
                  "
                >
                  <div class="col-lg-5">
                    <label for="staffs"
                      >Select OR write name of staff concerned:</label
                    >
                  </div>
                  <div class="col">
                    <!-- <input
                        type="text"
                        class="form-control"
                        value=""
                        data-role="tagsinput"
                      /> -->
                    <Multiselect
                      id="staffs"
                      v-model="staffs.values"
                      mode="tags"
                      class="form-select"
                      :searchable="true"
                      :createTag="true"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-5">
              <div class="card">
                <div class="card-header">Header</div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="row align-items-center">
                      <div class="col-lg-2">
                        <label for="from">From:</label>
                      </div>
                      <div class="col">
                        <Multiselect
                          @change="
                            optionsFor_To();
                            optionsFor_Cc();
                          "
                          id="from"
                          v-model="from.values"
                          mode="single"
                          class="form-control"
                          :options="from.options"
                          :searchable="true"
                          :createTag="true"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="form-group mt-2">
                    <div class="row align-items-center">
                      <div class="col-lg-2">
                        <label for="file_ref">File Ref:</label>
                      </div>
                      <div class="col">
                        <input
                          id="file_ref"
                          v-model="form.file_ref"
                          type="text"
                          class="form-control"
                          name="file_ref"
                          required
                          autocomplete="off"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="form-group mt-2">
                    <div class="row align-items-center">
                      <div class="col-lg-2">
                        <label for="date_issued">Date:</label>
                      </div>
                      <div class="col">
                        <datepicker
                          id="date_issued"
                          v-model="form.date_issued"
                          class="form-control"
                          :locale="locale"
                          :upperLimit="to"
                          :lowerLimit="from"
                          :clearable="false"
                          :typeable="true"
                          autocomplete="off"
                          label="Date"
                        />
                        <!-- <input
                  id="date_issued"
                  v-model="form.date_issued"
                  type="date"
                  class="form-control"
                  name="date_issued"
                  placeholder="name@example.com"
                  required
                  autofocus
                  autocomplete="off"
                /> -->
                      </div>
                    </div>
                  </div>
                  <div class="form-group mt-2">
                    <div class="row align-items-center">
                      <div class="col-lg-2">
                        <label for="tags-basic">To:</label>
                      </div>
                      <div class="col">
                        <Multiselect
                          @change="
                            optionsFor_Cc();
                            optionsFor_From();
                          "
                          id="to"
                          v-model="to.values"
                          mode="tags"
                          label="To:"
                          :options="to.options"
                          :searchable="true"
                          :createTag="true"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="form-group mt-2">
                    <div class="row align-items-center">
                      <div class="col-lg-2">
                        <label for="attn" class="">Attn:</label>
                      </div>
                      <div class="col-lg-8">
                        <Multiselect
                          id="attn"
                          v-model="attn.values"
                          mode="tags"
                          :options="attn.options"
                          :searchable="true"
                          :createTag="true"
                        />
                      </div>
                      <div class="col-lg-2">
                        <button
                          type="button"
                          class="btn btn-success form-control px-1 ml-1"
                          data-bs-toggle="modal"
                          data-bs-target="#exampleModal"
                        >
                          New
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
                                  New Job Title Form
                                </h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <form
                                  @submit.prevent="
                                    storeAttn();
                                    optionsFor_Attn();
                                    clearModalFields();
                                  "
                                >
                                  <div class="mb-3">
                                    <label
                                      for="exampleInputEmail1"
                                      class="form-label"
                                      >Job Title</label
                                    >
                                    <input
                                      v-model="modal.jobTitle"
                                      type="text"
                                      class="form-control"
                                      id="jobTitle"
                                      aria-describedby="titleHelp"
                                      autocomplete="off"
                                    />
                                    <div id="titleHelp" class="form-text">
                                      Only enter the job title that has not yet
                                      registered in the system.
                                    </div>
                                  </div>
                                  <div class="mb-3">
                                    <label for="description" class="form-label"
                                      >Description</label
                                    >
                                    <textarea
                                      v-model="modal.description"
                                      type="text"
                                      class="form-control"
                                      id="description"
                                      aria-describedby="descHelp"
                                    />
                                    <div id="descHelp" class="form-text">
                                      Brief description of the Job title.
                                    </div>
                                  </div>
                                  <div class="mb-3">
                                    <button
                                      type="submit"
                                      class="btn btn-primary"
                                      data-bs-dismiss="modal"
                                    >
                                      Save
                                    </button>
                                  </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button
                                  type="button"
                                  class="btn btn-warning"
                                  data-bs-dismiss="modal"
                                >
                                  Close
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- end modal -->
                      </div>
                    </div>
                  </div>
                  <div class="form-group mt-2">
                    <div class="row align-items-center">
                      <div class="col-lg-2">
                        <label for="cc">Cc:</label>
                      </div>
                      <div class="col">
                        <Multiselect
                          @change="
                            optionsFor_From();
                            optionsFor_To();
                          "
                          id="cc"
                          v-model="cc.values"
                          mode="tags"
                          label="Cc:"
                          :options="cc.options"
                          :searchable="true"
                          :createTag="true"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg">
              <div class="card">
                <div class="card-header">Body</div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input
                      id="subject"
                      v-model="from_template.subject"
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
                      v-model="from_template.content"
                      :config="editorConfig"
                      @ready="
                        ckEditorReady();
                        tableClass_CKEditor();
                      "
                    ></ckeditor>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row align-items-center">
            <div class="col-lg-11">
              <div class="form-group row mb-0">
                <div class="form-group">
                  <label class="checkbox-inline">
                    <span class="m-1">
                      <input
                        id="for_sec"
                        type="checkbox"
                        class="m-2"
                        name="for_secretary"
                        v-model="form.for_secretary"
                      />
                      <label for="for_sec">For Secretary</label>
                    </span>
                    <!-- <span class="m-1">
                      <input
                        id="draft"
                        type="checkbox"
                        class="m-2"
                        name="save_draft"
                        v-model="form.save_draft"
                      /><label for="draft">Save as Draft</label>
                    </span> -->
                  </label>
                </div>
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
import Datepicker from "vue3-datepicker";
import Multiselect from "@vueform/multiselect";
import { ref } from "vue";
//import Form from 'vform';
export default {
  components: {
    Datepicker,
    Multiselect,
  },
  data() {
    return {
      editor: ClassicEditor,
      showModal: false,
      editorConfig: {
        //
      },
      date_issued: new Date(),
      ministries: [],
      categories: [],
      doc_status: "",
      document: [],
      from: {
        values: "",
        options: [],
      },
      to: {
        values: [],
        options: [],
      },
      cc: {
        values: [],
        options: [],
      },
      attn: {
        values: [],
        options: [],
      },
      staffs: {
        values: [],
        options: [],
      },
      form: {
        file_ref: "",
        date_issued: null,
        for_secretary: false,
        pdf_url: "place/to/store/this/file",
        user_id: this.$userId,
      },
      from_template: {
        category_id: "",
        subject: "",
        content: "",
      },
      modal: {
        jobTitle: "",
        description: "",
      },
    };
  },
  created() {
    this.getTemplates();
    this.getMinistries();
    this.optionsFor_Attn();
  },
  methods: {
    getMinistries() {
      axios
        .get("/api/documents/ministries")
        .then((result) => {
          this.ministries = result.data;
          this.from.options = this.ministries.map(
            (filtered) => `${filtered.SRO}`
          );
          this.to.options = this.ministries.map(
            (filtered) => `${filtered.SRO}`
          );
          this.cc.options = this.ministries.map(
            (filtered) => `${filtered.SRO}`
          );
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    optionsFor_To() {
      axios
        .get("/api/documents/ministries")
        .then((result) => {
          const result1 = result.data;
          const result2 = result1.map((filtered) => `${filtered.SRO}`);
          const result3 = result2.filter(
            (ministry) => !this.from.values.includes(ministry)
          );
          const result4 = result3.filter(
            (ministry2) => !this.cc.values.includes(ministry2)
          );
          this.to.options = result4;
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    optionsFor_Cc() {
      axios
        .get("/api/documents/ministries")
        .then((result) => {
          const result1 = result.data;
          const result2 = result1.map((filtered) => `${filtered.SRO}`);
          const result3 = result2.filter(
            (ministry) => !this.from.values.includes(ministry)
          );
          const result4 = result3.filter(
            (ministry2) => !this.to.values.includes(ministry2)
          );
          this.cc.options = result4;
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    optionsFor_Attn() {
      axios
        .get("/api/documents/jobs")
        .then((result) => {
          const result1 = result.data;
          this.attn.options = result1.map((filtered) => `${filtered.title}`);
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    optionsFor_From() {
      axios
        .get("/api/documents/ministries")
        .then((result) => {
          const result1 = result.data;
          const result2 = result1.map((filtered) => `${filtered.SRO}`);
          const result3 = result2.filter(
            (ministry) => !this.to.values.includes(ministry)
          );
          const result4 = result3.filter(
            (ministry2) => !this.cc.values.includes(ministry2)
          );
          this.from.options = result4;
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    getTemplates() {
      axios
        .get("/api/document/" + this.$route.params.id)
        .then((result) => {
          this.from_template = result.data.data;
          // const result1 = result.data.data;
          console.log(result1);
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    clearModalFields() {
      this.modal.jobTitle = "";
      this.modal.description = "";
    },
    ckEditorReady(editor) {
      editor.ui.view.editable.element.style.minHeight = "100px";
    },
    storeDocument() {
      // if (this.save_draft === false) {
      //   this.doc_status = "Final";
      // } else {
      //   this.doc_status = "Draft";
      // }
      axios
        .post("/api/documents", {
          staffs: this.staffs.values.join("|"),
          category_id: this.from_template.category_id,
          from: this.from.values,
          to: this.to.values.join("|"),
          file_ref: this.form.file_ref,
          attn: this.attn.values.join("|"),
          date_issued: this.form.date_issued,
          cc: this.cc.values.join("|"),
          subject: this.from_template.subject,
          content: this.from_template.content,
          for_secretary: this.form.for_secretary,
          status: "Draft",
          pdf_url: this.form.pdf_url,
          user_id: this.form.user_id,
        })
        .then((result) => {
          this.$router.push({ name: "DocumenstIndex" });
        });

      // storeAttns();
    },
    storeAttn() {
      axios.post("/api/jobs", {
        title: this.modal.jobTitle,
        description: this.modal.description,
      });

      // storeAttns();
    },
    format_date(value) {
      if (value) {
        return moment(String(value)).format("YYYYMMDD");
      }
    },
    onEditorReady() {
      const myClass = "table";
      const addCustomClass = () =>
        this.$el.nextSibling
          .querySelector(".ck-content")
          .classList.add(myClass);

      this.$nextTick(addCustomClass);
    },
    tableClass_CKEditor() {
      var dialogName = ev.data.name;
      var dialogDefinition = ev.data.definition;

      if (dialogName === "table") {
        var addCssClass = dialogDefinition
          .getContents("advanced")
          .get("advCSSClasses");
        addCssClass["default"] = "table-class";
      }
    },
  },
};

// window.addEventListener("DOMContentLoaded", (event) => {
//   $("input").val();
//   $("input").tagsinput("items");
// });
</script>
<style src="@vueform/multiselect/themes/default.css">
.ck-editor .ck-editor__main .ck-content {
  min-height: 500px;
}
</style>