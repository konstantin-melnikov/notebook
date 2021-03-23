import template from './template.pug'

const route = 'menu'

export default {
  template,
  data () {
    return {
        menu: {}
    }
  },
  methods: {
    fetch () {
      this.$http.get(route).then(response => {
        this.menu = response.data
      })
    },
    callMethod(options) {
      if (options.action && typeof this.[options.action] === 'function') {
        this.[options.action](options)
      } else {
        console.log('Method not found');
      }
    },
    create () {
      this.$parent.createSubscriber()
    }
  },
  created () {
    this.fetch()
  },
  mounted () {
  }
}
