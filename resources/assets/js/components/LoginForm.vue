<template>
  <section class="login">
    <h1>Let's Log In First</h1>

    <form method="post" action="/api/v1/login" @submit.prevent="login">
      <div class="error" v-if="error">Failed to log in. Please try again.</div>
      <input type="text" required v-model="credentials.username" name="username">
      <input type="password" required v-model="credentials.password" name="password">
      <input type="submit" value="Log In">
    </form>
  </section>
</template>

<script>
  import { http } from '../services'

  export default {
    data () {
      return {
        error: false,
        credentials: {
          username: 'admin',
          password: 'password'
        }
      }
    },

    methods: {
      login() {
        http.post('login', this.credentials, response => {
          this.error = false
          this.$emit('loggedin', response.data)
        }, () => {
          this.error = true
        })
      }
    }
  }
</script>
