const state = {
  page: null,
  message: {
    body: [],
    type: 'info'
  },
}
const getters = {
  getPage: state => state.page,
  getMessage: state => {
    return {
      body: state.message.body,
      type: (state.message.type === 'error') ? 'danger' : state.message.type
    }
  }
}

const actions = {
}

const mutations = {
  setPage (state, data) {
    state.page = data
  },
  showMessage (state, data) {
    const body = []
    if (typeof data.body !== 'object') {
      body.push(data.body)
    } else {
      body = data.body
    }
    state.message = {
      type: data.type,
      body
    }
  },
  hideMessage (state) {
    state.message.body = []
    state.message.type = 'info'
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
