import VeeValidate from 'vee-validate';
import dictPtMessages from './locale/validator/pt-br';
import moment from 'moment';
import 'moment/locale/pt-br';
import numeral from 'numeral';
import 'numeral/locales/pt-br';

moment.locale('pt-br');
numeral.locale('pt-br');

VeeValidate.Validator.extend('date_format', {
	messages: {
		'pt-br': (field, args) => {
			return 'O campo ${field} não é uma Data válida.'
		}
	},
	validate: value => {
		return moment(value, 'DD/MM/YYYY').isValid();
	}
});

VeeValidate.Validator.extend('number_format', {
	messages: {
		'pt-br': (field, [min]) => {
			if(typeof min === undefined){
				return 'O campo ${field} não possui um Número válido.'
			}
			else{
				return 'O campo ${field} não pode ser menor que ${min}.'
			}
		}
	},
	validate: (value, [min]) => {
		let number = numeral(value);
		if(number.value() != null){
			return number.value() >= parseFloat(min);
		}
		return false;
	}
});

Vue.use(VeeValidate, {
	locale: 'pt-br',
	dictionary: {
		'pt-br': {
			messages: dictPtMessages
		}
	}
});
