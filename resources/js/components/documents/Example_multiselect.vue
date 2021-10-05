<template>
  <div class="container-fluid px-4">
    <h3 class="mt-4">New Document</h3>
    <div class="card border-1 mt-5">
      <div class="card-header"></div>
      <div>
        <div class="card-body">
          <Multiselect
            v-model="value1"
            mode="tags"
            placeholder="Select your characters"
            :options="options"
            :searchable="true"
            :createTag="true"
          />
        </div>
        <div>
          <Multiselect
            v-model="value2"
            mode="multiple"
            placeholder="Select your characters"
            :options="{
              batman: 'Batman',
              robin: 'Robin',
              joker: 'Joker',
            }"
          >
            <template v-slot:multiplelabel="{ values }">
              <div class="multiselect-multiple-label">
                {{ values }} characters selected
              </div>
            </template>
          </Multiselect>
        </div>
        <div>
          <Multiselect
            v-model="value3"
            mode="tags"
            placeholder="Select employees"
            trackBy="name"
            label="name"
            :search="true"
            :options="[
              {
                value: 'judy',
                name: 'Judy',
                image: 'https://randomuser.me/api/portraits/med/women/1.jpg',
              },
              {
                value: 'jane',
                name: 'Jane',
                image: 'https://randomuser.me/api/portraits/med/women/2.jpg',
              },
              {
                value: 'john',
                name: 'John',
                image: 'https://randomuser.me/api/portraits/med/men/1.jpg',
              },
              {
                value: 'joe',
                name: 'Joe',
                image: 'https://randomuser.me/api/portraits/med/men/2.jpg',
              },
            ]"
          >
            <template v-slot:tag="{ option, handleTagRemove, disabled }">
              <div class="multiselect-tag is-user">
                <img :src="option.image" />
                {{ option.name }}
                <i
                  v-if="!disabled"
                  @click.prevent
                  @mousedown.prevent.stop="handleTagRemove(option, $event)"
                />
              </div>
            </template>
          </Multiselect>
        </div>
        <div>
          <div class="form-floating mb-3">
            <select
              v-model="file_ref"
              class="form-control"
              aria-label="Default select example"
            >
              <option
                v-for="ministry in ministries"
                :key="ministry.id"
                :value="ministry.description"
              >
                {{ ministry.code }}
              </option>
            </select>
            <label for="file_ref">File Ref:</label>
          </div>
        </div>
        <div>
          <label class="typo__label">Select with search</label>
          <multiselect
            v-model="value4"
            :options="options"
            :custom-label="addressee"
            placeholder="Select one"
            label="name"
            track-by="name"
          ></multiselect>
          <pre class="language-json"><code>{{ value4  }}</code></pre>
        </div>
        <div>
          {{ value1 }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";

export default {
  components: { Multiselect },
  data() {
    return {
      value1: [],
      value2: [],
      value3: [],
      value4: [],
      options: ["Batman", "Robin", "Joker"],
      ministries: [],
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
          this.options = this.ministries.map((filtered) => `${filtered.SRO} ${", "} ${filtered.code}`);
          // const temp = result.data;
          // this.ministries = temp.filter((ministry) =>
          //   ministry.code.includes("PSO")
          // );
          //this.options = temp;
          console.log(this.options);
          //this.filteredProducts = products.filter(product => product.department.includes('food'))
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
    addressee({ sro, code }) {
      return `${sro} — [${code}]`;
    },
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css">
.multiselect-tag.is-user {
  padding: 5px 8px;
  border-radius: 22px;
  background: #35495e;
  margin: 3px 3px 8px;
}

.multiselect-tag.is-user img {
  width: 18px;
  border-radius: 50%;
  height: 18px;
  margin-right: 8px;
  border: 2px solid #ffffffbf;
}

.multiselect-tag.is-user i:before {
  color: #ffffff;
  border-radius: 50%;
}

.user-image {
  margin: 0 6px 0 0;
  border-radius: 50%;
  height: 22px;
}
</style>