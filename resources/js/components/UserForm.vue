<template>
  <div>
    <h2>{{ form.id ? 'Edit' : 'Create' }}</h2>

    <input v-model="form.name" placeholder="Name" class="form-control mb-2">
    <input v-model="form.email" placeholder="Email" class="form-control mb-2">
    <input v-model="form.password" placeholder="Password" class="form-control mb-2">

    <select v-model="form.role" class="form-control mb-2">
      <option value="user">User</option>
      <option value="admin">Admin</option>
    </select>

    <button @click="save" class="btn btn-success">Save</button>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      form: {
        id: null,
        name: '',
        email: '',
        password: '',
        role: 'user'
      }
    }
  },
  mounted() {
    const id = this.$route.params.id
    if (id) {
      axios.get('/api/users/' + id).then(res => {
        this.form = { ...res.data, password: '' }
      })
    }
  },
  methods: {
    async save() {
      if (this.form.id) {
        await axios.put('/api/users/' + this.form.id, this.form)
      } else {
        await axios.post('/api/users', this.form)
      }

      this.$router.push('/')
    }
  }
}
</script>