<template>
  <li class="group">
    {{ group.name }} <span class="muted">– {{ numberOfUsers }} user(s)</span>
    <a href="#" v-if="numberOfUsers" @click.prevent="showingUsers = !showingUsers" class="btn btn-default">Show</a>
    <ul class="show-users" v-if="showingUsers && numberOfUsers">
       <li v-for="user in groupUsers" :key="user.id">
         {{ user.name }}
         <a href="#" @click="removeUserFromGroup(user)" class="btn btn-danger">Remove</a>
       </li>
    </ul>
    <a href="#" v-if="canRemove" @click.prevent="deleteGroup" class="btn btn-danger">Delete</a>
  </li>
</template>

<script>
  import _ from 'lodash'
  import { http, events } from '../services'
  import store from '../store'

  export default {
    props: ['group'],

    data () {
      return {
        memberships: store.memberships,
        users: store.users,
        showingUsers: false
      }
    },

    computed: {
      groupUsers () {
        return this.users.filter(user => {
            return _.find(this.memberships, m => m.user_id === user.id && m.group_id === this.group.id)
        })
      },

      numberOfUsers () {
        return this.groupUsers.length
      },

      canRemove () {
        return this.numberOfUsers === 0
      }
    },

    methods: {
      deleteGroup () {
        store.deleteGroup(this.group.id)
      },

      removeUserFromGroup (user) {
        const membership = _.find(this.memberships, m => m.user_id === user.id && m.group_id === this.group.id)
        if (!membership) return

        store.removeMembership(membership.id, () => {
          this.showingUsers = false
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
