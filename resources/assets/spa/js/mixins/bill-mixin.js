import PageTitleComponent from '../../../_default/components/PageTitle.vue';
import ModalComponent from '../../../_default/components/Modal.vue';
import SelectMaterialComponent from '../../../_default/components/SelectMaterial.vue';
import store from '../store/store';

export default {
    components: {
        'page-title': PageTitleComponent,
        'modal': ModalComponent,
        'select-material': SelectMaterialComponent
    },
    props:{
        index:{
            type: Number,
            required: false,
            'default': -1
        },
        modalOptions:{
            type: Object,
            required: true
        },
    },
    data(){
        return {
            bill: {
                id: 0,
                date_due: '',
                name: '',
                value: 0,
                done: false,
                bank_account_id: 0,
                category_id: 0
            }
        };
    },
    computed:{
        cpOptions(){
            return {
                data: this.categoriesFormatted,
                templateResult(category){
                    let margin = '&nbsp'.repeat(category.level * 6);
                    let text = category.hasChildren ? `<strong>${category.text}</strong>` : category.text;
                    return `${margin}${text}`;
                },
                escapeMarkup(m){
                    return m;
                }
            }
        },
        bankAccounts(){
            return store.state.bankAccount.lists;
        },
        categoriesFormatted(){
            return store.getters[`${this.categoryNamespace()}/categoriesFormatted`];
        }
    },
    watch: {
        bankAccounts(bankAccounts){
            if(bankAccounts.length > 0){
                this.initAutoComplete();
            }
        }
    },
    methods: {
        doneId(){
            return `done-${this._uid}`;
        },
        bankAccountTextId(){
            return `bank-account-text-${this._uid}`;
        },
        bankAccountDropdownId(){
            return `bank-account-dropdown-${this._uid}`;
        },
        formId(){
            return `form-bill-${this._uid}`;
        },
        validateCategory(){
            let valid = this.$validator.validate('category_id', this.bill.category_id);
            let parent = $(`#${this.formId()}`).find('[name="category_id"]').parent();
            let label = parent.find('label');
            let labelSelect2 = parent.find('.select2-selection select2-selection--single');
            if(valid){
                label.removeClass('label-error');
                spanSelect2.removeClass('.select2-invalid');                                                  
            }
            else{
                label.removeClass('label-error').addClass('label-error');
                spanSelect2.removeClass('.select2-invalid').addClass('.select2-invalid'); 
            }
        },
        initSelect2(){
            let select = $(`#${this.formId()}`).find('[name="category_id"]');
            let self = this;
            select.on('select2:close', () => {
                self.validateCategory();
            });
        },
        initAutoComplete(){
            let self = this;
            $(`#${this.bankAccountTextId()}`).materialize_autocomplete({
                limit: 10,
                multiple: {
                    enable: false
                },
                dropdown: {
                    el: `#${this.bankAccountDropdownId()}`
                },
                getData(value, callback){
                    let mapBankAccounts = store.getters['bankAccount/mapBankAccounts'];
                    let bankAccounts = mapBankAccounts(value);
                    callback(value, bankAccounts);
                },
                onSelect(item){
                    self.bill.bank_account_id = item.id;
                }
            });        
        },
        submit(){
            if(this.bill.id !== 0){
                store.dispatch(`${this.namspace()}/edit`, {
                    bill: this.bill,
                    index: this.index
                }).then(() => {
                    Materialize.toast('Conta atualizada com sucesso !', 4000, 'rounded blue');
                    this.resetScope();
                })
            }
            else{
                store.dispatch(`${this.namspace()}/save`, this.bill).then(() => {
                  Materialize.toast('Conta criada com sucesso !', 4000, 'rounded green');
                  this.resetScope();  
                });
            }
        },
        resetScope(){
            this.bill = {
                id: 0,
                date_due: '',
                name: '',
                value: 0,
                done: false,
                bank_account_id: 0,
                category_id: 0
            }
        }
    }
}