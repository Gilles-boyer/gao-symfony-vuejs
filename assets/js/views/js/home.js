import { mapGetters, mapActions } from 'vuex'
import cardComputer from '../../components/cardComputer'
import addComputer from '../../components/modal/addComputer'
import datePicker from '../../components/datePicker'
import snackbar from '../../components/modal/snackbarConfirmation'
import apiLogin from '../../service/login'
import apiComputer from '../../service/computer'

export default {
    name: 'Home',
    components: {
        cardComputer,
        addComputer,
        datePicker,
        snackbar
    },
    data() {
        return {
            left: false,
            right: false,
            last_page: null,
        }
    },
    computed: {
        ...mapGetters(['getDate']),
        ...mapGetters(['getListComputers']),
    },
    methods: {
        ...mapActions(['listOfPc']),

        changePageRight() {
            this.$store.state.page = this.$store.state.page + 1
            this.listOfPc(this.getDate)
        },
        changePageLeft() {
            this.$store.state.page = this.$store.state.page - 1
            this.listOfPc(this.getDate)
        },

        logout: async function() {
            //var res = await apiLogin.logout()
            //console.log(res.data)
            localStorage.removeItem('token')
            this.$store.state.connected = false
            this.$router.push('/login')
        },

        test: async function() {
            var res = await apiComputer.index("2020-11-26")
            console.log(res.data)
        }
    },
    mounted() {
        this.listOfPc(this.getDate)
        this.test()
    },
}