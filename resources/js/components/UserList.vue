<template>
  <div>
    <h2>User List</h2>

    <router-link to="/create" class="btn btn-primary mb-2">
      Add
    </router-link>

    <table class="table">
      <tr v-for="u in users" :key="u.id">
        <td>{{ u.name }}</td>
        <td>{{ u.email }}</td>
        <td>{{ u.role }}</td>
        <td>
          <router-link :to="'/edit/'+u.id" class="btn btn-warning btn-sm">Edit</router-link>
          <button @click="del(u.id)" class="btn btn-danger btn-sm">Delete</button>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return { users: [] }
  },
  mounted() {
    this.load()
  },
  methods: {
    async load() {
      const res = await axios.get('/api/users')
      this.users = res.data
    },
    async del(id) {
      if (confirm('Xoá?')) {
        await axios.delete('/api/users/' + id)
        this.load()
      }
    }
  }
}
</script>