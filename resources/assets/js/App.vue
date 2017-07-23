<template>
  <div>
    <section v-if="ready">
      <p class="greetings">
        Hello {{ admin.name }}. How are you today?
        <a href="#" class="btn btn-default btn-out" @click.prevent="logOut">Log Out</a>
      </p>

      <ul class="menu">
        <li><a href="#users" @click="setView('users')" :class="{ active: view === 'users'}">Users</a></li>
        <li><a href="#groups" @click="setView('groups')" :class="{ active: view === 'groups'}">Groups</a></li>
      </ul>
      <div class="panels">
        <Groups v-show="view === 'groups'"></Groups>
        <Users v-show="view === 'users'"></Users>
      </div>
    </section>
    <LoginForm v-else @loggedin="loggedIn"></LoginForm>
  </div>
</template>
<script>
  import { http, ls } from './services'
  import _ from 'lodash'
  import LoginForm from './components/LoginForm'
  import Groups from './components/Groups'
  import Users from './components/Users'
  import store from './store'

  export default {
    components: { LoginForm, Groups, Users },
    data () {
      return {
        view: 'users',
        admin: null,
        ready: false
      }
    },

    methods: {
      setView (view) {
        this.view = view
      },

      loggedIn (admin) {
        this.admin = admin

        store.fetchData(() => {
          this.ready = true
        })
      },

      logOut () {
        http.post('logout', {}, () => {
          ls.remove('jwt-token')
          document.location.reload()
        })
      }
    },

    mounted () {
      const token = ls.get('jwt-token')
      if (token) {
        http.get('me', response => this.loggedIn(response.data))
      }
    }
  }
</script>

<style lang="scss">
  *, *::before, *::after {
    box-sizing: border-box;
  }

  input, select {
    border: 1px solid #ddd;
    padding: 5px;
    font-family: sans-serif;
    font-size: .8rem;
    background: #fff;
    -webkit-appearance: none;
    border-radius: 0;
  }

  select {
    background: url("data:image/svg+xml;utf8,<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24' height='24' viewBox='0 0 24 24'><path fill='#444' d='M7.406 7.828l4.594 4.594 4.594-4.594 1.406 1.406-6 6-6-6z'></path></svg>");
    background-position: 100% 50%;
    background-repeat: no-repeat;
    padding-right: 25px;
  }

  input:focus {
    border-color: orange;
    outline: none;
  }

  input[type="submit"] {
    background: brown;
    border-color: brown;
    color: #fff;
    padding: 5px 10px;
  }

  h1 {
    font-weight: 100;
    font-size: 1.5rem;
    margin: 1.5rem 0;
  }

  li {
    margin: 10px 0;
  }

  body {
    padding: 40px;
    font-family: sans-serif;
    color: #333;
  }

  form {
    background: #efefef;
    padding: 16px;
    margin-top: 10px;
  }

  li form {
    background: #f9f9f9;
  }

  h2 {
    font-size: 1.3rem;
    margin: 0 0 .7rem;
  }

  .greetings {
    padding: 8px 0;
    border-bottom: 1px solid #eee;

    .btn-out {
      float: right;
      margin-top: -5px;
    }
  }

  li {
    list-style-type: disc;
    margin-left: 20px;

    li {
      list-style-type: circle;
      margin-left: 40px;
    }
  }

  .menu {
    margin: 18px 0 0;

    li {
      display: inline-block;
      list-style-type: none;
      margin: 0 2px;
    }

    a {
      display: inline-block;
      padding: 8px 12px;
      border: 1px solid #ddd;
      margin-bottom: -1px;
      text-decoration: none;
      color: #111;

      &.active {
        margin-bottom: -1px;
        border-bottom-color: #fff;
        border-top: 2px solid orangered;
      }
    }
  }

  .panels > section {
    border: 1px solid #ddd;
    padding: 20px;
  }

  .btn {
    display: inline-block;
    text-decoration: none;
    border: 1px solid #ddd;
    background: #eee;
    padding: 4px;
    font-size: .8rem;
    color: #111;

    &.btn-danger {
      color: #fff;
      background: darkred;
      border-color: darkred;
    }
  }

  .muted {
    color: #888;
  }
</style>
