import apiComputer from '../../../service/computer'
export default {

    props: {
        pc: {
            type: Object,
            default: () => [{ id: null, name: null }],
        },
        index: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            dialog: false,
            confirmation: "",
        }
    },
    methods: {
        deleteComputer: async function() {
            if (this.index == 0) {
                this.$store.state.computers.splice(0, 1)
            } else {
                this.$store.state.computers.splice(this.index, this.index)
            }

            var res = await apiComputer.delete(this.pc.id)

            if (res.data.error) {
                this.error = res.data.errorList
            } else {
                this.$store.state.confirmation = res.data.message
                this.$store.state.snackbar = true //open confirmation snackbar
                this.dialog = false
            }
        }
    },
}