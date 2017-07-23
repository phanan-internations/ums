import _ from 'lodash'
import { http } from './services'

export default {
  groups: [],
  users: [],
  memberships: [],

  fetchData (cb = null) {
    http.get('data', ({ data }) => {
      this.groups = data.groups
      this.users = data.users
      this.memberships = data.memberships

      cb && cb()
    })
  },

  addGroup (name, cb = null) {
    http.post('groups', { name }, response => {
      this.groups.push(response.data)
      cb && cb()
    })
  },

  deleteGroup (id, cb = null) {
    http.delete(`groups/${id}`, {}, () => {
      const group = _.find(this.groups, group => group.id === id)
      this.groups.splice(this.groups.indexOf(group), 1)

      const membership = _.find(this.memberships, membership => membership.group_id === id)
      this.memberships.splice(this.memberships.indexOf(membership), 1)
    })
  },

  addUser (name, cb = null) {
    http.post('users', { name }, response => {
      this.users.push(response.data)
      cb && cb()
    })
  },

  deleteUser (id, cb = null) {
    http.delete(`users/${id}`, {}, () => {
      const user = _.find(this.users, user => user.id === id)
      this.users.splice(this.users.indexOf(user), 1)

      const membership = _.find(this.memberships, membership => membership.user_id === id)
      this.memberships.splice(this.memberships.indexOf(membership), 1)
      cb && cb()
    })
  },

  addMembership(userId, groupId, cb = null) {
    http.post('memberships', { user_id: userId, group_id: groupId }, response => {
      this.memberships.push(response.data)
      cb && cb()
    })
  },

  removeMembership(id, cb = null) {
    http.delete(`memberships/${id}`, {}, () => {
      const membership = _.find(this.memberships, membership => membership.id === id)
      this.memberships.splice(this.memberships.indexOf(membership), 1)
      cb && cb()
    })
  }
}
