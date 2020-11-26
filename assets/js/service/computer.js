import api from './api'
import store from '../store/index'

//collection of request to API for computer
export default {
    create(data) {
        return api.post('computer/create', data)
    },
    index(date) {
        return api.get('computer/getAll/' + date)
    },
    delete(id) {
        return api.get('computer/delete/' + id)
    }
}