// <template>
//   <vuejs-simple-datatable :options="table Options" />
//   <p>datatable example</p>
// </template>

// <script>

// export default {
//   data() {
//     return {
//       tableOptions: {
//         tableName: "users",
//         columns: [
//           {
//             title: "Name",
//             key: "name",
//             type: "clickable",
//             source: "users",
//             uniqueField: "id",
//             sortable: true,
//           },
//           { title: "Age", key: "age", type: "text", sortable: true },
//           {
//             title: "Salary",
//             key: "salary",
//             type: "text",
//             textAlign: "center",
//             currencyFormat: true,
//             currencyConfig: { format: "%v %c", code: "USD" },
//             sortable: false,
//           },
//           {
//             title: "Created at",
//             key: "created_at",
//             type: "text",
//             dateFormat: true,
//             currentFormat: "YYYY-MM-DD h:mm:ss",
//             expectFormat: "DD MMM YYYY",
//           },
//           { title: "Action", type: "component", name: HomeAction },
//         ],
//         source: "http://demo.datatable/api/users",
//         search: true,
//       },
//     };
//   },
// };
// </script>

// <style>
// </style>