<template>
  <div class="container-fluid px-4">
    <h1 class="mt-4">New Document</h1>
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
                <label for="from"></label>
              </div>

              <!-- <div class="form-floating mb-3">
                <input
                  id="from"
                  v-model="form.from"
                  type="text"
                  class="form-control"
                  name="from"
                  placeholder="name@example.com"
                  required
                  autofocus
                  autocomplete="off"
                />

                <label for="from">From:</label>
              </div> -->
              <div class="form-floating mb-3">
                <input
                  id="file_ref"
                  v-model="form.file_ref"
                  type="text"
                  class="form-control"
                  name="file_ref"
                  placeholder="name@example.com"
                  required
                  autofocus
                  autocomplete="off"
                />
                <label for="file_ref">File Ref:</label>
              </div>
              <div class="form-floating mb-3">
                <datepicker
                  id="date_issued"
                  v-model="form.date_issued"
                  class="form-control"
                  placeholder=""
                  :locale="locale"
                  :upperLimit="to"
                  :lowerLimit="from"
                  :clearable="true"
                  :typeable="true"
                />
                <label for="date_issued"></label>
              </div>
            </div>
            <!-- end of col -->
            <div class="col">
              <div class="form-floating mb-3">
                <!-- <input
                  id="to"
                  type="to"
                  class="form-control"
                  name="to"
                  value=""
                  required
                  placeholder="name@example.com"
                  autofocus
                  autocomplete="off"
                /> -->
                <b-form-tags
                  input-id="tags-basic"
                  v-model="form.to"
                ></b-form-tags>
                <p class="mt-2">Value: {{ to }}</p>
                <label for="tags-basic">To:</label>
              </div>
              <div class="form-floating mb-3">
                <input
                  id="attn"
                  type="attn"
                  class="form-control"
                  name="attn"
                  value=""
                  required
                  placeholder="name@example.com"
                  autofocus
                  autocomplete="off"
                />
                <label for="attn">Attn:</label>
              </div>
              <div class="form-floating mb-3">
                <input
                  id="cc"
                  type="cc"
                  class="form-control"
                  name="cc"
                  value=""
                  required
                  placeholder="name@example.com"
                  autofocus
                  autocomplete="off"
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
      form: {
        from: "",
        file_ref: "",
        date_issued: "",
        from: [],
        to: [],
      },

      options: ["Batman", "Robin", "Joker"],
    };
  },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>