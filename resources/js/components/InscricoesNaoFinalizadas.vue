<template>    
    <div class="card">
        <div class="card-header">Inscrições que não foram finalizadas</div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-10">
                    <label for="filter">Pesquisa rápida</label>
                    <input type="text" id="filter" class="form-control" v-model="quickSearchQuery">
                </div>
                <div class="form-group col-lg-2">
                    <label id="limit">Limitar resultados à:</label>
                    <select id="limit" class="form-control" v-model="limit" @change="getRecords">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="1000">1000</option>
                        <option value="">Todos</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th v-for="column in response.visivel">
                                <span class="sortable" @click="sortBy(column)">{{ response.custom_columns[column] || column }}</span>

                                <div class="arrow" v-if="sort.key === column" :class="{ 'arrow--asc': sort.order === 'asc', 'arrow--desc': sort.order === 'desc' }"></div>
                            </th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="record in filteredRecords">
                            <td>
                                {{ record.id_candidato }}
                            </td>
                            <td>
                                {{ record.nome }}
                            </td>
                            <td>
                                {{ record.email }}
                            </td>
                            <td>
                                {{ record.created_at }}
                            </td>
                            <td>
                                {{ record.updated_at }}
                            </td>
                            <td>
                                <a class="myhover" href="#" @click.prevent="ver_detalhes(record.id_candidato)" v-if="detalhe.id_candidato !== record.id_candidato"> Detalhes </a>
                                <template v-if="detalhe.id_candidato === record.id_candidato">
                                    <div class="container">
                                        <div class="row">
                                            <div v-if="record.curriculo !== null">
                                                <a class="myhover" href="#" @click.prevent="myFunction(record.curriculo)">Curriculo&nbsp;&nbsp;&nbsp;</a><br><br>
                                            </div>
                                            <div v-if="record.projeto !== null">
                                                <a class="myhover" href="#" @click.prevent="myFunction(record.projeto)">Projeto&nbsp;&nbsp;&nbsp;</a><br><br>
                                            </div>
                                        <div v-if="record.necessita_recomendante">
                                            <ul>
                                                <li>
                                                    <p :class="(record.recomendante1) ? 'mybg-success' : 'mybg-danger'">O recomendante 1 <span v-if="record.recomendante1"> FOI </span> <span v-else> NÃO FOI </span>inicializado.</p><br>
                                                </li>
                                                <li>
                                                    <p :class="(record.link_carta1) ? 'mybg-success' : 'mybg-danger'">A carta 1 <span v-if="record.link_carta1"> POSSUI </span> <span v-else> NÃO POSSUI </span>link de preenchimento.</p><br>
                                                </li>
                                                <li>
                                                    <p :class="(record.recomendante2) ? 'mybg-success' : 'mybg-danger'">O recomendante 2 <span v-if="record.recomendante2"> FOI </span> <span v-else> NÃO FOI </span>inicializado.</p><br>
                                                </li>
                                                <li>
                                                    <p :class="(record.link_carta2) ? 'mybg-success' : 'mybg-danger'">A carta 2 <span v-if="record.link_carta2"> POSSUI </span> <span v-else> NÃO POSSUI </span>link de preenchimento.</p><br>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>    
                                    </div>
                                    <a class="myhover" href="#" @click.provent="detalhe.id_candidato = null">Fechar</a>
                                </template>
                            </td>
                            <td>
                                <div>
                                    <a href="#" @click.provent="update(record.id_candidato, record.id_inscricao_pnpd)">Finalizar manualmente</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

    import queryString from 'query-string'

    export default {
        props: ['endpoint'],
        data () {
            return {
                response: {
                    table: '',
                    displayable: [],
                    visivel: [],
                    records: []
                },
                toggle: false,

                sort: {
                    key: 'id_user',
                    order: 'asc'
                },

                limit: 50,

                quickSearchQuery: '',

                detalhe: {
                    id_candidato: null,
                },

                finalizar: {
                    id_candidato: null,
                    id_inscricao_pnpd: null,
                    errors: []
                },
            }
        },

        computed: {
            filteredRecords () {
                
                let data = this.response.records

                data = data.filter((row) => {

                    return Object.keys(row).some((key) => {

                        return String(row[key]).toLowerCase().indexOf(this.quickSearchQuery.toLowerCase()) > -1
                    })
                })

                if (this.sort.key) {

                    data = _.orderBy(data, (i) => {

                        let value = i[this.sort.key]

                        if (!isNaN(parseFloat(value))) {

                            return parseFloat(value)
                        }

                        return String(i[this.sort.key]).toLowerCase()
                    }, this.sort.order)
                }

                return data
            }
        },

        methods: {
            myFunction: function (arquivo) {   
                window.open(arquivo, "_blank");    
            },

            getRecords () {
                return axios.get(`${this.endpoint}?${this.getQueryParameters()}`).then((response) => {
                    this.response = response.data.data
                })
            },

            getQueryParameters () {

                return queryString.stringify({

                    limit: this.limit
                })
            },

            sortBy (column) {
                
                this.sort.key  = column

                this.sort.order = this.sort.order  === 'asc' ? 'desc' : 'asc'
            },

            ver_detalhes (id_candidato) {
                this.detalhe.id_candidato = id_candidato
            },

            update (id_candidato, id_inscricao_pnpd) {
                axios.patch(`${this.endpoint}/${id_candidato+"_"+id_inscricao_pnpd}`, this.id_inscricao_pnpd).then(() => {

                    this.getRecords().then(() => {

                        this.finalizar.id_candidato = null
                        this.finalizar.id_inscricao_pnpd = null
                    })

                }).catch((error) => {

                    this.finalizar.errors = error.response.data.errors
                })
            }
        },

        mounted () {
            this.getRecords()
        },
    }
</script>

<style lang="scss">
    
    .sortable {
        cursor: pointer;
    }

    .arrow {
        display: inline-block;
        vertical-align: middle;
        width: 0;
        height: 0;
        margin-left: 5px;
        opacity: .6;

        &--asc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 4px solid #222;
        }

        &--desc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid #222;
        }

    }
</style>