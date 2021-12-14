<template>
  <div class="container-fluid px-4">
    <div class="breadcrumb mt-4 shadow-lg">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-2">
          <li class="breadcrumb-item" aria-current="page">Dashboard</li>
        </ol>
      </nav>
    </div>

    <div class="row justify-content">
      <div class="col-lg-3 mb-3">
        <div class="card p-4 shadow-lg">
          <div
            class="
              image
              d-flex
              flex-column
              justify-content-center
              align-items-center
            "
          >
            <div
              class="
                flex-column
                justify-content-center
                align-items-center
                alert-secondary
                p-3
              "
            >
              <span class="name mt-3">{{ user_details.name }}</span>
              |
              <span class="idd">
                <i> {{ user_details.email }} </i></span
              >
            </div>

            <div
              v-if="user_details.registration_status != 'Pending'"
              class="
                d-flex
                flex-row
                justify-content-center
                align-items-center
                mt-3
              "
            >
              <span class="number">
                <center>
                  <hr />
                  <b>{{ draft }}</b>
                  <span class="follow"> Draft Documents</span> <br />
                  <b>{{ final }}</b>
                  <span class="follow"> Final Documents</span> <br />
                  <hr />
                  <b>{{ total_docs }}</b>
                  <span class="follow"> Documents Created in Total </span>
                  <hr />
                </center>
              </span>
            </div>
            <div
              v-if="user_details.registration_status != 'Pending'"
              class="mt-2"
            >
              <a
                href="/documents"
                class="
                  btn btn-dark
                  d-grid
                  gap-2
                  d-md-flex
                  justify-content-md-center
                "
                >My Documents
                <span class="badge alert-light"
                  ><b>{{ total_docs }}</b></span
                ></a
              >
            </div>
            <div class="px-2 rounded mt-4 date">
              <span class="join"
                >Joined {{ format_date(user_details.created_at) }}</span
              >
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card mb-4 shadow-lg">
          <div class="card-header">
            <i class="fas fa-chart-bar me-1"></i>
            User Documents against Overall
          </div>
          <div class="card-body">
            <UserDocumentsChart
              v-if="user_loaded"
              v-bind:chartData="userDocuments"
              v-bind:chartOPtions="options"
            />
          </div>
          <div class="card-footer small text-muted">
            <button
              class="btn btn-secondary btn-sm"
              @click="getUserDocuments()"
            >
              <i class="fas fa-sync"></i> Refresh this graph
            </button>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card mb-4 shadow-lg">
          <div class="card-header">
            <i class="fas fa-chart-bar me-1"></i>
            Documents Totals by Categories
          </div>
          <div class="card-body">
            <CategoriesChart
              v-if="cat_loaded"
              v-bind:chartData="categories"
              v-bind:chartOPtions="options"
            />
          </div>
          <div class="card-footer small text-muted">
            <button
              class="btn btn-secondary btn-sm"
              @click="getCategoriesCounts()"
            >
              <i class="fas fa-sync"></i> Refresh this graph
            </button>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card mb-4 shadow-lg">
          <div class="card-header">
            <i class="fas fa-chart-bar me-1"></i>
            Daily Documents
          </div>
          <div class="card-body">
            <DailyCountsChart
              v-if="daily_loaded"
              v-bind:chartData="daily_counts"
              v-bind:chartOPtions="options"
            />
          </div>
          <div class="card-footer small text-muted">
            <button class="btn btn-secondary btn-sm" @click="getDailyCounts()">
              <i class="fas fa-sync"></i> Refresh this graph
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- row1 end -->
    <div class="row justify-content">
      <div class="col">
        <div class="card mb-4 shadow-lg">
          <div class="card-header">
            <h5>Recent Documents</h5>
          </div>
          <div class="card-body">
            <table class="table table-borderless table-secondary">
              <thead class="table-dark">
                <tr>
                  <th style="width: 8%">File Ref</th>
                  <th style="width: 14%">Categories</th>
                  <th>Subjects</th>
                  <th style="width: 10%">Date</th>
                  <th style="width: 20%">User</th>
                </tr>
              </thead>
              <tr v-for="document in recent_docs" :key="document.id">
                <td scope="row">{{ document.file_ref }}</td>
                <td>{{ document.category_id }}</td>
                <td>{{ document.subject }}</td>
                <td>{{ format_date(document.created_at) }}</td>
                <td>{{ document.name }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import { defineComponent } from "vue";
import DailyCountsChart from "./charts/DailyCountsChart.vue";
import CategoriesChart from "./charts/CategoriesChart.vue";
import UserDocumentsChart from "./charts/UserDocumentsChart.vue";
import axios from "axios";
import { defineComponent } from "@vue/runtime-core";
import moment from "moment";

export default defineComponent({
  components: {
    CategoriesChart,
    DailyCountsChart,
    UserDocumentsChart,
  },
  name: "App",
  data() {
    return {
      userDocuments: {},
      categories: {},
      daily_counts: {},
      options: {
        responsive: true,
        maintainAspectRatio: true,
        beginAtZero: true,
      },
      user_details: [],
      user_loaded: false,
      cat_loaded: false,
      daily_loaded: false,
      draft: 0,
      final: 0,
      total_docs: 0,
      recent_docs: [],
    };
  },

  created() {
    this.getUserDocuments();
    this.getUserDetails();
    this.getCategoriesCounts();
    this.getDailyCounts();
    this.getRecentDocs();
  },

  // mounted() {
  //   this.getCategoriesCounts();
  // },

  methods: {
    getUserDocuments() {
      this.user_loaded = false;
      axios
        .get("/api/userdocuments")
        .then((result) => {
          const result1 = result.data;

          // const labels = overall.map((filtered) => `${filtered.category_id}`);
          const overall_data = result1.map((filtered) => `${filtered.total}`);
          const perUser_data = result1.map((filtered) => `${filtered.perUser}`);

          this.userDocuments = {
            labels: ["Overall", "This User"],
            datasets: [
              {
                label: "# of Documents for this User",
                data: [overall_data, perUser_data],
                backgroundColor: [
                  "rgba(255, 206, 86, 0.5)",
                  "rgba(255, 99, 132,0.5)",
                ],
                borderColor: ["rgba(255, 205, 86, 1)", "rgba(255, 99, 132,1)"],
                borderWidth: 1,
              },
            ],
          };

          this.user_loaded = true;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getCategoriesCounts() {
      this.cat_loaded = false;
      axios
        .get("/api/categories")
        .then((result) => {
          const overall = result.data;

          const labels = overall.map((filtered) => `${filtered.category_id}`);
          const data = overall.map((filtered) => `${filtered.total}`);
          const perUser_data = overall.map((filtered) => `${filtered.perUser}`);

          this.categories = {
            labels: labels,
            datasets: [
              {
                label: "# of Documents for this User",
                data: perUser_data,
                backgroundColor: "rgba(255, 99, 132,0.5)",
                borderColor: "rgba(255, 99, 132,1)",
                borderWidth: 1,
              },
              {
                label: "# of Overall Documents",
                data: data,
                backgroundColor: "rgba(54, 162, 235, 0.5)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
              },
            ],
          };

          this.cat_loaded = true;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getDailyCounts() {
      (this.daily_loaded = false),
        axios
          .get("/api/dailycounts")
          .then((result) => {
            const overall = result.data;

            const labels = overall.map((filtered) => `${filtered.date}`);
            const data = overall.map((filtered) => `${filtered.total}`);
            const perUser_data = overall.map(
              (filtered) => `${filtered.perUser}`
            );

            this.daily_counts = {
              labels: labels,
              datasets: [
                {
                  label: "# of Documents for this User",
                  data: perUser_data,
                  backgroundColor: "rgba(255, 99, 132,0.5)",
                  borderColor: "rgba(255, 99, 132,1)",
                  borderWidth: 1,
                },
                {
                  label: "# of Overall Documents",
                  data: data,
                  backgroundColor: "rgba(75, 192, 192, 0.5)",
                  borderColor: "rgba(75, 192, 192, 1)",
                  borderWidth: 1,
                },
              ],
            };
            this.daily_loaded = true;
          })
          .catch((error) => {
            console.log(error);
          });
    },
    getUserDetails() {
      axios
        .get("/api/userprofile")
        .then((result) => {
          this.user_details = result.data.user_details[0];
          if (result.data.counts[0].status === "Final") {
            this.final = result.data.counts[0].total;
            this.total_docs = this.draft + this.final;
          } else {
            this.draft = result.data.counts[0].total;
            this.final = result.data.counts[1].total;
            this.total_docs = this.draft + this.final;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getRecentDocs() {
      axios
        .get("/api/recentdocs")
        .then((result) => {
          this.recent_docs = result.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    format_date(value) {
      if (value) {
        return moment(String(value)).format("DD MMM, YYYY");
      }
    },
  },
});
</script>

<style scoped>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>