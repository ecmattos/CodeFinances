<template>
	<div class="row">
		<page-title>
			<h5>Administração de Categorias</h5>
		</page-title>			
		<div class="card-panel z-depth-5 col">
			<select-material :options="options" :selected="selected"></select-material>
			<category-tree :categories="categories"></category-tree>
		</div>	
		<category-save 
			:modal-options="modalOptionsSave" 
			:category.sync="categorySave"
			:cp-options="cpOptions" 
			@save-category="saveCategory">

			<span slot="title">{{ title }}</span>
			<div slot="footer">
				<button type="submit" class="btn btn-flat waves-effect green lighten-2 modal-close modal-action">OK</button>
				<button type="button" class="btn btn-flat waves-effect red modal-close modal-action">Cancelar</button>
			</div>
		</category-save>	

		<div class="fixed-action-btn">
			<a class="btn-floating btn-large" @click="modalNew(null)">
				<i class="large material-icons">add</i>
			</a>
		</div>
	</div>

	<modal :modal="modalOptionsDelete">
		<div slot="content" v-if="categoryDelete">
			<h5>Mensagem de confirmação</h5>
			<p><strong>Deseja excluir esta Categoria ?</strong></p>
			<div class="divider"></div>
			<p>Nome: <strong>{{ categoryDelete.name }}</strong></p>
			<div class="divider"></div>
		</div>
		<div slot="footer">
			<button class="btn btn-flat waves-effect green lighten-2 modal-close modal-action" @click="destroy()">OK</button>
			<button class="btn btn-flat waves-effect red modal-close modal-action">Cancelar</button>
		</div>
	</modal>	
	
</template>

<script type="text/javascript">
	import PageTitleComponent from '../../../../_default/components/PageTitle.vue';
	import {Category} from '../../services/resources';
	import CategoryTreeComponent from './CategoryTree.vue';
	import CategorySaveComponent from './CategorySave.vue';
	import {CategoryFormat, CategoryService} from '../../services/category-nsm';
	import ModalComponent from '../../../../_default/components/Modal.vue';

	export default {
		components: {
			'page-title': PageTitleComponent,
			'category-tree': CategoryTreeComponent,
			'category-save': CategorySaveComponent,
			'modal': ModalComponent
		},
		data() {
			return {
				categories: [],
				categoriesFormatted: [],
				categorySave: {
					id: 0,
					name: '',
					parent_id: 0
				},
				categoryDelete: null,
				category: null,
				parent: null,
				title: 'Adicionar Categoria',
				modalOptionsSave: {
					id: 'modal-category-save'
				},
				modalOptionsDelete: {
					id: 'modal-category-delete'
				}
			}
		},
		computed: {
			//opçoes para o campo select2 de categoria pai
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
			}
		},
		created() {
			this.getCategories();
		},
		methods: {
			getCategories(){
				Category.query().then(response => {
					this.categories = response.data.data;
					this.formatCategories();
				});
			},
			saveCategory() {
				CategoryService.save(this.categorySave, this.parent, this.categories, this.category)
					.then(response => {
						if(this.categorySave.id === 0){
							Materialize.toast('Conta criada com sucesso !', 3000, 'rounded green');						
						}
						else{
							Materialize.toast('Conta alterada com sucesso !', 3000, 'rounded blue');
						}
						this.resetScope();
					});
			},
			destroy(){
				CategoryService.destroy(this.categoryDelete, this.parent, this.categories)
					.then(response => {
						Materialize.toast('Conta excluída com sucesso !', 3000, 'rounded red');
						this.resetScope();
					});
			},
			modalNew(category){
				this.title = "Nova Categoria";
				this.categorySave = {
					id: 0,
					name: '',
					parent_id: category === null ? null : category.id
				};
				this.parent = category;
				$(`#${this.modalOptionsSave.id}`).modal('open');
			},
			modalEdit(category, parent){
				this.title = "Alteração de Categoria";
				this.categorySave = {
					id: category.id,
					name: category.name,
					parent_id: category.parent_id
				};
				this.category = category;
				this.parent = parent;
				$(`#${this.modalOptionsSave.id}`).modal('open');
			},
			modalDelete(category, parent){
				this.categoryDelete = category;
				this.parent = parent;
				$(`#${this.modalOptionsDelete.id}`).modal('open');
			},
			formatCategories(){
				this.categoriesFormatted = CategoryFormat.getCategoriesFormatted(this.categories);
				//this.categoriesFormatted = this.categories;
			},
			resetScope(){
                this.categorySave = {
                    id: 0,
                    name: '',
                    parent_id: 0
                };
                this.categoryDelete = null;
                this.category = null;
                this.parent = null;
                this.formatCategories();
            }
		},
		events: {
			'category-new'(category){
				this.modalNew(category);
			},
			'category-edit'(category, parent){
				this.modalEdit(category, parent);
			},
			'category-delete'(category, parent){
				this.modalDelete(category, parent);
			}
		}
	}	
</script>