<template src="./_form.html"></template>
<script>
    import {BankAccount, Bank} from '../../services/resources';
    import PageTitleComponent from '../../../../_default/components/PageTitle.vue';
    import 'materialize-autocomplete';
    import _ from 'lodash';
    import store from '../../store/store';
    
    export default{
        components: {
            'page-title': PageTitleComponent
        },
        data(){
            return{
                title: 'Edição de conta bancária',
                bankAccount: {
                    name: '',
                    agency: '',
                    account: '',
                    bank_id: '',
                    'default': false
                },
                bank: {
                    name: ''
                }
            }
        },
        created(){
            this.getBanks();
            this.getBankAccount(this.$route.params.id);
        },
        methods: {
            submit(){
                store.dispatch('bankAccount/update', this.bankAccount).then(() => {
                    Materialize.toast('Conta bancária alterada com sucesso!',5000, 'rounded blue');
                    this.$router.go({name: 'bank-account.list'});
                });
            },
            getBanks(){
                store.dispatch('bank/query').then((response) => {
                    this.initAutoComplete();
                });
            },
            initAutoComplete(){
                $(document).ready(() => {
                    $('#bank-id').materialize_autocomplete({
                        limit: 10,
                        multiple: {
                            enable: false
                        },
                        dropdown: {
                            el: '#bank-id-dropdown'
                        },
                        getData(value, callback){
                            let mapBanks = store.getters['bank/mapBanks'];
                            let banks = mapBanks(value);
                            callback(value, banks);
                        }
                    });
                });
            },
            getBankAccount(id){
                store.dispatch('bankAccount/get', id).then((response) => {
                    this.bankAccount = response.data.data;
                    this.bank = response.data.data.bank.data;
                });
            }
        }
    }
</script>