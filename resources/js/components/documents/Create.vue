<template>
  <div class="container-fluid px-4">
    <h3 class="mt-4">New Document</h3>
    <div class="row">
      <div class="col">
        <div class="card mb-4">
          <div class="card-body"></div>
        </div>
      </div>
    </div>
    <form action="">
      <div class="card mb-4">
        <div class="card-header">Document</div>
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
                          id="from"
                          v-model="form.from"
                          mode="tags"
                          class="form-control"
                          :options="options"
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
                          id="to"
                          v-model="form.to"
                          mode="tags"
                          label="To:"
                          :options="options"
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
                      <div class="col">
                        <Multiselect
                          id="attn"
                          v-model="form.attn"
                          mode="tags"
                          :options="options"
                          :searchable="true"
                          :createTag="true"
                        />
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
                          id="cc"
                          v-model="form.cc"
                          mode="tags"
                          label="Cc:"
                          :options="options"
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
          </div>
        </div>
        <div class="card-footer">
          <div class="row align-items-center">
            <div class="col">
              <div class="card">
                <div class="card-header">Options</div>
                <div class="card-body">
                  <div class="form-group row mb-0">
                    <div class="form-group">
                      <label class="checkbox-inline">
                        <span class="m-1">
                          <input
                            type="checkbox"
                            class="m-2"
                            name="for_secretary"
                            v-model="form.for_secretary"
                          />
                          For Secretary
                        </span>
                        <span class="m-1">
                          <input
                            type="checkbox"
                            class="m-2"
                            name="save_draft"
                            v-model="form.save_draft"
                          />Save as Draft
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="col-md-1 offset-md-11">
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
//import Form from 'vform';
export default {
  components: {
    Datepicker,
    Multiselect,
  },
  data() {
    return {
      editor: ClassicEditor,

      editorConfig: {
        //
      },
      date_issued: new Date(),
      ministries: [],
      options: [],
      form: {
        from: "",
        file_ref: "",
        date_issued: "",
        from: [],
        to: [],
        cc: [],
        attn: [],
        subject: "",
        editorData: "<p>Content of the editor.</p>",
        for_secretary: false,
        save_draft: false,
      },
    };
  },
  created() {
    this.getMinistries();
  },
  methods: {
    getMinistries() {
      axios
        .get("/api/documents/ministries")
        .then((result) => {
          this.ministries = result.data;
          this.options = this.ministries.map((filtered) => `${filtered.SRO}`);
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    ckEditorReady(editor) {
      editor.ui.view.editable.element.style.minHeight = "100px";
    },
  },
};
</script>
<style src="@vueform/multiselect/themes/default.css">
.ck-editor .ck-editor__main .ck-content {
  min-height: 500px;
}
</style>