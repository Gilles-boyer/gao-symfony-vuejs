import { mapActions } from 'vuex'
import apiComputer from '../../../service/computer'
export default {
    name: 'addComputer',

    data: () => ({
        dialog: false,
        name: "",
        disableCreer: true,
        rules: {
            required: value => !!value || 'Required.',
            min: v => v.length >= 3 || 'Min 3 characters',
        },
        error: null,
    }),

    methods: {
        close() {
            this.error = null
            this.dialog = false
        },

        verifyData() {
            if (this.name.length > 2 && typeof(this.name) == "string") {
                this.disableCreer = false
            } else {
                this.disableCreer = true
            }
        },

        addComputer: async function() {
            this.error = null

            var data = {
                name: this.name,
            }

            var res = await apiComputer.create(data)

            if (res.data.error) {
                this.error = res.data.errorList
            } else {
                this.name = "";
                this.$store.state.confirmation = res.data.message
                this.$store.state.snackbar = true //open confirmation snackbar
                this.listOfPc(this.$store.state.date)
                this.dialog = false
            }
        },
        ...mapActions(['listOfPc'])
    },

}