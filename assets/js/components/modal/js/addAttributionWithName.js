import apiClient from '../../../service/user'
import { mapActions } from 'vuex'
import apiAttribution from "../../../service/attribution"

export default {
    props: ['attribution', 'idComputer'],
    data() {
        return {
            create: false,
            error: null,
            firstName: "",
            lastName: "",
            invalid: true,
            rules: {
                required: value => !!value || 'Required.',
                min: v => v.length >= 3 || 'Min 3 characters',
            },
            disableCreer: true,
        }
    },
    methods: {
        strUcFirst: function(a) {
            return (a + "").charAt(0).toUpperCase() + a.substr(1);
        },

        ...mapActions(['listOfPc']),

        addAttribution: async function() {
            var firstName = this.firstName.toLowerCase();
            firstName = this.strUcFirst(firstName);

            var lastName = this.lastName.toUpperCase();

            var nickName = firstName + " " + lastName;

            var data = {
                'name': nickName
            }

            var res = await apiClient.create(data)

            if (res.data.error) {
                return this.error = res.data.errorList
            } else {
                //this.listOfClient()
            }
            console.log(res)
            var element = {
                date: this.$store.state.date,
                time: this.attribution.time,
                computer: this.idComputer,
                client: res.data.client.id
            }

            var result = await apiAttribution.create(element)

            if (result.data.error) {
                this.error = result.data.errorList
            } else {
                this.$store.state.confirmation = result.data.message
                this.$store.state.snackbar = true //open confirmation snackbar
                this.dialog = false
                this.listOfPc(this.$store.state.date)
            }
        },
        verifyData() {
            if (this.firstName.length > 2 && typeof(this.firstName) == "string" && this.lastName.length > 2) {
                this.disableCreer = false
            } else {
                this.disableCreer = true
            }
        },
        closeModal() {
            this.$emit("bool", false)
        }
    },
}