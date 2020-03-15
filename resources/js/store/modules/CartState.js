import axiosClient from "../../config/axios";

const state = {
    // array to store products in the cart
    products : [],
    //variable that controls the carts state
    drawer : false,
    //variable that controls the information that the snackbar will display
    newProduct : {product_name : ''},
    //variable that controls the snackbars state
    snackbar : false
};

const getters = {
    //get all Products in the cart
    allProducts: state => state.products,
    //get the drawers state
    drawerState: state => state.drawer,
    //get the most recent product added to the cart
    getNewProduct : state => state.newProduct,
    // the snackbars state
    snackbarState : state => state.snackbar,
    //count the diferent products in the cart
    countProducts : state => state.products.length,
    //calculate the total value of the items in the cart
    calculateTotal : state => {
        let total=0;
        state.products.forEach(({product_price,quantity}) =>
        {
            if(quantity!=="")
            //had trouble adding each value cause textfield deliver numbers as strings
                total+=parseFloat(product_price)*parseInt(quantity)
        })
        return total;
    }
};

const actions = {
    showDrawer({commit}){
        commit('changeDrawerState');
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
    //adds new product to the cart
    addProductToCart : (state,product) => {
        let bool=false;
        state.newProduct = product;
        state.snackbar=true;
        //checks if the product has already been added
        state.products.forEach((stateProduct)=>{
            if(stateProduct.product_id === product.product_id)
            {
                //in case it has, it increments its quantity
                bool=true;
                stateProduct.quantity=parseInt(stateProduct.quantity)+product.quantity;
            }
        });
        if(bool)
            return;
        //in case it has'nt, it adds it to the products array (cart)
        state.products = [
        ...state.products,
        product
        ];
    },
    hideSnackbar: state => state.snackbar = false,
    //deletes item from the cart
    deleteFromCart: (state,id) =>
        state.products= state.products.filter(({product_id})=> product_id!==id)
};

export default {
    state,
    getters,
    actions,
    mutations
}
