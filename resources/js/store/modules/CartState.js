import axiosClient from "../../axios";

const state = {
    products : [
        /*{
            product_id : 1,
            product_name : 'Black hat',
            product_price : 26.0,
            quantity : 2
        },
        {
            product_id : 2,
            product_name : 'Red hat',
            product_price : 24.0,
            quantity : 3
        },
        {
            product_id : 1,
            product_name : 'Gray hat',
            product_price : 20.0,
            quantity : 1
        }*/
    ],
    drawer : false,
    newProduct : {product_name : ''},
    snackbar : false
};

const getters = {
    allProducts: state => state.products,
    drawerState: state => state.drawer,
    getNewProduct : state => state.newProduct,
    snackbarState : state => state.snackbar,
    countProducts : state => state.products.length,
    calculateTotal : state => {
        let total=0;
        state.products.forEach(({product_price,quantity}) =>
        {
            if(quantity!=="")
                total+=parseFloat(product_price)*parseInt(quantity)
        })
        return total;
    }
};

const actions = {
    showDrawer({commit}){
        commit('changeDrawerState');
        console.log('siuuuu');
    },
    addProduct ({commit},product){
        commit('addProductToCart',product);
    },
    hideSnackbar({commit}){
        commit('hideSnackbar')
    },
    deleteFromCart({commit},id){
        commit('deleteFromCart',id)
    }
};

const mutations = {
    changeDrawerState : state => state.drawer =!state.drawer,
    addProductToCart : (state,product) => {
        let bool=false;
        state.newProduct = product;
        state.snackbar=true;
        state.products.forEach((stateProduct)=>{
            if(stateProduct.product_id === product.product_id)
            {
                bool=true;
                stateProduct.quantity=parseInt(stateProduct.quantity)+product.quantity;
            }
        });
        if(bool)
            return;
        state.products = [
        ...state.products,
        product
        ];
    },
    hideSnackbar: state => state.snackbar = false,
    deleteFromCart: (state,id) =>
        state.products= state.products.filter(({product_id})=> product_id!==id)
};

export default {
    state,
    getters,
    actions,
    mutations
}
