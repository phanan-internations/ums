<template>
  <section class="groups">
    <h1>Our Amazing Groups</h1>

    <ul>
      <li v-for="group in groups" :group="group" is="Group" :key="group.id"></li>
    </ul>

    <div class="empty" v-if="!groups.length">
      There's no group. Create one using the form below.
    </div>

    <form method="post" @submit.prevent="addGroup">
      <input type="text" required v-model="newGroupName" placeholder="New Group Name">
      <input type="submit" value="Add">
    </form>
  </section>
</template>

<script>
  import { http } from '../services'
  import Group from './Group'
  import store from '../store'

  export default {
    components: { Group },

    data () {
      return {
        groups: store.groups,
        newGroupName: '',
      }
    },

    methods: {
      addGroup () {
        store.addGroup(this.newGroupName, () => {
          this.newGroupName = ''
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
