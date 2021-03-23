import { mapGetters } from 'vuex'
import template from './template.pug'
import MenuComponent from '@/components/menu/component'
import store from '@/store'
import config from '@/config/app'

const route = 'subscribers'

export default {
  template,
  components: {
    MenuComponent,
  },
  data () {
    return {
      subscribers: [],
      showModal: false,
      columns: {
        name: 'ФИО',
        phone: 'Телефон',
        email: 'Email',
        actions: ''
      },
      errors: [],
      subscriber: [],
      form: [],
    }
  },
  computed: {
    ...mapGetters({
      message: 'getMessage'
    })
  },
  methods: {
    storeLastPage() {
      if (this.subscribers && this.subscribers.links) {
        const links = this.subscribers.links.slice(-2, -1)
        store.commit('setPage', links[0].url)
      }
    },
    fetch (page = null) {
      const url = page || store.getters.getPage || route
      if (page) {
        store.commit('setPage', page)
      }
      this.$http.get(url).then(response => {
        this.subscribers = response.data.subscribers
      })
    },
    createSubscriber () {
      this.$http.get(`${route}/create`).then(response => {
        this.form = response.data.form
        this.subscriber = response.data.subscriber
        this.showForm()
      })
    },
    storeSubscriber () {
      this.$http.post(`${route}`, this.subscriber).then(response => {
        this.hideForm()
        this.storeLastPage()
        this.fetch()
      }).catch(error => {
        if (error.response.status == 422) {
          this.errors = error.response.data.errors
        }
      })
    },
    deleteSubscriber (id) {
      this.$http.delete(`${route}/${id}`).then(response => {
        this.fetch()
        this.showMessage({type: 'success', body: 'Абонент успешно удален'})
      })
    },
    editSubscriber (id) {
      this.$http.get(`${route}/${id}/edit`).then(response => {
        this.form = response.data.form
        this.subscriber = response.data.subscriber
        this.form.title = this.form.title + ' ' + this.subscriber.id
        this.showForm()
      })
    },
    updateSubscriber (id) {
      this.$http.patch(`${route}/${id}`, this.subscriber).then(response => {
        this.hideForm()
        this.fetch()
      }).catch(error => {
        if (error.response.status == 422) {
          this.errors = error.response.data.errors
        }
      })
    },
    showForm () {
      this.showModal = true
    },
    hideForm () {
      this.showModal = false
    },
    showMessage (message) {
      store.commit(
        'showMessage',
        { type: message.type, body: message.body }
      )
      setTimeout(function () {
        store.commit('hideMessage')
      }, config.messages.autoHideIn || 3000)
    },
    clearError (fieldName) {
      if (this.errors && this.errors[fieldName]) {
        this.$delete(this.errors, fieldName);
      }
    }
  },
  created () {
    this.fetch()
  },
  mounted () {
  }
}
