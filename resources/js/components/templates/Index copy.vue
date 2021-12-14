<template>
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Tamplates</h1>
      <div class="breadcrumb mt-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-2">
            <li class="breadcrumb-item" aria-current="page">
              <a href="/home">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Templates</li>
          </ol>
        </nav>
      </div>
      <div class="card mb-4">
        <div class="card-body">
          The list consist of registered templates to speed up the process of
          writing correspondenses. If you want to start a new document, go this
          link:
          <router-link :to="{ name: 'DocumentCreate' }">
            New Document
          </router-link>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <i class="fas fa-table me-1"></i>
              DataTable Example
            </div>
            <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
              <router-link
                :to="{ name: 'TemplatesCreate' }"
                class="btn btn-primary"
              >
                Create New Templates
              </router-link>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
              </tr>
            </tfoot>
            <tbody>
              <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
              </tr>
              <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
              </tr>
            </tbody>
          </table>

          <vuejs-simple-datatable :options="tableOptions"/>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      tableOptions: {
        tableName: "users",
        columns: [
          {
            title: "Name",
            key: "name",
            type: "clickable",
            source: "users",
            uniqueField: "id",
            sortable: true,
          },
          { title: "Age", key: "age", type: "text", sortable: true },
          {
            title: "Salary",
            key: "salary",
            type: "text",
            textAlign: "center",
            currencyFormat: true,
            currencyConfig: { format: "%v %c", code: "USD" },
            sortable: false,
          },
          {
            title: "Created at",
            key: "created_at",
            type: "text",
            dateFormat: true,
            currentFormat: "YYYY-MM-DD h:mm:ss",
            expectFormat: "DD MMM YYYY",
          },
          { title: "Action", type: "component", name: HomeAction },
        ],
        source: "http://demo.datatable/api/users",
        search: true,
      },
    };
  },
  created() {
    this.tableFormating();
  },
  methods: {
    getTemplates() {},
    tableFormating() {
      document.addEventListener("readystatechange", (event) => {
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables/wiki

        const datatablesSimple = document.getElementById("datatablesSimple");
        if (datatablesSimple) {
          new simpleDatatables.DataTable(datatablesSimple);
        }
      });
    },
  },
};
</script>