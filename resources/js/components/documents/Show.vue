<template>
  <div class="container-fluid px-4">
    <h3 class="mt-4">Document</h3>
    <div class="breadcrumb mt-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-2">
          <li class="breadcrumb-item" aria-current="page">
            <a href="/home">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="/documents">Documents</a>
          </li>
          <li class="breadcrumb-item active"> {{ document.category_id }} </li>
        </ol>
      </nav>
    </div>
    <center>
    <div class="col-lg-8 mb-3">
        <div class="card my-6">
            <div class="card-header">
                Correspondence - {{ document.category_id }}
            </div>
            <div class="card-body">
              <div class="col-lg-10">
                <div id="header">
                    <span class="inline_head">Correspondence <br>WriterJet 1.0</span>

                    <span class="inline_head" style="float: right;">
                        created on {{ $date_now }}
                    </span>

                </div>
                <div id="content" style="font-size:15px; text-align:justify;">
                    <center>
                        <br>
                        <p>
                            <b style="font-size: 19px;">Republic of Kiribati</b>
                        </p>
                        <p style="font-size: 13px">
                            <hr>
                            <b>PO box 68, Bairiki, Tarawa: (686) 74022790/74022789, enquiry@pso.gov.ki, Website: www.pso.gov.ki</b>
                            <hr>
                            <h4><b>MEMORANDUM</b></h4>
                        </p>
                    </center>
                    <table>
                        <tr>
                            <th><b>From:</b></th>
                            <td>
                            <span v-for="from_array in from">
                                    {{ from_array }} <br>
                                </span>
                            </td>
                            <th><b>To:</b></th>
                            <td>
                                <span v-for="to_array in to">
                                    {{ to_array }} <br>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th><b>File Ref:</b></th>
                            <td>
                                {{ document.file_ref }}
                            </td>
                            <th><b>Attn:</b></th>
                            <td>
                                <span v-for="attn_array in attn">
                                    {{ attn_array }} <br>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th><b>Date</b></th>
                            <td>
                                {{ document.date_issued }}
                            </td>
                            <th><b>Cc:</b></th>
                            <td>
                                <span v-for="cc_array in cc">
                                    {{ cc_array }} <br>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="subject"><b>Subject:</b> {{ document.subject }}</td>
                        </tr>
                    </table>
                    <br>
                    <span class="content" v-html="document.content"></span>
                    <br /><br />
                    ........................... 
                    <br>
                    
                    {{ document.user_id }}
                
                </div>
              </div>
            </div>
        </div>
    </div>
    </center>
  </div>
</template>

<script>
// import image from "/home/its/writerjet2.corrupt/public/images/NationalEmblem4.png"

export default {
  data() {
    return {
      date_issued: new Date(),
      ministries: [],
      categories: [],
      doc_status: "",
      document: [],
      from: [],
      to: [],
      attn: [],
      cc: [],
    };
  },
  created() {
    this.getDocument();
  },
  methods: {
    getDocument() {
      axios
        .get("/api/documents/" + this.$route.params.id)
        .then((result) => {
          this.document = result.data.data;
          this.from = result.data.data.from.split("|");
          this.to = result.data.data.to.split("|");
          this.cc = result.data.data.cc.split("|");
          this.attn = result.data.data.attn.split("|");
          this.staffs = result.data.data.staffs.split("|");
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
  },
};
</script>

<style scoped>
@page {
  margin: 80px 70px;
}

#header {
  position: fixed;
  left: 0px;
  top: -50px;
  right: 0px;
  height: 50px;
  text-align: left;
  font-size: 10px;
}

#footer {
  position: fixed;
  left: 0px;
  bottom: -20px;
  right: 0px;
  height: 50px;
  padding-left: 10px;
  text-align: center;
  font-size: 10px;
}

#footer .page:after {
  content: counter(page, upper-roman);
}

.content >>> table {
  width: 100%;
  margin-bottom: 1rem;
  vertical-align: top;
  border: 1px #111311 solid;
  font-size: 14px;
  border-collapse: collapse;
}

.dataTable-table,
th,
td {
  width: 100%;
  margin-bottom: 1rem;
  vertical-align: top;
  border: 1px #111311 solid;
  font-size: 14px;
  border-collapse: collapse;
}

th,
td {
  padding-left: 5px;
}

td {
    width: 40%;
}

th {
  width: 10%;
  text-align: left;
}

td.subject {
  padding: 8px;
}

span .inline_head {
  display: inline-block;
}
hr {
  margin-top: 3px;
  margin-bottom: 3px;
  border-top: 0.5px solid #9da09d;
}
</style>