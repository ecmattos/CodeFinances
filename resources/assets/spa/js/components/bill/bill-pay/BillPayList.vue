<template>
    <div class="container">
        <div class="row">
            <page-title>
                <h5>Minhas Contas Bancárias</h5>
            </page-title>
            <div class="card-panel z-depth-5">
                <search @on-submit="filter" :model.sync="search"></search>
                <table class="bordered striped highlight responsive-table ">
                    <thead>
                    <tr>
                        <th v-for="(key, o) in table.headers" :width="o.width">
                            <a href="#" @click.prevent="sortBy(key)">
                                {{ o.label }}
                                <i class="material-icons right" v-if="searchOptions.order.key == key">
                                    {{ searchOptions.order.sort == 'asc' ? 'arrow_drop_up' : 'arrow_drop_down' }}
                                </i>
                            </a>
                        </th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(index,o) in bills">
                        <td>&nbsp;{{ o.id }}</td>
                        <td>{{ o.date_due | dateFormat }}</td>
                        <td>{{ o.name }}</td>
                        <td>{{ o.value | moneyFormat }}</td>
                        <td>
                            <i class="material-icons green-text" v-if="o.default">check</i>
                        </td>
                        <td>
                            <a href="#" @click.prevent="@openModalEdit(index)">Editar</a>
                            <a href="#" @click.prevent="@openModalDelete(o)">Excluir</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <pagination
                        :current-page.sync="searchOptions.pagination.current_page"
                        :per-page="searchOptions.pagination.per_page"
                        :total-records="searchOptions.pagination.total"></pagination>
            </div>
            <div class="fixed-action-btn">
                <a class="btn-floating btn-large" href="#" @click.prevent="openModalCreate()">
                    <i class="large material-icons">add</i>
                </a>
            </div>
        </div>
    </div>

    <bill-pay-create :modal-options="modalCreate"></bill-pay-create>
    <bill-pay-update :index="indexUpdate" :modal-options="modalEdit"></bill-pay-update>

    <modal :modal="modalDelete">
        <div slot="content" v-if="billPayDelete">
            <h4>Mensagem de confirmação</h4>
            <p><strong>Deseja Excluir esta conta?</strong></p>
            <div class="divider"></div>
            <p>Vencimento: <strong>{{billPayDelete.date_due}}</strong></p>
            <p>Nome: <strong>{{billPayDelete.name}}</strong></p>
            <p>Valor: <strong>R$ {{billPayDelete.value}}</strong></p>
            <div class="divider"></div>
        </div>
        <div slot="footer">
            <button class="btn btn-flat waves-effect green lighten-2 modal-close modal-action"
                    @click="destroy()">OK
            </button>
            <button class="btn btn-flat waves-effect waves-red modal-close modal-action">Cancelar</button>
        </div>
    </modal>
</template>

<script type="text/javascript">
    import ModalComponent from '../../../../../_default/components/Modal.vue';
    import PageTitleComponent from '../../../../../_default/components/PageTitle.vue';
    import PaginationComponent from '../../Pagination.vue';
    import SearchComponent from '../../Search.vue';
    import BillPayCreateComponent from './BillPayCreate.vue';
    import BillPayUptadeComponent from './BillPayUpdate.vue';
    import store from '../../../store/store';

    export default {
        components: {
            'modal': ModalComponent,
            'pagination': PaginationComponent,
            'page-title': PageTitleComponent,
            'search': SearchComponent,
            'bill-pay-create': BillPayCreateComponent,
            'bill-pay-update': BillPayUptadeComponent
        },
        data(){
            return {
                modalDelete: {
                    id: 'modal-delete'
                },
                modalCreate: {
                    id: 'modal-create'
                },
                modalEdit: {
                    id: 'modal-edit'
                },
                indexUpdate: 0,
                table: {
                    headers: {
                        id: {label: '#',width: '7%'},
                        date_due: {label: 'Vencimento',width: '30%'},
                        name: {label: 'Nome',width: '30%'},
                        value: {label: 'Valor', width: '8%'},
                        done: {label: 'Paga', width: '5%'},
                    }
                }
            };
        },
        computed: {
            bills(){
                return store.state.billPay.bills;
            },
            searchOptions(){
                return store.state.billPay.searchOptions;
            },
            search:{
                get(){
                    return store.state.billPay.searchOptions.search;
                },
                set(value){
                    store.commit('billPay/setFilter', value);
                }
            },
            billPayDelete(){
                return store.state.billPay.billDelete;
            }
        },
        created(){
            store.dispatch('billPay/query');
            store.dispatch('bankAccount/lists');
            store.dispatch('categoryExpense/query');
        },
        methods: {
            destroy(){
                store.dispatch('billPay/delete').then((response) => {
                    Materialize.toast('Conta com sucesso!', 4000);
                });
            },
            openModalCreate(){
                $(`#modal-create`).modal('open');
            },
            openModalEdit(index){
                this.indexUpdate = index;
                $(`#modal-edit`).modal('open');
            },
            openModalDelete(billPay){
                store.commit('billPay/setDelete', billPay);
                $(`#modal-delete`).modal('open');
            },
            sortBy(key){
                store.dispatch('billPay/queryWithSortBy', key);
            },
            filter(){
                store.dispatch('billPay/queryWithFilter');
            }
        },
        events: {
            'pagination::changed'(page){
                store.dispatch('billPay/queryWithPagination', page);
            }
        }
    };
</script>