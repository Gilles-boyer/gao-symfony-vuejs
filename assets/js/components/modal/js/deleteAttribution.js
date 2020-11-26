import apiAttribution from '../../../service/attribution'

export default {
    props: ['attribu'],
    data() {
        return {
            dialog: false,
        }
    },
    methods: {
        deleteAttribution: async function() {
            var data = {
                id: this.attribu.id
            }

            var res = await apiAttribution.delete(data)

            if (res.data.error) {
                console.log(res.data.errorList)
            } else {
                this.$store.state.confirmation = res.data.message
                this.$store.state.snackbar = true //open confirmation snackbar
                this.dialog = false
            }

            this.attribu.client.id = null
            this.attribu.client.name = null


        }
    },
}