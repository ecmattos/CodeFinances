<template>
	<form name="form" method="GET" @submit.prevent="submit()">
		<div class="filter-group">
			<div class="wrapper col s4 left">
				<input type="text" v-model="model" placeholder="Digite aqui a sua busca">
			</div>
			<button class="btn waves-effect left" @click.prevent="submit">
				<i class="material-icons">search</i>
			</button>
		</div>
	</form>
</template>

<script type="text/javascript">
	export default {
		props: {
			model: {
				required: true,
				type: String
			}
		},
		methods: {
			submit() {
				this.$emit('on-submit');
			}
		}
	}
</script>