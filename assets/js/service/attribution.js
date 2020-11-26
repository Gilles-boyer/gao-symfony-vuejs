import api from './api'

//collection of request to API for computer
export default {
    create(data) {
        return api.post('attribution/create', JSON.stringify(data))
    },
    delete(id) {
        return api.post('attribution/delete', JSON.stringify(id))
    }
}