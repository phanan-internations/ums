<template>
  <li class="user">{{ user.name }}
    <a href="#" @click.prevent="deleteUser" class="btn btn-danger">Delete</a>
    <a href="#" @click="addingToGroup = !addingToGroup" class="btn btn-default">Add to Group</a>
    <div v-if="addingToGroup">
      <form class="add-to-group" v-if="eligibleGroups.length" @submit.prevent="addUserToGroup">
        <select name="group_id" v-model="selectedGroupId">
          <option v-for="group in eligibleGroups" :value="group.id">{{ group.name }}</option>
        </select>
        <input type="submit" value="Add to Group">
      </form>
      <p v-else class="member-all">{{ user.name }} has already been a member of all groups. Very active indeed!</p>
    </div>
  </li>
</template>

<script>
  import _ from 'lodash'
  import { http, events } from '../services'
  import store from '../store'

  export default {
    props: ['user'],

    data () {
      return {
        groups: store.groups,
        memberships: store.memberships,
        addingToGroup: false,
        selectedGroupId: null
      }
    },

    computed: {
      eligibleGroups () {
        return this.groups.filter(group => {
          return !_.find(this.memberships, m => m.group_id === group.id && m.user_id === this.user.id)
        })
      }
    },

    methods: {
      deleteUser () {
        store.deleteUser(this.user.id)
      },

      addUserToGroup () {
        if (!this.selectedGroupId) return

        store.addMembership(this.user.id, this.selectedGroupId, () => {
          this.selectedGroupId = null
          this.addingToGroup = false
        })
      }
    }
  }
</script>

<style scoped>
  form.add-to-group {
    margin-top: 12px;
  }

  .member-all {
    background: #ffedcb;
    padding: 8px;
    font-size: .9rem;
    margin-top: 8px;
  }
</style>
