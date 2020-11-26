import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            dialog: false,
            date: '',
            menu: false,
        }
    },

    computed: {
        ...mapGetters(['getDate'])
    },
    methods: {
        ...mapActions(['changeDate']),
        ...mapActions(['listOfPc']),

        dateChange() {
            this.$refs.menu.save(this.date)
            this.changeDate(this.date)
            this.listOfPc(this.date)
        }
    },
    created() {
        this.date = this.getDate
    },
};