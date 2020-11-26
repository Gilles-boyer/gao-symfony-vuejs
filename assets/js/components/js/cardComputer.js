import deleteComputer from "../modal/deleteComputer"
import deleteAttribution from "../modal/deleteAttribution"
import addAttributionWithAutocomplete from "../modal/addAttributionWithAutocomplete"

export default {
    name: 'cardComputer',
    components: {
        deleteComputer,
        deleteAttribution,
        addAttributionWithAutocomplete,
    },
    props: {
        computer: {
            type: Object,
            default: () => [{ id: null, name: null }],
        },
        indexPC: {
            type: Number,
            required: true
        }
    },
    methods: {
        attribution() {
            var data = []

            if (!Array.isArray(this.computer.attributions)) {
                var monObjet = this.computer.attributions
                var monTableau = Object.keys(monObjet).map(function(cle) {
                    return [Number(cle), monObjet[cle]];
                });
                this.computer.attributions = monTableau;
            }

            for (let index = 8; index <= 18; index++) {
                var attribution = {
                    id: null,
                    time: index,
                    client: {
                        id: null,
                        name: null,
                    }
                }

                if (this.computer.attributions.length > 0) {
                    for (let i = 0; i < this.computer.attributions.length; i++) {
                        if (this.computer.attributions[i][1]) {
                            if (attribution.time == this.computer.attributions[i][1].time) {
                                this.computer.attributions[i][1].time = this.computer.attributions[i][1].time
                                attribution = this.computer.attributions[i][1]
                            }

                        } else {
                            if (attribution.time == this.computer.attributions[i].time) {
                                this.computer.attributions[i].time = this.computer.attributions[i].time
                                attribution = this.computer.attributions[i]
                            }
                        }
                    }
                }

                data.push(attribution)
            }



            this.computer.attributions = data;

        }
    },
    mounted() {
        this.attribution()
    },
    watch: {
        computer: function() {
            this.attribution()
        }
    },
}