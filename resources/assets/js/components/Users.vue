<template>
  <section class="users">
    <h1>Our Lovely Users</h1>

    <ul>
      <li v-for="user in users" :user="user" is="User" :key="user.id"></li>
    </ul>

    <div class="empty" v-if="!users.length">
      There's no user. Create one using the form below, perhaps?
    </div>

    <form method="post" @submit.prevent="addUser">
      <h2>New User</h2>
      <input type="text" required v-model="newUserName" placeholder="New User Name">
      <input type="submit" value="Add">
    </form>
  </section>
</template>

<script>
  import { http } from '../services'
  import User from './User'
  import store from '../store'

  export default {
    components: { User },

    data () {
      return {
        users: store.users,
        newUserName: '',
      }
    },

    methods: {
      addUser () {
        store.addUser(this.newUserName, () => {
          this.newUserName = ''
        })
      }
    }
  }
</script>

<style scoped>
  form {
    margin-top: 32px;
  }
</style>

