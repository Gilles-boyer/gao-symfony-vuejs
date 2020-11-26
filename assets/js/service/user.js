import api from './api'

//collection of request to API for computer
export default {
    create(data) {
        return api.post('client/create', data)
    },
    index() {
        return api.get('client/getAll')
    }
}