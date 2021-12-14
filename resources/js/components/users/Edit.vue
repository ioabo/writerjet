<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card shadow-lg border-0 rounded-lg mt-4 mb-5">
        <div class="card-header">User</div>

        <div class="card-body">
          <form>
            <div class="form-floating mb-3">
              <input
                id="name"
                type="name"
                class="form-control"
                name="name"
                required
                placeholder="name@example.com"
                autofocus
              />
              <label for="name">Name</label>
            </div>

            <div class="form-floating mb-3">
              <input
                id="type"
                type="jobTitle"
                class="form-control"
                name="type"
                required
                placeholder="jobTitle@example.com"
                autofocus
              />
              <label for="jobTitle">Type</label>

              <input
                id="registration_status"
                type="registration_status"
                class="form-control"
                name="registration_status"
                value="Pending"
                hidden
              />
            </div>

            <div class="form-floating mb-3">
              <input
                id="email"
                type="email"
                class="form-control"
                name="email"
                required
                placeholder="name@example.com"
                autofocus
              />
              <label for="email">Email Address</label>
            </div>

            <div class="form-floating mb-3">
              <input
                id="password"
                type="password"
                class="form-control"
                name="password"
                required
                placeholder="Password"
              />
              <label for="password">Password</label>
            </div>

            <div class="form-floating mb-3">
              <input
                id="password-confirm"
                type="password"
                class="form-control"
                name="password-confirm"
                required
              />
              <label for="password-confirm">Password</label>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: "",
        type: "",
        email: "",
        registration_status: "",
      },
    };
  },
  methods: {
    getTemplate() {
      axios
        .get("/api/templates/" + this.$route.params.id)
        .then((result) => {
          this.form = result.data.data;
          this.template = result.data.data;
        })
        .catch((error) => {
          console.log(console.error);
        });
    },
  },
};
</script>

<style>
</style>