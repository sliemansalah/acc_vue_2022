const actions = {
  getData({}, queryParams) {

    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/seller/rate`, {
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
  getCustomers({}) {
    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/seller/rate/list_customer`)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  getItems({}) {
    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/seller/rate/list_item`)
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
        axios.get(window.server_url + `/api/seller/rate/${id}`)
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
       if( data.customer_id) form.append('customer_id', data.customer_id);
       if( data.store_id) form.append('store_id', data.store_id);
       if( data.item_id) form.append('item_id', data.item_id);
       if( data.rating) form.append('rating', data.rating);
       if( data.comment) form.append('comment', data.comment);
      axios.post(window.server_url + `/api/seller/rate`, form)
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
       if( data.customer_id) form.append('customer_id', data.customer_id);
       if( data.store_id) form.append('store_id', data.store_id);
       if( data.item_id) form.append('item_id', data.item_id);
       if( data.rating) form.append('rating', data.rating);
       if( data.comment) form.append('comment', data.comment);
      axios.post(window.server_url + `/api/seller/rate/${data.id}`, form)
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
      axios.put(window.server_url + `/api/seller/rate/`, JSON.parse(data))
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
        axios.delete(window.server_url + `/api/seller/rate`, {
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
