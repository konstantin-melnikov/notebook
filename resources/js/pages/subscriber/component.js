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
    fetch (page = null) {
      const url = page || store.getters.getPage || route
      if (page) {
        store.commit('setPage', page)
      }
      this.$http.get(url).then(({ data }) => {
        this.subscribers = data.subscribers
      })
    },
    deleteSubscriber (id) {
      this.$http.delete(`${route}/${id}`).then(({ data }) => {
        this.fetch()
        this.showMessage({type: 'success', body: 'Абонент успешно удален'})
      })
    },
    editSubscriber (id) {
      this.$http.get(`${route}/${id}/edit`).then(({ data }) => {
        this.form = data.form
        this.subscriber = data.subscriber
        this.showForm('edit')
      })
    },
    updateSubscriber (id) {
      console.log(id)
    },
    showForm(action) {
      this.showModal = true
    },
    showMessage(message) {
      store.commit(
        'showMessage',
        { type: message.type, body: message.body }
      )
      setTimeout(function () {
        store.commit('hideMessage')
      }, config.messages.autoHideIn || 3000)
    }
  },
  created () {
    this.fetch()
  },
  mounted () {
  }
}
