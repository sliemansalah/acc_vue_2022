const actions = {
  getData({}, queryParams) {

    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/seller/item`, {
        params: queryParams
      })
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  getItemType({}) {

    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/admin/item_type`)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  getCategory({}) {
    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/seller/item/list_categories`)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  findData({}, id) {
    return new Promise((resolve, reject) => {
        axios.get(window.server_url + `/api/seller/item/${id}`)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  saveData({}, data) {
    return new Promise((resolve, reject) => {
       let form = new FormData();
       if( data.name) form.append('name', data.name);
       if( data.description) form.append('description', data.description);
       if( data.price) form.append('price', data.price);
       if( data.selling_price) form.append('selling_price', data.selling_price);
       if( data.qty) form.append('qty', data.qty);
       if( data.item_type_id) form.append('item_type_id', data.item_type_id);
       if( data.store_id) form.append('store_id', data.store_id);
       if( data.image) form.append('image', data.image);
     
       if( data.is_offer) {
        form.append('is_offer', 1);
        if( data.special_price) form.append('special_price', data.special_price);
        if( data.special_price_start) form.append('special_price_start', data.special_price_start)
        if( data.special_price_end) form.append('special_price_end', data.special_price_end); 
       }
       else {
        form.append('is_offer', 0);
       }

       if(data.category) {
        data.category.forEach(ctg => {
          console.log(ctg.id);
          form.append('category_id[]', ctg.id);
         });
       }
        form.append('status', data.status?1:0);
      axios.post(window.server_url + `/api/seller/item`, form)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  updateData({}, data) {
    return new Promise((resolve, reject) => {
       let form = new FormData();
       if( data.name) form.append('name', data.name);
       if( data.description) form.append('description', data.description);
       if( data.price) form.append('price', data.price);
       if( data.selling_price) form.append('selling_price', data.selling_price);
       if( data.qty) form.append('qty', data.qty);
       if( data.item_type_id) form.append('item_type_id', data.item_type_id);
       if( data.store_id) form.append('store_id', data.store_id);
       if( data.image) form.append('image', data.image);

       if( data.is_offer) {
        form.append('is_offer', 1);
        if( data.special_price) form.append('special_price', data.special_price);
        if( data.special_price_start) form.append('special_price_start', data.special_price_start)
        if( data.special_price_end) form.append('special_price_end', data.special_price_end); 
       }
       else {
        form.append('is_offer', 0);
       }

       if(data.category) {
        data.category.forEach(ctg => {
          console.log(ctg.id);
          form.append('category_id[]', ctg.id);
         });
       }
        form.append('status', data.status?1:0);
      axios.post(window.server_url + `/api/seller/item/${data.id}`, form)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  updateStatus({}, data) {
    return new Promise((resolve, reject) => {
      axios.put(window.server_url + `/api/seller/item/`, JSON.parse(data))
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  
  removeData({}, id) {
    return new Promise((resolve, reject) => {
        axios.delete(window.server_url + `/api/seller/item`, {
            data: {
                ids: id
            }
        })
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  }
  
}
export default {
  namespaced: true,
  actions,
}
