export class Jwt{
	static accessToken(email, password){
		return Vue.http.post('access_token', {
			email: email,
			password: password
		})
	}

	static Logout(){
		return Vue.http.post('logout');
	}

	static refreshToken(){
		return Vue.http.post('refresh_token');	
	}
}

let User = Vue.resource('user');
let BankAccount = Vue.resource('bank_accounts{/id}', {}, {
	lists: {
		method: 'GET',
		url: 'bank_accounts/lists'
	}
}); //GET, POST, DELETE, LISTS
let Bank = Vue.resource('banks'); //GET, POST, DELETE ...
let CategoryRevenue = Vue.resource('category_revenues{/id}'); //GET, POST, DELETE ...
let CategoryExpense = Vue.resource('category_expenses{/id}'); //GET, POST, DELETE ...
let BillPay = Vue.resource('bill_pays{/id}'); //GET, POST, DELETE ... 

export {User, BankAccount, Bank, CategoryRevenue, CategoryExpense, BillPay};