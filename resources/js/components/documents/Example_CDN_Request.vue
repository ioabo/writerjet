<template>
  <div class="container-fluid px-4">
    <h3>Testing site for Create.Vue</h3>
    <multiselect
      :options="options"
      :value="optionsProxy"
      @input="updateSelected"
      @search-change="searchQuery"
      :multiple="true"
      :searchable="true"
      :close-on-select="true"
      placeholder="Search"
      :custom-label="customLabel"
      :loading="showLoadingSpinner"
    ></multiselect>
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";
//import Form from 'vform';
export default {
  components: {
    Multiselect
  },
  data() {
    return {
      options: [],
      optionsProxy: [],
      selectedResources: [],
      showLoadingSpinner: false,
    };
  },
  created() {
    const value = "";
    this.cdnRequest(value);
  },
  methods: {
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
    cdnRequest(value) {
      this.$http
        .get(
          `https://api.cdnjs.com/libraries?search=${value}&fields=version,description`
        )
        .then(
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
    searchQuery(value) {
      this.showLoadingSpinner = true;
      // GET
      this.cdnRequest(value);
    },
    removeDependency(index) {
      this.selectedResources.splice(index, 1);
    },
  },
};
</script>
<style>
.resources-list {
  margin-top: 15px;
  padding: 0;
  list-style: none;
}
.resources-list li {
  display: flex;
  align-items: center;
  min-height: 50px;
  padding: 10px 40px 10px 0;
  border-bottom: 1px solid rgba(51, 51, 51, 0.1);
  position: relative;
}
.resources-list li:last-child {
  border-bottom: none;
}
.resources-list li .resource-title {
  font-size: 1em;
  color: #333;
}
.resources-list li .version {
  opacity: 0.7;
  margin-left: 5px;
  font-size: 75%;
}
.resources-list li .resource-description,
.resources-list li .resource-url {
  font-size: 0.8em;
  color: #999;
  margin-top: 5px;
}
.resources-list li .resource-url {
  margin-top: 0;
}
.resources-list li .resource-description:empty {
  display: none;
}
.resources-list li .delete-controls {
  position: absolute;
  right: 0;
  width: 40px;
  text-align: center;
  color: #999;
  cursor: pointer;
}
.resources-list li .delete-controls:hover,
.resources-list li .delete-controls:focus {
  color: red;
}
</style>