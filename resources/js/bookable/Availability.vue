<template>
  <div>
    <h6 class="text-uppercase text-secondary font-weight-bolder">
      Check Abidlteyafeale
      <span v-if="noAvailability" class="text-danger">(NOT AVAILABLE)</span>
      <span v-if="hasAvailability" class="text-success">(AVAILABLE)</span>
    </h6>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="form">🇫 🇷 ⭕ 🇲</label>
        <input
          type="text"
          class="form-control"
          name=""
          id="form"
          aria-describedby="helpId"
          placeholder="Start Date"
          v-model="from"
          @keyup.enter="check"
          :class="[{ 'is-invalid': this.errorFor('from') }]"
        />

        <small
          id="helpId"
          class="form-text text-muted"
          v-for="(error, index) in this.errorFor('from')"
          :key="'from' + index"
          >{{ error }}
        </small>
      </div>
      <div class="form-group col-md-6">
        <label for="to"> 🇹 ⭕ </label>
        <input
          type="text"
          class="form-control"
          name=""
          id="to"
          aria-describedby="helpId"
          placeholder="End Date"
          v-model="to"
          @keyup.enter="check"
          :class="[{ 'is-invalid': this.errorFor('to') }]"
        />
        <small
          id="helpId"
          class="form-text text-muted"
          v-for="(error, index) in this.errorFor('to')"
          :key="'from' + index"
          >{{ error }}</small
        >
      </div>
    </div>
    <button class="btn btn-secondary btn-block" @click="check" :disabled="loading">
      Check!
    </button>
  </div>
</template>
<script>
export default {
  data() {
    return {
      from: null,
      to: null,
      loading: false,
      status: null,
      errors: null,
    };
  },
  methods: {
    check() {
      this.loading = true;
      this.errors = null;
      axios
        .get(
          `/api/bookables/${this.$route.params.id}/availability?from=${this.from}&to=${this.to}`
        )
        .then((response) => {
          this.status = response.status;
        })
        .catch((error) => {
          if (422 === error.response.status) {
            this.errors = error.response.data.errors;
          }
          this.status = error.response.status;
        })
        .then(() => (this.loading = false));
    },
    errorFor(field) {
      return this.hasErrors && this.errors[field] ? this.errors[field] : null;
    },
  },

  computed: {
    hasErrors() {
      return 422 === this.status && this.errors !== null;
    },
    hasAvailability() {
      return 200 === this.status;
    },
    noAvailability() {
      return 404 === this.status;
    },
  },
};
</script>
