import Vue from 'vue'

export const events = {
  bus: null,

  init () {
    if (!this.bus) {
      this.bus = new Vue()
    }

    return this
  },

  emit (name, ...args) {
    this.bus.$emit(name, ...args)
    return this
  },

  on () {
    if (arguments.length === 2) {
      this.bus.$on(arguments[0], arguments[1])
    } else {
      each(Object.keys(arguments[0]), key => this.bus.$on(key, arguments[0][key]))
    }

    return this
  }
}
