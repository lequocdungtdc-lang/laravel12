import { createRouter, createWebHistory } from 'vue-router'
import UserList from './components/UserList.vue'
import UserForm from './components/UserForm.vue'

const routes = [
  { path: '/', component: UserList },
  { path: '/create', component: UserForm },
  { path: '/edit/:id', component: UserForm }
]

export default createRouter({
  history: createWebHistory('/admin/users'), // 👈 QUAN TRỌNG
  routes
})