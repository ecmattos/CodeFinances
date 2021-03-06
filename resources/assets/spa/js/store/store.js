import Vuex from 'vuex';
import auth from './auth';
import bankAccount from './bank-account';
import bank from './bank';
import categoryModule from './category';
import billModule from './bill';

import {CategoryExpense, CategoryRevenue, BillPay} from '../services/resources';

let categoryRevenue = categoryModule(), categoryExpense = categoryModule();
categoryRevenue.state.resource = CategoryRevenue;
categoryExpense.state.resource = CategoryExpense;

let billPay = billModule();
billPay.state.resource = BillPay;

export default new Vuex.Store({
	modules: {
		auth, 
		bankAccount, 
		bank,
		categoryRevenue,
        categoryExpense,
        billPay
	}
});