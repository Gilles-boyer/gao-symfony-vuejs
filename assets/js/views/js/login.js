import { mapActions } from 'vuex'
import apiLogin from '../../service/login'

export default {
    data: () => ({
        valid: true,
        password: '',
        error: null,
        passwordRules: [
            v => !!v || 'Password is required',
            v => (v && v.length <= 10) || 'Password must be less than 6 characters',
        ],
        email: '',
        emailRules: [
            v => !!v || 'E-mail is required',
            v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
    }),

    methods: {
        ...mapActions(['changeStatutConnected', 'listOfPc']),
        validate: async function() {
            this.$refs.form.validate()
            this.error = null

            var data = {
                username: this.email,
                password: this.password,
            }

            var res = await apiLogin.login(data)

            console.log(res.data.token)

            if (res.data.token) {
                localStorage.setItem('token', res.data.token)
                this.changeStatutConnected(true)
                this.listOfPc(this.$store.state.date)
                window.location.href = "/login";
            } else {
                return this.error = 'login failed'
            }
        },

        testLogin: async function() {
            if (localStorage.getItem('token')) {
                var res = await apiLogin.index()
                if (res.data.error) {
                    return this.error = 'Merci de vous connecter un problème est survenue'
                } else {
                    this.changeStatutConnected(true)
                    this.$router.push('/')
                }
            }
        },

        reset() {
            this.$refs.form.reset()
        },

        resetValidation() {
            this.$refs.form.resetValidation()
        },
    },
    created() {
        this.testLogin()
    },
}