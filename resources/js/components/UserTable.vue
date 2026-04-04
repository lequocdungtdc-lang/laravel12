<template>
  <div>
    <h2>User List</h2>

    <button @click="showForm()" class="btn btn-primary mb-2">Add User</button>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.role }}</td>
          <td>
            <button @click="editUser(user)" class="btn btn-warning btn-sm">Edit</button>
            <button @click="deleteUser(user.id)" class="btn btn-danger btn-sm">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- FORM -->
    <div v-if="formVisible">
      <h3>{{ form.id ? 'Edit' : 'Create' }}</h3>

      <input v-model="form.name" placeholder="Name" class="form-control mb-2">
      <input v-model="form.email" placeholder="Email" class="form-control mb-2">
      <input v-model="form.password" placeholder="Password" class="form-control mb-2">

      <select v-model="form.role" class="form-control mb-2">
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>

      <button @click="saveUser()" class="btn btn-success">Save</button>
    </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: [],
      form: {
        id: null,
        name: '',
        email: '',
        password: '',
        role: 'user'
      },
      formVisible: false
    }
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    async getUsers() {
      const res = await axios.get('/api/users');
      this.users = res.data;
    },

    showForm() {
      this.form = {
        id: null,
        name: '',
        email: '',
        password: '',
        role: 'user'
      };
      this.formVisible = true;
    },

    editUser(user) {
      this.form = {
        ...user,
        password: '' // không load password
      };
      this.formVisible = true;
    },

    async saveUser() {
      try {
        if (this.form.id) {
          // UPDATE
          await axios.put('/api/users/' + this.form.id, this.form);
        } else {
          // CREATE
          await axios.post('/api/users', this.form);
        }

        this.getUsers();
        this.formVisible = false;

      } catch (error) {
        console.log(error.response.data);
        alert('Có lỗi xảy ra!');
      }
    },

    async deleteUser(id) {
      if (confirm('Bạn chắc chắn muốn xoá?')) {
        await axios.delete('/api/users/' + id);
        this.getUsers();
      }
    }
  }
}
</script>